<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Nextdestina Booking
 * @subpackage nextdestina-booking/admin
 * @author     Bug Finder <atikulislam92@mail.com>
 */

class Nextdestina_Admin {

	public function __construct() {
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_assets' ) );

		add_action( 'admin_menu', array( $this, 'register_admin_menu_page' ) );
		//add_action( 'admin_menu', array($this, 'remove_payment_submenu') );

		add_action('admin_init', [$this, 'register_settings']);

		add_action('init', array($this, 'register_admin_cpt'), 10);
		add_action('add_meta_boxes', array($this, 'add_payment_method_metabox'));
		add_action('save_post', array($this, 'save_payment_method_meta'));

		add_action('save_post', array($this, 'save_email_metabox'));

		add_action('save_post', array($this, 'save_package_metabox'));

		add_action('admin_init', array($this, 'admin_invoice_handler'));
		add_action('admin_init', [$this, 'maybe_handle_bulk_action_redirect']);

		add_filter('manage_payment_method_posts_columns', array($this, 'payment_method_toggle_column'));
		add_action( 'manage_payment_method_posts_custom_column', array($this, 'render_payment_method_column'), 10, 2 );
		add_action( 'wp_ajax_ndb_toggle_payment_method', array($this, 'ndb_toggle_payment_method') );


		add_action('wp_ajax_nd_get_transaction_chart', [$this, 'ajax_get_transaction_chart']);

		add_action('wp_ajax_nd_get_sparkline_data', [$this, 'ajax_get_sparkline_data']);
		add_action('wp_ajax_nopriv_nd_get_sparkline_data', [$this, 'ajax_get_sparkline_data']);

		// Support Ticket

		add_action( 'admin_menu', [$this, 'remove_ticket_publish_metabox'] );

		//add_action('save_post', array($this, 'save_admin_reply_metabox'));
		add_action('save_post', array($this, 'save_ticket_status_metabox'));

		add_filter('manage_nd_support_ticket_posts_columns', [$this, 'nd_add_ticket_status_column']);
		add_action('manage_nd_support_ticket_posts_custom_column', [$this, 'nd_display_ticket_status_column'], 10, 2);

		add_filter('manage_nd_support_ticket_posts_columns', [$this,'nd_add_last_reply_column']);
		add_action('manage_nd_support_ticket_posts_custom_column', [$this, 'nd_show_last_reply_column'], 10, 2);

		add_action('restrict_manage_posts', [$this, 'nd_filter_ticket_by_status']);
		add_action('pre_get_posts', [$this, 'nd_filter_tickets_query_by_status']);

		add_action('wp_ajax_nd_send_ticket_reply', [$this, 'admin_ticket_reply_handler']);

	}

	public function enqueue_admin_assets($hook) {

		global $post;

		global $post_type;

		if (($hook === 'post.php' || $hook === 'post-new.php') && $post_type === 'payment_method' || $hook === 'toplevel_page_nextdestina-settings') {
			wp_enqueue_media();
		}

		switch ( $hook ) {
			case 'toplevel_page_nextdestina-booking':
				wp_enqueue_style(
					'admin-bootstrap',
					TRAVELER_DASHBOARD_PLUGIN_URL . 'admin/assets/css/bootstrap.min.css',
					false,
					TRAVELER_DASHBOARD_VERSION
				);
				wp_enqueue_style(
					'font-awesome',
					TRAVELER_DASHBOARD_PLUGIN_URL . 'assets/css/all.min.css',
					false,
					TRAVELER_DASHBOARD_VERSION
				);
				break;
		}

		wp_enqueue_style(
            'admin-style',
            TRAVELER_DASHBOARD_PLUGIN_URL . 'admin/assets/css/admin-style.css',
            false,
            TRAVELER_DASHBOARD_VERSION
        );

        // JS

        wp_enqueue_script(
            'admin-script',
            TRAVELER_DASHBOARD_PLUGIN_URL . 'admin/assets/js/admin-script.js',
            array(),
            TRAVELER_DASHBOARD_VERSION,
            true
        );

		wp_localize_script('admin-script', 'admin_ajax', [
			'ajax_url' => admin_url('admin-ajax.php'),
			'nonce'    => wp_create_nonce('toggle_payment_method'),
		]);

		// Payment Modal
		wp_enqueue_script(
            'payment-modal',
            TRAVELER_DASHBOARD_PLUGIN_URL . 'admin/assets/js/payment-modal.js',
            array(),
            TRAVELER_DASHBOARD_VERSION,
            true
        );

		$current_user_id = get_current_user_id();
		$avatar_url = get_avatar_url($current_user_id, ['size' => 30]);

		if ($hook === 'post.php' && $post && $post->post_type === 'nd_support_ticket') {
			wp_enqueue_script(
				'admin-ticket-reply',
				TRAVELER_DASHBOARD_PLUGIN_URL . 'admin/assets/js/admin-ticket-reply.js',
				array(),
				TRAVELER_DASHBOARD_VERSION,
				true
			);

			wp_localize_script('admin-ticket-reply', 'nd_ticket_vars', array(
				'ajax_url'  => admin_url('admin-ajax.php'),
				'nonce'     => wp_create_nonce('nd_ticket_reply_nonce'),
				'ticket_id' => $post->ID,
				'current_user_avatar' => $avatar_url,
			));

		}

		wp_enqueue_script('chart-js', 'https://cdn.jsdelivr.net/npm/chart.js', [], null, true);

		wp_enqueue_script(
            'nd-admin-dashboard',
            TRAVELER_DASHBOARD_PLUGIN_URL . 'admin/assets/js/admin-dashboard.js',
            ['jquery'],
            TRAVELER_DASHBOARD_VERSION,
            true
        );
		wp_localize_script('nd-admin-dashboard', 'ndChartData', [
	        'ajaxurl' => admin_url('admin-ajax.php'),
	    ]);

	    if ( ( $hook == 'post-new.php' || $hook == 'post.php' ) && $post_type === 'tour' ) {
	        wp_enqueue_media();
	        wp_enqueue_script(
	        	'tour-gallery-script',
	        	TRAVELER_DASHBOARD_PLUGIN_URL . 'admin/assets/js/tour-gallery.js',
	        	['jquery'],
	        	'1.0',
	        	true
	        );
	    }

	}

	/**
     * Admin Menu page
     */

    public function register_admin_menu_page() {
    	add_menu_page(
            'Nextdestina Booking',
            'Nextdestina Booking',
            'manage_options',
            'nextdestina-booking',
            array( $this, 'nextdestina_booking_dashboard' ),
            'dashicons-tickets-alt',
            6
        );
        add_submenu_page(
        	'nextdestina-booking',
        	'Dashboard',
        	'Dashboard',
        	'manage_options',
        	'nextdestina-booking',
        	array( $this, 'nextdestina_booking_dashboard' ),
        );
        add_submenu_page(
            'nextdestina-booking',
            __('Booking History', 'nextdestina-booking'),
            __('Booking History', 'nextdestina-booking'),
            'manage_options',
            'booking-history',
            array( $this, 'render_custom_booking_dashboard' )
        );
        add_submenu_page(
            'nextdestina-booking',
            __('Payment Logs', 'nextdestina-booking'),
            __('Payment Logs', 'nextdestina-booking'),
            'manage_options',
            'payment-logs',
            array( $this, 'render_payment_log_page' ),
        );
        add_submenu_page(
            'nextdestina-booking',
            'Payment Methods',
            'Payment Methods',
            'manage_options',
            'edit.php?post_type=payment_method'
        );
        add_submenu_page(
            'nextdestina-booking',
            'Email Template',
            'Email Template',
            'manage_options',
            'edit.php?post_type=email_template'
        );
        add_submenu_page(
            'nextdestina-booking',
            __('Tour Ratings', 'nextdestina-booking'),
            __('Ratings', 'nextdestina-booking'),
            'manage_options',
            'tour-ratings',
            array( $this, 'render_ratings_page' )
        );
        add_submenu_page(
            'nextdestina-booking',
            __('Settings', 'nextdestina-booking'),
            __('Settings', 'nextdestina-booking'),
            'manage_options',
            'nextdestina-settings',
            array( $this, 'render_settings_page' )
        );
        add_submenu_page(
            'nextdestina-booking',
            'Support Tickets',
            'Support Tickets',
            'manage_options',
            'edit.php?post_type=nd_support_ticket'
        );
    }

