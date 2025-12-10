<?php
namespace RaizenCore\Widgets;

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Raizen Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Raizen_Hero_Banner extends \Elementor\Widget_Base {

	public function get_name() {
		return 'hero-banner';
	}

	public function get_title() {
		return __( 'Hero Banner', 'raizencore' );
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
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'banner_content',
            [
                'label' => esc_html__( 'Content', 'raizencore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
            $this->add_control(
                'subtitle',
                [
                    'label' => esc_html__( 'Subtitle', 'raizencore' ),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => esc_html__( 'Default Subtitle' , 'raizencore' ),
                    'label_block' => true,
                ]
            );
            $this->add_control(
                'name',
                [
                    'label' => esc_html__( 'Name', 'raizencore' ),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => esc_html__( 'Raizen' , 'raizencore' ),
                    'label_block' => true,
                ]
            );
            $this->add_control(
                'designation',
                [
                    'label' => esc_html__( 'Designation', 'raizencore' ),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => esc_html__( 'Developer' , 'raizencore' ),
                    'label_block' => true,
                ]
            );
            $this->add_control(
                'title_1',
                [
                    'label' => esc_html__( 'Title 1', 'raizencore' ),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => esc_html__( 'Default Title' , 'raizencore' ),
                    'label_block' => true,
                ]
            );
            $this->add_control(
                'title_2',
                [
                    'label' => esc_html__( 'Title 2', 'raizencore' ),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => esc_html__( 'Default Title' , 'raizencore' ),
                    'label_block' => true,
                ]
            );
            $this->add_control(
                'description',
                [
                    'label' => esc_html__( 'Description', 'raizencore' ),
                    'type' => \Elementor\Controls_Manager::TEXTAREA,
                    'default' => esc_html__( 'Default Description' , 'raizencore' ),
                ]
            );
            $this->add_control(
                'hero_shape1',
                [
                    'label' => esc_html__( 'Shape 1', 'raizencore' ),
                    'type' => \Elementor\Controls_Manager::MEDIA,
                ]
            );
            $this->add_control(
                'circuler_image',
                [
                    'label' => esc_html__( 'Circuler Image', 'raizencore' ),
                    'type' => \Elementor\Controls_Manager::MEDIA,
                ]
            );
            $this->add_control(
                'circuler_text',
                [
                    'label' => esc_html__( 'Circuler Text', 'raizencore' ),
                    'type' => \Elementor\Controls_Manager::TEXTAREA,
                    'default' => esc_html__( 'Get free consultation get free consultation get free consultation' , 'raizencore' ),
                ]
            );
        $this->end_controls_section();

        // $this->start_controls_section(
        //     'background_section',
        //     [
        //         'label' => esc_html__( 'Background', 'raizencore' ),
        //         'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
        //     ]
        // );

        //     $this->add_group_control(
        //         \Elementor\Group_Control_Background::get_type(),
        //         [
        //             'name' => 'background',
        //             'types' => [ 'classic', 'gradient', 'video' ],
        //             'selector' => '{{WRAPPER}} .banner-area',
        //         ]
        //     );

        // $this->end_controls_section();

        $this->start_controls_section(
            'image_section',
            [
                'label' => esc_html__( 'Image', 'raizencore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
            $this->add_control(
                'hero_image1',
                [
                    'label' => esc_html__( 'Image 1', 'raizencore' ),
                    'type' => \Elementor\Controls_Manager::MEDIA,
                    'default' => [
                        'url' => \Elementor\Utils::get_placeholder_image_src(),
                    ],
                ]
            );
            $this->add_control(
                'hero_image2',
                [
                    'label' => esc_html__( 'Image 2', 'raizencore' ),
                    'type' => \Elementor\Controls_Manager::MEDIA,
                    'default' => [
                        'url' => \Elementor\Utils::get_placeholder_image_src(),
                    ],
                ]
            );
            $this->add_control(
                'hero_image3',
                [
                    'label' => esc_html__( 'Image 3', 'raizencore' ),
                    'type' => \Elementor\Controls_Manager::MEDIA,
                    'default' => [
                        'url' => \Elementor\Utils::get_placeholder_image_src(),
                    ],
                ]
            );

        $this->end_controls_section();

        $this->start_controls_section(
            'exp_box_section',
            [
                'label' => esc_html__( 'Experience Box', 'raizencore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'box_text1',
            [
                'label' => esc_html__( 'Text 1', 'raizencore' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Default title', 'raizencore' ),
                'placeholder' => esc_html__( 'Type your title here', 'raizencore' ),
            ]
        );
        $this->add_control(
            'box_text2',
            [
                'label' => esc_html__( 'Text 2', 'raizencore' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Default title', 'raizencore' ),
                'placeholder' => esc_html__( 'Type your title here', 'raizencore' ),
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'button_section',
            [
                'label' => esc_html__( 'Button', 'raizencore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
            $this->add_control(
                'button1_text',
                [
                    'label' => esc_html__( 'Button 1 Text', 'raizencore' ),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => esc_html__( 'Click Here' , 'raizencore' ),
                    'label_block' => true,
                ]
            );
            $this->add_control(
                'button1_link',
                [
                    'label' => esc_html__( 'Button 1 Link', 'raizencore' ),
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
            $this->add_control(
                'button2_text',
                [
                    'label' => esc_html__( 'Button 2 Text', 'raizencore' ),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => esc_html__( 'Click Here' , 'raizencore' ),
                    'label_block' => true,
                ]
            );
            $this->add_control(
                'button2_link',
                [
                    'label' => esc_html__( 'Button 2 Link', 'raizencore' ),
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

		/**
         * Style section
         */
		$this->start_controls_section(
			'section_style',
			[
				'label' => __( 'Style', 'raizencore' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'text_transform',
			[
				'label' => __( 'Text Transform', 'raizencore' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => __( 'None', 'raizencore' ),
					'uppercase' => __( 'UPPERCASE', 'raizencore' ),
					'lowercase' => __( 'lowercase', 'raizencore' ),
					'capitalize' => __( 'Capitalize', 'raizencore' ),
				],
				'selectors' => [
					'{{WRAPPER}} .title' => 'text-transform: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();


        $this->start_controls_section(
            'subtitle_style',
            [
                'label' => esc_html__( 'Subtitle', 'raizencore' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'subtitle_color',
            [
                'label' => esc_html__( 'Color', 'raizencore' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .banner-area .subtitle' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'name_style',
            [
                'label' => esc_html__( 'Name', 'raizencore' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'name_color',
            [
                'label' => esc_html__( 'Color', 'raizencore' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .banner-area .name' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'description_style',
            [
                'label' => esc_html__( 'Description', 'raizencore' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label' => esc_html__( 'Color', 'raizencore' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .banner-area .description' => 'color: {{VALUE}}',
                ],
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
        ?>

        <?php if ( $settings['raizen_design_style']  == 'layout-1' ): 

            if ( !empty($settings['hero_image1']['url']) ) {
                $raizen_hero_image = !empty($settings['hero_image1']['id']) ? wp_get_attachment_image_url( $settings['hero_image1']['id'], '') : $settings['hero_image1']['url'];
                $raizen_hero_image_alt = get_post_meta($settings["hero_image1"]["id"], "_wp_attachment_image_alt", true);
            }
            if ( !empty($settings['hero_image2']['url']) ) {
                $hero_image2 = !empty($settings['hero_image2']['id']) ? wp_get_attachment_image_url( $settings['hero_image2']['id'], '') : $settings['hero_image2']['url'];
                $hero_image2_alt = get_post_meta($settings["hero_image2"]["id"], "_wp_attachment_image_alt", true);
            }
            if ( !empty($settings['hero_shape1']['url']) ) {
                $hero_shape1 = !empty($settings['hero_shape1']['id']) ? wp_get_attachment_image_url( $settings['hero_shape1']['id'], '') : $settings['hero_shape1']['url'];
                $hero_shape1_alt = get_post_meta($settings["hero_shape1"]["id"], "_wp_attachment_image_alt", true);
            }
            if ( !empty($settings['circuler_image']['url']) ) {
                $circuler_image = !empty($settings['circuler_image']['id']) ? wp_get_attachment_image_url( $settings['circuler_image']['id'], '') : $settings['circuler_image']['url'];
                $circuler_image_alt = get_post_meta($settings["circuler_image"]["id"], "_wp_attachment_image_alt", true);
            }
            
            $this->add_render_attribute('title_args', 'class', 'banner-title');

        ?>

        <div class="banner-area style-one">
            <div class="container">
                <div class="wrapper">
                    <h3 class="subtitle wow fadeInDown" data-wow-delay="700ms"><?php echo $settings['subtitle']; ?></h3>

                    <?php if(!empty($settings['name'])) : ?>
                        <div class="name-wrapper">
                            <h2 class="name"><?php echo $settings['name']; ?></h2>
                            <div class="line"></div>
                        </div>
                    <?php endif; ?>

                    <?php if(!empty($settings['description'])) : ?>
                        <p class="description wow fadeInUp" data-wow-delay="700ms"><?php echo $settings['description']; ?></p>
                    <?php endif; ?>
                    
                    <div class="box-wrap">
                    <div class="circle-box wow fadeInDownBig">
                        <div class="circuler-text">
                            <?php if( !empty($circuler_image) ) : ?>
                                <img src="<?php echo esc_url($circuler_image); ?>" alt="">
                            <?php endif; ?>
                        </div>
                        <div class="circuler-center">
                            <a href="#">
                                <?php if( !empty($hero_image2) ) : ?>
                                    <img src="<?php echo esc_url($hero_image2); ?>" alt="">
                                <?php endif; ?>
                            </a>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            <div class="image wow fadeInUpBig">
                <img src="<?php echo esc_url($raizen_hero_image); ?>" alt="">
            </div>
        </div>

        <?php elseif ( $settings['raizen_design_style']  == 'layout-2' ):

            if ( !empty($settings['hero_image1']['url']) ) {
                $raizen_hero_image = !empty($settings['hero_image1']['id']) ? wp_get_attachment_image_url( $settings['hero_image1']['id'], '') : $settings['hero_image1']['url'];
                $raizen_hero_image_alt = get_post_meta($settings["hero_image1"]["id"], "_wp_attachment_image_alt", true);
            }
            if ( !empty($settings['hero_image2']['url']) ) {
                $hero_image2 = !empty($settings['hero_image2']['id']) ? wp_get_attachment_image_url( $settings['hero_image2']['id'], '') : $settings['hero_image2']['url'];
                $hero_image2_alt = get_post_meta($settings["hero_image2"]["id"], "_wp_attachment_image_alt", true);
            }
            if ( !empty($settings['hero_shape1']['url']) ) {
                $hero_shape1 = !empty($settings['hero_shape1']['id']) ? wp_get_attachment_image_url( $settings['hero_shape1']['id'], '') : $settings['hero_shape1']['url'];
                $hero_shape1_alt = get_post_meta($settings["hero_shape1"]["id"], "_wp_attachment_image_alt", true);
            }
            if ( !empty($settings['circuler_image']['url']) ) {
                $circuler_image = !empty($settings['circuler_image']['id']) ? wp_get_attachment_image_url( $settings['circuler_image']['id'], '') : $settings['circuler_image']['url'];
                $circuler_image_alt = get_post_meta($settings["circuler_image"]["id"], "_wp_attachment_image_alt", true);
            }
            
            $this->add_render_attribute('title_args', 'class', 'banner-title');

            ?>
        
            <div class="banner-area style-two">
                <div class="exp-box">
                    <div class="inner-box">
                        <div class="text-content">
                            <h4 class="year"><?php echo $settings['box_text1']; ?></h4>
                            <p class="text"><?php echo $settings['box_text2']; ?></p>
                        </div>
                    </div>
                </div>
                <div class="content">
                    <div class="title-wrap">
                    <?php if(!empty($settings['title_1'])) : ?>
                        <h2 class="title1"><?php echo $settings['title_1']; ?></h2><span class="line"></span>
                    <?php endif; ?>
                    </div>

                    <?php if(!empty($settings['title_2'])) : ?>
                        <h2 class="title2">
                            <?php echo $settings['title_2']; ?>
                            <div class="toggle">
                                <div class="circle"></div>
                            </div>
                        </h2>
                    <?php endif; ?>
                </div>
                <div class="image wow fadeInUp">
                    <div class="circle-box">
                        <div class="circuler-text">
                            <?php if( !empty($circuler_image) ) : ?>
                                <img src="<?php echo esc_url($circuler_image); ?>" alt="">
                            <?php endif; ?>
                        </div>
                        <div class="circuler-center">
                            <a href="#">
                                <?php if( !empty($hero_image2) ) : ?>
                                    <img src="<?php echo esc_url($hero_image2); ?>" alt="">
                                <?php endif; ?>
                            </a>
                        </div>
                    </div>
                    <?php if( !empty($raizen_hero_image) ) : ?>
                        <img class="main-img" src="<?php echo esc_url($raizen_hero_image); ?>" alt="">
                    <?php endif; ?>
                </div>
            </div>

        <?php elseif ( $settings['raizen_design_style']  == 'layout-3' ):

            if ( !empty($settings['hero_image1']['url']) ) {
                $raizen_hero_image = !empty($settings['hero_image1']['id']) ? wp_get_attachment_image_url( $settings['hero_image1']['id'], '') : $settings['hero_image1']['url'];
                $raizen_hero_image_alt = get_post_meta($settings["hero_image1"]["id"], "_wp_attachment_image_alt", true);
            }
            if ( !empty($settings['hero_shape1']['url']) ) {
                $hero_shape1 = !empty($settings['hero_shape1']['id']) ? wp_get_attachment_image_url( $settings['hero_shape1']['id'], '') : $settings['hero_shape1']['url'];
                $hero_shape1_alt = get_post_meta($settings["hero_shape1"]["id"], "_wp_attachment_image_alt", true);
            }
            if ( !empty($settings['circuler_image']['url']) ) {
                $circuler_image = !empty($settings['circuler_image']['id']) ? wp_get_attachment_image_url( $settings['circuler_image']['id'], '') : $settings['circuler_image']['url'];
                $circuler_image_alt = get_post_meta($settings["circuler_image"]["id"], "_wp_attachment_image_alt", true);
            }

            $icon_url = PROTINE_ADDONS_URL . 'assets/img/icons/download-icon.png';
            $shape_img1 = PROTINE_ADDONS_URL . 'assets/img/hero3-shape1.png';
            $shape_img2 = PROTINE_ADDONS_URL . 'assets/img/hero3-shape2.png';
            ?>

            <div class="banner-area style-three">
                <?php if(!empty($settings['subtitle'])) : ?>
                    <h4 class="subtitle"><?php echo $settings['subtitle']; ?></h4>
                <?php endif; ?>

                <?php if(!empty($settings['title_1'])) : ?>
                    <h2 class="title1"><?php echo $settings['title_1']; ?></h2>
                <?php endif; ?>

                <?php if(!empty($settings['designation'])) : ?>
                    <h2 class="designation"><?php echo $settings['designation']; ?></h2>
                <?php endif; ?>
                
                <div class="box-wrap">
                <div class="circle-box wow fadeInDownBig">
                    <div class="circuler-text">
                        <?php if( !empty($circuler_image) ) : ?>
                            <img src="<?php echo esc_url($circuler_image); ?>" alt="">
                        <?php endif; ?>
                    </div>
                    <div class="circuler-center">
                        <a href="#">
                            <img src="<?php echo esc_url($icon_url); ?>" alt="">
                        </a>
                    </div>
                </div>
                </div>

                <?php if( !empty($raizen_hero_image) ) : ?>
                <div class="image">
                    <img src="<?php echo esc_url($raizen_hero_image); ?>" alt="">
                </div>
                <?php endif; ?>

                <?php if( !empty($shape_img1) ) : ?>
                <div class="shape1">
                    <img src="<?php echo esc_url($shape_img1); ?>" alt="">
                </div>
                <?php endif; ?>
            </div>

        <?php endif; ?>
        <?php
	}
}

$widgets_manager->register( new Raizen_Hero_Banner() );