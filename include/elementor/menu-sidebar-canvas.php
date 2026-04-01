<?php

namespace ProvixCore\Widgets;

if (! defined('ABSPATH')) exit;

/**
 * Provix Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Menu_Sidebar_Canvas extends \Elementor\Widget_Base {

	public function get_name()
	{
		return 'menu-sidebar-canvas';
	}

	public function get_title()
	{
		return __('Menu Sidebar Canvas', 'agenvix-core');
	}

	public function get_icon()
	{
		return 'provix-icon';
	}

	public function get_categories()
	{
		return ['agenvix-core'];
	}

	public function get_script_depends()
	{
		return ['agenvix-core'];
	}

	protected function register_controls()
	{

		/**
		 * Layout section
		 */

		$this->start_controls_section(
			'provix_layout',
			[
				'label' => esc_html__('Design Layout', 'agenvix-core'),
			]
		);
		$this->add_control(
			'provix_design_style',
			[
				'label' => esc_html__('Select Layout', 'agenvix-core'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'layout-1' => esc_html__( 'Layout 1', 'agenvix-core' ),
					'layout-2' => esc_html__( 'Layout 2', 'agenvix-core' ),
					'layout-3' => esc_html__( 'Layout 3', 'agenvix-core' ),
					'layout-4' => esc_html__( 'Layout 4', 'agenvix-core' ),
					'layout-5' => esc_html__( 'Layout 5', 'agenvix-core' ),
				],
				'default' => 'layout-1',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'button_section',
			[
				'label' => esc_html__('Button', 'agenvix-core'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'button_text',
			[
				'label' => esc_html__('Text', 'agenvix-core'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Click Here', 'agenvix-core'),
				'placeholder' => esc_html__('Type your title here', 'agenvix-core'),
			]
		);
		
		$this->end_controls_section();

		$this->start_controls_section(
			'offcanvas_section',
			[
				'label' => esc_html__('Offcanvas', 'agenvix-core'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		
		
		$this->end_controls_section();

		/*============
		 Style
        ==============*/

		$this->start_controls_section(
			'general_style',
			[
				'label' => esc_html__('General', 'agenvix-core'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'button_align',
			[
				'label' => esc_html__('Alignment', 'agenvix-core'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'start' => [
						'title' => esc_html__('Left', 'agenvix-core'),
						'icon' => 'eicon-h-align-left',
					],
					'center' => [
						'title' => esc_html__('Center', 'agenvix-core'),
						'icon' => 'eicon-h-align-center',
					],
					'end' => [
						'title' => esc_html__('Right', 'agenvix-core'),
						'icon' => 'eicon-h-align-right',
					],
				],
				'default' => 'left',
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .menu-offcanvas .offcanvas-icon' => 'justify-content: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'button_style',
			[
				'label' => esc_html__('Button', 'agenvix-core'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'button_color',
			[
				'label' => esc_html__('Color', 'agenvix-core'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .menu-offcanvas .sidebar-toggle' => 'color: {{VALUE}}',
					'{{WRAPPER}} .menu-offcanvas .sidebar-toggle svg' => 'fill: {{VALUE}}'
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'button_background',
				'types' => ['classic', 'gradient'],
				'selector' => '{{WRAPPER}} .menu-offcanvas .sidebar-toggle',
			]
		);
		$this->add_control(
			'button_margin',
			[
				'label' => esc_html__('Margin', 'agenvix-core'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .menu-offcanvas .sidebar-toggle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'button_icon_style',
			[
				'label' => esc_html__('Button Icon', 'agenvix-core'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'icon_color',
			[
				'label' => esc_html__('Color', 'agenvix-core'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .single-btn .button i' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'icon_background',
				'types' => ['classic', 'gradient'],
				'selector' => '{{WRAPPER}} .single-btn .button i',
			]
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
	protected function render()
	{
		$settings = $this->get_settings_for_display();
?>

		<?php
		if ( $settings['provix_design_style']  == 'layout-1' ) : ?>

			<div class="menu-offcanvas style-one">
				<div class="offcanvas-icon">
					<div class="sidebar-toggle nd-offcanvas-toggle"  data-target="#ndOffcanvas">
						<svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="white" class="bi bi-x-diamond" viewBox="0 0 16 16">
							<path d="M7.987 16a1.53 1.53 0 0 1-1.07-.448L.45 9.082a1.53 1.53 0 0 1 0-2.165L6.917.45a1.53 1.53 0 0 1 2.166 0l6.469 6.468A1.53 1.53 0 0 1 16 8.013a1.53 1.53 0 0 1-.448 1.07l-6.47 6.469A1.53 1.53 0 0 1 7.988 16zM7.639 1.17 4.766 4.044 8 7.278l3.234-3.234L8.361 1.17a.51.51 0 0 0-.722 0M8.722 8l3.234 3.234 2.873-2.873c.2-.2.2-.523 0-.722l-2.873-2.873zM8 8.722l-3.234 3.234 2.873 2.873c.2.2.523.2.722 0l2.873-2.873zM7.278 8 4.044 4.766 1.17 7.639a.51.51 0 0 0 0 .722l2.874 2.873z"/>
						</svg>
					</div>
				</div>

				<!-- Offcanvas -->

				<div class="nd-offcanvas-backdrop"></div>

				<div id="ndOffcanvas" class="header-offcanvas nd-offcanvas-right">
					<div class="offcanvas-header">
						<div class="logo">
							<?php agenvix_header_logo(); ?>
						</div>
						<button class="nd-offcanvas-close">&times;</button>
					</div>
					<div class="offcanvas-body">
						<div class="menu-outer"><!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header--></div>
						<div class="contact-info">

							<?php if ( ! empty( $phone_number ) ) : ?>
								<div class="info-box">
									<div class="icon">
										<i class="fa-light fa-phone"></i>
									</div>
									<div class="content">
										<p class="title"><?php echo esc_html( $phone_title ); ?></p>
										<h6><?php echo esc_html( $phone_number ); ?></h6>
									</div>
								</div>
							<?php endif; ?>

							<?php if ( ! empty( $email_address ) ) : ?>
								<div class="info-box">
									<div class="icon">
										<i class="fa-light fa-envelope"></i>
									</div>
									<div class="content">
										<p class="title"><?php echo esc_html( $email_title ); ?></p>
										<h6><?php echo esc_html( $email_address ); ?></h6>
									</div>
								</div>
							<?php endif; ?>

							<?php if ( ! empty( $open_hour_time ) ) : ?>
								<div class="info-box">
									<div class="icon">
										<i class="fa-light fa-alarm-clock"></i>
									</div>
									<div class="content">
										<p class="title"><?php echo esc_html( $open_hour_title ); ?></p>
										<h6><?php echo esc_html( $open_hour_time ); ?></h6>
									</div>
								</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>

		<?php elseif ( $settings['provix_design_style']  == 'layout-2' ) : ?>

			<div class="single-btn style-two">
				<a href="<?php echo esc_url($settings['button_link']['url']); ?>" class="button">
					<i class="fa-light fa-arrow-right"></i>
					<div class="text">
						<div class="first-text"><?php echo $settings['button_text']; ?></div>
						<div class="second-text"><?php echo $settings['button_text']; ?></div>
					</div>
				</a>
			</div>

		<?php elseif ( $settings['provix_design_style'] == 'layout-3' ) : ?>

			<div class="single-btn style-three">
				<a href="<?php echo esc_url($settings['button_link']['url']); ?>" class="button">
					<?php echo $settings['button_text']; ?>
					<div class="btn-icon">
						<span class="icon-first"><i class="fa-light fa-arrow-right"></i></span>
						<span class="icon-second"><i class="fa-light fa-arrow-right"></i></span>
					</div>
				</a>
			</div>

		<?php elseif ( $settings['provix_design_style']  == 'layout-4' ) : ?>

			<div class="single-btn style-four">
				<a href="<?php echo esc_url($settings['button_link']['url']); ?>" class="button">
					<span class="button-text">
						<?php echo $settings[ 'button_text' ]; ?>
					</span>
				</a>
			</div>

		<?php elseif ( $settings['provix_design_style']  == 'layout-5' ) : ?>

			<div class="single-btn style-five">
				<div class="btn-group">
					<a class="btn-el btn-circle" href="<?php echo esc_url($settings['button_link']['url']); ?>">
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32">
							<path d="M31,0H15V2H28.59L.29,30.29l1.41,1.41L30,3.41V16h2V1A1,1,0,0,0,31,0Z"></path>
						</svg>
					</a>
					<a class="btn-el btn-primary" href="<?php echo esc_url($settings['button_link']['url']); ?>">
						<?php echo $settings[ 'button_text' ]; ?>
					</a>
					<a class="btn-el btn-circle" href="<?php echo esc_url($settings['button_link']['url']); ?>">
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32">
							<path d="M31,0H15V2H28.59L.29,30.29l1.41,1.41L30,3.41V16h2V1A1,1,0,0,0,31,0Z"></path>
						</svg>
					</a>
				</div>
			</div>

		<?php endif; ?>

		<?php
	}
}

$widgets_manager->register( new Menu_Sidebar_Canvas() );
