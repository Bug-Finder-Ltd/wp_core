<?php
namespace BwallCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Background;
use \Elementor\Control_Media;
use \Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Bwall Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Bwall_Hero_Banner extends Widget_Base {

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
		return 'hero-banner';
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
		return __( 'Hero Banner', 'bwallcore' );
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
            'bwall_sub_title',
            [
                'label' => esc_html__('Sub Title', 'bwallcore'),
                'description' => bwall_get_allowed_html_desc( 'basic' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Wellcome to Bwall', 'bwallcore'),
                'placeholder' => esc_html__('Type sub title', 'bwallcore'),
                'label_block' => true,
                'condition' => [
                    'bwall_design_style' => 'layout-1'
                ],
            ]
        );

        $this->add_control(
            'bwall_sub_title_color',
            [
                'label' => __( 'Sub Title Color', 'bwallcore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .banner-two-title h6' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'bwall_design_style' => 'layout-1'
                ],
            ]
        );

        $this->add_control(
            'bwall_sub_title_2',
            [
                'label' => esc_html__('Sub Title 2', 'bwallcore'),
                'description' => bwall_get_allowed_html_desc( 'basic' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Our services add color to your walls.', 'bwallcore'),
                'placeholder' => esc_html__('Type sub title 2', 'bwallcore'),
                'label_block' => true,
                'condition' => [
                    'bwall_design_style' => 'layout-1'
                ],
            ]
        );

        $this->add_control(
            'bwall_sub_title_2_color',
            [
                'label' => __( 'Sub Title 2 Color', 'bwallcore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .banner-two-title h4' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'bwall_design_style' => 'layout-1'
                ],
            ]
        );

        $this->add_control(
            'bwall_title',
            [
                'label' => esc_html__('Title', 'bwallcore'),
                'description' => bwall_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Best Painting Ever', 'bwallcore'),
                'placeholder' => esc_html__('Type Heading Text', 'bwallcore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'bwall_title_color',
            [
                'label' => __( 'Title Color', 'bwallcore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .banner-left-content h1' => 'color: {{VALUE}}',
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
                'condition' => [
                    'bwall_design_style' => 'layout-1'
                ],
            ]
        );

        $this->add_control(
            'bwall_description_color',
            [
                'label' => __( 'Description Color', 'bwallcore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .banner-two-right-content p' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'bwall_design_style' => 'layout-1'
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

        // video url
        $this->add_control(
            'bwall_video_url',
            [
                'label' => esc_html__('Video Url', 'bwallcore'),
                'description' => bwall_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('https://www.youtube.com/watch?v=kS0X-yIsB64', 'bwallcore'),
                'placeholder' => esc_html__('Type video url', 'bwallcore'),
                'label_block' => true,
                'condition' => [
                    'bwall_design_style' => 'layout-2'
                ],
            ]
        );
        
        $this->end_controls_section();

                
        /**
         * Headlines accordin
         */
		$this->start_controls_section(
            '_headlines',
            [
                'label' => esc_html__( 'Headlines', 'bwallcore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'headline_pre_text', [
                'label' => esc_html__( 'Headline Letters', 'bwallcore' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'For Your' , 'bwallcore' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'headline_pre_text_color',
            [
                'label' => __( 'Headline Letters Color', 'bwallcore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .animate-loading-bar h2' => 'color: {{VALUE}}',
                ],
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'headline_letters', [
                'label' => esc_html__( 'Headline Letters', 'bwallcore' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'W' , 'bwallcore' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'headline_letters_color',
            [
                'label' => __( 'Headline Letters Color', 'bwallcore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ah-headline span' => 'color: {{VALUE}}',
                ],
            ]
        );

        $repeater->add_control(
            'headline_text', [
                'label' => esc_html__( 'Headline Text', 'bwallcore' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'allpapers' , 'bwallcore' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'headline_text_color',
            [
                'label' => __( 'Headline Text Color', 'bwallcore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ah-headline span' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'headlines',
            [
                'label' => esc_html__( 'Repeater Headlines', 'bwallcore' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'headline_text' => esc_html__( 'allpapers', 'bwallcore' ),
                    ],
                    [
                        'headline_text' => esc_html__( 'ecorating', 'bwallcore' ),
                    ],
                    [
                        'headline_text' => esc_html__( 'urnishing', 'bwallcore' ),
                    ]
                ],
                'title_field' => '{{{ headline_text }}}',
            ]
        );

        $this->end_controls_section();


        /**
         * Button section
         */
        $this->start_controls_section(
            'bwall_btn_button_group',
            [
                'label' => esc_html__('Button / Link', 'bwallcore'),
            ]
        );

        $this->add_control(
            'bwall_btn_button_show',
            [
                'label' => esc_html__( 'Show Button', 'bwallcore' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'bwallcore' ),
                'label_off' => esc_html__( 'Hide', 'bwallcore' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        
        $this->add_control(
            'bwall_btn_text',
            [
                'label' => esc_html__('Button /Link Text', 'bwallcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Explore More', 'bwallcore'),
                'title' => esc_html__('Enter button text', 'bwallcore'),
                'label_block' => true,
                'condition' => [
                    'bwall_btn_button_show' => 'yes',
                ],
            ]
        );
        
        $this->add_control(
            'bwall_btn_link_type',
            [
                'label' => esc_html__('Button Link Type', 'bwallcore'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom Link',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'label_block' => true,
                'condition' => [
                    'bwall_btn_button_show' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'bwall_btn_link',
            [
                'label' => esc_html__('Button link', 'bwallcore'),
                'type' => Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => esc_html__('https://your-link.com', 'bwallcore'),
                'show_external' => false,
                'default' => [
                    'url' => '#',
                    'is_external' => true,
                    'nofollow' => true,
                    'custom_attributes' => '',
                ],
                'condition' => [
                    'bwall_btn_link_type' => '1',
                    'bwall_btn_button_show' => 'yes',
                ],
                'label_block' => true,
            ]
        );
        $this->add_control(
            'bwall_btn_page_link',
            [
                'label' => esc_html__('Select Button Page', 'bwallcore'),
                'type' => Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => bwall_get_all_pages(),
                'condition' => [
                    'bwall_btn_link_type' => '2',
                    'bwall_btn_button_show' => 'yes',
                ]
            ]
        );

        $this->end_controls_section();


        /**
         * Image section
         */
        $this->start_controls_section(
            'bwall_hero_image_group',
            [
                'label' => esc_html__('Image', 'bwallcore'),
            ]
        );

        $this->add_control(
            'bwall_hero_image',
            [
                'label' => esc_html__( 'Hero Image', 'bwallcore' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'bwall_video_bg_image',
            [
                'label' => esc_html__( 'Hero Video Background Image', 'bwallcore' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'bwall_design_style' => 'layout-2',
                ]
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
        
        $this->end_controls_section();

        
        /**
         * Customer section
         */
        $this->start_controls_section(
            'bwall_customer',
            [
                'label' => esc_html__('Customer', 'bwallcore'),
                'description' => esc_html__( 'Control all the style settings from Style tab', 'bwallcore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'bwall_customer_text',
            [
                'label' => esc_html__('Customer Text', 'bwallcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('More Than 12k+ Satisfied Customers', 'bwallcore'),
                'title' => esc_html__('Enter customer text', 'bwallcore'),
                'label_block' => true,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'bwall_customer_image',
            [
                'label' => esc_html__('Customer Image', 'bwallcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'bwall_image_size',
                'default' => 'full',
                'exclude' => [
                    'custom'
                ],
            ]
        );

        $repeater->add_control(
            'bwall_customer_name', [
                'label' => esc_html__('Customer Name', 'bwallcore'),
                'description' => bwall_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Customer name', 'bwallcore'),
                'label_block' => true,
            ]
        );
    
        $repeater->add_control(
            'bwall_customer_link',
            [
                'label' => esc_html__( 'Customer Link', 'bwallcore' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'https://your-link.com', 'bwallcore' ),
                'default' => 'Customer Name',
            ]
        );

     
       
        $this->add_control(
            'bwall_customer_list',
            [
                'label' => esc_html__('Customer - List', 'bwallcore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'bwall_customer_name' => esc_html__('Customer name 1', 'bwallcore'),
                    ],
                    [
                        'bwall_customer_name' => esc_html__('Customer name 2', 'bwallcore')
                    ],
                    [
                        'bwall_customer_name' => esc_html__('Customer name 3', 'bwallcore')
                    ]
                ],
                'title_field' => '{{{ bwall_customer_name }}}',
            ]
        );

        $this->end_controls_section();


        /**
         * Counter section
         */
        $this->start_controls_section(
            'bwall_counter_section',
            [
                'label' => esc_html__('Counters', 'bwallcore'),
                'description' => esc_html__( 'Control all the style settings from Style tab', 'bwallcore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();


        // Icon/Image
        $repeater->add_control(
            'bwall_counter_icon_type',
            [
                'label' => esc_html__('Select Icon Type', 'bwallcore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'image',
                'options' => [
                    'image' => esc_html__('Image', 'bwallcore'),
                    'icon' => esc_html__('Icon', 'bwallcore'),
                ],
            ]
        );

        $repeater->add_control(
            'bwall_icon_image',
            [
                'label' => esc_html__('Upload Icon Image', 'bwallcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'bwall_counter_icon_type' => 'image'
                ]

            ]
        );

        if (bwall_is_elementor_version('<', '2.6.0')) {
            $repeater->add_control(
                'icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'fa fa-star',
                    'condition' => [
                        'bwall_counter_icon_type' => 'icon'
                    ]
                ]
            );
        } else {
            $repeater->add_control(
                'selected_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'icon',
                    'label_block' => true,
                    'default' => [
                        'value' => 'far fa-star',
                        'library' => 'regular',
                    ],
                    'condition' => [
                        'bwall_counter_icon_type' => 'icon'
                    ]
                ]
            );
        }

        $repeater->add_control(
            'bwall_counter_title',
            [
                'label' => esc_html__('Counter Title', 'bwallcore'),
                'description' => bwall_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('12+ Worldwide Languages', 'bwallcore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'bwall_counter_list',
            [
                'label' => esc_html__('Counters - List', 'bwallcore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'bwall_counter_title' => esc_html__('12+ Worldwide Languages', 'bwallcore'),
                    ],
                    [
                        'bwall_counter_title' => esc_html__('2k+ Project Completed', 'bwallcore')
                    ],
                    [
                        'bwall_counter_title' => esc_html__('1k+ Happy Clients', 'bwallcore')
                    ]
                ],
                'title_field' => '{{{ bwall_counter_title }}}',
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

            if ( !empty($settings['bwall_hero_image']['url']) ) {
                $bwall_hero_image = !empty($settings['bwall_hero_image']['id']) ? wp_get_attachment_image_url( $settings['bwall_hero_image']['id'], $settings['bwall_image_size_size']) : $settings['bwall_hero_image']['url'];
                $bwall_hero_image_alt = get_post_meta($settings["bwall_hero_image"]["id"], "_wp_attachment_image_alt", true);
            }
            if ( !empty($settings['bwall_video_bg_image']['url']) ) {
                $bwall_video_bg_image = !empty($settings['bwall_video_bg_image']['id']) ? wp_get_attachment_image_url( $settings['bwall_video_bg_image']['id'], $settings['bwall_image_size_size']) : $settings['bwall_video_bg_image']['url'];
            }
            // Link
            if ('2' == $settings['bwall_btn_link_type']) {
                $this->add_render_attribute('bwall-button-arg', 'href', get_permalink($settings['bwall_btn_page_link']));
                $this->add_render_attribute('bwall-button-arg', 'target', '_self');
                $this->add_render_attribute('bwall-button-arg', 'rel', 'nofollow');
                $this->add_render_attribute('bwall-button-arg', 'class', 'round-btn');
            } else {
                if ( ! empty( $settings['bwall_btn_link']['url'] ) ) {
                    $this->add_link_attributes( 'bwall-button-arg', $settings['bwall_btn_link'] );
                    $this->add_render_attribute('bwall-button-arg', 'class', 'round-btn');
                }
            }

            $this->add_render_attribute('title_args', 'class', 'banner-title');

        ?>
            <!-- banner-section -->
            <section class="banner-section banner-one">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="banner-content-box">
                                <?php if ( !empty($settings['bwall_title' ]) ) :
                                    printf( '<%1$s %2$s>%3$s</%1$s>',
                                        tag_escape( $settings['bwall_title_tag'] ),
                                        $this->get_render_attribute_string( 'title_args' ),
                                        bwall_kses( $settings['bwall_title' ] )
                                        );
                                endif; ?> <img src="<?php echo get_template_directory_uri() . '/assets/img/shape/line-right.png';?>'" alt="shape">
                                <div class="banner-content-box-wrapper">
                                    <div class="banner-video-content">
                                        <div class="banner-video-image">
                                            <?php if ($settings['bwall_video_bg_image']['url'] || $settings['bwall_video_bg_image']['id']) : ?>
                                                <img src="<?php echo esc_url($bwall_video_bg_image); ?>" alt="<?php echo esc_attr($bwall_video_bg_image_alt); ?>">
                                            <?php endif; ?>
                                        </div>
                                        <div class="banner-video-btn">
                                            <?php if ( !empty($settings['bwall_video_url']) ) : ?>
                                                <a class="play_btn hv-popup-link"
                                                    href="<?php echo esc_url($settings['bwall_video_url']); ?>">
                                                    <i class="fas fa-play"></i>
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="banner-video-title">
                                        <div class="animate-loading-bar">
                                            <h2 class="ah-headline zoom">
                                                <?php echo bwall_kses($settings['headline_pre_text']); ?>
                                                <span class="ah-words-wrapper">
                                                    <?php foreach ($settings['headlines'] as $index => $item) :
                                                        $vissible_hidden = ($index == '0' ) ? "is-visible" : "is-hidden";
                                                        ?>
                                                        <b class="<?php echo $vissible_hidden;?>"><?php echo bwall_kses($item['headline_text']); ?></b>
                                                    <?php endforeach; ?>
                                                </span>
                                            </h2>
                                        </div>
                                    </div>
                                    <div class="round-btn-box">
                                        <?php if (!empty($settings['bwall_btn_text'])) : ?>
                                            <a <?php echo $this->get_render_attribute_string( 'bwall-button-arg' ); ?>>
                                                <p><?php echo $settings['bwall_btn_text']; ?></p> <i class="icon-arrow-1"></i> <span></span>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="banner-image">
                                    <?php if ($settings['bwall_hero_image']['url'] || $settings['bwall_hero_image']['id']) : ?>
                                        <img src="<?php echo esc_url($bwall_hero_image); ?>" alt="<?php echo esc_attr($bwall_hero_image_alt); ?>">
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="client">
                    <div class="client-slid">
                        <div class="three-item-carousel swiper-container">
                            <div class="swiper-wrapper">
                                <?php foreach ($settings['bwall_counter_list'] as $item) : ?>
                                    <div class="swiper-slide">
                                        <div class="client-content">
                                            <div class="client-content-icon">
                                                <?php if($item['bwall_counter_icon_type'] !== 'image') : ?>
                                                    <?php if (!empty($item['icon']) || !empty($item['selected_icon']['value'])) : ?>
                                                        <?php bwall_render_icon($item, 'icon', 'selected_icon'); ?>
                                                    <?php endif; ?>   
                                                <?php else : ?>                                
                                                    <?php if (!empty($item['bwall_icon_image']['url'])): ?>  
                                                        <img src="<?php echo $item['bwall_icon_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['bwall_icon_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                                    <?php endif; ?> 
                                                <?php endif; ?> 
                                            </div>
                                            <div class="client-content-title">
                                                <h3><?php echo bwall_kses($item['bwall_counter_title' ]); ?></h3>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- banner-section end -->

        <?php else: 

            if ( !empty($settings['bwall_hero_image']['url']) ) {
                $bwall_hero_image = !empty($settings['bwall_hero_image']['id']) ? wp_get_attachment_image_url( $settings['bwall_hero_image']['id'], $settings['bwall_image_size_size']) : $settings['bwall_hero_image']['url'];
                $bwall_hero_image_alt = get_post_meta($settings["bwall_hero_image"]["id"], "_wp_attachment_image_alt", true);
            }
            // Link
            if ('2' == $settings['bwall_btn_link_type']) {
                $this->add_render_attribute('bwall-button-arg', 'href', get_permalink($settings['bwall_btn_page_link']));
                $this->add_render_attribute('bwall-button-arg', 'target', '_self');
                $this->add_render_attribute('bwall-button-arg', 'rel', 'nofollow');
            } else {
                if ( ! empty( $settings['bwall_btn_link']['url'] ) ) {
                    $this->add_link_attributes( 'bwall-button-arg', $settings['bwall_btn_link'] );
                }
            }

            $this->add_render_attribute('title_args', 'class', 'banner-title');
        ?>
            
            <!-- banner-section -->
            <section class="banner-two">
                <div class="container">
                    <div class="banner-two-container">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="banner-left-content">
                                    <?php if ( !empty($settings['bwall_title' ]) ) :
                                        printf( '<%1$s %2$s>%3$s</%1$s>',
                                            tag_escape( $settings['bwall_title_tag'] ),
                                            $this->get_render_attribute_string( 'title_args' ),
                                            bwall_kses( $settings['bwall_title' ] )
                                            );
                                    endif; ?>
                                    <div class="banner-two-content-box-wrapper">
                                        <div class="banner-two-title">
                                            <?php if ( !empty($settings['bwall_sub_title']) ) : ?>
                                                <h6><img src="<?php echo get_template_directory_uri() .'/assets/img/icons/star-icon-5.png';?>" alt="icon"> <?php echo bwall_kses( $settings['bwall_sub_title'] ); ?></h6>
                                            <?php endif; ?>
                                            <?php if ( !empty($settings['bwall_sub_title_2']) ) : ?>
                                                <h4><?php echo bwall_kses( $settings['bwall_sub_title_2'] ); ?> <img src="<?php echo get_template_directory_uri() . '/assets/img/shape/line-right-02.png';?>" alt="icon"></h4>
                                            <?php endif; ?>
                                        </div>
                                        <div class="banner-two-image-box">
                                            <div class="banner-two-arrow">
                                                <img src="<?php echo get_template_directory_uri() .'/assets/img/shape/arrow-shape.png';?>" alt="icon">
                                            </div>
                                            <div class="banner-two-image">
                                                <?php if ($settings['bwall_hero_image']['url'] || $settings['bwall_hero_image']['id']) : ?>
                                                    <img src="<?php echo esc_url($bwall_hero_image); ?>" alt="<?php echo esc_attr($bwall_hero_image_alt); ?>">
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="banner-two-big-title">
                                        <div class="animate-loading-bar">
                                            <h2 class="ah-headline zoom">
                                                <span class="ah-words-wrapper">
                                                    <?php foreach ($settings['headlines'] as $index => $item) :
                                                        $vissible_hidden = ($index == '0' ) ? "is-visible" : "is-hidden";
                                                        ?>
                                                        <b class="<?php echo $vissible_hidden;?>"><span class="strock-letter"><?php echo bwall_kses($item['headline_letters']); ?></span><?php echo bwall_kses($item['headline_text']); ?></b>
                                                    <?php endforeach; ?>
                                                </span>
                                            </h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="banner-two-right-container">
                                    <div class="banner-two-right-content">
                                        <div class="banner-two-right-shape">
                                            <img src="<?php echo get_template_directory_uri() .'/assets/img/shape/dot-shape-02.png';?>'" alt="shape">
                                        </div>
                                        <?php if ( !empty($settings['bwall_description']) ) : ?>
                                            <p><?php echo bwall_kses( $settings['bwall_description'] ); ?></p>
                                        <?php endif; ?>
                                        <?php if (!empty($settings['bwall_btn_text'])) : ?>
                                            <a <?php echo $this->get_render_attribute_string( 'bwall-button-arg' ); ?>>
                                                <?php echo $settings['bwall_btn_text']; ?> <i class="fa-sharp fa-regular fa-arrow-up-right"></i>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                    <div class="customers">
                                        <div class="customers-image">
                                            <ul>
                                                <?php foreach ($settings['bwall_customer_list'] as $key => $item) :
                                                    if ( !empty($item['bwall_customer_image']['url']) ) {
                                                        $bwall_customer_image = !empty($item['bwall_customer_image']['id']) ? wp_get_attachment_image_url( $item['bwall_customer_image']['id'], $item['bwall_image_size_size']) : $item['bwall_customer_image']['url'];
                                                        $bwall_customer_image_alt = get_post_meta($item["bwall_customer_image"]["id"], "_wp_attachment_image_alt", true);
                                                    }
                                                    ?>
                                                        <li>
                                                            <a href="<?php echo esc_url($item['bwall_customer_link']); ?>">
                                                                <img src="<?php echo esc_url($bwall_customer_image); ?>" alt="<?php echo esc_url($bwall_customer_image_alt); ?>">
                                                            </a>
                                                        </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                        <div class="customers-content">
                                            <?php if ( !empty($settings['bwall_customer_text']) ) : ?>
                                                <p><?php echo bwall_kses( $settings['bwall_customer_text'] ); ?></p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- banner-section end -->
        <?php endif; ?>
        <?php 
	}
}

$widgets_manager->register( new Bwall_Hero_Banner() );