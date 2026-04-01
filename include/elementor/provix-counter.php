<?php
namespace ProvixCore\Widgets;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Provix Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Provix_Counter extends \Elementor\Widget_Base {

    public function get_name() {
        return 'provix-counter';
    }

    public function get_title() {
        return __( 'Provix Counters', 'agenvix-core' );
    }

    public function get_icon() {
        return 'provix-icon';
    }

    public function get_categories() {
        return [ 'agenvix-core' ];
    }

    public function get_script_depends() {
        return [ 'agenvix-core' ];
    }

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
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'layout-1' => esc_html__('Layout 1', 'agenvix-core'),
                    'layout-2' => esc_html__('Layout 2', 'agenvix-core'),
                ],
                'default' => 'layout-1',
            ]
        );
        $this->end_controls_section();

        /**
         * Counter section
         */
        $this->start_controls_section(
            'provix_counter_section',
            [
                'label' => esc_html__('Counters', 'agenvix-core'),
                'description' => esc_html__( 'Control all the style settings from Style tab', 'agenvix-core' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();


        $this->add_control(
            'provix_counter_title',
            [
                'label' => esc_html__('Counter Title', 'agenvix-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Winning award', 'agenvix-core'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'provix_count_number', [
                'label' => esc_html__('Count Number', 'agenvix-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('200', 'agenvix-core'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'provix_count_number_post_text',
            [
                'label' => esc_html__('Counter Number Post Text', 'agenvix-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('K', 'agenvix-core'),
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
                'label' => esc_html__( 'General', 'agenvix-core' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
            $this->add_responsive_control(
                'text_align',
                [
                    'label' => esc_html__( 'Alignment', 'agenvix-core' ),
                    'type' => \Elementor\Controls_Manager::CHOOSE,
                    'options' => [
                        'start' => [
                            'title' => esc_html__( 'Left', 'agenvix-core' ),
                            'icon' => 'eicon-text-align-left',
                        ],
                        'center' => [
                            'title' => esc_html__( 'Center', 'agenvix-core' ),
                            'icon' => 'eicon-text-align-center',
                        ],
                        'end' => [
                            'title' => esc_html__( 'Right', 'agenvix-core' ),
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
                'label' => esc_html__( 'Number', 'agenvix-core' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
            $this->add_control(
                'number_color',
                [
                    'label' => esc_html__( 'Color', 'agenvix-core' ),
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
                    'label' => esc_html__( 'Margin', 'agenvix-core' ),
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
        
        <?php if ( $settings['provix_design_style']  == 'layout-1' ): ?>

        <div class="single-counter style-one">
            <div>
                <div class="counter-box">
                    <h5 class="odometer" data-count="<?php echo provix_kses($settings['provix_count_number']);?>">00</h5>
                    <div class="odometer-text"><?php echo provix_kses($settings['provix_count_number_post_text']);?></div>
                </div>
                <p class="text"><?php echo provix_kses($settings['provix_counter_title' ]); ?></p>
            </div>
        </div>

    <?php elseif ( $settings['provix_design_style']  == 'layout-2' ) : ?>

        <div class="single-counter style-two">
            <div class="counter-box">
                <h5 class="odometer" data-count="<?php echo provix_kses($settings['provix_count_number']);?>">00</h5>
                <div class="odometer-text"><?php echo provix_kses($settings['provix_count_number_post_text']);?></div>
            </div>
            <p class="text"><?php echo provix_kses($settings['provix_counter_title' ]); ?></p>
        </div>

    <?php endif; ?>
       
        <?php 
    }
}

$widgets_manager->register( new Provix_Counter() );