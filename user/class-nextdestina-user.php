<?php

/**
 * The user-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Nextdestina Booking
 * @subpackage nextdestina-booking/admin
 * @author     Bug Finder <atikulislam92@mail.com>
 */

class Nextdestina_User {

	public function __construct() {

		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_user_assets' ) );

		add_action( 'init', array( $this, 'nextdestina_handle_profile_form' ) );
		add_action( 'init', array( $this, 'nextdestina_handle_user_password' ) );

		// Login
		add_action( 'template_redirect', array( $this, 'traveler_handle_login' ) );
		add_action( 'init', array( $this, 'nextdestina_login_endpoint' ) );
		add_filter( 'template_include', array( $this, 'nextdestina_login_virtual_template' ) );

		// Thank You

		add_action( 'init', array( $this, 'nextdestina_thank_you_endpoint' ) );
		add_filter( 'template_include', array( $this, 'nextdestina_thank_you_virtual_template' ) );
		
		// Booking cancel

		add_action( 'init', array( $this, 'nextdestina_booking_cancel_endpoint' ) );
		add_filter( 'template_include', array( $this, 'nextdestina_booking_cancel_virtual_template' ) );
		
		// Booking success

		add_action( 'init', array( $this, 'nextdestina_booking_success_endpoint' ) );
		add_filter( 'template_include', array( $this, 'nextdestina_booking_success_virtual_template' ) );

		// Forget Password
		add_action( 'init', array( $this, 'forget_password_endpoint' ) );
		add_filter( 'template_include', array( $this, 'forget_password_template' ) );

		// Reset Password
		add_action( 'init', array( $this, 'reset_password_endpoint' ) );
		add_filter( 'template_include', array( $this, 'reset_password_template' ) );

		// Traveler Registration
		add_action( 'template_redirect', array( $this, 'traveler_handle_registration' ) );
		add_action('init', [$this, 'maybe_verify_user_email']);
		add_filter('authenticate', [$this, 'block_unverified_users'], 30, 3);

		add_action( 'init', array( $this, 'nextdestina_register_endpoint' ) );
		add_filter( 'template_include', array( $this, 'nextdestina_register_virtual_template' ) );

		// User Dashboard
		add_filter('show_admin_bar', array($this, 'hide_admin_bar_for_travelers'));
		add_filter('get_avatar', [$this, 'override_user_avatar'], 10, 5);

		// Support Ticket

		add_action('wp_ajax_create_ticket_submit', [$this, 'create_ticket_submission_handle']);
		add_action('wp_ajax_nopriv_create_ticket_submit', [$this, 'create_ticket_submission_handle']);

		add_action('wp_ajax_nd_submit_ticket_reply', [$this, 'user_ticket_reply_handle']);
		add_action('wp_ajax_nopriv_nd_submit_ticket_reply', [$this, 'user_ticket_reply_handle']);

	}

	public function enqueue_user_assets() {

		wp_enqueue_style(
            'intl-tel-input-css',
            'https://cdn.jsdelivr.net/npm/intl-tel-input@17/build/css/intlTelInput.min.css',
            false,
            '17.0.19'
        );

        wp_enqueue_script(
			'intl-tel-input-js',
			'https://cdn.jsdelivr.net/npm/intl-tel-input@17/build/js/intlTelInput.min.js',
			array(),
			'17.0.19',
			true
		);

		wp_enqueue_style(
			'user-style',
			TRAVELER_DASHBOARD_PLUGIN_URL . 'user/assets/css/user-style.css',
			false,
			TRAVELER_DASHBOARD_VERSION
		);

		// JS

		wp_enqueue_script(
            'nd-ticket',
            TRAVELER_DASHBOARD_PLUGIN_URL . 'user/assets/js/support-ticket.js',
            array(),
            TRAVELER_DASHBOARD_VERSION,
            true
        );

        wp_localize_script('nd-ticket', 'ndTicket', [
	        'ajaxurl' => admin_url('admin-ajax.php')
	    ]);
	}

	/*
	 * User Profile
	 */

