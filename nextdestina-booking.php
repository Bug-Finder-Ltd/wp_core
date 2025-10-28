<?php
/*
 * Plugin Name:       Nextdestina Booking
 * Plugin URI:        https://bugfinder.net/nextdestina-booking
 * Description:       Handle the basics with this plugin.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            bug-finder
 * Author URI:        https://bugfinder.net/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://bugfinder.net/nextdestina-booking/
 * Text Domain:       nextdestina-booking
 * Domain Path:       /languages
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Define plugin constants
define( 'TRAVELER_DASHBOARD_VERSION', '1.0.0' );
define( 'TRAVELER_DASHBOARD_PLUGIN_FILE', __FILE__ );
define( 'TRAVELER_DASHBOARD_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'TRAVELER_DASHBOARD_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

/**
 * Load plugin textdomain
 */
add_action( 'plugins_loaded', function() {
    load_plugin_textdomain(
        'nextdestina-booking',
        false,
        dirname( plugin_basename( __FILE__ ) ) . '/languages'
    );
});

require_once 'includes/email-invoice.php';

/**
 * Main plugin class
 */
class Traveler_Dashboard {

    protected $user_class;

    private $favorites;

    public $global_functions;

    /**
     * Plugin instance
     *
     * @var Traveler_Dashboard
     */
    private static $instance = null;

