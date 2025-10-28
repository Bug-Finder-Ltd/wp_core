<?php
/**
 * Plugin Deactivation Handler
 *
 * @package TravelerDashboard
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Deactivator {

    public static function deactivate() {

        remove_role('traveler');

        // Flush rewrite rules
        flush_rewrite_rules();

    }
}