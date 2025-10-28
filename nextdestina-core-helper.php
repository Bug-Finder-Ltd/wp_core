<?php
/**
	* Plugin Name: Nextdestina Core
	* Description: Nextdestina core plugin.
	* Plugin URI:  https://themeforest.net/item/nextdestina-wallpapers-and-painting-services-wordpress-theme/54844757
	* Version:     1.0.0
	* Author:      bug-finder
	* Author URI:  https://themeforest.net/user/bug-finder/portfolio
	* Text Domain: nextdestinacore
	* Elementor tested up to: 3.21.1
	* Elementor Pro tested up to: 3.21.0
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

use Elementor\Controls_Manager;

/**
 * Define
*/
define('NEXTDESTINA_ADDONS_URL', plugins_url('/', __FILE__));
define('NEXTDESTINA_ADDONS_DIR', dirname(__FILE__));
define('NEXTDESTINA_ADDONS_PATH', plugin_dir_path(__FILE__));
define('NEXTDESTINA_ELEMENTS_PATH', NEXTDESTINA_ADDONS_DIR . '/include/elementor');
define('NEXTDESTINA_WIDGET_PATH', NEXTDESTINA_ADDONS_DIR . '/include/widgets');
define('NEXTDESTINA_INCLUDE_PATH', NEXTDESTINA_ADDONS_DIR . '/include');

/**
 * Plugin activation hook
 * The function trigger when the plugin activated.
*/

