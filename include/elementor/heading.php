<?php
namespace ZupetCore\Widgets;

if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * Zupet Core
 *
 * Elementor widget for heading.
 *
 * @since 1.0.0
 */
class Zupet_Heading extends \Elementor\Widget_Base {

	public function get_name() {
		return 'zupet-heading';
	}

	public function get_title() {
		return __( 'Heading', 'zupetcore' );
	}

	public function get_icon() {
		return 'zupet-icon';
	}

	public function get_categories() {
		return [ 'zupetcore' ];
	}

	public function get_script_depends() {
		return [ 'zupetcore' ];
	}

	protected function register_controls() {

        /**
         * Layout section
         */
        
        $this->start_controls_section(
            'zupet_layout',
            [
                'label' => esc_html__('Design Layout', 'zupetcore'),
            ]
        );
        $this->add_control(
            'zupet_design_style',
            [
                'label' => esc_html__('Select Layout', 'zupetcore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'layout-1' => esc_html__('Layout 1', 'zupetcore'),
                    'layout-2' => esc_html__('Layout 2', 'zupetcore'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        
        /**
         * Title and content section
         */
        $this->start_controls_section(
            'zupet_heading',
            [
                'label' => esc_html__('Heading', 'zupetcore'),
            ]
        );
        
        $this->add_control(
            'heading_text',
            [
                'label' => esc_html__('Text', 'zupetcore'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Text Here', 'zupetcore'),
                'placeholder' => esc_html__('Type text', 'zupetcore'),
            ]
        );
        $this->add_control(
            'html_tag',
            [
                'label' => esc_html__( 'HTML Tag', 'zupetcore' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'h2',
                'options' => [
                    'h1' => esc_html__( 'h1', 'zupetcore' ),
                    'h2' => esc_html__( 'h2', 'zupetcore' ),
                    'h3'  => esc_html__( 'h3', 'zupetcore' ),
                    'h4' => esc_html__( 'h4', 'zupetcore' ),
                    'h5' => esc_html__( 'h5', 'zupetcore' ),
                    'h6' => esc_html__( 'h6', 'zupetcore' ),
                    'div' => esc_html__( 'div', 'zupetcore' ),
                    'span' => esc_html__( 'span', 'zupetcore' ),
                    'p' => esc_html__( 'p', 'zupetcore' ),
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
                'label' => esc_html__( 'General', 'zupetcore' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'text_alignment',
            [
                'label' => esc_html__( 'Alignment', 'zupetcore' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => '',
                'options' => [
                    '' => esc_html__( 'Left', 'zupetcore' ),
                    'center'  => esc_html__( 'Center', 'zupetcore' ),
                    'right' => esc_html__( 'Right', 'zupetcore' ),
                ],
            ]
        );
        $this->add_responsive_control(
            'width',
            [
                'label' => esc_html__( 'Width', 'zupetcore' ),
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
                'label' => esc_html__( 'Heading', 'zupetcore' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
            $this->add_control(
                'heading_color',
                [
                    'label' => esc_html__( 'Color', 'zupetcore' ),
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
                    'label' => esc_html__( 'Margin', 'zupetcore' ),
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .heading-text .heading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
        $this->end_controls_section();
        
	}

	/**
	 * Render the widget ouzupetut on the frontend.
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

		<?php if ( $settings['zupet_design_style']  == 'layout-1' ): ?>

            <div class="heading-text style-one <?php echo $settings['text_alignment']; ?>">
                <?php
                    $title = wp_kses_post( $settings['heading_text'] );
                    $title_html = sprintf( '<%1$s %2$s>%3$s</%1$s>', \Elementor\Utils::validate_html_tag( $settings['html_tag'] ), $this->get_render_attribute_string( 'heading_text' ), $title );
                    echo $title_html;
                ?>
            </div>

		<?php elseif( $settings['zupet_design_style']  == 'layout-2' ): ?>

            <div class="section-subtitle style-one <?php echo $settings['text_alignment']; ?>">
                <h2 class="subtitle">
                    <span><?php echo $settings['zupet_subtitle']; ?></span>
                </h2>
            </div>

        <?php endif; ?>

        <?php 
	}
}

$widgets_manager->register( new Zupet_Heading() );