    /**
     * Get plugin instance
     *
     * @return Traveler_Dashboard
     */
    public static function get_instance() {
        if ( null === self::$instance ) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Constructor
     */
    private function __construct() {
        $this->init_hooks();

        $this->load_activation_handler();

        $this->load_dependencies();
    }

    /**
     * Initialize hooks
     */
    private function init_hooks() {
        add_action( 'init', array( $this, 'init' ) );

        add_action( 'template_redirect', array( $this, 'invoice_handler' ) );

        add_action( 'template_redirect', array( $this, 'handle_dashboard_request' ) );

        //Miscellaneous function hook
        add_action( 'pre_get_posts', array( $this, 'custom_tour_archive_filters' ) );
        add_action( 'template_redirect', array( $this, 'prevent_single_result_redirect' ) );
        add_action( 'term_link', array( $this, 'redirect_destination_to_tour_archive' ), 10, 3 );

        // Email Notification
        //add_action( 'phpmailer_init', array( $this, 'phpmailer_process_data' ) );
        
        // AJAX hooks
        add_action( 'wp_ajax_get_traveler_bookings', array( $this, 'ajax_get_bookings' ) );
        add_action( 'wp_ajax_update_traveler_profile', array( $this, 'ajax_update_profile' ) );
        
        // Security hooks
        add_action( 'admin_init', array( $this, 'redirect_travelers_from_admin' ) );

        add_action( 'template_redirect', array( $this, 'handle_tour_rating_form_submission' ) );
        add_action( 'admin_post_approve_tour_rating', array( $this, 'handle_approve_rating' ) );
        add_action( 'admin_post_delete_tour_rating', array( $this, 'handle_delete_rating' ) );

        add_action( 'elementor/widgets/register', array( $this, 'register_elementor_widgets' ) );
        add_action( 'elementor/elements/categories_registered', array( $this, 'register_elementor_widget_category' ) );

        // Stripe checkout

        add_action( 'wp_ajax_create_stripe_checkout', array( $this, 'create_stripe_checkout' ) );
        add_action( 'wp_ajax_nopriv_create_stripe_checkout', array( $this, 'create_stripe_checkout' ) );

        // Paypal checkout

        add_action( 'wp_ajax_nextdestina_process_paypal_payment', array( $this, 'nextdestina_process_paypal_payment' ) );
        add_action( 'wp_ajax_nopriv_nextdestina_process_paypal_payment', array( $this, 'nextdestina_process_paypal_payment' ) );

    }

    /**
     * Load and register activation/deactivation handlers
     */
    private function load_activation_handler() {

        require_once TRAVELER_DASHBOARD_PLUGIN_DIR . 'includes/base/class-activator.php';
        require_once TRAVELER_DASHBOARD_PLUGIN_DIR . 'includes/base/class-deactivator.php';
        
        register_activation_hook( TRAVELER_DASHBOARD_PLUGIN_FILE, array( 'Activator', 'activate' ) );
        register_deactivation_hook( TRAVELER_DASHBOARD_PLUGIN_FILE, array( 'Deactivator', 'deactivate' ) );
    }

    /**
     * Load Dependencies
     */
    private function load_dependencies() {

        require_once TRAVELER_DASHBOARD_PLUGIN_DIR . 'admin/class-nextdestina-admin.php';
        new Nextdestina_Admin();

        require_once TRAVELER_DASHBOARD_PLUGIN_DIR . 'public/class-nextdestina-public.php';
        new Nextdestina_Public();

        require_once TRAVELER_DASHBOARD_PLUGIN_DIR . 'user/class-nextdestina-user.php';
        $this->user_class = new Nextdestina_User();

        require_once TRAVELER_DASHBOARD_PLUGIN_DIR . 'includes/class-payment-methods.php';
        new Nextdestina_Payment_Methods();
    }

    /**
     * Invoice
     */

    public function invoice_handler(){

        if (isset($_GET['download_invoice']) && is_numeric($_GET['download_invoice'])) {
            $booking_id = absint($_GET['download_invoice']);

            $invoice_id = $this->global_functions->get_invoice_id_by_booking_id($booking_id);

            if ($invoice_id) {
                require_once plugin_dir_path(__FILE__) . 'includes/class-invoice-pdf.php';
                Nextdestina_Invoice_PDF::render_invoice_pdf($invoice_id);
            } else {
                wp_die('Invoice not found.');
            }

            exit;
        }
    }

    /**
     * Stripe checkout
     */

    public function create_stripe_checkout() {

        if (!isset($_POST['tour_booking_nonce']) || !wp_verify_nonce($_POST['tour_booking_nonce'], 'submit_tour_booking')) {
            wp_send_json_error(['message' => 'Invalid nonce']);
        }
        ob_start();

        $tour_id       = intval($_POST['tour_id']);
        $travel_date   = sanitize_text_field($_POST['travel_date']);
        $num_travelers = intval($_POST['num_travelers']);

        $first_name = sanitize_text_field($_POST['first_name']);
        $last_name  = sanitize_text_field($_POST['last_name']);
        $email      = sanitize_email($_POST['email']);
        $phone      = sanitize_text_field($_POST['phone']);
        $address_1  = sanitize_text_field($_POST['address_1']);
        $address_2  = sanitize_text_field($_POST['address_2']);
        $city       = sanitize_text_field($_POST['city']);
        $state      = sanitize_text_field($_POST['state']);
        $zip        = sanitize_text_field($_POST['zip']);
        $country    = sanitize_text_field($_POST['country']);
        $message    = sanitize_textarea_field($_POST['message']);

        $travelers = isset($_POST['travelers']) ? $_POST['travelers'] : [];
        $price_per_person = floatval($_POST['price_per_person']);
        $total_price      = floatval($_POST['total_price']);

        // Charge calculation

        $stripe_method = get_posts([
            'post_type'      => 'payment_method',
            'title'          => 'Stripe',
            'posts_per_page' => 1,
            'post_status'    => 'publish',
        ]);
        $stripe_post_id = !empty($stripe_method) ? $stripe_method[0]->ID : 0;

        $percentage_charge = floatval(get_post_meta($stripe_post_id, '_stripe_percentage_charge', true));
        $fixed_charge      = floatval(get_post_meta($stripe_post_id, '_stripe_fixed_charge', true));

        $extra_charge = 0;

        if ($percentage_charge > 0) {
            $extra_charge += ($total_price * ($percentage_charge / 100));
        }

        if ($fixed_charge > 0) {
            $extra_charge += $fixed_charge;
        }

        $total_price_with_charges = $total_price + $extra_charge;

        $stripe_api = get_post_meta($stripe_post_id, '_stripe_secret_key', true);

        \Stripe\Stripe::setApiKey($stripe_api);

        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => ['name' => 'Tour Booking'],
                    'unit_amount' => intval($total_price_with_charges * 100),
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => home_url('/booking-success?session_id={CHECKOUT_SESSION_ID}'),
            'cancel_url' => home_url('/booking-cancel'),
        ]);

