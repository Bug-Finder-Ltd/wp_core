<?php
namespace RaizenCore;

use RaizenCore\PageSettings\Page_Settings;
use Elementor\Controls_Manager;


/**
 * Class Plugin
 *
 * Main Plugin class
 * @since 1.2.0
 */
class Raizen_Core_Plugin {

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

    public function raizen_core_elementor_category($manager)
    {

        $categories = [];
		$categories['raizencore'] =
			[
				'title' => __( 'Element Helper ( Raizen )', 'raizencore' ),
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
		wp_register_script( 'raizencore', plugins_url( '/assets/js/hello-world.js', __FILE__ ), [ 'jquery' ], false, true );
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
			'raizencore-editor',
			plugins_url( '/assets/js/editor/editor.js', __FILE__ ),
			[
				'elementor-editor',
			],
			'1.2.1',
			true
		);
	}


	/**
	 * raizen_enqueue_editor_scripts
	 */
    function raizen_enqueue_editor_scripts() {
        wp_enqueue_style('raizen-element-addons-editor', PROTINE_ADDONS_URL . 'assets/css/editor.css', null, '1.0');
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
		if ( 'raizencore-editor' === $handle ) {
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
		foreach($this->raizencore_widget_list() as $widget_file_name){
			require_once( PROTINE_ELEMENTS_PATH . "/{$widget_file_name}.php" );
		}
	}

	public function raizencore_widget_list() {
		return [
			'hero-banner',
			'hero-text',
			'section-title',
			'section-subtitle',
			'heading',
			'cta-area',
			'icon-box',
			'feature-box',
			'feature-list',
			'single-image',
			'button',
			'download-button',
			'review-box',
			'video-icon',
			'video-box',
			'experience-box',
			'experience-list',
			'contact-info-box',
			'about-tab',
			'service-box',
			'service-list',
			'achievement-list',
			'why-choose-us',
			'process',
			'raizen-testimonial',
			'testimonial-box',
			'blog-post',
			'case-study-project',
			'counter-box',
			'raizen-faq',
			'service-details-tab',
			'project-details',
			'brand',
			'team',
			'team-carousel',
			'list-item',
			'social-link',
			'skill-list',
			'instagram-feed',
			'woo-product-grid',
			'video-overlay',
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
        include_once(PROTINE_ADDONS_DIR . '/controls/raizengradient.php');
        $raizengradient = 'RaizenCore\Elementor\Controls\Group_Control_RaizenGradient';
        $controls_Manager->add_group_control($raizengradient::get_type(), new $raizengradient());

        include_once(PROTINE_ADDONS_DIR . '/controls/raizenbggradient.php');
        $raizenbggradient = 'RaizenCore\Elementor\Controls\Group_Control_RaizenBGGradient';
        $controls_Manager->add_group_control($raizenbggradient::get_type(), new $raizenbggradient());
    }


    public function raizen_add_custom_icons_tab($tabs = array()){

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

        $tabs['raizen-feather-icons'] = array(
            'name' => 'raizen-feather-icons',
            'label' => esc_html__('Raizen - Feather Icons', 'raizencore'),
            'labelIcon' => 'raizen-icon',
            'prefix' => '',
            'displayPrefix' => 'raizen',
            'url' => PROTINE_ADDONS_URL . 'assets/css/feather.css',
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
		
		$tabs['raizen-custom-icons'] = array(
			'name' => 'raizen-custom-icons',
			'label' => esc_html__('Raizen - Custom Icons', 'raizencore'),
			'labelIcon' => 'raizen-icon',
			'prefix' => '',
			'displayPrefix' => 'my-icon',
			'url' => PROTINE_ADDONS_URL . 'assets/css/raizen-customicon.css',
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

        $tabs['raizen-fontawesome-icons'] = array(
            'name' => 'raizen-fontawesome-icons',
            'label' => esc_html__('Raizen - Fontawesome Pro Light', 'raizencore'),
            'labelIcon' => 'raizen-icon',
            'prefix' => 'fa-',
            'displayPrefix' => 'fal',
            'url' => PROTINE_ADDONS_URL . 'assets/css/fontawesome-all.min.css',
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

		add_action('elementor/elements/categories_registered', [$this, 'raizen_core_elementor_category']);

		// Register custom controls
	    add_action('elementor/controls/controls_registered', [$this, 'register_controls']);

	    add_filter('elementor/icons_manager/additional_tabs', [$this, 'raizen_add_custom_icons_tab']);

	    // $this->raizen_add_custom_icons_tab();

	    add_action('elementor/editor/after_enqueue_scripts', [$this, 'raizen_enqueue_editor_scripts'] );

		$this->add_page_settings_controls();

	}

}

// Instantiate Plugin Class
Raizen_Core_Plugin::instance();