    public function nextdestina_handle_profile_form() {
        if (
            isset($_POST['submit_profile']) &&
            isset($_POST['user_profile_nonce']) &&
            wp_verify_nonce($_POST['user_profile_nonce'], 'update_user_profile')
        ) {
            $user_id = get_current_user_id();

            // Update user data
            wp_update_user([
                'ID'         => $user_id,
                'first_name' => sanitize_text_field($_POST['first_name']),
                'last_name'  => sanitize_text_field($_POST['last_name']),
                'user_email' => sanitize_email($_POST['email']),
            ]);

            // Update meta
            update_user_meta( $user_id, 'phone', sanitize_text_field($_POST['full_phone']) );
            update_user_meta( $user_id, 'address', sanitize_text_field($_POST['address']) );
            update_user_meta( $user_id, 'state', sanitize_text_field($_POST['state']) );
            update_user_meta( $user_id, 'zipcode', sanitize_text_field($_POST['zipcode']) );
            update_user_meta( $user_id, 'country', sanitize_text_field($_POST['country'] ?? '') );
            update_user_meta( $user_id, 'language', sanitize_text_field($_POST['language'] ?? '') );
            update_user_meta( $user_id, 'timezone', sanitize_text_field($_POST['timezone'] ?? '') );

            // Handle image
            if (!empty($_FILES['profile_picture']['name'])) {
                require_once ABSPATH . 'wp-admin/includes/file.php';
                require_once ABSPATH . 'wp-admin/includes/media.php';
                require_once ABSPATH . 'wp-admin/includes/image.php';

                $attachment_id = media_handle_upload('profile_picture', 0);
                if (!is_wp_error($attachment_id)) {
                    update_user_meta($user_id, 'profile_picture', $attachment_id);
                }
            }

            // Redirect early
            wp_safe_redirect(add_query_arg('updated', 'true', wp_get_referer()));
            exit;
        }
    }

	public function nextdestina_handle_user_password() {
		
		if (isset($_POST['submit_password']) && wp_verify_nonce($_POST['user_password_nonce'], 'update_user_password')) {
		    $old_password     = $_POST['old_password'] ?? '';
		    $new_password     = $_POST['new_password'] ?? '';
		    $confirm_password = $_POST['confirm_password'] ?? '';
		    $user             = wp_get_current_user();

		    // Check validations
		    if (empty($old_password) || empty($new_password) || empty($confirm_password)) {
		        wp_redirect(add_query_arg('status', 'empty_fields', $_SERVER['REQUEST_URI']));
		        exit;
		    }

		    if (!wp_check_password($old_password, $user->user_pass, $user->ID)) {
		        wp_redirect(add_query_arg('status', 'wrong_old', $_SERVER['REQUEST_URI']));
		        exit;
		    }

		    if ($new_password !== $confirm_password) {
		        wp_redirect(add_query_arg('status', 'mismatch', $_SERVER['REQUEST_URI']));
		        exit;
		    }

		    // Change password
		    wp_set_password($new_password, $user->ID);
		    wp_redirect(add_query_arg('status', 'success', $_SERVER['REQUEST_URI']));
		    exit;
		}
	}

	/**
     * Hide Admin Bar
     */
	public function hide_admin_bar_for_travelers($show) {
		if (current_user_can('traveler')) {
			return false;
		}
		return $show;
	}

	public function override_user_avatar($avatar, $id_or_email, $size, $default, $alt) {
		$user = false;

		if (is_numeric($id_or_email)) {
			$user = get_user_by('id', (int) $id_or_email);
		} elseif (is_object($id_or_email) && ! empty($id_or_email->user_id)) {
			$user = get_user_by('id', (int) $id_or_email->user_id);
		} elseif (is_string($id_or_email)) {
			$user = get_user_by('email', $id_or_email);
		}

		if ($user && $user instanceof WP_User) {
			$profile_img_id = get_user_meta($user->ID, 'profile_picture', true);
			if ($profile_img_id) {
				$profile_img_url = wp_get_attachment_image_url($profile_img_id, 'thumbnail');
				if ($profile_img_url) {
					$avatar = sprintf(
						'<img alt="%s" src="%s" class="custom-avatar avatar avatar-%d photo" height="%d" width="%d"/>',
						esc_attr($alt),
						esc_url($profile_img_url),
						(int) $size,
						(int) $size,
						(int) $size
					);
				}
			}
		}

		return $avatar;
	}

