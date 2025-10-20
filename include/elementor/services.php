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
class Bwall_Services extends Widget_Base {

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
        return 'services';
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
        return __( 'Services', 'bwallcore' );
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
                    'layout-2' => esc_html__('Layout 2', 'bwallcore'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        $layout_array = ["layout-1", "layout-2"];

        /**
         * Title and content section
         */
        $this->start_controls_section(
            'bwall_section_title',
            [
                'label' => esc_html__('Title & Content', 'bwallcore'),
                'condition' => [
                    'bwall_design_style' => $layout_array,
                ],
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
                'condition' => [
                    'bwall_design_style' => $layout_array,
                ],
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
                'condition' => [
                    'bwall_design_style' => $layout_array,
                ],
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
                'condition' => [
                    'bwall_design_style' => $layout_array,
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
                'condition' => [
                    'bwall_design_style' => $layout_array,
                ],
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
                ],
                'condition' => [
                    'bwall_design_style' => $layout_array,
                ],
            ]
        );

        $this->add_control(
            'bwall_description',
            [
                'label' => esc_html__('Description', 'bwallcore'),
                'description' => bwall_get_allowed_html_desc( 'basic' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Dynamically deliver multidisciplinary infrastructures via revolution process improvements. Competently orchestrate turnkey ideas his manufactured products deliverables premium after just in time scenarios.', 'bwallcore'),
                'placeholder' => esc_html__('Type description text', 'bwallcore'),
                'label_block' => true,
                'condition' => [
                    'bwall_design_style' => $layout_array,
                ],
            ]
        );

        $this->add_control(
            'text_inside_circle',
            [
                'label' => esc_html__('Text Inside Circle', 'bwallcore'),
                'description' => bwall_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('BEST WALLPAPERS FOR YOUR INTERIOR • ', 'bwallcore'),
                'placeholder' => esc_html__('Type text for inside circle', 'bwallcore'),
                'label_block' => true,
                'condition' => [
                    'bwall_design_style' => 'layout-1',
                ],
            ]
        );

        $this->add_control(
            'text_inside_circle_color',
            [
                'label' => __( 'Title Color', 'bwallcore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .round-box-content span' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'bwall_design_style' => 'layout-1',
                ],
            ]
        );

        $this->end_controls_section();


        /**
         * Show all button
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
                'default' => esc_html__('View all Service', 'bwallcore'),
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
         * Image section
         */
		$this->start_controls_section(
            '_bwall_image',
            [
                'label' => esc_html__('Image', 'bwallcore'),
                'condition' => array(
                    'bwall_design_style' => 'layout-1',
                ),
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
                'condition' => array(
                    'bwall_design_style' => 'layout-1',
                ),
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'bwall_image_size',
                'default' => 'full',
                'exclude' => [
                    'custom'
                ],
                'condition' => array(
                    'bwall_design_style' => 'layout-1',
                ),
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
                'condition' => array(
                    'bwall_design_style' => 'layout-1',
                ),
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
                'condition' => array(
                    'bwall_design_style' => 'layout-1',
                ),
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
                    'bwall_design_style' => 'layout-1',
                ),
            ]
        );

        $this->end_controls_section();

        
        /**
         * Service section
         */
        $this->start_controls_section(
            'bwall_services',
            [
                'label' => esc_html__('Services List', 'bwallcore'),
                'description' => esc_html__( 'Control all the style settings from Style tab', 'bwallcore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
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
            'bwall_service_title', [
                'label' => esc_html__('Title', 'bwallcore'),
                'description' => bwall_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Service Title', 'bwallcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'bwall_service_title_color',
            [
                'label' => __( 'Title Color', 'bwallcore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .service-two-right-single a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $repeater->add_control(
            'bwall_service_description',
            [
                'label' => esc_html__('Description', 'bwallcore'),
                'description' => bwall_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered.',
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'bwall_service_description_color',
            [
                'label' => __( 'Description Color', 'bwallcore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .service-two-right-single p' => 'color: {{VALUE}}',
                ]
            ]
        );

        $repeater->add_control(
            'bwall_services_link_switcher',
            [
                'label' => esc_html__( 'Add Services link', 'bwallcore' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'bwallcore' ),
                'label_off' => esc_html__( 'No', 'bwallcore' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',
            ]
        );

        $repeater->add_control(
            'bwall_services_btn_text',
            [
                'label' => esc_html__('Button Text', 'bwallcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Read More', 'bwallcore'),
                'title' => esc_html__('Enter button text', 'bwallcore'),
                'label_block' => true,
                'condition' => [
                    'bwall_services_link_switcher' => 'yes'
                ],
            ]
        );

        $repeater->add_control(
            'bwall_services_link_type',
            [
                'label' => esc_html__( 'Service Link Type', 'bwallcore' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom Link',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'condition' => [
                    'bwall_services_link_switcher' => 'yes'
                ]
            ]
        );
        $repeater->add_control(
            'bwall_services_link',
            [
                'label' => esc_html__( 'Service Link link', 'bwallcore' ),
                'type' => \Elementor\Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => esc_html__( 'https://your-link.com', 'bwallcore' ),
                'show_external' => true,
                'default' => [
                    'url' => '#',
                    'is_external' => false,
                    'nofollow' => false,
                ],
                'condition' => [
                    'bwall_services_link_type' => '1',
                    'bwall_services_link_switcher' => 'yes',
                ]
            ]
        );

        $repeater->add_control(
            'bwall_services_page_link',
            [
                'label' => esc_html__( 'Select Service Link Page', 'bwallcore' ),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => bwall_get_all_pages(),
                'condition' => [
                    'bwall_services_link_type' => '2',
                    'bwall_services_link_switcher' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'bwall_service_list',
            [
                'label' => esc_html__('Services - List', 'bwallcore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'bwall_service_title' => esc_html__('Agricultural consulting', 'bwallcore'),
                    ],
                    [
                        'bwall_service_title' => esc_html__('Agricultural financing', 'bwallcore')
                    ],
                    [
                        'bwall_service_title' => esc_html__('Agricultural technology', 'bwallcore')
                    ]
                ],
                'title_field' => '{{{ bwall_service_title }}}',
            ]
        );
        $this->add_responsive_control(
            'bwall_service_align',
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

        <?php if ( $settings['bwall_design_style']  == 'layout-2' ): ?>

            <!-- service -->
            <section class="service bwall-section-wrapper">
                <div class="light-one">
                    <img src="<?php echo get_template_directory_uri() . '/assets/img/shape/light-01.png';?>" alt="light">
                </div>
                <div class="light-two">
                    <img src="<?php echo get_template_directory_uri() . '/assets/img/shape/light-02.png';?>" alt="light">
                </div>
                <div class="container">
                    <div class="service-title-box">
                        <div class="service-title-left">
                            <?php if ( !empty($settings['bwall_description']) ) : ?>    
                                <p><?php echo bwall_kses( $settings['bwall_description'] ); ?></p>
                            <?php endif; ?>
                            <?php if ( ! empty( $settings['bwall_show_all_btn_link']['url'] ) ) : ?>
                                <a href="<?php echo esc_url($settings['bwall_show_all_btn_link']['url'] ); ?>">
                                    <?php echo bwall_kses( $settings['bwall_show_all_btn_text'] ); ?> <i class="icon-arrow-1"></i>
                                </a>
                            <?php endif; ?>
                        </div>
                        <div class="service-title-icon">
                            <img src="<?php echo get_template_directory_uri() . '/assets/img/icons/star-icon-2.png';?>" alt="icon">
                        </div>
                        <div class="service-title-right">
                            <?php if ( !empty($settings['bwall_section_title_show']) ) : ?>
                                <?php 
                                    if ( !empty($settings['bwall_title' ]) ) :
                                        printf( '<%1$s %2$s>%3$s</%1$s>',
                                        tag_escape( $settings['bwall_title_tag'] ),
                                        $this->get_render_attribute_string( 'title_args' ),
                                        bwall_kses( $settings['bwall_title' ] )
                                    );
                                    endif;
                                ?>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="service-list">
                        <ul>
                            <?php foreach ($settings['bwall_service_list'] as $key => $item) : 
                                if ('2' == $item['bwall_services_link_type']) {
                                    $link = get_permalink($item['bwall_services_page_link']);
                                    $target = '_self';
                                    $rel = 'nofollow';
                                } else {
                                    $link = !empty($item['bwall_services_link']['url']) ? $item['bwall_services_link']['url'] : '';
                                    $target = !empty($item['bwall_services_link']['is_external']) ? '_blank' : '_self';
                                    $rel = !empty($item['bwall_services_link']['nofollow']) ? 'nofollow' : '';
                                } 
                            ?>
                                <li class="service-list-container">
                                    <div class="service-list-left">
                                        <div class="service-list-number">
                                            <h3><?php echo esc_html($key+1);?></h3>
                                        </div>
                                        <div class="service-list-content">
                                            <?php if (!empty($link)) : ?>
                                                <a target="<?php echo esc_attr($target); ?>" href="<?php echo esc_url($link); ?>"><?php echo bwall_kses($item['bwall_service_title']); ?></a>
                                            <?php endif; ?>
                                            <?php if (!empty($item['bwall_service_description' ])): ?>
                                                <p ><?php echo bwall_kses($item['bwall_service_description']); ?></p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="service-list-image">
                                        <?php if($item['bwall_service_icon_type'] !== 'image') : ?>
                                            <?php if (!empty($item['icon']) || !empty($item['selected_icon']['value'])) : ?>
                                                <?php bwall_render_icon($item, 'icon', 'selected_icon'); ?>
                                                <?php endif; ?>   
                                            <?php else : ?>
                                            <?php if (!empty($item['bwall_icon_image']['url'])): ?>
                                                <img src="<?php echo $item['bwall_icon_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['bwall_icon_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </div>
                                    <div class="service-list-right">
                                        <a href="<?php echo esc_url($link); ?>">
                                            <img src="<?php echo get_template_directory_uri() . '/assets/img/icons/arrow-big-white.png';?>" alt="icon">
                                        </a>
                                    </div>
                                </li>

                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </section>
            <!-- service -->

        <?php else:
            if ( !empty($settings['bwall_image']['url']) ) {
                $bwall_image = !empty($settings['bwall_image']['id']) ? wp_get_attachment_image_url( $settings['bwall_image']['id'], $settings['bwall_image_size_size']) : $settings['bwall_image']['url'];
                $bwall_image_alt = get_post_meta($settings["bwall_image"]["id"], "_wp_attachment_image_alt", true);
            }
        ?>
            <!-- service 2 -->
            <div class="service-two">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="service-two-left-container">
                                <div class="common-title">
                                    <?php if ( !empty($settings['bwall_section_title_show']) ) : ?>
                                        <?php 
                                            if ( !empty($settings['bwall_title' ]) ) :
                                                printf( '<%1$s %2$s>%3$s</%1$s>',
                                                tag_escape( $settings['bwall_title_tag'] ),
                                                $this->get_render_attribute_string( 'title_args' ),
                                                bwall_kses( $settings['bwall_title' ] )
                                            );
                                            endif;
                                        ?>
                                    <?php endif; ?>
                                    <?php if ( !empty($settings['bwall_description']) ) : ?>    
                                        <p><?php echo bwall_kses( $settings['bwall_description'] ); ?></p>
                                    <?php endif; ?>
                                </div>
                                <div class="service-two-image">
                                    <?php if ($settings['bwall_image']['url'] || $settings['bwall_image']['id']) : ?>
                                        <img src="<?php echo esc_url($bwall_image); ?>" alt="<?php echo esc_attr($bwall_image); ?>">
                                    <?php endif; ?>
                                </div>
                                <div class="about-two-round-text">
                                    <div class="round-box-content">
                                        <span class="curved-circle"><?php echo bwall_kses($settings['text_inside_circle']); ?> </span>
                                        <div class="round-box-icon">
                                            <?php if ( ! empty( $settings['bwall_show_all_btn_link']['url'] ) ) : ?>
                                                <a href="<?php echo esc_url($settings['bwall_show_all_btn_link']['url'] ); ?>">
                                                    <img src="<?php echo get_template_directory_uri() . '/assets/img/icons/arrow-big-white.png';?>" alt="arrow">
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="service-two-right-container">
                                <?php foreach ($settings['bwall_service_list'] as $key => $item) : 
                                    if ('2' == $item['bwall_services_link_type']) {
                                        $link = get_permalink($item['bwall_services_page_link']);
                                        $target = '_self';
                                        $rel = 'nofollow';
                                    } else {
                                        $link = !empty($item['bwall_services_link']['url']) ? $item['bwall_services_link']['url'] : '';
                                        $target = !empty($item['bwall_services_link']['is_external']) ? '_blank' : '_self';
                                        $rel = !empty($item['bwall_services_link']['nofollow']) ? 'nofollow' : '';
                                    } 
                                    ?>
                                    <div class="service-two-right-single">
                                        <?php if (!empty($link)) : ?>
                                            <a target="<?php echo esc_attr($target); ?>" href="<?php echo esc_url($link); ?>"><span><?php echo esc_html($key+1);?></span> <?php echo bwall_kses($item['bwall_service_title']); ?></a>
                                        <?php endif; ?>
                                        <?php if (!empty($item['bwall_service_description' ])): ?>
                                            <p ><?php echo bwall_kses($item['bwall_service_description']); ?></p>
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- service 2 -->
        <?php endif; ?>
        <?php 
    }
}

$widgets_manager->register( new Bwall_Services() );