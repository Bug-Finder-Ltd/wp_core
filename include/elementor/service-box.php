<?php
namespace RaizenCore\Widgets;

use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Raizen Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Raizen_Service_Box extends \Elementor\Widget_Base {

    public function get_name() {
        return 'raizen-service-box';
    }

    public function get_title() {
        return __( 'Service Box', 'raizencore' );
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
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        /**
         * Icon section
         */
        $this->start_controls_section(
            'icon_section',
            [
                'label' => esc_html__('Icon', 'raizencore'),
            ]
        );
        
        $this->add_control(
            'choose_icon',
            [
                'label' => esc_html__( 'Alignment', 'raizencore' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'img_icon' => [
                        'title' => esc_html__( 'Image', 'raizencore' ),
                        'icon' => 'eicon-image',
                    ],
                    'icon' => [
                        'title' => esc_html__( 'Icon', 'raizencore' ),
                        'icon' => 'eicon-favorite',
                    ],
                ],
                'default' => 'icon',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .your-class' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'service_icon',
            [
                'label' => esc_html__( 'Icon', 'raizencore' ),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-circle',
                    'library' => 'fa-solid',
                ],
                'recommended' => [
                    'fa-solid' => [
                        'circle',
                        'dot-circle',
                        'square-full',
                    ],
                    'fa-regular' => [
                        'circle',
                        'dot-circle',
                        'square-full',
                    ],
                ],
                'condition' => [
                    'choose_icon' => 'icon',
                ],
            ]
        );
        $this->add_control(
            'service_image_icon',
            [
                'label' => esc_html__( 'Choose Image', 'raizencore' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'choose_icon' => 'img_icon',
                ],
            ]
        );
        $this->end_controls_section();

        /**
         * Title and content section
         */
        $this->start_controls_section(
            'title_description_section',
            [
                'label' => esc_html__('Title & Description', 'raizencore'),
            ]
        );

        
        $this->add_control(
            'service_title',
            [
                'label' => esc_html__('Title', 'raizencore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Raizen Title Here', 'raizencore'),
                'placeholder' => esc_html__('Type Heading Text', 'raizencore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'service_description',
            [
                'label' => esc_html__('Description', 'raizencore'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Dynamically deliver multidisciplinary infrastructures via revolution process improvements. Competently orchestrate turnkey ideas his manufactured products deliverables premium after just in time scenarios.', 'raizencore'),
                'placeholder' => esc_html__('Type description text', 'raizencore'),
            ]
        );

        $this->end_controls_section();


        /**
         * Show all button
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
            'button_text',
            [
                'label' => esc_html__('Button Text', 'raizencore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('View Details', 'raizencore'),
                'title' => esc_html__('Enter show all button text here', 'raizencore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'button_link',
            [
                'label' => esc_html__('Button link', 'raizencore'),
                'type' => Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => esc_html__('https://your-link.com', 'raizencore'),
                'default' => [
                    'url' => '#',
                    'is_external' => true,
                    'nofollow' => true,
                    'custom_attributes' => '',
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

        <?php if ( $settings['raizen_design_style']  == 'layout-1' ):
            if ( !empty($settings['service_image_icon']['url']) ) {
                $service_icon = !empty($settings['service_image_icon']['id']) ? wp_get_attachment_image_url( $settings['service_image_icon']['id'], '') : $settings['service_image_icon']['url'];
                $raizen_image_alt = get_post_meta($settings["service_image_icon"]["id"], "_wp_attachment_image_alt", true);
            }
            ?>

            <div class="service-box style-one">
                <div class="icon">
                    <?php if( !empty($service_icon) ) : ?>
                        <img src="<?php echo esc_url($service_icon); ?>" alt="">
                    <?php endif; ?>
                    <?php \Elementor\Icons_Manager::render_icon( $settings['service_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                </div>
                <div class="content">
                    <h4 class="title"><?php echo wp_kses_post($settings['service_title']); ?></h4>

                    <?php if( !empty($settings['service_description']) ) : ?>
                        <p class="description"><?php echo wp_kses_post($settings['service_description']); ?></p>
                    <?php endif; ?>
                    
                    <?php if( !empty($settings['button_text']) ) : ?>
                        <a class="button" href="<?php echo esc_url($settings['button_link']['url']); ?>">
                            <?php echo $settings['button_text']; ?>
                        </a>
                    <?php endif; ?>
                </div>
            </div>

        <?php elseif ( $settings['raizen_design_style']  == 'layout-2' ):
            if ( !empty($settings['raizen_image']['url']) ) {
                $raizen_image = !empty($settings['raizen_image']['id']) ? wp_get_attachment_image_url( $settings['raizen_image']['id'], $settings['raizen_image_size_size']) : $settings['raizen_image']['url'];
                $raizen_image_alt = get_post_meta($settings["raizen_image"]["id"], "_wp_attachment_image_alt", true);
            }
        ?>
            <!-- service 2 -->
            <div class="service-two">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="service-two-left-container">
                                <div class="common-title">
                                    <?php if ( !empty($settings['raizen_section_title_show']) ) : ?>
                                        <?php 
                                            if ( !empty($settings['raizen_title' ]) ) :
                                                printf( '<%1$s %2$s>%3$s</%1$s>',
                                                tag_escape( $settings['raizen_title_tag'] ),
                                                $this->get_render_attribute_string( 'title_args' ),
                                                raizen_kses( $settings['raizen_title' ] )
                                            );
                                            endif;
                                        ?>
                                    <?php endif; ?>
                                    <?php if ( !empty($settings['raizen_description']) ) : ?>    
                                        <p><?php echo raizen_kses( $settings['raizen_description'] ); ?></p>
                                    <?php endif; ?>
                                </div>
                                <div class="service-two-image">
                                    <?php if ($settings['raizen_image']['url'] || $settings['raizen_image']['id']) : ?>
                                        <img src="<?php echo esc_url($raizen_image); ?>" alt="<?php echo esc_attr($raizen_image); ?>">
                                    <?php endif; ?>
                                </div>
                                <div class="about-two-round-text">
                                    <div class="round-box-content">
                                        <span class="curved-circle"><?php echo raizen_kses($settings['text_inside_circle']); ?> </span>
                                        <div class="round-box-icon">
                                            <?php if ( ! empty( $settings['raizen_show_all_btn_link']['url'] ) ) : ?>
                                                <a href="<?php echo esc_url($settings['raizen_show_all_btn_link']['url'] ); ?>">
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
                                <?php foreach ($settings['raizen_service_list'] as $key => $item) : 
                                    if ('2' == $item['raizen_services_link_type']) {
                                        $link = get_permalink($item['raizen_services_page_link']);
                                        $target = '_self';
                                        $rel = 'nofollow';
                                    } else {
                                        $link = !empty($item['raizen_services_link']['url']) ? $item['raizen_services_link']['url'] : '';
                                        $target = !empty($item['raizen_services_link']['is_external']) ? '_blank' : '_self';
                                        $rel = !empty($item['raizen_services_link']['nofollow']) ? 'nofollow' : '';
                                    } 
                                    ?>
                                    <div class="service-two-right-single">
                                        <?php if (!empty($link)) : ?>
                                            <a target="<?php echo esc_attr($target); ?>" href="<?php echo esc_url($link); ?>"><span><?php echo esc_html($key+1);?></span> <?php echo raizen_kses($item['raizen_service_title']); ?></a>
                                        <?php endif; ?>
                                        <?php if (!empty($item['raizen_service_description' ])): ?>
                                            <p ><?php echo raizen_kses($item['raizen_service_description']); ?></p>
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

$widgets_manager->register( new Raizen_Service_Box() );