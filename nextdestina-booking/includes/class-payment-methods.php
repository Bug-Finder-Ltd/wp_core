<?php

if (!defined('ABSPATH')) exit;

class Nextdestina_Payment_Methods {

	public function __construct() {

		add_action( 'wp_enqueue_scripts', [$this, 'enqueue_payment_assets'], 20 );

		add_action( 'wp_ajax_booking_without_payment', [$this, 'booking_without_payment_handler'] );
		add_action( 'wp_ajax_nopriv_booking_without_payment', [$this, 'booking_without_payment_handler'] );
		
		add_action('wp_ajax_nextdestina_process_manual_payment', [$this, 'nextdestina_process_manual_payment']);
		add_action('wp_ajax_nopriv_nextdestina_process_manual_payment', [$this, 'nextdestina_process_manual_payment']);

		add_action('wp_ajax_nd_get_payment_details', [$this, 'manual_payment_details_modul']);

		add_action('wp_ajax_nd_update_payment_status', [$this, 'update_manual_payment_status']);
	}

	public function enqueue_payment_assets() {

		wp_enqueue_script(
			'payment-script',
			TRAVELER_DASHBOARD_PLUGIN_URL . 'assets/js/payment.js',
			array(),
			TRAVELER_DASHBOARD_VERSION,
			true
		);

        /**
         * Query stripe publishable key meta
         */

        $stripe_query = new WP_Query([
            'post_type'      => 'payment_method',
            'title'          => 'Stripe',
            'post_status'    => 'publish',
            'posts_per_page' => 1,
        ]);

        if (!$stripe_query->have_posts()) {
            return false;
        }

        $stripe_post = $stripe_query->posts[0];
        $post_id = $stripe_post->ID;

        $stripe_publishable_key = get_post_meta($post_id, '_stripe_publishable_key', true);

        // Get Stripe method
        $stripe_method = get_posts([
            'post_type'      => 'payment_method',
            'title'          => 'Stripe',
            'posts_per_page' => 1,
            'post_status'    => 'publish',
        ]);

        $stripe_post_id = !empty($stripe_method) ? $stripe_method[0]->ID : 0;

        $stripe_percentage_charge = $stripe_post_id ? floatval(get_post_meta($stripe_post_id, '_stripe_percentage_charge', true)) : 0;
        $stripe_fixed_charge      = $stripe_post_id ? floatval(get_post_meta($stripe_post_id, '_stripe_fixed_charge', true)) : 0;

        // Get PayPal method
        $paypal_method = get_posts([
            'post_type'      => 'payment_method',
            'title'          => 'PayPal',
            'posts_per_page' => 1,
            'post_status'    => 'publish',
        ]);

        $paypal_post_id = !empty($paypal_method) ? $paypal_method[0]->ID : 0;

        $paypal_percentage_charge = $paypal_post_id ? floatval(get_post_meta($paypal_post_id, '_paypal_percentage_charge', true)) : 0;
        $paypal_fixed_charge      = $paypal_post_id ? floatval(get_post_meta($paypal_post_id, '_paypal_fixed_charge', true)) : 0;

        /**
         * Localize AJAX & Stripe key
         */

        wp_localize_script('payment-script', 'bookingData', [
            'ajax_url' => admin_url('admin-ajax.php'),
            'stripe_key' => $stripe_publishable_key,
            'thank_you_url'=> home_url('/thank-you'),
        ]);

        wp_localize_script('payment-script', 'paymentCharges', [
            'stripe' => [
                'percentage' => $stripe_percentage_charge,
                'fixed'      => $stripe_fixed_charge,
            ],
            'paypal' => [
                'percentage' => $paypal_percentage_charge,
                'fixed'      => $paypal_fixed_charge,
            ]
        ]);

	}

