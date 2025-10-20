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
class Protine_Services extends Widget_Base {

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
        return __( 'Services', 'protinecore' );
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
                    'layout-1' => esc_html__('Layout 1', 'protinecore'),
                    'layout-2' => esc_html__('Layout 2', 'protinecore'),
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
            'protine_section_title',
            [
                'label' => esc_html__('Title & Content', 'protinecore'),
                'condition' => [
                    'protine_design_style' => $layout_array,
                ],
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
                'condition' => [
                    'protine_design_style' => $layout_array,
                ],
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
                'condition' => [
                    'protine_design_style' => $layout_array,
                ],
            ]
        );

        $this->add_control(
            'protine_title_color',
            [
                'label' => __( 'Title Color', 'protinecore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .common-title h3' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'protine_design_style' => $layout_array,
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
                'condition' => [
                    'protine_design_style' => $layout_array,
                ],
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
                ],
                'condition' => [
                    'protine_design_style' => $layout_array,
                ],
            ]
        );

        $this->add_control(
            'protine_description',
            [
                'label' => esc_html__('Description', 'protinecore'),
                'description' => protine_get_allowed_html_desc( 'basic' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Dynamically deliver multidisciplinary infrastructures via revolution process improvements. Competently orchestrate turnkey ideas his manufactured products deliverables premium after just in time scenarios.', 'protinecore'),
                'placeholder' => esc_html__('Type description text', 'protinecore'),
                'label_block' => true,
                'condition' => [
                    'protine_design_style' => $layout_array,
                ],
            ]
        );

        $this->add_control(
            'text_inside_circle',
            [
                'label' => esc_html__('Text Inside Circle', 'protinecore'),
                'description' => protine_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('BEST WALLPAPERS FOR YOUR INTERIOR • ', 'protinecore'),
                'placeholder' => esc_html__('Type text for inside circle', 'protinecore'),
                'label_block' => true,
                'condition' => [
                    'protine_design_style' => 'layout-1',
                ],
            ]
        );

        $this->add_control(
            'text_inside_circle_color',
            [
                'label' => __( 'Title Color', 'protinecore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .round-box-content span' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'protine_design_style' => 'layout-1',
                ],
            ]
        );

        $this->end_controls_section();


        /**
         * Show all button
         */
        $this->start_controls_section(
            'protine_btn_button_group',
            [
                'label' => esc_html__('Button', 'protinecore'),
            ]
        );

        $this->add_control(
            'protine_button_show',
            [
                'label' => esc_html__( 'Show Button', 'protinecore' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'protinecore' ),
                'label_off' => esc_html__( 'Hide', 'protinecore' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'protine_show_all_btn_text',
            [
                'label' => esc_html__('Show All Button Text', 'protinecore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('View all Service', 'protinecore'),
                'title' => esc_html__('Enter show all button text here', 'protinecore'),
                'label_block' => true,
                'condition' => array(
                    'protine_button_show' => 'yes',
                ),
            ]
        );

        $this->add_control(
            'protine_show_all_btn_link',
            [
                'label' => esc_html__('Show All Button link', 'protinecore'),
                'type' => Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => esc_html__('https://your-link.com', 'protinecore'),
                'show_external' => false,
                'default' => [
                    'url' => '#',
                    'is_external' => true,
                    'nofollow' => true,
                    'custom_attributes' => '',
                ],
                'condition' => array(
                    'protine_button_show' => 'yes',
                ),
                'label_block' => true,
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
                'condition' => array(
                    'protine_design_style' => 'layout-1',
                ),
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
                'condition' => array(
                    'protine_design_style' => 'layout-1',
                ),
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'protine_image_size',
                'default' => 'full',
                'exclude' => [
                    'custom'
                ],
                'condition' => array(
                    'protine_design_style' => 'layout-1',
                ),
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
                'condition' => array(
                    'protine_design_style' => 'layout-1',
                ),
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
                'condition' => array(
                    'protine_design_style' => 'layout-1',
                ),
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
                    'protine_design_style' => 'layout-1',
                ),
            ]
        );

        $this->end_controls_section();

        
        /**
         * Service section
         */
        $this->start_controls_section(
            'protine_services',
            [
                'label' => esc_html__('Services List', 'protinecore'),
                'description' => esc_html__( 'Control all the style settings from Style tab', 'protinecore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
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
            'protine_service_title', [
                'label' => esc_html__('Title', 'protinecore'),
                'description' => protine_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Service Title', 'protinecore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'protine_service_title_color',
            [
                'label' => __( 'Title Color', 'protinecore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .service-two-right-single a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $repeater->add_control(
            'protine_service_description',
            [
                'label' => esc_html__('Description', 'protinecore'),
                'description' => protine_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered.',
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'protine_service_description_color',
            [
                'label' => __( 'Description Color', 'protinecore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .service-two-right-single p' => 'color: {{VALUE}}',
                ]
            ]
        );

        $repeater->add_control(
            'protine_services_link_switcher',
            [
                'label' => esc_html__( 'Add Services link', 'protinecore' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'protinecore' ),
                'label_off' => esc_html__( 'No', 'protinecore' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',
            ]
        );

        $repeater->add_control(
            'protine_services_btn_text',
            [
                'label' => esc_html__('Button Text', 'protinecore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Read More', 'protinecore'),
                'title' => esc_html__('Enter button text', 'protinecore'),
                'label_block' => true,
                'condition' => [
                    'protine_services_link_switcher' => 'yes'
                ],
            ]
        );

        $repeater->add_control(
            'protine_services_link_type',
            [
                'label' => esc_html__( 'Service Link Type', 'protinecore' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom Link',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'condition' => [
                    'protine_services_link_switcher' => 'yes'
                ]
            ]
        );
        $repeater->add_control(
            'protine_services_link',
            [
                'label' => esc_html__( 'Service Link link', 'protinecore' ),
                'type' => \Elementor\Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => esc_html__( 'https://your-link.com', 'protinecore' ),
                'show_external' => true,
                'default' => [
                    'url' => '#',
                    'is_external' => false,
                    'nofollow' => false,
                ],
                'condition' => [
                    'protine_services_link_type' => '1',
                    'protine_services_link_switcher' => 'yes',
                ]
            ]
        );

        $repeater->add_control(
            'protine_services_page_link',
            [
                'label' => esc_html__( 'Select Service Link Page', 'protinecore' ),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => protine_get_all_pages(),
                'condition' => [
                    'protine_services_link_type' => '2',
                    'protine_services_link_switcher' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'protine_service_list',
            [
                'label' => esc_html__('Services - List', 'protinecore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'protine_service_title' => esc_html__('Agricultural consulting', 'protinecore'),
                    ],
                    [
                        'protine_service_title' => esc_html__('Agricultural financing', 'protinecore')
                    ],
                    [
                        'protine_service_title' => esc_html__('Agricultural technology', 'protinecore')
                    ]
                ],
                'title_field' => '{{{ protine_service_title }}}',
            ]
        );
        $this->add_responsive_control(
            'protine_service_align',
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
        ?>

        <?php if ( $settings['protine_design_style']  == 'layout-2' ): ?>

            <!-- service -->
            <section class="service protine-section-wrapper">
                <div class="light-one">
                    <img src="<?php echo get_template_directory_uri() . '/assets/img/shape/light-01.png';?>" alt="light">
                </div>
                <div class="light-two">
                    <img src="<?php echo get_template_directory_uri() . '/assets/img/shape/light-02.png';?>" alt="light">
                </div>
                <div class="container">
                    <div class="service-title-box">
                        <div class="service-title-left">
                            <?php if ( !empty($settings['protine_description']) ) : ?>    
                                <p><?php echo protine_kses( $settings['protine_description'] ); ?></p>
                            <?php endif; ?>
                            <?php if ( ! empty( $settings['protine_show_all_btn_link']['url'] ) ) : ?>
                                <a href="<?php echo esc_url($settings['protine_show_all_btn_link']['url'] ); ?>">
                                    <?php echo protine_kses( $settings['protine_show_all_btn_text'] ); ?> <i class="icon-arrow-1"></i>
                                </a>
                            <?php endif; ?>
                        </div>
                        <div class="service-title-icon">
                            <img src="<?php echo get_template_directory_uri() . '/assets/img/icons/star-icon-2.png';?>" alt="icon">
                        </div>
                        <div class="service-title-right">
                            <?php if ( !empty($settings['protine_section_title_show']) ) : ?>
                                <?php 
                                    if ( !empty($settings['protine_title' ]) ) :
                                        printf( '<%1$s %2$s>%3$s</%1$s>',
                                        tag_escape( $settings['protine_title_tag'] ),
                                        $this->get_render_attribute_string( 'title_args' ),
                                        protine_kses( $settings['protine_title' ] )
                                    );
                                    endif;
                                ?>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="service-list">
                        <ul>
                            <?php foreach ($settings['protine_service_list'] as $key => $item) : 
                                if ('2' == $item['protine_services_link_type']) {
                                    $link = get_permalink($item['protine_services_page_link']);
                                    $target = '_self';
                                    $rel = 'nofollow';
                                } else {
                                    $link = !empty($item['protine_services_link']['url']) ? $item['protine_services_link']['url'] : '';
                                    $target = !empty($item['protine_services_link']['is_external']) ? '_blank' : '_self';
                                    $rel = !empty($item['protine_services_link']['nofollow']) ? 'nofollow' : '';
                                } 
                            ?>
                                <li class="service-list-container">
                                    <div class="service-list-left">
                                        <div class="service-list-number">
                                            <h3><?php echo esc_html($key+1);?></h3>
                                        </div>
                                        <div class="service-list-content">
                                            <?php if (!empty($link)) : ?>
                                                <a target="<?php echo esc_attr($target); ?>" href="<?php echo esc_url($link); ?>"><?php echo protine_kses($item['protine_service_title']); ?></a>
                                            <?php endif; ?>
                                            <?php if (!empty($item['protine_service_description' ])): ?>
                                                <p ><?php echo protine_kses($item['protine_service_description']); ?></p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="service-list-image">
                                        <?php if($item['protine_service_icon_type'] !== 'image') : ?>
                                            <?php if (!empty($item['icon']) || !empty($item['selected_icon']['value'])) : ?>
                                                <?php protine_render_icon($item, 'icon', 'selected_icon'); ?>
                                                <?php endif; ?>   
                                            <?php else : ?>
                                            <?php if (!empty($item['protine_icon_image']['url'])): ?>
                                                <img src="<?php echo $item['protine_icon_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['protine_icon_image']['url']), '_wp_attachment_image_alt', true); ?>">
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
            if ( !empty($settings['protine_image']['url']) ) {
                $protine_image = !empty($settings['protine_image']['id']) ? wp_get_attachment_image_url( $settings['protine_image']['id'], $settings['protine_image_size_size']) : $settings['protine_image']['url'];
                $protine_image_alt = get_post_meta($settings["protine_image"]["id"], "_wp_attachment_image_alt", true);
            }
        ?>
            <!-- service 2 -->
            <div class="service-two">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="service-two-left-container">
                                <div class="common-title">
                                    <?php if ( !empty($settings['protine_section_title_show']) ) : ?>
                                        <?php 
                                            if ( !empty($settings['protine_title' ]) ) :
                                                printf( '<%1$s %2$s>%3$s</%1$s>',
                                                tag_escape( $settings['protine_title_tag'] ),
                                                $this->get_render_attribute_string( 'title_args' ),
                                                protine_kses( $settings['protine_title' ] )
                                            );
                                            endif;
                                        ?>
                                    <?php endif; ?>
                                    <?php if ( !empty($settings['protine_description']) ) : ?>    
                                        <p><?php echo protine_kses( $settings['protine_description'] ); ?></p>
                                    <?php endif; ?>
                                </div>
                                <div class="service-two-image">
                                    <?php if ($settings['protine_image']['url'] || $settings['protine_image']['id']) : ?>
                                        <img src="<?php echo esc_url($protine_image); ?>" alt="<?php echo esc_attr($protine_image); ?>">
                                    <?php endif; ?>
                                </div>
                                <div class="about-two-round-text">
                                    <div class="round-box-content">
                                        <span class="curved-circle"><?php echo protine_kses($settings['text_inside_circle']); ?> </span>
                                        <div class="round-box-icon">
                                            <?php if ( ! empty( $settings['protine_show_all_btn_link']['url'] ) ) : ?>
                                                <a href="<?php echo esc_url($settings['protine_show_all_btn_link']['url'] ); ?>">
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
                                <?php foreach ($settings['protine_service_list'] as $key => $item) : 
                                    if ('2' == $item['protine_services_link_type']) {
                                        $link = get_permalink($item['protine_services_page_link']);
                                        $target = '_self';
                                        $rel = 'nofollow';
                                    } else {
                                        $link = !empty($item['protine_services_link']['url']) ? $item['protine_services_link']['url'] : '';
                                        $target = !empty($item['protine_services_link']['is_external']) ? '_blank' : '_self';
                                        $rel = !empty($item['protine_services_link']['nofollow']) ? 'nofollow' : '';
                                    } 
                                    ?>
                                    <div class="service-two-right-single">
                                        <?php if (!empty($link)) : ?>
                                            <a target="<?php echo esc_attr($target); ?>" href="<?php echo esc_url($link); ?>"><span><?php echo esc_html($key+1);?></span> <?php echo protine_kses($item['protine_service_title']); ?></a>
                                        <?php endif; ?>
                                        <?php if (!empty($item['protine_service_description' ])): ?>
                                            <p ><?php echo protine_kses($item['protine_service_description']); ?></p>
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

$widgets_manager->register( new Protine_Services() );