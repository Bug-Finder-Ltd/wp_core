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
class Protine_Button extends \Elementor\Widget_Base {

	public function get_name() {
		return 'next-button';
	}

	public function get_title() {
		return __( 'Button', 'protinecore' );
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

        $this->start_controls_section(
            'button_section',
            [
                'label' => esc_html__( 'Button', 'protinecore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => esc_html__( 'Text', 'protinecore' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Click Here', 'protinecore' ),
                'placeholder' => esc_html__( 'Type your title here', 'protinecore' ),
            ]
        );
        $this->add_control(
            'button_link',
            [
                'label' => esc_html__( 'Link', 'protinecore' ),
                'type' => \Elementor\Controls_Manager::URL,
                'options' => [ 'url', 'is_external', 'nofollow' ],
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
				'label' => esc_html__( 'Style', 'protinecore' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'button_align',
			[
				'label' => esc_html__( 'Alignment', 'protinecore' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'protinecore' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'protinecore' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'protinecore' ),
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
				'label' => esc_html__( 'Button', 'protinecore' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

            $this->add_control(
                'button_color',
                [
                    'label' => esc_html__( 'Color', 'protinecore' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .single-btn .button' => 'color: {{VALUE}}',
                    ],
                ]
            );
			$this->add_group_control(
				\Elementor\Group_Control_Background::get_type(),
				[
					'name' => 'button_background',
					'types' => [ 'classic', 'gradient' ],
					'selector' => '{{WRAPPER}} .single-btn .button',
				]
			);
			$this->add_control(
                'button_margin',
                [
                    'label' => esc_html__( 'Margin', 'protinecore' ),
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .single-btn .button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
		$this->end_controls_section();

		$this->start_controls_section(
			'button_icon_style',
			[
				'label' => esc_html__( 'Button Icon', 'protinecore' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
			$this->add_control(
				'icon_color',
				[
					'label' => esc_html__( 'Color', 'protinecore' ),
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
					'types' => [ 'classic', 'gradient' ],
					'selector' => '{{WRAPPER}} .single-btn .button i',
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
        ?>

		<?php if ( $settings['protine_design_style']  == 'layout-2' ): ?>

            <div class="single-btn style-two">
                <a href="<?php echo esc_url($settings['button_link']['url']); ?>" class="button">
                	<?php echo $settings['button_text']; ?>
                	<div class="btn-icon">
                        <span class="icon-first"><i class="pi-medicine"></i></span>
                        <span class="icon-second"><i class="pi-medicine"></i></span>
                    </div>
                </a>
            </div>

		<?php else: ?>

            <div class="single-btn style-one">
                <a href="<?php echo esc_url($settings['button_link']['url']); ?>" class="button">
                	<?php echo $settings['button_text']; ?>
                	<div class="btn-icon">
                        <span class="icon-first"><i class="pi-medicine"></i></span>
                        <span class="icon-second"><i class="pi-medicine"></i></span>
                    </div>
                </a>
            </div>

        <?php endif; ?>

        <?php 
	}
}

$widgets_manager->register( new Protine_Button() );