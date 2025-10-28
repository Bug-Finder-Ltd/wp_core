<?php
namespace NextdestinaCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Nextdestina Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Nextdestina_Contact_Form extends Widget_Base {

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
		return 'contactform';
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
		return __( 'Contact Form', 'nextdestinacore' );
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


    public function get_nextdestina_contact_form(){
        if ( ! class_exists( 'WPCF7' ) ) {
            return;
        }
        $nextdestina_cfa         = array();
        $nextdestina_cf_args     = array( 'posts_per_page' => -1, 'post_type'=> 'wpcf7_contact_form' );
        $nextdestina_forms       = get_posts( $nextdestina_cf_args );
        $nextdestina_cfa         = ['0' => esc_html__( 'Select Form', 'nextdestinacore' ) ];
        if( $nextdestina_forms ){
            foreach ( $nextdestina_forms as $nextdestina_form ){
                $nextdestina_cfa[$nextdestina_form->ID] = $nextdestina_form->post_title;
            }
        }else{
            $nextdestina_cfa[ esc_html__( 'No contact form found', 'nextdestinacore' ) ] = 0;
        }
        return $nextdestina_cfa;
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
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'layout-1' => esc_html__('Layout 1 - Contact Page', 'nextdestinacore'),
                ],
                'default' => 'layout-1',
            ]
        );

		$this->end_controls_section();

		        /**
         * Image section
         */
		$this->start_controls_section(
            '_nextdestina_image',
            [
                'label' => esc_html__('Image', 'nextdestinacore'),
            ]
        );
        $this->add_control(
            'nextdestina_image',
            [
                'label' => esc_html__( 'Section Image', 'nextdestinacore' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
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
                'type' => Controls_Manager::SWITCHER,
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
                    '{{WRAPPER}} .nextdestina-overlap img' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'nextdestina_image_overlap_x',
            [
                'label' => esc_html__( 'Image overlap position', 'nextdestinacore' ),
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
                    '{{WRAPPER}} .nextdestina-overlap img' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
                'condition' => array(
                    'nextdestina_image_overlap' => 'yes',
                ),
            ]
        );

        $this->end_controls_section();

		/**
		 * Form
		 */

        $this->start_controls_section(
            'nextdestinacore_contact',
            [
                'label' => esc_html__('Contact Form', 'nextdestinacore'),
            ]
		);

        $this->add_control(
            'nextdestinacore_select_contact_form',
            [
                'label'   => esc_html__( 'Select Form', 'nextdestinacore' ),
                'type'    => Controls_Manager::SELECT,
                'default' => '0',
                'options' => $this->get_nextdestina_contact_form(),
            ]
        );

		$this->end_controls_section();


		/**
		 * Title and information
		 */
		$this->start_controls_section(
			'_information',
			[
				'label' => esc_html__( 'Title & Information', 'nextdestinacore' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		
		$this->add_control(
			'nextdestina_section_title_show',
			[
				'label' => esc_html__( 'Section Title & Content', 'nextdestinacore' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'nextdestinacore' ),
				'label_off' => esc_html__( 'Hide', 'nextdestinacore' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'nextdestina_title',
			[
				'label' => esc_html__('Title', 'nextdestinacore'),
				'description' => nextdestina_get_allowed_html_desc( 'intermediate' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Nextdestina Title Here', 'nextdestinacore'),
				'placeholder' => esc_html__('Type Heading Text', 'nextdestinacore'),
				'label_block' => true,
			]
		);

		$this->add_control(
            'nextdestina_title_color',
            [
                'label' => __( 'Title Color', 'nextdestinacore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .contact-page-container h5' => 'color: {{VALUE}}',
                ],
            ]
        );

		$this->add_control(
			'nextdestina_title_tag',
			[
				'label' => esc_html__('Title HTML Tag', 'nextdestinacore'),
				'type' => Controls_Manager::CHOOSE,
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
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__('Left', 'nextdestinacore'),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__('Center', 'nextdestinacore'),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__('Right', 'nextdestinacore'),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'left',
				'toggle' => false,
				'selectors' => [
					'{{WRAPPER}}' => 'text-align: {{VALUE}};'
				]
			]
		);

		
		// email
		$this->add_control(
            'nextdestina_single_icon_type_email',
            [
                'label' => esc_html__('Select Icon Type for Email', 'nextdestinacore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'image',
                'options' => [
                    'image' => esc_html__('Image', 'nextdestinacore'),
                    'icon' => esc_html__('Icon', 'nextdestinacore'),
				],
            ]
        );

        $this->add_control(
            'nextdestina_icon_image_email',
            [
                'label' => esc_html__('Upload Icon Image for Email', 'nextdestinacore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
					'nextdestina_single_icon_type_email' => 'image',
                ]

            ]
        );

        if (nextdestina_is_elementor_version('<', '2.6.0')) {
            $this->add_control(
                'icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'fa fa-star',
                    'condition' => [
                        'nextdestina_single_icon_type_email' => 'icon'
                    ]
                ]
            );
        } else {
            $this->add_control(
                'selected_icon2',
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
                        'nextdestina_single_icon_type_email' => 'icon'
                    ]
                ]
            );
        }
        
		$this->add_control(
			'nextdestina_contact_email_heading',
			[
				'label' => esc_html__('Email Heading', 'nextdestinacore'),
				'description' => nextdestina_get_allowed_html_desc( 'intermediate' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Email', 'nextdestinacore'),
				'placeholder' => esc_html__('Type email heading', 'nextdestinacore'),
				'label_block' => true,
			]
		);

		$this->add_control(
            'nextdestina_contact_email_heading_color',
            [
                'label' => __( 'Email Heading Color', 'nextdestinacore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .contact-page-info-content p' => 'color: {{VALUE}}',
				],
            ]
		);
		
		$this->add_control(
			'nextdestina_contact_email',
			[
				'label' => esc_html__('Send Email', 'nextdestinacore'),
				'description' => nextdestina_get_allowed_html_desc( 'intermediate' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('example@gmail.com', 'nextdestinacore'),
				'placeholder' => esc_html__('Type your email', 'nextdestinacore'),
				'label_block' => true,
			]
		);

		$this->add_control(
            'nextdestina_contact_email_color',
            [
                'label' => __( 'Email Color', 'nextdestinacore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .contact-page-info-content a' => 'color: {{VALUE}}',
				],
            ]
		);
		
        // phone
		$this->add_control(
            'nextdestina_single_icon_type_phone',
            [
                'label' => esc_html__('Select Icon Type for Phone', 'nextdestinacore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'image',
                'options' => [
                    'image' => esc_html__('Image', 'nextdestinacore'),
                    'icon' => esc_html__('Icon', 'nextdestinacore'),
				],
            ]
        );

        $this->add_control(
            'nextdestina_icon_image_phone',
            [
                'label' => esc_html__('Upload Icon Image for Phone', 'nextdestinacore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
					'nextdestina_single_icon_type_phone' => 'image',
                ]

            ]
        );

        if (nextdestina_is_elementor_version('<', '2.6.0')) {
            $this->add_control(
                'icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'fa fa-star',
                    'condition' => [
                        'nextdestina_single_icon_type_phone' => 'icon'
                    ]
                ]
            );
        } else {
            $this->add_control(
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
                        'nextdestina_single_icon_type_phone' => 'icon'
                    ]
                ]
            );
        }
		$this->add_control(
			'nextdestina_contact_phone_heading',
			[
				'label' => esc_html__('Phone Number Heading', 'nextdestinacore'),
				'description' => nextdestina_get_allowed_html_desc( 'intermediate' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Call Us Now', 'nextdestinacore'),
				'placeholder' => esc_html__('Type phone number heading', 'nextdestinacore'),
				'label_block' => true,
			]
		);

		$this->add_control(
            'nextdestina_contact_phone_heading_color',
            [
                'label' => __( 'Phone Number Heading Color', 'nextdestinacore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .contact-page-info-content p' => 'color: {{VALUE}}',
				],
            ]
		);
		
		$this->add_control(
			'nextdestina_contact_phone_number',
			[
				'label' => esc_html__('Phone Number', 'nextdestinacore'),
				'description' => nextdestina_get_allowed_html_desc( 'intermediate' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('+880 123 (4567) 890', 'nextdestinacore'),
				'placeholder' => esc_html__('Type your phone number', 'nextdestinacore'),
				'label_block' => true,
			]
		);

		$this->add_control(
            'nextdestina_contact_phone_number_color',
            [
                'label' => __( 'Phone Number Color', 'nextdestinacore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .contact-page-info-content a' => 'color: {{VALUE}}',
				],
            ]
		);

		// location
		$this->add_control(
			'nextdestina_single_icon_type_location',
			[
				'label' => esc_html__('Select Icon Type for Location', 'nextdestinacore'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'image',
				'options' => [
					'image' => esc_html__('Image', 'nextdestinacore'),
					'icon' => esc_html__('Icon', 'nextdestinacore'),
				],
			]
		);

		$this->add_control(
			'nextdestina_icon_image_location',
			[
				'label' => esc_html__('Upload Icon Image for Location', 'nextdestinacore'),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'nextdestina_single_icon_type_location' => 'image',
				]

			]
		);

		if (nextdestina_is_elementor_version('<', '2.6.0')) {
			$this->add_control(
				'icon',
				[
					'show_label' => false,
					'type' => Controls_Manager::ICON,
					'label_block' => true,
					'default' => 'fa fa-star',
					'condition' => [
						'nextdestina_single_icon_type_location' => 'icon'
					]
				]
			);
		} else {
			$this->add_control(
				'selected_icon3',
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
						'nextdestina_single_icon_type_location' => 'icon'
					]
				]
			);
		}

		$this->add_control(
			'nextdestina_contact_location_heading',
			[
				'label' => esc_html__('Location Heading', 'nextdestinacore'),
				'description' => nextdestina_get_allowed_html_desc( 'intermediate' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Location', 'nextdestinacore'),
				'placeholder' => esc_html__('Type location heading', 'nextdestinacore'),
				'label_block' => true,
			]
		);

		$this->add_control(
			'nextdestina_contact_location_heading_color',
			[
				'label' => __( 'Location Heading Color', 'nextdestinacore' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .contact-page-info-content p' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'nextdestina_contact_location',
			[
				'label' => esc_html__('Location', 'nextdestinacore'),
				'description' => nextdestina_get_allowed_html_desc( 'intermediate' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('122/B New market, USA', 'nextdestinacore'),
				'placeholder' => esc_html__('Type your location', 'nextdestinacore'),
				'label_block' => true,
			]
		);

		$this->add_control(
			'nextdestina_contact_location_color',
			[
				'label' => __( 'Location Color', 'nextdestinacore' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .contact-page-info-content span' => 'color: {{VALUE}}',
				],
			]
		);

		// open hour
		$this->add_control(
			'nextdestina_single_icon_type_open_hour',
			[
				'label' => esc_html__('Select Icon Type for Open Hour', 'nextdestinacore'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'image',
				'options' => [
					'image' => esc_html__('Image', 'nextdestinacore'),
					'icon' => esc_html__('Icon', 'nextdestinacore'),
				],
			]
		);

		$this->add_control(
			'nextdestina_icon_image_open_hour',
			[
				'label' => esc_html__('Upload Icon Image for Open Hour', 'nextdestinacore'),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'nextdestina_single_icon_type_open_hour' => 'image',
				]

			]
		);

		if (nextdestina_is_elementor_version('<', '2.6.0')) {
			$this->add_control(
				'icon',
				[
					'show_label' => false,
					'type' => Controls_Manager::ICON,
					'label_block' => true,
					'default' => 'fa fa-star',
					'condition' => [
						'nextdestina_single_icon_type_open_hour' => 'icon'
					]
				]
			);
		} else {
			$this->add_control(
				'selected_icon4',
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
						'nextdestina_single_icon_type_open_hour' => 'icon'
					]
				]
			);
		}

		$this->add_control(
			'nextdestina_contact_open_hour_heading',
			[
				'label' => esc_html__('Open Hour Heading', 'nextdestinacore'),
				'description' => nextdestina_get_allowed_html_desc( 'intermediate' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Open Time', 'nextdestinacore'),
				'placeholder' => esc_html__('Type open hour heading', 'nextdestinacore'),
				'label_block' => true,
			]
		);

		$this->add_control(
			'nextdestina_contact_open_hour_heading_color',
			[
				'label' => __( 'Open Hour Heading Color', 'nextdestinacore' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .contact-page-info-content p' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'nextdestina_contact_open_hour',
			[
				'label' => esc_html__('Open Hour', 'nextdestinacore'),
				'description' => nextdestina_get_allowed_html_desc( 'intermediate' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Mon - Sat (10.00AM - 4.00PM)', 'nextdestinacore'),
				'placeholder' => esc_html__('Type your open hour', 'nextdestinacore'),
				'label_block' => true,
			]
		);

		$this->add_control(
			'nextdestina_contact_open_hour_color',
			[
				'label' => __( 'Open Hour Color', 'nextdestinacore' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .contact-page-info-content span' => 'color: {{VALUE}}',
				],
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
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'text_transform',
			[
				'label' => __( 'Text Transform', 'nextdestinacore' ),
				'type' => Controls_Manager::SELECT,
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

			if ( !empty($settings['nextdestina_image']['url']) ) {
				$nextdestina_image = !empty($settings['nextdestina_image']['id']) ? wp_get_attachment_image_url( $settings['nextdestina_image']['id'], $settings['nextdestina_image_size_size']) : $settings['nextdestina_image']['url'];
				$nextdestina_image_alt = get_post_meta($settings["nextdestina_image"]["id"], "_wp_attachment_image_alt", true);
			}
		?>

			<!-- contact page -->
			<section class="contact-page">
				<div class="container">
					<div class="row">
						<div class="col-lg-7">
							<div class="contact-page-image">
								<?php if ($settings['nextdestina_image']['url'] || $settings['nextdestina_image']['id']) : ?>
									<img src="<?php echo esc_url($nextdestina_image); ?>" alt="<?php echo esc_attr($nextdestina_image_alt); ?>">
								<?php endif; ?>
							</div>
						</div>
						<div class="col-lg-5">
							<div class="contact-page-container">
								<?php
									if ( !empty($settings['nextdestina_title' ]) ) :
										printf( '<%1$s %2$s>%3$s</%1$s>',
											tag_escape( $settings['nextdestina_title_tag'] ),
											$this->get_render_attribute_string( 'title' ),
											nextdestina_kses( $settings['nextdestina_title' ] )
											);
									endif;
								?>
								<?php if( !empty($settings['nextdestinacore_select_contact_form']) ) : ?> 
									<div class="contact-page-form"> 
										<?php echo do_shortcode( '[contact-form-7  id="'.$settings['nextdestinacore_select_contact_form'].'"]' ); ?>
									</div>
								<?php else : ?>
									<?php echo '<div class="alert alert-warning"><p class="m-0">' . __('Please Select contact form.', 'nextdestinacore' ). '</p></div>'; ?>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
			</section>
			<!-- contact page -->

			<!-- contact page info -->
			<div class="contact-page-info">
				<div class="container">
					<div class="row">
						<div class="col-xl-3 col-lg-4 col-md-6">
							<div class="contact-page-info-single">
								<div class="contact-page-info-icon">
									<i class="icon-email-2"></i>
								</div>
								<div class="contact-page-info-content">
									<?php if ( !empty($settings['nextdestina_contact_email_heading']) ) : ?>    
										<p><?php echo nextdestina_kses( $settings['nextdestina_contact_email_heading'] ); ?></p>
									<?php endif; ?>
									<?php if ( !empty($settings['nextdestina_contact_email']) ) : ?>
										<a href="mailto:<?php echo nextdestina_kses( $settings['nextdestina_contact_email'] ); ?>"><?php echo nextdestina_kses( $settings['nextdestina_contact_email'] ); ?></a>
									<?php endif; ?>
								</div>
							</div>
						</div>
						<div class="col-xl-3 col-lg-4 col-md-6">
							<div class="contact-page-info-single">
								<div class="contact-page-info-icon">
									<i class="icon-call-2"></i>
								</div>
								<div class="contact-page-info-content">
									<?php if ( !empty($settings['nextdestina_contact_phone_heading']) ) : ?>    
										<p><?php echo nextdestina_kses( $settings['nextdestina_contact_phone_heading'] ); ?></p>
									<?php endif; ?>
									<?php if ( !empty($settings['nextdestina_contact_phone_number']) ) : ?>
										<a href="tel:<?php echo esc_attr(str_replace(' ', '-', $settings['nextdestina_contact_phone_number'])); ?>"><?php echo nextdestina_kses( $settings['nextdestina_contact_phone_number'] ); ?></a>
									<?php endif; ?>
								</div>
							</div>
						</div>
						<div class="col-xl-3 col-lg-4 col-md-6">
							<div class="contact-page-info-single">
								<div class="contact-page-info-icon">
									<i class="icon-location-dot"></i>
								</div>
								<div class="contact-page-info-content">
									<?php if ( !empty($settings['nextdestina_contact_location_heading']) ) : ?>    
										<p><?php echo nextdestina_kses( $settings['nextdestina_contact_location_heading'] ); ?></p>
									<?php endif; ?>
									<?php if ( !empty($settings['nextdestina_contact_location']) ) : ?>
										<span><?php echo nextdestina_kses( $settings['nextdestina_contact_location'] ); ?></span>
									<?php endif; ?>
								</div>
							</div>
						</div>
						<div class="col-xl-3 col-lg-5 col-md-6">
							<div class="contact-page-info-single">
								<div class="contact-page-info-icon">
									<i class="icon-watch"></i>
								</div>
								<div class="contact-page-info-content">
									<?php if ( !empty($settings['nextdestina_contact_open_hour_heading']) ) : ?>    
										<p><?php echo nextdestina_kses( $settings['nextdestina_contact_open_hour_heading'] ); ?></p>
									<?php endif; ?>
									<?php if ( !empty($settings['nextdestina_contact_open_hour']) ) : ?>
										<span><?php echo nextdestina_kses( $settings['nextdestina_contact_open_hour'] ); ?></span>
									<?php endif; ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- contact page info -->

        <?php
	}
}

$widgets_manager->register( new Nextdestina_Contact_Form() );