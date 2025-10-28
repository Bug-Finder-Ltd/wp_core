<?php
/**
 * Template Loader Class for Tour Booking Plugin
 * 
 */

class Tour_Booking_Template_Loader {

    /**
     * Constructor
     */
	public function __construct() {

		add_filter('single_template', array($this, 'tour_booking_single_template'));

	}

    /**
     * Load single tour template
     */
	function tour_booking_single_template($single) {
		global $post;

		if ($post->post_type === 'tour') {
			$plugin_template = plugin_dir_path(__FILE__) . '../templates/tour-details.php';
			if (file_exists($plugin_template)) {
				return $plugin_template;
			}
		}

		return $single;
	}

}