	/**
	 * Admin dashboard page callback
	 */

	public function nextdestina_booking_dashboard() {
		global $wpdb;
		$payment_history_table = $wpdb->prefix . 'payment_history';

		// Total transaction
		$total_amount_paid = (int) $wpdb->get_var(
			"SELECT SUM(amount_paid) FROM {$payment_history_table} WHERE payment_status = 'succeeded'"
		);
		$total_amount_paid = $total_amount_paid ?: 0.00;

		// This month transaction
		$start_of_month = date('Y-m-01 00:00:00');
		$end_of_month   = date('Y-m-t 23:59:59');

		$this_month_amount_paid = (int) $wpdb->get_var(
			$wpdb->prepare(
				"SELECT SUM(amount_paid) FROM {$payment_history_table} 
				 WHERE payment_status = 'succeeded' AND created_at BETWEEN %s AND %s",
				$start_of_month,
				$end_of_month
			)
		);
		$this_month_amount_paid = $this_month_amount_paid ?: 0.00;

		// Total travelers
		$total_users = count_users();
		$total_travelers = isset($total_users['avail_roles']['traveler']) ? $total_users['avail_roles']['traveler'] : 0;

		// Total bookings
		$args = array(
			'post_type'      => 'tour_booking',
			'posts_per_page' => -1,
			'post_status'    => 'publish',
			'meta_query' => [
				[
					'key'   => 'booking_status',
					'value' => 'confirmed',
				],
			],
			'fields'         => 'ids',
		);
		$query = new WP_Query($args);
		$total_bookings = $query->post_count;

		// Date ranges
		$start_of_this_month = date('Y-m-01 00:00:00');
		$end_of_this_month   = date('Y-m-t 23:59:59');

		$start_of_last_month = date('Y-m-01 00:00:00', strtotime('first day of last month'));
		$end_of_last_month   = date('Y-m-t 23:59:59', strtotime('last day of last month'));

		// Top tours
		$top_tours_this_month = $wpdb->get_results(
			$wpdb->prepare(
				"SELECT meta_value as tour_id, COUNT(*) as bookings_count
				 FROM {$wpdb->prefix}postmeta pm
				 INNER JOIN {$wpdb->prefix}posts p ON p.ID = pm.post_id
				 WHERE pm.meta_key = 'tour_id'
				   AND p.post_type = 'tour_booking'
				   AND p.post_status = 'publish'
				   AND p.post_date BETWEEN %s AND %s
				 GROUP BY meta_value
				 ORDER BY bookings_count DESC
				 LIMIT 5",
				$start_of_this_month,
				$end_of_this_month
			)
		);

		$top_tours_last_month = $wpdb->get_results(
			$wpdb->prepare(
				"SELECT meta_value as tour_id, COUNT(*) as bookings_count
				 FROM {$wpdb->prefix}postmeta pm
				 INNER JOIN {$wpdb->prefix}posts p ON p.ID = pm.post_id
				 WHERE pm.meta_key = 'tour_id'
				   AND p.post_type = 'tour_booking'
				   AND p.post_status = 'publish'
				   AND p.post_date BETWEEN %s AND %s
				 GROUP BY meta_value
				 ORDER BY bookings_count DESC
				 LIMIT 5",
				$start_of_last_month,
				$end_of_last_month
			)
		);

		// Top destinations
		$top_dest_this_month = $wpdb->get_results(
			$wpdb->prepare("
				SELECT tt.term_id, t.name, COUNT(*) as booking_count
				FROM {$wpdb->prefix}postmeta pm
				JOIN {$wpdb->prefix}posts p ON p.ID = pm.post_id
				JOIN {$wpdb->prefix}term_relationships tr ON tr.object_id = pm.meta_value
				JOIN {$wpdb->prefix}term_taxonomy tt ON tr.term_taxonomy_id = tt.term_taxonomy_id
				JOIN {$wpdb->prefix}terms t ON tt.term_id = t.term_id
				WHERE pm.meta_key = 'tour_id'
				  AND p.post_type = 'tour_booking'
				  AND p.post_status = 'publish'
				  AND tt.taxonomy = 'destination'
				  AND p.post_date BETWEEN %s AND %s
				GROUP BY tt.term_id
				ORDER BY booking_count DESC
				LIMIT 5
			", $start_of_this_month, $end_of_this_month)
		);

		$top_dest_last_month = $wpdb->get_results(
			$wpdb->prepare("
				SELECT tt.term_id, t.name, COUNT(*) as booking_count
				FROM {$wpdb->prefix}postmeta pm
				JOIN {$wpdb->prefix}posts p ON p.ID = pm.post_id
				JOIN {$wpdb->prefix}term_relationships tr ON tr.object_id = pm.meta_value
				JOIN {$wpdb->prefix}term_taxonomy tt ON tr.term_taxonomy_id = tt.term_taxonomy_id
				JOIN {$wpdb->prefix}terms t ON tt.term_id = t.term_id
				WHERE pm.meta_key = 'tour_id'
				  AND p.post_type = 'tour_booking'
				  AND p.post_status = 'publish'
				  AND tt.taxonomy = 'destination'
				  AND p.post_date BETWEEN %s AND %s
				GROUP BY tt.term_id
				ORDER BY booking_count DESC
				LIMIT 5
			", $start_of_last_month, $end_of_last_month)
		);

		?>

		<div class="nd-dashboard-wrap">
			<div class="page-header">
				<h1 class="page-title"><?php esc_html_e('Dashboard', 'nextdestina-booking'); ?></h1>
			</div>

			<!-- Top Stats -->
			<div class="row">
				<div class="col-lg-7">
					<div class="nd-db-card">
						<div class="nd-chart-header">
							<h3 class="card-title"><?php esc_html_e('Transaction', 'nextdestina-booking'); ?></h3>
							<div id="nd-chart-months">
								<button class="active" data-month="current"><?php esc_html_e('This Month', 'nextdestina-booking'); ?></button>
								<button data-month="last"><?php esc_html_e('Last Month', 'nextdestina-booking'); ?></button>
							</div>
						</div>
						<div class="nd-chart-body">
							<p class="deposit"><?php esc_html_e('Payments Received:', 'nextdestina-booking'); ?> <span id="nd-total-deposit"><?php esc_html_e('$0.00', 'nextdestina-booking'); ?></span></p>
							<canvas id="nd-transaction-chart" height="100"></canvas>
						</div>
					</div>
				</div>
				<div class="col-lg-5">
					<div class="nd-card-grid" id="nd-dashboard-stats">
						<!-- Stats Cards -->
						<div class="nd-card"><i class="fa-light fa-user"></i><h6 class="title"><?php esc_html_e('Total Travelers:', 'nextdestina-booking'); ?></h6><span class="number"><?php echo esc_html($total_travelers); ?></span></div>
						<div class="nd-card"><i class="fa-light fa-plane"></i><h6 class="title"><?php esc_html_e('Confirmed Bookings:', 'nextdestina-booking'); ?></h6><span class="number"><?php echo esc_html($total_bookings); ?></span></div>
						<div class="nd-card"><i class="fa-light fa-credit-card"></i><h6 class="title"><?php esc_html_e('This Month Transactions:', 'nextdestina-booking'); ?></h6><span class="number"><?php esc_html_e('$', 'nextdestina-booking'); ?><?php echo esc_html($this_month_amount_paid); ?></span></div>
						<div class="nd-card"><i class="fa-light fa-credit-card"></i><h6 class="title"><?php esc_html_e('Total Transactions:', 'nextdestina-booking'); ?></h6><span class="number"><?php esc_html_e('$', 'nextdestina-booking'); ?><?php echo esc_html($total_amount_paid); ?></span></div>
					</div>
				</div>
			</div>

			<!-- Top Destinations & Tours -->
			<div class="row">
				<div class="col-lg-6">
					<div class="nd-db-card">
						<div class="nd-chart-header">
							<h3 class="card-title"><?php esc_html_e('Top Destination', 'nextdestina-booking'); ?></h3>
							<div id="nd-destination-months">
								<button class="active" data-month="current"><?php esc_html_e('This Month', 'nextdestina-booking'); ?></button>
								<button data-month="last"><?php esc_html_e('Last Month', 'nextdestina-booking'); ?></button>
							</div>
						</div>
						<div class="nd-chart-body">
							<ul class="nd-top-destinations nd-top-dest-this-month">
							    <?php if( !empty($top_dest_this_month) ) : ?>
                                    <?php foreach ($top_dest_this_month as $dest):
                                        $link = get_term_link((int) $dest->term_id, 'destination'); ?>
                                        <li>
                                            <a href="<?php echo esc_url($link); ?>" target="_blank"><?php echo esc_html($dest->name); ?></a>
                                            (<?php echo intval($dest->booking_count); ?>)
                                        </li>
                                    <?php endforeach; ?>
								<?php else: ?>
								    <li><?php esc_html_e("Currently, there are no top destinations available.", "nextdestina-booking"); ?></li>
								<?php endif; ?>
							</ul>
							<ul class="nd-top-destinations nd-top-dest-last-month" style="display:none;">
							    <?php if( !empty($top_dest_last_month) ) : ?>
                                    <?php foreach ($top_dest_last_month as $dest):
                                        $link = get_term_link((int) $dest->term_id, 'destination'); ?>
                                        <li>
                                            <a href="<?php echo esc_url($link); ?>" target="_blank"><?php echo esc_html($dest->name); ?></a>
                                            (<?php echo intval($dest->booking_count); ?>)
                                        </li>
                                    <?php endforeach; ?>
								<?php else: ?>
                                    <li><?php esc_html_e("There are no top destinations available.", "nextdestina-booking"); ?></li>
								<?php endif; ?>
							</ul>
						</div>
					</div>
				</div>

				<div class="col-lg-6">
					<div class="nd-db-card">
						<div class="nd-chart-header">
							<h3 class="card-title"><?php esc_html_e('Top Packages', 'nextdestina-booking'); ?></h3>
							<div id="nd-packages-months">
								<button class="active" data-month="current"><?php esc_html_e('This Month', 'nextdestina-booking'); ?></button>
								<button data-month="last"><?php esc_html_e('Last Month', 'nextdestina-booking'); ?></button>
							</div>
						</div>
						<div class="nd-chart-body">
							<ul class="nd-top-tours nd-top-tours-this-month">
                                <?php if( !empty($top_tours_this_month) ) : ?>
                                    <?php foreach ($top_tours_this_month as $tour):
                                        $tour_id = $tour->tour_id;
                                        $tour_title = get_the_title($tour_id);
                                        $tour_link = get_permalink($tour_id);
                                        $tour_image = get_the_post_thumbnail_url($tour_id, 'thumbnail');
                                    ?>
                                        <li><a href="<?php echo esc_url($tour_link); ?>" target="_blank"><img src="<?php echo esc_url($tour_image); ?>" alt="<?php echo esc_attr($tour_title); ?>"><?php echo esc_html($tour_title); ?></a> (<?php echo intval($tour->bookings_count); ?>)</li>
                                    <?php endforeach; ?>
								<?php else: ?>
                                    <li><?php esc_html_e("Currently, there are no top packages available.", "nextdestina-booking"); ?></li>
								<?php endif; ?>
							</ul>
							<ul class="nd-top-tours nd-top-tours-last-month" style="display:none;">
                                <?php if( !empty($top_tours_last_month) ) : ?>
                                    <?php foreach ($top_tours_last_month as $tour):
                                        $tour_id = $tour->tour_id;
                                        $tour_title = get_the_title($tour_id);
                                        $tour_link = get_permalink($tour_id);
                                        $tour_image = get_the_post_thumbnail_url($tour_id, 'thumbnail');
                                    ?>
                                        <li><a href="<?php echo esc_url($tour_link); ?>" target="_blank"><img src="<?php echo esc_url($tour_image); ?>" alt="<?php echo esc_attr($tour_title); ?>"><?php echo esc_html($tour_title); ?></a> (<?php echo intval($tour->bookings_count); ?>)</li>
                                    <?php endforeach; ?>
								<?php else: ?>
                                    <li><?php esc_html_e("There are no top packages available.", "nextdestina-booking"); ?></li>
								<?php endif; ?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		<?php
	}

	public function ajax_get_transaction_chart() {
	    global $wpdb;
	    $table = $wpdb->prefix . 'payment_history';

	    $month = sanitize_text_field($_POST['month'] ?? 'current');
	    $start = $month === 'last'
	        ? date('Y-m-01 00:00:00', strtotime('first day of last month'))
	        : date('Y-m-01 00:00:00');
	    $end   = $month === 'last'
	        ? date('Y-m-t 23:59:59', strtotime('last day of last month'))
	        : date('Y-m-t 23:59:59');

	    $days = [];
	    $totals = [];

	    $totalDays = date('t', strtotime($start));
	    for ($i = 1; $i <= $totalDays; $i++) {
	        $key = str_pad($i, 2, '0', STR_PAD_LEFT);
	        $days[] = "Day $key";
	        $totals[$key] = 0;
	    }

	    $results = $wpdb->get_results(
	        $wpdb->prepare("
	            SELECT DATE_FORMAT(created_at, '%%d') as day, SUM(amount_paid) as total
	            FROM $table
	            WHERE payment_status = 'succeeded'
	            AND created_at BETWEEN %s AND %s
	            GROUP BY day
	        ", $start, $end)
	    );

	    $total_amount = 0;
	    foreach ($results as $row) {
	        $totals[$row->day] = (float) $row->total;
	        $total_amount += (float) $row->total;
	    }

	    wp_send_json([
	        'total' => number_format($total_amount, 2),
	        'labels' => $days,
	        'data' => array_values($totals),
	    ]);
	}

    /**
     * Ratings submenu page callback
     */

    public function render_ratings_page() {
        
        if (!class_exists('Nextdestina_Tour_Ratings_List_Table')) {
            require_once TRAVELER_DASHBOARD_PLUGIN_DIR . 'admin/partials/class-ratings-list.php';
        }
        
        echo '<div class="wrap"><h1>' . esc_html__( 'Tour Ratings', 'nextdestina-booking' ) . '</h1>';
        
        $ratingsTable = new Nextdestina_Tour_Ratings_List_Table();
        $ratingsTable->prepare_items();
        
        echo '<form method="post">';
        $ratingsTable->display();
        echo '</form>';
        
        echo '</div>';
        
    }

	public function admin_invoice_handler () {
	    if (
	        isset($_GET['page'], $_GET['action'], $_GET['booking_id']) &&
	        $_GET['page'] === 'booking-history' &&
	        $_GET['action'] === 'download_invoice' &&
	        current_user_can('manage_options')
	    ) {
	        $booking_id = absint($_GET['booking_id']);

			if ( class_exists( 'Traveler_Dashboard' ) ) {
				$instance = Traveler_Dashboard::get_instance();
				$invoice_id = $instance->global_functions->get_invoice_id_by_booking_id($booking_id);
			}

	        if ($invoice_id) {
	            require_once TRAVELER_DASHBOARD_PLUGIN_DIR . 'includes/class-invoice-pdf.php';
	            
	            // Prevent any output before PDF
	            if (ob_get_length()) {
	                ob_end_clean();
	            }

	            Nextdestina_Invoice_PDF::render_invoice_pdf($invoice_id);
	            exit;
	        } else {
	            wp_die('Invoice not found.');
	        }
	    }
	}

	public function maybe_handle_bulk_action_redirect() {
	    if (
	        isset($_GET['page']) && $_GET['page'] === 'custom-tour-bookings' &&
	        isset($_POST['action']) && $_POST['action'] !== '-1'
	    ) {
	        // Prevent double action
	        $action = sanitize_text_field($_POST['action']);
	        $ids    = isset($_POST['booking_ids']) ? array_map('intval', $_POST['booking_ids']) : [];

	        foreach ($ids as $id) {
	            switch ($action) {
	                case 'confirm':
	                    update_post_meta($id, 'booking_status', 'confirmed');
	                    break;
	                case 'cancel':
	                    update_post_meta($id, 'booking_status', 'cancelled');
	                    break;
	                case 'delete':
	                    wp_delete_post($id, true);
	                    break;
	            }
	        }

	        // Safe redirect (before headers sent!)
	        wp_redirect(admin_url('admin.php?page=custom-tour-bookings&bulk_done=' . $action));
	        exit;
	    }
	}

	public function render_custom_booking_dashboard() {
	    if (!class_exists('ND_Booking_Log_Table')) {
	        require_once TRAVELER_DASHBOARD_PLUGIN_DIR . 'admin/partials/class-booking-log.php';
	    }
	    
	    $table = new ND_Booking_Log_Table();
	    
	    // Process bulk actions BEFORE any output
	    $table->process_bulk_action();
	    
	    // Start output buffering AFTER bulk action processing
	    ob_start();
	    
	    // Admin notice
	    if (isset($_GET['bulk_done'])) {
	        $action = sanitize_text_field($_GET['bulk_done']);
	        $count  = intval($_GET['count'] ?? 0);
	        echo '<div class="updated notice is-dismissible"><p>' .
	             esc_html(ucfirst($action)) . " action applied successfully on {$count} booking(s)." .
	             '</p></div>';
	    }
	    
	    // Single booking view
	    if (isset($_GET['view_booking'])) {
	        $id = intval($_GET['view_booking']);
	        $booking = get_post($id);
	        if ($booking && $booking->post_type === 'tour_booking') {
	            echo '<div class="wrap"><h1>' . sprintf(esc_html__('Booking Details (#%d)', 'nextdestina-booking'), $id) . '</h1>';
	            $fields = ['tour_id','first_name','last_name','email','phone','address_1','address_2','city','state','zip','country','message','travel_date','num_travelers','price_per_person','total_price','booking_status'];
	            echo '<table class="widefat fixed striped">';
	            foreach ($fields as $field) {
	                $value = get_post_meta($id, $field, true);
	                $label = ucwords(str_replace('_',' ',$field));
	                if ($field==='tour_id' && $value) $value = get_the_title($value);
	                echo "<tr><th>{$label}</th><td>" . esc_html($value) . "</td></tr>";
	            }
	            $travelers = get_post_meta($id,'travelers',true);
	            if (!empty($travelers)) {
	                echo '<tr><th>' . esc_html__('Travelers','nextdestina-booking') . '</th><td><ul>';
	                foreach($travelers as $t) echo '<li>' . esc_html($t['first_name'].' '.$t['last_name']) . ' (DOB: ' . esc_html($t['dob']) . ')</li>';
	                echo '</ul></td></tr>';
	            }
	            echo '</table>';
	            echo '<p><a href="'.esc_url(admin_url('admin.php?page=booking-history')).'" class="button">← Back to All Bookings</a></p></div>';
	            ob_end_flush();
	            return;
	        }
	    }
	    
	    // All bookings list table
	    echo '<div class="wrap"><h1>' . esc_html__('All Tour Bookings','nextdestina-booking') . '</h1>';
	    $table->prepare_items();
	    ?>
	    <form method="get" style="margin-bottom:15px;">
	        <input type="hidden" name="page" value="<?php echo esc_attr($_REQUEST['page']); ?>">
	        <?php $table->search_box(__('Search Bookings','nextdestina-booking'),'booking'); ?>
	        <label for="from_date">From:</label>
	        <input type="date" id="from_date" name="from_date" value="<?php echo esc_attr($_GET['from_date'] ?? ''); ?>">
	        <label for="to_date">To:</label>
	        <input type="date" id="to_date" name="to_date" value="<?php echo esc_attr($_GET['to_date'] ?? ''); ?>">
	        <input type="submit" class="button" value="<?php esc_attr_e('Filter','nextdestina-booking'); ?>">
	    </form>
	    <form method="post">
	        <input type="hidden" name="page" value="<?php echo esc_attr($_REQUEST['page']); ?>">
	        <input type="hidden" name="from_date" value="<?php echo esc_attr($_GET['from_date'] ?? ''); ?>">
	        <input type="hidden" name="to_date" value="<?php echo esc_attr($_GET['to_date'] ?? ''); ?>">
	        <input type="hidden" name="s" value="<?php echo esc_attr($_GET['s'] ?? ''); ?>">
	        <?php $table->display(); ?>
	    </form>
	    <?php
	    echo '</div>';
	    ob_end_flush();
	}

    /**
     * Payment log callback
     */

	public function render_payment_log_page() {
	    if (!class_exists('ND_Payment_Log_Table')) {
	        require_once TRAVELER_DASHBOARD_PLUGIN_DIR . 'admin/partials/class-payment-log.php';
	    }

	    $payment_table = new ND_Payment_Log_Table();
	    $payment_table->process_bulk_action();
	    $payment_table->prepare_items();

	    echo '<div class="wrap">';
	    echo '<h1 class="wp-heading-inline">' . esc_html__('Payment Logs', 'nextdestina-booking') . '</h1>';

	    // Date Filter Form
	    echo '<form method="get">';
	    echo '<input type="hidden" name="page" value="' . esc_attr($_REQUEST['page']) . '" />';
	    echo '<label>' . __('From:', 'nextdestina-booking') . ' <input type="date" name="from_date" value="' . esc_attr($_GET['from_date'] ?? '') . '"></label> ';
	    echo '<label>' . __('To:', 'nextdestina-booking') . ' <input type="date" name="to_date" value="' . esc_attr($_GET['to_date'] ?? '') . '"></label> ';
	    submit_button(__('Filter'), '', 'filter_action', false);
	    $payment_table->search_box(__('Search Payments', 'nextdestina-booking'), 'payment');
	    echo '</form>';

	    // Table output
	    echo '<form method="post">';
	    echo '<input type="hidden" name="page" value="' . esc_attr($_REQUEST['page']) . '" />';
	    $payment_table->display();
	    echo '</form>';
	    echo '</div>';
	}


    /**
	 * Settings page
	 */

	public function register_settings() {
		// Invoice Settings
		register_setting('nextdestina_invoice', 'invoice_logo');
		register_setting('nextdestina_invoice', 'invoice_address');
		register_setting('nextdestina_invoice', 'invoice_phone_number');
		
		// Email
		register_setting('nextdestina_email', 'email_notification');
		register_setting('nextdestina_email', 'email_verification');
        
        // Style Settings
        register_setting('nextdestina_style', 'primary_color');
	}

    public function render_settings_page() {
        $active_tab = $_GET['tab'] ?? 'invoice';
        ?>
        <div class="wrap">
            <h1>Plugin Settings</h1>
            <h2 class="nav-tab-wrapper">
                <a href="?page=nextdestina-settings&tab=invoice" class="nav-tab <?= $active_tab === 'invoice' ? 'nav-tab-active' : '' ?>"><?php esc_html_e('Invoice', 'nextdestina-booking'); ?></a>
                <a href="?page=nextdestina-settings&tab=email" class="nav-tab <?= $active_tab === 'email' ? 'nav-tab-active' : '' ?>"><?php esc_html_e('Email', 'nextdestina-booking'); ?></a>
                <a href="?page=nextdestina-settings&tab=style" class="nav-tab <?= $active_tab === 'style' ? 'nav-tab-active' : '' ?>"><?php esc_html_e('Style', 'nextdestina-booking'); ?></a>
            </h2>

            <form method="post" action="options.php">
                <?php
                if ($active_tab === 'invoice') {
                    settings_fields('nextdestina_invoice');
                    do_settings_sections('nextdestina_invoice');
                    ?>
                    <table class="form-table">
                        <tr>
                            <th scope="row"><?php esc_html_e('Logo', 'nextdestina-booking'); ?></th>
                            <td>
								<img id="invoice_logo_preview" src="<?= esc_url(get_option('invoice_logo')) ?>" style="max-width: 200px; display: <?= get_option('invoice_logo') ? 'block' : 'none' ?>; margin-bottom: 10px;">
								<input type="hidden" id="invoice_logo" name="invoice_logo" value="<?= esc_attr(get_option('invoice_logo')) ?>" />
								<button type="button" class="button" id="upload_image_button"><?php esc_html_e('Upload Image', 'nextdestina-booking'); ?></button>
								<button type="button" class="button" id="remove_image_button"><?php esc_html_e('Remove', 'nextdestina-booking'); ?></button>
                            </td>
                        </tr>
                        <tr>
                        	<th scope="row"><?php esc_html_e('Address', 'nextdestina-booking'); ?></th>
                            <td>
                            	<input type="text" name="invoice_address" value="<?= esc_attr(get_option('invoice_address')) ?>" />
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?php esc_html_e('Phone Number', 'nextdestina-booking'); ?></th>
                            <td>
                            	<input type="text" name="invoice_phone_number" value="<?= esc_attr(get_option('invoice_phone_number')) ?>" />
                            </td>
                        </tr>
                    </table>
                    <?php
                } elseif ($active_tab === 'email') {
                    settings_fields('nextdestina_email');
                    do_settings_sections('nextdestina_email');
                    ?>
                    <table class="form-table">
                        <tr>
                            <th scope="row"><?php esc_html_e('Email Notification', 'nextdestina-booking'); ?></th>
                            <td>
                                <label class="switch-toggle">
                                    <input type="checkbox" name="email_notification" value="1" <?= checked(1, get_option('email_notification'), false); ?> />
                                    <span class="slider"></span>
                                </label>
                                <p class="description">
                                    <?php esc_html_e('If you want to request the user to enable email notifications through a direct message.', 'nextdestina-booking'); ?>
                                </p>
                            </td>
                        </tr>

                        <tr>
                            <th scope="row"><?php esc_html_e('Email Verification', 'nextdestina-booking'); ?></th>
                            <td>
                                <label class="switch-toggle">
                                    <input type="checkbox" name="email_verification" value="1" <?= checked(1, get_option('email_verification'), false); ?> />
                                    <span class="slider"></span>
                                </label>
                                <p class="description">
                                    <?php esc_html_e('If you\'re referring to sending an email for verification during user registration or account setup.', 'nextdestina-booking'); ?>
                                </p>
                            </td>
                        </tr>
                    </table>
                    <?php
                } elseif ($active_tab === 'style') {
                    settings_fields('nextdestina_style');
                    do_settings_sections('nextdestina_style');
                    ?>
                    	<table class="form-table">
                    		<tr>
                    			<th scope="row"><?php esc_html_e('Primary Color', 'nextdestina-booking'); ?></th>
                    			<td><input type="text" name="primary_color" value="<?= esc_attr(get_option('primary_color', '#ff6600')) ?>" id="my-color-field" /></td>
                    			
                    		</tr>
                    	</table>
                    <?php
                }
                submit_button();
                ?>
            </form>
        </div>
        <?php
    }

	public function register_admin_cpt() {

		/**
		 * Register "Payment Settings" custom post type
		 */

		$payment_labels = [
			'name'           => __('Payment Methods', 'nextdestina-booking'),
			'singular_name'  => __('Payment Method', 'nextdestina-booking'),
			'add_new_item'   => __('Add Method', 'nextdestina-booking'),
			'add_new'        => __('Add Method', 'nextdestina-booking'),
			'new_item'       => __('New Method', 'nextdestina-booking'),
		];

		$payment_args = [
			'labels'             => $payment_labels,
			'public'             => false,
			'show_ui'            => true,
			'show_in_menu'       => false, // Show it manually if needed
			'menu_icon'          => 'dashicons-cart',
			'supports'           => ['title'],
			'can_export'         => false,
			'capability_type'    => 'post',
			//'capabilities' => ['create_posts' => false],
			'map_meta_cap'       => true,
		];

		register_post_type('payment_method', $payment_args);

		/**
		 * Register "Email Template" custom post type
		 */

		$email_labels = [
			'name'           => __('Email Templates', 'nextdestina-booking'),
			'singular_name'  => __('Email Template', 'nextdestina-booking'),
			'add_new_item'   => __('Add Template', 'nextdestina-booking'),
			'add_new'        => __('Add Template', 'nextdestina-booking'),
			'new_item'       => __('New Template', 'nextdestina-booking'),
		];

		$email_args = [
			'labels'             => $email_labels,
			'public'             => false,
			'show_ui'            => true,
			'show_in_menu'       => false,
			'menu_icon'          => 'dashicons-email-alt',
			'supports'           => ['title'],
			'can_export'         => false,
			'capability_type'    => 'post',
			'capabilities' => ['create_posts' => false],
			'map_meta_cap'       => true,
		];

		register_post_type('email_template', $email_args);

        $ticket_labels = [
            'name' => 'Support Tickets',
            'singular_name' => 'Ticket',
            'add_new_item' => 'Add Ticket',
            'add_new' => 'Add Ticket',
            'edit_item' => 'Edit Ticket',
            'menu_name' => 'Support Tickets',
            'not_found' => 'No tickets found',
        ];

        register_post_type('nd_support_ticket', [
            'labels' => $ticket_labels,
            'public' => false,
            'show_ui' => true,
            'show_in_menu'       => false,
            'has_archive' => false,
            'supports' => ['title'],
            'can_export'         => false,
            'capability_type' => 'post',
            'capabilities' => ['create_posts' => false],
            'menu_icon' => 'dashicons-sos'
        ]);

	}

	public function add_payment_method_metabox() {
		add_meta_box(
			'payment_method_settings',
			__('Payment Settings', 'nextdestina-booking'),
			array($this, 'render_payment_method_metabox'),
			'payment_method',
			'normal',
			'default'
		);

		add_meta_box(
			'email_template_settings',
			__('Email Template', 'nextdestina-booking'),
			array($this, 'render_email_template_metabox'),
			'email_template',
			'normal',
			'default'
		);

		add_meta_box(
			'package_settings',
			__('Packages Setings', 'nextdestina-booking'),
			array($this, 'render_packages_metabox'),
			'tour',
			'normal',
			'default'
		);

		add_meta_box(
			'support_ticket_reply',
			__('Reply to Ticket', 'nextdestina-booking'),
			array($this, 'render_admin_reply_metabox'),
			'nd_support_ticket',
			'normal',
			'high'
		);

		add_meta_box(
			'support_ticket_status',
			__('Ticket Status', 'nextdestina-booking'),
			array($this, 'render_ticket_status_metabox'),
			'nd_support_ticket',
			'side',
			'high'
		);
	}

	public function render_payment_method_metabox($post) {
		wp_nonce_field('save_payment_method_meta', 'payment_method_meta_nonce');

		$method = strtolower($post->post_title);

		// Always include general/basic fields
		include plugin_dir_path(__FILE__) . 'partials/payment-metabox/metabox-general.php';

		// Include gateway-specific fields
		switch ($method) {
			case 'stripe':
				include plugin_dir_path(__FILE__) . 'partials/payment-metabox/metabox-stripe.php';
				break;
			case 'paypal':
				include plugin_dir_path(__FILE__) . 'partials/payment-metabox/metabox-paypal.php';
				break;
			default:
				include plugin_dir_path(__FILE__) . 'partials/payment-metabox/metabox-manual.php';
				//echo '';
		}
	}

	public function render_email_template_metabox($post) {

		wp_nonce_field('nd_save_email_template_meta', 'nd_email_template_meta_nonce');

		$template = strtolower($post->post_title);

		switch ($template) {
			case 'traveler':
				include plugin_dir_path(__FILE__) . 'partials/email-metabox/traveler-email.php';
				break;
			case 'admin':
				include plugin_dir_path(__FILE__) . 'partials/email-metabox/admin-email.php';
				break;
			default:
				echo '';
		}
	}

	public function render_packages_metabox($post) {

		wp_nonce_field('nd_save_packages_meta', 'nd_packages_meta_nonce');

		include plugin_dir_path(__FILE__) . 'partials/package-metabox/package-info.php';
	}

	public function save_payment_method_meta($post_id) {
		if (!isset($_POST['payment_method_meta_nonce']) || !wp_verify_nonce($_POST['payment_method_meta_nonce'], 'save_payment_method_meta')) {
			return;
		}

		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
			return;
		}
		if (!current_user_can('edit_post', $post_id)) {
			return;
		}

		// Save shared fields

		update_post_meta($post_id, '_payment_logo', sanitize_text_field($_POST['_payment_logo'] ?? ''));
		
		if (isset($_POST['_payment_description'])) {
			update_post_meta($post_id, '_payment_description', sanitize_textarea_field($_POST['_payment_description']));
		}

		$method = strtolower(get_the_title($post_id));

		switch ($method) {
			case 'stripe':
				update_post_meta($post_id, '_stripe_secret_key', sanitize_text_field($_POST['_stripe_secret_key'] ?? ''));
				update_post_meta($post_id, '_stripe_publishable_key', sanitize_text_field($_POST['_stripe_publishable_key'] ?? ''));
				update_post_meta($post_id, '_stripe_percentage_charge', sanitize_text_field($_POST['_stripe_percentage_charge'] ?? ''));
				update_post_meta($post_id, '_stripe_fixed_charge', sanitize_text_field($_POST['_stripe_fixed_charge'] ?? ''));
				break;
			case 'paypal':
				update_post_meta($post_id, '_paypal_client_id', sanitize_text_field($_POST['_paypal_client_id'] ?? ''));
				update_post_meta($post_id, '_paypal_secret', sanitize_text_field($_POST['_paypal_secret'] ?? ''));
				update_post_meta($post_id, '_paypal_percentage_charge', sanitize_text_field($_POST['_paypal_percentage_charge'] ?? ''));
				update_post_meta($post_id, '_paypal_fixed_charge', sanitize_text_field($_POST['_paypal_fixed_charge'] ?? ''));
				break;
		}

		// Manual Payment method

		if (isset($_POST['_manual_payment_description'])) {
			update_post_meta($post_id, '_manual_payment_description', sanitize_textarea_field($_POST['_manual_payment_description']));
		}

		if ( isset( $_POST['payment_method_fields'] ) && is_array( $_POST['payment_method_fields'] ) ) {
			update_post_meta( $post_id, '_payment_method_fields', array_values( $_POST['payment_method_fields'] ) );
		} else {
			delete_post_meta( $post_id, '_payment_method_fields' );
		}

	}

	public function save_email_metabox($post_id) {
	    if (!isset($_POST['nd_email_template_meta_nonce']) || !wp_verify_nonce($_POST['nd_email_template_meta_nonce'], 'nd_save_email_template_meta')) {
	        return;
	    }

	    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
	    if (!current_user_can('edit_post', $post_id)) return;

	    // Email Notification

		$template = strtolower(get_the_title($post_id));

		switch ($template) {
			case 'traveler':
			    update_post_meta($post_id, '_registration_email_subject', sanitize_text_field($_POST['_registration_email_subject'] ?? ''));
				update_post_meta($post_id, '_registration_email_message', sanitize_text_field($_POST['_registration_email_message'] ?? ''));
				if (isset($_POST['_registration_email_switch']) && $_POST['_registration_email_switch'] === 'yes') {
					update_post_meta($post_id, '_registration_email_switch', 'yes');
				} else {
					update_post_meta($post_id, '_registration_email_switch', 'no');
				}
				
				update_post_meta($post_id, '_user_email_subject', sanitize_text_field($_POST['_user_email_subject'] ?? ''));
				update_post_meta($post_id, '_user_email_message', sanitize_text_field($_POST['_user_email_message'] ?? ''));
				if (isset($_POST['_user_booking_confirmation_switch']) && $_POST['_user_booking_confirmation_switch'] === 'yes') {
					update_post_meta($post_id, '_user_booking_confirmation_switch', 'yes');
				} else {
					update_post_meta($post_id, '_user_booking_confirmation_switch', 'no');
				}

				update_post_meta($post_id, '_reset_password_subject', sanitize_text_field($_POST['_reset_password_subject'] ?? ''));
				update_post_meta($post_id, '_reset_password_message', sanitize_text_field($_POST['_reset_password_message'] ?? ''));
				if (isset($_POST['_user_pass_reset_switch']) && $_POST['_user_pass_reset_switch'] === 'yes') {
					update_post_meta($post_id, '_user_pass_reset_switch', 'yes');
				} else {
					update_post_meta($post_id, '_user_pass_reset_switch', 'no');
				}

				update_post_meta($post_id, '_support_reply_subject', sanitize_text_field($_POST['_support_reply_subject'] ?? ''));
				update_post_meta($post_id, '_support_reply_message', sanitize_text_field($_POST['_support_reply_message'] ?? ''));
				if (isset($_POST['_send_support_reply_email']) && $_POST['_send_support_reply_email'] === 'yes') {
				    update_post_meta($post_id, '_send_support_reply_email', 'yes');
				} else {
				    update_post_meta($post_id, '_send_support_reply_email', 'no');
				}

				break;
			case 'admin':
				update_post_meta($post_id, '_admin_email_subject', sanitize_text_field($_POST['_admin_email_subject'] ?? ''));
				update_post_meta($post_id, '_admin_email_message', sanitize_text_field($_POST['_admin_email_message'] ?? ''));
				if (isset($_POST['_admin_new_booking_switch']) && $_POST['_admin_new_booking_switch'] === 'yes') {
					update_post_meta($post_id, '_admin_new_booking_switch', 'yes');
				} else {
					update_post_meta($post_id, '_admin_new_booking_switch', 'no');
				}

				update_post_meta($post_id, '_admin_payment_subject', sanitize_text_field($_POST['_admin_payment_subject'] ?? ''));
				update_post_meta($post_id, '_admin_payment_message', sanitize_text_field($_POST['_admin_payment_message'] ?? ''));
				if (isset($_POST['_admin_new_payment_switch']) && $_POST['_admin_new_payment_switch'] === 'yes') {
					update_post_meta($post_id, '_admin_new_payment_switch', 'yes');
				} else {
					update_post_meta($post_id, '_admin_new_payment_switch', 'no');
				}

				update_post_meta($post_id, '_admin_ticket_subject', sanitize_text_field($_POST['_admin_ticket_subject'] ?? ''));
				update_post_meta($post_id, '_admin_ticket_message', sanitize_text_field($_POST['_admin_ticket_message'] ?? ''));
				if (isset($_POST['_support_request_email']) && $_POST['_support_request_email'] === 'yes') {
				    update_post_meta($post_id, '_support_request_email', 'yes');
				} else {
				    update_post_meta($post_id, '_support_request_email', 'no');
				}

				update_post_meta($post_id, '_ticket_user_reply_subject', sanitize_text_field($_POST['_ticket_user_reply_subject'] ?? ''));
				update_post_meta($post_id, '_ticket_user_reply_message', sanitize_text_field($_POST['_ticket_user_reply_message'] ?? ''));
				if (isset($_POST['_ticket_user_reply_switch']) && $_POST['_ticket_user_reply_switch'] === 'yes') {
				    update_post_meta($post_id, '_ticket_user_reply_switch', 'yes');
				} else {
				    update_post_meta($post_id, '_ticket_user_reply_switch', 'no');
				}

				break;
		}
	}

	public function save_package_metabox($post_id) {
		if (!isset($_POST['nd_packages_meta_nonce']) || !wp_verify_nonce($_POST['nd_packages_meta_nonce'], 'nd_save_packages_meta')) {
			return;
		}

		if (isset($_POST['_package_location'])) {
			update_post_meta($post_id, '_package_location', sanitize_textarea_field($_POST['_package_location']));
		}
		if (isset($_POST['_package_discount'])) {
			update_post_meta($post_id, '_package_discount', sanitize_textarea_field($_POST['_package_discount']));
		}

		// Gallery field

	    if ( isset( $_POST['nextdestina_tour_gallery_images'] ) ) {
	        $images = array_filter( array_map( 'intval', explode( ',', sanitize_text_field( $_POST['nextdestina_tour_gallery_images'] ) ) ) );
	        update_post_meta( $post_id, '_nextdestina_tour_gallery_images', $images );
	    } else {
	        // Clear gallery if empty
	        delete_post_meta( $post_id, '_nextdestina_tour_gallery_images' );
	    }

	}

	/**
	 * Payment method OFF/ON switch
	 */

	public function payment_method_toggle_column($columns) {
		$columns['enabled'] = __('Enabled', 'nextdestina-booking');
		return $columns;
	}

	public function render_payment_method_column($column, $post_id) {
		if ($column === 'enabled') {
			$enabled = get_post_meta($post_id, '_payment_enabled', true);

			$checked = $enabled === '1' ? 'checked' : '';
			echo '<label class="payment-switch">
			<input type="checkbox" class="toggle-payment-method" data-id="' . esc_attr($post_id) . '" ' . $checked . '>
			<span class="slider round"></span>
			</label>';
		}
	}

	public function ndb_toggle_payment_method() {
		check_ajax_referer('toggle_payment_method', 'nonce');

		$post_id = intval($_POST['post_id']);
		$enabled = sanitize_text_field($_POST['enabled']);

		if (current_user_can('edit_post', $post_id)) {
			update_post_meta($post_id, '_payment_enabled', $enabled);
			wp_send_json_success(['status' => 'updated']);
		}

		wp_send_json_error(['message' => 'Permission denied']);
	}

	/**
	 * Support Ticket
	 */

	public function remove_ticket_publish_metabox() {
		remove_meta_box('submitdiv', 'nd_support_ticket', 'side');
	}

	public function render_admin_reply_metabox($post) {
		?>
		
		<div class="admin-chat-group">
			<div class="chat-list">
				<?php
				$replies = get_post_meta($post->ID, '_nd_ticket_replies', true);
				
				if (!empty($replies)) {
					echo '<div class="ticket-replies">';
					foreach ($replies as $reply) {
						$user_info = get_userdata($reply['user_id']);

						$is_admin = user_can($reply['user_id'], 'manage_options');
						$reply_class = $is_admin ? 'admin-reply' : 'user-reply';
						?>
						<div class="reply <?php echo esc_attr($reply_class); ?>">
							<div class="author">
								<div class="image">
									<?php echo get_avatar($user_info->ID, 30); ?>
								</div>
							</div>
							<div class="content">
								<p><?php echo esc_html($reply['message']); ?></p>

								<?php if (!empty($reply['attachments']) && is_array($reply['attachments'])): ?>
								<div class="attachments">
									<ul>
										<?php foreach ($reply['attachments'] as $file): ?>
											<?php
											// If it's an attachment ID, convert it to URL
											$file_url = is_numeric($file) ? wp_get_attachment_url($file) : $file;
											?>
											<?php if ($file_url): ?>
												<li>
													<a href="<?php echo esc_url($file_url); ?>" target="_blank" download>
														<?php echo esc_html(basename($file_url)); ?>
													</a>
												</li>
											<?php endif; ?>
										<?php endforeach; ?>
									</ul>
								</div>
								<?php endif; ?>
							</div>
						</div>
						<?php
					}
					echo '</div>';
				} else {
					echo '<p>No replies yet.</p>';
				}
				?>
			</div>
			<div class="chat-form">
				<textarea name="nd_ticket_reply_message" rows="4" style="width:100%;" placeholder="Type your reply here..."></textarea>
				<br>
				<label for="nd_ticket_reply_attachments"><?php esc_html_e('Attach files:', 'nextdestina-booking'); ?></label><br>
				<input type="file" name="nd_ticket_reply_attachments[]" id="nd_ticket_reply_attachments" multiple>
				<br><br>
				<button class="button button-primary" id="admin-reply-btn"><?php esc_html_e('Send Reply', 'nextdestina-booking'); ?></button>
			</div>
		</div>

		<?php
	}

	public function admin_ticket_reply_handler() {
	    // Check nonce for security
	    if ( ! isset($_POST['nd_ticket_nonce']) || ! wp_verify_nonce($_POST['nd_ticket_nonce'], 'nd_ticket_reply_nonce') ) {
	        wp_send_json_error('Invalid nonce');
	    }

	    $ticket_id = intval($_POST['ticket_id']);
	    if (!current_user_can('edit_post', $ticket_id)) {
	        wp_send_json_error('You do not have permission to reply to this ticket.');
	    }

	    $message = isset($_POST['message']) ? sanitize_textarea_field($_POST['message']) : '';
	    if (empty($message)) {
	        wp_send_json_error('Reply message cannot be empty.');
	    }

	    $attachments = array();

	    // Handle file attachments if any
	    if (!empty($_FILES['attachments'])) {
	        $files = $_FILES['attachments'];
	        require_once(ABSPATH . 'wp-admin/includes/file.php');

	        foreach ($files['name'] as $key => $filename) {
	            if ($files['error'][$key] === UPLOAD_ERR_OK) {
	                $file = array(
	                    'name'     => $files['name'][$key],
	                    'type'     => $files['type'][$key],
	                    'tmp_name' => $files['tmp_name'][$key],
	                    'error'    => $files['error'][$key],
	                    'size'     => $files['size'][$key],
	                );

	                $upload = wp_handle_upload($file, array('test_form' => false));
	                if (!isset($upload['error'])) {
	                    $attachments[] = $upload['url'];
	                }
	            }
	        }
	    }

	    // Get existing replies
	    $replies = get_post_meta($ticket_id, '_nd_ticket_replies', true);
	    $replies = is_array($replies) ? $replies : array();

	    $replies[] = array(
	        'user_id'     => get_current_user_id(),
	        'message'     => $message,
	        'attachments' => $attachments,
	        'datetime'    => current_time('mysql'),
	    );

	    update_post_meta($ticket_id, '_nd_ticket_replies', $replies);

	    // Update ticket status
	    update_post_meta($ticket_id, '_admin_ticket_status', 'replied');
	    update_post_meta($ticket_id, '_user_ticket_status', 'answered');

	    // === Email Setup ===
	    
        $email_notification = get_option('email_notification');
        
        $ticket = get_post($ticket_id);
        if ($ticket && $ticket->post_type === 'nd_support_ticket') {
            $user_info = get_userdata($ticket->post_author);
            if ($user_info && !empty($user_info->user_email)) {
                
                $traveler_posts = get_posts([
                    'post_type'      => 'email_template',
                    'title'          => 'traveler',
                    'post_status'    => 'publish',
                    'posts_per_page' => 1,
                ]);
                
                $traveler_template = !empty($traveler_posts) ? $traveler_posts[0] : null;
                
				$support_req_reply_switch  = get_post_meta($traveler_template->ID, '_send_support_reply_email', true);
				$reply_subject             = $traveler_template ? get_post_meta($traveler_template->ID, '_support_reply_subject', true) : 'New Reply to Ticket';
				$reply_message_raw         = $traveler_template ? get_post_meta($traveler_template->ID, '_support_reply_message', true) : 'Hi {customer_name}, You have received a new reply to your support ticket #{ticket_id}. Message: {message}';
                
                $replacements = [
                    '{ticket_id}'     => $ticket->ID,
                    '{customer_name}' => $user_info->display_name,
                    '{message}'       => nl2br($message),
                ];
                
                $final_message = str_replace(array_keys($replacements), array_values($replacements), $reply_message_raw);
                
                $headers = ['Content-Type: text/html; charset=UTF-8'];
                $attachments_email = [];
                
                if ($email_notification == 1) {
                    if ($support_req_reply_switch === 'yes') {
                        if ( Nextdestina_Global_Functions::is_wp_mail_smtp_configured() ) {
                            wp_mail($user_info->user_email, $reply_subject, $final_message, $headers, $attachments_email);
                        }
                    }
                }
            }
        }
        
        $new_reply = [
            'user_id'     => get_current_user_id(),
            'message'     => $message,
            'attachments' => $attachments,
            'datetime'    => current_time('mysql'),
		];
        
		wp_send_json_success($new_reply);
	}

	public function render_ticket_status_metabox($post){
	
		$current_status = get_post_meta($post->ID, '_close_ticket_status', true);
		$is_closed = ($current_status === 'closed');

		wp_nonce_field('nd_ticket_status_action', 'nd_ticket_status_nonce');
		?>

		<p>
			<strong><?php esc_html_e('Current Status:', 'nextdestina-booking'); ?></strong><br>
			<?php echo $is_closed ? '<span style="color:red;">Closed</span>' : '<span style="color:green;">Open</span>'; ?>
		</p>

		<?php if (!$is_closed): ?>
			<p>
				<button type="submit" name="nd_close_ticket_now" value="1" class="button button-secondary">
					<?php esc_html_e('Close Ticket', 'nextdestina-booking'); ?>
				</button>
			</p>
		<?php else: ?>
			<p>
				<button type="submit" name="nd_reopen_ticket_now" value="1" class="button button-secondary">
					<?php esc_html_e('Reopen Ticket', 'nextdestina-booking'); ?>
				</button>
			</p>
		<?php endif;

	}

	public function save_ticket_status_metabox($post_id) {
		if (
			isset($_POST['nd_ticket_status_nonce']) &&
			wp_verify_nonce($_POST['nd_ticket_status_nonce'], 'nd_ticket_status_action')
		) {
			if (isset($_POST['nd_close_ticket_now'])) {
				update_post_meta($post_id, '_close_ticket_status', 'closed');

				update_post_meta($post_id, '_admin_ticket_status', 'closed');
				update_post_meta($post_id, '_user_ticket_status', 'closed');
			} elseif (isset($_POST['nd_reopen_ticket_now'])) {
				update_post_meta($post_id, '_close_ticket_status', 'open');

				update_post_meta($post_id, '_admin_ticket_status', 'open');
				update_post_meta($post_id, '_user_ticket_status', 'open');
			}
		}
	}

	// Status custom column

	public function nd_add_ticket_status_column($columns) {
		$new_columns = [];

		foreach ($columns as $key => $value) {
			$new_columns[$key] = $value;
			if ($key === 'title') {
				$new_columns['ticket_status'] = __('Status', 'nextdestina-booking');
			}
		}

		return $new_columns;
	}
	public function nd_display_ticket_status_column($column, $post_id) {
		if ($column === 'ticket_status') {
			$status = get_post_meta($post_id, '_admin_ticket_status', true);

			if (!$status) {
				$status = 'open';
			}

			// Optional: color styling
			$color_map = [
				'open'     => 'cyan',
				'replied'  => 'orange',
				'closed'   => 'red',
				'cutomer reply' => 'green'
			];
			$color = isset($color_map[$status]) ? $color_map[$status] : 'black';

			echo '<span class="' . esc_attr($color) . '">' . esc_html(ucfirst($status)) . '</span>';
		}
	}

	// Last reply column

	public function nd_add_last_reply_column($columns) {
		$columns['last_reply'] = __('Last Reply', 'nextdestina-booking');
		return $columns;
	}

	public function nd_show_last_reply_column($column, $post_id) {
		if ($column === 'last_reply') {
			$replies = get_post_meta($post_id, '_nd_ticket_replies', true);

			if (is_array($replies) && !empty($replies)) {
				$last_reply = end($replies);
				$last_time = $last_reply['datetime'];
				echo esc_html(human_time_diff(strtotime($last_time), current_time('timestamp'))) . ' ago';
			} else {
				echo '<em>' . __('No replies', 'nextdestina-booking') . '</em>';
			}
		}
	}

	// Filter by status

	public function nd_filter_ticket_by_status() {
		global $typenow;

		if ($typenow !== 'nd_support_ticket') {
			return;
		}

		$selected = isset($_GET['ticket_status']) ? $_GET['ticket_status'] : '';

		$statuses = [
			'open'     => __('Open', 'nextdestina-booking'),
			'answered' => __('Answered', 'nextdestina-booking'),
			'replied'  => __('Replied', 'nextdestina-booking'),
			'pending'  => __('Pending', 'nextdestina-booking'),
			'closed'   => __('Closed', 'nextdestina-booking'),
		];

		echo '<select name="ticket_status">';
		echo '<option value="">' . __('All Statuses', 'nextdestina-booking') . '</option>';
		foreach ($statuses as $key => $label) {
			printf(
				'<option value="%s"%s>%s</option>',
				esc_attr($key),
				selected($selected, $key, false),
				esc_html($label)
			);
		}
		echo '</select>';
	}
	public function nd_filter_tickets_query_by_status($query) {
		global $pagenow;

		if (
			is_admin() &&
			$pagenow === 'edit.php' &&
			isset($_GET['post_type']) &&
			$_GET['post_type'] === 'nd_support_ticket' &&
			isset($_GET['ticket_status']) &&
			$_GET['ticket_status'] !== ''
		) {
			$query->set('meta_query', [
				[
					'key'   => '_admin_ticket_status',
					'value' => sanitize_text_field($_GET['ticket_status']),
				]
			]);
		}
	}

}