	public function booking_without_payment_handler() {
		// Basic security
		if ( ! isset( $_POST['tour_booking_nonce'] ) || ! wp_verify_nonce( $_POST['tour_booking_nonce'], 'submit_tour_booking' ) ) {
			wp_send_json_error( ['message' => __( 'Security check failed.', 'nextdestina-booking' )] );
		}

		$tour_id        = intval($_POST['tour_id']);
		$travel_date    = sanitize_text_field($_POST['travel_date']);
		$num_travelers  = intval($_POST['num_travelers']);
		$price_per_person      = floatval($_POST['price_per_person']);
		$total_price    = floatval($_POST['total_price']);

		$first_name     = sanitize_text_field($_POST['first_name']);
		$last_name      = sanitize_text_field($_POST['last_name']);
		$email          = sanitize_email($_POST['email']);
		$phone          = sanitize_text_field($_POST['phone']);
		$address_1      = sanitize_text_field($_POST['address_1']);
		$address_2      = sanitize_text_field($_POST['address_2']);
		$city           = sanitize_text_field($_POST['city']);
		$state          = sanitize_text_field($_POST['state']);
		$zip            = sanitize_text_field($_POST['zip']);
		$country        = sanitize_text_field($_POST['country']);
		$message        = sanitize_textarea_field($_POST['message']);

		$travelers = isset($_POST['travelers']) ? $_POST['travelers'] : [];

		$user_id   = get_current_user_id();
		$post_data = array(
			'post_type'   => 'tour_booking',
			'post_status' => 'publish',
			'post_title'  => sprintf( __( 'Booking - %s', 'nextdestina-booking' ), current_time( 'mysql' ) ),
			'post_author' => $user_id ? $user_id : 0,
		);

		// Insert booking post
		$booking_id = wp_insert_post( $post_data );

		if ( is_wp_error( $booking_id ) ) {
			wp_send_json( [
				'success' => false,
				'message' => __( 'Could not create booking.', 'nextdestina-booking' ),
			] );
		}

		if ($booking_id) {
			update_post_meta($booking_id, 'user_id', get_current_user_id());
			update_post_meta($booking_id, 'tour_id', $tour_id);
			update_post_meta($booking_id, 'travel_date', $travel_date);
			update_post_meta($booking_id, 'num_travelers', $num_travelers);
			update_post_meta($booking_id, 'first_name', $first_name);
			update_post_meta($booking_id, 'last_name', $last_name);
			update_post_meta($booking_id, 'email', $email);
			update_post_meta($booking_id, 'phone', $phone);
			update_post_meta($booking_id, 'address_1', $address_1);
			update_post_meta($booking_id, 'address_2', $address_2);
			update_post_meta($booking_id, 'city', $city);
			update_post_meta($booking_id, 'state', $state);
			update_post_meta($booking_id, 'zip', $zip);
			update_post_meta($booking_id, 'country', $country);
			update_post_meta($booking_id, 'message', $message);
			update_post_meta($booking_id, 'price_per_person', $price_per_person);
			update_post_meta($booking_id, 'total_price', $total_price);
			update_post_meta($booking_id, 'travelers', $travelers);
		}

		global $wpdb;
		$payment_history_table = $wpdb->prefix . 'payment_history';

		$wpdb->insert(
			$payment_history_table,
			[
				'booking_id'           => $booking_id,
				'user_id'              => $user_id,
				'transaction_id'       => '',
				'amount_paid'          => $total_price,
				'currency'             => 'USD',
				'payment_status'       => 'not_paid',
				'payment_method'       => 'unavailable',
				'created_at'           => current_time('mysql'),
			],
			[
				'%d','%d','%s','%s','%s','%s','%s','%s'
			]
		);

		// === Email Setup ===
		
		$email_notification = get_option('email_notification');

		$admin_posts = get_posts([
			'post_type'      => 'email_template',
			'title'          => 'admin',
			'posts_per_page' => 1,
			'post_status'    => 'publish',
		]);

		$admin_template = !empty($admin_posts) ? $admin_posts[0] : null;

		$admin_new_booking_switch  = $admin_template ? get_post_meta($admin_template->ID, '_admin_new_booking_switch', true) : '';
		$admin_subject             = $admin_template ? get_post_meta($admin_template->ID, '_admin_email_subject', true) : '';
		$admin_message_raw         = $admin_template ? get_post_meta($admin_template->ID, '_admin_email_message', true) : '';

		if (empty($admin_subject)) {
			$admin_subject = 'New Booking Received';
		}

		if (empty($admin_message_raw)) {
			$admin_message_raw = 'A new booking has been received.<br><br>Booking ID: {booking_id}<br>Customer Email: {customer_email}';
		}

		$replacements = [
			'{booking_id}'     => $booking_id,
			'{customer_email}' => $email,
		];

		$admin_message  = str_replace(array_keys($replacements), array_values($replacements), $admin_message_raw);
		$headers = ['Content-Type: text/html; charset=UTF-8'];
        
        if ($email_notification == 1) {
            if ($admin_new_booking_switch === 'yes') {
                if ( Nextdestina_Global_Functions::is_wp_mail_smtp_configured() ) {
                    wp_mail(get_option('admin_email'), $admin_subject, $admin_message, $headers);
                }
            }
        }

		wp_send_json( [
			'success' => true,
			'booking_id' => $booking_id,
			'message' => __( 'Booking created successfully without payment.', 'nextdestina-booking' ),
		] );
	}

