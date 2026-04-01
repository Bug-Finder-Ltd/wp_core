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
class Pricing_tabs extends \Elementor\Widget_Base {

	public function get_name(){
		return 'pricing-tabs';
	}

	public function get_title(){
		return __('Pricing Tabs', 'agenvix-core');
	}

	public function get_icon(){
		return 'provix-icon';
	}

	public function get_categories(){
		return ['agenvix-core'];
	}

	public function get_script_depends(){
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
				],
				'default' => 'layout-1',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'pricing_plans_section',
			[
				'label' => esc_html__('Pricing Plans', 'agenvix-core'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->start_controls_tabs(
			'pricing_tabs'
		);

			$this->start_controls_tab(
				'monthly_tab',
				[
					'label' => esc_html__( 'Monthly', 'agenvix-core' ),
				]
			);

			$monthly_feature_repeater = new \Elementor\Repeater();

			$monthly_feature_repeater->add_control(
				'monthly_feature_text',
				[
					'label' => __( 'Feature', 'agenvix-core' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => 'Feature item',
					'label_block' => true,
				]
			);
			$monthly_feature_repeater->add_control(
				'monthly_feature_image_icon',
				[
					'label' => esc_html__( 'Choose Icon', 'agenvix-core' ),
					'type' => \Elementor\Controls_Manager::MEDIA,
					'default' => [
						'url' => \Elementor\Utils::get_placeholder_image_src(),
					],
				]
			);

			$monthly_plan_repeater = new \Elementor\Repeater();

			$monthly_plan_repeater->add_control(
				'monthly_plan_subtitle',
				[
					'label' => esc_html__( 'Sub Title', 'agenvix-core' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => esc_html__( 'Sub Title' , 'agenvix-core' ),
					'label_block' => true,
				]
			);
			$monthly_plan_repeater->add_control(
				'monthly_plan_name',
				[
					'label' => esc_html__( 'Name', 'agenvix-core' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => esc_html__( 'Plan Name' , 'agenvix-core' ),
					'label_block' => true,
				]
			);
			$monthly_plan_repeater->add_control(
				'monthly_plan_description',
				[
					'label' => esc_html__( 'Description', 'agenvix-core' ),
					'type' => \Elementor\Controls_Manager::TEXTAREA,
					'rows' => 6,
					'default' => esc_html__( 'Default description', 'agenvix-core' ),
					'placeholder' => esc_html__( 'Type your description here', 'agenvix-core' ),
				]
			);
			$monthly_plan_repeater->add_control(
				'monthly_plan_price',
				[
					'label' => esc_html__( 'Price', 'agenvix-core' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => esc_html__( '$999' , 'agenvix-core' ),
					'label_block' => true,
				]
			);

			$monthly_plan_repeater->add_control(
				'monthly_features',
				[
					'label' => __( 'Features', 'agenvix-core' ),
					'type' => \Elementor\Controls_Manager::REPEATER,
					'fields' => $monthly_feature_repeater->get_controls(),
					'title_field' => '{{{ monthly_feature_text }}}',
					'default' => [
						[
							'monthly_feature_text' => esc_html__( 'Basic analytics tracking', 'agenvix-core' ),
						],
						[
							'monthly_feature_text' => esc_html__( 'Content calendar planning', 'agenvix-core' ),
						],
						[
							'monthly_feature_text' => esc_html__( 'Competitor analysis', 'agenvix-core' ),
						],
					]
				]
			);

			$monthly_plan_repeater->add_control(
				'monthly_button_text',
				[
					'label' => esc_html__( 'Button Text', 'agenvix-core' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => esc_html__( 'Let’s Get Started' , 'agenvix-core' ),
					'label_block' => true,
				]
			);
			$monthly_plan_repeater->add_control(
				'monthly_button_link',
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

			$monthly_plan_repeater->add_control(
				'monthly_active_plan',
				[
					'label' => esc_html__( 'Active Plan', 'agenvix-core' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => esc_html__( 'Show', 'agenvix-core' ),
					'label_off' => esc_html__( 'Hide', 'agenvix-core' ),
					'return_value' => 'yes',
				]
			);

			$this->add_control(
				'monthly_list',
				[
					'label' => esc_html__( 'Repeater List', 'agenvix-core' ),
					'type' => \Elementor\Controls_Manager::REPEATER,
					'fields' => $monthly_plan_repeater->get_controls(),
					'collapsed' => true,
					'default' => [
						[
							'monthly_plan_name' => esc_html__( 'Startups Plan', 'agenvix-core' ),
						],
						[
							'monthly_plan_name' => esc_html__( 'Growth Plan', 'agenvix-core' ),
						],
						[
							'monthly_plan_name' => esc_html__( 'Enterprise Plan', 'agenvix-core' ),
						],
					],
					'title_field' => '{{{ monthly_plan_name }}}',
				]
			);

			$this->end_controls_tab();

			$this->start_controls_tab(
				'yearly_tab',
				[
					'label' => esc_html__( 'Yearly', 'agenvix-core' ),
				]
			);

			$yearly_feature_repeater = new \Elementor\Repeater();

			$yearly_feature_repeater->add_control(
				'yearly_feature_text',
				[
					'label' => __( 'Feature', 'agenvix-core' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => 'Feature item',
					'label_block' => true,
				]
			);
			$yearly_feature_repeater->add_control(
				'yearly_feature_image_icon',
				[
					'label' => esc_html__( 'Choose Icon', 'agenvix-core' ),
					'type' => \Elementor\Controls_Manager::MEDIA,
					'default' => [
						'url' => \Elementor\Utils::get_placeholder_image_src(),
					],
				]
			);

			$yearly_plan_repeater = new \Elementor\Repeater();

			$yearly_plan_repeater->add_control(
				'yearly_plan_subtitle',
				[
					'label' => esc_html__( 'Sub Title', 'agenvix-core' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => esc_html__( 'Sub Title' , 'agenvix-core' ),
					'label_block' => true,
				]
			);
			$yearly_plan_repeater->add_control(
				'yearly_plan_name',
				[
					'label' => esc_html__( 'Name', 'agenvix-core' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => esc_html__( 'Plan Name' , 'agenvix-core' ),
					'label_block' => true,
				]
			);
			$yearly_plan_repeater->add_control(
				'yearly_plan_description',
				[
					'label' => esc_html__( 'Description', 'agenvix-core' ),
					'type' => \Elementor\Controls_Manager::TEXTAREA,
					'rows' => 6,
					'default' => esc_html__( 'Default description', 'agenvix-core' ),
					'placeholder' => esc_html__( 'Type your description here', 'agenvix-core' ),
				]
			);
			$yearly_plan_repeater->add_control(
				'yearly_plan_price',
				[
					'label' => esc_html__( 'Price', 'agenvix-core' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => esc_html__( '$999' , 'agenvix-core' ),
					'label_block' => true,
				]
			);

			$yearly_plan_repeater->add_control(
				'yearly_features',
				[
					'label' => __( 'Features', 'agenvix-core' ),
					'type' => \Elementor\Controls_Manager::REPEATER,
					'fields' => $yearly_feature_repeater->get_controls(),
					'title_field' => '{{{ yearly_feature_text }}}',
					'default' => [
						[
							'yearly_feature_text' => esc_html__( 'Basic analytics tracking', 'agenvix-core' ),
						],
						[
							'yearly_feature_text' => esc_html__( 'Content calendar planning', 'agenvix-core' ),
						],
						[
							'yearly_feature_text' => esc_html__( 'Competitor analysis', 'agenvix-core' ),
						],
					]
				]
			);

			$yearly_plan_repeater->add_control(
				'yearly_button_text',
				[
					'label' => esc_html__( 'Button Text', 'agenvix-core' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => esc_html__( 'Let’s Get Started' , 'agenvix-core' ),
					'label_block' => true,
				]
			);
			$yearly_plan_repeater->add_control(
				'yearly_button_link',
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

			$yearly_plan_repeater->add_control(
				'yearly_active_plan',
				[
					'label' => esc_html__( 'Active Plan', 'agenvix-core' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => esc_html__( 'Show', 'agenvix-core' ),
					'label_off' => esc_html__( 'Hide', 'agenvix-core' ),
					'return_value' => 'yes',
				]
			);

			$this->add_control(
				'yearly_list',
				[
					'label' => esc_html__( 'Repeater List', 'agenvix-core' ),
					'type' => \Elementor\Controls_Manager::REPEATER,
					'fields' => $yearly_plan_repeater->get_controls(),
					'default' => [
						[
							'yearly_plan_name' => esc_html__( 'Startups Plan', 'agenvix-core' ),
						],
						[
							'yearly_plan_name' => esc_html__( 'Growth Plan', 'agenvix-core' ),
						],
						[
							'yearly_plan_name' => esc_html__( 'Enterprise Plan', 'agenvix-core' ),
						],
					],
					'title_field' => '{{{ yearly_plan_name }}}',
				]
			);
			$this->end_controls_tab();

		$this->end_controls_tabs();
		
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
	protected function render() {
		$settings = $this->get_settings_for_display();
		?>

			<div class="pricing-wrapper" data-billing="monthly">

				<!-- Toggle -->
				<div class="pricing-toggle">
					<div class="btn-wrap">
						<span class="active-bg"></span>
						<button class="is-active" data-type="monthly"><?php echo esc_html_e( 'Monthly', 'agenvix-core' ); ?></button>
						<button data-type="yearly"><?php echo esc_html_e( 'Yearly', 'agenvix-core' ); ?></button>
					</div>
				</div>

				<div class="pricing-cards">

					<!-- MONTHLY -->
					<div class="pricing-group pricing-monthly">
						<?php if ( ! empty( $settings['monthly_list'] ) ) : ?>
							<?php foreach ( $settings['monthly_list'] as $plan ) : ?>

								<div class="pricing-card <?php if ( 'yes' === $plan['monthly_active_plan'] ) { echo 'is-active'; } ?>">
									<div class="card-header">
										<?php if( !empty($plan['monthly_plan_subtitle']) ) : ?>
											<span class="subtitle">
												<div class="shape"></div>
												<?php echo esc_html( $plan['monthly_plan_subtitle'] ); ?>
											</span>
										<?php endif; ?>

										<h3 class="title"><?php echo esc_html( $plan['monthly_plan_name'] ); ?></h3>
										<p class="description"><?php echo esc_html( $plan['monthly_plan_description'] ); ?></p>
									</div>

									<div class="price">
										<?php echo esc_html( $plan['monthly_plan_price'] ); ?><span><?php esc_html_e('/month', 'agenvix-core'); ?></span>
									</div>

									<?php if ( ! empty( $plan['monthly_features'] ) ) : ?>
										<ul class="features">
											<?php foreach ( $plan['monthly_features'] as $feature ) : ?>
												<li>
													<img src="<?php echo esc_url($feature['monthly_feature_image_icon']['url']); ?>" alt="">
													<?php echo esc_html( $feature['monthly_feature_text'] ); ?>
												</li>
											<?php endforeach; ?>
										</ul>
									<?php endif; ?>

									<?php if ( ! empty( $plan['monthly_button_text'] ) ) : ?>
										<a class="pricing-btn"
										href="<?php echo esc_url( $plan['monthly_button_link']['url'] ); ?>"
										<?php echo $plan['monthly_button_link']['is_external'] ? 'target="_blank"' : ''; ?>
										<?php echo $plan['monthly_button_link']['nofollow'] ? 'rel="nofollow"' : ''; ?>>
											<?php echo esc_html( $plan['monthly_button_text'] ); ?>
											<i class="fa-regular fa-arrow-right"></i>
										</a>
									<?php endif; ?>
								</div>

							<?php endforeach; ?>
						<?php endif; ?>
					</div>

					<!-- YEARLY -->
					<div class="pricing-group pricing-yearly">
						<?php if ( ! empty( $settings['yearly_list'] ) ) : ?>
							<?php foreach ( $settings['yearly_list'] as $plan ) : ?>

								<div class="pricing-card <?php if ( 'yes' === $plan['yearly_active_plan'] ) { echo 'is-active'; } ?>">
									<div class="card-header">
										<?php if( !empty($plan['yearly_plan_subtitle']) ) : ?>
											<span class="subtitle">
												<div class="shape"></div>
												<?php echo esc_html( $plan['yearly_plan_subtitle'] ); ?>
											</span>
										<?php endif; ?>
										<h3 class="title"><?php echo esc_html( $plan['yearly_plan_name'] ); ?></h3>
										<p class="description"><?php echo esc_html( $plan['yearly_plan_description'] ); ?></p>
									</div>

									<div class="price">
										<?php echo esc_html( $plan['yearly_plan_price'] ); ?><span><?php esc_html_e('/year', 'agenvix-core'); ?></span>
									</div>

									<?php if ( ! empty( $plan['yearly_features'] ) ) : ?>
										<ul class="features">
											<?php foreach ( $plan['yearly_features'] as $feature ) : ?>
												<li>
													<img src="<?php echo esc_url($feature['yearly_feature_image_icon']['url']); ?>" alt="">
													<?php echo esc_html( $feature['yearly_feature_text'] ); ?>
												</li>
											<?php endforeach; ?>
										</ul>
									<?php endif; ?>

									<?php if ( ! empty( $plan['yearly_button_text'] ) ) : ?>
										<a class="pricing-btn"
										href="<?php echo esc_url( $plan['yearly_button_link']['url'] ); ?>"
										<?php echo $plan['yearly_button_link']['is_external'] ? 'target="_blank"' : ''; ?>
										<?php echo $plan['yearly_button_link']['nofollow'] ? 'rel="nofollow"' : ''; ?>>
											<?php echo esc_html( $plan['yearly_button_text'] ); ?>
											<i class="fa-regular fa-arrow-right"></i>
										</a>
									<?php endif; ?>
								</div>

							<?php endforeach; ?>
						<?php endif; ?>
					</div>

				</div>
			</div>

		<?php
	}

}

$widgets_manager->register( new Pricing_tabs() );
