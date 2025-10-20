<?php
namespace BwallCore;

use BwallCore\PageSettings\Page_Settings;
use Elementor\Controls_Manager;


/**
 * Class Plugin
 *
 * Main Plugin class
 * @since 1.2.0
 */
class Bwall_Core_Plugin {

	/**
	 * Instance
	 *
	 * @since 1.2.0
	 * @access private
	 * @static
	 *
	 * @var Plugin The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.2.0
	 * @access public
	 *
	 * @return Plugin An instance of the class.
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * Add Category
	 */

    public function bwall_core_elementor_category($manager)
    {

        $categories = [];
		$categories['bwallcore'] =
			[
				'title' => __( 'Element Helper ( Bwall )', 'bwallcore' ),
				'icon'  => 'eicon-banner'
			];

		$old_categories = $manager->get_categories();
		$categories = array_merge($categories, $old_categories);

		$set_categories = function ( $categories ) {
			$this->categories = $categories;
		};

		$set_categories->call( $manager, $categories );
		
    }
				

	/**
	 * widget_scripts
	 *
	 * Load required plugin core files.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function widget_scripts() {
		wp_register_script( 'bwallcore', plugins_url( '/assets/js/hello-world.js', __FILE__ ), [ 'jquery' ], false, true );
	}

	/**
	 * Editor scripts
	 *
	 * Enqueue plugin javascripts integrations for Elementor editor.
	 *
	 * @since 1.2.1
	 * @access public
	 */
	public function editor_scripts() {
		add_filter( 'script_loader_tag', [ $this, 'editor_scripts_as_a_module' ], 10, 2 );

		wp_enqueue_script(
			'bwallcore-editor',
			plugins_url( '/assets/js/editor/editor.js', __FILE__ ),
			[
				'elementor-editor',
			],
			'1.2.1',
			true
		);
	}


	/**
	 * bwall_enqueue_editor_scripts
	 */
    function bwall_enqueue_editor_scripts()
    {
        wp_enqueue_style('bwall-element-addons-editor', BWALL_ADDONS_URL . 'assets/css/editor.css', null, '1.0');
    }
    

	/**
	 * Force load editor script as a module
	 *
	 * @since 1.2.1
	 *
	 * @param string $tag
	 * @param string $handle
	 *
	 * @return string
	 */
	public function editor_scripts_as_a_module( $tag, $handle ) {
		if ( 'bwallcore-editor' === $handle ) {
			$tag = str_replace( '<script', '<script type="module"', $tag );
		}

		return $tag;
	}

	/**
	 * Register Widgets
	 *
	 * Register new Elementor widgets.
	 *
	 * @since 1.2.0
	 * @access public
	 *
	 * @param Widgets_Manager $widgets_manager Elementor widgets manager.
	 */
	public function register_widgets( $widgets_manager ) {
		// Its is now safe to include Widgets files
		foreach($this->bwallcore_widget_list() as $widget_file_name){
			require_once( BWALL_ELEMENTS_PATH . "/{$widget_file_name}.php" );
		}
	}

	public function bwallcore_widget_list() {
		return [
			'hero-banner',
			'about-us',
			'services',
			'why-choose-us',
			'process',
			'bwall-testimonial',
			'blog-post',
			'contact-form',
			'case-study-project',
			'bwall-counter',
			'bwall-faq',
			'service-details',
			'project-details',
			'brand',
			'team'
		];
	}

	/**
	 * Add page settings controls
	 *
	 * Register new settings for a document page settings.
	 *
	 * @since 1.2.1
	 * @access private
	 */
	private function add_page_settings_controls() {
		require_once( __DIR__ . '/page-settings/manager.php' );
		new Page_Settings();
	}


	/**
	 * Register controls
	 *
	 * @param Controls_Manager $controls_Manager
	 */

    public function register_controls(Controls_Manager $controls_Manager)
    {
        include_once(BWALL_ADDONS_DIR . '/controls/bwallgradient.php');
        $bwallgradient = 'BwallCore\Elementor\Controls\Group_Control_BwallGradient';
        $controls_Manager->add_group_control($bwallgradient::get_type(), new $bwallgradient());

        include_once(BWALL_ADDONS_DIR . '/controls/bwallbggradient.php');
        $bwallbggradient = 'BwallCore\Elementor\Controls\Group_Control_BwallBGGradient';
        $controls_Manager->add_group_control($bwallbggradient::get_type(), new $bwallbggradient());
    }


