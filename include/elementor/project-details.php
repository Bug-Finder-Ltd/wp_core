<?php
namespace ZupetCore\Widgets;

use Elementor\Widget_Base;
use \Elementor\Control_Media;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Css_Filter;
use \Elementor\Repeater;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Typography;
Use \Elementor\Core\Schemes\Typography;
use \Elementor\Utils;
use \Elementor\Group_Control_Box_Shadow;
use ZupetCore\Elementor\Controls\Group_Control_ZupetBGGradient;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Zupet Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Zupet_Project_Details extends Widget_Base {

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
		return 'project-details';
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
		return __( 'Project Details', 'zupetcore' );
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

    protected static function get_profile_names()
    {
        return [
            '500px' => esc_html__('500px', 'zupetcore'),
            'apple' => esc_html__('Apple', 'zupetcore'),
            'behance' => esc_html__('Behance', 'zupetcore'),
            'bitbucket' => esc_html__('BitBucket', 'zupetcore'),
            'codepen' => esc_html__('CodePen', 'zupetcore'),
            'delicious' => esc_html__('Delicious', 'zupetcore'),
            'deviantart' => esc_html__('DeviantArt', 'zupetcore'),
            'digg' => esc_html__('Digg', 'zupetcore'),
            'dribbble' => esc_html__('Dribbble', 'zupetcore'),
            'email' => esc_html__('Email', 'zupetcore'),
            'facebook' => esc_html__('Facebook', 'zupetcore'),
            'flickr' => esc_html__('Flicker', 'zupetcore'),
            'foursquare' => esc_html__('FourSquare', 'zupetcore'),
            'github' => esc_html__('Github', 'zupetcore'),
            'houzz' => esc_html__('Houzz', 'zupetcore'),
            'instagram' => esc_html__('Instagram', 'zupetcore'),
            'jsfiddle' => esc_html__('JS Fiddle', 'zupetcore'),
            'linkedin-in' => esc_html__('LinkedIn', 'zupetcore'),
            'medium' => esc_html__('Medium', 'zupetcore'),
            'pinterest' => esc_html__('Pinterest', 'zupetcore'),
            'product-hunt' => esc_html__('Product Hunt', 'zupetcore'),
            'reddit' => esc_html__('Reddit', 'zupetcore'),
            'slideshare' => esc_html__('Slide Share', 'zupetcore'),
            'snapchat' => esc_html__('Snapchat', 'zupetcore'),
            'soundcloud' => esc_html__('SoundCloud', 'zupetcore'),
            'spotify' => esc_html__('Spotify', 'zupetcore'),
            'stack-overflow' => esc_html__('StackOverflow', 'zupetcore'),
            'tripadvisor' => esc_html__('TripAdvisor', 'zupetcore'),
            'tumblr' => esc_html__('Tumblr', 'zupetcore'),
            'twitch' => esc_html__('Twitch', 'zupetcore'),
            'x-twitter' => esc_html__('Twitter', 'zupetcore'),
            'vimeo' => esc_html__('Vimeo', 'zupetcore'),
            'vk' => esc_html__('VK', 'zupetcore'),
            'website' => esc_html__('Website', 'zupetcore'),
            'whatsapp' => esc_html__('WhatsApp', 'zupetcore'),
            'wordpress' => esc_html__('WordPress', 'zupetcore'),
            'xing' => esc_html__('Xing', 'zupetcore'),
            'yelp' => esc_html__('Yelp', 'zupetcore'),
            'youtube' => esc_html__('YouTube', 'zupetcore'),
        ];
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
         * Image section
         */
        $this->start_controls_section(
        '_zupet_image',
        [
            'label' => esc_html__('Image', 'zupetcore'),
        ]
        );

        $this->add_control(
            'zupet_image',
            [
                'label' => esc_html__( 'Primary Image', 'zupetcore' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'zupet_image_2',
            [
                'label' => esc_html__( 'Secondary Image', 'zupetcore' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
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
                'type' => Controls_Manager::SWITCHER,
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
                    '{{WRAPPER}} .zupet-overlap img' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'zupet_image_overlap_x',
            [
                'label' => esc_html__( 'Image overlap position', 'zupetcore' ),
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
                    '{{WRAPPER}} .zupet-overlap img' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
                'condition' => array(
                    'zupet_image_overlap' => 'yes',
                ),
            ]
        );
        $this->end_controls_section();


        /**
         * Content section
         */
        $this->start_controls_section(
            '_zupet_content_section',
            [
                'label' => esc_html__('Main Content', 'zupetcore'),
            ]
        );
        
        $this->add_control(
            'zupet_title',
            [
                'label' => esc_html__('Title', 'zupetcore'),
                'description' => zupet_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Gray sofa in white living room', 'zupetcore'),
                'placeholder' => esc_html__('Type title', 'zupetcore'),
                'label_block' => true,
            ]
        );
        
        $this->add_control(
            'zupet_title_color',
            [
                'label' => __( 'Title Color', 'zupetcore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .service-details-content h3' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'zupet_description',
            [
                'label' => esc_html__('Description', 'zupetcore'),
                'description' => zupet_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Enthusiastically facilitate integrated catalysts for change vis-a-vis emerging relationships. Competently negotiate state of the art results via strategic procrastinate except
                        meta-services. Synergistically procrastinate exceptional e-markets whereas cooperative networks. Synergistically empower multifunctional "outside whereas cooperative
                        the box" thinking vis-a-vis unique data. Interactively productize cutting-edge sources whereas high standards in ideas.', 'zupetcore'),
                'placeholder' => esc_html__('Type section description here', 'zupetcore'),
            ]
        );

        $this->add_control(
            'zupet_description_color',
            [
                'label' => __( 'Description Color', 'zupetcore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .service-details-content p' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'zupet_title_2',
            [
                'label' => esc_html__('Title 2', 'zupetcore'),
                'description' => zupet_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('The Challenge of Project', 'zupetcore'),
                'placeholder' => esc_html__('Type title 2', 'zupetcore'),
                'label_block' => true,
            ]
        );
        
        $this->add_control(
            'zupet_title_2_color',
            [
                'label' => __( 'Title 2 Color', 'zupetcore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .service-details-content h3' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'zupet_description_2',
            [
                'label' => esc_html__('Description 2', 'zupetcore'),
                'description' => zupet_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Dramatically fashion state of the art collaboration and idea-sharing and 2.0 niches. Quickly enhance alternative ideas via technically sound opportunities. Proactively pross
                        client-based infomediaries with exceptional collaboration and idea-sharing. Conveniently impact enabled process improvements with high-quality leadership. Interactively
                        ominate quality channels through client-centered core competencies.', 'zupetcore'),
                'placeholder' => esc_html__('Type section description 2 here', 'zupetcore'),
            ]
        );

        $this->add_control(
            'zupet_description_2_color',
            [
                'label' => __( 'Description Color 2', 'zupetcore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .service-details-content p' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'zupet_title_3',
            [
                'label' => esc_html__('Title 3', 'zupetcore'),
                'description' => zupet_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Project Completed', 'zupetcore'),
                'placeholder' => esc_html__('Type title 3', 'zupetcore'),
                'label_block' => true,
            ]
        );
        
        $this->add_control(
            'zupet_title_3_color',
            [
                'label' => __( 'Title 3 Color', 'zupetcore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .service-details-content h3' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'zupet_description_3',
            [
                'label' => esc_html__('Description 3', 'zupetcore'),
                'description' => zupet_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Dramatically fashion state of the art collaboration and idea-sharing and 2.0 niches. Quickly enhance alternative ideas via technically sound opportunities. Proactively pross
                        client-based infomediaries with exceptional collaboration and idea-sharing. Conveniently impact enabled process improvements with high-quality leadership. Interactively
                        ominate quality channels through client-centered core competencies.', 'zupetcore'),
                'placeholder' => esc_html__('Type section description 3 here', 'zupetcore'),
            ]
        );

        $this->add_control(
            'zupet_description_3_color',
            [
                'label' => __( 'Description 3 Color', 'zupetcore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .service-details-content p' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'zupet_title_4',
            [
                'label' => esc_html__('Title 4', 'zupetcore'),
                'description' => zupet_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('The Result', 'zupetcore'),
                'placeholder' => esc_html__('Type title 4', 'zupetcore'),
                'label_block' => true,
            ]
        );
        
        $this->add_control(
            'zupet_title_4_color',
            [
                'label' => __( 'Title 4 Color', 'zupetcore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .service-details-content h3' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'zupet_description_4',
            [
                'label' => esc_html__('Description 4', 'zupetcore'),
                'description' => zupet_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Distinctively drive one-to-one models without client-focused ideas. Interactively revolutionize enterprise-wide information before cutting-edge partnerships. Assertively
                        synergize global schemas with future-proof convergence. Uniquely optimize integrated applications for performance based niche markets. Globally actualize reliable best
                        practices vis-a-vis pandemic niche markets. Rapidiously repurpose effective ideas via multidisciplinary vortals. Appropriately re-engineer extensible human capital through
                        pandemic solutions. Proactively leverage existing granular e-business via value-added metrics.', 'zupetcore'),
                'placeholder' => esc_html__('Type section description 4 here', 'zupetcore'),
            ]
        );

        $this->add_control(
            'zupet_description_4_color',
            [
                'label' => __( 'Description 4 Color', 'zupetcore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .service-details-content p' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'zupet_title_tag',
            [
                'label' => esc_html__('Title HTML Tag', 'zupetcore'),
                'type' => Controls_Manager::CHOOSE,
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

        $this->end_controls_section();


        /**
         * Social profile section
         */
        $this->start_controls_section(
            '_section_social',
            [
                'label' => esc_html__('Social Profiles', 'zupetcore'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'name',
            [
                'label' => esc_html__('Profile Name', 'zupetcore'),
                'type' => Controls_Manager::SELECT2,
                'label_block' => true,
                'select2options' => [
                    'allowClear' => false,
                ],
                'options' => self::get_profile_names()
            ]
        );

        $repeater->add_control(
            'link', [
                'label' => esc_html__('Profile Link', 'zupetcore'),
                'placeholder' => esc_html__('Add your profile link', 'zupetcore'),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'autocomplete' => false,
                'show_external' => false,
                'condition' => [
                    'name!' => 'email'
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );
        $this->add_control(
            'profiles',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '<# print(name.slice(0,1).toUpperCase() + name.slice(1)) #>',
                'default' => [
                    [
                        'link' => ['url' => 'https://facebook.com/'],
                        'name' => 'facebook'
                    ],
                    [
                        'link' => ['url' => 'https://twitter.com/'],
                        'name' => 'x-twitter'
                    ],
                    [
                        'link' => ['url' => 'https://linkedin.com/'],
                        'name' => 'linkedin-in'
                    ],
                    [
                        'link' => ['url' => 'https://instagram.com/'],
                        'name' => 'instagram'
                    ],
                ],
            ]
        );

        $this->add_control(
            'show_profiles',
            [
                'label' => esc_html__('Show Profiles', 'zupetcore'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'zupetcore'),
                'label_off' => esc_html__('Hide', 'zupetcore'),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',
                'style_transfer' => true,
            ]
        );

        $this->end_controls_section();

        
        /**
         * Project information section
         */
        $this->start_controls_section(
            '_project_information',
            [
                'label' => esc_html__( 'Project Information', 'zupetcore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        
        $repeater = new \Elementor\Repeater();
        
        $repeater->add_control(
            'zupet_project_information_title', [
                'label' => esc_html__('Title', 'zupetcore'),
                'description' => zupet_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Manager', 'zupetcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'zupet_project_information_title_color',
            [
                'label' => __( 'Title Color', 'zupetcore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .project-top-info-single p' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $repeater->add_control(
            'zupet_project_information_text', [
                'label' => esc_html__('Text', 'zupetcore'),
                'description' => zupet_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Omshikat Rinali', 'zupetcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'zupet_project_information_text_color',
            [
                'label' => __( 'Text Color', 'zupetcore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .project-top-info-single h5' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_control(
            'zupet_project_information_list',
            [
                'label' => esc_html__('Project Information', 'zupetcore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'zupet_project_information_title' => esc_html__('Clients', 'zupetcore'),
                    ],
                    [
                        'zupet_project_information_title' => esc_html__('Categories', 'zupetcore')
                    ],
                    [
                        'zupet_project_information_title' => esc_html__('Date', 'zupetcore'),
                    ]
                ],
                'title_field' => '{{{ zupet_project_information_title }}}',
            ]
        );

        $this->end_controls_section();



        
        /**
         * Counter section
         */
        $this->start_controls_section(
            'zupet_counter_section',
            [
                'label' => esc_html__('Counters', 'zupetcore'),
                'description' => esc_html__( 'Control all the style settings from Style tab', 'zupetcore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();


        // Icon/Image
        $repeater->add_control(
            'zupet_counter_icon_type',
            [
                'label' => esc_html__('Select Icon Type', 'zupetcore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'image',
                'options' => [
                    'image' => esc_html__('Image', 'zupetcore'),
                    'icon' => esc_html__('Icon', 'zupetcore'),
                ],
            ]
        );

        $repeater->add_control(
            'zupet_icon_image',
            [
                'label' => esc_html__('Upload Icon Image', 'zupetcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'zupet_counter_icon_type' => 'image'
                ]

            ]
        );

        if (zupet_is_elementor_version('<', '2.6.0')) {
            $repeater->add_control(
                'icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'fa fa-star',
                    'condition' => [
                        'zupet_counter_icon_type' => 'icon'
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
                        'zupet_counter_icon_type' => 'icon'
                    ]
                ]
            );
        }


        $repeater->add_control(
            'zupet_counter_title',
            [
                'label' => esc_html__('Counter Title', 'zupetcore'),
                'description' => zupet_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Winning award', 'zupetcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'zupet_count_number', [
                'label' => esc_html__('Count Number', 'zupetcore'),
                'description' => zupet_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('200', 'zupetcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'zupet_count_number_post_text',
            [
                'label' => esc_html__('Count Number Post Text', 'zupetcore'),
                'description' => zupet_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('K', 'zupetcore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'zupet_counter_list',
            [
                'label' => esc_html__('Counters - List', 'zupetcore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'zupet_counter_title' => esc_html__('Project Completed', 'zupetcore'),
                    ],
                    [
                        'zupet_counter_title' => esc_html__('Years of Experience', 'zupetcore')
                    ],
                    [
                        'zupet_counter_title' => esc_html__('Happy Customers', 'zupetcore')
                    ],
                    [
                        'zupet_counter_title' => esc_html__('Avg. Conversation Rate', 'zupetcore')
                    ]
                ],
                'title_field' => '{{{ zupet_counter_title }}}',
            ]
        );

        $this->end_controls_section();


        /**
         * Features section
         */
        $this->start_controls_section(
            'zupet_features',
            [
                'label' => esc_html__('Features List', 'zupetcore'),
                'description' => esc_html__( 'Control all the style settings from Style tab', 'zupetcore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();


        $repeater->add_control(
            'zupet_features_title', [
                'label' => esc_html__('Title', 'zupetcore'),
                'description' => zupet_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Feature Title', 'zupetcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'zupet_features_title_color',
            [
                'label' => __( 'Title Color', 'zupetcore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .project-details-list li' => 'color: {{VALUE}}',
                ],
            ]
        );

        $repeater->add_control(
            'zupet_service_icon_type',
            [
                'label' => esc_html__('Select Icon Type', 'zupetcore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'image',
                'options' => [
                    'image' => esc_html__('Image', 'zupetcore'),
                    'icon' => esc_html__('Icon', 'zupetcore'),
                ],
            ]
        );

        $repeater->add_control(
            'zupet_icon_image',
            [
                'label' => esc_html__('Upload Icon Image', 'zupetcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'zupet_service_icon_type' => 'image'
                ]

            ]
        );

        if (zupet_is_elementor_version('<', '2.6.0')) {
            $repeater->add_control(
                'icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'fa fa-star',
                    'condition' => [
                        'zupet_service_icon_type' => 'icon'
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
                        'zupet_service_icon_type' => 'icon'
                    ]
                ]
            );
        }
     
        $this->add_control(
            'zupet_features_list',
            [
                'label' => esc_html__('Features - List', 'zupetcore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'zupet_features_title' => esc_html__('Conveniently create tactical intellectual capital before customized users', 'zupetcore'),
                    ],
                    [
                        'zupet_features_title' => esc_html__('Conveniently create tactical capital before customized users', 'zupetcore')
                    ],
                    [
                        'zupet_features_title' => esc_html__('Monotonectally productivate robust manufactured products users', 'zupetcore'),
                    ]
                ],
                'title_field' => '{{{ zupet_features_title }}}',
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
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'text_transform',
			[
				'label' => __( 'Text Transform', 'zupetcore' ),
				'type' => Controls_Manager::SELECT,
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

            if ( !empty($settings['zupet_image']['url']) ) {
                $zupet_image = !empty($settings['zupet_image']['id']) ? wp_get_attachment_image_url( $settings['zupet_image']['id'], $settings['zupet_image_size_size']) : $settings['zupet_image']['url'];
                $zupet_image_alt = get_post_meta($settings["zupet_image"]["id"], "_wp_attachment_image_alt", true);
            }
            if ( !empty($settings['zupet_image_2']['url']) ) {
                $zupet_image_2 = !empty($settings['zupet_image_2']['id']) ? wp_get_attachment_image_url( $settings['zupet_image_2']['id'], $settings['zupet_image_size_size']) : $settings['zupet_image_2']['url'];
                $zupet_image_2_alt = get_post_meta($settings["zupet_image_2"]["id"], "_wp_attachment_image_alt", true);
            }
        ?>

        <!-- project details -->
        <section class="project-details">
            <div class="container">
                <div class="project-details-top-container">
                    <div class="project-details-top-image">
                        <?php if ($settings['zupet_image']['url'] || $settings['zupet_image']['id']) : ?>  
                            <img src="<?php echo esc_url($zupet_image); ?>" alt="<?php echo esc_attr($zupet_image_alt); ?>">
                        <?php endif; ?>
                    </div>
                    <div class="project-top-info">
                        <?php foreach ($settings['zupet_project_information_list'] as $item) : ?>
                            <div class="project-top-info-single">
                                <?php if ( !empty($item['zupet_project_information_title']) ) : ?>
                                    <p><?php echo zupet_kses( $item['zupet_project_information_title'] ); ?></p>
                                <?php endif; ?>
                                <?php if ( !empty($item['zupet_project_information_text']) ) : ?>
                                    <h5><a><?php echo zupet_kses( $item['zupet_project_information_text'] ); ?></a></h5>
                                <?php endif; ?>
                            </div>
                            <div class="project-top-info-border"></div>
                        <?php endforeach; ?>
                        <div class="project-top-info-single">
                            <p><?php echo esc_html__('Social Media:', 'zupetcore');?></p>
                            <div class="media-content">
                                <?php if ($settings['show_profiles'] && is_array($settings['profiles'])) : ?>
                                    <ul>
                                        <?php foreach ($settings['profiles'] as $profile) :
                                            $icon = esc_attr($profile['name']);
                                            $url = esc_url($profile['link']['url']); ?>
                                            <li>
                                                <a href="<?php echo $url;?>"><i class="fa-brands fa-<?php echo $icon;?>"></i></a>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="service-details-content">
                    <?php
                        if ( !empty($settings['zupet_title' ]) ) :
                            printf( '<%1$s %2$s>%3$s</%1$s>',
                                tag_escape( $settings['zupet_title_tag'] ),
                                $this->get_render_attribute_string( 'title_args' ),
                                zupet_kses( $settings['zupet_title' ] )
                                );
                        endif;
                    ?>
                    <?php if ( !empty($settings['zupet_description']) ) : ?>    
                        <p class="mb_20"><?php echo zupet_kses( $settings['zupet_description'] ); ?></p>
                    <?php endif; ?>
                </div>
                <div class="service-details-content">
                    <?php
                        if ( !empty($settings['zupet_title_2' ]) ) :
                            printf( '<%1$s %2$s>%3$s</%1$s>',
                                tag_escape( $settings['zupet_title_tag'] ),
                                $this->get_render_attribute_string( 'title_args' ),
                                zupet_kses( $settings['zupet_title_2' ] )
                                );
                        endif;
                    ?>
                    <?php if ( !empty($settings['zupet_description_2']) ) : ?>    
                        <p><?php echo zupet_kses( $settings['zupet_description_2'] ); ?></p>
                    <?php endif; ?>
                </div>
                <div class="project-details-counter-container">
                    <?php foreach ($settings['zupet_counter_list'] as $item) : ?>
                        <div class="project-details-counter-single">
                            <div class="project-details-counter-single-icon">
                                <?php if($item['zupet_counter_icon_type'] !== 'image') : ?>
                                    <?php if (!empty($item['icon']) || !empty($item['selected_icon']['value'])) : ?>
                                        <?php zupet_render_icon($item, 'icon', 'selected_icon'); ?>
                                    <?php endif; ?>   
                                <?php else : ?>                                
                                    <?php if (!empty($item['zupet_icon_image']['url'])): ?>  
                                        <img src="<?php echo $item['zupet_icon_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['zupet_icon_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                    <?php endif; ?> 
                                <?php endif; ?> 
                            </div>
                            <div class="project-details-counter">
                                <div class="odometer-box">
                                    <h5 class="odometer" data-count="<?php echo zupet_kses($item['zupet_count_number']);?>">00</h5>
                                    <div class="odometer-text"><?php echo zupet_kses($item['zupet_count_number_post_text' ]); ?></div>
                                </div>
                                <p><?php echo zupet_kses($item['zupet_counter_title' ]); ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="project-details-image-container">
                            <?php if ($settings['zupet_image_2']['url'] || $settings['zupet_image_2']['id']) : ?>  
                                <img src="<?php echo esc_url($zupet_image_2); ?>" alt="<?php echo esc_attr($zupet_image_2_alt); ?>">
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="project-details-list">
                            <ul>
                                <?php foreach ($settings['zupet_features_list'] as $key => $item) :?>
                                    <li>
                                        <?php if($item['zupet_service_icon_type'] !== 'image') : ?>
                                            <?php if (!empty($item['icon']) || !empty($item['selected_icon']['value'])) : ?>
                                                <?php zupet_render_icon($item, 'icon', 'selected_icon'); ?>
                                            <?php endif; ?>   
                                        <?php else : ?>                                
                                            <?php if (!empty($item['zupet_icon_image']['url'])): ?>  
                                                <img src="<?php echo $item['zupet_icon_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['zupet_icon_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                            <?php endif; ?> 
                                        <?php endif; ?> 
                                        <?php echo zupet_kses($item['zupet_features_title' ]); ?>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="service-details-content mt_80">
                    <?php
                        if ( !empty($settings['zupet_title_3' ]) ) :
                            printf( '<%1$s %2$s>%3$s</%1$s>',
                                tag_escape( $settings['zupet_title_tag'] ),
                                $this->get_render_attribute_string( 'title_args' ),
                                zupet_kses( $settings['zupet_title_3' ] )
                                );
                        endif;
                    ?>
                    <?php if ( !empty($settings['zupet_description_3']) ) : ?>    
                        <p><?php echo zupet_kses( $settings['zupet_description_3'] ); ?></p>
                    <?php endif; ?>
                </div>
                <div class="service-details-content">
                    <?php
                        if ( !empty($settings['zupet_title_4' ]) ) :
                            printf( '<%1$s %2$s>%3$s</%1$s>',
                                tag_escape( $settings['zupet_title_tag'] ),
                                $this->get_render_attribute_string( 'title_args' ),
                                zupet_kses( $settings['zupet_title_4' ] )
                                );
                        endif;
                    ?>
                    <?php if ( !empty($settings['zupet_description_4']) ) : ?>    
                        <p><?php echo zupet_kses( $settings['zupet_description_4'] ); ?></p>
                    <?php endif; ?>
                </div>
            </div>
            </section>
        <!-- project details -->
		<?php
	}

}

$widgets_manager->register( new Zupet_Project_Details() );