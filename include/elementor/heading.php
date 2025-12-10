<?php
namespace RaizenCore\Widgets;

if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * Raizen Core
 *
 * Elementor widget for heading.
 *
 * @since 1.0.0
 */
class Raizen_Heading extends \Elementor\Widget_Base {

	public function get_name() {
		return 'raizen-heading';
	}

	public function get_title() {
		return __( 'Heading', 'raizencore' );
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
         * Layout section
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
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'layout-1' => esc_html__('Layout 1', 'raizencore'),
                    'layout-2' => esc_html__('Layout 2', 'raizencore'),
                    'layout-3' => esc_html__('Layout 3', 'raizencore'),
                    'layout-4' => esc_html__('Layout 4', 'raizencore'),
                    'layout-5' => esc_html__('Layout 5', 'raizencore'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        
        /**
         * Title and content section
         */
        $this->start_controls_section(
            'raizen_heading',
            [
                'label' => esc_html__('Heading', 'raizencore'),
            ]
        );
        
        $this->add_control(
            'heading_text',
            [
                'label' => esc_html__('Text', 'raizencore'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Text Here', 'raizencore'),
                'placeholder' => esc_html__('Type text', 'raizencore'),
            ]
        );
        $this->add_control(
            'html_tag',
            [
                'label' => esc_html__( 'HTML Tag', 'raizencore' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'h2',
                'options' => [
                    'h1' => esc_html__( 'h1', 'raizencore' ),
                    'h2' => esc_html__( 'h2', 'raizencore' ),
                    'h3'  => esc_html__( 'h3', 'raizencore' ),
                    'h4' => esc_html__( 'h4', 'raizencore' ),
                    'h5' => esc_html__( 'h5', 'raizencore' ),
                    'h6' => esc_html__( 'h6', 'raizencore' ),
                    'div' => esc_html__( 'div', 'raizencore' ),
                    'span' => esc_html__( 'span', 'raizencore' ),
                    'p' => esc_html__( 'p', 'raizencore' ),
                ],
            ]
        );
        $this->end_controls_section();

        /**
         * Style section
         */

        $this->start_controls_section(
            'general_section',
            [
                'label' => esc_html__( 'General', 'raizencore' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'text_alignment',
            [
                'label' => esc_html__( 'Alignment', 'raizencore' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => '',
                'options' => [
                    '' => esc_html__( 'Left', 'raizencore' ),
                    'center'  => esc_html__( 'Center', 'raizencore' ),
                    'right' => esc_html__( 'Right', 'raizencore' ),
                ],
            ]
        );
        $this->add_responsive_control(
            'width',
            [
                'label' => esc_html__( 'Width', 'raizencore' ),
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
                    '{{WRAPPER}} .heading-text .heading' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'heading_style',
            [
                'label' => esc_html__( 'Heading', 'raizencore' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
            $this->add_control(
                'heading_color',
                [
                    'label' => esc_html__( 'Color', 'raizencore' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .heading-text .heading' => 'color: {{VALUE}}',
                    ],
                ]
            );
            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'heading_typography',
                    'selector' => '{{WRAPPER}} .heading-text .heading',
                ]
            );
            $this->add_control(
                'heading_margin',
                [
                    'label' => esc_html__( 'Margin', 'raizencore' ),
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .heading-text .heading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_group_control(
                \Elementor\Group_Control_Border::get_type(),
                [
                    'name' => 'heading_border',
                    'selector' => '{{WRAPPER}} .heading-text .heading',
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

        $this->add_render_attribute( 'heading_text', 'class', 'heading' );

        ?>

		<?php if ( $settings['raizen_design_style']  == 'layout-1' ): ?>

            <div class="heading-text style-one <?php echo $settings['text_alignment']; ?>">
                <?php
                    $title = wp_kses_post( $settings['heading_text'] );
                    $title_html = sprintf( '<%1$s %2$s>%3$s</%1$s>', \Elementor\Utils::validate_html_tag( $settings['html_tag'] ), $this->get_render_attribute_string( 'heading_text' ), $title );
                    echo $title_html;
                ?>
            </div>

		<?php elseif( $settings['raizen_design_style']  == 'layout-2' ): ?>

            <div class="heading-text style-two <?php echo $settings['text_alignment']; ?>">
                <?php
                    $title = wp_kses_post( $settings['heading_text'] );
                    $title_html = sprintf( '<%1$s %2$s>%3$s</%1$s>', \Elementor\Utils::validate_html_tag( $settings['html_tag'] ), $this->get_render_attribute_string( 'heading_text' ), $title );
                    echo $title_html;
                ?>
            </div>

        <?php elseif( $settings['raizen_design_style']  == 'layout-3' ): ?>

            <div class="heading-text style-three <?php echo $settings['text_alignment']; ?>">
                <?php
                    $title = wp_kses_post( $settings['heading_text'] );
                    $title_html = sprintf( '<%1$s %2$s>%3$s</%1$s>', \Elementor\Utils::validate_html_tag( $settings['html_tag'] ), $this->get_render_attribute_string( 'heading_text' ), $title );
                    echo $title_html;
                ?>
            </div>

        <?php elseif( $settings['raizen_design_style']  == 'layout-4' ): ?>

            <div class="heading-text style-four <?php echo $settings['text_alignment']; ?>">
                <?php
                    $title = wp_kses_post( $settings['heading_text'] );
                    $title_html = sprintf( '<%1$s %2$s>%3$s</%1$s>', \Elementor\Utils::validate_html_tag( $settings['html_tag'] ), $this->get_render_attribute_string( 'heading_text' ), $title );
                    echo $title_html;
                ?>
            </div>

        <?php elseif( $settings['raizen_design_style']  == 'layout-5' ): ?>

            <div class="heading-text style-five <?php echo $settings['text_alignment']; ?>">
                <?php
                    $title = wp_kses_post( $settings['heading_text'] );
                    $title_html = sprintf( '<%1$s %2$s>%3$s</%1$s>', \Elementor\Utils::validate_html_tag( $settings['html_tag'] ), $this->get_render_attribute_string( 'heading_text' ), $title );
                    echo $title_html;
                ?>
            </div>

        <?php endif; ?>

        <?php 
	}
}

$widgets_manager->register( new Raizen_Heading() );