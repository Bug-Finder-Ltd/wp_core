<?php
namespace ZupetCore\Widgets;

use Elementor\Controls_Manager;
use \Elementor\Repeater;

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Zupet Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Service_List extends \Elementor\Widget_Base {

    public function get_name() {
        return 'service-list';
    }

    public function get_title() {
        return __( 'Service List', 'zupetcore' );
    }

    public function get_icon() {
        return 'zupet-icon';
    }

    public function get_categories() {
        return [ 'zupetcore' ];
    }

    public function get_script_depends() {
        return [ 'zupetcore' ];
    }

    protected function register_controls() {

        /**
         * Layout section
         */
        $this->start_controls_section(
            'zupet_layout',
            [
                'label' => esc_html__('Design Layout', 'zupetcore'),
            ]
        );
        $this->add_control(
            'zupet_design_style',
            [
                'label' => esc_html__('Select Layout', 'zupetcore'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'layout-1' => esc_html__('Layout 1', 'zupetcore'),
                    'layout-2' => esc_html__('Layout 2', 'zupetcore'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'title_section',
            [
                'label' => esc_html__('Title', 'zupetcore'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'list_title',
            [
                'label' => esc_html__( 'Title', 'zupetcore' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Default title', 'zupetcore' ),
                'placeholder' => esc_html__( 'Type your title here', 'zupetcore' ),
                'label_block' => true,
            ]
        );
        $this->end_controls_section();
        
        /**
         * Service section
         */
        $this->start_controls_section(
            'zupet_services',
            [
                'label' => esc_html__('Service List', 'zupetcore'),
                'description' => esc_html__( 'Control all the style settings from Style tab', 'zupetcore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'zupet_service_icon_type',
            [
                'label' => esc_html__('Select Icon Type', 'zupetcore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'image',
                'options' => [
                    'image' => esc_html__('Image', 'zupetcore'),
                    'icon' => esc_html__('Icon', 'zupetcore'),
                ],
            ]
        );

        $repeater->add_control(
            'icon_image',
            [
                'label' => esc_html__('Upload Icon Image', 'zupetcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'zupet_service_icon_type' => 'image'
                ]

            ]
        );

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
                    'zupet_service_icon_type' => 'icon'
                ]
            ]
        );
        
        $repeater->add_control(
            'zupet_image',
            [
                'label' => esc_html__('Upload Image', 'zupetcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],

            ]
        );
        $repeater->add_control(
            'service_title', [
                'label' => esc_html__('Title', 'zupetcore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Service Title', 'zupetcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'service_description',
            [
                'label' => esc_html__('Description', 'zupetcore'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered.',
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'zupet_services_link_switcher',
            [
                'label' => esc_html__( 'Add Services link', 'zupetcore' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'zupetcore' ),
                'label_off' => esc_html__( 'No', 'zupetcore' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',
            ]
        );

        $repeater->add_control(
            'service_btn_text',
            [
                'label' => esc_html__('Button Text', 'zupetcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Read More', 'zupetcore'),
                'title' => esc_html__('Enter button text', 'zupetcore'),
                'label_block' => true,
                'condition' => [
                    'zupet_services_link_switcher' => 'yes'
                ],
            ]
        );

        $repeater->add_control(
            'zupet_services_link_type',
            [
                'label' => esc_html__( 'Service Link Type', 'zupetcore' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom Link',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'condition' => [
                    'zupet_services_link_switcher' => 'yes'
                ]
            ]
        );
        $repeater->add_control(
            'zupet_service_link',
            [
                'label' => esc_html__( 'Service Link link', 'zupetcore' ),
                'type' => \Elementor\Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => esc_html__( 'https://your-link.com', 'zupetcore' ),
                'show_external' => true,
                'default' => [
                    'url' => '#',
                    'is_external' => false,
                    'nofollow' => false,
                ],
                'condition' => [
                    'zupet_services_link_type' => '1',
                    'zupet_services_link_switcher' => 'yes',
                ]
            ]
        );

        $repeater->add_control(
            'zupet_services_page_link',
            [
                'label' => esc_html__( 'Select Service Link Page', 'zupetcore' ),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => zupet_get_all_pages(),
                'condition' => [
                    'zupet_services_link_type' => '2',
                    'zupet_services_link_switcher' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'zupet_service_list',
            [
                'label' => esc_html__('Services - List', 'zupetcore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'service_title' => esc_html__('Agricultural consulting', 'zupetcore'),
                    ],
                    [
                        'service_title' => esc_html__('Agricultural financing', 'zupetcore')
                    ],
                    [
                        'service_title' => esc_html__('Agricultural technology', 'zupetcore')
                    ]
                ],
                'title_field' => '{{{ service_title }}}',
            ]
        );
        $this->end_controls_section();

        
        /**
         * Style section
         */
        $this->start_controls_section(
            'section_style',
            [
                'label' => __( 'Style', 'zupetcore' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'text_transform',
            [
                'label' => __( 'Text Transform', 'zupetcore' ),
                'type' => Controls_Manager::SELECT,
                'default' => '',
                'options' => [
                    '' => __( 'None', 'zupetcore' ),
                    'uppercase' => __( 'UPPERCASE', 'zupetcore' ),
                    'lowercase' => __( 'lowercase', 'zupetcore' ),
                    'capitalize' => __( 'Capitalize', 'zupetcore' ),
                ],
                'selectors' => [
                    '{{WRAPPER}} .title' => 'text-transform: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Render the widget ouzupetut on the frontend.
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

        <?php if ( $settings['zupet_design_style']  == 'layout-1' ): ?>

            <div class="service-list style-one">
                <?php foreach (  $settings['zupet_service_list'] as $item ) :
                    if ( !empty($item['zupet_image']['url']) ) {
                        $zupet_image = !empty($item['zupet_image']['id']) ? wp_get_attachment_image_url( $item['zupet_image']['id'], '') : $item['zupet_image']['url'];
                        $zupet_image_alt = get_post_meta($item["zupet_image"]["id"], "_wp_attachment_image_alt", true);
                    }

                    if ( !empty($item['icon_image']['url']) ) {
                        $icon_image = !empty($item['icon_image']['id']) ? wp_get_attachment_image_url( $item['icon_image']['id'], '') : $item['icon_image']['url'];
                        $zupet_image_alt = get_post_meta($item["icon_image"]["id"], "_wp_attachment_image_alt", true);
                    }

                    $icon_url = PROTINE_ADDONS_URL . 'assets/img/icons/footprint.png';
                    ?>
                <div class="service-item">
                    <div class="service-item-frontend">
                        <div class="frontend-icon">
                            <img src="<?php echo esc_url($icon_image); ?>" alt="icon">
                        </div>
                        <h4 class="frontend-title"><?php echo $item['service_title']; ?></h4>
                        <div class="service-border"></div>
                    </div>
                    <div class="service-item-backend">
                        <div class="service-backend-title">
                            <img class="icon" src="<?php echo esc_url($icon_image); ?>" alt="icon">
                            <a href="<?php echo esc_url($item['zupet_service_link']['url']); ?>"><?php echo $item['service_title']; ?></a>
                            <div class="service-border"></div>
                        </div>
                        <p><?php echo $item['service_description']; ?></p>
                        <div class="service-btn">
                            <a href="<?php echo esc_url($item['zupet_service_link']['url']); ?>" class="button">
                                <span class="button-text">
                                    <span class="main-text"><?php echo $item['service_btn_text']; ?></span>
                                    <span class="hover-text"><?php echo $item['service_btn_text']; ?></span>
                                </span>
                                <span class="button-icon">
                                    <span class="main-text">
                                        <img decoding="async" src="<?php echo esc_url($icon_url); ?>" alt="icon">
                                    </span>
                                    <span class="hover-text">
                                        <img decoding="async" src="<?php echo esc_url($icon_url); ?>" alt="icon">
                                    </span>
                                </span>
                            </a>
                        </div>
                        <div class="backend-image">
                            <img src="<?php echo esc_url($zupet_image); ?>" alt="image">
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
      
            </div>

        <?php elseif ( $settings['zupet_design_style']  == 'layout-2' ): ?>

            <div class="service-list style-two">
                <div class="wrapper">
                    <h2 class="title"><?php echo $settings['list_title']; ?></h2>
                    <ul class="lists">
                        <?php foreach (  $settings['zupet_service_list'] as $item ) : ?>
                            <li class="item">
                               <a href="<?php echo esc_url($item['zupet_service_link']['url']); ?>">
                                    <?php echo $item['service_title']; ?>
                                    <div class="service-list-icon">
                                        <i class="fa-light fa-arrow-up-right"></i>
                                    </div>
                               </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="image-box  overlay-anim">
                    <?php
                    $i = 0;
                    foreach (  $settings['zupet_service_list'] as $item ) :
                    $i++;
                        if ( !empty($item['zupet_image']['url']) ) {
                            $zupet_image = !empty($item['zupet_image']['id']) ? wp_get_attachment_image_url( $item['zupet_image']['id'], '') : $item['zupet_image']['url'];
                            $zupet_image_alt = get_post_meta($item["zupet_image"]["id"], "_wp_attachment_image_alt", true);
                        }
                        ?>
                        <img class="service-two-image service-two-image-<?php echo $i; ?>" src="<?php echo esc_url($zupet_image); ?>" alt="image">
                    <?php endforeach; ?>
                </div>
            </div>

        <?php endif; ?>
        <?php 
    }
}

$widgets_manager->register( new Service_List() );