function nextdestina_activate() {

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
register_activation_hook(__FILE__, 'nextdestina_activate');

/**
 * Plugin deactivation hook
 * The function trigger when the plugin deactivated.
*/

function nextdestina_deactivate() {

}
register_deactivation_hook(__FILE__, 'nextdestina_deactivate');

/**
 * Include all files
*/

include_once(NEXTDESTINA_ADDONS_DIR . '/include/common-functions.php');
include_once(NEXTDESTINA_ADDONS_DIR . '/include/class-ocdi-importer.php');
include_once(NEXTDESTINA_ADDONS_DIR . '/include/allow-svg.php');
include_once(NEXTDESTINA_ADDONS_DIR . '/include/meta-boxes.php');

/**
 * Newsletter
 */
require_once NEXTDESTINA_ADDONS_DIR . '/include/newsletter.php';


/**
 * Nextdestina Custom Widget
*/

include_once(NEXTDESTINA_WIDGET_PATH . '/nextdestina-footer-info.php');
include_once(NEXTDESTINA_WIDGET_PATH . '/nextdestina-footer-social.php');
include_once(NEXTDESTINA_WIDGET_PATH . '/nextdestina-footer-phone.php');
include_once(NEXTDESTINA_WIDGET_PATH . '/nextdestina-footer-email.php');
include_once(NEXTDESTINA_WIDGET_PATH . '/nextdestina-footer-lets-talk.php');
include_once(NEXTDESTINA_WIDGET_PATH . '/nextdestina-footer-subscriber.php');
include_once(NEXTDESTINA_WIDGET_PATH . '/nextdestina-footer-subscriber-2.php');
include_once(NEXTDESTINA_WIDGET_PATH . '/nextdestina-footer-address.php');
include_once(NEXTDESTINA_WIDGET_PATH . '/nextdestina-menu-list.php');
include_once(NEXTDESTINA_WIDGET_PATH . '/nextdestina-footer-logo-info.php');
include_once(NEXTDESTINA_WIDGET_PATH . '/nextdestina-footer-logo-info-2.php');
include_once(NEXTDESTINA_WIDGET_PATH . '/nextdestina-latest-posts-footer.php');
include_once(NEXTDESTINA_WIDGET_PATH . '/nextdestina-blog-post-sidebar.php');
include_once(NEXTDESTINA_WIDGET_PATH . '/nextdestina-sidebar-cat-list.php');
include_once(NEXTDESTINA_WIDGET_PATH . '/nextdestina-sidebar-tag-list.php');
include_once(NEXTDESTINA_WIDGET_PATH . '/nextdestina-nav-menu.php');

/**
 * Nextdestina Scripts
*/

function nextdestina_enqueue_scripts() {
    wp_enqueue_style(
        'elementor-widget',
        plugin_dir_url( __FILE__ ) . 'assets/css/elementor-widget.css',
        array(),
        '1.0.0'
    );
    
    // CSS
    wp_enqueue_style('nouislider', 'https://cdn.jsdelivr.net/npm/nouislider@15.7.0/dist/nouislider.min.css');

    // JS
    wp_enqueue_script('nouislider', 'https://cdn.jsdelivr.net/npm/nouislider@15.7.0/dist/nouislider.min.js', [], null, true);

	wp_enqueue_script( 'swiper-slider', plugin_dir_url( __FILE__ ) . 'assets/js/swiper.min.js', ['jquery'], '1.0', true);
	
	wp_enqueue_script( 'elementor-widget', plugin_dir_url( __FILE__ ) . 'assets/js/elementor-widget.js', ['jquery'], '1.0', true);

    wp_enqueue_script('ajax-filter', plugin_dir_url( __FILE__ ) . 'assets/js/ajax-filter.js', ['jquery'], null, true);
    wp_localize_script('ajax-filter', 'ajaxfilter', [
        'ajax_url' => admin_url('admin-ajax.php')
    ]);

}
add_action( 'wp_enqueue_scripts', 'nextdestina_enqueue_scripts' );

/**
 * Package ajax filter
*/

function filter_tours_ajax() {
    $args = [
        'post_type' => 'tour',
        'posts_per_page' => -1,
        'post_status' => 'publish',
    ];

    // Search Filter

	if (!empty($_POST['keyword'])) {
		$args['s'] = sanitize_text_field($_POST['keyword']);
	}

    // Tour Type Filter (metabox)

    if (!empty($_POST['tour_type'])) {
		$args['meta_query'][] = [
			'key'     => 'tour_type',
			'value'   => $_POST['tour_type'],
			'compare' => 'IN',
		];
	}

	// Duration Filter (metabox)

	if (!empty($_POST['duration'])) {
	    $args['meta_query'][] = [
	        'key'     => 'duration',
	        'value'   => $_POST['duration'],
	        'compare' => 'IN',
	    ];
	}

    // Destination filter (taxonomy)

    if (!empty($_POST['destination'])) {
        $args['tax_query'][] = [
            'taxonomy' => 'destination',
            'field'    => 'slug',
            'terms'    => $_POST['destination'],
        ];
    }

    // Price filter (metabox)

    if (!empty($_POST['min_price'])) {
    	$args['meta_query'][] = [
    		'key'     => 'price',
    		'value'   => intval($_POST['min_price']),
    		'compare' => '>=',
    		'type'    => 'NUMERIC',
    	];
    }

    if (!empty($_POST['max_price'])) {
    	$args['meta_query'][] = [
    		'key'     => 'price',
    		'value'   => intval($_POST['max_price']),
    		'compare' => '<=',
    		'type'    => 'NUMERIC',
    	];
    }

    $query = new WP_Query($args);
    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();
            get_template_part('template-parts/content', 'tour');
        endwhile;
    else :
        echo '<p>No results found.</p>';
    endif;
    wp_die();
}
add_action('wp_ajax_filter_tours', 'filter_tours_ajax');
add_action('wp_ajax_nopriv_filter_tours', 'filter_tours_ajax');

/**
 * Main Nextdestina Core Class
 *
 * The init class that runs the Hello World plugin.
 * Intended To make sure that the plugin's minimum requirements are met.
 *
 * You should only modify the constants to match your plugin's needs.
 *
 * Any custom code should go inside Plugin Class in the plugin.php file.
 * @since 1.2.0
 */
final class Nextdestina_Core {

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
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'nextdestinacore' ),
			'<strong>' . esc_html__( 'Nextdestina Core', 'nextdestinacore' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'nextdestinacore' ) . '</strong>'
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
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'nextdestinacore' ),
			'<strong>' . esc_html__( 'Nextdestina Core', 'nextdestinacore' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'nextdestinacore' ) . '</strong>',
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
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'nextdestinacore' ),
			'<strong>' . esc_html__( 'Nextdestina Core', 'nextdestinacore' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'nextdestinacore' ) . '</strong>',
			self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}
}

// Instantiate Nextdestina_Core.
new Nextdestina_Core();