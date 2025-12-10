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
class Raizen_Image extends \Elementor\Widget_Base {

	public function get_name() {
		return 'next-image';
	}

	public function get_title() {
		return __( 'Image', 'raizencore' );
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
                    'layout-4' => esc_html__('Layout 4', 'raizencore'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();
        
        /**
         * Title and content section
         */
        $this->start_controls_section(
            'raizen_section_title',
            [
                'label' => esc_html__('Title & Content', 'raizencore'),
            ]
        );
        
        $this->add_control(
            'raizen_title',
            [
                'label' => esc_html__('Title', 'raizencore'),
                'description' => raizen_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Title Here', 'raizencore'),
                'placeholder' => esc_html__('Type title', 'raizencore'),
                'label_block' => true,
            ]
        );
        
        $this->add_control(
            'raizen_title_color',
            [
                'label' => __( 'Title Color', 'raizencore' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .section-title h3' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'raizen_description',
            [
                'label' => esc_html__('Description', 'raizencore'),
                'description' => raizen_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Raizen section description here', 'raizencore'),
                'placeholder' => esc_html__('Type section description here', 'raizencore'),
            ]
        );

        $this->add_control(
            'raizen_description_color',
            [
                'label' => __( 'Description Color', 'raizencore' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .about-two-right-content p' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'raizen_title_tag',
            [
                'label' => esc_html__('Title HTML Tag', 'raizencore'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'h1' => [
                        'title' => esc_html__('H1', 'raizencore'),
                        'icon' => 'eicon-editor-h1'
                    ],
                    'h2' => [
                        'title' => esc_html__('H2', 'raizencore'),
                        'icon' => 'eicon-editor-h2'
                    ],
                    'h3' => [
                        'title' => esc_html__('H3', 'raizencore'),
                        'icon' => 'eicon-editor-h3'
                    ],
                    'h4' => [
                        'title' => esc_html__('H4', 'raizencore'),
                        'icon' => 'eicon-editor-h4'
                    ],
                    'h5' => [
                        'title' => esc_html__('H5', 'raizencore'),
                        'icon' => 'eicon-editor-h5'
                    ],
                    'h6' => [
                        'title' => esc_html__('H6', 'raizencore'),
                        'icon' => 'eicon-editor-h6'
                    ]
                ],
                'default' => 'h2',
                'toggle' => false,
            ]
        );

        $this->add_responsive_control(
            'raizen_align',
            [
                'label' => esc_html__('Alignment', 'raizencore'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'text-left' => [
                        'title' => esc_html__('Left', 'raizencore'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'text-center' => [
                        'title' => esc_html__('Center', 'raizencore'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'text-right' => [
                        'title' => esc_html__('Right', 'raizencore'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'left',
                'toggle' => false,
            ]
        );

        $this->add_control(
            'raizen_page_link',
            [
                'label' => esc_html__('Page Link', 'raizencore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('https://your-link.com', 'raizencore'),
                'title' => esc_html__('Enter link', 'raizencore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'raizen_video_url',
            [
                'label' => esc_html__('Video Url', 'raizencore'),
                'description' => raizen_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('https://www.youtube.com/watch?v=kS0X-yIsB64', 'raizencore'),
                'placeholder' => esc_html__('Type video url', 'raizencore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'text_inside_circle',
            [
                'label' => esc_html__('Text Inside Circle', 'raizencore'),
                'description' => raizen_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('BEST WALLPAPERS FOR YOUR INTERIOR • ', 'raizencore'),
                'placeholder' => esc_html__('Type text for inside circle', 'raizencore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'text_inside_circle_color',
            [
                'label' => __( 'Text Inside Circle Color', 'raizencore' ),
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
            'raizen_image',
            [
                'label' => esc_html__('Image', 'raizencore'),
            ]
        );
        $this->add_control(
            'raizen_image_one',
            [
                'label' => esc_html__( 'Image One', 'raizencore' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        
        $this->add_control(
            'raizen_image_two',
            [
                'label' => esc_html__( 'Image Two', 'raizencore' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'raizen_image_three',
            [
                'label' => esc_html__( 'Image Three', 'raizencore' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );


        $this->add_group_control(
            \Elementor\Group_Control_Image_Size::get_type(),
            [
                'name' => 'raizen_image_size',
                'default' => 'full',
                'exclude' => [
                    'custom'
                ]
            ]
        );
        $this->add_control(
            'raizen_image_overlap',
            [
                'label' => esc_html__('Image overlap to top?', 'raizencore'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'raizencore'),
                'label_off' => esc_html__('No', 'raizencore'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );
        $this->add_responsive_control(
            'raizen_image_height',
            [
                'label' => esc_html__( 'Image Height', 'raizencore' ),
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
                    '{{WRAPPER}} .raizen-overlap img' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'raizen_image_overlap_x',
            [
                'label' => esc_html__( 'Image overlap position', 'raizencore' ),
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
                    '{{WRAPPER}} .raizen-overlap img' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
                'condition' => array(
                    'raizen_image_overlap' => 'yes',
                ),
            ]
        );

        $this->end_controls_section();


        /**
         * Style section
         */
		$this->start_controls_section(
			'general_style',
			[
				'label' => __( 'General', 'raizencore' ),
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
            'image1_style',
            [
                'label' => __( 'Image 1', 'raizencore' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_group_control(
                \Elementor\Group_Control_Background::get_type(),
                [
                    'name' => 'background',
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .image-box .image',
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
                    'label' => esc_html__( 'Border Radius', 'raizencore' ),
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .image-box .image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

		<?php if ( $settings['raizen_design_style']  == 'layout-1' ): ?>

            <?php
                if ( !empty($settings['raizen_image_one']['url']) ) {
                    $image_1 = !empty($settings['raizen_image_one']['id']) ? wp_get_attachment_image_url( $settings['raizen_image_one']['id'], '') : $settings['raizen_image_one']['url'];
                }
            ?>

            <div class="image-box style-one">
                <div class="image feature-image">
                    <?php if ($settings['raizen_image_one']['url'] || $settings['raizen_image_one']['id']) : ?>
                        <div class="image-wrap">
                            <img src="<?php echo esc_url($image_1); ?>" alt="image">
                        </div>
                    <?php endif; ?>
                    <div class="overlay-top"></div>
                    <div class="overlay-bottom"></div>
                </div>
            </div>

		<?php elseif ( $settings['raizen_design_style']  == 'layout-2' ): ?>
            
            <?php
                if ( !empty($settings['raizen_image_one']['url']) ) {
                    $image_1 = !empty($settings['raizen_image_one']['id']) ? wp_get_attachment_image_url( $settings['raizen_image_one']['id'], '') : $settings['raizen_image_one']['url'];
                }
            ?>

            <div class="image-box style-two">
                <div class="image feature-image">
                    <?php if ($settings['raizen_image_one']['url'] || $settings['raizen_image_one']['id']) : ?>
                        <img src="<?php echo esc_url($image_1); ?>" alt="image">
                    <?php endif; ?>
                </div>
            </div>

        <?php elseif ( $settings['raizen_design_style']  == 'layout-3' ): ?>
            <?php
                if ( !empty($settings['raizen_image_one']['url']) ) {
                    $image_1 = !empty($settings['raizen_image_one']['id']) ? wp_get_attachment_image_url( $settings['raizen_image_one']['id'], '') : $settings['raizen_image_one']['url'];
                }
            ?>
            <div class="image-box style-three">
                <div class="image wow zoomIn" data-wow-delay="00ms" data-wow-duration="2000ms">
                    <img src="<?php echo esc_url($image_1); ?>" alt="image">
                </div>
            </div>

        <?php elseif ( $settings['raizen_design_style']  == 'layout-4' ):
            if ( !empty($settings['raizen_image_one']['url']) ) {
                $image_1 = !empty($settings['raizen_image_one']['id']) ? wp_get_attachment_image_url( $settings['raizen_image_one']['id'], '') : $settings['raizen_image_one']['url'];
            }
            if ( !empty($settings['raizen_image_two']['url']) ) {
                $image_2 = !empty($settings['raizen_image_two']['id']) ? wp_get_attachment_image_url( $settings['raizen_image_two']['id'], '') : $settings['raizen_image_two']['url'];
            }
            if ( !empty($settings['raizen_image_three']['url']) ) {
                $image_3 = !empty($settings['raizen_image_three']['id']) ? wp_get_attachment_image_url( $settings['raizen_image_three']['id'], '') : $settings['raizen_image_three']['url'];
            }
            ?>

            <div class="image-box style-four">
                <div class="image">
                    <img src="<?php echo esc_url($image_1); ?>" alt="image">
                </div>
                <div class="circuler-box">
                    <div class="center-img">
                        <img src="<?php echo esc_url($image_2); ?>" alt="image">
                    </div>
                    <div class="circle-img">
                        <img src="<?php echo esc_url($image_3); ?>" alt="image">
                    </div>
                </div>
            </div>

        <?php endif; ?>

        <?php
	}
}

$widgets_manager->register( new Raizen_Image() );