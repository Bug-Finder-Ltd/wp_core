<?php
namespace ZupetCore\Widgets;

use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

class Zupet_Faq extends \Elementor\Widget_Base {

	public function get_name() {
		return 'zupet-faq';
	}

	public function get_title() {
		return __( 'FAQ / Your Answer', 'zupetcore' );
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

        
        /**
         * Title and content section
         */
        $this->start_controls_section(
            'zupet_section_title',
            [
                'label' => esc_html__('Title & Content', 'zupetcore'),
                'condition' => [
                    'zupet_design_style' => 'layout-2'
                ],
            ]
        );
        
        $this->add_control(
            'zupet_title',
            [
                'label' => esc_html__('Title', 'zupetcore'),
                'description' => zupet_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Zupet Title Here', 'zupetcore'),
                'placeholder' => esc_html__('Type Heading Text', 'zupetcore'),
                'label_block' => true,
                'condition' => [
                    'zupet_design_style' => 'layout-2'
                ],
            ]
        );

        $this->add_control(
            'zupet_title_color',
            [
                'label' => __( 'Title Color', 'zupetcore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .common-title h3' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'zupet_design_style' => 'layout-2'
                ],
            ]
        );
 
        $this->add_control(
            'zupet_title_tag',
            [
                'label' => esc_html__('Title HTML Tag', 'zupetcore'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'h1' => [
                        'title' => esc_html__('H1', 'zupetcore'),
                        'icon' => 'eicon-editor-h1'
                    ],
                    'h2' => [
                        'title' => esc_html__('H2', 'zupetcore'),
                        'icon' => 'eicon-editor-h2'
                    ],
                    'h3' => [
                        'title' => esc_html__('H3', 'zupetcore'),
                        'icon' => 'eicon-editor-h3'
                    ],
                    'h4' => [
                        'title' => esc_html__('H4', 'zupetcore'),
                        'icon' => 'eicon-editor-h4'
                    ],
                    'h5' => [
                        'title' => esc_html__('H5', 'zupetcore'),
                        'icon' => 'eicon-editor-h5'
                    ],
                    'h6' => [
                        'title' => esc_html__('H6', 'zupetcore'),
                        'icon' => 'eicon-editor-h6'
                    ]
                ],
                'default' => 'h2',
                'toggle' => false,
                'condition' => [
                    'zupet_design_style' => 'layout-2'
                ],
            ]
        );

        $this->add_responsive_control(
            'zupet_align',
            [
                'label' => esc_html__('Alignment', 'zupetcore'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'text-left' => [
                        'title' => esc_html__('Left', 'zupetcore'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'text-center' => [
                        'title' => esc_html__('Center', 'zupetcore'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'text-right' => [
                        'title' => esc_html__('Right', 'zupetcore'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'left',
                'toggle' => false,
                'condition' => [
                    'zupet_design_style' => 'layout-2'
                ],
            ]
        );

        $this->add_control(
            'zupet_client_box_text',
            [
                'label' => esc_html__('Client Box Text', 'zupetcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('100+ Happy Clients  ', 'zupetcore'),
                'title' => esc_html__('Enter client box text', 'zupetcore'),
                'label_block' => true,
            ]
        );

        $this->end_controls_section();

        
        /**
         * FAQ accordin
         */
		$this->start_controls_section(
            '_accordion',
            [
                'label' => esc_html__( 'Accordion', 'zupetcore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'accordion_title', [
                'label' => esc_html__( 'Accordion Item', 'zupetcore' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'This is accordion item title' , 'zupetcore' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'accordion_description',
            [
                'label' => esc_html__('Description', 'zupetcore'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Quickly coordinate resource-leveling mindshare rather than pandemic new img Professionally empower just in time metrics for seamless total linkage. It’ an untinually impact mission-critical',
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'animation_delay',
            [
                'label'       => __( 'Animation Delay (e.g. 200ms)', 'zupetcore' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => __( '0ms', 'zupetcore' ),
            ]
        );

        $this->add_control(
            'accordions',
            [
                'label' => esc_html__( 'Repeater Accordion', 'zupetcore' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'accordion_title' => esc_html__( 'Credibly initiate efficient e-commerce whereas services?', 'zupetcore' ),
                    ],
                    [
                        'accordion_title' => esc_html__( 'How Much Does Zupet Monthly Cost?', 'zupetcore' ),
                    ],
                    [
                        'accordion_title' => esc_html__( 'What Payment Method do you Supports?', 'zupetcore' ),
                    ]
                ],
                'title_field' => '{{{ accordion_title }}}',
            ]
        );

        $this->add_control(
            'space_accordion_item',
            [
                'label' => esc_html__( 'Accordion space gap', 'zupetcore' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rn-card + .rn-card' => 'margin-top: {{SIZE}}{{UNIT}};',
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
            
            <div class="faq-accordion style-one">
                <div class="accordion" id="accordionExample">
                    <?php
                    $count = 1;
                    foreach ( $settings['accordions'] as $faq ) :
                        $collapse_id = 'collapse' . $count;
                        $show_class  = ( 1 === $count ) ? 'show' : '';
                        $collapsed   = ( 1 === $count ) ? '' : 'collapsed';
                        ?>
                        <div class="accordion-item wow fadeInLeft" data-wow-delay="<?php echo esc_attr( $faq['animation_delay'] ); ?>" data-wow-duration="2000ms">
                            <h2 class="accordion-header">
                                <button class="accordion-button <?php echo esc_attr( $collapsed ); ?>" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo esc_attr( $collapse_id ); ?>" aria-expanded="<?php echo ( 1 === $count ) ? 'true' : 'false'; ?>" aria-controls="<?php echo esc_attr( $collapse_id ); ?>">
                                    <?php echo esc_html( $faq['accordion_title'] ); ?>
                                </button>
                            </h2>
                            <div id="<?php echo esc_attr( $collapse_id ); ?>" class="accordion-collapse collapse <?php echo esc_attr( $show_class ); ?>" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p><?php echo esc_html( $faq['accordion_description'] ); ?></p>
                                </div>
                            </div>
                        </div>
                        <?php
                        $count++;
                    endforeach;
                    ?>
                </div>
            </div>

        <?php elseif ( $settings['zupet_design_style']  == 'layout-2' ): ?>
            
            <div class="accordion-wrap">
                <ul class="accordion-box acc_style_h4">
                    <?php foreach ($settings['accordions'] as $index => $item) : ?>
                    <li class="accordion block <?php echo $index === 0 ? 'active-block' : ''; ?>">
                        <div class="acc-btn <?php echo $index === 0 ? 'active' : ''; ?>">
                            <div class="icon-box">
                                <div class="icon icon_1">                                            
                                    <i class="fas fa-plus"></i>
                                </div>
                                <div class="icon icon_2">
                                    <i class="fas fa-minus"></i>
                                </div>
                            </div>
                            <h4><?php echo esc_html($item['accordion_title']); ?></h4>
                        </div>
                        <div class="acc-content <?php echo $index === 0 ? 'current' : ''; ?>">
                            <p class="text"><?php echo zupet_kses($item['accordion_description']); ?></p>
                        </div>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            
        <?php endif; ?>
        <?php 
	}
}

$widgets_manager->register( new Zupet_Faq() );