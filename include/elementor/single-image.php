<?php

namespace ProvixCore\Widgets;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Provix Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Provix_Image extends \Elementor\Widget_Base {


	public function get_name() {
		return 'next-image';
	}

	public function get_title() {
		return __( 'Image', 'agenvix-core' );
	}

	public function get_icon() {
		return 'provix-icon';
	}

	public function get_categories() {
		return array( 'agenvix-core' );
	}

	public function get_script_depends() {
		return array( 'agenvix-core' );
	}

	protected function register_controls() {

		/**
		 * Layout section
		 */

		$this->start_controls_section(
			'provix_layout',
			array(
				'label' => esc_html__( 'Design Layout', 'agenvix-core' ),
			)
		);
		$this->add_control(
			'provix_design_style',
			array(
				'label'   => esc_html__( 'Select Layout', 'agenvix-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'layout-1' => esc_html__( 'Layout 1', 'agenvix-core' ),
					'layout-2' => esc_html__( 'Layout 2', 'agenvix-core' ),
					'layout-3' => esc_html__( 'Layout 3', 'agenvix-core' ),
					'layout-4' => esc_html__( 'Layout 4', 'agenvix-core' ),
				),
				'default' => 'layout-1',
			)
		);

		$this->end_controls_section();

		/**
		 * Image section
		 */
		$this->start_controls_section(
			'provix_image',
			array(
				'label' => esc_html__( 'Image', 'agenvix-core' ),
			)
		);
		$this->add_control(
			'provix_image_one',
			array(
				'label'   => esc_html__( 'Image One', 'agenvix-core' ),
				'type'    => \Elementor\Controls_Manager::MEDIA,
				'default' => array(
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				),
			)
		);

		$this->add_control(
			'provix_image_two',
			array(
				'label'   => esc_html__( 'Image Two', 'agenvix-core' ),
				'type'    => \Elementor\Controls_Manager::MEDIA,
				'default' => array(
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				),
			)
		);

		$this->add_control(
			'provix_image_three',
			array(
				'label'   => esc_html__( 'Image Three', 'agenvix-core' ),
				'type'    => \Elementor\Controls_Manager::MEDIA,
				'default' => array(
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				),
			)
		);

		$this->add_group_control(
			\Elementor\Group_Control_Image_Size::get_type(),
			array(
				'name'    => 'provix_image_size',
				'default' => 'full',
				'exclude' => array(
					'custom',
				),
			)
		);
		$this->add_control(
			'provix_image_overlap',
			array(
				'label'        => esc_html__( 'Image overlap to top?', 'agenvix-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'agenvix-core' ),
				'label_off'    => esc_html__( 'No', 'agenvix-core' ),
				'return_value' => 'yes',
				'default'      => 'no',
			)
		);
		$this->add_responsive_control(
			'provix_image_height',
			array(
				'label'      => esc_html__( 'Image Height', 'agenvix-core' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 1,
					),
					'%'  => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .provix-overlap img' => 'height: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'provix_image_overlap_x',
			array(
				'label'      => esc_html__( 'Image overlap position', 'agenvix-core' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 1,
					),
					'%'  => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .provix-overlap img' => 'margin-top: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'provix_image_overlap' => 'yes',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'rotating_circle_section',
			[
				'label' => esc_html__( 'Rotating Circle', 'agenvix-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'circle_image1',
			[
				'label' => esc_html__( 'Image 1', 'agenvix-core' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->add_control(
			'circle_image2',
			[
				'label' => esc_html__( 'Image 2', 'agenvix-core' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->end_controls_section();
		
		/**
		 * Style section
		 */
		$this->start_controls_section(
			'general_style',
			array(
				'label' => __( 'General', 'agenvix-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'text_align',
			[
				'label' => esc_html__('Alignment', 'agenvix-core'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__('Left', 'agenvix-core'),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__('Center', 'agenvix-core'),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__('Right', 'agenvix-core'),
						'icon' => 'eicon-text-align-right',
					],
				],
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .image-box' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'image1_style',
			array(
				'label' => __( 'Image 1', 'agenvix-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			array(
				'name'     => 'image1_border',
				'selector' => '{{WRAPPER}} .image-box .image',
			)
		);
		$this->add_control(
			'image1_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'agenvix-core' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em', 'rem', 'custom' ),
				'selectors'  => array(
					'{{WRAPPER}} .image-box .image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->end_controls_section();
	}

	/**
	 * Render the widget ouprovixut on the frontend.
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

		<?php if ( $settings['provix_design_style'] == 'layout-1' ) : ?>

			<?php
			if ( ! empty( $settings['provix_image_one']['url'] ) ) {
				$image_1 = ! empty( $settings['provix_image_one']['id'] ) ? wp_get_attachment_image_url( $settings['provix_image_one']['id'], '' ) : $settings['provix_image_one']['url'];
			}
			?>

			<div class="image-box style-one">
				<div class="image feature-image">
					<?php if ( $settings['provix_image_one']['url'] || $settings['provix_image_one']['id'] ) : ?>
						<img src="<?php echo esc_url( $image_1 ); ?>" alt="image">
					<?php endif; ?>
					<div class="overlay-top"></div>
					<div class="overlay-bottom"></div>
				</div>
			</div>

		<?php elseif ( $settings['provix_design_style'] == 'layout-2' ) : ?>

			<?php
			if ( ! empty( $settings['provix_image_one']['url'] ) ) {
				$image_1 = ! empty( $settings['provix_image_one']['id'] ) ? wp_get_attachment_image_url( $settings['provix_image_one']['id'], '' ) : $settings['provix_image_one']['url'];
			}
			?>

			<div class="image-box style-two">
				<div class="image feature-image image-anim-2">
					<?php if ( $settings['provix_image_one']['url'] || $settings['provix_image_one']['id'] ) : ?>
						<img src="<?php echo esc_url( $image_1 ); ?>" alt="image">
					<?php endif; ?>
				</div>
			</div>

		<?php elseif ( $settings['provix_design_style'] == 'layout-3' ) : ?>
			<?php
			if ( ! empty( $settings['provix_image_one']['url'] ) ) {
				$image_1 = ! empty( $settings['provix_image_one']['id'] ) ? wp_get_attachment_image_url( $settings['provix_image_one']['id'], '' ) : $settings['provix_image_one']['url'];
			}
			?>
			<div class="image-box style-three">
				<div class="image-one wow zoomIn" data-wow-delay="00ms" data-wow-duration="2000ms">
					<img src="<?php echo esc_url( $image_1 ); ?>" alt="image">
				</div>
			</div>

		<?php elseif ( $settings['provix_design_style'] == 'layout-4' ) :
			if (! empty($settings['provix_image_one']['url'])) {
				$image1     = ! empty($settings['provix_image_one']['id']) ? wp_get_attachment_image_url($settings['provix_image_one']['id'], '') : $settings['provix_image_one']['url'];
				$image1_alt = get_post_meta($settings['provix_image_one']['id'], '_wp_attachment_image_alt', true);
			}
			if (! empty($settings['circle_image1']['url'])) {
				$circle_image1     = ! empty($settings['circle_image1']['id']) ? wp_get_attachment_image_url($settings['circle_image1']['id'], '') : $settings['circle_image1']['url'];
				$circle_image1_alt = get_post_meta($settings['circle_image1']['id'], '_wp_attachment_image_alt', true);
			}
			if (! empty($settings['circle_image2']['url'])) {
				$circle_image2     = ! empty($settings['circle_image2']['id']) ? wp_get_attachment_image_url($settings['circle_image2']['id'], '') : $settings['circle_image2']['url'];
				$circle_image2_alt = get_post_meta($settings['circle_image2']['id'], '_wp_attachment_image_alt', true);
			}
			?>

			<div class="image-box style-four">
				<div class="image-one">
					<img src="<?php echo esc_url($image1); ?>" alt="image">
				</div>

				<div class="rotating-image">
					<?php if( !empty($circle_image1) ) : ?>
						<div class="circle-image1">
							<img src="<?php echo esc_url($circle_image1); ?>" alt="image">
						</div>
					<?php endif; ?>

					<?php if( !empty($circle_image2) ) : ?>
						<div class="circle-image2 rotate15">
							<img src="<?php echo esc_url($circle_image2); ?>" alt="image">
						</div>
					<?php endif; ?>
				</div>
			</div>

		<?php endif; ?>

		<?php
	}
}

$widgets_manager->register( new Provix_Image() );
