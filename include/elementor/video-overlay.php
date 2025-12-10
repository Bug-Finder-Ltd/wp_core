<?php
namespace RaizenCore\Widgets;

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Raizen Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Video_Overlay extends \Elementor\Widget_Base {

	public function get_name() {
		return 'video-overlay';
	}

	public function get_title() {
		return __( 'BG Video Overlay', 'raizencore' );
	}

	public function get_icon() {
		return 'raizen-icon';
	}

	public function get_categories() {
		return [ 'raizencore' ];
	}

	public function get_script_depends() {
		return [ 'raizencore' ];
	}

	protected function register_controls() {
        
        $this->start_controls_section(
            'video_section',
            [
                'label' => esc_html__( 'Video', 'raizencore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
		$this->add_control(
			'important_notice',
			[
				'type' => \Elementor\Controls_Manager::NOTICE,
				'notice_type' => 'warning',
				'dismissible' => false,
				'heading' => esc_html__( 'Important Notice', 'raizencore' ),
				'content' => esc_html__( 'Go to "Advanced" tab and add a CSS ID "video-overlay" to make the video fit properly', 'raizencore' ),
			]
		);
        $this->add_control(
			'bg_video',
			[
				'label' => esc_html__( 'Choose Video', 'raizencore' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'media_types' => [ 'video' ],
				'placeholder' => __( 'Select or Upload a Video', 'raizencore' ),
			]
		);
        
        $this->end_controls_section();

	}

	/**
	 * Render the widget ouraizenut on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
        ?>
            
			<div class="video-wrap">
				<video autoplay loop muted playsinline class="bg-video">
                    <source src="<?php echo esc_url($settings['bg_video']['url']); ?>" type="video/webm">
				</video>
			</div>
            
        <?php 
	}
}

$widgets_manager->register( new Video_Overlay() );