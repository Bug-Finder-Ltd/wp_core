<?php
namespace NextdestinaCore\Widgets;

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Nextdestina Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Nextdestina_Image extends \Elementor\Widget_Base {

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
		return 'next-image';
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
		return __( 'Image', 'nextdestinacore' );
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
                    'layout-3' => esc_html__('Layout 3', 'nextdestinacore'),
                    'layout-4' => esc_html__('Layout 4', 'nextdestinacore'),
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
            'nextdestina_image',
            [
                'label' => esc_html__('Image', 'nextdestinacore'),
            ]
        );
        $this->add_control(
            'nextdestina_image_one',
            [
                'label' => esc_html__( 'Image One', 'nextdestinacore' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        
        $this->add_control(
            'nextdestina_image_two',
            [
                'label' => esc_html__( 'Image Two', 'nextdestinacore' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'nextdestina_image_three',
            [
                'label' => esc_html__( 'Image Three', 'nextdestinacore' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
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

		<?php if ( $settings['nextdestina_design_style']  == 'layout-1' ): ?>

            <?php
                if ( !empty($settings['nextdestina_image_one']['url']) ) {
                    $image_1 = !empty($settings['nextdestina_image_one']['id']) ? wp_get_attachment_image_url( $settings['nextdestina_image_one']['id'], '') : $settings['nextdestina_image_one']['url'];
                }
            ?>

            <div class="image-box style-one">
                <div class="about-right-image wow fadeInRight" data-wow-delay="100ms" data-wow-duration="2500ms">
                    <?php if ($settings['nextdestina_image_one']['url'] || $settings['nextdestina_image_one']['id']) : ?>
                        <img src="<?php echo esc_url($image_1); ?>" alt="image">
                    <?php endif; ?>
                </div>
                <div class="round-border-shape"></div>
                <div class="squir-shape"></div>
            </div>

		<?php elseif ( $settings['nextdestina_design_style']  == 'layout-2' ): ?>
            <?php
                if ( !empty($settings['nextdestina_image_one']['url']) ) {
                    $image_1 = !empty($settings['nextdestina_image_one']['id']) ? wp_get_attachment_image_url( $settings['nextdestina_image_one']['id'], '') : $settings['nextdestina_image_one']['url'];

                    $image_2 = !empty($settings['nextdestina_image_two']['id']) ? wp_get_attachment_image_url( $settings['nextdestina_image_two']['id'], '') : $settings['nextdestina_image_two']['url'];
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
                        <h5><?php echo $settings['nextdestina_title']; ?></h5>
                        <p><?php echo $settings['nextdestina_description']; ?></p>
                    </div>
                </div>
            </div>

        <?php elseif ( $settings['nextdestina_design_style']  == 'layout-3' ): ?>
            <?php
                if ( !empty($settings['nextdestina_image_one']['url']) ) {
                    $image_1 = !empty($settings['nextdestina_image_one']['id']) ? wp_get_attachment_image_url( $settings['nextdestina_image_one']['id'], '') : $settings['nextdestina_image_one']['url'];

                    $image_2 = !empty($settings['nextdestina_image_two']['id']) ? wp_get_attachment_image_url( $settings['nextdestina_image_two']['id'], '') : $settings['nextdestina_image_two']['url'];
                }
            ?>
            <div class="image-box style-three">
                <div class="image-one wow fadeInDown" data-wow-delay="100ms">
                    <img src="<?php echo esc_url($image_1); ?>" alt="image">
                </div>
                <div class="image-two wow fadeInUp" data-wow-delay="100ms">
                    <img src="<?php echo esc_url($image_2); ?>" alt="image">
                </div>
                <div class="round-box" data-text="<?php echo $settings['nextdestina_title']; ?>">
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

        <?php elseif ( $settings['nextdestina_design_style']  == 'layout-4' ): ?>

            <?php
                $plane_image = NEXTDESTINA_ADDONS_URL . 'assets/img/plane.png';
                $gallery_image = NEXTDESTINA_ADDONS_URL . 'assets/img/gallery.png';
                $bg_image = NEXTDESTINA_ADDONS_URL . 'assets/img/exprience-bg.png';
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
                    <img src="<?php echo $settings['nextdestina_image_one']['url']; ?>" alt="image">
                </div>
                <div class="experience-bottom-image">
                    <div class="image">
                        <img src="<?php echo $settings['nextdestina_image_two']['url']; ?>" alt="image">
                    </div>
                    <div class="image">
                        <img src="<?php echo $settings['nextdestina_image_three']['url']; ?>" alt="image">
                    </div>
                </div>
            </div>

        <?php endif; ?>

        <?php
	}
}

$widgets_manager->register( new Nextdestina_Image() );