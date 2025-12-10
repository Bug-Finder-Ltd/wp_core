<?php
namespace RaizenCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Raizen Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Raizen_Review_Box extends Widget_Base {

	public function get_name() {
		return 'next-review';
	}

	public function get_title() {
		return __( 'Review Box', 'raizencore' );
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
		/**
         * Layout Section
         */
        $this->start_controls_section(
            'raizen_layout',
            [
                'label' => esc_html__('Design Layout', 'raizencore'),
            ]
        );
        $this->add_control(
            'raizen_design_style',
            [
                'label' => esc_html__('Select Layout', 'raizencore'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'layout-1' => esc_html__('Layout 1', 'raizencore'),
                    'layout-2' => esc_html__('Layout 2', 'raizencore'),
                    'layout-3' => esc_html__('Layout 3', 'raizencore'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();
		
		$this->start_controls_section(
            'raizen_reviewer_section',
            [
                'label' => __( 'Reviewer Image', 'raizencore' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

		$this->add_control(
			'reviewer_img',
			[
				'label' => esc_html__( 'Add Images', 'raizencore' ),
				'type' => \Elementor\Controls_Manager::GALLERY,
				'show_label' => false,
				'default' => [],
			]
		);

        $this->end_controls_section();

		$this->start_controls_section(
			'text_section',
			[
				'label' => esc_html__( 'Text', 'raizencore' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'avg_rating',
			[
				'label' => esc_html__( 'Avg. Rating', 'raizencore' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '4.5', 'raizencore' ),
				'placeholder' => esc_html__( 'Type your number here', 'raizencore' ),
			]
		);
		$this->add_control(
			'title',
			[
				'label' => esc_html__( 'Title', 'raizencore' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Default title', 'raizencore' ),
				'placeholder' => esc_html__( 'Type your title here', 'raizencore' ),
			]
		);
		$this->add_control(
			'number',
			[
				'label' => esc_html__( 'Number', 'raizencore' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '+880 123 (456) 7890', 'raizencore' ),
				'placeholder' => esc_html__( 'Phone', 'raizencore' ),
			]
		);

		$this->end_controls_section();

		/**
		 * Style section
		 */
		$this->start_controls_section(
			'section_style',
			[
				'label' => __( 'Style', 'raizencore' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'text_transform',
			[
				'label' => __( 'Text Transform', 'raizencore' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => __( 'None', 'raizencore' ),
					'uppercase' => __( 'UPPERCASE', 'raizencore' ),
					'lowercase' => __( 'lowercase', 'raizencore' ),
					'capitalize' => __( 'Capitalize', 'raizencore' ),
				],
				'selectors' => [
					'{{WRAPPER}} .title' => 'text-transform: {{VALUE}};',
				],
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
		$settings = $this->get_settings_for_display();?>

		<?php if ( $settings['raizen_design_style']  == 'layout-1' ): ?>

			<div class="rivew-box style-one">
				<div class="avater-image">
					<ul>
						<?php foreach ( $settings['reviewer_img'] as $image ) { ?>
							<li><a href="#"><img src="<?php echo esc_attr( $image['url'] ); ?>" alt="client"></a></li>
						<?php } ?>
						<li>
							<a href="#" class="client-icon">
								<i class="fa-solid fa-star"></i>
								<?php echo esc_html($settings['avg_rating']); ?>
							</a>
						</li>
					</ul>
				</div>
				<div class="contact">
					<div class="icon">
						<i class="fa-thin fa-phone-volume"></i>
					</div>
					<div class="text">
						<p class="title"><?php echo esc_html($settings['title']); ?></p>
						<p class="number"><?php echo esc_html($settings['number']); ?></p>
					</div>
				</div>
			</div>

		<?php elseif ( $settings['raizen_design_style']  == 'layout-2' ): ?>

			<div class="review-box style-two">
				<div class="avater-image">
					<ul>
						<?php foreach ( $settings['reviewer_img'] as $image ) { ?>
							<li><a href="#"><img src="<?php echo esc_attr( $image['url'] ); ?>" alt="client"></a></li>
						<?php } ?>
					</ul>
				</div>
				<h5 class="title"><?php echo esc_html($settings['title']); ?></h5>
			</div>

		<?php elseif ( $settings['raizen_design_style']  == 'layout-3' ): ?>

			<div class="review-box style-three">
				<div class="avater-image">
					<ul>
						<?php foreach ( $settings['reviewer_img'] as $image ) { ?>
							<li><a href="#"><img src="<?php echo esc_attr( $image['url'] ); ?>" alt="client"></a></li>
						<?php } ?>
					</ul>
				</div>
				<h5 class="title"><?php echo wp_kses_post($settings['title']); ?></h5>
			</div>

		<?php endif; ?>

		<?php
	}
}

$widgets_manager->register( new Raizen_Review_Box() );