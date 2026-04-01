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
class Provix_Info_Box extends \Elementor\Widget_Base {


	public function get_name() {
		return 'provix-info-box';
	}

	public function get_title() {
		return __( 'Info Box', 'agenvix-core' );
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
				),
				'default' => 'layout-1',
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
				'default'     => esc_html__( '12k', 'agenvix-core' ),
				'placeholder' => esc_html__( 'Type title', 'agenvix-core' ),
				'label_block' => true,
			)
		);

		$this->add_control(
			'provix_description',
			array(
				'label'       => esc_html__( 'Description', 'agenvix-core' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => esc_html__( 'Project Completed', 'agenvix-core' ),
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

		$this->end_controls_section();

		$this->start_controls_section(
			'title_style',
			array(
				'label' => __( 'Title', 'agenvix-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
			$this->add_control(
				'title_color',
				[
					'label' => esc_html__( 'Text Color', 'agenvix-core' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .info-box .twenty-four .title' => 'color: {{VALUE}}',
					],
				]
			);
			$this->add_group_control(
				\Elementor\Group_Control_Background::get_type(),
				[
					'name' => 'title_background',
					'types' => [ 'classic', 'gradient', 'video' ],
					'selector' => '{{WRAPPER}} .info-box .twenty-four, {{WRAPPER}} .info-box .twenty-four-inner::after',
				]
			);
		$this->end_controls_section();

		$this->start_controls_section(
			'description_style',
			array(
				'label' => __( 'Description', 'agenvix-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
			$this->add_control(
				'description_color',
				array(
					'label'     => esc_html__( 'Color', 'agenvix-core' ),
					'type'      => \Elementor\Controls_Manager::COLOR,
					'selectors' => array(
						'{{WRAPPER}} .info-box .description' => 'color: {{VALUE}}',
					),
				)
			);
			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'description_typography',
					'selector' => '{{WRAPPER}} .info-box .description',
				]
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
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		if ( ! empty( $settings['icon_image']['url'] ) ) {
			$icon = ! empty( $settings['icon_image']['id'] ) ? wp_get_attachment_image_url( $settings['icon_image']['id'], '' ) : $settings['icon_image']['url'];
		}
		?>

		<?php if ( $settings['provix_design_style'] == 'layout-1' ) { ?>

			<div class="info-box style-one">
				<div class="twenty-four">
					<h4 class="title"><?php echo $settings['provix_title']; ?></h4>
					<div class="twenty-four-inner"></div>
				</div>
				<?php if ( ! empty( $settings['provix_description'] ) ) : ?>
					<h4 class="description"><?php echo $settings['provix_description']; ?></h4>
				<?php endif; ?>
			</div>

		<?php } elseif ( $settings['provix_design_style'] == 'layout-2' ) { ?>

			<div class="info-box style-two">
				<h2 class="title"><?php echo $settings['provix_title']; ?></h2>
				<?php if ( ! empty( $settings['provix_description'] ) ) : ?>
					<p class="description"><?php echo $settings['provix_description']; ?></p>
				<?php endif; ?>
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

		<?php } elseif ( 'layout-4' === $settings['provix_design_style'] ) { ?>
			
		<?php } ?>

		<?php
	}
}

$widgets_manager->register( new Provix_Info_Box() );
