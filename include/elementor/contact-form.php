<?php
namespace ProtineCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Protine Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Protine_Contact_Form extends Widget_Base {

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
		return __( 'Contact Form', 'protinecore' );
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


    public function get_protine_contact_form(){
        if ( ! class_exists( 'WPCF7' ) ) {
            return;
        }
        $protine_cfa         = array();
        $protine_cf_args     = array( 'posts_per_page' => -1, 'post_type'=> 'wpcf7_contact_form' );
        $protine_forms       = get_posts( $protine_cf_args );
        $protine_cfa         = ['0' => esc_html__( 'Select Form', 'protinecore' ) ];
        if( $protine_forms ){
            foreach ( $protine_forms as $protine_form ){
                $protine_cfa[$protine_form->ID] = $protine_form->post_title;
            }
        }else{
            $protine_cfa[ esc_html__( 'No contact form found', 'protinecore' ) ] = 0;
        }
        return $protine_cfa;
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
            'protine_layout',
            [
                'label' => esc_html__('Design Layout', 'protinecore'),
            ]
        );
        $this->add_control(
            'protine_design_style',
            [
                'label' => esc_html__('Select Layout', 'protinecore'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'layout-1' => esc_html__('Layout 1 - Contact Page', 'protinecore'),
                ],
                'default' => 'layout-1',
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
                'label' => esc_html__( 'Section Image', 'protinecore' ),
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
		 * Form
		 */

        $this->start_controls_section(
            'protinecore_contact',
            [
                'label' => esc_html__('Contact Form', 'protinecore'),
            ]
		);

        $this->add_control(
            'protinecore_select_contact_form',
            [
                'label'   => esc_html__( 'Select Form', 'protinecore' ),
                'type'    => Controls_Manager::SELECT,
                'default' => '0',
                'options' => $this->get_protine_contact_form(),
            ]
        );

		$this->end_controls_section();


		/**
		 * Title and information
		 */
		$this->start_controls_section(
			'_information',
			[
				'label' => esc_html__( 'Title & Information', 'protinecore' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		
		$this->add_control(
			'protine_section_title_show',
			[
				'label' => esc_html__( 'Section Title & Content', 'protinecore' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'protinecore' ),
				'label_off' => esc_html__( 'Hide', 'protinecore' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'protine_title',
			[
				'label' => esc_html__('Title', 'protinecore'),
				'description' => protine_get_allowed_html_desc( 'intermediate' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Protine Title Here', 'protinecore'),
				'placeholder' => esc_html__('Type Heading Text', 'protinecore'),
				'label_block' => true,
			]
		);

		$this->add_control(
            'protine_title_color',
            [
                'label' => __( 'Title Color', 'protinecore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .contact-page-container h5' => 'color: {{VALUE}}',
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
					'left' => [
						'title' => esc_html__('Left', 'protinecore'),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__('Center', 'protinecore'),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__('Right', 'protinecore'),
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
            'protine_single_icon_type_email',
            [
                'label' => esc_html__('Select Icon Type for Email', 'protinecore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'image',
                'options' => [
                    'image' => esc_html__('Image', 'protinecore'),
                    'icon' => esc_html__('Icon', 'protinecore'),
				],
            ]
        );

        $this->add_control(
            'protine_icon_image_email',
            [
                'label' => esc_html__('Upload Icon Image for Email', 'protinecore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
					'protine_single_icon_type_email' => 'image',
                ]

            ]
        );

        if (protine_is_elementor_version('<', '2.6.0')) {
            $this->add_control(
                'icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'fa fa-star',
                    'condition' => [
                        'protine_single_icon_type_email' => 'icon'
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
                        'protine_single_icon_type_email' => 'icon'
                    ]
                ]
            );
        }
        
		$this->add_control(
			'protine_contact_email_heading',
			[
				'label' => esc_html__('Email Heading', 'protinecore'),
				'description' => protine_get_allowed_html_desc( 'intermediate' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Email', 'protinecore'),
				'placeholder' => esc_html__('Type email heading', 'protinecore'),
				'label_block' => true,
			]
		);

		$this->add_control(
            'protine_contact_email_heading_color',
            [
                'label' => __( 'Email Heading Color', 'protinecore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .contact-page-info-content p' => 'color: {{VALUE}}',
				],
            ]
		);
		
		$this->add_control(
			'protine_contact_email',
			[
				'label' => esc_html__('Send Email', 'protinecore'),
				'description' => protine_get_allowed_html_desc( 'intermediate' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('example@gmail.com', 'protinecore'),
				'placeholder' => esc_html__('Type your email', 'protinecore'),
				'label_block' => true,
			]
		);

		$this->add_control(
            'protine_contact_email_color',
            [
                'label' => __( 'Email Color', 'protinecore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .contact-page-info-content a' => 'color: {{VALUE}}',
				],
            ]
		);
		
        // phone
		$this->add_control(
            'protine_single_icon_type_phone',
            [
                'label' => esc_html__('Select Icon Type for Phone', 'protinecore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'image',
                'options' => [
                    'image' => esc_html__('Image', 'protinecore'),
                    'icon' => esc_html__('Icon', 'protinecore'),
				],
            ]
        );

        $this->add_control(
            'protine_icon_image_phone',
            [
                'label' => esc_html__('Upload Icon Image for Phone', 'protinecore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
					'protine_single_icon_type_phone' => 'image',
                ]

            ]
        );

        if (protine_is_elementor_version('<', '2.6.0')) {
            $this->add_control(
                'icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'fa fa-star',
                    'condition' => [
                        'protine_single_icon_type_phone' => 'icon'
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
                        'protine_single_icon_type_phone' => 'icon'
                    ]
                ]
            );
        }
		$this->add_control(
			'protine_contact_phone_heading',
			[
				'label' => esc_html__('Phone Number Heading', 'protinecore'),
				'description' => protine_get_allowed_html_desc( 'intermediate' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Call Us Now', 'protinecore'),
				'placeholder' => esc_html__('Type phone number heading', 'protinecore'),
				'label_block' => true,
			]
		);

		$this->add_control(
            'protine_contact_phone_heading_color',
            [
                'label' => __( 'Phone Number Heading Color', 'protinecore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .contact-page-info-content p' => 'color: {{VALUE}}',
				],
            ]
		);
		
		$this->add_control(
			'protine_contact_phone_number',
			[
				'label' => esc_html__('Phone Number', 'protinecore'),
				'description' => protine_get_allowed_html_desc( 'intermediate' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('+880 123 (4567) 890', 'protinecore'),
				'placeholder' => esc_html__('Type your phone number', 'protinecore'),
				'label_block' => true,
			]
		);

		$this->add_control(
            'protine_contact_phone_number_color',
            [
                'label' => __( 'Phone Number Color', 'protinecore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .contact-page-info-content a' => 'color: {{VALUE}}',
				],
            ]
		);

		// location
		$this->add_control(
			'protine_single_icon_type_location',
			[
				'label' => esc_html__('Select Icon Type for Location', 'protinecore'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'image',
				'options' => [
					'image' => esc_html__('Image', 'protinecore'),
					'icon' => esc_html__('Icon', 'protinecore'),
				],
			]
		);

		$this->add_control(
			'protine_icon_image_location',
			[
				'label' => esc_html__('Upload Icon Image for Location', 'protinecore'),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'protine_single_icon_type_location' => 'image',
				]

			]
		);

		if (protine_is_elementor_version('<', '2.6.0')) {
			$this->add_control(
				'icon',
				[
					'show_label' => false,
					'type' => Controls_Manager::ICON,
					'label_block' => true,
					'default' => 'fa fa-star',
					'condition' => [
						'protine_single_icon_type_location' => 'icon'
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
						'protine_single_icon_type_location' => 'icon'
					]
				]
			);
		}

		$this->add_control(
			'protine_contact_location_heading',
			[
				'label' => esc_html__('Location Heading', 'protinecore'),
				'description' => protine_get_allowed_html_desc( 'intermediate' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Location', 'protinecore'),
				'placeholder' => esc_html__('Type location heading', 'protinecore'),
				'label_block' => true,
			]
		);

		$this->add_control(
			'protine_contact_location_heading_color',
			[
				'label' => __( 'Location Heading Color', 'protinecore' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .contact-page-info-content p' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'protine_contact_location',
			[
				'label' => esc_html__('Location', 'protinecore'),
				'description' => protine_get_allowed_html_desc( 'intermediate' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('122/B New market, USA', 'protinecore'),
				'placeholder' => esc_html__('Type your location', 'protinecore'),
				'label_block' => true,
			]
		);

		$this->add_control(
			'protine_contact_location_color',
			[
				'label' => __( 'Location Color', 'protinecore' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .contact-page-info-content span' => 'color: {{VALUE}}',
				],
			]
		);

		// open hour
		$this->add_control(
			'protine_single_icon_type_open_hour',
			[
				'label' => esc_html__('Select Icon Type for Open Hour', 'protinecore'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'image',
				'options' => [
					'image' => esc_html__('Image', 'protinecore'),
					'icon' => esc_html__('Icon', 'protinecore'),
				],
			]
		);

		$this->add_control(
			'protine_icon_image_open_hour',
			[
				'label' => esc_html__('Upload Icon Image for Open Hour', 'protinecore'),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'protine_single_icon_type_open_hour' => 'image',
				]

			]
		);

		if (protine_is_elementor_version('<', '2.6.0')) {
			$this->add_control(
				'icon',
				[
					'show_label' => false,
					'type' => Controls_Manager::ICON,
					'label_block' => true,
					'default' => 'fa fa-star',
					'condition' => [
						'protine_single_icon_type_open_hour' => 'icon'
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
						'protine_single_icon_type_open_hour' => 'icon'
					]
				]
			);
		}

		$this->add_control(
			'protine_contact_open_hour_heading',
			[
				'label' => esc_html__('Open Hour Heading', 'protinecore'),
				'description' => protine_get_allowed_html_desc( 'intermediate' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Open Time', 'protinecore'),
				'placeholder' => esc_html__('Type open hour heading', 'protinecore'),
				'label_block' => true,
			]
		);

		$this->add_control(
			'protine_contact_open_hour_heading_color',
			[
				'label' => __( 'Open Hour Heading Color', 'protinecore' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .contact-page-info-content p' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'protine_contact_open_hour',
			[
				'label' => esc_html__('Open Hour', 'protinecore'),
				'description' => protine_get_allowed_html_desc( 'intermediate' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Mon - Sat (10.00AM - 4.00PM)', 'protinecore'),
				'placeholder' => esc_html__('Type your open hour', 'protinecore'),
				'label_block' => true,
			]
		);

		$this->add_control(
			'protine_contact_open_hour_color',
			[
				'label' => __( 'Open Hour Color', 'protinecore' ),
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
		?>

			<!-- contact page -->
			<section class="contact-page">
				<div class="container">
					<div class="row">
						<div class="col-lg-7">
							<div class="contact-page-image">
								<?php if ($settings['protine_image']['url'] || $settings['protine_image']['id']) : ?>
									<img src="<?php echo esc_url($protine_image); ?>" alt="<?php echo esc_attr($protine_image_alt); ?>">
								<?php endif; ?>
							</div>
						</div>
						<div class="col-lg-5">
							<div class="contact-page-container">
								<?php
									if ( !empty($settings['protine_title' ]) ) :
										printf( '<%1$s %2$s>%3$s</%1$s>',
											tag_escape( $settings['protine_title_tag'] ),
											$this->get_render_attribute_string( 'title' ),
											protine_kses( $settings['protine_title' ] )
											);
									endif;
								?>
								<?php if( !empty($settings['protinecore_select_contact_form']) ) : ?> 
									<div class="contact-page-form"> 
										<?php echo do_shortcode( '[contact-form-7  id="'.$settings['protinecore_select_contact_form'].'"]' ); ?>
									</div>
								<?php else : ?>
									<?php echo '<div class="alert alert-warning"><p class="m-0">' . __('Please Select contact form.', 'protinecore' ). '</p></div>'; ?>
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
									<?php if ( !empty($settings['protine_contact_email_heading']) ) : ?>    
										<p><?php echo protine_kses( $settings['protine_contact_email_heading'] ); ?></p>
									<?php endif; ?>
									<?php if ( !empty($settings['protine_contact_email']) ) : ?>
										<a href="mailto:<?php echo protine_kses( $settings['protine_contact_email'] ); ?>"><?php echo protine_kses( $settings['protine_contact_email'] ); ?></a>
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
									<?php if ( !empty($settings['protine_contact_phone_heading']) ) : ?>    
										<p><?php echo protine_kses( $settings['protine_contact_phone_heading'] ); ?></p>
									<?php endif; ?>
									<?php if ( !empty($settings['protine_contact_phone_number']) ) : ?>
										<a href="tel:<?php echo esc_attr(str_replace(' ', '-', $settings['protine_contact_phone_number'])); ?>"><?php echo protine_kses( $settings['protine_contact_phone_number'] ); ?></a>
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
									<?php if ( !empty($settings['protine_contact_location_heading']) ) : ?>    
										<p><?php echo protine_kses( $settings['protine_contact_location_heading'] ); ?></p>
									<?php endif; ?>
									<?php if ( !empty($settings['protine_contact_location']) ) : ?>
										<span><?php echo protine_kses( $settings['protine_contact_location'] ); ?></span>
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
									<?php if ( !empty($settings['protine_contact_open_hour_heading']) ) : ?>    
										<p><?php echo protine_kses( $settings['protine_contact_open_hour_heading'] ); ?></p>
									<?php endif; ?>
									<?php if ( !empty($settings['protine_contact_open_hour']) ) : ?>
										<span><?php echo protine_kses( $settings['protine_contact_open_hour'] ); ?></span>
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

$widgets_manager->register( new Protine_Contact_Form() );