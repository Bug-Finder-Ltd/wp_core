<?php
namespace ProvixCore\Widgets;

use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Provix Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Social_Icons extends \Elementor\Widget_Base {

	public function get_name() {
		return 'provix-social-icons';
	}

	public function get_title() {
		return __( 'Social Icons', 'agenvix-core' );
	}

	public function get_icon() {
		return 'provix-icon';
	}

	public function get_categories() {
		return [ 'agenvix-core' ];
	}

	public function get_script_depends() {
		return [ 'agenvix-core' ];
	}

	protected function register_controls() {
		/**
		 * Layout Section
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
				'type' => Controls_Manager::SELECT,
				'options' => [
					'layout-1' => esc_html__( 'Layout 1', 'agenvix-core' ),
					'layout-2' => esc_html__( 'Layout 2', 'agenvix-core' ),
					'layout-3' => esc_html__( 'Layout 3', 'agenvix-core' ),
				],
				'default' => 'layout-1',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'social_icons',
			[
				'label' => __( 'Social Icons', 'agenvix-core' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'icon',
			[
				'label' => esc_html__( 'Icon', 'agenvix-core' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fab fa-facebook-f',
					'library' => 'fa-brands',
				],
			]
		);
		$repeater->add_control(
			'social_media_name',
			[
				'label' => esc_html__( 'Name', 'agenvix-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Facebook' , 'agenvix-core' ),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'social_media_link',
			[
				'label' => esc_html__( 'Link', 'agenvix-core' ),
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
		$this->add_control(
			'list',
			[
				'label' => esc_html__( 'Repeater List', 'agenvix-core' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'social_media_name' => esc_html__( 'Facebook', 'agenvix-core' ),
						'icon' => [
							'value'   => 'fab fa-facebook-f',
							'library' => 'fa-brands',
						]
					],
					[
						'social_media_name' => esc_html__( 'Linkedin', 'agenvix-core' ),
						'icon' => [
							'value'   => 'fab fa-linkedin-in',
							'library' => 'fa-brands',
						]
					],
				],
				'title_field' => '{{{ social_media_name }}}',
			]
		);

		$this->end_controls_section();

		/**
		 * Style section
		 */
		$this->start_controls_section(
			'general_style',
			[
				'label' => __( 'General', 'agenvix-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'icon_gap',
			[
				'label' => esc_html__( 'Icon Gap', 'agenvix-core' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .social-icons' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'icon_style',
			[
				'label' => __( 'Icon', 'agenvix-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'icon_color',
			[
				'label' => esc_html__( 'Color', 'agenvix-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .social-icons a' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'icon_background',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .social-icons a',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'icon_typography',
				'selector' => '{{WRAPPER}} .social-icons a',
			]
		);
		$this->add_responsive_control(
			'icon_margin',
			[
				'label' => esc_html__( 'Margin', 'agenvix-core' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .social-icons a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'icon_hover_style',
			[
				'label' => __( 'Icon Hover', 'agenvix-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_control(
				'icon_hover_color',
				[
					'label' => esc_html__( 'Color', 'agenvix-core' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .social-icons a:hover' => 'color: {{VALUE}}',
					],
				]
			);
			
			$this->add_group_control(
                \Elementor\Group_Control_Background::get_type(),
                [
                    'name' => 'icon_hover_background',
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .social-icons a:hover',
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
		$settings = $this->get_settings_for_display();?>

		<?php if ( $settings['provix_design_style']  == 'layout-1' ) : ?>

			<div class="social-icons style-one">
				<?php foreach ( $settings['list'] as $item ) : ?>
					<a href="<?php echo esc_url( $item['social_media_link']['url'] ); ?>">
						<?php \Elementor\Icons_Manager::render_icon( $item['icon'], [ 'aria-hidden' => 'true' ] ); ?>
					</a>
				<?php endforeach; ?>
			</div>

		<?php elseif ( $settings['provix_design_style']  == 'layout-2' ) : ?>

			<div class="social-icons style-two">
				<?php foreach ( $settings['list'] as $item ) : ?>
					<a href="<?php echo esc_url( $item['social_media_link']['url'] ); ?>">
						<?php \Elementor\Icons_Manager::render_icon( $item['icon'], [ 'aria-hidden' => 'true' ] ); ?>
					</a>
				<?php endforeach; ?>
			</div>

		<?php elseif ( $settings['provix_design_style']  == 'layout-3' ) : ?>
			
			<div class="social-icons style-three">
				<?php foreach ( $settings['list'] as $item ) : ?>
					<a href="<?php echo esc_url( $item['social_media_link']['url'] ); ?>">
						<?php echo $item['social_media_name']; ?>
					</a>
				<?php endforeach; ?>
			</div>

		<?php endif; ?>

		<?php
	}
}

$widgets_manager->register( new Social_Icons() );