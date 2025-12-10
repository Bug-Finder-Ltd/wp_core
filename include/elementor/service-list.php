<?php
namespace RaizenCore\Widgets;

use Elementor\Controls_Manager;
use \Elementor\Repeater;

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Raizen Core
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
        return __( 'Service List', 'raizencore' );
    }

    public function get_icon() {
        return 'raizen-icon';
    }

    public function get_categories() {
        return [ 'raizencore' ];
    }

    public function get_script_depends() {
        return [ 'raizencore' ];
    }

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
                    'layout-2' => esc_html__('Layout 2', 'raizencore'),
                    'layout-3' => esc_html__('Layout 3', 'raizencore'),
                    'layout-4' => esc_html__('Layout 4', 'raizencore'),
                    'layout-5' => esc_html__('Layout 5', 'raizencore'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'title_section',
            [
                'label' => esc_html__('Title', 'raizencore'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'list_title',
            [
                'label' => esc_html__( 'Title', 'raizencore' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Default title', 'raizencore' ),
                'placeholder' => esc_html__( 'Type your title here', 'raizencore' ),
                'label_block' => true,
            ]
        );
        $this->end_controls_section();
        
        /**
         * Service section
         */
        $this->start_controls_section(
            'raizen_services',
            [
                'label' => esc_html__('Service List', 'raizencore'),
                'description' => esc_html__( 'Control all the style settings from Style tab', 'raizencore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'raizen_service_icon_type',
            [
                'label' => esc_html__('Select Icon Type', 'raizencore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'image',
                'options' => [
                    'image' => esc_html__('Image', 'raizencore'),
                    'icon' => esc_html__('Icon', 'raizencore'),
                ],
            ]
        );

        $repeater->add_control(
            'icon_image',
            [
                'label' => esc_html__('Upload Icon Image', 'raizencore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'raizen_service_icon_type' => 'image'
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
                    'raizen_service_icon_type' => 'icon'
                ]
            ]
        );
        
        $repeater->add_control(
            'raizen_image',
            [
                'label' => esc_html__('Upload Image', 'raizencore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],

            ]
        );
        $repeater->add_control(
            'service_title', [
                'label' => esc_html__('Title', 'raizencore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Service Title', 'raizencore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'service_description',
            [
                'label' => esc_html__('Description', 'raizencore'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered.',
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'category_1',
            [
                'label' => esc_html__('Category 1', 'raizencore'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Packaging',
            ]
        );
        $repeater->add_control(
            'category_2',
            [
                'label' => esc_html__('Category 2', 'raizencore'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Mockup',
            ]
        );

        $repeater->add_control(
            'raizen_services_link_switcher',
            [
                'label' => esc_html__( 'Add Services link', 'raizencore' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'raizencore' ),
                'label_off' => esc_html__( 'No', 'raizencore' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',
            ]
        );

        $repeater->add_control(
            'service_btn_text',
            [
                'label' => esc_html__('Button Text', 'raizencore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Read More', 'raizencore'),
                'title' => esc_html__('Enter button text', 'raizencore'),
                'label_block' => true,
                'condition' => [
                    'raizen_services_link_switcher' => 'yes'
                ],
            ]
        );

        $repeater->add_control(
            'raizen_services_link_type',
            [
                'label' => esc_html__( 'Service Link Type', 'raizencore' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom Link',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'condition' => [
                    'raizen_services_link_switcher' => 'yes'
                ]
            ]
        );
        $repeater->add_control(
            'raizen_service_link',
            [
                'label' => esc_html__( 'Service Link', 'raizencore' ),
                'type' => \Elementor\Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => esc_html__( 'https://your-link.com', 'raizencore' ),
                'show_external' => true,
                'default' => [
                    'url' => '#',
                    'is_external' => false,
                    'nofollow' => false,
                ],
                'condition' => [
                    'raizen_services_link_type' => '1',
                    'raizen_services_link_switcher' => 'yes',
                ]
            ]
        );

        $repeater->add_control(
            'raizen_services_page_link',
            [
                'label' => esc_html__( 'Select Service Link Page', 'raizencore' ),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => raizen_get_all_pages(),
                'condition' => [
                    'raizen_services_link_type' => '2',
                    'raizen_services_link_switcher' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'raizen_service_list',
            [
                'label' => esc_html__('Services - List', 'raizencore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'service_title' => esc_html__('Agricultural consulting', 'raizencore'),
                    ],
                    [
                        'service_title' => esc_html__('Agricultural financing', 'raizencore')
                    ],
                    [
                        'service_title' => esc_html__('Agricultural technology', 'raizencore')
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

        <?php if ( $settings['raizen_design_style']  == 'layout-1' ): ?>

            <div class="service-list style-one">
                <div class="image-box overlay-anim">
                    <?php
                    $i = 0;
                    foreach (  $settings['raizen_service_list'] as $item ) :
                    $i++;
                        if ( !empty($item['raizen_image']['url']) ) {
                            $raizen_image = !empty($item['raizen_image']['id']) ? wp_get_attachment_image_url( $item['raizen_image']['id'], '') : $item['raizen_image']['url'];
                            $raizen_image_alt = get_post_meta($item["raizen_image"]["id"], "_wp_attachment_image_alt", true);
                        }
                        ?>
                        <img class="service-two-image service-two-image-<?php echo $i; ?>" src="<?php echo esc_url($raizen_image); ?>" alt="image">
                    <?php endforeach; ?>
                </div>
                <div class="wrapper">
                    <ul class="lists">
                        <?php
                        $delay = 0;
                        foreach (  $settings['raizen_service_list'] as $item ) :
                            $ms_delay = 100 + ($delay * 100);
                            ?>
                            <li class="item wow fadeInRight" data-wow-delay="<?php echo $ms_delay; ?>ms">
                               <a href="<?php echo esc_url($item['raizen_service_link']['url']); ?>">
                                    <?php echo $item['service_title']; ?>
                                    <div class="service-list-icon">
                                        <?php echo $item['service_description']; ?>
                                    </div>
                               </a>
                            </li>
                        <?php
                        $delay++;
                        endforeach; ?>
                    </ul>
                </div>
            </div>

        <?php elseif ( $settings['raizen_design_style']  == 'layout-2' ): ?>

            <div class="service-list style-two">
                <div class="service-slider swiper-container">
                    <div class="swiper-wrapper">
                        <?php foreach (  $settings['raizen_service_list'] as $item ) :
                            if ( !empty($item['raizen_image']['url']) ) {
                                $raizen_image = !empty($item['raizen_image']['id']) ? wp_get_attachment_image_url( $item['raizen_image']['id'], '') : $item['raizen_image']['url'];
                                $raizen_image_alt = get_post_meta($item["raizen_image"]["id"], "_wp_attachment_image_alt", true);
                            }
                            ?>
                            <div class="swiper-slide">
                                <div class="slide-item">
                                    <div class="image">
                                        <img src="<?php echo esc_url($raizen_image); ?>" alt="image">
                                    </div>
                                    <div class="content">
                                        <div class="category">
                                            <span><?php echo $item['category_1']; ?></span>
                                            <span><?php echo $item['category_2']; ?></span>
                                        </div>
                                        <h5 class="title">
                                            <?php echo $item['service_title']; ?>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="swiper-pagination"></div>
                <div class="button-prev"><?php esc_html_e('Prev', 'raizen'); ?></div>
                <div class="button-next"><?php esc_html_e('Next', 'raizen'); ?></div>
            </div>

        <?php elseif ( $settings['raizen_design_style']  == 'layout-3' ): ?>

            <div class="service-list style-three">
                <?php
                $i = 0;
                $delay = 0;
                foreach (  $settings['raizen_service_list'] as $item ) :
                    if ( !empty($item['raizen_image']['url']) ) {
                        $raizen_image = !empty($item['raizen_image']['id']) ? wp_get_attachment_image_url( $item['raizen_image']['id'], '') : $item['raizen_image']['url'];
                        $raizen_image_alt = get_post_meta($item["raizen_image"]["id"], "_wp_attachment_image_alt", true);
                    }

                    $ms_delay = 100 + ($delay * 100);
                    ?>
                <div class="service-single-item wow fadeInLeft" data-wow-delay="<?php echo $ms_delay; ?>ms">
                    <a class="" href="<?php echo esc_url($item['raizen_service_link']['url']); ?>">
                    <div class="left">
                        <div class="image">
                            <img src="<?php echo esc_url($raizen_image); ?>" alt="image">
                        </div>
                        <span class="number">
                            <?php echo esc_html( sprintf('%02d', $i + 1) ); ?>
                        </span>
                        <div class="content">
                            <h5 class="title">
                                <?php echo $item['service_title']; ?>
                            </h5>
                            <p class="description">
                                <?php echo $item['service_description']; ?>
                            </p>
                        </div>
                    </div>
                    <a class="button" href="<?php echo esc_url($item['raizen_service_link']['url']); ?>">
                        <span class="btn-icon">
                            <span class="icon-first">
                                <i class="fa-thin fa-arrow-right-long"></i>
                            </span>
                            <span class="icon-second">
                                <i class="fa-thin fa-arrow-right-long"></i>
                            </span>
                        </span>
                    </a>
                    </a>
                </div>
                <?php
                $i++;
                $delay++;
                endforeach; ?>
            </div>

        <?php elseif ( $settings['raizen_design_style']  == 'layout-4' ): ?>

            <div class="service-list style-four">
                <?php
                $i = 0;
                foreach (  $settings['raizen_service_list'] as $item ) :
                    if ( !empty($item['raizen_image']['url']) ) {
                        $raizen_image = !empty($item['raizen_image']['id']) ? wp_get_attachment_image_url( $item['raizen_image']['id'], '') : $item['raizen_image']['url'];
                        $raizen_image_alt = get_post_meta($item["raizen_image"]["id"], "_wp_attachment_image_alt", true);
                    }
                    $serial = $i + 1;
                ?>
                <div class="service-item">
                    <div class="row align-items-center">
                        <div class="col-md-12 col-lg-2 col-xl-3">
                            <h6 class="serial"><?php echo '{' . str_pad( esc_html( $serial ), 3, '0', STR_PAD_LEFT ) . '}'; ?></h6>
                        </div>
                        <div class="col-md-12 col-lg-6 col-xl-5">
                            <div class="content">
                                <h4 class="title">
                                    <a href="<?php echo esc_url($item['raizen_service_link']['url']); ?>">
                                        <?php echo $item['service_title']; ?>
                                    </a>
                                </h4>
                                <p><?php echo $item['service_description']; ?></p>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-4 col-xl-4">
                            <div class="thumbnail wow rotateInUpLeft" data-wow-delay="300ms">
                                <img src="<?php echo esc_url($raizen_image); ?>" alt="image">
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                $i++;
                endforeach; ?>
            </div>

        <?php elseif ( $settings['raizen_design_style']  == 'layout-5' ): ?>

            <div class="service-list style-five">
                <?php foreach (  $settings['raizen_service_list'] as $item ) :
                    if ( !empty($item['raizen_image']['url']) ) {
                        $raizen_image = !empty($item['raizen_image']['id']) ? wp_get_attachment_image_url( $item['raizen_image']['id'], '') : $item['raizen_image']['url'];
                        $raizen_image_alt = get_post_meta($item["raizen_image"]["id"], "_wp_attachment_image_alt", true);
                    }

                    if ( !empty($item['icon_image']['url']) ) {
                        $icon_image = !empty($item['icon_image']['id']) ? wp_get_attachment_image_url( $item['icon_image']['id'], '') : $item['icon_image']['url'];
                        $raizen_image_alt = get_post_meta($item["icon_image"]["id"], "_wp_attachment_image_alt", true);
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
                            <a href="<?php echo esc_url($item['raizen_service_link']['url']); ?>"><?php echo $item['service_title']; ?></a>
                            <div class="service-border"></div>
                        </div>
                        <p><?php echo $item['service_description']; ?></p>
                        <div class="service-btn">
                            <a href="<?php echo esc_url($item['raizen_service_link']['url']); ?>" class="button">
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
                            <img src="<?php echo esc_url($raizen_image); ?>" alt="image">
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
      
            </div>

        <?php endif; ?>
        <?php 
    }
}

$widgets_manager->register( new Service_List() );