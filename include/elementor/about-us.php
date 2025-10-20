<?php
namespace BwallCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Control_Media;



use \Elementor\Group_Control_Css_Filter;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Typography;
Use \Elementor\Core\Schemes\Typography;
use \Elementor\Group_Control_Box_Shadow;
use BwallCore\Elementor\Controls\Group_Control_BwallBGGradient;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Bwall Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Bwall_About extends Widget_Base {

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
		return 'about-us';
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
		return __( 'About', 'bwallcore' );
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
		return 'bwall-icon';
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
		return [ 'bwallcore' ];
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
		return [ 'bwallcore' ];
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
            'bwall_layout',
            [
                'label' => esc_html__('Design Layout', 'bwallcore'),
            ]
        );
        $this->add_control(
            'bwall_design_style',
            [
                'label' => esc_html__('Select Layout', 'bwallcore'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'layout-1' => esc_html__('Layout 1', 'bwallcore'),
                    'layout-2' => esc_html__('Layout 2', 'bwallcore'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        
        /**
         * Title and content section
         */
        $this->start_controls_section(
            'bwall_section_title',
            [
                'label' => esc_html__('Title & Content', 'bwallcore'),
            ]
        );

        $this->add_control(
            'bwall_section_title_show',
            [
                'label' => esc_html__( 'Section Title & Content', 'bwallcore' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'bwallcore' ),
                'label_off' => esc_html__( 'Hide', 'bwallcore' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        
        $this->add_control(
            'bwall_title',
            [
                'label' => esc_html__('Title', 'bwallcore'),
                'description' => bwall_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Title Here', 'bwallcore'),
                'placeholder' => esc_html__('Type title', 'bwallcore'),
                'label_block' => true,
            ]
        );
        
        $this->add_control(
            'bwall_title_color',
            [
                'label' => __( 'Title Color', 'bwallcore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .common-title h3' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'bwall_description',
            [
                'label' => esc_html__('Description', 'bwallcore'),
                'description' => bwall_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Bwall section description here', 'bwallcore'),
                'placeholder' => esc_html__('Type section description here', 'bwallcore'),
            ]
        );

        $this->add_control(
            'bwall_description_color',
            [
                'label' => __( 'Description Color', 'bwallcore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .about-two-right-content p' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'bwall_title_tag',
            [
                'label' => esc_html__('Title HTML Tag', 'bwallcore'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'h1' => [
                        'title' => esc_html__('H1', 'bwallcore'),
                        'icon' => 'eicon-editor-h1'
                    ],
                    'h2' => [
                        'title' => esc_html__('H2', 'bwallcore'),
                        'icon' => 'eicon-editor-h2'
                    ],
                    'h3' => [
                        'title' => esc_html__('H3', 'bwallcore'),
                        'icon' => 'eicon-editor-h3'
                    ],
                    'h4' => [
                        'title' => esc_html__('H4', 'bwallcore'),
                        'icon' => 'eicon-editor-h4'
                    ],
                    'h5' => [
                        'title' => esc_html__('H5', 'bwallcore'),
                        'icon' => 'eicon-editor-h5'
                    ],
                    'h6' => [
                        'title' => esc_html__('H6', 'bwallcore'),
                        'icon' => 'eicon-editor-h6'
                    ]
                ],
                'default' => 'h2',
                'toggle' => false,
            ]
        );

        $this->add_responsive_control(
            'bwall_align',
            [
                'label' => esc_html__('Alignment', 'bwallcore'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'text-left' => [
                        'title' => esc_html__('Left', 'bwallcore'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'text-center' => [
                        'title' => esc_html__('Center', 'bwallcore'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'text-right' => [
                        'title' => esc_html__('Right', 'bwallcore'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'left',
                'toggle' => false,
            ]
        );

        $this->add_control(
            'bwall_page_link',
            [
                'label' => esc_html__('Page Link', 'bwallcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('https://your-link.com', 'bwallcore'),
                'title' => esc_html__('Enter link', 'bwallcore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'bwall_video_url',
            [
                'label' => esc_html__('Video Url', 'bwallcore'),
                'description' => bwall_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('https://www.youtube.com/watch?v=kS0X-yIsB64', 'bwallcore'),
                'placeholder' => esc_html__('Type video url', 'bwallcore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'text_inside_circle',
            [
                'label' => esc_html__('Text Inside Circle', 'bwallcore'),
                'description' => bwall_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('BEST WALLPAPERS FOR YOUR INTERIOR • ', 'bwallcore'),
                'placeholder' => esc_html__('Type text for inside circle', 'bwallcore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'text_inside_circle_color',
            [
                'label' => __( 'Text Inside Circle Color', 'bwallcore' ),
                'type' => Controls_Manager::COLOR,
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
            '_bwall_image',
            [
                'label' => esc_html__('Image', 'bwallcore'),
            ]
        );
        $this->add_control(
            'bwall_about_left_image',
            [
                'label' => esc_html__( 'Left Image', 'bwallcore' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        
        $this->add_control(
            'bwall_about_right_image',
            [
                'label' => esc_html__( 'Right Image', 'bwallcore' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'bwall_about_right_image_2',
            [
                'label' => esc_html__( 'Right Image 2', 'bwallcore' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'bwall_design_style' => 'layout-1',
                ],
            ]
        );


        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'bwall_image_size',
                'default' => 'full',
                'exclude' => [
                    'custom'
                ]
            ]
        );
        $this->add_control(
            'bwall_image_overlap',
            [
                'label' => esc_html__('Image overlap to top?', 'bwallcore'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'bwallcore'),
                'label_off' => esc_html__('No', 'bwallcore'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );
        $this->add_responsive_control(
            'bwall_image_height',
            [
                'label' => esc_html__( 'Image Height', 'bwallcore' ),
                'type' => Controls_Manager::SLIDER,
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
                    '{{WRAPPER}} .bwall-overlap img' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'bwall_image_overlap_x',
            [
                'label' => esc_html__( 'Image overlap position', 'bwallcore' ),
                'type' => Controls_Manager::SLIDER,
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
                    '{{WRAPPER}} .bwall-overlap img' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
                'condition' => array(
                    'bwall_image_overlap' => 'yes',
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
				'label' => __( 'Style', 'bwallcore' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'text_transform',
			[
				'label' => __( 'Text Transform', 'bwallcore' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => __( 'None', 'bwallcore' ),
					'uppercase' => __( 'UPPERCASE', 'bwallcore' ),
					'lowercase' => __( 'lowercase', 'bwallcore' ),
					'capitalize' => __( 'Capitalize', 'bwallcore' ),
				],
				'selectors' => [
					'{{WRAPPER}} .title' => 'text-transform: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render the widget oubwallut on the frontend.
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

		<?php if ( $settings['bwall_design_style']  == 'layout-2' ): 
            
            if ( !empty($settings['bwall_about_left_image']['url']) ) {
                $bwall_about_left_image = !empty($settings['bwall_about_left_image']['id']) ? wp_get_attachment_image_url( $settings['bwall_about_left_image']['id'], $settings['bwall_image_size_size']) : $settings['bwall_about_left_image']['url'];
                $bwall_about_left_image_alt = get_post_meta($settings["bwall_about_left_image"]["id"], "_wp_attachment_image_alt", true);
            } 
            if ( !empty($settings['bwall_about_right_image']['url']) ) {
                $bwall_about_right_image = !empty($settings['bwall_about_right_image']['id']) ? wp_get_attachment_image_url( $settings['bwall_about_right_image']['id'], $settings['bwall_image_size_size']) : $settings['bwall_about_right_image']['url'];
                $bwall_about_right_image_alt = get_post_meta($settings["bwall_about_right_image"]["id"], "_wp_attachment_image_alt", true);
            } 
        ?>
            <!-- about -->
            <section class="about">
                <div class="container">
                    <div class="common-title">
                        <img src="<?php echo get_template_directory_uri() .  '/assets/img/shape/line-left.png';?>" alt="shape">
                        <?php
                            if ( !empty($settings['bwall_title' ]) ) :
                                printf( '<%1$s %2$s>%3$s</%1$s>',
                                    tag_escape( $settings['bwall_title_tag'] ),
                                    $this->get_render_attribute_string( 'title_args' ),
                                    bwall_kses( $settings['bwall_title' ] )
                                    );
                            endif;
                        ?>
                    </div>
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="about-left-image">
                                <?php if ($settings['bwall_about_left_image']['url'] || $settings['bwall_about_left_image']['id']) : ?>
                                    <img src="<?php echo esc_url($bwall_about_left_image); ?>" alt="<?php echo esc_attr($bwall_about_left_image_alt); ?>">
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
                                    <?php if ( !empty($settings['bwall_description']) ) : ?>
                                        <p><?php echo bwall_kses( $settings['bwall_description'] ); ?></p>
                                    <?php endif; ?>
                                </div>
                                <div class="about-right-content">
                                    <div class="about-right-content-round">
                                        <div class="about-round-text">
                                            <div class="round-box-content">
                                                <span class="curved-circle"><?php echo bwall_kses($settings['text_inside_circle']); ?> </span>
                                                <div class="round-box-icon">
                                                    <a href="<?php echo esc_url($settings['bwall_page_link']); ?>"><img src="<?php echo get_template_directory_uri() .  '/assets/img/icons/arrow-big-black.png';?>" alt="arrow"></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="about-right-content-image">
                                        <?php if ($settings['bwall_about_right_image']['url'] || $settings['bwall_about_right_image']['id']) : ?>
                                            <img src="<?php echo esc_url($bwall_about_right_image); ?>" alt="<?php echo esc_attr($bwall_about_right_image_alt); ?>">
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
            if ( !empty($settings['bwall_about_left_image']['url']) ) {
                $bwall_about_left_image = !empty($settings['bwall_about_left_image']['id']) ? wp_get_attachment_image_url( $settings['bwall_about_left_image']['id'], $settings['bwall_image_size_size']) : $settings['bwall_about_left_image']['url'];
                $bwall_about_left_image_alt = get_post_meta($settings["bwall_about_left_image"]["id"], "_wp_attachment_image_alt", true);
            } 
            if ( !empty($settings['bwall_about_right_image']['url']) ) {
                $bwall_about_right_image = !empty($settings['bwall_about_right_image']['id']) ? wp_get_attachment_image_url( $settings['bwall_about_right_image']['id'], $settings['bwall_image_size_size']) : $settings['bwall_about_right_image']['url'];
                $bwall_about_right_image_alt = get_post_meta($settings["bwall_about_right_image"]["id"], "_wp_attachment_image_alt", true);
            } 
            if ( !empty($settings['bwall_about_right_image_2']['url']) ) {
                $bwall_about_right_image_2 = !empty($settings['bwall_about_right_image_2']['id']) ? wp_get_attachment_image_url( $settings['bwall_about_right_image_2']['id'], $settings['bwall_image_size_size']) : $settings['bwall_about_right_image_2']['url'];
                $bwall_about_right_image_2_alt = get_post_meta($settings["bwall_about_right_image_2"]["id"], "_wp_attachment_image_alt", true);
            } 
        ?>
            <!-- about-two -->
            <div class="about-two">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="common-title">
                            <?php
                                if ( !empty($settings['bwall_title' ]) ) :
                                    printf( '<%1$s %2$s>%3$s</%1$s>',
                                        tag_escape( $settings['bwall_title_tag'] ),
                                        $this->get_render_attribute_string( 'title_args' ),
                                        bwall_kses( $settings['bwall_title' ] )
                                        );
                                endif;
                            ?>
                            </div>
                            <div class="about-two-left-image">
                                <?php if ($settings['bwall_about_left_image']['url'] || $settings['bwall_about_left_image']['id']) : ?>
                                    <img src="<?php echo esc_url($bwall_about_left_image); ?>" alt="<?php echo esc_attr($bwall_about_left_image_alt); ?>">
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="about-two-right-container">
                                <div class="about-two-right-icon">
                                    <div class="icon">
                                        <img src="<?php echo get_template_directory_uri() . '/assets/img/shape/arrow-shape-two.png';?>" alt="icon">
                                    </div>
                                    <div class="about-two-round-text">
                                        <div class="round-box-content">
                                            <span class="curved-circle"><?php echo bwall_kses($settings['text_inside_circle']); ?> </span>
                                            <div class="round-box-icon">
                                                <a href="<?php echo esc_url($settings['bwall_page_link']); ?>"><img src="<?php echo get_template_directory_uri() . '/assets/img/icons/arrow-big-white.png';?>" alt="arrow"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="about-two-right-content">
                                    <?php if ( !empty($settings['bwall_description']) ) : ?>
                                        <p><?php echo bwall_kses( $settings['bwall_description'] ); ?></p>
                                    <?php endif; ?>
                                    <div class="about-two-right-image-box">
                                        <div class="about-two-right-image-one">
                                            <?php if ($settings['bwall_about_right_image']['url'] || $settings['bwall_about_right_image']['id']) : ?>
                                                <img src="<?php echo esc_url($bwall_about_right_image); ?>" alt="<?php echo esc_attr($bwall_about_right_image_alt); ?>">
                                            <?php endif; ?>
                                        </div>
                                        <div class="about-two-right-image-two">
                                            <?php if ($settings['bwall_about_right_image_2']['url'] || $settings['bwall_about_right_image_2']['id']) : ?>
                                                <img src="<?php echo esc_url($bwall_about_right_image_2); ?>" alt="<?php echo esc_attr($bwall_about_right_image_2_alt); ?>">
                                            <?php endif; ?>
                                        </div>
                                        <div class="about-two-dot-shape">
                                            <img src="<?php echo get_template_directory_uri() . '/assets/img/shape/dot-shape-03.png';?>" alt="image">
                                        </div>
                                        <div class="about-two-star-shape">
                                            <img src="<?php echo get_template_directory_uri() . '/assets/img/shape/star-shape-01.png';?>" alt="image">
                                        </div>
                                        <div class="about-two-right-round">
                                            <div class="round-box-content">
                                                <span class="curved-circle-3"><?php echo bwall_kses($settings['text_inside_circle']); ?> </span>
                                                <div class="round-box-icon">
                                                    <a class="play_btn hv-popup-link" href="<?php echo esc_url($settings['bwall_video_url']); ?>">
                                                        <i class="fas fa-play"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- about-two -->

        <?php endif; ?>

        <?php 
	}
}

$widgets_manager->register( new Bwall_About() );