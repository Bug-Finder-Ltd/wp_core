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
class Provix_Button extends \Elementor\Widget_Base {

	public function get_name() {
		return 'next-button';
	}

	public function get_title() {
		return __('Button', 'agenvix-core');
	}

	public function get_icon() {
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
					'layout-6' => esc_html__( 'Layout 6', 'agenvix-core' ),
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
		$this->add_control(
			'button_link',
			[
				'label' => esc_html__('Link', 'agenvix-core'),
				'type' => \Elementor\Controls_Manager::URL,
				'options' => ['url', 'is_external', 'nofollow'],
				'default' => [
					'url' => '#',
					'is_external' => true,
					'nofollow' => true,
					// 'custom_attributes' => '',
				],
				'label_block' => true,
			]
		);
		$this->end_controls_section();

		/*============
		 Style
        ==============*/

		$this->start_controls_section(
			'style_section',
			[
				'label' => esc_html__('Style', 'agenvix-core'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'button_align',
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
				'default' => 'left',
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .single-btn' => 'text-align: {{VALUE}};',
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
					'{{WRAPPER}} .single-btn .button' => 'color: {{VALUE}}',
					'{{WRAPPER}} .single-btn .button .button-text' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'button_background',
				'types' => ['classic', 'gradient'],
				'selector' => '{{WRAPPER}} .single-btn .button .button-text, {{WRAPPER}} .single-btn .button',
			]
		);
		$this->add_control(
			'button_margin',
			[
				'label' => esc_html__('Margin', 'agenvix-core'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .single-btn .button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

			<div class="single-btn style-one">
				<a href="<?php echo esc_url( $settings['button_link']['url'] ); ?>" class="button btn-1">
					<?php echo esc_html( $settings['button_text'] ); ?>
					<i class="fa-light fa-arrow-right"></i>
					<span></span>
				</a>
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
			
		<?php elseif ( 'layout-6' === $settings['provix_design_style'] ) : ?>
            
			<div class="single-btn style-six">
				<a href="<?php echo esc_url($settings['button_link']['url']); ?>" class="button">
					<span class="button-text">
						<?php echo $settings[ 'button_text' ]; ?>
					</span>
				</a>
			</div>
            
		<?php endif; ?>

		<?php
	}
}

$widgets_manager->register( new Provix_Button() );
