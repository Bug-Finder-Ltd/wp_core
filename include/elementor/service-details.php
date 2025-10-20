<?php
namespace ProtineCore\Widgets;

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
use ProtineCore\Elementor\Controls\Group_Control_ProtineBGGradient;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Protine Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Protine_Service_Details extends Widget_Base {

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
		return __( 'Service Details', 'protinecore' );
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
		return 'protine-icon';
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
		return [ 'protinecore' ];
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
		return [ 'protinecore' ];
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
            'protine_section_title',
            [
                'label' => esc_html__('Title & Content', 'protinecore'),
            ]
        );

        $this->add_control(
            'protine_service_heading',
            [
                'label' => esc_html__('Protine Service Heading', 'protinecore'),
                'description' => protine_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Room Wallpaper', 'protinecore'),
                'placeholder' => esc_html__('Type Service Heading Here', 'protinecore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'protine_service_heading_color',
            [
                'label' => __( 'Protine Service Heading Color', 'protinecore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .service-details-content h3' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'protine_service_desctiption',
            [
                'label' => esc_html__('Service Description', 'protinecore'),
                'description' => protine_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Collaboratively provide access to an expanded array 248 Engine via timely leadership. Enthusiastically timely evolve transparent technologies whereas timely functionalities. Continually repurpose e-business info access rmation and prospective intellectual capital. Enthusiastically create strategic communities without realization iable infrastructures. Holisticly embrace professional technologies
Transparent technologies wherea timely functionalities. Continually repurpose business information arrive prospective intellectual capital. Enthusiastically create strategic communities.', 'protinecore'),
                'placeholder' => esc_html__('Type service description here', 'protinecore'),
            ]
        );

        $this->add_control(
            'protine_service_desctiption_color',
            [
                'label' => __( 'Description Color', 'protinecore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .service-details-content p' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'protine_service_heading_2',
            [
                'label' => esc_html__('Protine Service Heading 2', 'protinecore'),
                'description' => protine_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Room Wallpaper', 'protinecore'),
                'placeholder' => esc_html__('Type Service Heading Here', 'protinecore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'protine_service_heading_color_2',
            [
                'label' => __( 'Protine Service Heading Color 2', 'protinecore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .service-details-content h3' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'protine_service_desctiption_2',
            [
                'label' => esc_html__('Service Description 2', 'protinecore'),
                'description' => protine_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Collaboratively provide access to an expanded array 248 Engine via timely leadership. Enthusiastically an transparent technologies whereas timely functionalities. Continually repurpose e-business information is prospective intellectual capital. Enthusiastically create strategic communities without reliable infrastruct Holisticly embrace professional technologies create professional Technologies.', 'protinecore'),
                'placeholder' => esc_html__('Type service description here', 'protinecore'),
            ]
        );

        $this->add_control(
            'protine_service_desctiption_2_color',
            [
                'label' => __( 'Description 2 Color', 'protinecore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .service-details-content p' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'protine_service_heading_3',
            [
                'label' => esc_html__('Protine Service Heading 3', 'protinecore'),
                'description' => protine_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Room Wallpaper', 'protinecore'),
                'placeholder' => esc_html__('Type Service Heading Here', 'protinecore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'protine_service_heading_color_3',
            [
                'label' => __( 'Protine Service Heading Color 3', 'protinecore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .service-details-content h3' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'protine_service_desctiption_3',
            [
                'label' => esc_html__('Service Description 3', 'protinecore'),
                'description' => protine_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Prospective intellectual capital. Enthusiastically create strategic communities without reliable infrastru Holisticly embrace professional technologies create professional Technologies. Collaboratively provide to an expanded array 248 Engine via timely leadership enthusiastically evolve.', 'protinecore'),
                'placeholder' => esc_html__('Type service description here', 'protinecore'),
            ]
        );

        $this->add_control(
            'protine_service_desctiption_color_3',
            [
                'label' => __( 'Description Color 3', 'protinecore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .service-details-content p' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'protine_title_tag',
            [
                'label' => esc_html__('Title HTML Tag', 'protinecore'),
                'type' => Controls_Manager::CHOOSE,
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
                'type' => Controls_Manager::CHOOSE,
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
            'protine_service_video_url',
            [
                'label' => esc_html__('Video Url', 'protinecore'),
                'description' => protine_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('https://www.youtube.com/watch?v=kS0X-yIsB64', 'protinecore'),
                'placeholder' => esc_html__('Put video url here', 'protinecore'),
            ]
        );
        $this->end_controls_section();

        /**
         * Image section
         */
		$this->start_controls_section(
            '_protine_image',
            [
                'label' => esc_html__('Image', 'protinecore'),
            ]
        );
        $this->add_control(
            'protine_image',
            [
                'label' => esc_html__( 'Service Top Image', 'protinecore' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $this->add_control(
            'protine_video_bg_image',
            [
                'label' => esc_html__( 'Video Background Image', 'protinecore' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
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
                'type' => Controls_Manager::SWITCHER,
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
                    '{{WRAPPER}} .protine-overlap img' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'protine_image_overlap_x',
            [
                'label' => esc_html__( 'Image overlap position', 'protinecore' ),
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
                    '{{WRAPPER}} .protine-overlap img' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
                'condition' => array(
                    'protine_image_overlap' => 'yes',
                ),
            ]
        );

        $this->end_controls_section();

        
        /**
         * Big Features section
         */
        
		$this->start_controls_section(
			'protine_big_features',
			[
				'label' => esc_html__('Big Features List', 'protinecore'),
				'description' => esc_html__( 'Control all the style settings from Style tab', 'protinecore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'protine_big_features_title', [
				'label' => esc_html__('Title', 'protinecore'),
				'description' => protine_get_allowed_html_desc( 'basic' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Irrigation', 'protinecore'),
                'label_block' => true,
			]
        );

        $repeater->add_control(
			'protine_big_features_description', [
				'label' => esc_html__('Description', 'protinecore'),
				'description' => protine_get_allowed_html_desc( 'basic' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__('Enthusiastically create strategic communities without reliable', 'protinecore'),
                'label_block' => true,
			]
        );

		$repeater->add_control(
            'protine_icon_type',
            [
                'label' => esc_html__('Select Icon Type', 'protinecore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'icon',
                'options' => [
                    'image' => esc_html__('Image', 'protinecore'),
                    'icon' => esc_html__('Icon', 'protinecore'),
                ]
            ]
        );

        $repeater->add_control(
            'protine_icon_image',
            [
                'label' => esc_html__('Upload Image', 'protinecore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'protine_icon_type' => 'image'
                ]

            ]
        );
        if (protine_is_elementor_version('<', '2.6.0')) {
            $repeater->add_control(
                'icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'fa fa-star',
                    'condition' => [
                        'protine_icon_type' => 'icon',
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
                        'protine_icon_type' => 'icon'
                    ]
                ]
            );
        }
		
		$this->add_control(
			'protine_big_features_list',
			[
				'label' => esc_html__('Big Features - List', 'protinecore'),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'protine_big_features_title' => esc_html__('Best Quality Standard', 'protinecore'),
					],
					[
						'protine_big_features_title' => esc_html__('Crafty & Artistic Wall Art', 'protinecore')
                    ]
				],
                'title_field' => '{{{ protine_big_features_title }}}',
			]
        );

        $this->end_controls_section();

        /**
         * Features list
         */
        $this->start_controls_section(
            'protine_service_details_features',
            [
                'label' => esc_html__('Service Features List', 'protinecore'),
                'description' => esc_html__( 'Control all the style settings from Style tab', 'protinecore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'protine_service_list_heading',
            [
                'label' => esc_html__('Features Heading', 'protinecore'),
                'description' => protine_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('What You Benifits', 'protinecore'),
                'placeholder' => esc_html__('Type features heading here', 'protinecore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'protine_service_list_heading_color',
            [
                'label' => __( 'Features Title Color', 'protinecore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .service-details-left-list h5' => 'color: {{VALUE}}',
                ],
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'protine_service_icon_type',
            [
                'label' => esc_html__('Select Icon Type', 'protinecore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'image',
                'options' => [
                    'image' => esc_html__('Image', 'protinecore'),
                    'icon' => esc_html__('Icon', 'protinecore'),
                ],
            ]
        );

        $repeater->add_control(
            'protine_icon_image',
            [
                'label' => esc_html__('Upload Icon Image', 'protinecore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'protine_service_icon_type' => 'image'
                ]

            ]
        );

        if (protine_is_elementor_version('<', '2.6.0')) {
            $repeater->add_control(
                'icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'fa fa-star',
                    'condition' => [
                        'protine_service_icon_type' => 'icon'
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
                        'protine_service_icon_type' => 'icon'
                    ]
                ]
            );
        }

        $repeater->add_control(
            'protine_service_details_features_title', [
                'label' => esc_html__('Title', 'protinecore'),
                'description' => protine_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Feature Title', 'protinecore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'protine_service_details_features_title_color',
            [
                'label' => __( 'Title Color', 'protinecore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .service-details-left-list ul li' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_control(
            'protine_service_details_features_list',
            [
                'label' => esc_html__('Features - List', 'protinecore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'protine_service_details_features_title' => esc_html__('Knew About Fonts text the printing and', 'protinecore'),
                    ],
                    [
                        'protine_service_details_features_title' => esc_html__('Mistakes To Avoid to the dummy printing', 'protinecore')
                    ],
                    [
                        'protine_service_details_features_title' => esc_html__('Your Startup industry standard loream saum.', 'protinecore'),
                    ]
                ],
                'title_field' => '{{{ protine_service_details_features_title }}}',
            ]
        );

        $this->end_controls_section();
                
        /**
         * Process list
         */
        $this->start_controls_section(
            'protine_process',
            [
                'label' => esc_html__('Process List', 'protinecore'),
                'description' => esc_html__( 'Control all the style settings from Style tab', 'protinecore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        // process step
        $repeater->add_control(
            'protine_process_step', [
                'label' => esc_html__('Process Step', 'protinecore'),
                'description' => protine_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('01', 'protinecore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'protine_process_step_color',
            [
                'label' => __( 'Step Color', 'protinecore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .service-details-process-content-inner .process-number' => 'color: {{VALUE}}',
                ],
            ]
        );

        $repeater->add_control(
            'protine_process_title', [
                'label' => esc_html__('Process Title', 'protinecore'),
                'description' => protine_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Process title here', 'protinecore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'protine_process_title_color',
            [
                'label' => __( 'Process Title Color', 'protinecore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .service-details-process-content-inner a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $repeater->add_control(
            'protine_process_description',
            [
                'label' => esc_html__('Description', 'protinecore'),
                'description' => protine_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Holisticly embrace profession technologies create',
                'label_block' => true,
            ]
        );

        $this->add_control(
            'protine_process_list',
            [
                'label' => esc_html__('Process - List', 'protinecore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'protine_process_title' => esc_html__('Choose Your Service', 'protinecore'),
                    ],
                    [
                        'protine_process_title' => esc_html__('Confirm Your Service', 'protinecore')
                    ],
                    [
                        'protine_process_title' => esc_html__('Meet With Our Expert', 'protinecore')
                    ]
                ],
                'title_field' => '{{{ protine_process_title }}}',
            ]
        );
        $this->add_responsive_control(
            'protine_process_align',
            [
                'label' => esc_html__( 'Alignment', 'protinecore' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'text-left' => [
                        'title' => esc_html__( 'Left', 'protinecore' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'text-center' => [
                        'title' => esc_html__( 'Center', 'protinecore' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'text-right' => [
                        'title' => esc_html__( 'Right', 'protinecore' ),
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
            'protine_sidebar_services',
            [
                'label' => esc_html__('Sidebar Service List', 'protinecore'),
                'description' => esc_html__( 'Control all the style settings from Style tab', 'protinecore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'protine_sidebar_service_list_heading',
            [
                'label' => esc_html__('Sidebar Service List Heading', 'protinecore'),
                'description' => protine_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Services', 'protinecore'),
                'placeholder' => esc_html__('Type service name ', 'protinecore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'protine_sidebar_service_list_heading_color',
            [
                'label' => __( 'Service List Heading Color', 'protinecore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sidebar-category h5' => 'color: {{VALUE}}',
                ],
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'protine_sidebar_service_title', [
                'label' => esc_html__('Sidebar Service Title', 'protinecore'),
                'description' => protine_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Room Wallpaper', 'protinecore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'protine_sidebar_service_title_color',
            [
                'label' => __( 'Sidebar Service Title Color', 'protinecore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sidebar-category-list a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $repeater->add_control(
            'protine_sidebar_service_link', [
                'label' => esc_html__('Sidebar Service Link', 'protinecore'),
                'description' => protine_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('https://your-link.com', 'protinecore'),
                'label_block' => true,
            ]
        );
        
        $this->add_control(
            'protine_sidebar_service_list',
            [
                'label' => esc_html__('Service - List', 'protinecore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'protine_sidebar_service_title' => esc_html__('Room Wallpaper', 'protinecore'),
                    ],
                    [
                        'protine_sidebar_service_title' => esc_html__('Wall Painting', 'protinecore')
                    ],
                    [
                        'protine_sidebar_service_title' => esc_html__('Ceiling Wallpaper', 'protinecore'),
                    ],
                    [
                        'protine_sidebar_service_title' => esc_html__('PVC Panels', 'protinecore'),
                    ],
                    [
                        'protine_sidebar_service_title' => esc_html__('Outdoor Designs', 'protinecore'),
                    ]
                ],
                'title_field' => '{{{ protine_sidebar_service_title }}}',
            ]
        );

        $this->end_controls_section();
        
        /**
         * Sidebar call to action section
         */
        $this->start_controls_section(
            'protine_btn_button_group',
            [
                'label' => esc_html__('Sidebar Call to Action', 'protinecore'),
            ]
        );
        
        
        $this->add_control(
            'protine_sidebar_image',
            [
                'label' => esc_html__( 'Sidebar Image', 'protinecore' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'protine_sidebar_image_size',
                'default' => 'full',
                'exclude' => [
                    'custom'
                ]
            ]
        );
        $this->add_control(
            'protine_sidebar_image_overlap',
            [
                'label' => esc_html__('Image overlap to top?', 'protinecore'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'protinecore'),
                'label_off' => esc_html__('No', 'protinecore'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );
        $this->add_responsive_control(
            'protine_sidebar_image_height',
            [
                'label' => esc_html__( 'Image Height', 'protinecore' ),
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
                    '{{WRAPPER}} .protine-overlap img' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'protine_sidebar_image_overlap_x',
            [
                'label' => esc_html__( 'Image overlap position', 'protinecore' ),
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
                    '{{WRAPPER}} .protine-overlap img' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
                'condition' => array(
                    'protine_image_overlap' => 'yes',
                ),
            ]
        );
        
        $this->add_control(
            'protine_sidebar_phone_heading',
            [
                'label' => esc_html__('Sidebar Phone Heading', 'protinecore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Call 24 hr / 7 days', 'protinecore'),
                'title' => esc_html__('Enter phone heading', 'protinecore'),
                'label_block' => true,
            ]
        );
        
        $this->add_control(
            'protine_sidebar_btn_text',
            [
                'label' => esc_html__('Sidebar Button Text', 'protinecore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Get a Free Quote', 'protinecore'),
                'title' => esc_html__('Enter button text', 'protinecore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'protine_sidebar_btn_url',
            [
                'label' => esc_html__('Sidebar Button Url', 'protinecore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('https://your-link.com', 'protinecore'),
                'title' => esc_html__('Enter button url', 'protinecore'),
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
				'label' => __( 'Style', 'protinecore' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'text_transform',
			[
				'label' => __( 'Text Transform', 'protinecore' ),
				'type' => Controls_Manager::SELECT,
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


            if ( !empty($settings['protine_image']['url']) ) {
                $protine_image = !empty($settings['protine_image']['id']) ? wp_get_attachment_image_url( $settings['protine_image']['id'], $settings['protine_image_size_size']) : $settings['protine_image']['url'];
                $protine_image_alt = get_post_meta($settings["protine_image"]["id"], "_wp_attachment_image_alt", true);
            }

            if ( !empty($settings['protine_video_bg_image']['url']) ) {
                $protine_video_bg_image = !empty($settings['protine_video_bg_image']['id']) ? wp_get_attachment_image_url( $settings['protine_video_bg_image']['id'], $settings['protine_image_size_size']) : $settings['protine_video_bg_image']['url'];
                $protine_video_bg_image_alt = get_post_meta($settings["protine_video_bg_image"]["id"], "_wp_attachment_image_alt", true);
            }

            if ( !empty($settings['protine_sidebar_image']['url']) ) {
                $protine_sidebar_image = !empty($settings['protine_sidebar_image']['id']) ? wp_get_attachment_image_url( $settings['protine_sidebar_image']['id'], $settings['protine_image_size_size']) : $settings['protine_sidebar_image']['url'];
                $protine_sidebar_image_alt = get_post_meta($settings["protine_sidebar_image"]["id"], "_wp_attachment_image_alt", true);
            }
        ?>
            <!-- service details -->
            <section class="service-details">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="service-details-left-container">
                                <div class="service-details-top-image">
                                    <?php if ($settings['protine_image']['url'] || $settings['protine_image']['id']) : ?>
                                        <img src="<?php echo esc_url($protine_image); ?>" alt="<?php echo esc_attr($protine_image_alt); ?>">
                                    <?php endif; ?>
                                </div>
                                <div class="service-details-content">
                                    <?php
                                    if ( !empty($settings['protine_service_heading' ]) ) :
                                        printf( '<%1$s %2$s>%3$s</%1$s>',
                                            tag_escape( $settings['protine_title_tag'] ),
                                            $this->get_render_attribute_string( 'title_args' ),
                                            protine_kses( $settings['protine_service_heading' ] )
                                            );
                                    endif;
                                    ?>
                                    <?php if ( !empty($settings['protine_service_desctiption']) ) : ?>
                                        <p class="mb_20"><?php echo protine_kses( $settings['protine_service_desctiption'] ); ?></p>
                                    <?php endif; ?>
                                </div>
                                <div class="row">
                                    <?php foreach ($settings['protine_big_features_list'] as $item) : ?>
                                        <div class="col-lg-6 col-md-8">
                                            <div class="service-details-single">
                                                <div class="service-details-single-icon">
                                                    <?php if($item['protine_icon_type'] !== 'image') : ?>
                                                        <?php if (!empty($item['icon']) || !empty($item['selected_icon']['value'])) : ?>
                                                            <?php protine_render_icon($item, 'icon', 'selected_icon'); ?>
                                                        <?php endif; ?>   
                                                    <?php else : ?>                                
                                                        <?php if (!empty($item['protine_icon_image']['url'])): ?>  
                                                            <img src="<?php echo $item['protine_icon_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['protine_icon_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                                        <?php endif; ?> 
                                                    <?php endif; ?>
                                                </div>
                                                <div class="service-details-single-content">
                                                    <?php if ( !empty($item['protine_big_features_title']) ) : ?>  
                                                        <h6><?php echo protine_kses( $item['protine_big_features_title'] ); ?></h6>
                                                    <?php endif; ?>
                                                    <?php if ( !empty($item['protine_big_features_description']) ) : ?>  
                                                        <p><?php echo protine_kses( $item['protine_big_features_description'] ); ?></p>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <div class="service-details-content">
                                    <?php
                                    if ( !empty($settings['protine_service_heading_2' ]) ) :
                                        printf( '<%1$s %2$s>%3$s</%1$s>',
                                            tag_escape( $settings['protine_title_tag'] ),
                                            $this->get_render_attribute_string( 'title_args' ),
                                            protine_kses( $settings['protine_service_heading_2' ] )
                                            );
                                    endif;
                                    ?>
                                    <?php if ( !empty($settings['protine_service_desctiption_2']) ) : ?>
                                        <p><?php echo protine_kses( $settings['protine_service_desctiption_2'] ); ?></p>
                                    <?php endif; ?>
                                </div>
                                <div class="service-details-left-list-container">
                                    <div class="service-details-left-list-image">
                                        <div class="image">
                                            <?php if ($settings['protine_video_bg_image']['url'] || $settings['protine_video_bg_image']['id']) : ?>
                                                <img src="<?php echo esc_url($protine_video_bg_image); ?>" alt="<?php echo esc_attr($protine_video_bg_image_alt); ?>">
                                            <?php endif; ?>
                                        </div>
                                        <div class="service-details-left-list-video">
                                            <?php if ( !empty($settings['protine_service_video_url'])) : ?>
                                                <a class="play_btn hv-popup-link" href="<?php echo esc_url($settings['protine_service_video_url']); ?>">
                                                    <i class="fas fa-play"></i>
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="service-details-left-list">
                                        <?php if ( !empty($settings['protine_service_list_heading']) ) : ?>
                                            <h5><?php echo protine_kses( $settings['protine_service_list_heading'] ); ?></h5>
                                        <?php endif; ?>
                                        <ul>
                                            <?php foreach ($settings['protine_service_details_features_list'] as $item) : ?>
                                                <li>
                                                    <?php if($item['protine_service_icon_type'] !== 'image') : ?>
                                                        <?php if (!empty($item['icon']) || !empty($item['selected_icon']['value'])) : ?>
                                                            <?php protine_render_icon($item, 'icon', 'selected_icon'); ?>
                                                        <?php endif; ?>   
                                                    <?php else : ?>                                
                                                        <?php if (!empty($item['protine_icon_image']['url'])): ?>  
                                                            <img src="<?php echo $item['protine_icon_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['protine_icon_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                    <?php echo protine_kses($item['protine_service_details_features_title' ]); ?>
                                                </li>
                                            <?php endforeach; ?>  
                                        </ul>
                                    </div>
                                </div>
                                <div class="service-details-content">
                                    <?php
                                    if ( !empty($settings['protine_service_heading_3' ]) ) :
                                        printf( '<%1$s %2$s>%3$s</%1$s>',
                                            tag_escape( $settings['protine_title_tag'] ),
                                            $this->get_render_attribute_string( 'title_args' ),
                                            protine_kses( $settings['protine_service_heading_3' ] )
                                            );
                                    endif;
                                    ?>
                                    <?php if ( !empty($settings['protine_service_desctiption_3']) ) : ?>
                                        <p><?php echo protine_kses( $settings['protine_service_desctiption_3'] ); ?></p>
                                    <?php endif; ?>
                                </div>
                                <div class="service-details-process">
                                    <?php foreach ($settings['protine_process_list'] as $key => $item) : ?>
                                        <div class="service-details-process-content">
                                            <div class="service-details-process-content-inner">
                                                <div class="process-number">
                                                    <?php if (!empty($item['protine_process_step' ])): ?>
                                                        <?php echo protine_kses($item['protine_process_step' ]); ?>
                                                    <?php endif; ?>
                                                </div>
                                                <?php if (!empty($item['protine_process_title' ])): ?>
                                                    <a><?php echo protine_kses($item['protine_process_title' ]); ?></a>
                                                <?php endif; ?>
                                                <?php if (!empty($item['protine_process_description' ])): ?>
                                                    <p><?php echo protine_kses($item['protine_process_description']); ?></p>
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
                                            <?php if ( !empty($settings['protine_sidebar_service_list_heading']) ) : ?>
                                                <h5><?php echo protine_kses( $settings['protine_sidebar_service_list_heading'] ); ?></h5>
                                            <?php endif; ?>
                                            <div class="sidebar-category-list">
                                                <ul>
                                                    <?php foreach ($settings['protine_sidebar_service_list'] as $item) : ?>
                                                        <li>
                                                            <a href="<?php echo esc_url($item['protine_sidebar_service_link' ]); ?>"><span><?php echo protine_kses($item['protine_sidebar_service_title' ]); ?></span><i class="fa-regular fa-angle-right"></i></a>
                                                        </li>
                                                    <?php endforeach; ?> 
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="sidebar-advertisment">
                                        <div class="add-image">
                                            <?php if ($settings['protine_sidebar_image']['url'] || $settings['protine_sidebar_image']['id']) : ?>
                                                <img src="<?php echo esc_url($protine_sidebar_image); ?>" alt="<?php echo esc_attr($protine_sidebar_image_alt); ?>">
                                            <?php endif; ?>
                                        </div>
                                        <div class="sidebar-call-center">
                                            <div class="sidebar-call-center-inner">
                                                <?php if (!empty($settings['protine_sidebar_phone_heading'])) : ?>
                                                    <h6><i class="icon-call"></i> <?php echo protine_kses($settings['protine_sidebar_phone_heading']); ?></h6>
                                                <?php endif; ?>
                                                <?php if (!empty($settings['protine_sidebar_btn_url'])) : ?>
                                                    <a href="<?php echo esc_html($settings['protine_sidebar_btn_url']); ?>" class="btn-1">
                                                        <?php echo protine_kses($settings['protine_sidebar_btn_text']); ?> <span></span>
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

$widgets_manager->register( new Protine_Service_Details() );