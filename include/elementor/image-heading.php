<?php
namespace ProvixCore\Widgets;

if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * Provix Core
 *
 * Elementor widget for heading.
 *
 * @since 1.0.0
 */
class Image_Heading extends \Elementor\Widget_Base {

	public function get_name() {
		return 'image-heading';
	}

	public function get_title() {
		return __( 'Image Heading', 'agenvix-core' );
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
                    'layout-1' => esc_html__('Layout 1', 'agenvix-core'),
                    'layout-2' => esc_html__('Layout 2', 'agenvix-core'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        
        /**
         * Title and content section
         */
        $this->start_controls_section(
            'provix_heading',
            [
                'label' => esc_html__('Heading', 'agenvix-core'),
            ]
        );
        
        $this->add_control(
            'heading_text',
            [
                'label' => esc_html__('Text', 'agenvix-core'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Text Here', 'agenvix-core'),
                'placeholder' => esc_html__('Type text', 'agenvix-core'),
				'description' => 'Insert {image} to display inline image'
            ]
        );
        $this->add_control(
            'html_tag',
            [
                'label' => esc_html__( 'HTML Tag', 'agenvix-core' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'h2',
                'options' => [
                    'h1' => esc_html__( 'h1', 'agenvix-core' ),
                    'h2' => esc_html__( 'h2', 'agenvix-core' ),
                    'h3'  => esc_html__( 'h3', 'agenvix-core' ),
                    'h4' => esc_html__( 'h4', 'agenvix-core' ),
                    'h5' => esc_html__( 'h5', 'agenvix-core' ),
                    'h6' => esc_html__( 'h6', 'agenvix-core' ),
                    'div' => esc_html__( 'div', 'agenvix-core' ),
                    'span' => esc_html__( 'span', 'agenvix-core' ),
                    'p' => esc_html__( 'p', 'agenvix-core' ),
                ],
            ]
        );

		$this->add_control(
			'heading_image',
			[
				'label' => esc_html__( 'Choose Image', 'agenvix-core' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
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
                'label' => esc_html__( 'General', 'agenvix-core' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'text_alignment',
            [
                'label' => esc_html__( 'Alignment', 'agenvix-core' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => '',
                'options' => [
                    '' => esc_html__( 'Left', 'agenvix-core' ),
                    'center'  => esc_html__( 'Center', 'agenvix-core' ),
                    'right' => esc_html__( 'Right', 'agenvix-core' ),
                ],
            ]
        );
        $this->add_responsive_control(
            'width',
            [
                'label' => esc_html__( 'Width', 'agenvix-core' ),
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
                    '{{WRAPPER}} .inline-text-image .heading' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'heading_style',
            [
                'label' => esc_html__( 'Heading', 'agenvix-core' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
            $this->add_control(
                'heading_color',
                [
                    'label' => esc_html__( 'Color', 'agenvix-core' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .inline-text-image .heading' => 'color: {{VALUE}}',
                    ],
                ]
            );
            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'heading_typography',
                    'selector' => '{{WRAPPER}} .inline-text-image .heading',
                ]
            );
            $this->add_control(
                'heading_margin',
                [
                    'label' => esc_html__( 'Margin', 'agenvix-core' ),
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .inline-text-image .heading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'highlight_text_color',
                [
                    'label' => esc_html__( 'Highlight Text Color', 'agenvix-core' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .inline-text-image .heading span' => 'color: {{VALUE}}',
                    ],
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

        $this->add_render_attribute( 'heading_text', 'class', 'heading' );

        ?>

		<?php if ( $settings['provix_design_style']  == 'layout-1' ):
			$text  = $settings['heading_text'];
			$image = $settings['heading_image']['url'];
            ?>

            <div class="inline-text-image style-one <?php echo $settings['text_alignment']; ?>">
                <?php
				if ( empty( $text ) ) {
					return;
				}

				$image_html = '<span class="image-wrap"><img src="' . esc_url( $image ) . '" alt=""></span>';

				$output = str_replace( '{image}', $image_html, $text );
				?>
				<h2 class="heading">
					<?php echo wp_kses_post( $output ); ?>
				</h2>

				<div class="full-img">

				</div>
            </div>

		<?php elseif( $settings['provix_design_style']  == 'layout-2' ): ?>

            <div class="section-subtitle style-one <?php echo $settings['text_alignment']; ?>">
                <h2 class="subtitle">
                    <span><?php echo $settings['provix_subtitle']; ?></span>
                </h2>
            </div>

        <?php endif; ?>

        <?php 
	}
}

$widgets_manager->register( new Image_Heading() );