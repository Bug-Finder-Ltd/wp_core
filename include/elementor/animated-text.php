<?php
namespace ProtineCore\Widgets;

if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * Protine Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Protine_Anim_Text extends \Elementor\Widget_Base {

	public function get_name() {
		return 'protine-anim-text';
	}

	public function get_title() {
		return __( 'Animated Text', 'protinecore' );
	}

	public function get_icon() {
		return 'protine-icon';
	}

	public function get_categories() {
		return [ 'protinecore' ];
	}

	public function get_script_depends() {
		return [ 'protinecore' ];
	}

	protected function register_controls() {

        /**
         * Layout section
         */
        
        $this->start_controls_section(
            'protine_layout',
            [
                'label' => esc_html__('Design Layout', 'protinecore'),
            ]
        );
        $this->add_control(
            'protine_design_style',
            [
                'label' => esc_html__('Select Layout', 'protinecore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'layout-1' => esc_html__('Layout 1', 'protinecore'),
                    'layout-2' => esc_html__('Layout 2', 'protinecore'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        
        /**
         * Title and content section
         */
        $this->start_controls_section(
            'protine_heading',
            [
                'label' => esc_html__('Heading', 'protinecore'),
            ]
        );
        
        $this->add_control(
            'heading_text',
            [
                'label' => esc_html__('Text', 'protinecore'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Text Here', 'protinecore'),
                'placeholder' => esc_html__('Type text', 'protinecore'),
            ]
        );
        $this->add_control(
            'html_tag',
            [
                'label' => esc_html__( 'HTML Tag', 'protinecore' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'h2',
                'options' => [
                    'h1' => esc_html__( 'h1', 'protinecore' ),
                    'h2' => esc_html__( 'h2', 'protinecore' ),
                    'h3'  => esc_html__( 'h3', 'protinecore' ),
                    'h4' => esc_html__( 'h4', 'protinecore' ),
                    'h5' => esc_html__( 'h5', 'protinecore' ),
                    'h6' => esc_html__( 'h6', 'protinecore' ),
                    'div' => esc_html__( 'div', 'protinecore' ),
                    'span' => esc_html__( 'span', 'protinecore' ),
                    'p' => esc_html__( 'p', 'protinecore' ),
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
                'label' => esc_html__( 'General', 'protinecore' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'text_alignment',
            [
                'label' => esc_html__( 'Alignment', 'protinecore' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => '',
                'options' => [
                    '' => esc_html__( 'Left', 'protinecore' ),
                    'center'  => esc_html__( 'Center', 'protinecore' ),
                    'right' => esc_html__( 'Right', 'protinecore' ),
                ],
            ]
        );
        $this->add_responsive_control(
            'width',
            [
                'label' => esc_html__( 'Width', 'protinecore' ),
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
                    '{{WRAPPER}} .heading-text' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'heading_style',
            [
                'label' => esc_html__( 'Heading', 'protinecore' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
            $this->add_control(
                'heading_color',
                [
                    'label' => esc_html__( 'Color', 'protinecore' ),
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
                    'label' => esc_html__( 'Margin', 'protinecore' ),
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
	 * Render the widget ouprotineut on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

        $this->add_render_attribute( 'heading_text', 'id', 'split-type-text' );

        ?>

		<?php if ( $settings['protine_design_style']  == 'layout-1' ): ?>

            <div class="animated-text style-one">
                <?php
                    $title = wp_kses_post( $settings['heading_text'] );
                    $title_html = sprintf( '<%1$s %2$s>%3$s</%1$s>', \Elementor\Utils::validate_html_tag( $settings['html_tag'] ), $this->get_render_attribute_string( 'heading_text' ), $title );
                    echo $title_html;
                ?>
            </div>

		<?php elseif( $settings['protine_design_style']  == 'layout-2' ): ?>

            <div class="section-subtitle style-one <?php echo $settings['text_alignment']; ?>">
                <h2 class="subtitle">
                    <span><?php echo $settings['protine_subtitle']; ?></span>
                </h2>
            </div>

        <?php endif; ?>

        <?php 
	}
}

$widgets_manager->register( new Protine_Anim_Text() );