	/**
	 * Generate transaction ID for manual payment
	 */

    public function generate_transaction_id() {
        global $wpdb;

        $prefix = 'BT';
        $date   = date('Ymd');

        do {
            $unique = strtoupper(wp_generate_password(10, false, false));
            $transaction_id = $prefix . '-' . $date . '-' . $unique;

            // Check uniqueness in DB
            $exists = $wpdb->get_var(
                $wpdb->prepare(
                    "SELECT COUNT(*) FROM {$wpdb->prefix}payment_history WHERE transaction_id = %s",
                    $transaction_id
                )
            );
        } while ($exists > 0);

        return $transaction_id;
    }

	/**
	 * Manual payment handler
	 */

	public function nextdestina_process_manual_payment() {
		global $wpdb;
		$payment_history_table = $wpdb->prefix . 'payment_history';

		// Security check
		if ( ! isset($_POST['tour_booking_nonce']) || ! wp_verify_nonce($_POST['tour_booking_nonce'], 'submit_tour_booking') ) {
			wp_send_json_error(['message' => __('Invalid nonce', 'nextdestina-booking')]);
		}

		$tour_id        = intval($_POST['tour_id']);
		$travel_date    = sanitize_text_field($_POST['travel_date']);
		$num_travelers  = intval($_POST['num_travelers']);
		$price_per      = floatval($_POST['price_per_person']);
		$total_price    = floatval($_POST['total_price']);

		$first_name     = sanitize_text_field($_POST['first_name']);
		$last_name      = sanitize_text_field($_POST['last_name']);
		$email          = sanitize_email($_POST['email']);
		$phone          = sanitize_text_field($_POST['phone']);
		$address_1      = sanitize_text_field($_POST['address_1']);
		$address_2      = sanitize_text_field($_POST['address_2']);
		$city           = sanitize_text_field($_POST['city']);
		$state          = sanitize_text_field($_POST['state']);
		$zip            = sanitize_text_field($_POST['zip']);
		$country        = sanitize_text_field($_POST['country']);
		$message        = sanitize_textarea_field($_POST['message']);

		$manual_method  = sanitize_text_field($_POST['manual_method'] ?? 'manual');

		// Travelers
		$travelers = isset($_POST['travelers']) && is_array($_POST['travelers']) ? array_map(function($trav) {
			return [
				'first_name' => sanitize_text_field($trav['first_name'] ?? ''),
				'last_name'  => sanitize_text_field($trav['last_name'] ?? ''),
				'dob'        => sanitize_text_field($trav['dob'] ?? ''),
				'type'       => sanitize_text_field($trav['type'] ?? ''),
			];
		}, $_POST['travelers']) : [];

		$user_id = get_current_user_id();

		// Insert booking post
		$booking_id = wp_insert_post([
			'post_type'   => 'tour_booking',
			'post_title'  => $first_name . ' ' . $last_name . ' - ' . current_time('Y-m-d H:i'),
			'post_status' => 'publish',
			'post_author' => $user_id,
		]);

		if (!$booking_id || is_wp_error($booking_id)) {
			wp_send_json_error(['message' => __('Could not create booking.', 'nextdestina-booking')]);
		}

		// Save post meta
		update_post_meta($booking_id, 'user_id', $user_id);
		update_post_meta($booking_id, 'tour_id', $tour_id);
		update_post_meta($booking_id, 'travel_date', $travel_date);
		update_post_meta($booking_id, 'num_travelers', $num_travelers);
		update_post_meta($booking_id, 'price_per_person', $price_per);
		update_post_meta($booking_id, 'total_price', $total_price);
		update_post_meta($booking_id, 'first_name', $first_name);
		update_post_meta($booking_id, 'last_name', $last_name);
		update_post_meta($booking_id, 'email', $email);
		update_post_meta($booking_id, 'phone', $phone);
		update_post_meta($booking_id, 'address_1', $address_1);
		update_post_meta($booking_id, 'address_2', $address_2);
		update_post_meta($booking_id, 'city', $city);
		update_post_meta($booking_id, 'state', $state);
		update_post_meta($booking_id, 'zip', $zip);
		update_post_meta($booking_id, 'country', $country);
		update_post_meta($booking_id, 'message', $message);
		update_post_meta($booking_id, 'travelers', $travelers);
		update_post_meta($booking_id, 'payment_method', $manual_method);
		update_post_meta($booking_id, 'payment_status', 'pending');

		// Insert payment history with extra manual fields
		
	    $extra_fields_array = $_POST['payment_fields'] ?? [];

	    // Handle uploaded files
	    if (!empty($_FILES['payment_fields'])) {
	        foreach ($_FILES['payment_fields']['name'] as $key => $name) {
	            if ($_FILES['payment_fields']['error'][$key] === UPLOAD_ERR_OK) {
	                $file_tmp  = $_FILES['payment_fields']['tmp_name'][$key];
	                $file_name = sanitize_file_name($_FILES['payment_fields']['name'][$key]);
	                $upload    = wp_upload_bits($file_name, null, file_get_contents($file_tmp));

	                if (!$upload['error']) {
	                    $extra_fields_array[$key] = $upload['url'];
	                }
	            }
	        }
	    }

	    $extra_fields = wp_json_encode($extra_fields_array);

	    $transaction_id = $this->generate_transaction_id();

		$wpdb->insert(
			$payment_history_table,
			[
				'booking_id'           => $booking_id,
				'user_id'              => $user_id,
				'transaction_id'       => $transaction_id,
				'amount_paid'          => $total_price,
				'currency'             => 'USD',
				'payment_status'       => 'pending',
				'payment_method'       => $manual_method,
				'payment_extra_fields' => $extra_fields,
				'created_at'           => current_time('mysql'),
			],
			[
				'%d','%d','%s','%s','%s','%s','%s','%s','%s'
			]
		);

		// === Email Setup ===
		
		$email_notification = get_option('email_notification');

		$admin_posts = get_posts([
			'post_type'      => 'email_template',
			'title'          => 'admin',
			'post_status'    => 'publish',
			'posts_per_page' => 1,
		]);

		$admin_template = !empty($admin_posts) ? $admin_posts[0] : null;

		$admin_new_booking_switch  = $admin_template ? get_post_meta($admin_template->ID, '_admin_new_booking_switch', true) : '';
		$admin_subject             = $admin_template ? get_post_meta($admin_template->ID, '_admin_email_subject', true) : '';
		$admin_message_raw         = $admin_template ? get_post_meta($admin_template->ID, '_admin_email_message', true) : '';

		if (empty($admin_subject)) {
			$admin_subject = 'New Booking Received';
		}

		if (empty($admin_message_raw)) {
			$admin_message_raw = 'A new booking has been received.<br><br>Booking ID: {booking_id}<br>Customer Email: {customer_email}';
		}

		$replacements = [
			'{booking_id}'     => $booking_id,
			'{customer_email}' => $email,
		];

		$admin_message  = str_replace(array_keys($replacements), array_values($replacements), $admin_message_raw);
		$headers = ['Content-Type: text/html; charset=UTF-8'];
        
        if ($email_notification == 1) {
            if ($admin_new_booking_switch === 'yes') {
                if ( Nextdestina_Global_Functions::is_wp_mail_smtp_configured() ) {
                    wp_mail(get_option('admin_email'), $admin_subject, $admin_message, $headers);
                }
            }
        }

		// Final JSON response
		wp_send_json_success([
			'booking_id' => $booking_id,
			'message'    => __('Booking created, pending manual payment.', 'nextdestina-booking')
		]);
	}

