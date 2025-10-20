<?php
namespace BwallCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Bwall Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Bwall_Contact_Form extends Widget_Base {

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
		return __( 'Contact Form', 'bwallcore' );
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


    public function get_bwall_contact_form(){
        if ( ! class_exists( 'WPCF7' ) ) {
            return;
        }
        $bwall_cfa         = array();
        $bwall_cf_args     = array( 'posts_per_page' => -1, 'post_type'=> 'wpcf7_contact_form' );
        $bwall_forms       = get_posts( $bwall_cf_args );
        $bwall_cfa         = ['0' => esc_html__( 'Select Form', 'bwallcore' ) ];
        if( $bwall_forms ){
            foreach ( $bwall_forms as $bwall_form ){
                $bwall_cfa[$bwall_form->ID] = $bwall_form->post_title;
            }
        }else{
            $bwall_cfa[ esc_html__( 'No contact form found', 'bwallcore' ) ] = 0;
        }
        return $bwall_cfa;
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
                    'layout-1' => esc_html__('Layout 1 - Contact Page', 'bwallcore'),
                ],
                'default' => 'layout-1',
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
                'label' => esc_html__( 'Section Image', 'bwallcore' ),
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
		 * Form
		 */

        $this->start_controls_section(
            'bwallcore_contact',
            [
                'label' => esc_html__('Contact Form', 'bwallcore'),
            ]
		);

        $this->add_control(
            'bwallcore_select_contact_form',
            [
                'label'   => esc_html__( 'Select Form', 'bwallcore' ),
                'type'    => Controls_Manager::SELECT,
                'default' => '0',
                'options' => $this->get_bwall_contact_form(),
            ]
        );

		$this->end_controls_section();


