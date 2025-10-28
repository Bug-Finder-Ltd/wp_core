<?php
// Exit if accessed directly
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    exit;
}

global $wpdb;

// Drop custom tables
$wpdb->query( "DROP TABLE IF EXISTS {$wpdb->prefix}tour_ratings" );

$wpdb->query( "DROP TABLE IF EXISTS {$wpdb->prefix}payment_history" );