    /**
     * Handle traveler login
     */

    public function traveler_handle_login() {
        if (isset($_POST['traveler_login'])) {
            if (
                isset($_POST['traveler_login_nonce']) &&
                wp_verify_nonce($_POST['traveler_login_nonce'], 'traveler_login_action')
            ) {
                $username_email = sanitize_text_field($_POST['username_email']);
                $password       = $_POST['password'];
                $remember       = isset($_POST['rememberme']);

                $creds = array(
                    'user_login'    => $username_email,
                    'user_password' => $password,
                    'remember'      => $remember,
                );

                $user = wp_signon($creds, false);

                if (is_wp_error($user)) {
                    wp_redirect(add_query_arg('login', 'failed', wp_get_referer()));
                    exit;
                } else {
                    if (in_array('traveler', (array) $user->roles)) {
                        wp_redirect(home_url('/my-dashboard/'));
                        exit;
                    } else {
                        wp_logout();
                        wp_redirect(add_query_arg('login', 'not_allowed', wp_get_referer()));
                        exit;
                    }
                }
            } else {
                wp_die(__('Security check failed. Please try again.', 'nextdestina-booking'));
            }
        }
    }

	/*
	 * User Login page
	 */

	public function nextdestina_login_endpoint() {
		add_rewrite_rule('^traveler-login/?$', 'index.php?nextdestina_login_page=1', 'top');
		add_rewrite_tag('%nextdestina_login_page%', '1');
	}

	public function nextdestina_login_virtual_template($template) {
		if (get_query_var('nextdestina_login_page') == '1') {
			return plugin_dir_path(__FILE__) . 'templates/page-login.php';
		}
		return $template;
	}

	/*
	 * Thank You page
	 */

	public function nextdestina_thank_you_endpoint() {
		add_rewrite_rule('^thank-you/?$', 'index.php?nextdestina_thank_you_page=1', 'top');
		add_rewrite_tag('%nextdestina_thank_you_page%', '1');
	}

	public function nextdestina_thank_you_virtual_template($template) {
		if (get_query_var('nextdestina_thank_you_page') == '1') {
			return plugin_dir_path(__FILE__) . 'templates/page-thank-you.php';
		}
		return $template;
	}
	
	/*
	 * Booking cancel page
	 */

	public function nextdestina_booking_cancel_endpoint() {
		add_rewrite_rule('^booking-cancel/?$', 'index.php?nextdestina_booking_cancel_page=1', 'top');
		add_rewrite_tag('%nextdestina_booking_cancel_page%', '1');
	}

	public function nextdestina_booking_cancel_virtual_template($template) {
		if (get_query_var('nextdestina_booking_cancel_page') == '1') {
			return plugin_dir_path(__FILE__) . 'templates/page-booking-cancel.php';
		}
		return $template;
	}
	
	/*
	 * Booking success page
	 */

	public function nextdestina_booking_success_endpoint() {
		add_rewrite_rule('^booking-success/?$', 'index.php?nextdestina_booking_success_page=1', 'top');
		add_rewrite_tag('%nextdestina_booking_success_page%', '1');
	}

	public function nextdestina_booking_success_virtual_template($template) {
		if (get_query_var('nextdestina_booking_success_page') == '1') {
			return plugin_dir_path(__FILE__) . 'templates/page-booking-success.php';
		}
		return $template;
	}

	/*
	 * This function is not a callback or don't have any hook
	 * It just a function to get login URL
	 */
	public static function get_login_url() {
		return home_url('/traveler-login/');
	}

	/*
	 * Forget Password page
	 */
	public function forget_password_endpoint() {
		add_rewrite_rule('^traveler-forgot-password/?$', 'index.php?nd_forget_password_page=1', 'top');
		add_rewrite_tag('%nd_forget_password_page%', '1');
	}
	public function forget_password_template($template) {
		if (get_query_var('nd_forget_password_page') == '1') {
			return plugin_dir_path(__FILE__) . 'templates/page-forgot-password.php';
		}
		return $template;
	}