		/**
		 * Title and information
		 */
		$this->start_controls_section(
			'_information',
			[
				'label' => esc_html__( 'Title & Information', 'bwallcore' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
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
				'default' => esc_html__('Bwall Title Here', 'bwallcore'),
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
                    '{{WRAPPER}} .contact-page-container h5' => 'color: {{VALUE}}',
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
					'left' => [
						'title' => esc_html__('Left', 'bwallcore'),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__('Center', 'bwallcore'),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__('Right', 'bwallcore'),
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
            'bwall_single_icon_type_email',
            [
                'label' => esc_html__('Select Icon Type for Email', 'bwallcore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'image',
                'options' => [
                    'image' => esc_html__('Image', 'bwallcore'),
                    'icon' => esc_html__('Icon', 'bwallcore'),
				],
            ]
        );

        $this->add_control(
            'bwall_icon_image_email',
            [
                'label' => esc_html__('Upload Icon Image for Email', 'bwallcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
					'bwall_single_icon_type_email' => 'image',
                ]

            ]
        );

        if (bwall_is_elementor_version('<', '2.6.0')) {
            $this->add_control(
                'icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'fa fa-star',
                    'condition' => [
                        'bwall_single_icon_type_email' => 'icon'
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
                        'bwall_single_icon_type_email' => 'icon'
                    ]
                ]
            );
        }
        
		$this->add_control(
			'bwall_contact_email_heading',
			[
				'label' => esc_html__('Email Heading', 'bwallcore'),
				'description' => bwall_get_allowed_html_desc( 'intermediate' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Email', 'bwallcore'),
				'placeholder' => esc_html__('Type email heading', 'bwallcore'),
				'label_block' => true,
			]
		);

		$this->add_control(
            'bwall_contact_email_heading_color',
            [
                'label' => __( 'Email Heading Color', 'bwallcore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .contact-page-info-content p' => 'color: {{VALUE}}',
				],
            ]
		);
		
		$this->add_control(
			'bwall_contact_email',
			[
				'label' => esc_html__('Send Email', 'bwallcore'),
				'description' => bwall_get_allowed_html_desc( 'intermediate' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('example@gmail.com', 'bwallcore'),
				'placeholder' => esc_html__('Type your email', 'bwallcore'),
				'label_block' => true,
			]
		);

		$this->add_control(
            'bwall_contact_email_color',
            [
                'label' => __( 'Email Color', 'bwallcore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .contact-page-info-content a' => 'color: {{VALUE}}',
				],
            ]
		);
		
        // phone
		$this->add_control(
            'bwall_single_icon_type_phone',
            [
                'label' => esc_html__('Select Icon Type for Phone', 'bwallcore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'image',
                'options' => [
                    'image' => esc_html__('Image', 'bwallcore'),
                    'icon' => esc_html__('Icon', 'bwallcore'),
				],
            ]
        );

        $this->add_control(
            'bwall_icon_image_phone',
            [
                'label' => esc_html__('Upload Icon Image for Phone', 'bwallcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
					'bwall_single_icon_type_phone' => 'image',
                ]

            ]
        );

        if (bwall_is_elementor_version('<', '2.6.0')) {
            $this->add_control(
                'icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'fa fa-star',
                    'condition' => [
                        'bwall_single_icon_type_phone' => 'icon'
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
                        'bwall_single_icon_type_phone' => 'icon'
                    ]
                ]
            );
        }
		$this->add_control(
			'bwall_contact_phone_heading',
			[
				'label' => esc_html__('Phone Number Heading', 'bwallcore'),
				'description' => bwall_get_allowed_html_desc( 'intermediate' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Call Us Now', 'bwallcore'),
				'placeholder' => esc_html__('Type phone number heading', 'bwallcore'),
				'label_block' => true,
			]
		);

		$this->add_control(
            'bwall_contact_phone_heading_color',
            [
                'label' => __( 'Phone Number Heading Color', 'bwallcore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .contact-page-info-content p' => 'color: {{VALUE}}',
				],
            ]
		);
		
		$this->add_control(
			'bwall_contact_phone_number',
			[
				'label' => esc_html__('Phone Number', 'bwallcore'),
				'description' => bwall_get_allowed_html_desc( 'intermediate' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('+880 123 (4567) 890', 'bwallcore'),
				'placeholder' => esc_html__('Type your phone number', 'bwallcore'),
				'label_block' => true,
			]
		);

		$this->add_control(
            'bwall_contact_phone_number_color',
            [
                'label' => __( 'Phone Number Color', 'bwallcore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .contact-page-info-content a' => 'color: {{VALUE}}',
				],
            ]
		);

		// location
		$this->add_control(
			'bwall_single_icon_type_location',
			[
				'label' => esc_html__('Select Icon Type for Location', 'bwallcore'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'image',
				'options' => [
					'image' => esc_html__('Image', 'bwallcore'),
					'icon' => esc_html__('Icon', 'bwallcore'),
				],
			]
		);

		$this->add_control(
			'bwall_icon_image_location',
			[
				'label' => esc_html__('Upload Icon Image for Location', 'bwallcore'),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'bwall_single_icon_type_location' => 'image',
				]

			]
		);

		if (bwall_is_elementor_version('<', '2.6.0')) {
			$this->add_control(
				'icon',
				[
					'show_label' => false,
					'type' => Controls_Manager::ICON,
					'label_block' => true,
					'default' => 'fa fa-star',
					'condition' => [
						'bwall_single_icon_type_location' => 'icon'
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
						'bwall_single_icon_type_location' => 'icon'
					]
				]
			);
		}

		$this->add_control(
			'bwall_contact_location_heading',
			[
				'label' => esc_html__('Location Heading', 'bwallcore'),
				'description' => bwall_get_allowed_html_desc( 'intermediate' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Location', 'bwallcore'),
				'placeholder' => esc_html__('Type location heading', 'bwallcore'),
				'label_block' => true,
			]
		);

		$this->add_control(
			'bwall_contact_location_heading_color',
			[
				'label' => __( 'Location Heading Color', 'bwallcore' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .contact-page-info-content p' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'bwall_contact_location',
			[
				'label' => esc_html__('Location', 'bwallcore'),
				'description' => bwall_get_allowed_html_desc( 'intermediate' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('122/B New market, USA', 'bwallcore'),
				'placeholder' => esc_html__('Type your location', 'bwallcore'),
				'label_block' => true,
			]
		);

		$this->add_control(
			'bwall_contact_location_color',
			[
				'label' => __( 'Location Color', 'bwallcore' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .contact-page-info-content span' => 'color: {{VALUE}}',
				],
			]
		);

		// open hour
		$this->add_control(
			'bwall_single_icon_type_open_hour',
			[
				'label' => esc_html__('Select Icon Type for Open Hour', 'bwallcore'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'image',
				'options' => [
					'image' => esc_html__('Image', 'bwallcore'),
					'icon' => esc_html__('Icon', 'bwallcore'),
				],
			]
		);

		$this->add_control(
			'bwall_icon_image_open_hour',
			[
				'label' => esc_html__('Upload Icon Image for Open Hour', 'bwallcore'),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'bwall_single_icon_type_open_hour' => 'image',
				]

			]
		);

		if (bwall_is_elementor_version('<', '2.6.0')) {
			$this->add_control(
				'icon',
				[
					'show_label' => false,
					'type' => Controls_Manager::ICON,
					'label_block' => true,
					'default' => 'fa fa-star',
					'condition' => [
						'bwall_single_icon_type_open_hour' => 'icon'
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
						'bwall_single_icon_type_open_hour' => 'icon'
					]
				]
			);
		}

		$this->add_control(
			'bwall_contact_open_hour_heading',
			[
				'label' => esc_html__('Open Hour Heading', 'bwallcore'),
				'description' => bwall_get_allowed_html_desc( 'intermediate' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Open Time', 'bwallcore'),
				'placeholder' => esc_html__('Type open hour heading', 'bwallcore'),
				'label_block' => true,
			]
		);

		$this->add_control(
			'bwall_contact_open_hour_heading_color',
			[
				'label' => __( 'Open Hour Heading Color', 'bwallcore' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .contact-page-info-content p' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'bwall_contact_open_hour',
			[
				'label' => esc_html__('Open Hour', 'bwallcore'),
				'description' => bwall_get_allowed_html_desc( 'intermediate' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Mon - Sat (10.00AM - 4.00PM)', 'bwallcore'),
				'placeholder' => esc_html__('Type your open hour', 'bwallcore'),
				'label_block' => true,
			]
		);

		$this->add_control(
			'bwall_contact_open_hour_color',
			[
				'label' => __( 'Open Hour Color', 'bwallcore' ),
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
		?>

			<!-- contact page -->
			<section class="contact-page">
				<div class="container">
					<div class="row">
						<div class="col-lg-7">
							<div class="contact-page-image">
								<?php if ($settings['bwall_image']['url'] || $settings['bwall_image']['id']) : ?>
									<img src="<?php echo esc_url($bwall_image); ?>" alt="<?php echo esc_attr($bwall_image_alt); ?>">
								<?php endif; ?>
							</div>
						</div>
						<div class="col-lg-5">
							<div class="contact-page-container">
								<?php
									if ( !empty($settings['bwall_title' ]) ) :
										printf( '<%1$s %2$s>%3$s</%1$s>',
											tag_escape( $settings['bwall_title_tag'] ),
											$this->get_render_attribute_string( 'title' ),
											bwall_kses( $settings['bwall_title' ] )
											);
									endif;
								?>
								<?php if( !empty($settings['bwallcore_select_contact_form']) ) : ?> 
									<div class="contact-page-form"> 
										<?php echo do_shortcode( '[contact-form-7  id="'.$settings['bwallcore_select_contact_form'].'"]' ); ?>
									</div>
								<?php else : ?>
									<?php echo '<div class="alert alert-warning"><p class="m-0">' . __('Please Select contact form.', 'bwallcore' ). '</p></div>'; ?>
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
									<?php if ( !empty($settings['bwall_contact_email_heading']) ) : ?>    
										<p><?php echo bwall_kses( $settings['bwall_contact_email_heading'] ); ?></p>
									<?php endif; ?>
									<?php if ( !empty($settings['bwall_contact_email']) ) : ?>
										<a href="mailto:<?php echo bwall_kses( $settings['bwall_contact_email'] ); ?>"><?php echo bwall_kses( $settings['bwall_contact_email'] ); ?></a>
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
									<?php if ( !empty($settings['bwall_contact_phone_heading']) ) : ?>    
										<p><?php echo bwall_kses( $settings['bwall_contact_phone_heading'] ); ?></p>
									<?php endif; ?>
									<?php if ( !empty($settings['bwall_contact_phone_number']) ) : ?>
										<a href="tel:<?php echo esc_attr(str_replace(' ', '-', $settings['bwall_contact_phone_number'])); ?>"><?php echo bwall_kses( $settings['bwall_contact_phone_number'] ); ?></a>
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
									<?php if ( !empty($settings['bwall_contact_location_heading']) ) : ?>    
										<p><?php echo bwall_kses( $settings['bwall_contact_location_heading'] ); ?></p>
									<?php endif; ?>
									<?php if ( !empty($settings['bwall_contact_location']) ) : ?>
										<span><?php echo bwall_kses( $settings['bwall_contact_location'] ); ?></span>
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
									<?php if ( !empty($settings['bwall_contact_open_hour_heading']) ) : ?>    
										<p><?php echo bwall_kses( $settings['bwall_contact_open_hour_heading'] ); ?></p>
									<?php endif; ?>
									<?php if ( !empty($settings['bwall_contact_open_hour']) ) : ?>
										<span><?php echo bwall_kses( $settings['bwall_contact_open_hour'] ); ?></span>
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

$widgets_manager->register( new Bwall_Contact_Form() );