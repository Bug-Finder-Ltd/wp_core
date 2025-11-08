<?php
namespace ZupetCore\Widgets;

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Zupet Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Zupet_Button extends \Elementor\Widget_Base {

	public function get_name() {
		return 'next-button';
	}

	public function get_title() {
		return __( 'Button', 'zupetcore' );
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

        $this->start_controls_section(
            'button_section',
            [
                'label' => esc_html__( 'Button', 'zupetcore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => esc_html__( 'Text', 'zupetcore' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Click Here', 'zupetcore' ),
                'placeholder' => esc_html__( 'Type your title here', 'zupetcore' ),
            ]
        );
        $this->add_control(
            'button_link',
            [
                'label' => esc_html__( 'Link', 'zupetcore' ),
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
				'label' => esc_html__( 'Style', 'zupetcore' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'button_align',
			[
				'label' => esc_html__( 'Alignment', 'zupetcore' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'zupetcore' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'zupetcore' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'zupetcore' ),
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
				'label' => esc_html__( 'Button', 'zupetcore' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

            $this->add_control(
                'button_color',
                [
                    'label' => esc_html__( 'Color', 'zupetcore' ),
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
					'types' => [ 'classic', 'gradient' ],
					'selector' => '{{WRAPPER}} .single-btn .button .button-text',
				]
			);
			$this->add_control(
                'button_margin',
                [
                    'label' => esc_html__( 'Margin', 'zupetcore' ),
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
				'label' => esc_html__( 'Button Icon', 'zupetcore' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
			$this->add_control(
				'icon_color',
				[
					'label' => esc_html__( 'Color', 'zupetcore' ),
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
        ?>

		<?php if ( $settings['zupet_design_style']  == 'layout-1' ):
			$icon_url = PROTINE_ADDONS_URL . 'assets/img/icons/footprint.png';
			?>

			<div class="single-btn style-one">
                <a href="<?php echo esc_url($settings['button_link']['url']); ?>" class="button">
                	<span class="button-text">
                		<span class="main-text"><?php echo $settings['button_text']; ?></span>
                		<span class="hover-text"><?php echo $settings['button_text']; ?></span>
                	</span>
                	<span class="button-icon">
                		<span class="main-text">
                			<img src="<?php echo esc_url($icon_url); ?>" alt="<?php esc_html_e('icon', 'zupetcore'); ?>">
                		</span>
                		<span class="hover-text">
                			<img src="<?php echo esc_url($icon_url); ?>" alt="<?php esc_html_e('icon', 'zupetcore'); ?>">
                		</span>
                	</span>
                </a>
            </div>

		<?php elseif ( $settings['zupet_design_style']  == 'layout-2' ): ?>

            <div class="single-btn style-two">
                <a href="<?php echo esc_url($settings['button_link']['url']); ?>" class="button">
                	<?php echo $settings['button_text']; ?>
                	<i class="pi-medicine"></i>
                </a>
            </div>

        <?php endif; ?>

        <?php 
	}
}

$widgets_manager->register( new Zupet_Button() );