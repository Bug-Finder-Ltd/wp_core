<?php
namespace ProvixCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Provix Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Provix_Services extends Widget_Base {

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
        return __( 'Services', 'agenvix-core' );
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
        return 'provix-icon';
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
        return [ 'agenvix-core' ];
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
        return [ 'agenvix-core' ];
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
            'provix_layout',
            [
                'label' => esc_html__('Design Layout', 'agenvix-core'),
            ]
        );
        $this->add_control(
            'provix_design_style',
            [
                'label' => esc_html__('Select Layout', 'agenvix-core'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'layout-1' => esc_html__('Layout 1', 'agenvix-core'),
                    'layout-2' => esc_html__('Layout 2', 'agenvix-core'),
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
            'provix_section_title',
            [
                'label' => esc_html__('Title & Content', 'agenvix-core'),
                'condition' => [
                    'provix_design_style' => $layout_array,
                ],
            ]
        );

        $this->add_control(
            'provix_section_title_show',
            [
                'label' => esc_html__( 'Section Title & Content', 'agenvix-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'agenvix-core' ),
                'label_off' => esc_html__( 'Hide', 'agenvix-core' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'provix_design_style' => $layout_array,
                ],
            ]
        );

        
        $this->add_control(
            'provix_title',
            [
                'label' => esc_html__('Title', 'agenvix-core'),
                'description' => provix_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Provix Title Here', 'agenvix-core'),
                'placeholder' => esc_html__('Type Heading Text', 'agenvix-core'),
                'label_block' => true,
                'condition' => [
                    'provix_design_style' => $layout_array,
                ],
            ]
        );

        $this->add_control(
            'provix_title_color',
            [
                'label' => __( 'Title Color', 'agenvix-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .common-title h3' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'provix_design_style' => $layout_array,
                ],
            ]
        );

        $this->add_control(
            'provix_title_tag',
            [
                'label' => esc_html__('Title HTML Tag', 'agenvix-core'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'h1' => [
                        'title' => esc_html__('H1', 'agenvix-core'),
                        'icon' => 'eicon-editor-h1'
                    ],
                    'h2' => [
                        'title' => esc_html__('H2', 'agenvix-core'),
                        'icon' => 'eicon-editor-h2'
                    ],
                    'h3' => [
                        'title' => esc_html__('H3', 'agenvix-core'),
                        'icon' => 'eicon-editor-h3'
                    ],
                    'h4' => [
                        'title' => esc_html__('H4', 'agenvix-core'),
                        'icon' => 'eicon-editor-h4'
                    ],
                    'h5' => [
                        'title' => esc_html__('H5', 'agenvix-core'),
                        'icon' => 'eicon-editor-h5'
                    ],
                    'h6' => [
                        'title' => esc_html__('H6', 'agenvix-core'),
                        'icon' => 'eicon-editor-h6'
                    ]
                ],
                'default' => 'h2',
                'toggle' => false,
                'condition' => [
                    'provix_design_style' => $layout_array,
                ],
            ]
        );

        $this->add_responsive_control(
            'provix_align',
            [
                'label' => esc_html__('Alignment', 'agenvix-core'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'agenvix-core'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'agenvix-core'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'agenvix-core'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'left',
                'toggle' => false,
                'selectors' => [
                    '{{WRAPPER}}' => 'text-align: {{VALUE}};'
                ],
                'condition' => [
                    'provix_design_style' => $layout_array,
                ],
            ]
        );

        $this->add_control(
            'provix_description',
            [
                'label' => esc_html__('Description', 'agenvix-core'),
                'description' => provix_get_allowed_html_desc( 'basic' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Dynamically deliver multidisciplinary infrastructures via revolution process improvements. Competently orchestrate turnkey ideas his manufactured products deliverables premium after just in time scenarios.', 'agenvix-core'),
                'placeholder' => esc_html__('Type description text', 'agenvix-core'),
                'label_block' => true,
                'condition' => [
                    'provix_design_style' => $layout_array,
                ],
            ]
        );

        $this->add_control(
            'text_inside_circle',
            [
                'label' => esc_html__('Text Inside Circle', 'agenvix-core'),
                'description' => provix_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('BEST WALLPAPERS FOR YOUR INTERIOR • ', 'agenvix-core'),
                'placeholder' => esc_html__('Type text for inside circle', 'agenvix-core'),
                'label_block' => true,
                'condition' => [
                    'provix_design_style' => 'layout-1',
                ],
            ]
        );

        $this->add_control(
            'text_inside_circle_color',
            [
                'label' => __( 'Title Color', 'agenvix-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .round-box-content span' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'provix_design_style' => 'layout-1',
                ],
            ]
        );

        $this->end_controls_section();


        /**
         * Show all button
         */
        $this->start_controls_section(
            'provix_btn_button_group',
            [
                'label' => esc_html__('Button', 'agenvix-core'),
            ]
        );

        $this->add_control(
            'provix_button_show',
            [
                'label' => esc_html__( 'Show Button', 'agenvix-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'agenvix-core' ),
                'label_off' => esc_html__( 'Hide', 'agenvix-core' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'provix_show_all_btn_text',
            [
                'label' => esc_html__('Show All Button Text', 'agenvix-core'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('View all Service', 'agenvix-core'),
                'title' => esc_html__('Enter show all button text here', 'agenvix-core'),
                'label_block' => true,
                'condition' => array(
                    'provix_button_show' => 'yes',
                ),
            ]
        );

        $this->add_control(
            'provix_show_all_btn_link',
            [
                'label' => esc_html__('Show All Button link', 'agenvix-core'),
                'type' => Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => esc_html__('https://your-link.com', 'agenvix-core'),
                'show_external' => false,
                'default' => [
                    'url' => '#',
                    'is_external' => true,
                    'nofollow' => true,
                    'custom_attributes' => '',
                ],
                'condition' => array(
                    'provix_button_show' => 'yes',
                ),
                'label_block' => true,
            ]
        );

        $this->end_controls_section();


        /**
         * Image section
         */
		$this->start_controls_section(
            '_provix_image',
            [
                'label' => esc_html__('Image', 'agenvix-core'),
                'condition' => array(
                    'provix_design_style' => 'layout-1',
                ),
            ]
        );
        $this->add_control(
            'provix_image',
            [
                'label' => esc_html__( 'Section Image', 'agenvix-core' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => array(
                    'provix_design_style' => 'layout-1',
                ),
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'provix_image_size',
                'default' => 'full',
                'exclude' => [
                    'custom'
                ],
                'condition' => array(
                    'provix_design_style' => 'layout-1',
                ),
            ]
        );
        $this->add_control(
            'provix_image_overlap',
            [
                'label' => esc_html__('Image overlap to top?', 'agenvix-core'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'agenvix-core'),
                'label_off' => esc_html__('No', 'agenvix-core'),
                'return_value' => 'yes',
                'default' => 'no',
                'condition' => array(
                    'provix_design_style' => 'layout-1',
                ),
            ]
        );
        $this->add_responsive_control(
            'provix_image_height',
            [
                'label' => esc_html__( 'Image Height', 'agenvix-core' ),
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
                    '{{WRAPPER}} .provix-overlap img' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => array(
                    'provix_design_style' => 'layout-1',
                ),
            ]
        );
        $this->add_responsive_control(
            'provix_image_overlap_x',
            [
                'label' => esc_html__( 'Image overlap position', 'agenvix-core' ),
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
                    '{{WRAPPER}} .provix-overlap img' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
                'condition' => array(
                    'provix_image_overlap' => 'yes',
                    'provix_design_style' => 'layout-1',
                ),
            ]
        );

        $this->end_controls_section();

        
        /**
         * Service section
         */
        $this->start_controls_section(
            'provix_services',
            [
                'label' => esc_html__('Services List', 'agenvix-core'),
                'description' => esc_html__( 'Control all the style settings from Style tab', 'agenvix-core' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'provix_service_icon_type',
            [
                'label' => esc_html__('Select Icon Type', 'agenvix-core'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'image',
                'options' => [
                    'image' => esc_html__('Image', 'agenvix-core'),
                    'icon' => esc_html__('Icon', 'agenvix-core'),
                ],
            ]
        );

        $repeater->add_control(
            'provix_icon_image',
            [
                'label' => esc_html__('Upload Icon Image', 'agenvix-core'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'provix_service_icon_type' => 'image'
                ]

            ]
        );

        if (provix_is_elementor_version('<', '2.6.0')) {
            $repeater->add_control(
                'icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'fa fa-star',
                    'condition' => [
                        'provix_service_icon_type' => 'icon'
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
                        'provix_service_icon_type' => 'icon'
                    ]
                ]
            );
        }
        $repeater->add_control(
            'provix_service_title', [
                'label' => esc_html__('Title', 'agenvix-core'),
                'description' => provix_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Service Title', 'agenvix-core'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'provix_service_title_color',
            [
                'label' => __( 'Title Color', 'agenvix-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .service-two-right-single a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $repeater->add_control(
            'provix_service_description',
            [
                'label' => esc_html__('Description', 'agenvix-core'),
                'description' => provix_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered.',
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'provix_service_description_color',
            [
                'label' => __( 'Description Color', 'agenvix-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .service-two-right-single p' => 'color: {{VALUE}}',
                ]
            ]
        );

        $repeater->add_control(
            'provix_services_link_switcher',
            [
                'label' => esc_html__( 'Add Services link', 'agenvix-core' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'agenvix-core' ),
                'label_off' => esc_html__( 'No', 'agenvix-core' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',
            ]
        );

        $repeater->add_control(
            'provix_services_btn_text',
            [
                'label' => esc_html__('Button Text', 'agenvix-core'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Read More', 'agenvix-core'),
                'title' => esc_html__('Enter button text', 'agenvix-core'),
                'label_block' => true,
                'condition' => [
                    'provix_services_link_switcher' => 'yes'
                ],
            ]
        );

        $repeater->add_control(
            'provix_services_link_type',
            [
                'label' => esc_html__( 'Service Link Type', 'agenvix-core' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom Link',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'condition' => [
                    'provix_services_link_switcher' => 'yes'
                ]
            ]
        );
        $repeater->add_control(
            'provix_services_link',
            [
                'label' => esc_html__( 'Service Link link', 'agenvix-core' ),
                'type' => \Elementor\Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => esc_html__( 'https://your-link.com', 'agenvix-core' ),
                'show_external' => true,
                'default' => [
                    'url' => '#',
                    'is_external' => false,
                    'nofollow' => false,
                ],
                'condition' => [
                    'provix_services_link_type' => '1',
                    'provix_services_link_switcher' => 'yes',
                ]
            ]
        );

        $repeater->add_control(
            'provix_services_page_link',
            [
                'label' => esc_html__( 'Select Service Link Page', 'agenvix-core' ),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => provix_get_all_pages(),
                'condition' => [
                    'provix_services_link_type' => '2',
                    'provix_services_link_switcher' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'provix_service_list',
            [
                'label' => esc_html__('Services - List', 'agenvix-core'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'provix_service_title' => esc_html__('Agricultural consulting', 'agenvix-core'),
                    ],
                    [
                        'provix_service_title' => esc_html__('Agricultural financing', 'agenvix-core')
                    ],
                    [
                        'provix_service_title' => esc_html__('Agricultural technology', 'agenvix-core')
                    ]
                ],
                'title_field' => '{{{ provix_service_title }}}',
            ]
        );
        $this->add_responsive_control(
            'provix_service_align',
            [
                'label' => esc_html__( 'Alignment', 'agenvix-core' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'text-left' => [
                        'title' => esc_html__( 'Left', 'agenvix-core' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'text-center' => [
                        'title' => esc_html__( 'Center', 'agenvix-core' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'text-right' => [
                        'title' => esc_html__( 'Right', 'agenvix-core' ),
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
                'label' => __( 'Style', 'agenvix-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'text_transform',
            [
                'label' => __( 'Text Transform', 'agenvix-core' ),
                'type' => Controls_Manager::SELECT,
                'default' => '',
                'options' => [
                    '' => __( 'None', 'agenvix-core' ),
                    'uppercase' => __( 'UPPERCASE', 'agenvix-core' ),
                    'lowercase' => __( 'lowercase', 'agenvix-core' ),
                    'capitalize' => __( 'Capitalize', 'agenvix-core' ),
                ],
                'selectors' => [
                    '{{WRAPPER}} .title' => 'text-transform: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Render the widget ouprovixut on the frontend.
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

        <?php if ( $settings['provix_design_style']  == 'layout-2' ): ?>

            <!-- service -->
            <section class="service provix-section-wrapper">
                <div class="light-one">
                    <img src="<?php echo get_template_directory_uri() . '/assets/img/shape/light-01.png';?>" alt="light">
                </div>
                <div class="light-two">
                    <img src="<?php echo get_template_directory_uri() . '/assets/img/shape/light-02.png';?>" alt="light">
                </div>
                <div class="container">
                    <div class="service-title-box">
                        <div class="service-title-left">
                            <?php if ( !empty($settings['provix_description']) ) : ?>    
                                <p><?php echo provix_kses( $settings['provix_description'] ); ?></p>
                            <?php endif; ?>
                            <?php if ( ! empty( $settings['provix_show_all_btn_link']['url'] ) ) : ?>
                                <a href="<?php echo esc_url($settings['provix_show_all_btn_link']['url'] ); ?>">
                                    <?php echo provix_kses( $settings['provix_show_all_btn_text'] ); ?> <i class="icon-arrow-1"></i>
                                </a>
                            <?php endif; ?>
                        </div>
                        <div class="service-title-icon">
                            <img src="<?php echo get_template_directory_uri() . '/assets/img/icons/star-icon-2.png';?>" alt="icon">
                        </div>
                        <div class="service-title-right">
                            <?php if ( !empty($settings['provix_section_title_show']) ) : ?>
                                <?php 
                                    if ( !empty($settings['provix_title' ]) ) :
                                        printf( '<%1$s %2$s>%3$s</%1$s>',
                                        tag_escape( $settings['provix_title_tag'] ),
                                        $this->get_render_attribute_string( 'title_args' ),
                                        provix_kses( $settings['provix_title' ] )
                                    );
                                    endif;
                                ?>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="service-list">
                        <ul>
                            <?php foreach ($settings['provix_service_list'] as $key => $item) : 
                                if ('2' == $item['provix_services_link_type']) {
                                    $link = get_permalink($item['provix_services_page_link']);
                                    $target = '_self';
                                    $rel = 'nofollow';
                                } else {
                                    $link = !empty($item['provix_services_link']['url']) ? $item['provix_services_link']['url'] : '';
                                    $target = !empty($item['provix_services_link']['is_external']) ? '_blank' : '_self';
                                    $rel = !empty($item['provix_services_link']['nofollow']) ? 'nofollow' : '';
                                } 
                            ?>
                                <li class="service-list-container">
                                    <div class="service-list-left">
                                        <div class="service-list-number">
                                            <h3><?php echo esc_html($key+1);?></h3>
                                        </div>
                                        <div class="service-list-content">
                                            <?php if (!empty($link)) : ?>
                                                <a target="<?php echo esc_attr($target); ?>" href="<?php echo esc_url($link); ?>"><?php echo provix_kses($item['provix_service_title']); ?></a>
                                            <?php endif; ?>
                                            <?php if (!empty($item['provix_service_description' ])): ?>
                                                <p ><?php echo provix_kses($item['provix_service_description']); ?></p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="service-list-image">
                                        <?php if($item['provix_service_icon_type'] !== 'image') : ?>
                                            <?php if (!empty($item['icon']) || !empty($item['selected_icon']['value'])) : ?>
                                                <?php provix_render_icon($item, 'icon', 'selected_icon'); ?>
                                                <?php endif; ?>   
                                            <?php else : ?>
                                            <?php if (!empty($item['provix_icon_image']['url'])): ?>
                                                <img src="<?php echo $item['provix_icon_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['provix_icon_image']['url']), '_wp_attachment_image_alt', true); ?>">
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
            if ( !empty($settings['provix_image']['url']) ) {
                $provix_image = !empty($settings['provix_image']['id']) ? wp_get_attachment_image_url( $settings['provix_image']['id'], $settings['provix_image_size_size']) : $settings['provix_image']['url'];
                $provix_image_alt = get_post_meta($settings["provix_image"]["id"], "_wp_attachment_image_alt", true);
            }
        ?>
            <!-- service 2 -->
            <div class="service-two">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="service-two-left-container">
                                <div class="common-title">
                                    <?php if ( !empty($settings['provix_section_title_show']) ) : ?>
                                        <?php 
                                            if ( !empty($settings['provix_title' ]) ) :
                                                printf( '<%1$s %2$s>%3$s</%1$s>',
                                                tag_escape( $settings['provix_title_tag'] ),
                                                $this->get_render_attribute_string( 'title_args' ),
                                                provix_kses( $settings['provix_title' ] )
                                            );
                                            endif;
                                        ?>
                                    <?php endif; ?>
                                    <?php if ( !empty($settings['provix_description']) ) : ?>    
                                        <p><?php echo provix_kses( $settings['provix_description'] ); ?></p>
                                    <?php endif; ?>
                                </div>
                                <div class="service-two-image">
                                    <?php if ($settings['provix_image']['url'] || $settings['provix_image']['id']) : ?>
                                        <img src="<?php echo esc_url($provix_image); ?>" alt="<?php echo esc_attr($provix_image); ?>">
                                    <?php endif; ?>
                                </div>
                                <div class="about-two-round-text">
                                    <div class="round-box-content">
                                        <span class="curved-circle"><?php echo provix_kses($settings['text_inside_circle']); ?> </span>
                                        <div class="round-box-icon">
                                            <?php if ( ! empty( $settings['provix_show_all_btn_link']['url'] ) ) : ?>
                                                <a href="<?php echo esc_url($settings['provix_show_all_btn_link']['url'] ); ?>">
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
                                <?php foreach ($settings['provix_service_list'] as $key => $item) : 
                                    if ('2' == $item['provix_services_link_type']) {
                                        $link = get_permalink($item['provix_services_page_link']);
                                        $target = '_self';
                                        $rel = 'nofollow';
                                    } else {
                                        $link = !empty($item['provix_services_link']['url']) ? $item['provix_services_link']['url'] : '';
                                        $target = !empty($item['provix_services_link']['is_external']) ? '_blank' : '_self';
                                        $rel = !empty($item['provix_services_link']['nofollow']) ? 'nofollow' : '';
                                    } 
                                    ?>
                                    <div class="service-two-right-single">
                                        <?php if (!empty($link)) : ?>
                                            <a target="<?php echo esc_attr($target); ?>" href="<?php echo esc_url($link); ?>"><span><?php echo esc_html($key+1);?></span> <?php echo provix_kses($item['provix_service_title']); ?></a>
                                        <?php endif; ?>
                                        <?php if (!empty($item['provix_service_description' ])): ?>
                                            <p ><?php echo provix_kses($item['provix_service_description']); ?></p>
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

$widgets_manager->register( new Provix_Services() );