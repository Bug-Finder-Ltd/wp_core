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
class Bwall_Service_Details extends Widget_Base {

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
		return 'service-details';
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
		return __( 'Service Details', 'bwallcore' );
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
         * Title and content section
         */
        $this->start_controls_section(
            'bwall_section_title',
            [
                'label' => esc_html__('Title & Content', 'bwallcore'),
            ]
        );

        $this->add_control(
            'bwall_service_heading',
            [
                'label' => esc_html__('Bwall Service Heading', 'bwallcore'),
                'description' => bwall_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Room Wallpaper', 'bwallcore'),
                'placeholder' => esc_html__('Type Service Heading Here', 'bwallcore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'bwall_service_heading_color',
            [
                'label' => __( 'Bwall Service Heading Color', 'bwallcore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .service-details-content h3' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'bwall_service_desctiption',
            [
                'label' => esc_html__('Service Description', 'bwallcore'),
                'description' => bwall_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Collaboratively provide access to an expanded array 248 Engine via timely leadership. Enthusiastically timely evolve transparent technologies whereas timely functionalities. Continually repurpose e-business info access rmation and prospective intellectual capital. Enthusiastically create strategic communities without realization iable infrastructures. Holisticly embrace professional technologies
Transparent technologies wherea timely functionalities. Continually repurpose business information arrive prospective intellectual capital. Enthusiastically create strategic communities.', 'bwallcore'),
                'placeholder' => esc_html__('Type service description here', 'bwallcore'),
            ]
        );

        $this->add_control(
            'bwall_service_desctiption_color',
            [
                'label' => __( 'Description Color', 'bwallcore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .service-details-content p' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'bwall_service_heading_2',
            [
                'label' => esc_html__('Bwall Service Heading 2', 'bwallcore'),
                'description' => bwall_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Room Wallpaper', 'bwallcore'),
                'placeholder' => esc_html__('Type Service Heading Here', 'bwallcore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'bwall_service_heading_color_2',
            [
                'label' => __( 'Bwall Service Heading Color 2', 'bwallcore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .service-details-content h3' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'bwall_service_desctiption_2',
            [
                'label' => esc_html__('Service Description 2', 'bwallcore'),
                'description' => bwall_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Collaboratively provide access to an expanded array 248 Engine via timely leadership. Enthusiastically an transparent technologies whereas timely functionalities. Continually repurpose e-business information is prospective intellectual capital. Enthusiastically create strategic communities without reliable infrastruct Holisticly embrace professional technologies create professional Technologies.', 'bwallcore'),
                'placeholder' => esc_html__('Type service description here', 'bwallcore'),
            ]
        );

        $this->add_control(
            'bwall_service_desctiption_2_color',
            [
                'label' => __( 'Description 2 Color', 'bwallcore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .service-details-content p' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'bwall_service_heading_3',
            [
                'label' => esc_html__('Bwall Service Heading 3', 'bwallcore'),
                'description' => bwall_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Room Wallpaper', 'bwallcore'),
                'placeholder' => esc_html__('Type Service Heading Here', 'bwallcore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'bwall_service_heading_color_3',
            [
                'label' => __( 'Bwall Service Heading Color 3', 'bwallcore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .service-details-content h3' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'bwall_service_desctiption_3',
            [
                'label' => esc_html__('Service Description 3', 'bwallcore'),
                'description' => bwall_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Prospective intellectual capital. Enthusiastically create strategic communities without reliable infrastru Holisticly embrace professional technologies create professional Technologies. Collaboratively provide to an expanded array 248 Engine via timely leadership enthusiastically evolve.', 'bwallcore'),
                'placeholder' => esc_html__('Type service description here', 'bwallcore'),
            ]
        );

        $this->add_control(
            'bwall_service_desctiption_color_3',
            [
                'label' => __( 'Description Color 3', 'bwallcore' ),
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
            'bwall_service_video_url',
            [
                'label' => esc_html__('Video Url', 'bwallcore'),
                'description' => bwall_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('https://www.youtube.com/watch?v=kS0X-yIsB64', 'bwallcore'),
                'placeholder' => esc_html__('Put video url here', 'bwallcore'),
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
            'bwall_image',
            [
                'label' => esc_html__( 'Service Top Image', 'bwallcore' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $this->add_control(
            'bwall_video_bg_image',
            [
                'label' => esc_html__( 'Video Background Image', 'bwallcore' ),
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
         * Big Features section
         */
        
		$this->start_controls_section(
			'bwall_big_features',
			[
				'label' => esc_html__('Big Features List', 'bwallcore'),
				'description' => esc_html__( 'Control all the style settings from Style tab', 'bwallcore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'bwall_big_features_title', [
				'label' => esc_html__('Title', 'bwallcore'),
				'description' => bwall_get_allowed_html_desc( 'basic' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Irrigation', 'bwallcore'),
                'label_block' => true,
			]
        );

        $repeater->add_control(
			'bwall_big_features_description', [
				'label' => esc_html__('Description', 'bwallcore'),
				'description' => bwall_get_allowed_html_desc( 'basic' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__('Enthusiastically create strategic communities without reliable', 'bwallcore'),
                'label_block' => true,
			]
        );

		$repeater->add_control(
            'bwall_icon_type',
            [
                'label' => esc_html__('Select Icon Type', 'bwallcore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'icon',
                'options' => [
                    'image' => esc_html__('Image', 'bwallcore'),
                    'icon' => esc_html__('Icon', 'bwallcore'),
                ]
            ]
        );

        $repeater->add_control(
            'bwall_icon_image',
            [
                'label' => esc_html__('Upload Image', 'bwallcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'bwall_icon_type' => 'image'
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
                        'bwall_icon_type' => 'icon',
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
                        'bwall_icon_type' => 'icon'
                    ]
                ]
            );
        }
		
		$this->add_control(
			'bwall_big_features_list',
			[
				'label' => esc_html__('Big Features - List', 'bwallcore'),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'bwall_big_features_title' => esc_html__('Best Quality Standard', 'bwallcore'),
					],
					[
						'bwall_big_features_title' => esc_html__('Crafty & Artistic Wall Art', 'bwallcore')
                    ]
				],
                'title_field' => '{{{ bwall_big_features_title }}}',
			]
        );

        $this->end_controls_section();

        /**
         * Features list
         */
        $this->start_controls_section(
            'bwall_service_details_features',
            [
                'label' => esc_html__('Service Features List', 'bwallcore'),
                'description' => esc_html__( 'Control all the style settings from Style tab', 'bwallcore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'bwall_service_list_heading',
            [
                'label' => esc_html__('Features Heading', 'bwallcore'),
                'description' => bwall_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('What You Benifits', 'bwallcore'),
                'placeholder' => esc_html__('Type features heading here', 'bwallcore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'bwall_service_list_heading_color',
            [
                'label' => __( 'Features Title Color', 'bwallcore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .service-details-left-list h5' => 'color: {{VALUE}}',
                ],
            ]
        );

        $repeater = new \Elementor\Repeater();

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

        $repeater->add_control(
            'bwall_service_details_features_title', [
                'label' => esc_html__('Title', 'bwallcore'),
                'description' => bwall_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Feature Title', 'bwallcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'bwall_service_details_features_title_color',
            [
                'label' => __( 'Title Color', 'bwallcore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .service-details-left-list ul li' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_control(
            'bwall_service_details_features_list',
            [
                'label' => esc_html__('Features - List', 'bwallcore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'bwall_service_details_features_title' => esc_html__('Knew About Fonts text the printing and', 'bwallcore'),
                    ],
                    [
                        'bwall_service_details_features_title' => esc_html__('Mistakes To Avoid to the dummy printing', 'bwallcore')
                    ],
                    [
                        'bwall_service_details_features_title' => esc_html__('Your Startup industry standard loream saum.', 'bwallcore'),
                    ]
                ],
                'title_field' => '{{{ bwall_service_details_features_title }}}',
            ]
        );

        $this->end_controls_section();
                
        /**
         * Process list
         */
        $this->start_controls_section(
            'bwall_process',
            [
                'label' => esc_html__('Process List', 'bwallcore'),
                'description' => esc_html__( 'Control all the style settings from Style tab', 'bwallcore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        // process step
        $repeater->add_control(
            'bwall_process_step', [
                'label' => esc_html__('Process Step', 'bwallcore'),
                'description' => bwall_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('01', 'bwallcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'bwall_process_step_color',
            [
                'label' => __( 'Step Color', 'bwallcore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .service-details-process-content-inner .process-number' => 'color: {{VALUE}}',
                ],
            ]
        );

        $repeater->add_control(
            'bwall_process_title', [
                'label' => esc_html__('Process Title', 'bwallcore'),
                'description' => bwall_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Process title here', 'bwallcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'bwall_process_title_color',
            [
                'label' => __( 'Process Title Color', 'bwallcore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .service-details-process-content-inner a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $repeater->add_control(
            'bwall_process_description',
            [
                'label' => esc_html__('Description', 'bwallcore'),
                'description' => bwall_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Holisticly embrace profession technologies create',
                'label_block' => true,
            ]
        );

        $this->add_control(
            'bwall_process_list',
            [
                'label' => esc_html__('Process - List', 'bwallcore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'bwall_process_title' => esc_html__('Choose Your Service', 'bwallcore'),
                    ],
                    [
                        'bwall_process_title' => esc_html__('Confirm Your Service', 'bwallcore')
                    ],
                    [
                        'bwall_process_title' => esc_html__('Meet With Our Expert', 'bwallcore')
                    ]
                ],
                'title_field' => '{{{ bwall_process_title }}}',
            ]
        );
        $this->add_responsive_control(
            'bwall_process_align',
            [
                'label' => esc_html__( 'Alignment', 'bwallcore' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'text-left' => [
                        'title' => esc_html__( 'Left', 'bwallcore' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'text-center' => [
                        'title' => esc_html__( 'Center', 'bwallcore' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'text-right' => [
                        'title' => esc_html__( 'Right', 'bwallcore' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'toggle' => true,
                'separator' => 'before',
            ]
        );
        $this->end_controls_section();

        /**
         * Sidebar service list
         */
        $this->start_controls_section(
            'bwall_sidebar_services',
            [
                'label' => esc_html__('Sidebar Service List', 'bwallcore'),
                'description' => esc_html__( 'Control all the style settings from Style tab', 'bwallcore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'bwall_sidebar_service_list_heading',
            [
                'label' => esc_html__('Sidebar Service List Heading', 'bwallcore'),
                'description' => bwall_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Services', 'bwallcore'),
                'placeholder' => esc_html__('Type service name ', 'bwallcore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'bwall_sidebar_service_list_heading_color',
            [
                'label' => __( 'Service List Heading Color', 'bwallcore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sidebar-category h5' => 'color: {{VALUE}}',
                ],
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'bwall_sidebar_service_title', [
                'label' => esc_html__('Sidebar Service Title', 'bwallcore'),
                'description' => bwall_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Room Wallpaper', 'bwallcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'bwall_sidebar_service_title_color',
            [
                'label' => __( 'Sidebar Service Title Color', 'bwallcore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sidebar-category-list a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $repeater->add_control(
            'bwall_sidebar_service_link', [
                'label' => esc_html__('Sidebar Service Link', 'bwallcore'),
                'description' => bwall_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('https://your-link.com', 'bwallcore'),
                'label_block' => true,
            ]
        );
        
        $this->add_control(
            'bwall_sidebar_service_list',
            [
                'label' => esc_html__('Service - List', 'bwallcore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'bwall_sidebar_service_title' => esc_html__('Room Wallpaper', 'bwallcore'),
                    ],
                    [
                        'bwall_sidebar_service_title' => esc_html__('Wall Painting', 'bwallcore')
                    ],
                    [
                        'bwall_sidebar_service_title' => esc_html__('Ceiling Wallpaper', 'bwallcore'),
                    ],
                    [
                        'bwall_sidebar_service_title' => esc_html__('PVC Panels', 'bwallcore'),
                    ],
                    [
                        'bwall_sidebar_service_title' => esc_html__('Outdoor Designs', 'bwallcore'),
                    ]
                ],
                'title_field' => '{{{ bwall_sidebar_service_title }}}',
            ]
        );

        $this->end_controls_section();
        
        /**
         * Sidebar call to action section
         */
        $this->start_controls_section(
            'bwall_btn_button_group',
            [
                'label' => esc_html__('Sidebar Call to Action', 'bwallcore'),
            ]
        );
        
        
        $this->add_control(
            'bwall_sidebar_image',
            [
                'label' => esc_html__( 'Sidebar Image', 'bwallcore' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'bwall_sidebar_image_size',
                'default' => 'full',
                'exclude' => [
                    'custom'
                ]
            ]
        );
        $this->add_control(
            'bwall_sidebar_image_overlap',
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
            'bwall_sidebar_image_height',
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
            'bwall_sidebar_image_overlap_x',
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
        
        $this->add_control(
            'bwall_sidebar_phone_heading',
            [
                'label' => esc_html__('Sidebar Phone Heading', 'bwallcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Call 24 hr / 7 days', 'bwallcore'),
                'title' => esc_html__('Enter phone heading', 'bwallcore'),
                'label_block' => true,
            ]
        );
        
        $this->add_control(
            'bwall_sidebar_btn_text',
            [
                'label' => esc_html__('Sidebar Button Text', 'bwallcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Get a Free Quote', 'bwallcore'),
                'title' => esc_html__('Enter button text', 'bwallcore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'bwall_sidebar_btn_url',
            [
                'label' => esc_html__('Sidebar Button Url', 'bwallcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('https://your-link.com', 'bwallcore'),
                'title' => esc_html__('Enter button url', 'bwallcore'),
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

            if ( !empty($settings['bwall_video_bg_image']['url']) ) {
                $bwall_video_bg_image = !empty($settings['bwall_video_bg_image']['id']) ? wp_get_attachment_image_url( $settings['bwall_video_bg_image']['id'], $settings['bwall_image_size_size']) : $settings['bwall_video_bg_image']['url'];
                $bwall_video_bg_image_alt = get_post_meta($settings["bwall_video_bg_image"]["id"], "_wp_attachment_image_alt", true);
            }

            if ( !empty($settings['bwall_sidebar_image']['url']) ) {
                $bwall_sidebar_image = !empty($settings['bwall_sidebar_image']['id']) ? wp_get_attachment_image_url( $settings['bwall_sidebar_image']['id'], $settings['bwall_image_size_size']) : $settings['bwall_sidebar_image']['url'];
                $bwall_sidebar_image_alt = get_post_meta($settings["bwall_sidebar_image"]["id"], "_wp_attachment_image_alt", true);
            }
        ?>
            <!-- service details -->
            <section class="service-details">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="service-details-left-container">
                                <div class="service-details-top-image">
                                    <?php if ($settings['bwall_image']['url'] || $settings['bwall_image']['id']) : ?>
                                        <img src="<?php echo esc_url($bwall_image); ?>" alt="<?php echo esc_attr($bwall_image_alt); ?>">
                                    <?php endif; ?>
                                </div>
                                <div class="service-details-content">
                                    <?php
                                    if ( !empty($settings['bwall_service_heading' ]) ) :
                                        printf( '<%1$s %2$s>%3$s</%1$s>',
                                            tag_escape( $settings['bwall_title_tag'] ),
                                            $this->get_render_attribute_string( 'title_args' ),
                                            bwall_kses( $settings['bwall_service_heading' ] )
                                            );
                                    endif;
                                    ?>
                                    <?php if ( !empty($settings['bwall_service_desctiption']) ) : ?>
                                        <p class="mb_20"><?php echo bwall_kses( $settings['bwall_service_desctiption'] ); ?></p>
                                    <?php endif; ?>
                                </div>
                                <div class="row">
                                    <?php foreach ($settings['bwall_big_features_list'] as $item) : ?>
                                        <div class="col-lg-6 col-md-8">
                                            <div class="service-details-single">
                                                <div class="service-details-single-icon">
                                                    <?php if($item['bwall_icon_type'] !== 'image') : ?>
                                                        <?php if (!empty($item['icon']) || !empty($item['selected_icon']['value'])) : ?>
                                                            <?php bwall_render_icon($item, 'icon', 'selected_icon'); ?>
                                                        <?php endif; ?>   
                                                    <?php else : ?>                                
                                                        <?php if (!empty($item['bwall_icon_image']['url'])): ?>  
                                                            <img src="<?php echo $item['bwall_icon_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['bwall_icon_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                                        <?php endif; ?> 
                                                    <?php endif; ?>
                                                </div>
                                                <div class="service-details-single-content">
                                                    <?php if ( !empty($item['bwall_big_features_title']) ) : ?>  
                                                        <h6><?php echo bwall_kses( $item['bwall_big_features_title'] ); ?></h6>
                                                    <?php endif; ?>
                                                    <?php if ( !empty($item['bwall_big_features_description']) ) : ?>  
                                                        <p><?php echo bwall_kses( $item['bwall_big_features_description'] ); ?></p>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <div class="service-details-content">
                                    <?php
                                    if ( !empty($settings['bwall_service_heading_2' ]) ) :
                                        printf( '<%1$s %2$s>%3$s</%1$s>',
                                            tag_escape( $settings['bwall_title_tag'] ),
                                            $this->get_render_attribute_string( 'title_args' ),
                                            bwall_kses( $settings['bwall_service_heading_2' ] )
                                            );
                                    endif;
                                    ?>
                                    <?php if ( !empty($settings['bwall_service_desctiption_2']) ) : ?>
                                        <p><?php echo bwall_kses( $settings['bwall_service_desctiption_2'] ); ?></p>
                                    <?php endif; ?>
                                </div>
                                <div class="service-details-left-list-container">
                                    <div class="service-details-left-list-image">
                                        <div class="image">
                                            <?php if ($settings['bwall_video_bg_image']['url'] || $settings['bwall_video_bg_image']['id']) : ?>
                                                <img src="<?php echo esc_url($bwall_video_bg_image); ?>" alt="<?php echo esc_attr($bwall_video_bg_image_alt); ?>">
                                            <?php endif; ?>
                                        </div>
                                        <div class="service-details-left-list-video">
                                            <?php if ( !empty($settings['bwall_service_video_url'])) : ?>
                                                <a class="play_btn hv-popup-link" href="<?php echo esc_url($settings['bwall_service_video_url']); ?>">
                                                    <i class="fas fa-play"></i>
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="service-details-left-list">
                                        <?php if ( !empty($settings['bwall_service_list_heading']) ) : ?>
                                            <h5><?php echo bwall_kses( $settings['bwall_service_list_heading'] ); ?></h5>
                                        <?php endif; ?>
                                        <ul>
                                            <?php foreach ($settings['bwall_service_details_features_list'] as $item) : ?>
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
                                                    <?php echo bwall_kses($item['bwall_service_details_features_title' ]); ?>
                                                </li>
                                            <?php endforeach; ?>  
                                        </ul>
                                    </div>
                                </div>
                                <div class="service-details-content">
                                    <?php
                                    if ( !empty($settings['bwall_service_heading_3' ]) ) :
                                        printf( '<%1$s %2$s>%3$s</%1$s>',
                                            tag_escape( $settings['bwall_title_tag'] ),
                                            $this->get_render_attribute_string( 'title_args' ),
                                            bwall_kses( $settings['bwall_service_heading_3' ] )
                                            );
                                    endif;
                                    ?>
                                    <?php if ( !empty($settings['bwall_service_desctiption_3']) ) : ?>
                                        <p><?php echo bwall_kses( $settings['bwall_service_desctiption_3'] ); ?></p>
                                    <?php endif; ?>
                                </div>
                                <div class="service-details-process">
                                    <?php foreach ($settings['bwall_process_list'] as $key => $item) : ?>
                                        <div class="service-details-process-content">
                                            <div class="service-details-process-content-inner">
                                                <div class="process-number">
                                                    <?php if (!empty($item['bwall_process_step' ])): ?>
                                                        <?php echo bwall_kses($item['bwall_process_step' ]); ?>
                                                    <?php endif; ?>
                                                </div>
                                                <?php if (!empty($item['bwall_process_title' ])): ?>
                                                    <a><?php echo bwall_kses($item['bwall_process_title' ]); ?></a>
                                                <?php endif; ?>
                                                <?php if (!empty($item['bwall_process_description' ])): ?>
                                                    <p><?php echo bwall_kses($item['bwall_process_description']); ?></p>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="service-details-right-container">
                                <div class="sidebar">
                                    <div class="sidebar-content">
                                        <div class="sidebar-category">
                                            <?php if ( !empty($settings['bwall_sidebar_service_list_heading']) ) : ?>
                                                <h5><?php echo bwall_kses( $settings['bwall_sidebar_service_list_heading'] ); ?></h5>
                                            <?php endif; ?>
                                            <div class="sidebar-category-list">
                                                <ul>
                                                    <?php foreach ($settings['bwall_sidebar_service_list'] as $item) : ?>
                                                        <li>
                                                            <a href="<?php echo esc_url($item['bwall_sidebar_service_link' ]); ?>"><span><?php echo bwall_kses($item['bwall_sidebar_service_title' ]); ?></span><i class="fa-regular fa-angle-right"></i></a>
                                                        </li>
                                                    <?php endforeach; ?> 
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="sidebar-advertisment">
                                        <div class="add-image">
                                            <?php if ($settings['bwall_sidebar_image']['url'] || $settings['bwall_sidebar_image']['id']) : ?>
                                                <img src="<?php echo esc_url($bwall_sidebar_image); ?>" alt="<?php echo esc_attr($bwall_sidebar_image_alt); ?>">
                                            <?php endif; ?>
                                        </div>
                                        <div class="sidebar-call-center">
                                            <div class="sidebar-call-center-inner">
                                                <?php if (!empty($settings['bwall_sidebar_phone_heading'])) : ?>
                                                    <h6><i class="icon-call"></i> <?php echo bwall_kses($settings['bwall_sidebar_phone_heading']); ?></h6>
                                                <?php endif; ?>
                                                <?php if (!empty($settings['bwall_sidebar_btn_url'])) : ?>
                                                    <a href="<?php echo esc_html($settings['bwall_sidebar_btn_url']); ?>" class="btn-1">
                                                        <?php echo bwall_kses($settings['bwall_sidebar_btn_text']); ?> <span></span>
                                                    </a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- service details -->
		<?php
	}

}

$widgets_manager->register( new Bwall_Service_Details() );