	/**
	 * Manual payment POP UP
	 */

	public function manual_payment_details_modul() {
		global $wpdb;

	    $payment_id = intval($_POST['payment_id']);
	    $table_name = $wpdb->prefix . 'payment_history';
	    $payment = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE id=%d", $payment_id), ARRAY_A);

	    if(!$payment){
	        wp_send_json_error();
	    }

		// Decode JSON (assuming your column name is `extra_fields`)
	    $extra_fields = !empty($payment['payment_extra_fields']) ? json_decode($payment['payment_extra_fields'], true) : [];

	    // Build dynamic summary HTML
	    $summary_html = '';
	    if (!empty($extra_fields)) {
	        foreach ($extra_fields as $key => $value) {
	            $label = ucwords(str_replace(['-', '_'], ' ', $key));

	            // If value is a URL (like NID image), show as image
	            if (filter_var($value, FILTER_VALIDATE_URL) && preg_match('/\.(jpg|jpeg|png|gif|webp)$/i', $value)) {
	                $value_html = '<a href="'.esc_url($value).'" target="_blank"><img src="'.esc_url($value).'" style="max-height:60px; border:1px solid #ddd; border-radius:4px;"></a>';
	            } else {
	                $value_html = esc_html($value);
	            }

	            $summary_html .= "<p><strong>{$label}:</strong> {$value_html}</p>";
	        }
	    } else {
	        $summary_html = "<p>No additional details provided.</p>";
	    }

		// Modal HTML
		$html = '
	    <div class="nd-payment-modal">
	        <div class="nd-payment-content">
	            <span class="close-btn">&times;</span>
	            
	            <h2 class="title">Payment Information</h2>
	            
	            <div class="info-grid">
	                <div>
	                    <strong>Amount Paid:</strong>
	                    <p>$'.esc_html(number_format((float)$payment['amount_paid'], 2)).'</p>
	                </div>
	                <div>
	                    <strong>Date Paid:</strong>
	                    <p>'.esc_html(date_i18n('d/m/Y', strtotime($payment['created_at']))).'</p>
	                </div>
	                <div>
	                    <strong>Payment Method:</strong>
	                    <p><span class="method">'.esc_html($payment['payment_method']).'</span></p>
	                </div>
	            </div>
	            
	            <h3 class="subtitle">Summary</h3>
	            <div class="summary-box">
	                '.$summary_html.'
	            </div>
	            
	            <h3 class="subtitle">Send You Feedback</h3>
	            <textarea class="feedback" placeholder="Feedback"></textarea>
	            
	            <div class="modal-actions">
	                <button class="button button-primary approve-btn" data-id="'.esc_attr($payment['id']).'">Approved</button>
	                <button class="button button-secondary reject-btn" data-id="'.esc_attr($payment['id']).'">Rejected</button>
	            </div>
	        </div>
	    </div>';

	    wp_send_json_success(['html' => $html]);
	}

