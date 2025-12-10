<?php
namespace RaizenCore\Widgets;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Raizen Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Raizen_Counter extends \Elementor\Widget_Base {

    public function get_name() {
        return 'raizen-counter';
    }

    public function get_title() {
        return __( 'Counter Box', 'raizencore' );
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
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'layout-1' => esc_html__('Layout 1', 'raizencore'),
                    'layout-2' => esc_html__('Layout 2', 'raizencore'),
                ],
                'default' => 'layout-1',
            ]
        );
        $this->end_controls_section();

        /**
         * Counter section
         */
        $this->start_controls_section(
            'raizen_counter_section',
            [
                'label' => esc_html__('Counters', 'raizencore'),
                'description' => esc_html__( 'Control all the style settings from Style tab', 'raizencore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'raizen_counter_title',
            [
                'label' => esc_html__('Counter Title', 'raizencore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Winning award', 'raizencore'),
                'label_block' => true,
            ]
        );
        $this->add_control(
            'description',
            [
                'label' => esc_html__('Description', 'raizencore'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('More than 07 Years in field', 'raizencore'),
                'rows' => 4,
            ]
        );

        $this->add_control(
            'raizen_count_number', [
                'label' => esc_html__('Count Number', 'raizencore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('200', 'raizencore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'raizen_count_number_post_text',
            [
                'label' => esc_html__('Counter Number Post Text', 'raizencore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('K', 'raizencore'),
                'label_block' => true,
            ]
        );
  
        $this->end_controls_section();

        /*================
         Style
        ==================*/

        $this->start_controls_section(
            'general_section',
            [
                'label' => esc_html__( 'General', 'raizencore' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
            $this->add_responsive_control(
                'text_align',
                [
                    'label' => esc_html__( 'Alignment', 'raizencore' ),
                    'type' => \Elementor\Controls_Manager::CHOOSE,
                    'options' => [
                        'start' => [
                            'title' => esc_html__( 'Left', 'raizencore' ),
                            'icon' => 'eicon-text-align-left',
                        ],
                        'center' => [
                            'title' => esc_html__( 'Center', 'raizencore' ),
                            'icon' => 'eicon-text-align-center',
                        ],
                        'end' => [
                            'title' => esc_html__( 'Right', 'raizencore' ),
                            'icon' => 'eicon-text-align-right',
                        ],
                    ],
                    'toggle' => true,
                    'selectors' => [
                        '{{WRAPPER}} .single-counter' => 'justify-content: {{VALUE}};',
                    ],
                ]
            );
        $this->end_controls_section();

        $this->start_controls_section(
            'number_section',
            [
                'label' => esc_html__( 'Number', 'raizencore' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
            $this->add_control(
                'number_color',
                [
                    'label' => esc_html__( 'Color', 'raizencore' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .single-counter .counter-box h5' => 'color: {{VALUE}}',
                        '{{WRAPPER}} .single-counter .counter-box .odometer-text' => 'color: {{VALUE}}',
                    ],
                ]
            );
            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'number_typography',
                    'selector' => '{{WRAPPER}} .single-counter .counter-box h5, .single-counter .counter-box .odometer-text',
                ]
            );
            $this->add_control(
                'number_margin',
                [
                    'label' => esc_html__( 'Margin', 'raizencore' ),
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .single-counter .counter-box h5' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .single-counter .counter-box .odometer-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

        <div class="single-counter style-one">
            <div>
                <div class="counter-box">
                    <h5 class="odometer" data-count="<?php echo raizen_kses($settings['raizen_count_number']);?>">00</h5>
                    <?php if( !empty($settings['raizen_count_number_post_text']) ) : ?>
                        <div class="odometer-text"><?php echo raizen_kses($settings['raizen_count_number_post_text']);?></div>
                    <?php endif; ?>
                </div>
                <?php if( !empty($settings['raizen_counter_title']) ) : ?>
                    <p class="text"><?php echo raizen_kses($settings['raizen_counter_title' ]); ?></p>
                <?php endif; ?>

                <?php if( !empty($settings['description']) ) : ?>
                    <p class="description"><?php echo raizen_kses($settings['description' ]); ?></p>
                <?php endif; ?>
            </div>
        </div>

    <?php elseif ( $settings['raizen_design_style']  == 'layout-2' ) : ?>

        <div class="single-counter style-two">
            <div class="wrapper">
                <div class="counter-box">
                    <h2 class="odometer" data-count="<?php echo raizen_kses($settings['raizen_count_number']);?>">00</h2>
                    <h2 class="odometer-text"><?php echo raizen_kses($settings['raizen_count_number_post_text']);?></h2>
                </div>
                <p class="text"><?php echo raizen_kses($settings['raizen_counter_title' ]); ?></p>
            </div>
        </div>

    <?php endif; ?>
       
        <?php 
    }
}

$widgets_manager->register( new Raizen_Counter() );