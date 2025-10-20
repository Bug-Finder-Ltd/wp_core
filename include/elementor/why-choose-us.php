<?php
namespace BwallCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Control_Media;



use \Elementor\Group_Control_Css_Filter;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Typography;
Use \Elementor\Core\Schemes\Typography;
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
class Bwall_Why_Choose_Us extends Widget_Base {

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
		return 'about';
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
		return __( 'Why Choose Us', 'bwallcore' );
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
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();


        /**
         * Title & content section
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
            'bwall_count_value',
            [
                'label' => esc_html__('Count Value', 'bwallcore'),
                'description' => bwall_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('12', 'bwallcore'),
                'placeholder' => esc_html__('Type count value', 'bwallcore'),
                'label_block' => true,
            ]
        );
        
        $this->add_control(
            'bwall_count_value_color',
            [
                'label' => __( 'Count Value Color', 'bwallcore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .odometer-box h5' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'bwall_count_value_post_text',
            [
                'label' => esc_html__('Count Value Post Text', 'bwallcore'),
                'description' => bwall_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('K+', 'bwallcore'),
                'placeholder' => esc_html__('Type count value post text', 'bwallcore'),
                'label_block' => true,
            ]
        );
        
        $this->add_control(
            'bwall_count_value_post_text_color',
            [
                'label' => __( 'Count Value Post Text Color', 'bwallcore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .odometer-box .odometer-text' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'bwall_counter_text',
            [
                'label' => esc_html__('Counter Text', 'bwallcore'),
                'description' => bwall_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Counter Text Here', 'bwallcore'),
                'placeholder' => esc_html__('Type Counter Text', 'bwallcore'),
                'label_block' => true,
            ]
        );
        
        $this->add_control(
            'bwall_counter_text_color',
            [
                'label' => __( 'Counter Text Color', 'bwallcore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .odometer-box p' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();

        
        /**
         * Show all button section
         */
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
         * Features section
         */

