<?php

/**
 * The public-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-specific stylesheet and JavaScript.
 *
 * @package    Nextdestina Booking
 * @subpackage nextdestina-booking/public
 * @author     Bug Finder <atikulislam92@mail.com>
 */

class Nextdestina_Public {

	public function __construct() {
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_public_assets' ) );

		add_action( 'wp_ajax_search_tours_and_destinations', array( $this, 'nextdestina_ajax_search_tours_dest' ) );
		add_action( 'wp_ajax_nopriv_search_tours_and_destinations', array( $this, 'nextdestina_ajax_search_tours_dest' ) );

        add_action( 'init', array( $this, 'nextdestina_booking_endpoint' ) );
        add_filter( 'template_include', array( $this, 'nextdestina_booking_virtual_template' ) );
	}

	public function enqueue_public_assets() {

		wp_enqueue_style(
            'notiflix',
            TRAVELER_DASHBOARD_PLUGIN_URL . 'public/assets/css/notiflix.min.css',
            false,
            '3.2.8'
        );

        wp_enqueue_style(
            'public-style',
            TRAVELER_DASHBOARD_PLUGIN_URL . 'public/assets/css/public-style.css',
            false,
            TRAVELER_DASHBOARD_VERSION
        );

		wp_enqueue_script(
			'notiflix',
			TRAVELER_DASHBOARD_PLUGIN_URL . 'public/assets/js/notiflix.min.js',
			array(),
			'3.2.8',
			true
		);

        wp_enqueue_script(
            'public-script',
            TRAVELER_DASHBOARD_PLUGIN_URL . 'public/assets/js/public-script.js',
            array(),
            TRAVELER_DASHBOARD_VERSION,
            true
        );

		wp_localize_script('public-script', 'PublicAjax', [
			'ajax_url' => admin_url('admin-ajax.php'),
			'nonce'    => wp_create_nonce('tour_search_nonce')
		]);
        
	}

	/**
     * Search Suggestion
     */

    public function nextdestina_ajax_search_tours_dest() {
        check_ajax_referer('tour_search_nonce', 'nonce');

        $keyword = sanitize_text_field($_POST['keyword']);
        $results = [];

        // Search Tour Titles with Thumbnails
        $tour_query = new WP_Query([
            'post_type'      => 'tour',
            'post_status'    => 'publish',
            'posts_per_page' => -1,
            's'              => $keyword,
        ]);

        if ($tour_query->have_posts()) {
            foreach ($tour_query->get_posts() as $post) {
                $results[] = [
                    'type'      => 'tour',
                    'title'     => get_the_title($post),
                    'thumbnail' => get_the_post_thumbnail_url($post->ID, 'thumbnail'),
                ];
            }
        }

        // Destination Terms (no thumbnail by default, unless you use ACF or custom fields)
        $destination_terms = get_terms([
            'taxonomy'   => 'destination',
            'hide_empty' => false,
            'name__like' => $keyword,
            'number'     => 5,
        ]);

        if (!is_wp_error($destination_terms)) {
            foreach ($destination_terms as $term) {
                
                $image = get_term_meta($term->term_id, 'destination_image', true);

                $results[] = [
                    'type'      => 'destination',
                    'title'     => $term->name,
                    'thumbnail' => $image ?: '',
                ];
            }
        }

        if (!empty($results)) {
            wp_send_json_success($results);
        } else {
            wp_send_json_error();
        }
    }

    /*
     * Tour Booking Form
     */

    public function nextdestina_booking_endpoint() {
        add_rewrite_rule('^book-tour/?$', 'index.php?nextdestina_booking_page=1', 'top');
        add_rewrite_tag('%nextdestina_booking_page%', '1');
    }

    public function nextdestina_booking_virtual_template($template) {
        if (get_query_var('nextdestina_booking_page') == '1') {
            return plugin_dir_path(__FILE__) . 'templates/tour-booking-form.php';
        }
        return $template;
    }

}