	/*
	 * Reset Password page
	 */
	public function reset_password_endpoint() {
		add_rewrite_rule('^traveler-reset-password/?$', 'index.php?ndb_reset_password=1', 'top');
		add_rewrite_tag('%ndb_reset_password%', '1');
	}
	public function reset_password_template($template) {
		if (get_query_var('ndb_reset_password') == '1') {
			return plugin_dir_path(__FILE__) . 'templates/page-reset-password.php';
		}
		return $template;
	}

	/**
     * Handle traveler registration
     */

    public function traveler_handle_registration() {
        if (
            isset($_POST['traveler_register']) &&
            isset($_POST['traveler_register_nonce']) &&
            wp_verify_nonce($_POST['traveler_register_nonce'], 'traveler_register_action')
        ) {
            $username   = sanitize_user($_POST['username']);
            $email      = sanitize_email($_POST['email']);
            $password   = $_POST['password'];
            $first_name = sanitize_text_field($_POST['first_name']);
            $last_name  = sanitize_text_field($_POST['last_name']);
            $phone      = sanitize_text_field($_POST['phone']);
    
            $referer = wp_get_referer() ?: get_permalink(get_the_ID());
    
            if ( empty($username) || empty($email) || empty($password) ) {
                wp_redirect(add_query_arg('error', 'failed', $referer));
                exit;
            }
    
            if ( username_exists($username) || email_exists($email) ) {
                wp_redirect(add_query_arg('error', 'exists', $referer));
                exit;
            }
    
            $user_id = wp_create_user($username, $password, $email);
    
            if ( is_wp_error($user_id) ) {
                wp_redirect(add_query_arg('error', 'failed', $referer));
                exit;
            }
    
            wp_update_user([
                'ID'         => $user_id,
                'role'       => 'traveler',
                'first_name' => $first_name,
                'last_name'  => $last_name,
            ]);
            update_user_meta($user_id, 'phone', $phone);
    
            // === Check if Email Verification toggle is ON ===
            
            $email_verification = get_option('email_verification');
            $email_notification = get_option('email_notification');
            
            if ($email_verification == 1) {
                // Create verification token
                $token = wp_generate_password(20, false);
                update_user_meta($user_id, 'email_verification_token', $token);
                update_user_meta($user_id, 'email_verified', '0');
    
                // Verification link
                $verification_link = add_query_arg([
                    'nd_verify_email' => '1',
                    'user_id'         => $user_id,
                    'token'           => $token,
                ], site_url());
    
                // Load template if exists
                $template_posts = get_posts([
                    'post_type'      => 'email_template',
                    'title'          => 'traveler',
                    'post_status'    => 'publish',
                    'posts_per_page' => 1,
                ]);
                $template = !empty($template_posts) ? $template_posts[0] : null;
    
                $send_email = $template ? get_post_meta($template->ID, '_registration_email_switch', true) : 'yes';
                $subject = $template ? (string) get_post_meta($template->ID, '_registration_email_subject', true) : __('Verify Your Email', 'nextdestina-booking');
                $message = $template ? (string) get_post_meta($template->ID, '_registration_email_message', true) : 'Hello {first_name}, please click the link below to verify your email: {verification_link}';
    
                // Replace placeholders
                $replacements = [
                    '{first_name}'        => esc_html($first_name),
                    '{last_name}'         => esc_html($last_name),
                    '{username}'          => esc_html($username),
                    '{email}'             => esc_html($email),
                    '{phone}'             => esc_html($phone),
                    '{verification_link}' => esc_url($verification_link),
                ];
                $message = str_replace(array_keys($replacements), array_values($replacements), $message);
                $headers = ['Content-Type: text/html; charset=UTF-8'];
                
                if ($email_notification == 1) {
                    if ($send_email === 'yes') {
                        if ( Nextdestina_Global_Functions::is_wp_mail_smtp_configured() ) {
                            wp_mail($email, $subject, $message, $headers);
                        }
                    }
                }
    
                // Redirect to login with pending verification
                wp_safe_redirect(add_query_arg('register', 'pending_verification', home_url('/traveler-login/')));
            } else {
                // Skip verification → mark user as verified
                update_user_meta($user_id, 'email_verified', '1');
    
                // Redirect to login as normal
                wp_safe_redirect(add_query_arg('register', 'success', home_url('/traveler-login/')));
            }
            exit;
        }
    }

