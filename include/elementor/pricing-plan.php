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
class Provix_Pricing_Plan extends \Elementor\Widget_Base
{

	public function get_name()
	{
		return 'provix-pricing';
	}

	public function get_title()
	{
		return __('Pricing Plan', 'agenvix-core');
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
				'label' => esc_html__( 'Design Layout', 'agenvix-core' ),
			]
		);
		$this->add_control(
			'provix_design_style',
			[
				'label' => esc_html__( 'Select Layout', 'agenvix-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'layout-1' => esc_html__( 'Layout 1', 'agenvix-core' ),
					'layout-2' => esc_html__( 'Layout 2', 'agenvix-core' ),
					'layout-3' => esc_html__( 'Layout 3', 'agenvix-core' ),
				],
				'default' => 'layout-1',
			]
		);
		$this->add_control(
			'active_plan',
			[
				'label' => esc_html__( 'Active Plan', 'agenvix-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Active', 'agenvix-core' ),
				'label_off' => esc_html__( 'Deactive', 'agenvix-core' ),
				'return_value' => 'yes',
				'default' => '',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'package_section',
			[
				'label' => esc_html__('Package', 'agenvix-core'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'icon',
			[
				'label' => esc_html__( 'Icon', 'agenvix-core' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-circle',
					'library' => 'fa-solid',
				],
				'recommended' => [
					'fa-solid' => [
						'circle',
						'dot-circle',
						'square-full',
					],
					'fa-regular' => [
						'circle',
						'dot-circle',
						'square-full',
					],
				],
			]
		);
		$this->add_control(
			'package_name',
			[
				'label' => esc_html__( 'Name', 'agenvix-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Basic Package', 'agenvix-core' ),
				'placeholder' => esc_html__( 'Type your name here', 'agenvix-core' ),
			]
		);
		$this->add_control(
			'package_type',
			[
				'label' => esc_html__( 'Type', 'agenvix-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Indivisual', 'agenvix-core' ),
				'placeholder' => esc_html__( 'Type your text here', 'agenvix-core' ),
			]
		);
		$this->add_control(
			'currency',
			[
				'label' => esc_html__( 'Currency', 'agenvix-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '$', 'agenvix-core' ),
				'placeholder' => esc_html__( 'Type your currency here', 'agenvix-core' ),
			]
		);
		$this->add_control(
			'duration',
			[
				'label' => esc_html__( 'Duration', 'agenvix-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '/month', 'agenvix-core' ),
				'placeholder' => esc_html__( 'Type your duration here', 'agenvix-core' ),
			]
		);
		$this->add_control(
			'price',
			[
				'label' => esc_html__( 'Price', 'agenvix-core' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 10000,
				'step' => 1,
				'default' => 299,
			]
		);
		$this->add_control(
			'button_text',
			[
				'label' => esc_html__( 'Button Text', 'agenvix-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Purchase Now', 'agenvix-core' ),
				'placeholder' => esc_html__( 'Type your text here', 'agenvix-core' ),
			]
		);
		$this->add_control(
			'button_link',
			[
				'label' => esc_html__( 'Button Link', 'agenvix-core' ),
				'type' => \Elementor\Controls_Manager::URL,
				'options' => [ 'url', 'is_external', 'nofollow' ],
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
					// 'custom_attributes' => '',
				],
				'label_block' => true,
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'image_icon',
			[
				'label' => esc_html__( 'Choose Icon', 'agenvix-core' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
		$repeater->add_control(
			'feature_title',
			[
				'label' => esc_html__( 'Feature Text', 'agenvix-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'List Title' , 'agenvix-core' ),
				'label_block' => true,
			]
		);
		$this->add_control(
			'list',
			[
				'label' => esc_html__( 'Feature List', 'agenvix-core' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'feature_title' => esc_html__( 'Business Solutions', 'agenvix-core' ),
					],
					[
						'feature_title' => esc_html__( 'Unlimited Projects', 'agenvix-core' ),
					],
					[
						'feature_title' => esc_html__( 'Customer Support', 'agenvix-core' ),
					],
				],
				'title_field' => '{{{ feature_title }}}',
			]
		);
		$this->end_controls_section();

		/*
		============
		Style
		==============
		*/

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
			$this->add_control(
				'animation_delay',
				[
					'label' => esc_html__( 'Animation Delay (ms)', 'agenvix-core' ),
					'type' => \Elementor\Controls_Manager::NUMBER,
					'min' => 1,
					'max' => 10000,
					'step' => 1,
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'header_style',
			[
				'label' => esc_html__('Header', 'agenvix-core'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_group_control(
				\Elementor\Group_Control_Background::get_type(),
				[
					'name' => 'header_background',
					'types' => [ 'classic', 'gradient' ],
					'selector' => '{{WRAPPER}} .pricing-card .card-head',
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Border::get_type(),
				[
					'name' => 'header_border',
					'selector' => '{{WRAPPER}} .pricing-card .card-head',
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'icon_style',
			[
				'label' => esc_html__('Icon', 'agenvix-core'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_group_control(
				\Elementor\Group_Control_Background::get_type(),
				[
					'name' => 'main_icon_background',
					'types' => [ 'classic', 'gradient' ],
					'selector' => '{{WRAPPER}} .pricing-card .card-head .icon',
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
					'{{WRAPPER}} .single-btn .button .button-text' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'button_background',
				'types' => ['classic', 'gradient'],
				'selector' => '{{WRAPPER}} .single-btn .button .button-text',
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
		if ( $settings['provix_design_style']  == 'layout-1' ) :
			$classes = 'pricing-card style-one';
			if ( ! empty( $settings['active_plan'] ) && 'yes' === $settings['active_plan'] ) {
				$classes .= ' is-active';
			}
			?>

			<div class="<?php echo esc_attr( $classes ); ?>">
				<div class="card-head">
					<?php if( !empty( $settings['package_name'] ) ) : ?>
						<h6 class="name"><?php echo $settings['package_name']; ?></h6>
					<?php endif; ?>

					<h4 class="price">
						<sup><?php echo $settings['currency']; ?></sup>
						<span><?php echo $settings['price']; ?></span>
						<?php echo $settings['duration']; ?>
					</h4>

					<div class="pricing-btn">
						<a href="<?php echo esc_url( $settings['button_link']['url'] ); ?>" class="button">
							<i class="fa-light fa-arrow-right"></i>
							<div class="text">
								<div class="first-text"><?php echo $settings['button_text']; ?></div>
								<div class="second-text"><?php echo $settings['button_text']; ?></div>
							</div>
						</a>
					</div>
				</div>
				<ul>
					<?php foreach ( $settings['list'] as $item ) {
						if ( !empty( $item['image_icon']['url'] ) ) {
							$icon = !empty( $item['image_icon']['id'] ) ? wp_get_attachment_image_url( $item['image_icon']['id'], '' ) : $item['image_icon']['url'];
						}
						?>
						<li>
							<img src="<?php echo esc_url( $icon ); ?>" alt="icon">
							<?php echo $item['feature_title']; ?>
						</li>
					<?php } ?>
				</ul>
			</div>

		<?php elseif ($settings['provix_design_style']  == 'layout-2') :
			$classes = 'pricing-card style-two';
			if ( ! empty( $settings['active_plan'] ) && 'yes' === $settings['active_plan'] ) {
				$classes .= ' is-active';
			}
			?>

			<div class="<?php echo esc_attr( $classes ); ?>">
				<div class="card-head">
					<div class="icon">
						<?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?>
					</div>
					<?php if( !empty( $settings['package_name'] ) ) : ?>
						<h6 class="name"><?php echo $settings['package_name']; ?></h6>
					<?php endif; ?>

					<?php if( !empty( $settings['package_type'] ) ) : ?>
						<p class="type"><?php echo $settings['package_type']; ?></p>
					<?php endif; ?>
				</div>
				<div class="card-body">
					<ul>
						<?php foreach ( $settings['list'] as $item ) {
							if ( !empty( $item['image_icon']['url'] ) ) {
								$icon = !empty( $item['image_icon']['id'] ) ? wp_get_attachment_image_url( $item['image_icon']['id'], '' ) : $item['image_icon']['url'];
							}
							?>
							<li>
								<img src="<?php echo esc_url( $icon ); ?>" alt="icon">
								<?php echo $item['feature_title']; ?>
							</li>
						<?php } ?>
					</ul>
					<h4 class="price">
						<sup><?php echo $settings['currency']; ?></sup>
						<span><?php echo $settings['price']; ?></span>
						<?php echo $settings['duration']; ?>
					</h4>

					<div class="pricing-btn">
						<a href="<?php echo esc_url( $settings['button_link']['url'] ); ?>" class="btn-2">
							<?php echo $settings['button_text']; ?>
							<div class="btn-icon">
								<span class="icon-first"><i class="fa-light fa-arrow-right"></i></span>
								<span class="icon-second"><i class="fa-light fa-arrow-right"></i></span>
							</div>
						</a>
					</div>
				</div>
			</div>

		<?php elseif ($settings['provix_design_style'] == 'layout-3') :
			$classes = 'pricing-card style-three wow fadeInLeftLong';
			if ( ! empty( $settings['active_plan'] ) && 'yes' === $settings['active_plan'] ) {
				$classes .= ' is-active';
			}
			?>

			<div class="<?php echo esc_attr( $classes ); ?>" data-wow-delay="<?php echo $settings['animation_delay']; ?>ms">
				<div class="card-head">
					<div class="icon">
						<?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?>
					</div>
					<?php if( !empty( $settings['package_name'] ) ) : ?>
						<h6 class="name"><?php echo $settings['package_name']; ?></h6>
					<?php endif; ?>

					<?php if( !empty( $settings['package_type'] ) ) : ?>
						<p class="type"><?php echo $settings['package_type']; ?></p>
					<?php endif; ?>
				</div>
				<div class="card-body">
					<ul>
						<?php foreach ( $settings['list'] as $item ) {
							if ( !empty( $item['image_icon']['url'] ) ) {
								$icon = !empty( $item['image_icon']['id'] ) ? wp_get_attachment_image_url( $item['image_icon']['id'], '' ) : $item['image_icon']['url'];
							}
							?>
							<li>
								<img src="<?php echo esc_url( $icon ); ?>" alt="icon">
								<?php echo $item['feature_title']; ?>
							</li>
						<?php } ?>
					</ul>
					<h4 class="price">
						<sup><?php echo $settings['currency']; ?></sup>
						<span><?php echo $settings['price']; ?></span>
						<?php echo $settings['duration']; ?>
					</h4>

					
				</div>
				<div class="pricing-btn">
					<a href="<?php echo esc_url( $settings['button_link']['url'] ); ?>" class="btn-2">
						<?php echo $settings['button_text']; ?>
						<div class="btn-icon">
							<span class="icon-first"><i class="fa-light fa-arrow-right"></i></span>
							<span class="icon-second"><i class="fa-light fa-arrow-right"></i></span>
						</div>
					</a>
				</div>
			</div>
		<?php endif; ?>

		<?php
	}
}

$widgets_manager->register(new Provix_Pricing_Plan());
