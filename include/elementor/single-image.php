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
class Protine_Image extends \Elementor\Widget_Base {

	public function get_name() {
		return 'next-image';
	}

	public function get_title() {
		return __( 'Image', 'protinecore' );
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
                    'layout-3' => esc_html__('Layout 3', 'protinecore'),
                    'layout-4' => esc_html__('Layout 4', 'protinecore'),
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
                'description' => protine_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Title Here', 'protinecore'),
                'placeholder' => esc_html__('Type title', 'protinecore'),
                'label_block' => true,
            ]
        );
        
        $this->add_control(
            'protine_title_color',
            [
                'label' => __( 'Title Color', 'protinecore' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .section-title h3' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'protine_description',
            [
                'label' => esc_html__('Description', 'protinecore'),
                'description' => protine_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Protine section description here', 'protinecore'),
                'placeholder' => esc_html__('Type section description here', 'protinecore'),
            ]
        );

        $this->add_control(
            'protine_description_color',
            [
                'label' => __( 'Description Color', 'protinecore' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .about-two-right-content p' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'protine_title_tag',
            [
                'label' => esc_html__('Title HTML Tag', 'protinecore'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'h1' => [
                        'title' => esc_html__('H1', 'protinecore'),
                        'icon' => 'eicon-editor-h1'
                    ],
                    'h2' => [
                        'title' => esc_html__('H2', 'protinecore'),
                        'icon' => 'eicon-editor-h2'
                    ],
                    'h3' => [
                        'title' => esc_html__('H3', 'protinecore'),
                        'icon' => 'eicon-editor-h3'
                    ],
                    'h4' => [
                        'title' => esc_html__('H4', 'protinecore'),
                        'icon' => 'eicon-editor-h4'
                    ],
                    'h5' => [
                        'title' => esc_html__('H5', 'protinecore'),
                        'icon' => 'eicon-editor-h5'
                    ],
                    'h6' => [
                        'title' => esc_html__('H6', 'protinecore'),
                        'icon' => 'eicon-editor-h6'
                    ]
                ],
                'default' => 'h2',
                'toggle' => false,
            ]
        );

        $this->add_responsive_control(
            'protine_align',
            [
                'label' => esc_html__('Alignment', 'protinecore'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'text-left' => [
                        'title' => esc_html__('Left', 'protinecore'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'text-center' => [
                        'title' => esc_html__('Center', 'protinecore'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'text-right' => [
                        'title' => esc_html__('Right', 'protinecore'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'left',
                'toggle' => false,
            ]
        );

        $this->add_control(
            'protine_page_link',
            [
                'label' => esc_html__('Page Link', 'protinecore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('https://your-link.com', 'protinecore'),
                'title' => esc_html__('Enter link', 'protinecore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'protine_video_url',
            [
                'label' => esc_html__('Video Url', 'protinecore'),
                'description' => protine_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('https://www.youtube.com/watch?v=kS0X-yIsB64', 'protinecore'),
                'placeholder' => esc_html__('Type video url', 'protinecore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'text_inside_circle',
            [
                'label' => esc_html__('Text Inside Circle', 'protinecore'),
                'description' => protine_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('BEST WALLPAPERS FOR YOUR INTERIOR • ', 'protinecore'),
                'placeholder' => esc_html__('Type text for inside circle', 'protinecore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'text_inside_circle_color',
            [
                'label' => __( 'Text Inside Circle Color', 'protinecore' ),
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
            'protine_image',
            [
                'label' => esc_html__('Image', 'protinecore'),
            ]
        );
        $this->add_control(
            'protine_image_one',
            [
                'label' => esc_html__( 'Image One', 'protinecore' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        
        $this->add_control(
            'protine_image_two',
            [
                'label' => esc_html__( 'Image Two', 'protinecore' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'protine_image_three',
            [
                'label' => esc_html__( 'Image Three', 'protinecore' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
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

        $this->start_controls_section(
            'image1_style',
            [
                'label' => __( 'Image 1', 'protinecore' ),
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
                    'label' => esc_html__( 'Border Radius', 'protinecore' ),
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

		<?php if ( $settings['protine_design_style']  == 'layout-1' ): ?>

            <?php
                if ( !empty($settings['protine_image_one']['url']) ) {
                    $image_1 = !empty($settings['protine_image_one']['id']) ? wp_get_attachment_image_url( $settings['protine_image_one']['id'], '') : $settings['protine_image_one']['url'];
                }
            ?>

            <div class="image-box style-one">
                <div class="image feature-image">
                    <?php if ($settings['protine_image_one']['url'] || $settings['protine_image_one']['id']) : ?>
                        <img src="<?php echo esc_url($image_1); ?>" alt="image">
                    <?php endif; ?>
                </div>
            </div>

		<?php elseif ( $settings['protine_design_style']  == 'layout-2' ): ?>
            <?php
                if ( !empty($settings['protine_image_one']['url']) ) {
                    $image_1 = !empty($settings['protine_image_one']['id']) ? wp_get_attachment_image_url( $settings['protine_image_one']['id'], '') : $settings['protine_image_one']['url'];

                    $image_2 = !empty($settings['protine_image_two']['id']) ? wp_get_attachment_image_url( $settings['protine_image_two']['id'], '') : $settings['protine_image_two']['url'];
                }
            ?>
            <div class="image-box style-two">
                <div class="image-1">
                    <img src="<?php echo esc_url($image_1); ?>" alt="image">
                </div>
                <div class="image-2">
                    <img src="<?php echo esc_url($image_2); ?>" alt="image">
                </div>
                <div class="about-3-right-frem paroller">
                    <div class="about-3-right-frem-inner">
                        <h5><?php echo $settings['protine_title']; ?></h5>
                        <p><?php echo $settings['protine_description']; ?></p>
                    </div>
                </div>
            </div>

        <?php elseif ( $settings['protine_design_style']  == 'layout-3' ): ?>
            <?php
                if ( !empty($settings['protine_image_one']['url']) ) {
                    $image_1 = !empty($settings['protine_image_one']['id']) ? wp_get_attachment_image_url( $settings['protine_image_one']['id'], '') : $settings['protine_image_one']['url'];

                    $image_2 = !empty($settings['protine_image_two']['id']) ? wp_get_attachment_image_url( $settings['protine_image_two']['id'], '') : $settings['protine_image_two']['url'];
                }
            ?>
            <div class="image-box style-three">
                <div class="image-one wow fadeInDown" data-wow-delay="100ms">
                    <img src="<?php echo esc_url($image_1); ?>" alt="image">
                </div>
                <div class="image-two wow fadeInUp" data-wow-delay="100ms">
                    <img src="<?php echo esc_url($image_2); ?>" alt="image">
                </div>
                <div class="round-box" data-text="<?php echo $settings['protine_title']; ?>">
                    <i class="fa-regular fa-arrow-up-right"></i>
                    <div class="circular-text"></div>
                </div>
            </div>

            <script>
                (function ($) {
                    $('.round-box').each(function () {
                        const $badge = $(this);
                        const text   = ($badge.data('text') + '').split('');
                        const $ring  = $badge.find('.circular-text');
                        $ring.empty();

                        // radius: half the badge minus some padding so letters sit nicely
                        const radius = $badge.outerWidth() / 2 - 5;

                        // distribute characters evenly around the circle
                        const step = 360 / text.length;

                        text.forEach((ch, i) => {
                          $('<span/>', { text: ch })
                            .css('transform', `rotate(${i * step}deg) translate(${radius}px) rotate(90deg)`)
                            .appendTo($ring);
                        });
                    });
                }(jQuery));
            </script>

        <?php elseif ( $settings['protine_design_style']  == 'layout-4' ): ?>

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
                    <img src="<?php echo $settings['protine_image_one']['url']; ?>" alt="image">
                </div>
                <div class="experience-bottom-image">
                    <div class="image">
                        <img src="<?php echo $settings['protine_image_two']['url']; ?>" alt="image">
                    </div>
                    <div class="image">
                        <img src="<?php echo $settings['protine_image_three']['url']; ?>" alt="image">
                    </div>
                </div>
            </div>

        <?php endif; ?>

        <?php
	}
}

$widgets_manager->register( new Protine_Image() );