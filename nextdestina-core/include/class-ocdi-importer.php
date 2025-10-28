<?php

if ( !defined( 'ABSPATH' ) ) {
    exit;
}

class Nextdestina_OCDI_Demo_Importer {

    public function __construct() {
        add_filter( 'ocdi/import_files', [$this, 'import_files_config'] );
        add_filter( 'ocdi/after_import', [$this, 'ocdi_after_import_setup'] );
        add_filter( 'ocdi/disable_pt_branding', '__return_true' );
        
        add_filter( 'ocdi/regenerate_thumbnails_in_content_import', '__return_false' );

        add_action( 'init', [$this, 'nextdestina_ocdi_rewrite_flush'] );
    }

    public function import_files_config() {

		$home_prevs = array(
			'nextdestina_demo_home_1' => array(
				'title' => __( 'Home 1', 'nextdestinacore' ),
				'page'  => __( 'home-1', 'nextdestinacore' ),
				'screenshot' => plugins_url( 'assets/img/demo/home-1.png', dirname(__FILE__) ),
				'preview_link' => 'https://wp-next-destina.bugfinder.app/',
			),
			'nextdestina_demo_home_2' => array(
				'title' => __( 'Home 2', 'nextdestinacore' ),
				'page'  => __( 'home-2', 'nextdestinacore' ),
				'screenshot' => plugins_url( 'assets/img/demo/home-2.png', dirname(__FILE__) ),
				'preview_link' => 'https://wp-next-destina.bugfinder.app/home-2/',
			),
		);

        $config = [];

        $import_path = trailingslashit( NEXTDESTINA_ADDONS_PATH ) . 'admin/demo-data/';
        
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
                'import_notice'                => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'nextdestinacore' ),
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
        
        flush_rewrite_rules();
    }

    private function assign_menu_to_location() {

        $main_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );

        set_theme_mod( 'nav_menu_locations', [
            'main-menu' => $main_menu->term_id,
        ] );
    }

    private function assign_frontpage_id( $selected_import ) {

        $front_page = get_page_by_path( 'home-1', OBJECT, 'page' );
        $blog_page = get_page_by_path( 'blog', OBJECT, 'page' );

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
                'size' => 1470,
            ];

            update_post_meta( $kit_id, '_elementor_page_settings', $settings );
        }

        // Disable inline font icons
        update_option( 'elementor_experiment-e_font_icon_svg', 'inactive' );
    }

    private function update_permalinks() {
        update_option( 'permalink_structure', '/%postname%/' );
    }

    public function nextdestina_ocdi_rewrite_flush() {
        
        if ( get_option( 'basa_ocdi_importer_flash' ) == true ) {
            flush_rewrite_rules();
            delete_option( 'basa_ocdi_importer_flash' );
        }
    }
}

new Nextdestina_OCDI_Demo_Importer;
