<?php

if ( !defined( 'ABSPATH' ) ) {
	exit;
}

class Agenvix_OCDI_Demo_Importer {

	public function __construct() {
		add_filter( 'ocdi/import_files', [$this, 'import_files_config'] );
		add_filter( 'ocdi/after_import', [$this, 'ocdi_after_import_setup'] );
		add_filter( 'ocdi/disable_pt_branding', '__return_true' );

		add_action( 'init', [$this, 'agenvix_ocdi_rewrite_flush'] );
	}

	public function import_files_config() {

		$home_prevs = array(
			'provix_demo_home_1' => array(
				'title' => __( 'Creative Agency', 'agenvix-core' ),
				'page'  => __( 'creative-agency', 'agenvix-core' ),
				'screenshot' => plugins_url( 'assets/img/demo/home-4.jpg', dirname(__FILE__) ),
				'preview_link' => 'https://wp-agenvix.bugfinder.app/',
			),
			'provix_demo_home_2' => array(
				'title' => __( 'Digital Agency', 'agenvix-core' ),
				'page'  => __( 'digital-agency', 'agenvix-core' ),
				'screenshot' => plugins_url( 'assets/img/demo/home-5.jpg', dirname(__FILE__) ),
				'preview_link' => 'https://wp-agenvix.bugfinder.app/digital-agency/',
			),
			'provix_demo_home_3' => array(
				'title'        => __( 'Marketing Agency', 'agenvix-core' ),
				'page'         => __( 'marketing-agency', 'agenvix-core' ),
				'screenshot'   => plugins_url( 'assets/img/demo/home-6.jpg', dirname(__FILE__) ),
				'preview_link' => 'https://wp-agenvix.bugfinder.app/marketing-agency/',
			),
			'provix_demo_home_4' => array(
				'title'        => __( 'Business Consult', 'agenvix-core' ),
				'page'         => __( 'business-consult', 'agenvix-core' ),
				'screenshot'   => plugins_url( 'assets/img/demo/home-1.jpg', dirname(__FILE__) ),
				'preview_link' => 'https://wp-agenvix.bugfinder.app/business-consult/',
			),
			'provix_demo_home_5' => array(
				'title'        => __( 'Finance Advisor', 'agenvix-core' ),
				'page'         => __( 'finance-advisor', 'agenvix-core' ),
				'screenshot'   => plugins_url( 'assets/img/demo/home-2.jpg', dirname(__FILE__) ),
				'preview_link' => 'https://wp-agenvix.bugfinder.app/finance-advisor/',
			),
			'provix_demo_home_6' => array(
				'title'        => __( 'IT Solution', 'agenvix-core' ),
				'page'         => __( 'it-solution', 'agenvix-core' ),
				'screenshot'   => plugins_url( 'assets/img/demo/home-3.jpg', dirname(__FILE__) ),
				'preview_link' => 'https://wp-agenvix.bugfinder.app/it-solution/',
			),
			'provix_demo_home_7' => array(
				'title'        => __( 'Life Coach', 'agenvix-core' ),
				'page'         => __( 'life-coach', 'agenvix-core' ),
				'screenshot'   => plugins_url( 'assets/img/demo/home-7.jpg', dirname(__FILE__) ),
				'preview_link' => 'https://wp-agenvix.bugfinder.app/life-coach/',
			),
			'provix_demo_home_8' => array(
				'title'        => __( 'Tech Agency', 'agenvix-core' ),
				'page'         => __( 'tech-agency', 'agenvix-core' ),
				'screenshot'   => plugins_url( 'assets/img/demo/home-8.jpg', dirname(__FILE__) ),
				'preview_link' => 'https://wp-agenvix.bugfinder.app/tech-agency/',
			),
		);

		$config = [];

		$import_path = trailingslashit( PROTINE_ADDONS_PATH ) . 'admin/demo-data/';

		foreach ( $home_prevs as $key => $prev ) {

            $contents_demo = $import_path . 'contents-demo.xml';
            $widget_settings = $import_path . 'widget-settings.wie';
            $customizer_data = $import_path . 'customizer-data.dat';

            $config[] = [
                'import_file_id'               => $key,
                'import_page_name'             => $prev['page'],
                'import_file_name'             => $prev['title'],
                'local_import_file'            => $contents_demo,
                'local_import_widget_file'     => $widget_settings,
                'local_import_customizer_file' => $customizer_data,
                'import_preview_image_url'     => $prev['screenshot'],
                'preview_url'                  => $prev['preview_link'],
                'import_notice'                => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'agenvix-core' ),
            ];
		}

		return $config;
	}

    public function ocdi_after_import_setup( $selected_file ) {
        
        $this->assign_menu_to_location();
        $this->assign_frontpage_id( $selected_file );
        $this->update_permalinks();
        $this->set_elementor_settings();
        update_option( 'basa_ocdi_importer_flash', true );
    }

    private function assign_menu_to_location() {

        $main_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );

        set_theme_mod( 'nav_menu_locations', [
            'main-menu' => $main_menu->term_id,
        ] );
    }

    private function assign_frontpage_id( $selected_import ) {

        $front_page = get_page_by_path( 'creative-agency', OBJECT, 'page' );
        $blog_page = get_page_by_path( 'blog-grid', OBJECT, 'page' );

        update_option( 'show_on_front', 'page' );
        update_option( 'page_on_front', $front_page->ID );
        update_option( 'page_for_posts', $blog_page->ID );
    }

    private function set_elementor_settings() {
        // Set container width
        $kit_id = get_option( 'elementor_active_kit' );

        if ( $kit_id ) {
            $settings = get_post_meta( $kit_id, '_elementor_page_settings', true );

            if ( ! is_array( $settings ) ) {
                $settings = [];
            }

            $settings['container_width'] = [
                'unit' => 'px',
                'size' => 1340,
            ];

            update_post_meta( $kit_id, '_elementor_page_settings', $settings );
        }

        // Disable inline font icons
        update_option( 'elementor_experiment-e_font_icon_svg', 'inactive' );
    }

    private function update_permalinks() {
        update_option( 'permalink_structure', '/%postname%/' );
    }

    public function agenvix_ocdi_rewrite_flush() {

        if ( get_option( 'basa_ocdi_importer_flash' ) == true ) {
            flush_rewrite_rules();
            delete_option( 'basa_ocdi_importer_flash' );
        }
    }
}

new Agenvix_OCDI_Demo_Importer;
