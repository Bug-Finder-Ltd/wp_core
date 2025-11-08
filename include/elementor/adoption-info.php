<?php
namespace ZupetCore\Widgets;

if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * Zupet Core
 *
 * Elementor widget for heading.
 *
 * @since 1.0.0
 */
class Adoption_Info extends \Elementor\Widget_Base {

	public function get_name() {
		return 'adoption-info';
	}

	public function get_title() {
		return __( 'Adoption Info', 'zupetcore' );
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
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'layout-1' => esc_html__('Layout 1', 'zupetcore'),
                    'layout-2' => esc_html__('Layout 2', 'zupetcore'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        
        /**
         * Title and content section
         */
        $this->start_controls_section(
            'name_designation',
            [
                'label' => esc_html__('Name & Designation', 'zupetcore'),
            ]
        );
        
        $this->add_control(
            'name',
            [
                'label' => esc_html__('Name', 'zupetcore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Tommy', 'zupetcore'),
                'placeholder' => esc_html__('Type text', 'zupetcore'),
                'label_block' => true,
            ]
        );
        $this->add_control(
            'designation',
            [
                'label' => esc_html__('Designation', 'zupetcore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('(Cocker Spaniel)', 'zupetcore'),
                'placeholder' => esc_html__('Type text', 'zupetcore'),
                'label_block' => true,
            ]
        );
        $this->add_control(
            'short_description',
            [
                'label' => esc_html__('Description', 'zupetcore'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Meet Tommy, a loving and playful dog ready for his forever home. With a gentle heart and joyful spirit, he brings endless happiness.', 'zupetcore'),
                'placeholder' => esc_html__('Type text', 'zupetcore'),
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'meta_section',
            [
                'label' => esc_html__( 'Meta', 'zupetcore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'list_title',
            [
                'label' => esc_html__( 'Title', 'zupetcore' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'List Title' , 'zupetcore' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'list',
            [
                'label' => esc_html__( 'Repeater List', 'zupetcore' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'list_title' => esc_html__( 'Title #1', 'zupetcore' ),
                    ],
                    [
                        'list_title' => esc_html__( 'Title #2', 'zupetcore' ),
                    ],
                ],
                'title_field' => '{{{ list_title }}}',
            ]
        );

        $this->end_controls_section();

        /**
         * Style section
         */

        $this->start_controls_section(
            'general_section',
            [
                'label' => esc_html__( 'General', 'zupetcore' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'text_alignment',
            [
                'label' => esc_html__( 'Alignment', 'zupetcore' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => '',
                'options' => [
                    '' => esc_html__( 'Left', 'zupetcore' ),
                    'center'  => esc_html__( 'Center', 'zupetcore' ),
                    'right' => esc_html__( 'Right', 'zupetcore' ),
                ],
            ]
        );
        $this->add_responsive_control(
            'width',
            [
                'label' => esc_html__( 'Width', 'zupetcore' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
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
                    '{{WRAPPER}} .heading-text .heading' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'heading_style',
            [
                'label' => esc_html__( 'Heading', 'zupetcore' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
            $this->add_control(
                'heading_color',
                [
                    'label' => esc_html__( 'Color', 'zupetcore' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .heading-text .heading' => 'color: {{VALUE}}',
                    ],
                ]
            );
            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'heading_typography',
                    'selector' => '{{WRAPPER}} .heading-text .heading',
                ]
            );
            $this->add_control(
                'heading_margin',
                [
                    'label' => esc_html__( 'Margin', 'zupetcore' ),
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .heading-text .heading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

        $this->add_render_attribute( 'heading_text', 'class', 'heading' );

        ?>

		<?php if ( $settings['zupet_design_style']  == 'layout-1' ): ?>

            <div class="adoption-info style-one <?php echo $settings['text_alignment']; ?>">
                <div class="title">
                    <h2 class="name"><?php echo $settings['name']; ?></h2>
                    <span class="designation"><?php echo $settings['designation']; ?></span>
                </div>
                <p class="description"><?php echo $settings['short_description']; ?></p>
                <ul>
                    <?php
                    $delay = 100;
                    $increment = 100;
                    foreach (  $settings['list'] as $key => $item ) :
                        $current_delay = $delay + ( $key * $increment );
                    ?>
                        <li class="wow fadeInDown" data-wow-delay="<?php echo esc_attr( $current_delay ); ?>ms" data-wow-duration="1000ms"><?php echo $item['list_title']; ?></li>
                    <?php endforeach;?>
                </ul>
            </div>

		<?php elseif( $settings['zupet_design_style']  == 'layout-2' ): ?>

            <div class="section-subtitle style-one <?php echo $settings['text_alignment']; ?>">
                <h2 class="subtitle">
                    <span><?php echo $settings['zupet_subtitle']; ?></span>
                </h2>
            </div>

        <?php endif; ?>

        <?php 
	}
}

$widgets_manager->register( new Adoption_Info() );