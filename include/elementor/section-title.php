<?php
namespace ProtineCore\Widgets;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Protine Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Protine_Section_Title extends \Elementor\Widget_Base {

	public function get_name() {
		return 'section-title';
	}

	public function get_title() {
		return __( 'Section Title', 'protinecore' );
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
            'protine_section_title',
            [
                'label' => esc_html__('Title & Content', 'protinecore'),
            ]
        );
        
        $this->add_control(
            'protine_title',
            [
                'label' => esc_html__('Title', 'protinecore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Title Here', 'protinecore'),
                'placeholder' => esc_html__('Type title', 'protinecore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'protine_description',
            [
                'label' => esc_html__('Description', 'protinecore'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Protine section description here', 'protinecore'),
                'placeholder' => esc_html__('Type section description here', 'protinecore'),
            ]
        );

        $this->end_controls_section();

        /**
         * Image section
         */
		$this->start_controls_section(
            '_protine_image',
            [
                'label' => esc_html__('Image', 'protinecore'),
            ]
        );
        $this->add_control(
            'protine_about_left_image',
            [
                'label' => esc_html__( 'Left Image', 'protinecore' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        
        $this->add_control(
            'protine_about_right_image',
            [
                'label' => esc_html__( 'Right Image', 'protinecore' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'protine_about_right_image_2',
            [
                'label' => esc_html__( 'Right Image 2', 'protinecore' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'protine_design_style' => 'layout-1',
                ],
            ]
        );


        $this->add_group_control(
            \Elementor\Group_Control_Image_Size::get_type(),
            [
                'name' => 'protine_image_size',
                'default' => 'full',
                'exclude' => [
                    'custom'
                ]
            ]
        );
        $this->add_control(
            'protine_image_overlap',
            [
                'label' => esc_html__('Image overlap to top?', 'protinecore'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'protinecore'),
                'label_off' => esc_html__('No', 'protinecore'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );
        $this->add_responsive_control(
            'protine_image_height',
            [
                'label' => esc_html__( 'Image Height', 'protinecore' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
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
                    '{{WRAPPER}} .protine-overlap img' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'protine_image_overlap_x',
            [
                'label' => esc_html__( 'Image overlap position', 'protinecore' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
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
                    '{{WRAPPER}} .protine-overlap img' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
                'condition' => array(
                    'protine_image_overlap' => 'yes',
                ),
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
                    '{{WRAPPER}} .section-title' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'title_section',
            [
                'label' => esc_html__( 'Title', 'protinecore' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
            $this->add_control(
                'title_color',
                [
                    'label' => esc_html__( 'Color', 'protinecore' ),
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
            $this->add_responsive_control(
                'title_margin',
                [
                    'label' => esc_html__( 'Margin', 'protinecore' ),
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .section-title h2' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_control(
                'highlight_text',
                [
                    'label' => esc_html__( 'Highlight Text', 'protinecore' ),
                    'type' => \Elementor\Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );
            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'title_span_typography',
                    'selector' => '{{WRAPPER}} .section-title h2 span',
                ]
            );
        $this->end_controls_section();

        $this->start_controls_section(
            'description_section',
            [
                'label' => esc_html__( 'Description', 'protinecore' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
            $this->add_control(
                'description_color',
                [
                    'label' => esc_html__( 'Color', 'protinecore' ),
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
                    'label' => esc_html__( 'Margin', 'protinecore' ),
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
				'label' => __( 'Style', 'protinecore' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'text_transform',
			[
				'label' => __( 'Text Transform', 'protinecore' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => __( 'None', 'protinecore' ),
					'uppercase' => __( 'UPPERCASE', 'protinecore' ),
					'lowercase' => __( 'lowercase', 'protinecore' ),
					'capitalize' => __( 'Capitalize', 'protinecore' ),
				],
				'selectors' => [
					'{{WRAPPER}} .title' => 'text-transform: {{VALUE}};',
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
        ?>

		<?php if ( $settings['protine_design_style']  == 'layout-2' ): 
            
            if ( !empty($settings['protine_about_left_image']['url']) ) {
                $protine_about_left_image = !empty($settings['protine_about_left_image']['id']) ? wp_get_attachment_image_url( $settings['protine_about_left_image']['id'], $settings['protine_image_size_size']) : $settings['protine_about_left_image']['url'];
                $protine_about_left_image_alt = get_post_meta($settings["protine_about_left_image"]["id"], "_wp_attachment_image_alt", true);
            } 
            if ( !empty($settings['protine_about_right_image']['url']) ) {
                $protine_about_right_image = !empty($settings['protine_about_right_image']['id']) ? wp_get_attachment_image_url( $settings['protine_about_right_image']['id'], $settings['protine_image_size_size']) : $settings['protine_about_right_image']['url'];
                $protine_about_right_image_alt = get_post_meta($settings["protine_about_right_image"]["id"], "_wp_attachment_image_alt", true);
            } 
        ?>
            <!-- about -->
            <section class="about">
                <div class="container">
                    <div class="common-title">
                        <img src="<?php echo get_template_directory_uri() .  '/assets/img/shape/line-left.png';?>" alt="shape">
                        <?php
                            if ( !empty($settings['protine_title' ]) ) :
                                printf( '<%1$s %2$s>%3$s</%1$s>',
                                    tag_escape( $settings['protine_title_tag'] ),
                                    $this->get_render_attribute_string( 'title_args' ),
                                    protine_kses( $settings['protine_title' ] )
                                    );
                            endif;
                        ?>
                    </div>
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="about-left-image">
                                <?php if ($settings['protine_about_left_image']['url'] || $settings['protine_about_left_image']['id']) : ?>
                                    <img src="<?php echo esc_url($protine_about_left_image); ?>" alt="<?php echo esc_attr($protine_about_left_image_alt); ?>">
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="about-right">
                                <div class="about-right-shape">
                                    <div class="shape">
                                        <img src="<?php echo get_template_directory_uri() .  '/assets/img/shape/about-shape.png';?>" alt="shape">
                                    </div>
                                </div>
                                <div class="about-article">
                                    <?php if ( !empty($settings['protine_description']) ) : ?>
                                        <p><?php echo protine_kses( $settings['protine_description'] ); ?></p>
                                    <?php endif; ?>
                                </div>
                                <div class="about-right-content">
                                    <div class="about-right-content-round">
                                        <div class="about-round-text">
                                            <div class="round-box-content">
                                                <span class="curved-circle"><?php echo protine_kses($settings['text_inside_circle']); ?> </span>
                                                <div class="round-box-icon">
                                                    <a href="<?php echo esc_url($settings['protine_page_link']); ?>"><img src="<?php echo get_template_directory_uri() .  '/assets/img/icons/arrow-big-black.png';?>" alt="arrow"></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="about-right-content-image">
                                        <?php if ($settings['protine_about_right_image']['url'] || $settings['protine_about_right_image']['id']) : ?>
                                            <img src="<?php echo esc_url($protine_about_right_image); ?>" alt="<?php echo esc_attr($protine_about_right_image_alt); ?>">
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- about -->

		<?php else: ?>


            <?php
                $image_url = PROTINE_ADDONS_URL . 'assets/img/common-title-shape-1.png';
            ?>
            <div class="section-title style-one <?php echo $settings['text_alignment']; ?>">
                <h2 class="title"><?php echo $settings['protine_title']; ?></h2>
                <?php if(!empty($settings['protine_description'])) : ?>
                    <p><?php echo $settings['protine_description']; ?></p>
                <?php endif ?>
            </div>

        <?php endif; ?>

        <?php
	}
}

$widgets_manager->register( new Protine_Section_Title() );