<?php
/**
	* Plugin Name: Zupet Core
	* Description: Zupet core plugin.
	* Plugin URI:  https://themeforest.net/item/zupet-wallpapers-and-painting-services-wordpress-theme/54844757
	* Version:     1.0.0
	* Author:      bug-finder
	* Author URI:  https://themeforest.net/user/bug-finder/portfolio
	* Text Domain: zupetcore
	* Elementor tested up to: 3.21.1
	* Elementor Pro tested up to: 3.21.0
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

use Elementor\Controls_Manager;

/**
 * Define
*/
define('PROTINE_ADDONS_URL', plugins_url('/', __FILE__));
define('PROTINE_ADDONS_DIR', dirname(__FILE__));
define('PROTINE_ADDONS_PATH', plugin_dir_path(__FILE__));
define('PROTINE_ELEMENTS_PATH', PROTINE_ADDONS_DIR . '/include/elementor');
define('PROTINE_WIDGET_PATH', PROTINE_ADDONS_DIR . '/include/widgets');
define('PROTINE_INCLUDE_PATH', PROTINE_ADDONS_DIR . '/include');

/**
 * Plugin activation hook
 * The function trigger when the plugin activated.
*/

function zupet_activate() {

    global $wpdb;
    $table_name      = $wpdb->prefix . 'nd_newsletter';
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        email varchar(255) NOT NULL,
        subscribed_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY  (id),
        UNIQUE KEY email (email)
    ) $charset_collate;";

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta( $sql );
}
register_activation_hook(__FILE__, 'zupet_activate');

/**
 * Plugin deactivation hook
 * The function trigger when the plugin deactivated.
*/

function zupet_deactivate() {

}
register_deactivation_hook(__FILE__, 'zupet_deactivate');

/**
 * Include all files
*/

include_once(PROTINE_ADDONS_DIR . '/include/common-functions.php');
include_once(PROTINE_ADDONS_DIR . '/include/class-ocdi-importer.php');
include_once(PROTINE_ADDONS_DIR . '/include/allow-svg.php');
include_once(PROTINE_ADDONS_DIR . '/include/meta-boxes.php');

/**
 * Newsletter
 */
require_once PROTINE_ADDONS_DIR . '/include/newsletter.php';

/**
 * Woo Wishlist
 */
require_once PROTINE_ADDONS_DIR . '/include/wishlist-handler.php';

/**
 * Zupet Custom Widget
*/

include_once(PROTINE_WIDGET_PATH . '/zupet-footer-info.php');
include_once(PROTINE_WIDGET_PATH . '/zupet-footer-social.php');
include_once(PROTINE_WIDGET_PATH . '/zupet-footer-phone.php');
include_once(PROTINE_WIDGET_PATH . '/zupet-footer-email.php');
include_once(PROTINE_WIDGET_PATH . '/zupet-footer-lets-talk.php');
include_once(PROTINE_WIDGET_PATH . '/zupet-footer-subscriber.php');
include_once(PROTINE_WIDGET_PATH . '/zupet-footer-subscriber-2.php');
include_once(PROTINE_WIDGET_PATH . '/zupet-footer-address.php');
include_once(PROTINE_WIDGET_PATH . '/zupet-menu-list.php');
include_once(PROTINE_WIDGET_PATH . '/zupet-footer-logo-info.php');
include_once(PROTINE_WIDGET_PATH . '/zupet-footer-logo-info-2.php');
include_once(PROTINE_WIDGET_PATH . '/zupet-latest-posts-footer.php');
include_once(PROTINE_WIDGET_PATH . '/zupet-blog-post-sidebar.php');
include_once(PROTINE_WIDGET_PATH . '/zupet-sidebar-cat-list.php');
include_once(PROTINE_WIDGET_PATH . '/zupet-sidebar-tag-list.php');
include_once(PROTINE_WIDGET_PATH . '/zupet-nav-menu.php');

include_once(PROTINE_WIDGET_PATH . '/category-filter.php');
include_once(PROTINE_WIDGET_PATH . '/price-slider.php');

/**
 * Zupet Scripts
*/

