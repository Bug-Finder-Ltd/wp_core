<?php

namespace ProvixCore\Widgets;

use Elementor\Controls_Manager;

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
class Provix_Icon_Box extends \Elementor\Widget_Base {


	public function get_name() {
		return 'next-iconbox';
	}

	public function get_title() {
		return __( 'Icon Box', 'agenvix-core' );
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
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'layout-1' => esc_html__( 'Layout 1', 'agenvix-core' ),
					'layout-2' => esc_html__( 'Layout 2', 'agenvix-core' ),
					'layout-3' => esc_html__( 'Layout 3', 'agenvix-core' ),
					'layout-4' => esc_html__( 'Layout 4', 'agenvix-core' ),
					'layout-5' => esc_html__( 'Layout 5', 'agenvix-core' ),
					'layout-6' => esc_html__( 'Layout 6', 'agenvix-core' ),
					'layout-7' => esc_html__( 'Layout 7', 'agenvix-core' ),
					'layout-8' => esc_html__( 'Layout 8', 'agenvix-core' ),
				),
				'default' => 'layout-1',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_icon',
			array(
				'label' => esc_html__( 'Icon', 'agenvix-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'icon',
			array(
				'label'       => esc_html__( 'Icon', 'agenvix-core' ),
				'type'        => \Elementor\Controls_Manager::ICONS,
				'default'     => array(
					'value'   => 'fas fa-circle',
					'library' => 'fa-solid',
				),
				'recommended' => array(
					'fa-solid'   => array(
						'circle',
						'dot-circle',
						'square-full',
					),
					'fa-regular' => array(
						'circle',
						'dot-circle',
						'square-full',
					),
				),
			)
		);
		$this->add_control(
			'icon_image',
			array(
				'label'   => esc_html__( 'Choose Image', 'agenvix-core' ),
				'type'    => \Elementor\Controls_Manager::MEDIA,
				'default' => array(
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				),
			)
		);
		$this->end_controls_section();

		/**
		 * Title and content section
		 */
		$this->start_controls_section(
			'provix_section_title',
			array(
				'label' => esc_html__( 'Title & Content', 'agenvix-core' ),
			)
		);

		$this->add_control(
			'provix_title',
			array(
				'label'       => esc_html__( 'Title', 'agenvix-core' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Title Here', 'agenvix-core' ),
				'placeholder' => esc_html__( 'Type title', 'agenvix-core' ),
				'label_block' => true,
			)
		);

		$this->add_control(
			'provix_title_color',
			array(
				'label'     => __( 'Title Color', 'agenvix-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .section-title h3' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'provix_description',
			array(
				'label'       => esc_html__( 'Description', 'agenvix-core' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => esc_html__( 'Provix section description here', 'agenvix-core' ),
				'placeholder' => esc_html__( 'Type section description here', 'agenvix-core' ),
			)
		);

		$this->end_controls_section();

		/**
		 * Style section
		 */
		$this->start_controls_section(
			'general_section',
			array(
				'label' => __( 'General', 'agenvix-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'text_align',
			array(
				'label'     => esc_html__( 'Alignment', 'agenvix-core' ),
				'type'      => \Elementor\Controls_Manager::CHOOSE,
				'options'   => array(
					'left'   => array(
						'title' => esc_html__( 'Left', 'agenvix-core' ),
						'icon'  => 'eicon-text-align-left',
					),
					'center' => array(
						'title' => esc_html__( 'Center', 'agenvix-core' ),
						'icon'  => 'eicon-text-align-center',
					),
					'right'  => array(
						'title' => esc_html__( 'Right', 'agenvix-core' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'default'   => 'left',
				'toggle'    => true,
				'selectors' => array(
					'{{WRAPPER}} .box-icon' => 'text-align: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'animation_delay',
			array(
				'label'   => __( 'Animation Delay (e.g. 200ms)', 'agenvix-core' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( '0ms', 'agenvix-core' ),
			)
		);
		$this->add_control(
			'show_line',
			array(
				'label'        => esc_html__( 'Show Line', 'agenvix-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'agenvix-core' ),
				'label_off'    => esc_html__( 'Hide', 'agenvix-core' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'icon_style',
			array(
				'label' => __( 'Icon', 'agenvix-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->start_controls_tabs(
			'style_tabs'
		);
			$this->start_controls_tab(
				'style_normal_tab',
				array(
					'label' => esc_html__( 'Normal', 'agenvix-core' ),
				)
			);
				$this->add_control(
					'icon_color',
					[
						'label' => esc_html__( 'Icon Color', 'agenvix-core' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .box-icon .icon' => 'color: {{VALUE}}',
						],
					]
				);
				$this->add_group_control(
					\Elementor\Group_Control_Background::get_type(),
					array(
						'name'     => 'icon_background',
						'types'    => array( 'classic', 'gradient' ),
						'selector' => '{{WRAPPER}} .box-icon .icon',
					)
				);
			$this->end_controls_tab();

			$this->start_controls_tab(
				'style_hover_tab',
				array(
					'label' => esc_html__( 'Hover', 'agenvix-core' ),
				)
			);
				$this->add_control(
					'icon_hover_color',
					[
						'label' => esc_html__( 'Icon Color', 'agenvix-core' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .box-icon:hover .icon' => 'color: {{VALUE}}',
						],
					]
				);
				$this->add_group_control(
					\Elementor\Group_Control_Background::get_type(),
					array(
						'name'     => 'icon_hover_background',
						'types'    => array( 'classic', 'gradient' ),
						'selector' => '{{WRAPPER}} .box-icon:hover .icon::after',
					)
				);
			$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'title_style',
			[
				'label' => esc_html__( 'Title', 'agenvix-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Text Color', 'agenvix-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .box-icon .content .title' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'title_margin',
			[
				'label' => esc_html__( 'Margin', 'agenvix-core' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .box-icon .content .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

        $this->start_controls_section(
			'description_style',
			[
				'label' => esc_html__( 'Description', 'agenvix-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'description_color',
			[
				'label' => esc_html__( 'Description Color', 'agenvix-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .box-icon .content .description' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'description_margin',
			[
				'label' => esc_html__( 'Margin', 'agenvix-core' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .box-icon .content .description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		if ( ! empty( $settings['icon_image']['url'] ) ) {
			$icon = ! empty( $settings['icon_image']['id'] ) ? wp_get_attachment_image_url( $settings['icon_image']['id'], '' ) : $settings['icon_image']['url'];
		}
		?>

		<?php if ( $settings['provix_design_style'] == 'layout-1' ) { ?>

			<div class="box-icon style-one wow fadeInLeft <?php echo $settings['show_line']; ?>" data-wow-delay="<?php echo esc_attr( $settings['animation_delay'] ); ?>">
				<div class="icon">
					<img src="<?php echo esc_url( $icon ); ?>" alt="icon">
				</div>
				<div class="content">
					<h3 class="title"><?php echo $settings['provix_title']; ?></h3>
					<p class="description"><?php echo $settings['provix_description']; ?></p>
				</div>
			</div>

		<?php } elseif ( $settings['provix_design_style'] == 'layout-2' ) { ?>

			<div class="box-icon style-two">
				<div class="icon">
					<?php \Elementor\Icons_Manager::render_icon( $settings['icon'], array( 'aria-hidden' => 'true' ) ); ?>
				</div>
				<div class="content">
					<p class="title"><?php echo $settings['provix_title']; ?></p>
					<?php if ( ! empty( $settings['provix_description'] ) ) : ?>
						<p class="description"><?php echo $settings['provix_description']; ?></p>
					<?php endif; ?>
				</div>
			</div>

		<?php } elseif ( $settings['provix_design_style'] == 'layout-3' ) { ?>

			<div class="box-icon style-three">
				<div class="icon">
					<img src="<?php echo esc_url( $icon ); ?>" alt="icon">
				</div>
				<div class="content">
					<h4 class="title"><?php echo $settings['provix_title']; ?></h4>
					<?php if ( ! empty( $settings['provix_description'] ) ) : ?>
						<p><?php echo $settings['provix_description']; ?></p>
					<?php endif; ?>
				</div>
			</div>

		<?php } elseif ( $settings['provix_design_style'] == 'layout-4' ) { ?>

			<div class="box-icon style-four wow fadeInLeft <?php echo $settings['show_line']; ?>" data-wow-delay="<?php echo esc_attr( $settings['animation_delay'] ); ?>">
				<div class="icon">
					<img src="<?php echo esc_url( $icon ); ?>" alt="icon">
					<span></span>
				</div>
				<div class="content">
					<h3 class="title"><?php echo $settings['provix_title']; ?></h3>
					<p class="description"><?php echo $settings['provix_description']; ?></p>
				</div>
			</div>

		<?php } elseif ( $settings['provix_design_style'] == 'layout-5' ) { ?>

			<div class="box-icon style-five wow fadeInRight <?php echo $settings['show_line']; ?>" data-wow-delay="<?php echo esc_attr( $settings['animation_delay'] ); ?>">
				<div class="icon">
					<img src="<?php echo esc_url( $icon ); ?>" alt="icon">
				</div>
				<div class="content">
					<h3 class="title"><?php echo $settings['provix_title']; ?></h3>
					<p class="description"><?php echo $settings['provix_description']; ?></p>
				</div>
			</div>

		<?php } elseif ( 'layout-6' === $settings['provix_design_style'] ) { ?>

			<div class="box-icon style-six">
				<div class="icon">
					<img src="<?php echo esc_url( $icon ); ?>" alt="icon">
				</div>
				<div class="content">
					<h3 class="title"><?php echo $settings['provix_title']; ?></h3>
					<p class="description"><?php echo $settings['provix_description']; ?></p>
				</div>
			</div>
			
		<?php } elseif ( 'layout-7' === $settings['provix_design_style'] ) { ?>

			<div class="box-icon style-seven">
				<div class="icon">
					<?php \Elementor\Icons_Manager::render_icon( $settings['icon'], array( 'aria-hidden' => 'true' ) ); ?>
				</div>
				<div class="content">
					<p class="title"><?php echo $settings['provix_title']; ?></p>
					<?php if ( ! empty( $settings['provix_description'] ) ) : ?>
						<p class="description"><?php echo $settings['provix_description']; ?></p>
					<?php endif; ?>
				</div>
			</div>

		<?php } elseif ( 'layout-8' === $settings['provix_design_style'] ) { ?>
			
			<div class="box-icon style-eight">
				<div class="icon">
					<?php \Elementor\Icons_Manager::render_icon( $settings['icon'], array( 'aria-hidden' => 'true' ) ); ?>
					<?php if( !empty( $icon ) ) : ?>
						<img src="<?php echo esc_url( $icon ); ?>" alt="icon">
					<?php endif; ?>
				</div>
				<div class="content">
					<h5 class="title"><?php echo $settings['provix_title']; ?></h5>
					<?php if ( ! empty( $settings['provix_description'] ) ) : ?>
						<p class="description"><?php echo $settings['provix_description']; ?></p>
					<?php endif; ?>
				</div>
			</div>

		<?php } ?>

		<?php
	}
}

$widgets_manager->register( new Provix_Icon_Box() );