	/**
	 * Manual payment update status
	 */

	public function update_manual_payment_status() {
		global $wpdb;

		$payment_id = intval($_POST['payment_id']);
		$status     = sanitize_text_field($_POST['status']);
		$feedback   = sanitize_textarea_field($_POST['feedback']);

		$table_name = $wpdb->prefix . 'payment_history';

		$allowed_statuses = ['succeeded', 'rejected'];
		if (!in_array($status, $allowed_statuses)) {
			wp_send_json_error(['message' => 'Invalid status']);
		}

		// Fetch existing JSON
		$existing_json = $wpdb->get_var($wpdb->prepare("SELECT payment_extra_fields FROM $table_name WHERE id=%d", $payment_id));
		$extra_fields  = !empty($existing_json) ? json_decode($existing_json, true) : [];

		// Add feedback into JSON
		$extra_fields['admin_feedback'] = $feedback;
		$json_value = wp_json_encode($extra_fields);

		$updated = $wpdb->update(
			$table_name,
			[
				'payment_status'       => $status,
				'payment_extra_fields' => $json_value,
			],
			['id' => $payment_id],
			['%s','%s'],
			['%d']
		);

		// === Email Setup ===
		
		$email_notification = get_option('email_notification');

		$booking_id = $wpdb->get_var( $wpdb->prepare("SELECT booking_id FROM $table_name WHERE id=%d", $payment_id) );
		
		$traveler_email = get_post_meta($booking_id, 'email', true);
        $headers = array('Content-Type: text/html; charset=UTF-8');
        
        if ($email_notification == 1) {
            if ( Nextdestina_Global_Functions::is_wp_mail_smtp_configured() ) {
                wp_mail( $traveler_email, __('Feedback', 'nextdestina-booking'), $feedback, $headers );
            }
        }

		// Generate invoice

		$user_id = $wpdb->get_var(
			$wpdb->prepare("SELECT user_id FROM $table_name WHERE id = %d", $payment_id)
		);
		
		$amount_paid = $wpdb->get_var(
			$wpdb->prepare("SELECT amount_paid FROM $table_name WHERE id = %d", $payment_id)
		);

		if ( $status === 'succeeded' ) {
			wp_insert_post([
				'post_type'   => 'invoice',
				'post_status' => 'publish',
				'post_title'  => 'Invoice for Booking #' . $booking_id,
				'meta_input'  => [
					'_booking_id' => $booking_id,
					'_user_id'    => $user_id,
					'_amount'     => $amount_paid,
					'_invoice_date' => current_time('mysql'),
					'_invoice_status' => 'paid',
					'_invoice_number' => uniqid('INV-'),
				]
			]);
		}

		if ($updated !== false) {
			wp_send_json_success(['message' => 'Payment updated']);
		} else {
			wp_send_json_error(['message' => 'Database update failed']);
		}
	}

}