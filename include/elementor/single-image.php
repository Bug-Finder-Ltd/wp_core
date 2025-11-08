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
class Zupet_Image extends \Elementor\Widget_Base {

	public function get_name() {
		return 'next-image';
	}

	public function get_title() {
		return __( 'Image', 'zupetcore' );
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
                    'layout-3' => esc_html__('Layout 3', 'zupetcore'),
                    'layout-4' => esc_html__('Layout 4', 'zupetcore'),
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
            'zupet_title',
            [
                'label' => esc_html__('Title', 'zupetcore'),
                'description' => zupet_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Title Here', 'zupetcore'),
                'placeholder' => esc_html__('Type title', 'zupetcore'),
                'label_block' => true,
            ]
        );
        
        $this->add_control(
            'zupet_title_color',
            [
                'label' => __( 'Title Color', 'zupetcore' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .section-title h3' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'zupet_description',
            [
                'label' => esc_html__('Description', 'zupetcore'),
                'description' => zupet_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Zupet section description here', 'zupetcore'),
                'placeholder' => esc_html__('Type section description here', 'zupetcore'),
            ]
        );

        $this->add_control(
            'zupet_description_color',
            [
                'label' => __( 'Description Color', 'zupetcore' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .about-two-right-content p' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'zupet_title_tag',
            [
                'label' => esc_html__('Title HTML Tag', 'zupetcore'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'h1' => [
                        'title' => esc_html__('H1', 'zupetcore'),
                        'icon' => 'eicon-editor-h1'
                    ],
                    'h2' => [
                        'title' => esc_html__('H2', 'zupetcore'),
                        'icon' => 'eicon-editor-h2'
                    ],
                    'h3' => [
                        'title' => esc_html__('H3', 'zupetcore'),
                        'icon' => 'eicon-editor-h3'
                    ],
                    'h4' => [
                        'title' => esc_html__('H4', 'zupetcore'),
                        'icon' => 'eicon-editor-h4'
                    ],
                    'h5' => [
                        'title' => esc_html__('H5', 'zupetcore'),
                        'icon' => 'eicon-editor-h5'
                    ],
                    'h6' => [
                        'title' => esc_html__('H6', 'zupetcore'),
                        'icon' => 'eicon-editor-h6'
                    ]
                ],
                'default' => 'h2',
                'toggle' => false,
            ]
        );

        $this->add_responsive_control(
            'zupet_align',
            [
                'label' => esc_html__('Alignment', 'zupetcore'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'text-left' => [
                        'title' => esc_html__('Left', 'zupetcore'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'text-center' => [
                        'title' => esc_html__('Center', 'zupetcore'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'text-right' => [
                        'title' => esc_html__('Right', 'zupetcore'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'left',
                'toggle' => false,
            ]
        );

        $this->add_control(
            'zupet_page_link',
            [
                'label' => esc_html__('Page Link', 'zupetcore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('https://your-link.com', 'zupetcore'),
                'title' => esc_html__('Enter link', 'zupetcore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'zupet_video_url',
            [
                'label' => esc_html__('Video Url', 'zupetcore'),
                'description' => zupet_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('https://www.youtube.com/watch?v=kS0X-yIsB64', 'zupetcore'),
                'placeholder' => esc_html__('Type video url', 'zupetcore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'text_inside_circle',
            [
                'label' => esc_html__('Text Inside Circle', 'zupetcore'),
                'description' => zupet_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('BEST WALLPAPERS FOR YOUR INTERIOR • ', 'zupetcore'),
                'placeholder' => esc_html__('Type text for inside circle', 'zupetcore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'text_inside_circle_color',
            [
                'label' => __( 'Text Inside Circle Color', 'zupetcore' ),
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
            'zupet_image',
            [
                'label' => esc_html__('Image', 'zupetcore'),
            ]
        );
        $this->add_control(
            'zupet_image_one',
            [
                'label' => esc_html__( 'Image One', 'zupetcore' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        
        $this->add_control(
            'zupet_image_two',
            [
                'label' => esc_html__( 'Image Two', 'zupetcore' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'zupet_image_three',
            [
                'label' => esc_html__( 'Image Three', 'zupetcore' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );


        $this->add_group_control(
            \Elementor\Group_Control_Image_Size::get_type(),
            [
                'name' => 'zupet_image_size',
                'default' => 'full',
                'exclude' => [
                    'custom'
                ]
            ]
        );
        $this->add_control(
            'zupet_image_overlap',
            [
                'label' => esc_html__('Image overlap to top?', 'zupetcore'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'zupetcore'),
                'label_off' => esc_html__('No', 'zupetcore'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );
        $this->add_responsive_control(
            'zupet_image_height',
            [
                'label' => esc_html__( 'Image Height', 'zupetcore' ),
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
                    '{{WRAPPER}} .zupet-overlap img' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'zupet_image_overlap_x',
            [
                'label' => esc_html__( 'Image overlap position', 'zupetcore' ),
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
                    '{{WRAPPER}} .zupet-overlap img' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
                'condition' => array(
                    'zupet_image_overlap' => 'yes',
                ),
            ]
        );

        $this->end_controls_section();


        /**
         * Style section
         */
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

        $this->start_controls_section(
            'image1_style',
            [
                'label' => __( 'Image 1', 'zupetcore' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
            $this->add_group_control(
                \Elementor\Group_Control_Border::get_type(),
                [
                    'name' => 'image1_border',
                    'selector' => '{{WRAPPER}} .image-box .image',
                ]
            );
            $this->add_control(
                'image1_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'zupetcore' ),
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .image-box .image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

            <?php
                if ( !empty($settings['zupet_image_one']['url']) ) {
                    $image_1 = !empty($settings['zupet_image_one']['id']) ? wp_get_attachment_image_url( $settings['zupet_image_one']['id'], '') : $settings['zupet_image_one']['url'];
                }
            ?>

            <div class="image-box style-one">
                <div class="image feature-image">
                    <?php if ($settings['zupet_image_one']['url'] || $settings['zupet_image_one']['id']) : ?>
                        <img src="<?php echo esc_url($image_1); ?>" alt="image">
                    <?php endif; ?>
                    <div class="overlay-top"></div>
                    <div class="overlay-bottom"></div>
                </div>
            </div>

		<?php elseif ( $settings['zupet_design_style']  == 'layout-2' ): ?>
            
            <?php
                if ( !empty($settings['zupet_image_one']['url']) ) {
                    $image_1 = !empty($settings['zupet_image_one']['id']) ? wp_get_attachment_image_url( $settings['zupet_image_one']['id'], '') : $settings['zupet_image_one']['url'];
                }
            ?>

            <div class="image-box style-two">
                <div class="image feature-image">
                    <?php if ($settings['zupet_image_one']['url'] || $settings['zupet_image_one']['id']) : ?>
                        <img src="<?php echo esc_url($image_1); ?>" alt="image">
                    <?php endif; ?>
                </div>
            </div>

        <?php elseif ( $settings['zupet_design_style']  == 'layout-3' ): ?>
            <?php
                if ( !empty($settings['zupet_image_one']['url']) ) {
                    $image_1 = !empty($settings['zupet_image_one']['id']) ? wp_get_attachment_image_url( $settings['zupet_image_one']['id'], '') : $settings['zupet_image_one']['url'];
                }
            ?>
            <div class="image-box style-three">
                <div class="image-one wow zoomIn" data-wow-delay="00ms" data-wow-duration="2000ms">
                    <img src="<?php echo esc_url($image_1); ?>" alt="image">
                </div>
            </div>

        <?php elseif ( $settings['zupet_design_style']  == 'layout-4' ): ?>

            <?php
                $plane_image = PROTINE_ADDONS_URL . 'assets/img/plane.png';
                $gallery_image = PROTINE_ADDONS_URL . 'assets/img/gallery.png';
                $bg_image = PROTINE_ADDONS_URL . 'assets/img/exprience-bg.png';
            ?>

            <div class="image-box style-three">
                <div class="plane">
                    <img src="<?php echo esc_url($plane_image); ?>" alt="plane">
                </div>
                <div class="gallery">
                    <img src="<?php echo esc_url($gallery_image); ?>" alt="image">
                </div>
                <div class="experience-right-bg">
                    <img src="<?php echo esc_url($bg_image); ?>" alt="bg">
                </div>
                <div class="image-one paroller" style="transform: translateY(11px);">
                    <img src="<?php echo $settings['zupet_image_one']['url']; ?>" alt="image">
                </div>
                <div class="experience-bottom-image">
                    <div class="image">
                        <img src="<?php echo $settings['zupet_image_two']['url']; ?>" alt="image">
                    </div>
                    <div class="image">
                        <img src="<?php echo $settings['zupet_image_three']['url']; ?>" alt="image">
                    </div>
                </div>
            </div>

        <?php endif; ?>

        <?php
	}
}

$widgets_manager->register( new Zupet_Image() );