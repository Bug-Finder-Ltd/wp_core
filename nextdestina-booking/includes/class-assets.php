<?php

class Nextdestina_Booking_Assets {

    public function __construct() {
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_frontend_assets' ), 20 );
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_dashboard_assets' ), 20 );
    }

    /**
     * Enqueue frontend scripts and styles
     */
    public function enqueue_frontend_assets() {

        wp_enqueue_style('flatpickr-css', 'https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css');

        wp_enqueue_style(
            'frontend-style',
            TRAVELER_DASHBOARD_PLUGIN_URL . 'assets/css/frontend-style.css',
            array(),
            TRAVELER_DASHBOARD_VERSION
        );

        // JS

        wp_enqueue_script('flatpickr-js', 'https://cdn.jsdelivr.net/npm/flatpickr', [], null, true);

        wp_enqueue_script('bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js', [], null, true);

        wp_enqueue_script(
            'frontend-script',
            TRAVELER_DASHBOARD_PLUGIN_URL . 'assets/js/frontend-script.js',
            array(),
            TRAVELER_DASHBOARD_VERSION,
            true
        );
    }

    public function enqueue_dashboard_assets(){

        if ( ! get_query_var( 'traveler_dashboard' ) ) {
            return;
        }

        wp_enqueue_style(
            'next-bootstrap',
            TRAVELER_DASHBOARD_PLUGIN_URL . 'assets/css/bootstrap.min.css',
            array(),
            TRAVELER_DASHBOARD_VERSION
        );

        wp_enqueue_style(
            'owl-style',
            TRAVELER_DASHBOARD_PLUGIN_URL . 'assets/css/owl.carousel.min.css',
            array(),
            TRAVELER_DASHBOARD_VERSION
        );

        wp_enqueue_style(
            'owl-theme',
            TRAVELER_DASHBOARD_PLUGIN_URL . 'assets/css/owl.theme.default.min.css',
            array(),
            TRAVELER_DASHBOARD_VERSION
        );

        wp_enqueue_style(
            'next-dashboard',
            TRAVELER_DASHBOARD_PLUGIN_URL . 'assets/css/dashboard.css',
            array(),
            TRAVELER_DASHBOARD_VERSION
        );

        // Load JS

        wp_enqueue_script(
            'nextdestina-jquery',
            TRAVELER_DASHBOARD_PLUGIN_URL . 'assets/js/jquery-3.7.1.min.js',
            array( 'jquery' ),
            TRAVELER_DASHBOARD_VERSION,
            true
        );

        wp_enqueue_script(
            'owl-script',
            TRAVELER_DASHBOARD_PLUGIN_URL . 'assets/js/owl.carousel.min.js',
            array( 'jquery' ),
            TRAVELER_DASHBOARD_VERSION,
            true
        );

        wp_enqueue_script(
            'traveler-dashboard',
            TRAVELER_DASHBOARD_PLUGIN_URL . 'assets/js/dashboard.js',
            array( 'jquery' ),
            TRAVELER_DASHBOARD_VERSION,
            true
        );

        wp_localize_script(
            'traveler-dashboard',
            'travelerDashboard',
            array(
                'ajaxUrl' => admin_url( 'admin-ajax.php' ),
                'nonce'   => wp_create_nonce( 'traveler_dashboard_nonce' ),
                'userId'  => get_current_user_id(),
                'baseUrl' => home_url( '/my-dashboard/' ),
                'strings' => array(
                    'loading'       => __( 'Loading...', 'nextdestina-booking' ),
                    'error'         => __( 'An error occurred.', 'nextdestina-booking' ),
                    'confirmDelete' => __( 'Are you sure you want to delete this?', 'nextdestina-booking' ),
                ),
            )
        );
    }
}