	public function maybe_verify_user_email() {
	    
        // Only run if email verification toggle is enabled
        if (get_option('email_verification') != 1) {
            return;
        }
        
		if (
			isset($_GET['nd_verify_email'], $_GET['user_id'], $_GET['token']) &&
			$_GET['nd_verify_email'] === '1'
		) {
			$user_id = absint($_GET['user_id']);
			$token   = sanitize_text_field($_GET['token']);

			$saved_token = get_user_meta($user_id, 'email_verification_token', true);

			if ($token && $saved_token && $token === $saved_token) {
				update_user_meta($user_id, 'email_verified', '1');
				delete_user_meta($user_id, 'email_verification_token');

				wp_redirect(add_query_arg('verify', 'success', site_url('/traveler-login')));
				exit;
			} else {
				wp_redirect(add_query_arg('verify', 'failed', site_url('/traveler-login')));
				exit;
			}
		}
	}
	
    public function block_unverified_users($user, $username, $password) {
        if (is_wp_error($user)) return $user;
        
        // Only apply email verification to 'traveler' role
        if (in_array('traveler', (array) $user->roles)) {
            if (get_option('email_verification') == 1) { // check toggle
                $verified = get_user_meta($user->ID, 'email_verified', true);
                if ($verified !== '1') {
                    return new WP_Error('email_not_verified', __('Please verify your email before logging in.', 'nextdestina-booking'));
                }
            }
        }
        
        return $user;
    }

	/*
	 * User Registration page
	 */

	public function nextdestina_register_endpoint() {
		add_rewrite_rule('^traveler-registration/?$', 'index.php?nextdestina_register_page=1', 'top');
		add_rewrite_tag('%nextdestina_register_page%', '1');
	}
	public function register_query_vars($vars) {
		$vars[] = 'nextdestina_register_page';
		return $vars;
	}
	public function nextdestina_register_virtual_template($template) {
		if (get_query_var('nextdestina_register_page') == '1') {
			return plugin_dir_path(__FILE__) . 'templates/page-registration.php';
		}
		return $template;
	}

	/*
	 * This function is not a callback or don't have any hook
	 * It just a function to get registration URL
	 */
	public static function get_register_url() {
		return home_url('/traveler-registration/');
	}

	/*
	 * Support ticket
	 */