    public function bwall_add_custom_icons_tab($tabs = array()){

        // Append new icons
        $feather_icons = array(
            'feather-activity',
            'feather-airplay',
            'feather-alert-circle',
            'feather-alert-octagon',
            'feather-alert-triangle',
            'feather-align-center',
            'feather-align-justify',
            'feather-align-left',
            'feather-align-right',
        );

        $tabs['bwall-feather-icons'] = array(
            'name' => 'bwall-feather-icons',
            'label' => esc_html__('Bwall - Feather Icons', 'bwallcore'),
            'labelIcon' => 'bwall-icon',
            'prefix' => '',
            'displayPrefix' => 'bwall',
            'url' => BWALL_ADDONS_URL . 'assets/css/feather.css',
            'icons' => $feather_icons,
            'ver' => '1.0.0',
		); 

		// Adding custom icons
		$custom_icons = array(
			'icon-angle-down',
			'icon-angle-left',
			'icon-angle-right',
			'icon-angle-up',
			'icon-arrow-down',
			'icon-arrow-left',
			'icon-arrow-right',
			'icon-arrow-up',
			'icon-busness-idea',
			'icon-busness-mind',
			'icon-calendar-days',
			'icon-check-circle',
			'icon-check',
			'icon-clock',
			'icon-close',
			'icon-comments',
			'icon-desing-tool-pot',
			'icon-dobble-angles-down',
			'icon-dobble-angles-left',
			'icon-dobble-angles-right',
			'icon-dobble-angles-up',
			'icon-envelope',
			'icon-facebook',
			'icon-folder-open',
			'icon-heart',
			'icon-instagram',
			'icon-layout',
			'icon-linkedin-in',
			'icon-location-dot',
			'icon-magnifying-glass',
			'icon-pencil-compus',
			'icon-phone-volume',
			'icon-pinterest-p',
			'icon-play-t',
			'icon-share-nodes',
			'icon-skype',
			'icon-strong-brin',
			'icon-twitter',
			'icon-user'
		  );
		
		$tabs['bwall-custom-icons'] = array(
			'name' => 'bwall-custom-icons',
			'label' => esc_html__('Bwall - Custom Icons', 'bwallcore'),
			'labelIcon' => 'bwall-icon',
			'prefix' => '',
			'displayPrefix' => 'my-icon',
			'url' => BWALL_ADDONS_URL . 'assets/css/bwall-customicon.css',
			'icons' => $custom_icons,
			'ver' => '1.0.0',
		); 

        $feather_icons = array(
	        'angle-up',
	        'check',
	        'times',
	        'calendar',
	        'language',
	        'shopping-cart',
	        'bars',
	        'search',
	        'map-marker',
	        'arrow-right',
	        'arrow-left',
	        'arrow-up',
	        'arrow-down',
	        'angle-right',
	        'angle-left',
	        'angle-up',
	        'angle-down',
	        'phone',
	        'users',
	        'user',
	        'map-marked-alt',
	        'trophy-alt',
	        'envelope',
	        'marker',
	        'globe',
	        'broom',
	        'home',
	        'bed',
	        'chair',
	        'bath',
	        'tree',
	        'laptop-code',
	        'cube',
	        'cog',
	        'play',
	        'trophy-alt',
	        'heart',
	        'truck',
	        'user-circle',
	        'map-marker-alt',
	        'comments',
	         'award',
	        'bell',
	        'book-alt',
	        'book-open',
	        'book-reader',
	        'graduation-cap',
	        'laptop-code',
	        'music',
	        'ruler-triangle',
	        'user-graduate',
	        'microscope',
	        'glasses-alt',
	        'theater-masks',
	        'atom'
        );

        $tabs['bwall-fontawesome-icons'] = array(
            'name' => 'bwall-fontawesome-icons',
            'label' => esc_html__('Bwall - Fontawesome Pro Light', 'bwallcore'),
            'labelIcon' => 'bwall-icon',
            'prefix' => 'fa-',
            'displayPrefix' => 'fal',
            'url' => BWALL_ADDONS_URL . 'assets/css/fontawesome-all.min.css',
            'icons' => $feather_icons,
            'ver' => '1.0.0',
        );        

        return $tabs;
    }


	/**
	 *  Plugin class constructor
	 *
	 * Register plugin action hooks and filters
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function __construct() {

		// Register widget scripts
		add_action( 'elementor/frontend/after_register_scripts', [ $this, 'widget_scripts' ] );

		// Register widgets
		add_action( 'elementor/widgets/register', [ $this, 'register_widgets' ] );

		// Register editor scripts
		add_action( 'elementor/editor/after_enqueue_scripts', [ $this, 'editor_scripts' ] );

		add_action('elementor/elements/categories_registered', [$this, 'bwall_core_elementor_category']);

		// Register custom controls
	    add_action('elementor/controls/controls_registered', [$this, 'register_controls']);

	    add_filter('elementor/icons_manager/additional_tabs', [$this, 'bwall_add_custom_icons_tab']);

	    // $this->bwall_add_custom_icons_tab();

	    add_action('elementor/editor/after_enqueue_scripts', [$this, 'bwall_enqueue_editor_scripts'] );

		$this->add_page_settings_controls();

	}

}

// Instantiate Plugin Class
Bwall_Core_Plugin::instance();