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
class Nextdestina_Services extends Widget_Base {

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
        return __( 'Services', 'nextdestinacore' );
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
                    'layout-1' => esc_html__('Layout 1', 'nextdestinacore'),
                    'layout-2' => esc_html__('Layout 2', 'nextdestinacore'),
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
            'nextdestina_section_title',
            [
                'label' => esc_html__('Title & Content', 'nextdestinacore'),
                'condition' => [
                    'nextdestina_design_style' => $layout_array,
                ],
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
                'condition' => [
                    'nextdestina_design_style' => $layout_array,
                ],
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
                'condition' => [
                    'nextdestina_design_style' => $layout_array,
                ],
            ]
        );

        $this->add_control(
            'nextdestina_title_color',
            [
                'label' => __( 'Title Color', 'nextdestinacore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .common-title h3' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'nextdestina_design_style' => $layout_array,
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
                'condition' => [
                    'nextdestina_design_style' => $layout_array,
                ],
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
                ],
                'condition' => [
                    'nextdestina_design_style' => $layout_array,
                ],
            ]
        );

        $this->add_control(
            'nextdestina_description',
            [
                'label' => esc_html__('Description', 'nextdestinacore'),
                'description' => nextdestina_get_allowed_html_desc( 'basic' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Dynamically deliver multidisciplinary infrastructures via revolution process improvements. Competently orchestrate turnkey ideas his manufactured products deliverables premium after just in time scenarios.', 'nextdestinacore'),
                'placeholder' => esc_html__('Type description text', 'nextdestinacore'),
                'label_block' => true,
                'condition' => [
                    'nextdestina_design_style' => $layout_array,
                ],
            ]
        );

        $this->add_control(
            'text_inside_circle',
            [
                'label' => esc_html__('Text Inside Circle', 'nextdestinacore'),
                'description' => nextdestina_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('BEST WALLPAPERS FOR YOUR INTERIOR • ', 'nextdestinacore'),
                'placeholder' => esc_html__('Type text for inside circle', 'nextdestinacore'),
                'label_block' => true,
                'condition' => [
                    'nextdestina_design_style' => 'layout-1',
                ],
            ]
        );

        $this->add_control(
            'text_inside_circle_color',
            [
                'label' => __( 'Title Color', 'nextdestinacore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .round-box-content span' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'nextdestina_design_style' => 'layout-1',
                ],
            ]
        );

        $this->end_controls_section();


        /**
         * Show all button
         */
        $this->start_controls_section(
            'nextdestina_btn_button_group',
            [
                'label' => esc_html__('Button', 'nextdestinacore'),
            ]
        );

        $this->add_control(
            'nextdestina_button_show',
            [
                'label' => esc_html__( 'Show Button', 'nextdestinacore' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'nextdestinacore' ),
                'label_off' => esc_html__( 'Hide', 'nextdestinacore' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'nextdestina_show_all_btn_text',
            [
                'label' => esc_html__('Show All Button Text', 'nextdestinacore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('View all Service', 'nextdestinacore'),
                'title' => esc_html__('Enter show all button text here', 'nextdestinacore'),
                'label_block' => true,
                'condition' => array(
                    'nextdestina_button_show' => 'yes',
                ),
            ]
        );

        $this->add_control(
            'nextdestina_show_all_btn_link',
            [
                'label' => esc_html__('Show All Button link', 'nextdestinacore'),
                'type' => Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => esc_html__('https://your-link.com', 'nextdestinacore'),
                'show_external' => false,
                'default' => [
                    'url' => '#',
                    'is_external' => true,
                    'nofollow' => true,
                    'custom_attributes' => '',
                ],
                'condition' => array(
                    'nextdestina_button_show' => 'yes',
                ),
                'label_block' => true,
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
                'condition' => array(
                    'nextdestina_design_style' => 'layout-1',
                ),
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
                'condition' => array(
                    'nextdestina_design_style' => 'layout-1',
                ),
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'nextdestina_image_size',
                'default' => 'full',
                'exclude' => [
                    'custom'
                ],
                'condition' => array(
                    'nextdestina_design_style' => 'layout-1',
                ),
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
                'condition' => array(
                    'nextdestina_design_style' => 'layout-1',
                ),
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
                'condition' => array(
                    'nextdestina_design_style' => 'layout-1',
                ),
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
                    'nextdestina_design_style' => 'layout-1',
                ),
            ]
        );

        $this->end_controls_section();

        
        /**
         * Service section
         */
        $this->start_controls_section(
            'nextdestina_services',
            [
                'label' => esc_html__('Services List', 'nextdestinacore'),
                'description' => esc_html__( 'Control all the style settings from Style tab', 'nextdestinacore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'nextdestina_service_icon_type',
            [
                'label' => esc_html__('Select Icon Type', 'nextdestinacore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'image',
                'options' => [
                    'image' => esc_html__('Image', 'nextdestinacore'),
                    'icon' => esc_html__('Icon', 'nextdestinacore'),
                ],
            ]
        );

        $repeater->add_control(
            'nextdestina_icon_image',
            [
                'label' => esc_html__('Upload Icon Image', 'nextdestinacore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'nextdestina_service_icon_type' => 'image'
                ]

            ]
        );

        if (nextdestina_is_elementor_version('<', '2.6.0')) {
            $repeater->add_control(
                'icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'fa fa-star',
                    'condition' => [
                        'nextdestina_service_icon_type' => 'icon'
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
                        'nextdestina_service_icon_type' => 'icon'
                    ]
                ]
            );
        }
        $repeater->add_control(
            'nextdestina_service_title', [
                'label' => esc_html__('Title', 'nextdestinacore'),
                'description' => nextdestina_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Service Title', 'nextdestinacore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'nextdestina_service_title_color',
            [
                'label' => __( 'Title Color', 'nextdestinacore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .service-two-right-single a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $repeater->add_control(
            'nextdestina_service_description',
            [
                'label' => esc_html__('Description', 'nextdestinacore'),
                'description' => nextdestina_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered.',
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'nextdestina_service_description_color',
            [
                'label' => __( 'Description Color', 'nextdestinacore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .service-two-right-single p' => 'color: {{VALUE}}',
                ]
            ]
        );

        $repeater->add_control(
            'nextdestina_services_link_switcher',
            [
                'label' => esc_html__( 'Add Services link', 'nextdestinacore' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'nextdestinacore' ),
                'label_off' => esc_html__( 'No', 'nextdestinacore' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',
            ]
        );

        $repeater->add_control(
            'nextdestina_services_btn_text',
            [
                'label' => esc_html__('Button Text', 'nextdestinacore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Read More', 'nextdestinacore'),
                'title' => esc_html__('Enter button text', 'nextdestinacore'),
                'label_block' => true,
                'condition' => [
                    'nextdestina_services_link_switcher' => 'yes'
                ],
            ]
        );

        $repeater->add_control(
            'nextdestina_services_link_type',
            [
                'label' => esc_html__( 'Service Link Type', 'nextdestinacore' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom Link',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'condition' => [
                    'nextdestina_services_link_switcher' => 'yes'
                ]
            ]
        );
        $repeater->add_control(
            'nextdestina_services_link',
            [
                'label' => esc_html__( 'Service Link link', 'nextdestinacore' ),
                'type' => \Elementor\Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => esc_html__( 'https://your-link.com', 'nextdestinacore' ),
                'show_external' => true,
                'default' => [
                    'url' => '#',
                    'is_external' => false,
                    'nofollow' => false,
                ],
                'condition' => [
                    'nextdestina_services_link_type' => '1',
                    'nextdestina_services_link_switcher' => 'yes',
                ]
            ]
        );

        $repeater->add_control(
            'nextdestina_services_page_link',
            [
                'label' => esc_html__( 'Select Service Link Page', 'nextdestinacore' ),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => nextdestina_get_all_pages(),
                'condition' => [
                    'nextdestina_services_link_type' => '2',
                    'nextdestina_services_link_switcher' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'nextdestina_service_list',
            [
                'label' => esc_html__('Services - List', 'nextdestinacore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'nextdestina_service_title' => esc_html__('Agricultural consulting', 'nextdestinacore'),
                    ],
                    [
                        'nextdestina_service_title' => esc_html__('Agricultural financing', 'nextdestinacore')
                    ],
                    [
                        'nextdestina_service_title' => esc_html__('Agricultural technology', 'nextdestinacore')
                    ]
                ],
                'title_field' => '{{{ nextdestina_service_title }}}',
            ]
        );
        $this->add_responsive_control(
            'nextdestina_service_align',
            [
                'label' => esc_html__( 'Alignment', 'nextdestinacore' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'text-left' => [
                        'title' => esc_html__( 'Left', 'nextdestinacore' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'text-center' => [
                        'title' => esc_html__( 'Center', 'nextdestinacore' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'text-right' => [
                        'title' => esc_html__( 'Right', 'nextdestinacore' ),
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
        ?>

        <?php if ( $settings['nextdestina_design_style']  == 'layout-2' ): ?>

            <!-- service -->
            <section class="service nextdestina-section-wrapper">
                <div class="light-one">
                    <img src="<?php echo get_template_directory_uri() . '/assets/img/shape/light-01.png';?>" alt="light">
                </div>
                <div class="light-two">
                    <img src="<?php echo get_template_directory_uri() . '/assets/img/shape/light-02.png';?>" alt="light">
                </div>
                <div class="container">
                    <div class="service-title-box">
                        <div class="service-title-left">
                            <?php if ( !empty($settings['nextdestina_description']) ) : ?>    
                                <p><?php echo nextdestina_kses( $settings['nextdestina_description'] ); ?></p>
                            <?php endif; ?>
                            <?php if ( ! empty( $settings['nextdestina_show_all_btn_link']['url'] ) ) : ?>
                                <a href="<?php echo esc_url($settings['nextdestina_show_all_btn_link']['url'] ); ?>">
                                    <?php echo nextdestina_kses( $settings['nextdestina_show_all_btn_text'] ); ?> <i class="icon-arrow-1"></i>
                                </a>
                            <?php endif; ?>
                        </div>
                        <div class="service-title-icon">
                            <img src="<?php echo get_template_directory_uri() . '/assets/img/icons/star-icon-2.png';?>" alt="icon">
                        </div>
                        <div class="service-title-right">
                            <?php if ( !empty($settings['nextdestina_section_title_show']) ) : ?>
                                <?php 
                                    if ( !empty($settings['nextdestina_title' ]) ) :
                                        printf( '<%1$s %2$s>%3$s</%1$s>',
                                        tag_escape( $settings['nextdestina_title_tag'] ),
                                        $this->get_render_attribute_string( 'title_args' ),
                                        nextdestina_kses( $settings['nextdestina_title' ] )
                                    );
                                    endif;
                                ?>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="service-list">
                        <ul>
                            <?php foreach ($settings['nextdestina_service_list'] as $key => $item) : 
                                if ('2' == $item['nextdestina_services_link_type']) {
                                    $link = get_permalink($item['nextdestina_services_page_link']);
                                    $target = '_self';
                                    $rel = 'nofollow';
                                } else {
                                    $link = !empty($item['nextdestina_services_link']['url']) ? $item['nextdestina_services_link']['url'] : '';
                                    $target = !empty($item['nextdestina_services_link']['is_external']) ? '_blank' : '_self';
                                    $rel = !empty($item['nextdestina_services_link']['nofollow']) ? 'nofollow' : '';
                                } 
                            ?>
                                <li class="service-list-container">
                                    <div class="service-list-left">
                                        <div class="service-list-number">
                                            <h3><?php echo esc_html($key+1);?></h3>
                                        </div>
                                        <div class="service-list-content">
                                            <?php if (!empty($link)) : ?>
                                                <a target="<?php echo esc_attr($target); ?>" href="<?php echo esc_url($link); ?>"><?php echo nextdestina_kses($item['nextdestina_service_title']); ?></a>
                                            <?php endif; ?>
                                            <?php if (!empty($item['nextdestina_service_description' ])): ?>
                                                <p ><?php echo nextdestina_kses($item['nextdestina_service_description']); ?></p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="service-list-image">
                                        <?php if($item['nextdestina_service_icon_type'] !== 'image') : ?>
                                            <?php if (!empty($item['icon']) || !empty($item['selected_icon']['value'])) : ?>
                                                <?php nextdestina_render_icon($item, 'icon', 'selected_icon'); ?>
                                                <?php endif; ?>   
                                            <?php else : ?>
                                            <?php if (!empty($item['nextdestina_icon_image']['url'])): ?>
                                                <img src="<?php echo $item['nextdestina_icon_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['nextdestina_icon_image']['url']), '_wp_attachment_image_alt', true); ?>">
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
            if ( !empty($settings['nextdestina_image']['url']) ) {
                $nextdestina_image = !empty($settings['nextdestina_image']['id']) ? wp_get_attachment_image_url( $settings['nextdestina_image']['id'], $settings['nextdestina_image_size_size']) : $settings['nextdestina_image']['url'];
                $nextdestina_image_alt = get_post_meta($settings["nextdestina_image"]["id"], "_wp_attachment_image_alt", true);
            }
        ?>
            <!-- service 2 -->
            <div class="service-two">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="service-two-left-container">
                                <div class="common-title">
                                    <?php if ( !empty($settings['nextdestina_section_title_show']) ) : ?>
                                        <?php 
                                            if ( !empty($settings['nextdestina_title' ]) ) :
                                                printf( '<%1$s %2$s>%3$s</%1$s>',
                                                tag_escape( $settings['nextdestina_title_tag'] ),
                                                $this->get_render_attribute_string( 'title_args' ),
                                                nextdestina_kses( $settings['nextdestina_title' ] )
                                            );
                                            endif;
                                        ?>
                                    <?php endif; ?>
                                    <?php if ( !empty($settings['nextdestina_description']) ) : ?>    
                                        <p><?php echo nextdestina_kses( $settings['nextdestina_description'] ); ?></p>
                                    <?php endif; ?>
                                </div>
                                <div class="service-two-image">
                                    <?php if ($settings['nextdestina_image']['url'] || $settings['nextdestina_image']['id']) : ?>
                                        <img src="<?php echo esc_url($nextdestina_image); ?>" alt="<?php echo esc_attr($nextdestina_image); ?>">
                                    <?php endif; ?>
                                </div>
                                <div class="about-two-round-text">
                                    <div class="round-box-content">
                                        <span class="curved-circle"><?php echo nextdestina_kses($settings['text_inside_circle']); ?> </span>
                                        <div class="round-box-icon">
                                            <?php if ( ! empty( $settings['nextdestina_show_all_btn_link']['url'] ) ) : ?>
                                                <a href="<?php echo esc_url($settings['nextdestina_show_all_btn_link']['url'] ); ?>">
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
                                <?php foreach ($settings['nextdestina_service_list'] as $key => $item) : 
                                    if ('2' == $item['nextdestina_services_link_type']) {
                                        $link = get_permalink($item['nextdestina_services_page_link']);
                                        $target = '_self';
                                        $rel = 'nofollow';
                                    } else {
                                        $link = !empty($item['nextdestina_services_link']['url']) ? $item['nextdestina_services_link']['url'] : '';
                                        $target = !empty($item['nextdestina_services_link']['is_external']) ? '_blank' : '_self';
                                        $rel = !empty($item['nextdestina_services_link']['nofollow']) ? 'nofollow' : '';
                                    } 
                                    ?>
                                    <div class="service-two-right-single">
                                        <?php if (!empty($link)) : ?>
                                            <a target="<?php echo esc_attr($target); ?>" href="<?php echo esc_url($link); ?>"><span><?php echo esc_html($key+1);?></span> <?php echo nextdestina_kses($item['nextdestina_service_title']); ?></a>
                                        <?php endif; ?>
                                        <?php if (!empty($item['nextdestina_service_description' ])): ?>
                                            <p ><?php echo nextdestina_kses($item['nextdestina_service_description']); ?></p>
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

$widgets_manager->register( new Nextdestina_Services() );