	public function create_ticket_submission_handle() {
	    if (!is_user_logged_in()) {
	        wp_send_json_error(['message' => 'User not logged in.']);
	    }

	    $user_id = get_current_user_id();
	    $subject = isset($_POST['subject']) ? sanitize_text_field($_POST['subject']) : '';
	    $message = isset($_POST['message']) ? sanitize_textarea_field($_POST['message']) : '';

	    if (empty($subject) || empty($message)) {
	        wp_send_json_error(['message' => 'Subject and message are required.']);
	    }

	    require_once ABSPATH . 'wp-admin/includes/file.php';
	    require_once ABSPATH . 'wp-admin/includes/media.php';
	    require_once ABSPATH . 'wp-admin/includes/image.php';

	    $file_ids = [];
	    $attachment_urls = [];

	    // Handle multiple files
	    if (!empty($_FILES['attachment']['name'][0])) {
	        foreach ($_FILES['attachment']['name'] as $key => $value) {
	            if ($_FILES['attachment']['name'][$key]) {
	                // Rebuild file array for media_handle_upload
	                $file = [
	                    'name'     => $_FILES['attachment']['name'][$key],
	                    'type'     => $_FILES['attachment']['type'][$key],
	                    'tmp_name' => $_FILES['attachment']['tmp_name'][$key],
	                    'error'    => $_FILES['attachment']['error'][$key],
	                    'size'     => $_FILES['attachment']['size'][$key]
	                ];

	                $_FILES['single_attachment'] = $file; // Temporary key for upload

	                $upload = media_handle_upload('single_attachment', 0);
	                if ( !is_wp_error($upload) && $upload ) {
	                    $file_ids[] = $upload;
	                    $url = wp_get_attachment_url($upload);
	                    if ($url) {
	                    	$attachment_urls[] = $url;
	                    }
	                }
	            }
	        }
	    }

	    // Create the support ticket post
	    $post_id = wp_insert_post([
	        'post_type'    => 'nd_support_ticket',
	        'post_title'   => $subject,
	        'post_content' => $message,
	        'post_status'  => 'publish',
	        'post_author'  => $user_id,
	    ]);

	    if (!$post_id || is_wp_error($post_id)) {
	        wp_send_json_error(['message' => 'Failed to submit ticket.']);
	    }

	    // Set ticket status
	    update_post_meta($post_id, '_admin_ticket_status', 'open');
	    update_post_meta($post_id, '_user_ticket_status', 'pending');

	    // Save first message in _nd_ticket_replies
	    $replies = [
	        [
	            'user_id'  => $user_id,
	            'message'  => $message,
	            'datetime' => current_time('mysql'),
	            'attachments' => !empty($file_ids) ? $file_ids : [],
	        ]
	    ];
	    update_post_meta($post_id, '_nd_ticket_replies', $replies);

	    // Save attachment IDs array if exists
	    if (!empty($file_ids)) {
	        update_post_meta($post_id, '_ticket_attachments', $file_ids);
	    }

	    // === Email Setup ===
	    
	    $email_notification = get_option('email_notification');
	    
	    $current_user = wp_get_current_user();
	    $admin_email = get_option('admin_email');

	    $admin_posts = get_posts([
	        'post_type' => 'email_template',
	        'title'     => 'admin',
	        'post_status' => 'publish',
	        'posts_per_page' => 1,
	    ]);

	    $template = !empty($admin_posts) ? $admin_posts[0] : null;

	    $send_email = get_post_meta($template->ID, '_support_request_email', true);
	    $admin_subject = $template ? (string) get_post_meta($template->ID, '_admin_ticket_subject', true) : 'New Support Ticket Received';
	    $admin_message = $template ? (string) get_post_meta($template->ID, '_admin_ticket_message', true) : 'A new support ticket has been submitted by {user_name}.<br><br>Subject: {subject}<br>Message:<br>{message}<br><br>Attachments:<br>{attachments}';

	    // Replace placeholders
	    $replacements = [
	        '{user_name}'   => esc_html($current_user->display_name),
	        '{subject}'     => esc_html($subject),
	        '{message}'     => nl2br(esc_html($message)),
	        '{attachments}' => !empty($attachment_urls) ? implode('<br>', array_map('esc_url', $attachment_urls)) : 'No attachments',
	    ];
	    $admin_message = str_replace(array_keys($replacements), array_values($replacements), $admin_message);

	    // Prepare attachments for email
	    $attachments_for_email = [];
	    foreach ($file_ids as $fid) {
	        $file_path = get_attached_file($fid);
	        if (is_string($file_path) && file_exists($file_path)) {
	            $attachments_for_email[] = $file_path;
	        }
	    }

        if ($email_notification == 1) {
            if ($send_email === 'yes') {
                if ( Nextdestina_Global_Functions::is_wp_mail_smtp_configured() ) {
                    wp_mail($admin_email, $admin_subject, $admin_message, ['Content-Type: text/html; charset=UTF-8'], $attachments_for_email);
                }
            }
        }

	    wp_send_json_success(['message' => 'Ticket submitted successfully!']);
	}

