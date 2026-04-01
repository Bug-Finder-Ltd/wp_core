<?php
namespace ProvixCore\Widgets;

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
use ProvixCore\Elementor\Controls\Group_Control_ProvixBGGradient;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Provix Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Provix_Project_Details extends Widget_Base {

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
		return __( 'Project Details', 'agenvix-core' );
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
		return 'provix-icon';
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
		return [ 'agenvix-core' ];
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
		return [ 'agenvix-core' ];
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
            '500px' => esc_html__('500px', 'agenvix-core'),
            'apple' => esc_html__('Apple', 'agenvix-core'),
            'behance' => esc_html__('Behance', 'agenvix-core'),
            'bitbucket' => esc_html__('BitBucket', 'agenvix-core'),
            'codepen' => esc_html__('CodePen', 'agenvix-core'),
            'delicious' => esc_html__('Delicious', 'agenvix-core'),
            'deviantart' => esc_html__('DeviantArt', 'agenvix-core'),
            'digg' => esc_html__('Digg', 'agenvix-core'),
            'dribbble' => esc_html__('Dribbble', 'agenvix-core'),
            'email' => esc_html__('Email', 'agenvix-core'),
            'facebook' => esc_html__('Facebook', 'agenvix-core'),
            'flickr' => esc_html__('Flicker', 'agenvix-core'),
            'foursquare' => esc_html__('FourSquare', 'agenvix-core'),
            'github' => esc_html__('Github', 'agenvix-core'),
            'houzz' => esc_html__('Houzz', 'agenvix-core'),
            'instagram' => esc_html__('Instagram', 'agenvix-core'),
            'jsfiddle' => esc_html__('JS Fiddle', 'agenvix-core'),
            'linkedin-in' => esc_html__('LinkedIn', 'agenvix-core'),
            'medium' => esc_html__('Medium', 'agenvix-core'),
            'pinterest' => esc_html__('Pinterest', 'agenvix-core'),
            'product-hunt' => esc_html__('Product Hunt', 'agenvix-core'),
            'reddit' => esc_html__('Reddit', 'agenvix-core'),
            'slideshare' => esc_html__('Slide Share', 'agenvix-core'),
            'snapchat' => esc_html__('Snapchat', 'agenvix-core'),
            'soundcloud' => esc_html__('SoundCloud', 'agenvix-core'),
            'spotify' => esc_html__('Spotify', 'agenvix-core'),
            'stack-overflow' => esc_html__('StackOverflow', 'agenvix-core'),
            'tripadvisor' => esc_html__('TripAdvisor', 'agenvix-core'),
            'tumblr' => esc_html__('Tumblr', 'agenvix-core'),
            'twitch' => esc_html__('Twitch', 'agenvix-core'),
            'x-twitter' => esc_html__('Twitter', 'agenvix-core'),
            'vimeo' => esc_html__('Vimeo', 'agenvix-core'),
            'vk' => esc_html__('VK', 'agenvix-core'),
            'website' => esc_html__('Website', 'agenvix-core'),
            'whatsapp' => esc_html__('WhatsApp', 'agenvix-core'),
            'wordpress' => esc_html__('WordPress', 'agenvix-core'),
            'xing' => esc_html__('Xing', 'agenvix-core'),
            'yelp' => esc_html__('Yelp', 'agenvix-core'),
            'youtube' => esc_html__('YouTube', 'agenvix-core'),
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
        '_provix_image',
        [
            'label' => esc_html__('Image', 'agenvix-core'),
        ]
        );

        $this->add_control(
            'provix_image',
            [
                'label' => esc_html__( 'Primary Image', 'agenvix-core' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'provix_image_2',
            [
                'label' => esc_html__( 'Secondary Image', 'agenvix-core' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'provix_image_size',
                'default' => 'full',
                'exclude' => [
                    'custom'
                ]
            ]
        );
        $this->add_control(
            'provix_image_overlap',
            [
                'label' => esc_html__('Image overlap to top?', 'agenvix-core'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'agenvix-core'),
                'label_off' => esc_html__('No', 'agenvix-core'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );
        $this->add_responsive_control(
            'provix_image_height',
            [
                'label' => esc_html__( 'Image Height', 'agenvix-core' ),
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
                    '{{WRAPPER}} .provix-overlap img' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'provix_image_overlap_x',
            [
                'label' => esc_html__( 'Image overlap position', 'agenvix-core' ),
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
                    '{{WRAPPER}} .provix-overlap img' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
                'condition' => array(
                    'provix_image_overlap' => 'yes',
                ),
            ]
        );
        $this->end_controls_section();


        /**
         * Content section
         */
        $this->start_controls_section(
            '_provix_content_section',
            [
                'label' => esc_html__('Main Content', 'agenvix-core'),
            ]
        );
        
        $this->add_control(
            'provix_title',
            [
                'label' => esc_html__('Title', 'agenvix-core'),
                'description' => provix_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Gray sofa in white living room', 'agenvix-core'),
                'placeholder' => esc_html__('Type title', 'agenvix-core'),
                'label_block' => true,
            ]
        );
        
        $this->add_control(
            'provix_title_color',
            [
                'label' => __( 'Title Color', 'agenvix-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .service-details-content h3' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'provix_description',
            [
                'label' => esc_html__('Description', 'agenvix-core'),
                'description' => provix_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Enthusiastically facilitate integrated catalysts for change vis-a-vis emerging relationships. Competently negotiate state of the art results via strategic procrastinate except
                        meta-services. Synergistically procrastinate exceptional e-markets whereas cooperative networks. Synergistically empower multifunctional "outside whereas cooperative
                        the box" thinking vis-a-vis unique data. Interactively productize cutting-edge sources whereas high standards in ideas.', 'agenvix-core'),
                'placeholder' => esc_html__('Type section description here', 'agenvix-core'),
            ]
        );

        $this->add_control(
            'provix_description_color',
            [
                'label' => __( 'Description Color', 'agenvix-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .service-details-content p' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'provix_title_2',
            [
                'label' => esc_html__('Title 2', 'agenvix-core'),
                'description' => provix_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('The Challenge of Project', 'agenvix-core'),
                'placeholder' => esc_html__('Type title 2', 'agenvix-core'),
                'label_block' => true,
            ]
        );
        
        $this->add_control(
            'provix_title_2_color',
            [
                'label' => __( 'Title 2 Color', 'agenvix-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .service-details-content h3' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'provix_description_2',
            [
                'label' => esc_html__('Description 2', 'agenvix-core'),
                'description' => provix_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Dramatically fashion state of the art collaboration and idea-sharing and 2.0 niches. Quickly enhance alternative ideas via technically sound opportunities. Proactively pross
                        client-based infomediaries with exceptional collaboration and idea-sharing. Conveniently impact enabled process improvements with high-quality leadership. Interactively
                        ominate quality channels through client-centered core competencies.', 'agenvix-core'),
                'placeholder' => esc_html__('Type section description 2 here', 'agenvix-core'),
            ]
        );

        $this->add_control(
            'provix_description_2_color',
            [
                'label' => __( 'Description Color 2', 'agenvix-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .service-details-content p' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'provix_title_3',
            [
                'label' => esc_html__('Title 3', 'agenvix-core'),
                'description' => provix_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Project Completed', 'agenvix-core'),
                'placeholder' => esc_html__('Type title 3', 'agenvix-core'),
                'label_block' => true,
            ]
        );
        
        $this->add_control(
            'provix_title_3_color',
            [
                'label' => __( 'Title 3 Color', 'agenvix-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .service-details-content h3' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'provix_description_3',
            [
                'label' => esc_html__('Description 3', 'agenvix-core'),
                'description' => provix_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Dramatically fashion state of the art collaboration and idea-sharing and 2.0 niches. Quickly enhance alternative ideas via technically sound opportunities. Proactively pross
                        client-based infomediaries with exceptional collaboration and idea-sharing. Conveniently impact enabled process improvements with high-quality leadership. Interactively
                        ominate quality channels through client-centered core competencies.', 'agenvix-core'),
                'placeholder' => esc_html__('Type section description 3 here', 'agenvix-core'),
            ]
        );

        $this->add_control(
            'provix_description_3_color',
            [
                'label' => __( 'Description 3 Color', 'agenvix-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .service-details-content p' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'provix_title_4',
            [
                'label' => esc_html__('Title 4', 'agenvix-core'),
                'description' => provix_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('The Result', 'agenvix-core'),
                'placeholder' => esc_html__('Type title 4', 'agenvix-core'),
                'label_block' => true,
            ]
        );
        
        $this->add_control(
            'provix_title_4_color',
            [
                'label' => __( 'Title 4 Color', 'agenvix-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .service-details-content h3' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'provix_description_4',
            [
                'label' => esc_html__('Description 4', 'agenvix-core'),
                'description' => provix_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Distinctively drive one-to-one models without client-focused ideas. Interactively revolutionize enterprise-wide information before cutting-edge partnerships. Assertively
                        synergize global schemas with future-proof convergence. Uniquely optimize integrated applications for performance based niche markets. Globally actualize reliable best
                        practices vis-a-vis pandemic niche markets. Rapidiously repurpose effective ideas via multidisciplinary vortals. Appropriately re-engineer extensible human capital through
                        pandemic solutions. Proactively leverage existing granular e-business via value-added metrics.', 'agenvix-core'),
                'placeholder' => esc_html__('Type section description 4 here', 'agenvix-core'),
            ]
        );

        $this->add_control(
            'provix_description_4_color',
            [
                'label' => __( 'Description 4 Color', 'agenvix-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .service-details-content p' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'provix_title_tag',
            [
                'label' => esc_html__('Title HTML Tag', 'agenvix-core'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'h1' => [
                        'title' => esc_html__('H1', 'agenvix-core'),
                        'icon' => 'eicon-editor-h1'
                    ],
                    'h2' => [
                        'title' => esc_html__('H2', 'agenvix-core'),
                        'icon' => 'eicon-editor-h2'
                    ],
                    'h3' => [
                        'title' => esc_html__('H3', 'agenvix-core'),
                        'icon' => 'eicon-editor-h3'
                    ],
                    'h4' => [
                        'title' => esc_html__('H4', 'agenvix-core'),
                        'icon' => 'eicon-editor-h4'
                    ],
                    'h5' => [
                        'title' => esc_html__('H5', 'agenvix-core'),
                        'icon' => 'eicon-editor-h5'
                    ],
                    'h6' => [
                        'title' => esc_html__('H6', 'agenvix-core'),
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
                'label' => esc_html__('Social Profiles', 'agenvix-core'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'name',
            [
                'label' => esc_html__('Profile Name', 'agenvix-core'),
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
                'label' => esc_html__('Profile Link', 'agenvix-core'),
                'placeholder' => esc_html__('Add your profile link', 'agenvix-core'),
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
                'label' => esc_html__('Show Profiles', 'agenvix-core'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'agenvix-core'),
                'label_off' => esc_html__('Hide', 'agenvix-core'),
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
                'label' => esc_html__( 'Project Information', 'agenvix-core' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        
        $repeater = new \Elementor\Repeater();
        
        $repeater->add_control(
            'provix_project_information_title', [
                'label' => esc_html__('Title', 'agenvix-core'),
                'description' => provix_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Manager', 'agenvix-core'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'provix_project_information_title_color',
            [
                'label' => __( 'Title Color', 'agenvix-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .project-top-info-single p' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $repeater->add_control(
            'provix_project_information_text', [
                'label' => esc_html__('Text', 'agenvix-core'),
                'description' => provix_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Omshikat Rinali', 'agenvix-core'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'provix_project_information_text_color',
            [
                'label' => __( 'Text Color', 'agenvix-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .project-top-info-single h5' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_control(
            'provix_project_information_list',
            [
                'label' => esc_html__('Project Information', 'agenvix-core'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'provix_project_information_title' => esc_html__('Clients', 'agenvix-core'),
                    ],
                    [
                        'provix_project_information_title' => esc_html__('Categories', 'agenvix-core')
                    ],
                    [
                        'provix_project_information_title' => esc_html__('Date', 'agenvix-core'),
                    ]
                ],
                'title_field' => '{{{ provix_project_information_title }}}',
            ]
        );

        $this->end_controls_section();



        
        /**
         * Counter section
         */
        $this->start_controls_section(
            'provix_counter_section',
            [
                'label' => esc_html__('Counters', 'agenvix-core'),
                'description' => esc_html__( 'Control all the style settings from Style tab', 'agenvix-core' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();


        // Icon/Image
        $repeater->add_control(
            'provix_counter_icon_type',
            [
                'label' => esc_html__('Select Icon Type', 'agenvix-core'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'image',
                'options' => [
                    'image' => esc_html__('Image', 'agenvix-core'),
                    'icon' => esc_html__('Icon', 'agenvix-core'),
                ],
            ]
        );

        $repeater->add_control(
            'provix_icon_image',
            [
                'label' => esc_html__('Upload Icon Image', 'agenvix-core'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'provix_counter_icon_type' => 'image'
                ]

            ]
        );

        if (provix_is_elementor_version('<', '2.6.0')) {
            $repeater->add_control(
                'icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'fa fa-star',
                    'condition' => [
                        'provix_counter_icon_type' => 'icon'
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
                        'provix_counter_icon_type' => 'icon'
                    ]
                ]
            );
        }


        $repeater->add_control(
            'provix_counter_title',
            [
                'label' => esc_html__('Counter Title', 'agenvix-core'),
                'description' => provix_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Winning award', 'agenvix-core'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'provix_count_number', [
                'label' => esc_html__('Count Number', 'agenvix-core'),
                'description' => provix_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('200', 'agenvix-core'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'provix_count_number_post_text',
            [
                'label' => esc_html__('Count Number Post Text', 'agenvix-core'),
                'description' => provix_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('K', 'agenvix-core'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'provix_counter_list',
            [
                'label' => esc_html__('Counters - List', 'agenvix-core'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'provix_counter_title' => esc_html__('Project Completed', 'agenvix-core'),
                    ],
                    [
                        'provix_counter_title' => esc_html__('Years of Experience', 'agenvix-core')
                    ],
                    [
                        'provix_counter_title' => esc_html__('Happy Customers', 'agenvix-core')
                    ],
                    [
                        'provix_counter_title' => esc_html__('Avg. Conversation Rate', 'agenvix-core')
                    ]
                ],
                'title_field' => '{{{ provix_counter_title }}}',
            ]
        );

        $this->end_controls_section();


        /**
         * Features section
         */
        $this->start_controls_section(
            'provix_features',
            [
                'label' => esc_html__('Features List', 'agenvix-core'),
                'description' => esc_html__( 'Control all the style settings from Style tab', 'agenvix-core' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();


        $repeater->add_control(
            'provix_features_title', [
                'label' => esc_html__('Title', 'agenvix-core'),
                'description' => provix_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Feature Title', 'agenvix-core'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'provix_features_title_color',
            [
                'label' => __( 'Title Color', 'agenvix-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .project-details-list li' => 'color: {{VALUE}}',
                ],
            ]
        );

        $repeater->add_control(
            'provix_service_icon_type',
            [
                'label' => esc_html__('Select Icon Type', 'agenvix-core'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'image',
                'options' => [
                    'image' => esc_html__('Image', 'agenvix-core'),
                    'icon' => esc_html__('Icon', 'agenvix-core'),
                ],
            ]
        );

        $repeater->add_control(
            'provix_icon_image',
            [
                'label' => esc_html__('Upload Icon Image', 'agenvix-core'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'provix_service_icon_type' => 'image'
                ]

            ]
        );

        if (provix_is_elementor_version('<', '2.6.0')) {
            $repeater->add_control(
                'icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'fa fa-star',
                    'condition' => [
                        'provix_service_icon_type' => 'icon'
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
                        'provix_service_icon_type' => 'icon'
                    ]
                ]
            );
        }
     
        $this->add_control(
            'provix_features_list',
            [
                'label' => esc_html__('Features - List', 'agenvix-core'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'provix_features_title' => esc_html__('Conveniently create tactical intellectual capital before customized users', 'agenvix-core'),
                    ],
                    [
                        'provix_features_title' => esc_html__('Conveniently create tactical capital before customized users', 'agenvix-core')
                    ],
                    [
                        'provix_features_title' => esc_html__('Monotonectally productivate robust manufactured products users', 'agenvix-core'),
                    ]
                ],
                'title_field' => '{{{ provix_features_title }}}',
            ]
        );
        $this->end_controls_section();

        
        /**
         * Style section
         */
		$this->start_controls_section(
			'section_style',
			[
				'label' => __( 'Style', 'agenvix-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'text_transform',
			[
				'label' => __( 'Text Transform', 'agenvix-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => __( 'None', 'agenvix-core' ),
					'uppercase' => __( 'UPPERCASE', 'agenvix-core' ),
					'lowercase' => __( 'lowercase', 'agenvix-core' ),
					'capitalize' => __( 'Capitalize', 'agenvix-core' ),
				],
				'selectors' => [
					'{{WRAPPER}} .title' => 'text-transform: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render the widget ouprovixut on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

            if ( !empty($settings['provix_image']['url']) ) {
                $provix_image = !empty($settings['provix_image']['id']) ? wp_get_attachment_image_url( $settings['provix_image']['id'], $settings['provix_image_size_size']) : $settings['provix_image']['url'];
                $provix_image_alt = get_post_meta($settings["provix_image"]["id"], "_wp_attachment_image_alt", true);
            }
            if ( !empty($settings['provix_image_2']['url']) ) {
                $provix_image_2 = !empty($settings['provix_image_2']['id']) ? wp_get_attachment_image_url( $settings['provix_image_2']['id'], $settings['provix_image_size_size']) : $settings['provix_image_2']['url'];
                $provix_image_2_alt = get_post_meta($settings["provix_image_2"]["id"], "_wp_attachment_image_alt", true);
            }
        ?>

        <!-- project details -->
        <section class="project-details">
            <div class="container">
                <div class="project-details-top-container">
                    <div class="project-details-top-image">
                        <?php if ($settings['provix_image']['url'] || $settings['provix_image']['id']) : ?>  
                            <img src="<?php echo esc_url($provix_image); ?>" alt="<?php echo esc_attr($provix_image_alt); ?>">
                        <?php endif; ?>
                    </div>
                    <div class="project-top-info">
                        <?php foreach ($settings['provix_project_information_list'] as $item) : ?>
                            <div class="project-top-info-single">
                                <?php if ( !empty($item['provix_project_information_title']) ) : ?>
                                    <p><?php echo provix_kses( $item['provix_project_information_title'] ); ?></p>
                                <?php endif; ?>
                                <?php if ( !empty($item['provix_project_information_text']) ) : ?>
                                    <h5><a><?php echo provix_kses( $item['provix_project_information_text'] ); ?></a></h5>
                                <?php endif; ?>
                            </div>
                            <div class="project-top-info-border"></div>
                        <?php endforeach; ?>
                        <div class="project-top-info-single">
                            <p><?php echo esc_html__('Social Media:', 'agenvix-core');?></p>
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
                        if ( !empty($settings['provix_title' ]) ) :
                            printf( '<%1$s %2$s>%3$s</%1$s>',
                                tag_escape( $settings['provix_title_tag'] ),
                                $this->get_render_attribute_string( 'title_args' ),
                                provix_kses( $settings['provix_title' ] )
                                );
                        endif;
                    ?>
                    <?php if ( !empty($settings['provix_description']) ) : ?>    
                        <p class="mb_20"><?php echo provix_kses( $settings['provix_description'] ); ?></p>
                    <?php endif; ?>
                </div>
                <div class="service-details-content">
                    <?php
                        if ( !empty($settings['provix_title_2' ]) ) :
                            printf( '<%1$s %2$s>%3$s</%1$s>',
                                tag_escape( $settings['provix_title_tag'] ),
                                $this->get_render_attribute_string( 'title_args' ),
                                provix_kses( $settings['provix_title_2' ] )
                                );
                        endif;
                    ?>
                    <?php if ( !empty($settings['provix_description_2']) ) : ?>    
                        <p><?php echo provix_kses( $settings['provix_description_2'] ); ?></p>
                    <?php endif; ?>
                </div>
                <div class="project-details-counter-container">
                    <?php foreach ($settings['provix_counter_list'] as $item) : ?>
                        <div class="project-details-counter-single">
                            <div class="project-details-counter-single-icon">
                                <?php if($item['provix_counter_icon_type'] !== 'image') : ?>
                                    <?php if (!empty($item['icon']) || !empty($item['selected_icon']['value'])) : ?>
                                        <?php provix_render_icon($item, 'icon', 'selected_icon'); ?>
                                    <?php endif; ?>   
                                <?php else : ?>                                
                                    <?php if (!empty($item['provix_icon_image']['url'])): ?>  
                                        <img src="<?php echo $item['provix_icon_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['provix_icon_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                    <?php endif; ?> 
                                <?php endif; ?> 
                            </div>
                            <div class="project-details-counter">
                                <div class="odometer-box">
                                    <h5 class="odometer" data-count="<?php echo provix_kses($item['provix_count_number']);?>">00</h5>
                                    <div class="odometer-text"><?php echo provix_kses($item['provix_count_number_post_text' ]); ?></div>
                                </div>
                                <p><?php echo provix_kses($item['provix_counter_title' ]); ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="project-details-image-container">
                            <?php if ($settings['provix_image_2']['url'] || $settings['provix_image_2']['id']) : ?>  
                                <img src="<?php echo esc_url($provix_image_2); ?>" alt="<?php echo esc_attr($provix_image_2_alt); ?>">
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="project-details-list">
                            <ul>
                                <?php foreach ($settings['provix_features_list'] as $key => $item) :?>
                                    <li>
                                        <?php if($item['provix_service_icon_type'] !== 'image') : ?>
                                            <?php if (!empty($item['icon']) || !empty($item['selected_icon']['value'])) : ?>
                                                <?php provix_render_icon($item, 'icon', 'selected_icon'); ?>
                                            <?php endif; ?>   
                                        <?php else : ?>                                
                                            <?php if (!empty($item['provix_icon_image']['url'])): ?>  
                                                <img src="<?php echo $item['provix_icon_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['provix_icon_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                            <?php endif; ?> 
                                        <?php endif; ?> 
                                        <?php echo provix_kses($item['provix_features_title' ]); ?>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="service-details-content mt_80">
                    <?php
                        if ( !empty($settings['provix_title_3' ]) ) :
                            printf( '<%1$s %2$s>%3$s</%1$s>',
                                tag_escape( $settings['provix_title_tag'] ),
                                $this->get_render_attribute_string( 'title_args' ),
                                provix_kses( $settings['provix_title_3' ] )
                                );
                        endif;
                    ?>
                    <?php if ( !empty($settings['provix_description_3']) ) : ?>    
                        <p><?php echo provix_kses( $settings['provix_description_3'] ); ?></p>
                    <?php endif; ?>
                </div>
                <div class="service-details-content">
                    <?php
                        if ( !empty($settings['provix_title_4' ]) ) :
                            printf( '<%1$s %2$s>%3$s</%1$s>',
                                tag_escape( $settings['provix_title_tag'] ),
                                $this->get_render_attribute_string( 'title_args' ),
                                provix_kses( $settings['provix_title_4' ] )
                                );
                        endif;
                    ?>
                    <?php if ( !empty($settings['provix_description_4']) ) : ?>    
                        <p><?php echo provix_kses( $settings['provix_description_4'] ); ?></p>
                    <?php endif; ?>
                </div>
            </div>
            </section>
        <!-- project details -->
		<?php
	}

}

$widgets_manager->register( new Provix_Project_Details() );