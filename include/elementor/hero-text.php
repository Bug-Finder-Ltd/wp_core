<?php
namespace ZupetCore\Widgets;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Zupet Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Zupet_Hero_Text extends \Elementor\Widget_Base {

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'hero-text';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Hero Text', 'zupetcore' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'zupet-icon';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'zupetcore' ];
	}

	/**
	 * Retrieve the list of scripts the widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
	public function get_script_depends() {
		return [ 'zupetcore' ];
	}

	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
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
            'zupet_section_title',
            [
                'label' => esc_html__('Title & Content', 'zupetcore'),
            ]
        );
        
        $this->add_control(
            'title1',
            [
                'label' => esc_html__('Title 1', 'zupetcore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Title Here', 'zupetcore'),
                'placeholder' => esc_html__('Type title', 'zupetcore'),
                'label_block' => true,
            ]
        );
        $this->add_control(
            'animated_text',
            [
                'label' => esc_html__('Animated Text', 'zupetcore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Travel', 'zupetcore'),
                'placeholder' => esc_html__('Enter your text', 'zupetcore'),
                'label_block' => true,
            ]
        );
        $this->add_control(
            'title2',
            [
                'label' => esc_html__('Title 2', 'zupetcore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Title Here', 'zupetcore'),
                'placeholder' => esc_html__('Type title', 'zupetcore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'zupet_description',
            [
                'label' => esc_html__('Description', 'zupetcore'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Zupet section description here', 'zupetcore'),
                'placeholder' => esc_html__('Type section description here', 'zupetcore'),
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
                    '{{WRAPPER}} .section-title' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'title_section',
            [
                'label' => esc_html__( 'Title', 'zupetcore' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
            $this->add_control(
                'title_color',
                [
                    'label' => esc_html__( 'Color', 'zupetcore' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .section-title h2' => 'color: {{VALUE}}',
                    ],
                ]
            );
            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'title_typography',
                    'selector' => '{{WRAPPER}} .section-title h2',
                ]
            );
            $this->add_control(
                'title_margin',
                [
                    'label' => esc_html__( 'Margin', 'zupetcore' ),
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .section-title h2' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
        $this->end_controls_section();

        $this->start_controls_section(
            'description_section',
            [
                'label' => esc_html__( 'Description', 'zupetcore' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
            $this->add_control(
                'description_color',
                [
                    'label' => esc_html__( 'Color', 'zupetcore' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .section-title p' => 'color: {{VALUE}}',
                    ],
                ]
            );
            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'description_typography',
                    'selector' => '{{WRAPPER}} .section-title p',
                ]
            );
            $this->add_control(
                'description_margin',
                [
                    'label' => esc_html__( 'Margin', 'zupetcore' ),
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .section-title p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
        $this->end_controls_section();
        
		$this->start_controls_section(
			'section_style',
			[
				'label' => __( 'Style', 'zupetcore' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'text_transform',
			[
				'label' => __( 'Text Transform', 'zupetcore' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => __( 'None', 'zupetcore' ),
					'uppercase' => __( 'UPPERCASE', 'zupetcore' ),
					'lowercase' => __( 'lowercase', 'zupetcore' ),
					'capitalize' => __( 'Capitalize', 'zupetcore' ),
				],
				'selectors' => [
					'{{WRAPPER}} .title' => 'text-transform: {{VALUE}};',
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
        ?>

		<?php if ( $settings['zupet_design_style']  == 'layout-1' ): ?>
            
            <div class="hero-text style-one">
                <div class="banner-title">
                    <h3>
                        <?php echo esc_html($settings['title1']); ?>

                        <?php if(!empty($settings['animated_text'])) : ?>
                            <span class="banner-title-animation">
                                <span class="banner-title-animation-inner">
                                    <span class=flip>
                                        <span class="flip-text"><?php echo esc_html($settings['animated_text']); ?></span>
                                    </span> 
                                </span>
                            </span>
                        <?php endif; ?>

                        <?php echo esc_html($settings['title2']); ?>
                    </h3>
                </div>
                <p class="description"><?php echo $settings['zupet_description']; ?></p>
            </div>

		<?php elseif ( $settings['zupet_design_style']  == 'layout-2' ):
            
            if ( !empty($settings['zupet_about_left_image']['url']) ) {
                $zupet_about_left_image = !empty($settings['zupet_about_left_image']['id']) ? wp_get_attachment_image_url( $settings['zupet_about_left_image']['id'], $settings['zupet_image_size_size']) : $settings['zupet_about_left_image']['url'];
                $zupet_about_left_image_alt = get_post_meta($settings["zupet_about_left_image"]["id"], "_wp_attachment_image_alt", true);
            } 
            if ( !empty($settings['zupet_about_right_image']['url']) ) {
                $zupet_about_right_image = !empty($settings['zupet_about_right_image']['id']) ? wp_get_attachment_image_url( $settings['zupet_about_right_image']['id'], $settings['zupet_image_size_size']) : $settings['zupet_about_right_image']['url'];
                $zupet_about_right_image_alt = get_post_meta($settings["zupet_about_right_image"]["id"], "_wp_attachment_image_alt", true);
            } 
            if ( !empty($settings['zupet_about_right_image_2']['url']) ) {
                $zupet_about_right_image_2 = !empty($settings['zupet_about_right_image_2']['id']) ? wp_get_attachment_image_url( $settings['zupet_about_right_image_2']['id'], $settings['zupet_image_size_size']) : $settings['zupet_about_right_image_2']['url'];
                $zupet_about_right_image_2_alt = get_post_meta($settings["zupet_about_right_image_2"]["id"], "_wp_attachment_image_alt", true);
            } 
        ?>


            <?php
                $image_url = PROTINE_ADDONS_URL . 'assets/img/common-title-shape-1.png';
            ?>
            <div class="section-title style-one <?php echo $settings['text_alignment']; ?>">
                <h2><?php echo $settings['zupet_title']; ?></h2>
                <?php if(!empty($settings['zupet_description'])) : ?>
                    <p><?php echo $settings['zupet_description']; ?></p>
                <?php endif ?>
            </div>

        <?php endif; ?>

        <?php 
	}
}

$widgets_manager->register( new Zupet_Hero_Text() );