	public function user_ticket_reply_handle() {

		$ticket_id = absint($_POST['ticket_id']);
		$message   = sanitize_textarea_field($_POST['reply_message']);
		$user_id   = get_current_user_id();

		if (!$ticket_id || empty($message)) {
			wp_send_json_error(['message' => 'Missing required fields.']);
		}

		$ticket = get_post($ticket_id);
		if (!$ticket || $ticket->post_type !== 'nd_support_ticket') {
			wp_send_json_error(['message' => 'Invalid ticket.']);
		}

		require_once ABSPATH . 'wp-admin/includes/file.php';
		require_once ABSPATH . 'wp-admin/includes/media.php';
		require_once ABSPATH . 'wp-admin/includes/image.php';

		$attachment_urls = [];

		if (!empty($_FILES['reply_attachments']['name']) && is_array($_FILES['reply_attachments']['name'])) {
			$files = $_FILES['reply_attachments'];

			foreach ($files['name'] as $key => $name) {
				if ($files['error'][$key] !== UPLOAD_ERR_OK) {
					continue;
				}

				$file = [
					'name'     => $files['name'][$key],
					'type'     => $files['type'][$key],
					'tmp_name' => $files['tmp_name'][$key],
					'error'    => $files['error'][$key],
					'size'     => $files['size'][$key],
				];

				$_FILES['single_attachment'] = $file;

				$upload = media_handle_upload('single_attachment', 0);
				if (!is_wp_error($upload)) {
					$attachment_urls[] = wp_get_attachment_url($upload);
				}
			}
		}

		$replies = get_post_meta($ticket_id, '_nd_ticket_replies', true);
		if (!is_array($replies)) {
			$replies = [];
		}

		$replies[] = [
			'user_id'    => $user_id,
			'message'    => $message,
			'datetime'   => current_time('mysql'),
			'attachments' => $attachment_urls,
		];

		update_post_meta($ticket_id, '_nd_ticket_replies', $replies);

		$user = get_userdata($user_id);

		update_post_meta($ticket_id, '_admin_ticket_status', 'cutomer reply');

		update_post_meta($ticket_id, '_user_ticket_status', 'pending');

		// Send Mail
		
		$email_notification = get_option('email_notification');

		$current_user = wp_get_current_user();
		$admin_email = get_option('admin_email');

		$admin_posts = get_posts([
			'post_type'      => 'email_template',
			'title'          => 'admin',
			'post_status'    => 'publish',
			'posts_per_page' => 1,
		]);

		$template = !empty($admin_posts) ? $admin_posts[0] : null;

		$user_reply_switch = get_post_meta($template->ID, '_ticket_user_reply_switch', true);
		$subject_template = $template ? get_post_meta($template->ID, '_ticket_user_reply_subject', true) : 'New User Reply';
		$message_template = $template ? get_post_meta($template->ID, '_ticket_user_reply_message', true) : 
		'A new reply has been added by {user_name} to the ticket titled "{ticket_title}".<br><br>Message:<br>{message}<br><br>Attachments:<br>{attachments}';

		$replacements = [
			'{user_name}'    => esc_html($current_user->display_name),
			'{ticket_title}' => esc_html($ticket->post_title),
			'{message}'      => nl2br(esc_html($message)),
			'{attachments}'  => !empty($attachment_urls) ? implode('<br>', array_map('esc_url', $attachment_urls)) : 'No attachments',
		];

		$subject = str_replace(array_keys($replacements), array_values($replacements), $subject_template);
		$email_message = str_replace(array_keys($replacements), array_values($replacements), $message_template);

		$attachments_for_email = [];
		foreach ($attachment_urls as $url) {
			$attachment_id = attachment_url_to_postid($url);
			if ($attachment_id) {
				$file_path = get_attached_file($attachment_id);
				if ($file_path && file_exists($file_path)) {
					$attachments_for_email[] = $file_path;
				}
			}
		}
        
        if ($email_notification == 1) {
            if ($user_reply_switch === 'yes') {
                if ( Nextdestina_Global_Functions::is_wp_mail_smtp_configured() ) {
                    wp_mail($admin_email, $subject, $email_message, ['Content-Type: text/html; charset=UTF-8'], $attachments_for_email);
                }
            }
        }

		ob_start(); ?>
		<div class="message-bubble message-bubble-right">
			<div class="message-thumbs"><?php echo get_avatar($user->ID, 30); ?></div>
			<div class="message-text">
				<?php echo nl2br(esc_html($message)); ?>
				<?php if (!empty($attachment_urls)) : ?>
					<div class="attachments">
						<?php foreach ($attachment_urls as $url) : ?>
							<div class="attachment">
								<a href="<?php echo esc_url($url); ?>" target="_blank"><i class="fa fa-paperclip"></i> <?php esc_html_e('View Attachment', 'nextdestina-booking'); ?></a>
							</div>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
		<?php
		$html = ob_get_clean();

		wp_send_json_success([
			'message' => 'Reply sent successfully!',
			'html'    => $html
		]);
	}

}