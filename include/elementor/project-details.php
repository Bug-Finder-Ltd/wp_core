<?php
namespace BwallCore\Widgets;

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
use BwallCore\Elementor\Controls\Group_Control_BwallBGGradient;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Bwall Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Bwall_Project_Details extends Widget_Base {

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
		return __( 'Project Details', 'bwallcore' );
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

    protected static function get_profile_names()
    {
        return [
            '500px' => esc_html__('500px', 'bwallcore'),
            'apple' => esc_html__('Apple', 'bwallcore'),
            'behance' => esc_html__('Behance', 'bwallcore'),
            'bitbucket' => esc_html__('BitBucket', 'bwallcore'),
            'codepen' => esc_html__('CodePen', 'bwallcore'),
            'delicious' => esc_html__('Delicious', 'bwallcore'),
            'deviantart' => esc_html__('DeviantArt', 'bwallcore'),
            'digg' => esc_html__('Digg', 'bwallcore'),
            'dribbble' => esc_html__('Dribbble', 'bwallcore'),
            'email' => esc_html__('Email', 'bwallcore'),
            'facebook' => esc_html__('Facebook', 'bwallcore'),
            'flickr' => esc_html__('Flicker', 'bwallcore'),
            'foursquare' => esc_html__('FourSquare', 'bwallcore'),
            'github' => esc_html__('Github', 'bwallcore'),
            'houzz' => esc_html__('Houzz', 'bwallcore'),
            'instagram' => esc_html__('Instagram', 'bwallcore'),
            'jsfiddle' => esc_html__('JS Fiddle', 'bwallcore'),
            'linkedin-in' => esc_html__('LinkedIn', 'bwallcore'),
            'medium' => esc_html__('Medium', 'bwallcore'),
            'pinterest' => esc_html__('Pinterest', 'bwallcore'),
            'product-hunt' => esc_html__('Product Hunt', 'bwallcore'),
            'reddit' => esc_html__('Reddit', 'bwallcore'),
            'slideshare' => esc_html__('Slide Share', 'bwallcore'),
            'snapchat' => esc_html__('Snapchat', 'bwallcore'),
            'soundcloud' => esc_html__('SoundCloud', 'bwallcore'),
            'spotify' => esc_html__('Spotify', 'bwallcore'),
            'stack-overflow' => esc_html__('StackOverflow', 'bwallcore'),
            'tripadvisor' => esc_html__('TripAdvisor', 'bwallcore'),
            'tumblr' => esc_html__('Tumblr', 'bwallcore'),
            'twitch' => esc_html__('Twitch', 'bwallcore'),
            'x-twitter' => esc_html__('Twitter', 'bwallcore'),
            'vimeo' => esc_html__('Vimeo', 'bwallcore'),
            'vk' => esc_html__('VK', 'bwallcore'),
            'website' => esc_html__('Website', 'bwallcore'),
            'whatsapp' => esc_html__('WhatsApp', 'bwallcore'),
            'wordpress' => esc_html__('WordPress', 'bwallcore'),
            'xing' => esc_html__('Xing', 'bwallcore'),
            'yelp' => esc_html__('Yelp', 'bwallcore'),
            'youtube' => esc_html__('YouTube', 'bwallcore'),
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
        '_bwall_image',
        [
            'label' => esc_html__('Image', 'bwallcore'),
        ]
        );

        $this->add_control(
            'bwall_image',
            [
                'label' => esc_html__( 'Primary Image', 'bwallcore' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'bwall_image_2',
            [
                'label' => esc_html__( 'Secondary Image', 'bwallcore' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
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
         * Content section
         */
        $this->start_controls_section(
            '_bwall_content_section',
            [
                'label' => esc_html__('Main Content', 'bwallcore'),
            ]
        );
        
        $this->add_control(
            'bwall_title',
            [
                'label' => esc_html__('Title', 'bwallcore'),
                'description' => bwall_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Gray sofa in white living room', 'bwallcore'),
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
                    '{{WRAPPER}} .service-details-content h3' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'bwall_description',
            [
                'label' => esc_html__('Description', 'bwallcore'),
                'description' => bwall_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Enthusiastically facilitate integrated catalysts for change vis-a-vis emerging relationships. Competently negotiate state of the art results via strategic procrastinate except
                        meta-services. Synergistically procrastinate exceptional e-markets whereas cooperative networks. Synergistically empower multifunctional "outside whereas cooperative
                        the box" thinking vis-a-vis unique data. Interactively productize cutting-edge sources whereas high standards in ideas.', 'bwallcore'),
                'placeholder' => esc_html__('Type section description here', 'bwallcore'),
            ]
        );

        $this->add_control(
            'bwall_description_color',
            [
                'label' => __( 'Description Color', 'bwallcore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .service-details-content p' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'bwall_title_2',
            [
                'label' => esc_html__('Title 2', 'bwallcore'),
                'description' => bwall_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('The Challenge of Project', 'bwallcore'),
                'placeholder' => esc_html__('Type title 2', 'bwallcore'),
                'label_block' => true,
            ]
        );
        
        $this->add_control(
            'bwall_title_2_color',
            [
                'label' => __( 'Title 2 Color', 'bwallcore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .service-details-content h3' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'bwall_description_2',
            [
                'label' => esc_html__('Description 2', 'bwallcore'),
                'description' => bwall_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Dramatically fashion state of the art collaboration and idea-sharing and 2.0 niches. Quickly enhance alternative ideas via technically sound opportunities. Proactively pross
                        client-based infomediaries with exceptional collaboration and idea-sharing. Conveniently impact enabled process improvements with high-quality leadership. Interactively
                        ominate quality channels through client-centered core competencies.', 'bwallcore'),
                'placeholder' => esc_html__('Type section description 2 here', 'bwallcore'),
            ]
        );

        $this->add_control(
            'bwall_description_2_color',
            [
                'label' => __( 'Description Color 2', 'bwallcore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .service-details-content p' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'bwall_title_3',
            [
                'label' => esc_html__('Title 3', 'bwallcore'),
                'description' => bwall_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Project Completed', 'bwallcore'),
                'placeholder' => esc_html__('Type title 3', 'bwallcore'),
                'label_block' => true,
            ]
        );
        
        $this->add_control(
            'bwall_title_3_color',
            [
                'label' => __( 'Title 3 Color', 'bwallcore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .service-details-content h3' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'bwall_description_3',
            [
                'label' => esc_html__('Description 3', 'bwallcore'),
                'description' => bwall_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Dramatically fashion state of the art collaboration and idea-sharing and 2.0 niches. Quickly enhance alternative ideas via technically sound opportunities. Proactively pross
                        client-based infomediaries with exceptional collaboration and idea-sharing. Conveniently impact enabled process improvements with high-quality leadership. Interactively
                        ominate quality channels through client-centered core competencies.', 'bwallcore'),
                'placeholder' => esc_html__('Type section description 3 here', 'bwallcore'),
            ]
        );

        $this->add_control(
            'bwall_description_3_color',
            [
                'label' => __( 'Description 3 Color', 'bwallcore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .service-details-content p' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'bwall_title_4',
            [
                'label' => esc_html__('Title 4', 'bwallcore'),
                'description' => bwall_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('The Result', 'bwallcore'),
                'placeholder' => esc_html__('Type title 4', 'bwallcore'),
                'label_block' => true,
            ]
        );
        
        $this->add_control(
            'bwall_title_4_color',
            [
                'label' => __( 'Title 4 Color', 'bwallcore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .service-details-content h3' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'bwall_description_4',
            [
                'label' => esc_html__('Description 4', 'bwallcore'),
                'description' => bwall_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Distinctively drive one-to-one models without client-focused ideas. Interactively revolutionize enterprise-wide information before cutting-edge partnerships. Assertively
                        synergize global schemas with future-proof convergence. Uniquely optimize integrated applications for performance based niche markets. Globally actualize reliable best
                        practices vis-a-vis pandemic niche markets. Rapidiously repurpose effective ideas via multidisciplinary vortals. Appropriately re-engineer extensible human capital through
                        pandemic solutions. Proactively leverage existing granular e-business via value-added metrics.', 'bwallcore'),
                'placeholder' => esc_html__('Type section description 4 here', 'bwallcore'),
            ]
        );

        $this->add_control(
            'bwall_description_4_color',
            [
                'label' => __( 'Description 4 Color', 'bwallcore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .service-details-content p' => 'color: {{VALUE}}',
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

        $this->end_controls_section();


        /**
         * Social profile section
         */
        $this->start_controls_section(
            '_section_social',
            [
                'label' => esc_html__('Social Profiles', 'bwallcore'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'name',
            [
                'label' => esc_html__('Profile Name', 'bwallcore'),
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
                'label' => esc_html__('Profile Link', 'bwallcore'),
                'placeholder' => esc_html__('Add your profile link', 'bwallcore'),
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
                'label' => esc_html__('Show Profiles', 'bwallcore'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'bwallcore'),
                'label_off' => esc_html__('Hide', 'bwallcore'),
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
                'label' => esc_html__( 'Project Information', 'bwallcore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        
        $repeater = new \Elementor\Repeater();
        
        $repeater->add_control(
            'bwall_project_information_title', [
                'label' => esc_html__('Title', 'bwallcore'),
                'description' => bwall_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Manager', 'bwallcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'bwall_project_information_title_color',
            [
                'label' => __( 'Title Color', 'bwallcore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .project-top-info-single p' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $repeater->add_control(
            'bwall_project_information_text', [
                'label' => esc_html__('Text', 'bwallcore'),
                'description' => bwall_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Omshikat Rinali', 'bwallcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'bwall_project_information_text_color',
            [
                'label' => __( 'Text Color', 'bwallcore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .project-top-info-single h5' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_control(
            'bwall_project_information_list',
            [
                'label' => esc_html__('Project Information', 'bwallcore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'bwall_project_information_title' => esc_html__('Clients', 'bwallcore'),
                    ],
                    [
                        'bwall_project_information_title' => esc_html__('Categories', 'bwallcore')
                    ],
                    [
                        'bwall_project_information_title' => esc_html__('Date', 'bwallcore'),
                    ]
                ],
                'title_field' => '{{{ bwall_project_information_title }}}',
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
                'default' => esc_html__('Winning award', 'bwallcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'bwall_count_number', [
                'label' => esc_html__('Count Number', 'bwallcore'),
                'description' => bwall_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('200', 'bwallcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'bwall_count_number_post_text',
            [
                'label' => esc_html__('Count Number Post Text', 'bwallcore'),
                'description' => bwall_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('K', 'bwallcore'),
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
                        'bwall_counter_title' => esc_html__('Project Completed', 'bwallcore'),
                    ],
                    [
                        'bwall_counter_title' => esc_html__('Years of Experience', 'bwallcore')
                    ],
                    [
                        'bwall_counter_title' => esc_html__('Happy Customers', 'bwallcore')
                    ],
                    [
                        'bwall_counter_title' => esc_html__('Avg. Conversation Rate', 'bwallcore')
                    ]
                ],
                'title_field' => '{{{ bwall_counter_title }}}',
            ]
        );

        $this->end_controls_section();


        /**
         * Features section
         */
        $this->start_controls_section(
            'bwall_features',
            [
                'label' => esc_html__('Features List', 'bwallcore'),
                'description' => esc_html__( 'Control all the style settings from Style tab', 'bwallcore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();


        $repeater->add_control(
            'bwall_features_title', [
                'label' => esc_html__('Title', 'bwallcore'),
                'description' => bwall_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Feature Title', 'bwallcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'bwall_features_title_color',
            [
                'label' => __( 'Title Color', 'bwallcore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .project-details-list li' => 'color: {{VALUE}}',
                ],
            ]
        );

        $repeater->add_control(
            'bwall_service_icon_type',
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
                    'bwall_service_icon_type' => 'image'
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
                        'bwall_service_icon_type' => 'icon'
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
                        'bwall_service_icon_type' => 'icon'
                    ]
                ]
            );
        }
     
        $this->add_control(
            'bwall_features_list',
            [
                'label' => esc_html__('Features - List', 'bwallcore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'bwall_features_title' => esc_html__('Conveniently create tactical intellectual capital before customized users', 'bwallcore'),
                    ],
                    [
                        'bwall_features_title' => esc_html__('Conveniently create tactical capital before customized users', 'bwallcore')
                    ],
                    [
                        'bwall_features_title' => esc_html__('Monotonectally productivate robust manufactured products users', 'bwallcore'),
                    ]
                ],
                'title_field' => '{{{ bwall_features_title }}}',
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

            if ( !empty($settings['bwall_image']['url']) ) {
                $bwall_image = !empty($settings['bwall_image']['id']) ? wp_get_attachment_image_url( $settings['bwall_image']['id'], $settings['bwall_image_size_size']) : $settings['bwall_image']['url'];
                $bwall_image_alt = get_post_meta($settings["bwall_image"]["id"], "_wp_attachment_image_alt", true);
            }
            if ( !empty($settings['bwall_image_2']['url']) ) {
                $bwall_image_2 = !empty($settings['bwall_image_2']['id']) ? wp_get_attachment_image_url( $settings['bwall_image_2']['id'], $settings['bwall_image_size_size']) : $settings['bwall_image_2']['url'];
                $bwall_image_2_alt = get_post_meta($settings["bwall_image_2"]["id"], "_wp_attachment_image_alt", true);
            }
        ?>

        <!-- project details -->
        <section class="project-details">
            <div class="container">
                <div class="project-details-top-container">
                    <div class="project-details-top-image">
                        <?php if ($settings['bwall_image']['url'] || $settings['bwall_image']['id']) : ?>  
                            <img src="<?php echo esc_url($bwall_image); ?>" alt="<?php echo esc_attr($bwall_image_alt); ?>">
                        <?php endif; ?>
                    </div>
                    <div class="project-top-info">
                        <?php foreach ($settings['bwall_project_information_list'] as $item) : ?>
                            <div class="project-top-info-single">
                                <?php if ( !empty($item['bwall_project_information_title']) ) : ?>
                                    <p><?php echo bwall_kses( $item['bwall_project_information_title'] ); ?></p>
                                <?php endif; ?>
                                <?php if ( !empty($item['bwall_project_information_text']) ) : ?>
                                    <h5><a><?php echo bwall_kses( $item['bwall_project_information_text'] ); ?></a></h5>
                                <?php endif; ?>
                            </div>
                            <div class="project-top-info-border"></div>
                        <?php endforeach; ?>
                        <div class="project-top-info-single">
                            <p><?php echo esc_html__('Social Media:', 'bwallcore');?></p>
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
                        if ( !empty($settings['bwall_title' ]) ) :
                            printf( '<%1$s %2$s>%3$s</%1$s>',
                                tag_escape( $settings['bwall_title_tag'] ),
                                $this->get_render_attribute_string( 'title_args' ),
                                bwall_kses( $settings['bwall_title' ] )
                                );
                        endif;
                    ?>
                    <?php if ( !empty($settings['bwall_description']) ) : ?>    
                        <p class="mb_20"><?php echo bwall_kses( $settings['bwall_description'] ); ?></p>
                    <?php endif; ?>
                </div>
                <div class="service-details-content">
                    <?php
                        if ( !empty($settings['bwall_title_2' ]) ) :
                            printf( '<%1$s %2$s>%3$s</%1$s>',
                                tag_escape( $settings['bwall_title_tag'] ),
                                $this->get_render_attribute_string( 'title_args' ),
                                bwall_kses( $settings['bwall_title_2' ] )
                                );
                        endif;
                    ?>
                    <?php if ( !empty($settings['bwall_description_2']) ) : ?>    
                        <p><?php echo bwall_kses( $settings['bwall_description_2'] ); ?></p>
                    <?php endif; ?>
                </div>
                <div class="project-details-counter-container">
                    <?php foreach ($settings['bwall_counter_list'] as $item) : ?>
                        <div class="project-details-counter-single">
                            <div class="project-details-counter-single-icon">
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
                            <div class="project-details-counter">
                                <div class="odometer-box">
                                    <h5 class="odometer" data-count="<?php echo bwall_kses($item['bwall_count_number']);?>">00</h5>
                                    <div class="odometer-text"><?php echo bwall_kses($item['bwall_count_number_post_text' ]); ?></div>
                                </div>
                                <p><?php echo bwall_kses($item['bwall_counter_title' ]); ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="project-details-image-container">
                            <?php if ($settings['bwall_image_2']['url'] || $settings['bwall_image_2']['id']) : ?>  
                                <img src="<?php echo esc_url($bwall_image_2); ?>" alt="<?php echo esc_attr($bwall_image_2_alt); ?>">
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="project-details-list">
                            <ul>
                                <?php foreach ($settings['bwall_features_list'] as $key => $item) :?>
                                    <li>
                                        <?php if($item['bwall_service_icon_type'] !== 'image') : ?>
                                            <?php if (!empty($item['icon']) || !empty($item['selected_icon']['value'])) : ?>
                                                <?php bwall_render_icon($item, 'icon', 'selected_icon'); ?>
                                            <?php endif; ?>   
                                        <?php else : ?>                                
                                            <?php if (!empty($item['bwall_icon_image']['url'])): ?>  
                                                <img src="<?php echo $item['bwall_icon_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['bwall_icon_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                            <?php endif; ?> 
                                        <?php endif; ?> 
                                        <?php echo bwall_kses($item['bwall_features_title' ]); ?>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="service-details-content mt_80">
                    <?php
                        if ( !empty($settings['bwall_title_3' ]) ) :
                            printf( '<%1$s %2$s>%3$s</%1$s>',
                                tag_escape( $settings['bwall_title_tag'] ),
                                $this->get_render_attribute_string( 'title_args' ),
                                bwall_kses( $settings['bwall_title_3' ] )
                                );
                        endif;
                    ?>
                    <?php if ( !empty($settings['bwall_description_3']) ) : ?>    
                        <p><?php echo bwall_kses( $settings['bwall_description_3'] ); ?></p>
                    <?php endif; ?>
                </div>
                <div class="service-details-content">
                    <?php
                        if ( !empty($settings['bwall_title_4' ]) ) :
                            printf( '<%1$s %2$s>%3$s</%1$s>',
                                tag_escape( $settings['bwall_title_tag'] ),
                                $this->get_render_attribute_string( 'title_args' ),
                                bwall_kses( $settings['bwall_title_4' ] )
                                );
                        endif;
                    ?>
                    <?php if ( !empty($settings['bwall_description_4']) ) : ?>    
                        <p><?php echo bwall_kses( $settings['bwall_description_4'] ); ?></p>
                    <?php endif; ?>
                </div>
            </div>
            </section>
        <!-- project details -->
		<?php
	}

}

$widgets_manager->register( new Bwall_Project_Details() );