        $layout_array_1_2 = ["layout-1", "layout-2"];
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
                    '{{WRAPPER}} .choose-right-content h5' => 'color: {{VALUE}}',
                ],
            ]
        );

        $repeater->add_control(
            'bwall_features_text', [
                'label' => esc_html__('Features Description', 'bwallcore'),
                'description' => bwall_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Ntypesetting industry Loreaim Ipsum has been in our the design compan industry compan standard dummy Lorem Ipsum', 'bwallcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'bwall_features_text_color',
            [
                'label' => __( 'Text Color', 'bwallcore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .choose-right-content p' => 'color: {{VALUE}}',
                ],
            ]
        );
     
        $this->add_control(
            'bwall_features_list',
            [
                'label' => esc_html__('Features - List', 'bwallcore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'bwall_features_title' => esc_html__('Organizational Design', 'bwallcore'),
                    ],
                    [
                        'bwall_features_title' => esc_html__('Digital Transformation', 'bwallcore')
                    ]
                ],
                'title_field' => '{{{ bwall_features_title }}}',
            ]
        );
        $this->end_controls_section();


        /**
         * Skill section
         */
        $this->start_controls_section(
            'bwall_progress_bar',
            [
                'label' => esc_html__('Skill Bar', 'bwallcore'),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'name',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__( 'Name', 'bwallcore' ),
                'default' => esc_html__( 'Design', 'bwallcore' ),
                'placeholder' => esc_html__( 'Type a skill name', 'bwallcore' ),
            ]
        );

        $repeater->add_control(
            'level',
            [
                'label' => esc_html__( 'Level (Out Of 100)', 'bwallcore' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'unit' => '%',
                    'size' => 95
                ],
                'size_units' => ['%'],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );
        $repeater->add_control(
            'want_customize',
            [
                'label' => esc_html__( 'Want To Customize?', 'bwallcore' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'bwallcore' ),
                'label_off' => esc_html__( 'No', 'bwallcore' ),
                'return_value' => 'yes',
                'description' => esc_html__( 'You can customize this skill bar color from here or customize from Style tab', 'bwallcore' ),
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'title_color',
            [
                'label' => esc_html__( 'Title Color', 'bwallcore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .title' => 'color: {{VALUE}};',
                ],
                'condition' => ['want_customize' => 'yes'],
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'percentage_color',
            [
                'label' => esc_html__( 'Percentage label Color', 'bwallcore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .percentage' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'want_customize' => 'yes',
                ],
                'style_transfer' => true,
            ]
        );


        $repeater->add_group_control(
            Group_Control_BwallBGGradient::get_type(),
            [
                'name' => 'level_color',
                'label' => esc_html__('Level Color', 'bwallcore'),
                'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} .progress-bar',
                'condition' => [
                    'want_customize' => 'yes',
                ],
            ]
        );

        $repeater->add_control(
            'base_color',
            [
                'label' => esc_html__( 'Base Color', 'bwallcore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .progress' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'want_customize' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'skills',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '<# print((name || level.size) ? (name || "Skill") + " - " + level.size + level.unit : "Skill - 0%") #>',
                'default' => [
                    [
                        'name' => 'The Walt Disney Company',
                        'level' => ['size' => 45, 'unit' => '%']
                    ],
                    [
                        'name' => 'Louis Vuitton',
                        'level' => ['size' => 80, 'unit' => '%']
                    ],
                ]
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
                'label' => esc_html__( 'Image', 'bwallcore' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'bwall_image_2',
            [
                'label' => esc_html__( 'Image 2', 'bwallcore' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'bwall_image_3',
            [
                'label' => esc_html__( 'Image 3', 'bwallcore' ),
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
    
		<?php 

            if ( !empty($settings['bwall_image']['url']) ) {
                $bwall_image = !empty($settings['bwall_image']['id']) ? wp_get_attachment_image_url( $settings['bwall_image']['id'], $settings['bwall_image_size_size']) : $settings['bwall_image']['url'];
                $bwall_image_alt = get_post_meta($settings["bwall_image"]["id"], "_wp_attachment_image_alt", true);
            }
            
            if ( !empty($settings['bwall_image_2']['url']) ) {
                $bwall_image_2 = !empty($settings['bwall_image_2']['id']) ? wp_get_attachment_image_url( $settings['bwall_image_2']['id'], $settings['bwall_image_size_size']) : $settings['bwall_image_2']['url'];
                $bwall_image_2_alt = get_post_meta($settings["bwall_image_2"]["id"], "_wp_attachment_image_alt", true);
            }     

            if ( !empty($settings['bwall_image_3']['url']) ) {
                $bwall_image_3 = !empty($settings['bwall_image_3']['id']) ? wp_get_attachment_image_url( $settings['bwall_image_3']['id'], $settings['bwall_image_size_size']) : $settings['bwall_image_3']['url'];
                $bwall_image_3_alt = get_post_meta($settings["bwall_image_3"]["id"], "_wp_attachment_image_alt", true);
            }     
        ?>	

        <!-- why choose us -->
        <section class="choose">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="common-title">
                            <img src="<?php echo get_template_directory_uri() . '/assets/img/shape/line-left.png';?>" alt="shape">
                            <?php
                                if ( !empty($settings['bwall_title' ]) ) :
                                    printf( '<%1$s %2$s>%3$s</%1$s>',
                                        tag_escape( $settings['bwall_title_tag'] ),
                                        $this->get_render_attribute_string( 'title_args' ),
                                        bwall_kses( $settings['bwall_title' ] )
                                        );
                                endif;
                            ?>
                        </div>
                        <div class="choose-left-container">
                            <div class="choose-image-1">
                                <img src="<?php echo esc_url($bwall_image); ?>" alt="<?php echo esc_url($bwall_image_alt); ?>">
                            </div>
                            <div class="choose-image-2 mt_50">
                                <img src="<?php echo esc_url($bwall_image_2); ?>" alt="<?php echo esc_url($bwall_image_2_alt); ?>">
                            </div>
                            <div class="choose-image-3">
                                <img src="<?php echo esc_url($bwall_image_3); ?>" alt="<?php echo esc_url($bwall_image_3_alt); ?>">
                                <div class="choose-counter">
                                    <div class="odometer-box">
                                        <h5 class="odometer" data-count="<?php echo bwall_kses( $settings['bwall_count_value'] ); ?>">00</h5>
                                        <div class="odometer-text"><?php echo bwall_kses( $settings['bwall_count_value_post_text'] ); ?></div>
                                    </div>
                                    <?php if ( !empty($settings['bwall_counter_text']) ) : ?>    
                                        <p><?php echo bwall_kses( $settings['bwall_counter_text'] ); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="choose-right-container">
                            <div class="choose-right-btn-box">
                                <div class="choose-right-icon">
                                    <img src="<?php echo get_template_directory_uri() . '/assets/img/icons/star-icon-3.png';?>" alt="icon">
                                </div>
                                <div class="choose-right-round-btn">
                                    <?php if ( ! empty( $settings['bwall_show_all_btn_link']['url'] ) ) : ?>
                                        <a href="<?php echo esc_url($settings['bwall_show_all_btn_link']['url'] ); ?>" class="round-btn"><p><?php echo bwall_kses( $settings['bwall_show_all_btn_text'] ); ?></p> <i class="icon-arrow-1"></i> <span></span></a>
                                    <?php endif; ?>
                                </div>
                            </div>
                            
                            <?php foreach ($settings['bwall_features_list'] as $key => $item) : ?>
                                <div class="choose-right-content">
                                    <h5><?php echo bwall_kses($item['bwall_features_title' ]); ?></h5>
                                    <p><?php echo bwall_kses($item['bwall_features_text' ]); ?></p>
                                </div>
                            <?php endforeach; ?>
                            
                            <?php foreach ( $settings['skills'] as $index => $skill ) : ?>
                                <div class="skills-section">
                                    <h6><?php echo esc_html( $skill['name'] ); ?></h6>
                                    <div class="progress">
                                        <div class="progress-bar" data-progress="<?php echo esc_attr( $skill['level']['size'] ); ?>"></div>
                                        <span><?php echo esc_attr( $skill['level']['size'] ); ?>%</span>
                                    </div>
                                </div>
                            <?php endforeach; ?>   
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- why choose us -->

        <?php 
	}
}

$widgets_manager->register( new Bwall_Why_Choose_Us() );