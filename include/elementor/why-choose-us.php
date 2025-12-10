<?php
namespace RaizenCore\Widgets;

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
use RaizenCore\Elementor\Controls\Group_Control_RaizenBGGradient;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Raizen Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Raizen_Why_Choose_Us extends Widget_Base {

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
		return __( 'Why Choose Us', 'raizencore' );
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
		return 'raizen-icon';
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
		return [ 'raizencore' ];
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
		return [ 'raizencore' ];
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
            'raizen_layout',
            [
                'label' => esc_html__('Design Layout', 'raizencore'),
            ]
        );
        $this->add_control(
            'raizen_design_style',
            [
                'label' => esc_html__('Select Layout', 'raizencore'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'layout-1' => esc_html__('Layout 1', 'raizencore'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();


        /**
         * Title & content section
         */

        $this->start_controls_section(
            'raizen_section_title',
            [
                'label' => esc_html__('Title & Content', 'raizencore'),
            ]
        );

        $this->add_control(
            'raizen_section_title_show',
            [
                'label' => esc_html__( 'Section Title & Content', 'raizencore' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'raizencore' ),
                'label_off' => esc_html__( 'Hide', 'raizencore' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        
        $this->add_control(
            'raizen_title',
            [
                'label' => esc_html__('Title', 'raizencore'),
                'description' => raizen_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Raizen Title Here', 'raizencore'),
                'placeholder' => esc_html__('Type Heading Text', 'raizencore'),
                'label_block' => true,
            ]
        );
        
        $this->add_control(
            'raizen_title_color',
            [
                'label' => __( 'Title Color', 'raizencore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .common-title h3' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'raizen_title_tag',
            [
                'label' => esc_html__('Title HTML Tag', 'raizencore'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'h1' => [
                        'title' => esc_html__('H1', 'raizencore'),
                        'icon' => 'eicon-editor-h1'
                    ],
                    'h2' => [
                        'title' => esc_html__('H2', 'raizencore'),
                        'icon' => 'eicon-editor-h2'
                    ],
                    'h3' => [
                        'title' => esc_html__('H3', 'raizencore'),
                        'icon' => 'eicon-editor-h3'
                    ],
                    'h4' => [
                        'title' => esc_html__('H4', 'raizencore'),
                        'icon' => 'eicon-editor-h4'
                    ],
                    'h5' => [
                        'title' => esc_html__('H5', 'raizencore'),
                        'icon' => 'eicon-editor-h5'
                    ],
                    'h6' => [
                        'title' => esc_html__('H6', 'raizencore'),
                        'icon' => 'eicon-editor-h6'
                    ]
                ],
                'default' => 'h2',
                'toggle' => false,
            ]
        );

        $this->add_responsive_control(
            'raizen_align',
            [
                'label' => esc_html__('Alignment', 'raizencore'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'text-left' => [
                        'title' => esc_html__('Left', 'raizencore'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'text-center' => [
                        'title' => esc_html__('Center', 'raizencore'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'text-right' => [
                        'title' => esc_html__('Right', 'raizencore'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'left',
                'toggle' => false,
            ]
        );


        $this->add_control(
            'raizen_count_value',
            [
                'label' => esc_html__('Count Value', 'raizencore'),
                'description' => raizen_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('12', 'raizencore'),
                'placeholder' => esc_html__('Type count value', 'raizencore'),
                'label_block' => true,
            ]
        );
        
        $this->add_control(
            'raizen_count_value_color',
            [
                'label' => __( 'Count Value Color', 'raizencore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .odometer-box h5' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'raizen_count_value_post_text',
            [
                'label' => esc_html__('Count Value Post Text', 'raizencore'),
                'description' => raizen_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('K+', 'raizencore'),
                'placeholder' => esc_html__('Type count value post text', 'raizencore'),
                'label_block' => true,
            ]
        );
        
        $this->add_control(
            'raizen_count_value_post_text_color',
            [
                'label' => __( 'Count Value Post Text Color', 'raizencore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .odometer-box .odometer-text' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'raizen_counter_text',
            [
                'label' => esc_html__('Counter Text', 'raizencore'),
                'description' => raizen_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Counter Text Here', 'raizencore'),
                'placeholder' => esc_html__('Type Counter Text', 'raizencore'),
                'label_block' => true,
            ]
        );
        
        $this->add_control(
            'raizen_counter_text_color',
            [
                'label' => __( 'Counter Text Color', 'raizencore' ),
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
            'raizen_btn_button_group',
            [
                'label' => esc_html__('Button', 'raizencore'),
            ]
        );

        $this->add_control(
            'raizen_button_show',
            [
                'label' => esc_html__( 'Show Button', 'raizencore' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'raizencore' ),
                'label_off' => esc_html__( 'Hide', 'raizencore' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'raizen_show_all_btn_text',
            [
                'label' => esc_html__('Show All Button Text', 'raizencore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Explore More', 'raizencore'),
                'title' => esc_html__('Enter show all button text here', 'raizencore'),
                'label_block' => true,
                'condition' => array(
                    'raizen_button_show' => 'yes',
                ),
            ]
        );

        $this->add_control(
            'raizen_show_all_btn_link',
            [
                'label' => esc_html__('Show All Button link', 'raizencore'),
                'type' => Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => esc_html__('https://your-link.com', 'raizencore'),
                'show_external' => false,
                'default' => [
                    'url' => '#',
                    'is_external' => true,
                    'nofollow' => true,
                    'custom_attributes' => '',
                ],
                'condition' => array(
                    'raizen_button_show' => 'yes',
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
            'raizen_features',
            [
                'label' => esc_html__('Features List', 'raizencore'),
                'description' => esc_html__( 'Control all the style settings from Style tab', 'raizencore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

    
        $repeater->add_control(
            'raizen_features_title', [
                'label' => esc_html__('Title', 'raizencore'),
                'description' => raizen_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Feature Title', 'raizencore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'raizen_features_title_color',
            [
                'label' => __( 'Title Color', 'raizencore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .choose-right-content h5' => 'color: {{VALUE}}',
                ],
            ]
        );

        $repeater->add_control(
            'raizen_features_text', [
                'label' => esc_html__('Features Description', 'raizencore'),
                'description' => raizen_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Ntypesetting industry Loreaim Ipsum has been in our the design compan industry compan standard dummy Lorem Ipsum', 'raizencore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'raizen_features_text_color',
            [
                'label' => __( 'Text Color', 'raizencore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .choose-right-content p' => 'color: {{VALUE}}',
                ],
            ]
        );
     
        $this->add_control(
            'raizen_features_list',
            [
                'label' => esc_html__('Features - List', 'raizencore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'raizen_features_title' => esc_html__('Organizational Design', 'raizencore'),
                    ],
                    [
                        'raizen_features_title' => esc_html__('Digital Transformation', 'raizencore')
                    ]
                ],
                'title_field' => '{{{ raizen_features_title }}}',
            ]
        );
        $this->end_controls_section();


        /**
         * Skill section
         */
        $this->start_controls_section(
            'raizen_progress_bar',
            [
                'label' => esc_html__('Skill Bar', 'raizencore'),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'name',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__( 'Name', 'raizencore' ),
                'default' => esc_html__( 'Design', 'raizencore' ),
                'placeholder' => esc_html__( 'Type a skill name', 'raizencore' ),
            ]
        );

        $repeater->add_control(
            'level',
            [
                'label' => esc_html__( 'Level (Out Of 100)', 'raizencore' ),
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
                'label' => esc_html__( 'Want To Customize?', 'raizencore' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'raizencore' ),
                'label_off' => esc_html__( 'No', 'raizencore' ),
                'return_value' => 'yes',
                'description' => esc_html__( 'You can customize this skill bar color from here or customize from Style tab', 'raizencore' ),
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'title_color',
            [
                'label' => esc_html__( 'Title Color', 'raizencore' ),
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
                'label' => esc_html__( 'Percentage label Color', 'raizencore' ),
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
            Group_Control_RaizenBGGradient::get_type(),
            [
                'name' => 'level_color',
                'label' => esc_html__('Level Color', 'raizencore'),
                'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} .progress-bar',
                'condition' => [
                    'want_customize' => 'yes',
                ],
            ]
        );

        $repeater->add_control(
            'base_color',
            [
                'label' => esc_html__( 'Base Color', 'raizencore' ),
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
            '_raizen_image',
            [
                'label' => esc_html__('Image', 'raizencore'),
            ]
        );

        $this->add_control(
            'raizen_image',
            [
                'label' => esc_html__( 'Image', 'raizencore' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'raizen_image_2',
            [
                'label' => esc_html__( 'Image 2', 'raizencore' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'raizen_image_3',
            [
                'label' => esc_html__( 'Image 3', 'raizencore' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
      
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'raizen_image_size',
                'default' => 'full',
                'exclude' => [
                    'custom'
                ]
            ]
        );

        $this->add_control(
            'raizen_image_overlap',
            [
                'label' => esc_html__('Image overlap to top?', 'raizencore'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'raizencore'),
                'label_off' => esc_html__('No', 'raizencore'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_responsive_control(
            'raizen_image_height',
            [
                'label' => esc_html__( 'Image Height', 'raizencore' ),
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
                    '{{WRAPPER}} .raizen-overlap img' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'raizen_image_overlap_x',
            [
                'label' => esc_html__( 'Image overlap position', 'raizencore' ),
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
                    '{{WRAPPER}} .raizen-overlap img' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
                'condition' => array(
                    'raizen_image_overlap' => 'yes',
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
				'label' => __( 'Style', 'raizencore' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'text_transform',
			[
				'label' => __( 'Text Transform', 'raizencore' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => __( 'None', 'raizencore' ),
					'uppercase' => __( 'UPPERCASE', 'raizencore' ),
					'lowercase' => __( 'lowercase', 'raizencore' ),
					'capitalize' => __( 'Capitalize', 'raizencore' ),
				],
				'selectors' => [
					'{{WRAPPER}} .title' => 'text-transform: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render the widget ouraizenut on the frontend.
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

            if ( !empty($settings['raizen_image']['url']) ) {
                $raizen_image = !empty($settings['raizen_image']['id']) ? wp_get_attachment_image_url( $settings['raizen_image']['id'], $settings['raizen_image_size_size']) : $settings['raizen_image']['url'];
                $raizen_image_alt = get_post_meta($settings["raizen_image"]["id"], "_wp_attachment_image_alt", true);
            }
            
            if ( !empty($settings['raizen_image_2']['url']) ) {
                $raizen_image_2 = !empty($settings['raizen_image_2']['id']) ? wp_get_attachment_image_url( $settings['raizen_image_2']['id'], $settings['raizen_image_size_size']) : $settings['raizen_image_2']['url'];
                $raizen_image_2_alt = get_post_meta($settings["raizen_image_2"]["id"], "_wp_attachment_image_alt", true);
            }     

            if ( !empty($settings['raizen_image_3']['url']) ) {
                $raizen_image_3 = !empty($settings['raizen_image_3']['id']) ? wp_get_attachment_image_url( $settings['raizen_image_3']['id'], $settings['raizen_image_size_size']) : $settings['raizen_image_3']['url'];
                $raizen_image_3_alt = get_post_meta($settings["raizen_image_3"]["id"], "_wp_attachment_image_alt", true);
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
                                if ( !empty($settings['raizen_title' ]) ) :
                                    printf( '<%1$s %2$s>%3$s</%1$s>',
                                        tag_escape( $settings['raizen_title_tag'] ),
                                        $this->get_render_attribute_string( 'title_args' ),
                                        raizen_kses( $settings['raizen_title' ] )
                                        );
                                endif;
                            ?>
                        </div>
                        <div class="choose-left-container">
                            <div class="choose-image-1">
                                <img src="<?php echo esc_url($raizen_image); ?>" alt="<?php echo esc_url($raizen_image_alt); ?>">
                            </div>
                            <div class="choose-image-2 mt_50">
                                <img src="<?php echo esc_url($raizen_image_2); ?>" alt="<?php echo esc_url($raizen_image_2_alt); ?>">
                            </div>
                            <div class="choose-image-3">
                                <img src="<?php echo esc_url($raizen_image_3); ?>" alt="<?php echo esc_url($raizen_image_3_alt); ?>">
                                <div class="choose-counter">
                                    <div class="odometer-box">
                                        <h5 class="odometer" data-count="<?php echo raizen_kses( $settings['raizen_count_value'] ); ?>">00</h5>
                                        <div class="odometer-text"><?php echo raizen_kses( $settings['raizen_count_value_post_text'] ); ?></div>
                                    </div>
                                    <?php if ( !empty($settings['raizen_counter_text']) ) : ?>    
                                        <p><?php echo raizen_kses( $settings['raizen_counter_text'] ); ?></p>
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
                                    <?php if ( ! empty( $settings['raizen_show_all_btn_link']['url'] ) ) : ?>
                                        <a href="<?php echo esc_url($settings['raizen_show_all_btn_link']['url'] ); ?>" class="round-btn"><p><?php echo raizen_kses( $settings['raizen_show_all_btn_text'] ); ?></p> <i class="icon-arrow-1"></i> <span></span></a>
                                    <?php endif; ?>
                                </div>
                            </div>
                            
                            <?php foreach ($settings['raizen_features_list'] as $key => $item) : ?>
                                <div class="choose-right-content">
                                    <h5><?php echo raizen_kses($item['raizen_features_title' ]); ?></h5>
                                    <p><?php echo raizen_kses($item['raizen_features_text' ]); ?></p>
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

$widgets_manager->register( new Raizen_Why_Choose_Us() );