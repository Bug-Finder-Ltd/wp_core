<?php
/**
 * Plugin Activation Handler
 *
 * @package TravelerDashboard
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Activator {

    public static function activate() {

        //Add new role

        if (null === get_role('traveler')) {
            add_role(
                'traveler',
                'Traveler',
                [
                    'read' => true,
                    'edit_posts' => false,
                    'delete_posts' => false,
                ]
            );
        }

        // Payment Method

        $methods = ['Stripe', 'PayPal'];

        foreach ($methods as $method) {
            $query = new WP_Query([
                'post_type'      => 'payment_method',
                'post_status'    => 'any',
                'title'          => $method,
                'posts_per_page' => 1,
            ]);

            if (!$query->have_posts()) {
                $post_id = wp_insert_post([
                    'post_title'  => $method,
                    'post_type'   => 'payment_method',
                    'post_status' => 'publish',
                ]);

                update_post_meta($post_id, '_payment_enabled', '0');
            }
            wp_reset_postdata();
        }

        // Email Template

        $templates = ['Traveler', 'Admin'];

        foreach ($templates as $template) {
            $query = new WP_Query([
                'post_type'      => 'email_template',
                'post_status'    => 'any',
                'title'          => $template,
                'posts_per_page' => 1,
            ]);

            if (!$query->have_posts()) {
                $post_id = wp_insert_post([
                    'post_title'  => $template,
                    'post_type'   => 'email_template',
                    'post_status' => 'publish',
                ]);

                update_post_meta($post_id, '_payment_enabled', '0');
            }
            wp_reset_postdata();
        }

        // Load the CPT class before flushing
        require_once TRAVELER_DASHBOARD_PLUGIN_DIR . 'includes/class-cpt.php';
        $cpt = new Nextdestina_CPT();

        // Load and register endpoints
        self::register_rewrite_rules();
        
        // Create database tables
        self::create_database_tables();

        // Flush rewrite rules
        flush_rewrite_rules();
        
        // Set default options
        add_option( 'traveler_dashboard_version', TRAVELER_DASHBOARD_VERSION );
    }

    /**
     * Register endpoints during activation
     *
     * @since 1.0.0
     */
    private static function register_rewrite_rules() {

        // Create temporary instance to call the rewrite rules method
        $temp_instance = Traveler_Dashboard::get_instance();
        $temp_instance->add_rewrite_rules();

        // Load the user class
        if ( ! class_exists( 'Nextdestina_User' ) ) {
            require_once TRAVELER_DASHBOARD_PLUGIN_DIR . 'user/class-nextdestina-user.php';
        }
        
        // Create instance and register endpoints
        $user_instance = new Nextdestina_User();
        $user_instance->nextdestina_login_endpoint();
        $user_instance->forget_password_endpoint();
        $user_instance->reset_password_endpoint();
        $user_instance->nextdestina_register_endpoint();

        if ( ! class_exists( 'Nextdestina_Public' ) ) {
            require_once TRAVELER_DASHBOARD_PLUGIN_DIR . 'public/class-nextdestina-public.php';
        }

        $public_instance = new Nextdestina_Public();
        $public_instance->nextdestina_booking_endpoint();
    }

    /**
     * Create database tables
     */
    private static function create_database_tables() {
        global $wpdb;
        
        $charset_collate = $wpdb->get_charset_collate();
        
        $ratings_table = $wpdb->prefix . 'tour_ratings';
        $payment_history_table = $wpdb->prefix . 'payment_history';

        $sql_ratings = "CREATE TABLE $ratings_table (
            id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
            tour_id BIGINT(20) UNSIGNED NOT NULL,
            user_id BIGINT(20) UNSIGNED DEFAULT 0,
            rating TINYINT(1) NOT NULL,
            review TEXT DEFAULT NULL,
            status VARCHAR(20) DEFAULT 'approved',
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            PRIMARY KEY (id),
            KEY tour_id (tour_id),
            KEY user_id (user_id),
            KEY status (status)
        ) $charset_collate;";

        $sql_payment = "CREATE TABLE $payment_history_table (
            id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
            booking_id BIGINT(20) UNSIGNED NOT NULL,
            user_id BIGINT(20) UNSIGNED DEFAULT 0,
            transaction_id VARCHAR(255),
            amount_paid DECIMAL(10,2) NOT NULL,
            currency VARCHAR(10) NOT NULL,
            payment_status VARCHAR(50) NOT NULL,
            payment_method VARCHAR(50) DEFAULT 'stripe',
            payment_extra_fields JSON DEFAULT NULL,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (id),
            KEY booking_id (booking_id),
            KEY user_id (user_id),
            KEY transaction_id (transaction_id)
        ) $charset_collate;";
        
        require_once ABSPATH . 'wp-admin/includes/upgrade.php';
        dbDelta( $sql_ratings );
        dbDelta( $sql_payment );
    }

}