        $booking_id = wp_insert_post(array(
            'post_type'   => 'tour_booking',
            'post_title'  => $first_name . ' ' . $last_name . ' - ' . current_time('Y-m-d H:i'),
            'post_status' => 'publish',
        ));

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
            update_post_meta($booking_id, 'travelers', $travelers);
            update_post_meta($booking_id, 'price_per_person', $price_per_person);
            update_post_meta($booking_id, 'total_price', $total_price);
            update_post_meta($booking_id, 'stripe_session_id', $session->id);
        }

        wp_send_json(['id' => $session->id]);
    }

    /**
     * Paypal checkout
     */

    protected function get_paypal_payment_details($transaction_id, $is_live = false) {

        /**
         * Query paypal client id
         */

        $paypal_query = new WP_Query([
            'post_type'      => 'payment_method',
            'title'          => 'PayPal',
            'post_status'    => 'publish',
            'posts_per_page' => 1,
        ]);

        if (!$paypal_query->have_posts()) {
            return false;
        }

        $paypal_post = $paypal_query->posts[0];
        $post_id = $paypal_post->ID;

        $client_id = get_post_meta($post_id, '_paypal_client_id', true);
        $secret    = get_post_meta($post_id, '_paypal_secret', true);

        $url = $is_live
            ? "https://api-m.paypal.com/v2/checkout/orders/{$transaction_id}"
            : "https://api-m.sandbox.paypal.com/v2/checkout/orders/{$transaction_id}";

        $auth = base64_encode("{$client_id}:{$secret}");

        $args = [
            'headers' => [
                'Authorization' => 'Basic ' . $auth,
                'Content-Type'  => 'application/json',
            ],
        ];

        $response = wp_remote_get($url, $args);

        if (is_wp_error($response)) return false;

        $body = wp_remote_retrieve_body($response);
        return json_decode($body, true);
    }

    public function nextdestina_process_paypal_payment() {

        if (!isset($_POST['details'])) {
            wp_send_json_error(['message' => 'Missing payment data']);
        }

        $details = json_decode(stripslashes($_POST['details']), true);
        $transaction_id = sanitize_text_field($details['id']);
        
        // Verify with PayPal server
        $paypal_data = $this->get_paypal_payment_details($transaction_id, false); // false = sandbox

        if (!$paypal_data || !isset($paypal_data['status']) || $paypal_data['status'] !== 'COMPLETED') {
            wp_send_json_error(['message' => 'Payment verification with PayPal failed.']);
        }

        // Fetch charges from "payment_method" CPT for PayPal
        $paypal_method = get_posts([
            'post_type'      => 'payment_method',
            'title'          => 'PayPal',
            'posts_per_page' => 1,
            'post_status'    => 'publish',
        ]);

        $paypal_post_id = !empty($paypal_method) ? $paypal_method[0]->ID : 0;
        $percentage_charge = floatval(get_post_meta($paypal_post_id, '_paypal_percentage_charge', true));
        $fixed_charge      = floatval(get_post_meta($paypal_post_id, '_paypal_fixed_charge', true));

        // Original price from form
        $original_total = floatval($_POST['total_price']);

        // Calculate extra charges
        $extra_charge = 0;
        if ($percentage_charge > 0) {
            $extra_charge += ($original_total * ($percentage_charge / 100));
        }
        if ($fixed_charge > 0) {
            $extra_charge += $fixed_charge;
        }

        // New total with charges
        $expected_total = $original_total + $extra_charge;

        // Compare with PayPal payment
        $amount_paid = floatval($paypal_data['purchase_units'][0]['amount']['value']);
        $currency    = sanitize_text_field($paypal_data['purchase_units'][0]['amount']['currency_code']);

        if (abs($amount_paid - $expected_total) > 0.01) { // allow tiny rounding difference
            wp_send_json_error(['message' => 'Payment amount does not match']);
        }

        // Booking form data
        $tour_id         = intval($_POST['tour_id']);
        $travel_date     = sanitize_text_field($_POST['travel_date']);
        $num_travelers   = intval($_POST['num_travelers']);

        $first_name = sanitize_text_field($_POST['first_name']);
        $last_name  = sanitize_text_field($_POST['last_name']);
        $email      = sanitize_email($_POST['email']);
        $phone      = sanitize_text_field($_POST['phone']);
        $address_1  = sanitize_text_field($_POST['address_1']);
        $address_2  = sanitize_text_field($_POST['address_2']);
        $city       = sanitize_text_field($_POST['city']);
        $state      = sanitize_text_field($_POST['state']);
        $zip        = sanitize_text_field($_POST['zip']);
        $country    = sanitize_text_field($_POST['country']);
        $message    = sanitize_textarea_field($_POST['message']);
        $travelers        = isset($_POST['travelers']) ? $_POST['travelers'] : [];
        $price_per_person = floatval($_POST['price_per_person']);

        // Insert booking post
        $booking_id = wp_insert_post([
            'post_type'    => 'tour_booking',
            'post_status'  => 'publish',
            'post_title'   => $first_name . ' ' . $last_name . ' - ' . current_time('Y-m-d H:i'),
            'post_content' => '',
        ]);

        if ($booking_id) {
            // Save booking meta
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
            update_post_meta($booking_id, 'travelers', $travelers);
            update_post_meta($booking_id, 'price_per_person', $price_per_person);
            update_post_meta($booking_id, 'total_price', $expected_total);
            update_post_meta($booking_id, 'extra_charge', $extra_charge);

            // Insert into payment history
            global $wpdb;
            $payment_history_table = $wpdb->prefix . 'payment_history';

            $payment_status = ($paypal_data['status'] === 'COMPLETED') ? 'succeeded' : strtolower($paypal_data['status']);

            $wpdb->insert($payment_history_table, [
                'booking_id'        => $booking_id,
                'user_id'           => get_current_user_id(),
                'stripe_session_id' => '',
                'transaction_id'    => $transaction_id,
                'amount_paid'       => $amount_paid,
                'currency'          => $currency,
                'payment_status'    => $payment_status,
                'payment_method'    => 'paypal',
                'created_at'        => current_time('mysql', 1),
            ]);

            wp_send_json_success(['message' => 'Booking successful', 'booking_id' => $booking_id]);
        } else {
            wp_send_json_error(['message' => 'Booking failed']);
        }
    }

    /**
     * Initialize plugin
     */
    public function init() {
        // Load textdomain
        load_plugin_textdomain( 'nextdestina-booking', false, dirname( plugin_basename( TRAVELER_DASHBOARD_PLUGIN_FILE ) ) . '/languages' );

        // Load favorites classes
        require_once TRAVELER_DASHBOARD_PLUGIN_DIR . 'includes/class-favorites.php';
        $this->favorites = new Nextdestina_Favorites();

        // Load assets class
        require_once TRAVELER_DASHBOARD_PLUGIN_DIR . 'includes/class-assets.php';
        new Nextdestina_Booking_Assets();

        // Custom post type
        require_once TRAVELER_DASHBOARD_PLUGIN_DIR . 'includes/class-cpt.php';
        new Nextdestina_CPT();

        // Template loader
        require_once TRAVELER_DASHBOARD_PLUGIN_DIR . 'includes/class-template-loader.php';
        new Tour_Booking_Template_Loader();

        // Global functions
        require_once TRAVELER_DASHBOARD_PLUGIN_DIR . 'includes/class-global.php';
        $this->global_functions = new Nextdestina_Global_Functions();

        require_once TRAVELER_DASHBOARD_PLUGIN_DIR . 'includes/stripe/init.php';

        // Add rewrite rules
        $this->add_rewrite_rules();

    }

    /**
     * Add rewrite rules
     */
    public function add_rewrite_rules() {
        // Validate allowed pages
        $allowed_pages = $this->get_allowed_dashboard_pages();
        
        // Main dashboard
        add_rewrite_rule(
            '^my-dashboard/?$',
            'index.php?traveler_dashboard=home',
            'top'
        );
        
        // Dashboard pages
        add_rewrite_rule(
            '^my-dashboard/([^/]+)/?$',
            'index.php?traveler_dashboard=$matches[1]',
            'top'
        );
        
        // Add rewrite tags
        add_rewrite_tag( '%traveler_dashboard%', '([^&]+)' );
    }

    /**
     * Get allowed dashboard pages
     *
     * @return array
     */
    private function get_allowed_dashboard_pages() {
        return array(
            'home',
            'history',
            'favorites',
            'payments',
            'profile',
            'create-ticket',
            'tickets',
            'ticket-details',
            'booking-details',
        );
    }

    /**
     * Handle dashboard request
     */
    public function handle_dashboard_request() {
        $dashboard_page = get_query_var( 'traveler_dashboard' );
        
        if ( ! $dashboard_page ) {
            return;
        }
        
        // Validate page
        if ( ! in_array( $dashboard_page, $this->get_allowed_dashboard_pages(), true ) ) {
            wp_die( esc_html__( 'Invalid dashboard page.', 'nextdestina-booking' ), 404 );
        }
        
        // Check authentication
        if ( ! is_user_logged_in() ) {
            wp_safe_redirect( wp_login_url( esc_url_raw( $_SERVER['REQUEST_URI'] ) ) );
            exit;
        }
        
        // Check user capabilities
        if ( ! current_user_can( 'traveler' ) ) {
            wp_die( esc_html__( 'You do not have permission to access this page.', 'nextdestina-booking' ) );
        }
        
        $this->load_dashboard_template( $dashboard_page );
        exit;
    }

    /**
     * Handle rating
     */

    public function handle_approve_rating() {
        if (
            current_user_can( 'manage_options' ) &&
            isset( $_GET['id'] ) &&
            wp_verify_nonce( $_REQUEST['_wpnonce'], 'approve_rating_' . $_GET['id'] )
        ) {
            global $wpdb;
            $table = $wpdb->prefix . 'tour_ratings';
            $wpdb->update( $table, array( 'status' => 'approved' ), array( 'id' => absint( $_GET['id'] ) ) );
        }
        wp_redirect( admin_url( 'edit.php?post_type=tour&page=tour-ratings' ) );
        exit;
    }

    public function handle_delete_rating() {
        if (
            current_user_can( 'manage_options' ) &&
            isset( $_GET['id'] ) &&
            wp_verify_nonce( $_REQUEST['_wpnonce'], 'delete_rating_' . $_GET['id'] )
        ) {
            global $wpdb;
            $table = $wpdb->prefix . 'tour_ratings';
            $wpdb->delete( $table, array( 'id' => absint( $_GET['id'] ) ) );
        }
        wp_redirect( admin_url( 'edit.php?post_type=tour&page=tour-ratings' ) );
        exit;
    }

    /**
     * Handle rating form
     */

    public function handle_tour_rating_form_submission() {
        if ( isset($_POST['submit_tour_rating']) ) {
            if (
                ! isset($_POST['tour_rating_nonce']) ||
                ! wp_verify_nonce($_POST['tour_rating_nonce'], 'submit_tour_rating')
            ) {
                return;
            }

            if ( ! is_user_logged_in() || ! current_user_can('traveler') ) {
                return; // Only logged-in travelers can submit
            }

            global $wpdb;

            $tour_id = absint($_POST['tour_id']);
            $rating  = isset($_POST['rating']) ? intval($_POST['rating']) : 0;
            $review  = isset($_POST['review']) ? sanitize_textarea_field($_POST['review']) : '';
            $user_id = get_current_user_id();
            $today   = current_time('Y-m-d');

            // Check if traveler booked this tour and travel start date has passed
            $can_rate = false;
            $bookings = get_posts(array(
                'post_type'      => 'tour_booking',
                'post_status'    => 'publish',
                'numberposts'    => -1,
                'meta_query'     => array(
                    'relation' => 'AND',
                    array(
                        'key'     => 'tour_id',
                        'value'   => $tour_id,
                        'compare' => '='
                    ),
                    array(
                        'key'     => 'user_id',
                        'value'   => $user_id,
                        'compare' => '='
                    )
                )
            ));

            if ( $bookings ) {
                foreach ( $bookings as $booking ) {
                    $start_date = get_post_meta($booking->ID, 'travel_date', true); // Adjust meta key
                    if ( $start_date && $start_date <= $today ) {
                        $can_rate = true;
                        break;
                    }
                }
            }

            if ( ! $can_rate ) {
                // Store a notice in a transient so it can be displayed on redirect
                set_transient('tour_rating_notice_' . $user_id, __('You can only rate after your travel start date, and only if you booked this tour.', 'nextdestina-booking'), 30);
                wp_redirect( get_permalink( $tour_id ) );
                exit;
            }

            // Insert rating if allowed
            if ( $tour_id && $rating >= 1 && $rating <= 5 ) {
                $wpdb->insert(
                    $wpdb->prefix . 'tour_ratings',
                    array(
                        'tour_id'    => $tour_id,
                        'user_id'    => $user_id,
                        'rating'     => $rating,
                        'review'     => $review,
                        'status'     => 'pending',
                        'created_at' => current_time( 'mysql' ),
                        'updated_at' => current_time( 'mysql' ),
                    ),
                    array('%d','%d','%d','%s','%s','%s','%s')
                );
            }

            // Redirect to prevent resubmission
            wp_redirect( add_query_arg( 'rating_submitted', '1', get_permalink( $tour_id ) ) );
            exit;
        }
    }

    /**
     * Miscellaneous function
     */

    public function custom_tour_archive_filters($query) {
        // Only affect frontend main query for 'tour' archive or custom AJAX
        if (!is_admin() && $query->is_main_query() && (is_post_type_archive('tour') || (isset($_POST['action']) && $_POST['action'] === 'filter_tours'))) {

            // Keyword search
            if (!empty($_GET['keyword'])) {
                $query->set('s', sanitize_text_field($_GET['keyword']));
            }

            // Taxonomy filter: destination
            if (!empty($_GET['destination'])) {
                $query->set('tax_query', array(
                    array(
                        'taxonomy' => 'destination',
                        'field'    => 'slug',
                        'terms'    => sanitize_text_field($_GET['destination']),
                    ),
                ));
            }

            // Mark as search for AJAX if needed
            if (isset($_POST['action']) && $_POST['action'] === 'filter_tours') {
                $query->is_search = true;
            }
        }
    }
    public function prevent_single_result_redirect() {
        if (is_post_type_archive('tour') && is_search()) {
            remove_action('template_redirect', 'redirect_canonical');
        }
    }
    public function redirect_destination_to_tour_archive($url, $term, $taxonomy) {
        if ($taxonomy === 'destination') {
            $url = get_post_type_archive_link('tour');
            $url = add_query_arg('destination', $term->slug, $url);
        }
        return $url;
    }
    
    /**
     * Load dashboard template
     *
     * @param string $page Page name.
     */
    private function load_dashboard_template( $page ) {
        // Set global for template
        global $current_dashboard_page, $dashboard_instance;
        $current_dashboard_page = sanitize_key( $page );
        $dashboard_instance = $this;
        
        // Load template
        $template_path = TRAVELER_DASHBOARD_PLUGIN_DIR . 'templates/dashboard-master.php';
        
        if ( file_exists( $template_path ) ) {
            include $template_path;
        } else {
            wp_die( esc_html__( 'Dashboard template not found.', 'nextdestina-booking' ) );
        }
    }

    /**
     * Load page content
     *
     * @param string $page Page name.
     */
    public function load_page_content( $page ) {
        $page = sanitize_key( $page );
        $template_file = TRAVELER_DASHBOARD_PLUGIN_DIR . "templates/pages/{$page}.php";
        
        if ( file_exists( $template_file ) ) {
            include $template_file;
        } else {
            $this->load_404_page();
        }
    }

    /**
     * Load 404 page
     */
    private function load_404_page() {
        $template_file = TRAVELER_DASHBOARD_PLUGIN_DIR . 'templates/pages/404.php';
        
        if ( file_exists( $template_file ) ) {
            include $template_file;
        } else {
            echo '<div class="dashboard-error">';
            echo '<h2>' . esc_html__( 'Page Not Found', 'nextdestina-booking' ) . '</h2>';
            echo '<p>' . esc_html__( 'The requested dashboard page could not be found.', 'nextdestina-booking' ) . '</p>';
            echo '</div>';
        }
    }

    /**
     * AJAX: Get traveler bookings
     */
    public function ajax_get_bookings() {
        // Verify nonce
        if ( ! wp_verify_nonce( $_POST['nonce'], 'traveler_dashboard_nonce' ) ) {
            wp_send_json_error( __( 'Security check failed.', 'nextdestina-booking' ) );
        }
        
        // Check capabilities
        if ( ! current_user_can( 'traveler' ) ) {
            wp_send_json_error( __( 'Insufficient permissions.', 'nextdestina-booking' ) );
        }
        
        // Sanitize input
        $page = isset( $_POST['page'] ) ? absint( $_POST['page'] ) : 1;
        $per_page = isset( $_POST['per_page'] ) ? absint( $_POST['per_page'] ) : 10;
        $status = isset( $_POST['status'] ) ? sanitize_text_field( $_POST['status'] ) : '';
        
        // Get bookings (implement your booking logic here)
        $bookings = $this->get_user_bookings( get_current_user_id(), $page, $per_page, $status );
        
        wp_send_json_success( $bookings );
    }

    /**
     * AJAX: Update traveler profile
     */
    public function ajax_update_profile() {
        // Verify nonce
        if ( ! wp_verify_nonce( $_POST['nonce'], 'traveler_dashboard_nonce' ) ) {
            wp_send_json_error( __( 'Security check failed.', 'nextdestina-booking' ) );
        }
        
        // Check capabilities
        if ( ! current_user_can( 'traveler' ) ) {
            wp_send_json_error( __( 'Insufficient permissions.', 'nextdestina-booking' ) );
        }
        
        $user_id = get_current_user_id();
        
        // Sanitize and validate input
        $first_name = isset( $_POST['first_name'] ) ? sanitize_text_field( $_POST['first_name'] ) : '';
        $last_name = isset( $_POST['last_name'] ) ? sanitize_text_field( $_POST['last_name'] ) : '';
        $email = isset( $_POST['email'] ) ? sanitize_email( $_POST['email'] ) : '';
        
        // Validate email
        if ( ! is_email( $email ) ) {
            wp_send_json_error( __( 'Invalid email address.', 'nextdestina-booking' ) );
        }
        
        // Update user meta
        update_user_meta( $user_id, 'first_name', $first_name );
        update_user_meta( $user_id, 'last_name', $last_name );
        
        // Update user email if changed
        $user = get_user_by( 'ID', $user_id );
        if ( $user->user_email !== $email ) {
            $result = wp_update_user( array(
                'ID' => $user_id,
                'user_email' => $email,
            ) );
            
            if ( is_wp_error( $result ) ) {
                wp_send_json_error( $result->get_error_message() );
            }
        }
        
        wp_send_json_success( __( 'Profile updated successfully.', 'nextdestina-booking' ) );
    }

    /**
     * Get user bookings (implement based on your booking system)
     *
     * @param int    $user_id User ID.
     * @param int    $page Page number.
     * @param int    $per_page Items per page.
     * @param string $status Booking status.
     * @return array
     */
    private function get_user_bookings( $user_id, $page = 1, $per_page = 10, $status = '' ) {
        // Implement your booking retrieval logic here
        // This is a placeholder - replace with your actual booking system
        
        global $wpdb;
        
        $offset = ( $page - 1 ) * $per_page;
        $where_clause = $wpdb->prepare( "WHERE user_id = %d", $user_id );
        
        if ( ! empty( $status ) ) {
            $where_clause .= $wpdb->prepare( " AND status = %s", $status );
        }
        
        // Example query - adjust table name and structure as needed
        $bookings = $wpdb->get_results(
            $wpdb->prepare(
                "SELECT * FROM {$wpdb->prefix}tour_bookings 
                {$where_clause} 
                ORDER BY created_date DESC 
                LIMIT %d OFFSET %d",
                $per_page,
                $offset
            )
        );
        
        return array(
            'bookings' => $bookings,
            'total' => $wpdb->get_var( "SELECT COUNT(*) FROM {$wpdb->prefix}tour_bookings {$where_clause}" ),
            'page' => $page,
            'per_page' => $per_page,
        );
    }

    /**
     * Redirect travelers from admin
     */
    public function redirect_travelers_from_admin() {
        if ( current_user_can( 'traveler' ) && ! wp_doing_ajax() && ! defined( 'DOING_CRON' ) ) {
            wp_safe_redirect( home_url( '/my-dashboard/' ) );
            exit;
        }
    }

    public function get_total_tour_bookings($status = '') {
        $args = array(
            'post_type' => 'tour',
            'posts_per_page' => -1,
            'fields' => 'ids',
            'meta_query' => array()
        );

        // Add status filter if provided
        if (!empty($status)) {
            $args['meta_query'][] = array(
                'key' => 'booking_status',
                'value' => $status,
                'compare' => '='
            );
        }

        $bookings = get_posts($args);
        return count($bookings);
    }

    /**
     * Get booking statistics
     * 
     * @return array Array of booking statistics
     */
    public function get_booking_statistics() {
        $stats = array(
            'total' => $this->get_total_tour_bookings(),
            'pending' => $this->get_total_tour_bookings('pending'),
            'confirmed' => $this->get_total_tour_bookings('confirmed'),
            'cancelled' => $this->get_total_tour_bookings('cancelled'),
            'completed' => $this->get_total_tour_bookings('completed')
        );
        
        return $stats;
    }

    /**
     * Elementor
     */

    public function register_elementor_widgets($widgets_manager) {
        require_once TRAVELER_DASHBOARD_PLUGIN_DIR . 'includes/elementor/tour-packages.php';
        require_once TRAVELER_DASHBOARD_PLUGIN_DIR . 'includes/elementor/tour-destination.php';
        require_once TRAVELER_DASHBOARD_PLUGIN_DIR . 'includes/elementor/tour-search.php';

        $widgets_manager->register( new Tour_Packages() );
        $widgets_manager->register( new Tour_Destination() );
        $widgets_manager->register( new Nextdestina_Search() );
    }
    public function register_elementor_widget_category() {
        \Elementor\Plugin::instance()->elements_manager->add_category(
            'nextdestina-booking-category',
            [
                'title' => esc_html__( 'Nextdestina Booking', 'nextdestina-booking' ),
                'icon'  => 'fa fa-map', // Or any Dashicons class like 'eicon-dashboard'
            ],
            0 // Position
        );
    }

}

// Initialize plugin
Traveler_Dashboard::get_instance();

require_once plugin_dir_path(__FILE__) . 'includes/class-favorites.php';
$GLOBALS['traveler_favorites'] = new Nextdestina_Favorites();