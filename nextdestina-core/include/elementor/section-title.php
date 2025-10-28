<?php
namespace NextdestinaCore\Widgets;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Nextdestina Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Nextdestina_Section_Title extends \Elementor\Widget_Base {

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
		return 'section-title';
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
		return __( 'Section Title', 'nextdestinacore' );
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
		return 'nextdestina-icon';
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
		return [ 'nextdestinacore' ];
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
		return [ 'nextdestinacore' ];
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
            'nextdestina_layout',
            [
                'label' => esc_html__('Design Layout', 'nextdestinacore'),
            ]
        );
        $this->add_control(
            'nextdestina_design_style',
            [
                'label' => esc_html__('Select Layout', 'nextdestinacore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'layout-1' => esc_html__('Layout 1', 'nextdestinacore'),
                    'layout-2' => esc_html__('Layout 2', 'nextdestinacore'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        
        /**
         * Title and content section
         */
        $this->start_controls_section(
            'nextdestina_section_title',
            [
                'label' => esc_html__('Title & Content', 'nextdestinacore'),
            ]
        );
        
        $this->add_control(
            'nextdestina_title',
            [
                'label' => esc_html__('Title', 'nextdestinacore'),
                'description' => nextdestina_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Title Here', 'nextdestinacore'),
                'placeholder' => esc_html__('Type title', 'nextdestinacore'),
                'label_block' => true,
            ]
        );
        
        $this->add_control(
            'nextdestina_title_color',
            [
                'label' => __( 'Title Color', 'nextdestinacore' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .section-title h3' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'nextdestina_description',
            [
                'label' => esc_html__('Description', 'nextdestinacore'),
                'description' => nextdestina_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Nextdestina section description here', 'nextdestinacore'),
                'placeholder' => esc_html__('Type section description here', 'nextdestinacore'),
            ]
        );

        $this->add_control(
            'nextdestina_description_color',
            [
                'label' => __( 'Description Color', 'nextdestinacore' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .about-two-right-content p' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'nextdestina_title_tag',
            [
                'label' => esc_html__('Title HTML Tag', 'nextdestinacore'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'h1' => [
                        'title' => esc_html__('H1', 'nextdestinacore'),
                        'icon' => 'eicon-editor-h1'
                    ],
                    'h2' => [
                        'title' => esc_html__('H2', 'nextdestinacore'),
                        'icon' => 'eicon-editor-h2'
                    ],
                    'h3' => [
                        'title' => esc_html__('H3', 'nextdestinacore'),
                        'icon' => 'eicon-editor-h3'
                    ],
                    'h4' => [
                        'title' => esc_html__('H4', 'nextdestinacore'),
                        'icon' => 'eicon-editor-h4'
                    ],
                    'h5' => [
                        'title' => esc_html__('H5', 'nextdestinacore'),
                        'icon' => 'eicon-editor-h5'
                    ],
                    'h6' => [
                        'title' => esc_html__('H6', 'nextdestinacore'),
                        'icon' => 'eicon-editor-h6'
                    ]
                ],
                'default' => 'h2',
                'toggle' => false,
            ]
        );

        $this->add_responsive_control(
            'nextdestina_align',
            [
                'label' => esc_html__('Alignment', 'nextdestinacore'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'text-left' => [
                        'title' => esc_html__('Left', 'nextdestinacore'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'text-center' => [
                        'title' => esc_html__('Center', 'nextdestinacore'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'text-right' => [
                        'title' => esc_html__('Right', 'nextdestinacore'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'left',
                'toggle' => false,
            ]
        );

        $this->add_control(
            'nextdestina_page_link',
            [
                'label' => esc_html__('Page Link', 'nextdestinacore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('https://your-link.com', 'nextdestinacore'),
                'title' => esc_html__('Enter link', 'nextdestinacore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'nextdestina_video_url',
            [
                'label' => esc_html__('Video Url', 'nextdestinacore'),
                'description' => nextdestina_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('https://www.youtube.com/watch?v=kS0X-yIsB64', 'nextdestinacore'),
                'placeholder' => esc_html__('Type video url', 'nextdestinacore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'text_inside_circle',
            [
                'label' => esc_html__('Text Inside Circle', 'nextdestinacore'),
                'description' => nextdestina_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('BEST WALLPAPERS FOR YOUR INTERIOR • ', 'nextdestinacore'),
                'placeholder' => esc_html__('Type text for inside circle', 'nextdestinacore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'text_inside_circle_color',
            [
                'label' => __( 'Text Inside Circle Color', 'nextdestinacore' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .round-box-content span' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();


        /**
         * Image section
         */
		$this->start_controls_section(
            '_nextdestina_image',
            [
                'label' => esc_html__('Image', 'nextdestinacore'),
            ]
        );
        $this->add_control(
            'nextdestina_about_left_image',
            [
                'label' => esc_html__( 'Left Image', 'nextdestinacore' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        
        $this->add_control(
            'nextdestina_about_right_image',
            [
                'label' => esc_html__( 'Right Image', 'nextdestinacore' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'nextdestina_about_right_image_2',
            [
                'label' => esc_html__( 'Right Image 2', 'nextdestinacore' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'nextdestina_design_style' => 'layout-1',
                ],
            ]
        );


        $this->add_group_control(
            \Elementor\Group_Control_Image_Size::get_type(),
            [
                'name' => 'nextdestina_image_size',
                'default' => 'full',
                'exclude' => [
                    'custom'
                ]
            ]
        );
        $this->add_control(
            'nextdestina_image_overlap',
            [
                'label' => esc_html__('Image overlap to top?', 'nextdestinacore'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'nextdestinacore'),
                'label_off' => esc_html__('No', 'nextdestinacore'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );
        $this->add_responsive_control(
            'nextdestina_image_height',
            [
                'label' => esc_html__( 'Image Height', 'nextdestinacore' ),
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
                    '{{WRAPPER}} .nextdestina-overlap img' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'nextdestina_image_overlap_x',
            [
                'label' => esc_html__( 'Image overlap position', 'nextdestinacore' ),
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
                    '{{WRAPPER}} .nextdestina-overlap img' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
                'condition' => array(
                    'nextdestina_image_overlap' => 'yes',
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
                'label' => esc_html__( 'General', 'nextdestinacore' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'text_alignment',
            [
                'label' => esc_html__( 'Alignment', 'nextdestinacore' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => '',
                'options' => [
                    '' => esc_html__( 'Left', 'nextdestinacore' ),
                    'center'  => esc_html__( 'Center', 'nextdestinacore' ),
                    'right' => esc_html__( 'Right', 'nextdestinacore' ),
                ],
            ]
        );
        $this->add_responsive_control(
            'width',
            [
                'label' => esc_html__( 'Width', 'nextdestinacore' ),
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
                'label' => esc_html__( 'Title', 'nextdestinacore' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
            $this->add_control(
                'title_color',
                [
                    'label' => esc_html__( 'Color', 'nextdestinacore' ),
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
                    'label' => esc_html__( 'Margin', 'nextdestinacore' ),
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
                'label' => esc_html__( 'Description', 'nextdestinacore' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
            $this->add_control(
                'description_color',
                [
                    'label' => esc_html__( 'Color', 'nextdestinacore' ),
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
                    'label' => esc_html__( 'Margin', 'nextdestinacore' ),
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
				'label' => __( 'Style', 'nextdestinacore' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'text_transform',
			[
				'label' => __( 'Text Transform', 'nextdestinacore' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => __( 'None', 'nextdestinacore' ),
					'uppercase' => __( 'UPPERCASE', 'nextdestinacore' ),
					'lowercase' => __( 'lowercase', 'nextdestinacore' ),
					'capitalize' => __( 'Capitalize', 'nextdestinacore' ),
				],
				'selectors' => [
					'{{WRAPPER}} .title' => 'text-transform: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render the widget ounextdestinaut on the frontend.
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

		<?php if ( $settings['nextdestina_design_style']  == 'layout-2' ): 
            
            if ( !empty($settings['nextdestina_about_left_image']['url']) ) {
                $nextdestina_about_left_image = !empty($settings['nextdestina_about_left_image']['id']) ? wp_get_attachment_image_url( $settings['nextdestina_about_left_image']['id'], $settings['nextdestina_image_size_size']) : $settings['nextdestina_about_left_image']['url'];
                $nextdestina_about_left_image_alt = get_post_meta($settings["nextdestina_about_left_image"]["id"], "_wp_attachment_image_alt", true);
            } 
            if ( !empty($settings['nextdestina_about_right_image']['url']) ) {
                $nextdestina_about_right_image = !empty($settings['nextdestina_about_right_image']['id']) ? wp_get_attachment_image_url( $settings['nextdestina_about_right_image']['id'], $settings['nextdestina_image_size_size']) : $settings['nextdestina_about_right_image']['url'];
                $nextdestina_about_right_image_alt = get_post_meta($settings["nextdestina_about_right_image"]["id"], "_wp_attachment_image_alt", true);
            } 
        ?>
            <!-- about -->
            <section class="about">
                <div class="container">
                    <div class="common-title">
                        <img src="<?php echo get_template_directory_uri() .  '/assets/img/shape/line-left.png';?>" alt="shape">
                        <?php
                            if ( !empty($settings['nextdestina_title' ]) ) :
                                printf( '<%1$s %2$s>%3$s</%1$s>',
                                    tag_escape( $settings['nextdestina_title_tag'] ),
                                    $this->get_render_attribute_string( 'title_args' ),
                                    nextdestina_kses( $settings['nextdestina_title' ] )
                                    );
                            endif;
                        ?>
                    </div>
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="about-left-image">
                                <?php if ($settings['nextdestina_about_left_image']['url'] || $settings['nextdestina_about_left_image']['id']) : ?>
                                    <img src="<?php echo esc_url($nextdestina_about_left_image); ?>" alt="<?php echo esc_attr($nextdestina_about_left_image_alt); ?>">
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
                                    <?php if ( !empty($settings['nextdestina_description']) ) : ?>
                                        <p><?php echo nextdestina_kses( $settings['nextdestina_description'] ); ?></p>
                                    <?php endif; ?>
                                </div>
                                <div class="about-right-content">
                                    <div class="about-right-content-round">
                                        <div class="about-round-text">
                                            <div class="round-box-content">
                                                <span class="curved-circle"><?php echo nextdestina_kses($settings['text_inside_circle']); ?> </span>
                                                <div class="round-box-icon">
                                                    <a href="<?php echo esc_url($settings['nextdestina_page_link']); ?>"><img src="<?php echo get_template_directory_uri() .  '/assets/img/icons/arrow-big-black.png';?>" alt="arrow"></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="about-right-content-image">
                                        <?php if ($settings['nextdestina_about_right_image']['url'] || $settings['nextdestina_about_right_image']['id']) : ?>
                                            <img src="<?php echo esc_url($nextdestina_about_right_image); ?>" alt="<?php echo esc_attr($nextdestina_about_right_image_alt); ?>">
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- about -->

		<?php else: 
            if ( !empty($settings['nextdestina_about_left_image']['url']) ) {
                $nextdestina_about_left_image = !empty($settings['nextdestina_about_left_image']['id']) ? wp_get_attachment_image_url( $settings['nextdestina_about_left_image']['id'], $settings['nextdestina_image_size_size']) : $settings['nextdestina_about_left_image']['url'];
                $nextdestina_about_left_image_alt = get_post_meta($settings["nextdestina_about_left_image"]["id"], "_wp_attachment_image_alt", true);
            } 
            if ( !empty($settings['nextdestina_about_right_image']['url']) ) {
                $nextdestina_about_right_image = !empty($settings['nextdestina_about_right_image']['id']) ? wp_get_attachment_image_url( $settings['nextdestina_about_right_image']['id'], $settings['nextdestina_image_size_size']) : $settings['nextdestina_about_right_image']['url'];
                $nextdestina_about_right_image_alt = get_post_meta($settings["nextdestina_about_right_image"]["id"], "_wp_attachment_image_alt", true);
            } 
            if ( !empty($settings['nextdestina_about_right_image_2']['url']) ) {
                $nextdestina_about_right_image_2 = !empty($settings['nextdestina_about_right_image_2']['id']) ? wp_get_attachment_image_url( $settings['nextdestina_about_right_image_2']['id'], $settings['nextdestina_image_size_size']) : $settings['nextdestina_about_right_image_2']['url'];
                $nextdestina_about_right_image_2_alt = get_post_meta($settings["nextdestina_about_right_image_2"]["id"], "_wp_attachment_image_alt", true);
            } 
        ?>


            <?php
                $image_url = NEXTDESTINA_ADDONS_URL . 'assets/img/common-title-shape-1.png';
            ?>
            <div class="section-title style-one <?php echo $settings['text_alignment']; ?>">
                <h2><?php echo $settings['nextdestina_title']; ?></h2>
                <?php if(!empty($settings['nextdestina_description'])) : ?>
                    <p><?php echo $settings['nextdestina_description']; ?></p>
                <?php endif ?>
            </div>

        <?php endif; ?>

        <?php 
	}
}

$widgets_manager->register( new Nextdestina_Section_Title() );