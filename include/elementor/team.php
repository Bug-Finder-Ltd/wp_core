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
class Bwall_Team extends Widget_Base {

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
		return 'team';
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
		return __( 'Team', 'bwallcore' );
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
         * Layout Section
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
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();


         /**
         * Title & Content
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
                    '{{WRAPPER}} .common-title h3' => 'color: {{VALUE}}',
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

        // Show all button
        $this->start_controls_section(
            'bwall_btn_button_group',
            [
                'label' => esc_html__('Button', 'bwallcore'),
            ]
        );

        $this->add_control(
            'bwall_button_show',
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
            'bwall_show_all_btn_text',
            [
                'label' => esc_html__('Show All Button Text', 'bwallcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Explore More', 'bwallcore'),
                'title' => esc_html__('Enter show all button text here', 'bwallcore'),
                'label_block' => true,
                'condition' => array(
                    'bwall_button_show' => 'yes',
                ),
            ]
        );

        $this->add_control(
            'bwall_show_all_btn_link',
            [
                'label' => esc_html__('Show All Button link', 'bwallcore'),
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
                'condition' => array(
                    'bwall_button_show' => 'yes',
                ),
                'label_block' => true,
            ]
        );

        $this->end_controls_section();

        /**
         * Members
         */
        $this->start_controls_section(
            '_section_teams',
            [
                'label' => __( 'Members', 'bwallcore' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->start_controls_tabs(
            '_tab_style_member_box_itemr'
        );

        $repeater->start_controls_tab(
            '_tab_member_info',
            [
                'label' => __( 'Information', 'bwallcore' ),
            ]
        );

        $repeater->add_control(
            'image',
            [
                'type' => Controls_Manager::MEDIA,
                'label' => __( 'Image', 'bwallcore' ),
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        ); 
        
        $repeater->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'bwall_image_size',
                'default' => 'full',
                'exclude' => [
                    'custom'
                ]
            ]
        );

        $repeater->add_control(
            'title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'label' => __( 'Name', 'bwallcore' ),
                'default' => __( 'Member Name', 'bwallcore' ),
                'placeholder' => __( 'Type name here', 'bwallcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'title_color',
            [
                'label' => __( 'Name Color', 'bwallcore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team-member-info h3' => 'color: {{VALUE}}',
                ],
            ]
        );

        $repeater->add_control(
            'designation',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'label' => __( 'Job Title', 'bwallcore' ),
                'default' => __( 'Bwall Officer', 'bwallcore' ),
                'placeholder' => __( 'Type designation here', 'bwallcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'bwall_title_color',
            [
                'label' => __( 'Job Title Color', 'bwallcore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .te-team-card .dec' => 'color: {{VALUE}}',
                ],
            ]
        );

        $repeater->add_control(
            'item_url',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'label' => __( 'URL', 'bwallcore' ),
                'placeholder' => __( 'Type link here', 'bwallcore' ),
                'default' => __( '#', 'bwallcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->end_controls_tab();

        $repeater->start_controls_tab(
            '_tab_member_links',
            [
                'label' => __( 'Links', 'bwallcore' ),
            ]
        );

        $repeater->add_control(
            'show_social',
            [
                'label' => __( 'Show Options?', 'bwallcore' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'bwallcore' ),
                'label_off' => __( 'No', 'bwallcore' ),
                'return_value' => 'yes',
                'style_transfer' => true,
            ]
        );
    

        $repeater->add_control(
            'facebook_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Facebook', 'bwallcore' ),
                'default' => __( 'https://facebook.com', 'bwallcore' ),
                'placeholder' => __( 'Add your facebook link', 'bwallcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );
        
        $repeater->add_control(
            'skype_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Skype', 'bwallcore' ),
                'default' => __( 'https://skype.com', 'bwallcore' ),
                'placeholder' => __( 'Add your skype link', 'bwallcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'linkedin_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Linkedin', 'bwallcore' ),
                'default' => __( 'https://linkedin.com', 'bwallcore' ),
                'placeholder' => __( 'Add your linkedin link', 'bwallcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'instagram_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Instagram', 'bwallcore' ),
                'default' => __( 'https://instagram.com', 'bwallcore' ),
                'placeholder' => __( 'Add your instagram link', 'bwallcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );       

        $repeater->end_controls_tab();
        $repeater->end_controls_tabs();

        // Repeater
        $this->add_control(
            'teams',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '<# print(title || "Carousel Item"); #>',
                'default' => [
                    [
                        'image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ]
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

            <!-- team -->
            <section class="team">
                <div class="container">
                    <div class="common-title-container">
                        <div class="choose-right-round-btn">
                            <?php 
                            if ( ! empty( $settings['bwall_show_all_btn_link']['url'] ) ) : ?>
                                <a href="<?php echo esc_url($settings['bwall_show_all_btn_link']['url'] ); ?>" class="round-btn">
                                    <p><?php echo bwall_kses( $settings['bwall_show_all_btn_text'] ); ?></p> <i class="icon-arrow-1"></i> <span></span>
                                </a>
                            <?php endif; ?>
                        </div>
                        <div class="common-title">
                            <img src="<?php echo get_template_directory_uri() . '/assets/img/shape/line-left.png';?>" alt="shape">
                            <?php if ( !empty($settings['bwall_title' ]) ) :
                                printf( '<%1$s %2$s>%3$s</%1$s>',
                                    tag_escape( $settings['bwall_title_tag'] ),
                                    $this->get_render_attribute_string( 'title_args' ),
                                    bwall_kses( $settings['bwall_title' ] )
                                );
                            endif; ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="team-left-container">
                                <div class="row">
                                    <?php foreach ( $settings['teams'] as $key => $item ) :
                                        $title = bwall_kses( $item['title' ] );
                                        $item_url = esc_url($item['item_url']);

                                        if ( !empty($item['image']['url']) ) {
                                            $bwall_team_image_url = !empty($item['image']['id']) ? wp_get_attachment_image_url( $item['image']['id'], $settings['bwall_image_size_size']) : $item['image']['url'];
                                            $bwall_team_image_alt = get_post_meta($item["image"]["id"], "_wp_attachment_image_alt", true);
                                        }            
                                        ?>
                                            <div class="col-lg-6">
                                                <div class="team-member team-member-<?php echo $key+1;?> team-hover-<?php echo $key+1;?>">
                                                    <div class="member-image">
                                                        <?php if( !empty($bwall_team_image_url) ) : ?>
                                                            <img src="<?php echo esc_url($bwall_team_image_url); ?>" alt="<?php echo esc_attr($bwall_team_image_alt); ?>">
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="member-image-overlay"></div>
                                                </div>
                                            </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="team-right-container">
                                <?php foreach ( $settings['teams'] as $key => $item ) : ?>
                                    <div class="team-member-details team-member-details-<?php echo $key+1;?> team-hover-<?php echo $key+1;?>">
                                        <div class="team-member-info">
                                            <?php if( !empty($item['designation']) ) : ?>
                                                <h6><?php echo bwall_kses( $item['designation'] ); ?></h6>
                                            <?php endif; ?>
                                            <?php if( !empty($item['title']) ) : ?>
                                                <h3><?php echo bwall_kses( $item['title' ] );?></h3>
                                            <?php endif; ?>
                                        </div>
                                        <div class="team-member-media">
                                            <div class="media-content">
                                                <?php if( !empty($item['show_social'] ) ) : ?>
                                                    <ul>
                                                        <?php if( !empty($item['facebook_title'] ) ) : ?>
                                                            <li><a href="<?php echo esc_url( $item['facebook_title'] ); ?>"><i class="fa-brands fa-facebook-f"></i></a></li>
                                                        <?php endif; ?>
                                                        <?php if( !empty($item['skype_title'] ) ) : ?>
                                                            <li><a href="<?php echo esc_url( $item['skype_title'] ); ?>"><i class="fa-brands fa-skype"></i></a></li>
                                                        <?php endif; ?>
                                                        <?php if( !empty($item['linkedin_title'] ) ) : ?>
                                                            <li><a href="<?php echo esc_url( $item['linkedin_title'] ); ?>"><i class="fa-brands fa-linkedin-in"></i></a></li>
                                                        <?php endif; ?>
                                                        <?php if( !empty($item['instagram_title'] ) ) : ?>
                                                            <li><a href="<?php echo esc_url( $item['instagram_title'] ); ?>"><i class="fa-brands fa-instagram"></i></a></li>
                                                        <?php endif; ?>
                                                    </ul>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- team -->

        <?php
	}
}

$widgets_manager->register( new Bwall_Team() );