function zupet_enqueue_scripts() {

	wp_enqueue_style( 'jquery-ui', plugin_dir_url( __FILE__ ) . 'assets/css/jquery-ui.css', array(), '1.0.0' );

	wp_enqueue_style( 'elementor-widget', plugin_dir_url( __FILE__ ) . 'assets/css/elementor-widget.css', array(), '1.0.0' );

	wp_enqueue_style( 'zupet-icon', plugin_dir_url( __FILE__ ) . 'assets/css/zupet-icon.css', array(), '1.0.0' );

	// JS

	wp_enqueue_script('jquery-ui-slider');

	wp_enqueue_script( 'gsap-js', plugin_dir_url( __FILE__ ) . 'assets/js/gsap.min.js', array(), '3.13.0', true );
	wp_enqueue_script( 'scroll-trigger', plugin_dir_url( __FILE__ ) . 'assets/js/ScrollTrigger.min.js', array('gsap-js'), '3.13.0', true );

    wp_enqueue_script( 'scroll-smoother', plugin_dir_url( __FILE__ ) . 'assets/js/ScrollSmoother.min.js', array('gsap-js'), '3.13.0', true );

    wp_enqueue_script( 'split-type', plugin_dir_url( __FILE__ ) . 'assets/js/SplitType.min.js', array(), '0.3.4', true );
    wp_enqueue_script( 'circletype-type', plugin_dir_url( __FILE__ ) . 'assets/js/circletype.min.js', array(), '2.3.0', true );

    wp_enqueue_script( 'split-text', plugin_dir_url( __FILE__ ) . 'assets/js/SplitText.min.js', array(), '3.13.0', true );

    wp_enqueue_script( 'custom-gsap', plugin_dir_url( __FILE__ ) . 'assets/js/custom-gsap.js', array('gsap-js'), false, true);

	wp_enqueue_script( 'elementor-widget', plugin_dir_url( __FILE__ ) . 'assets/js/elementor-widget.js', ['jquery'], '1.0', true);

    wp_enqueue_script('ajax-filter', plugin_dir_url( __FILE__ ) . 'assets/js/ajax-filter.js', ['jquery'], null, true);
    
    wp_localize_script('ajax-filter', 'woocommerce_params', [
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce'    => wp_create_nonce('zupet_filter_products_nonce'),
    ]);

	wp_enqueue_script('wishlist-script', plugin_dir_url( __FILE__ ) . 'assets/js/woo-wishlist.js', ['jquery'], null, true);

	wp_localize_script('wishlist-script', 'wooWishlist', array(
		'ajax_url' => admin_url('admin-ajax.php'),
		'nonce'    => wp_create_nonce('woo_wishlist_nonce')
	));

}
add_action( 'wp_enqueue_scripts', 'zupet_enqueue_scripts' );

/**
 * Admin Scripts
*/

function zupetcore_admin_scripts() {
	wp_enqueue_style( 'admin-script', plugin_dir_url( __FILE__ ) . 'assets/css/zupet-admin.css', array(), '1.0.0' );
}
add_action( 'admin_enqueue_scripts', 'zupetcore_admin_scripts' );

/**
 * Main Zupet Core Class
 *
 * The init class that runs the Hello World plugin.
 * Intended To make sure that the plugin's minimum requirements are met.
 *
 * You should only modify the constants to match your plugin's needs.
 *
 * Any custom code should go inside Plugin Class in the plugin.php file.
 * @since 1.2.0
 */
final class Zupet_Core {

	/**
	 * Plugin Version
	 *
	 * @since 1.0.0
	 * @var string The plugin version.
	 */
	const VERSION = '1.0.0';

	/**
	 * Minimum Elementor Version
	 *
	 * @since 1.2.0
	 * @var string Minimum Elementor version required to run the plugin.
	 */
	const MINIMUM_ELEMENTOR_VERSION = '3.0.0';

	/**
	 * Minimum PHP Version
	 *
	 * @since 1.2.0
	 * @var string Minimum PHP version required to run the plugin.
	 */
	const MINIMUM_PHP_VERSION = '7.0';

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function __construct() {

		// Init Plugin
		add_action( 'plugins_loaded', array( $this, 'init' ) );
	}

	/**
	 * Initialize the plugin
	 *
	 * Validates that Elementor is already loaded.
	 * Checks for basic plugin requirements, if one check fail don't continue,
	 * if all check have passed include the plugin class.
	 *
	 * Fired by `plugins_loaded` action hook.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function init() {

		// Check if Elementor installed and activated
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', array( $this, 'admin_notice_missing_main_plugin' ) );
			return;
		}

		// Check for required Elementor version
		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', array( $this, 'admin_notice_minimum_elementor_version' ) );
			return;
		}

		// Check for required PHP version
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', array( $this, 'admin_notice_minimum_php_version' ) );
			return;
		}

	
		// Once we get here, We have passed all validation checks so we can safely include our plugin
		require_once( 'plugin.php' );
	}


	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have Elementor installed or activated.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_missing_main_plugin() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor */
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'zupetcore' ),
			'<strong>' . esc_html__( 'Zupet Core', 'zupetcore' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'zupetcore' ) . '</strong>'
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required Elementor version.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_minimum_elementor_version() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'zupetcore' ),
			'<strong>' . esc_html__( 'Zupet Core', 'zupetcore' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'zupetcore' ) . '</strong>',
			self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required PHP version.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_minimum_php_version() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'zupetcore' ),
			'<strong>' . esc_html__( 'Zupet Core', 'zupetcore' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'zupetcore' ) . '</strong>',
			self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}
}

// Instantiate Zupet_Core.
new Zupet_Core();