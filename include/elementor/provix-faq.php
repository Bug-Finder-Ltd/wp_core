<?php
namespace ProvixCore\Widgets;

use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

class Provix_Faq extends \Elementor\Widget_Base {

	public function get_name() {
		return 'provix-faq';
	}

	public function get_title() {
		return __( 'FAQ / Your Answer', 'agenvix-core' );
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
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'layout-1' => esc_html__('Layout 1', 'agenvix-core'),
                    'layout-2' => esc_html__('Layout 2', 'agenvix-core'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        
        /**
         * Title and content section
         */
        $this->start_controls_section(
            'provix_section_title',
            [
                'label' => esc_html__('Title & Content', 'agenvix-core'),
                'condition' => [
                    'provix_design_style' => 'layout-2'
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
                    'provix_design_style' => 'layout-2'
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
                    'provix_design_style' => 'layout-2'
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
                    'provix_design_style' => 'layout-2'
                ],
            ]
        );

        $this->add_responsive_control(
            'provix_align',
            [
                'label' => esc_html__('Alignment', 'agenvix-core'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'text-left' => [
                        'title' => esc_html__('Left', 'agenvix-core'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'text-center' => [
                        'title' => esc_html__('Center', 'agenvix-core'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'text-right' => [
                        'title' => esc_html__('Right', 'agenvix-core'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'left',
                'toggle' => false,
                'condition' => [
                    'provix_design_style' => 'layout-2'
                ],
            ]
        );

        $this->add_control(
            'provix_client_box_text',
            [
                'label' => esc_html__('Client Box Text', 'agenvix-core'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('100+ Happy Clients  ', 'agenvix-core'),
                'title' => esc_html__('Enter client box text', 'agenvix-core'),
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
                'label' => esc_html__( 'Accordion', 'agenvix-core' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'accordion_title', [
                'label' => esc_html__( 'Accordion Item', 'agenvix-core' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'This is accordion item title' , 'agenvix-core' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'accordion_description',
            [
                'label' => esc_html__('Description', 'agenvix-core'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Quickly coordinate resource-leveling mindshare rather than pandemic new img Professionally empower just in time metrics for seamless total linkage. It’ an untinually impact mission-critical',
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'animation_delay',
            [
                'label'       => __( 'Animation Delay (e.g. 200ms)', 'agenvix-core' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => __( '0ms', 'agenvix-core' ),
            ]
        );

        $this->add_control(
            'accordions',
            [
                'label' => esc_html__( 'Repeater Accordion', 'agenvix-core' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'accordion_title' => esc_html__( 'Credibly initiate efficient e-commerce whereas services?', 'agenvix-core' ),
                    ],
                    [
                        'accordion_title' => esc_html__( 'How Much Does Provix Monthly Cost?', 'agenvix-core' ),
                    ],
                    [
                        'accordion_title' => esc_html__( 'What Payment Method do you Supports?', 'agenvix-core' ),
                    ]
                ],
                'title_field' => '{{{ accordion_title }}}',
            ]
        );

        $this->add_control(
            'space_accordion_item',
            [
                'label' => esc_html__( 'Accordion space gap', 'agenvix-core' ),
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

        <?php if ( $settings['provix_design_style']  == 'layout-1' ): ?>
            
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

        <?php elseif ( $settings['provix_design_style']  == 'layout-2' ): ?>
            
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
                            <p class="text"><?php echo provix_kses($item['accordion_description']); ?></p>
                        </div>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            
        <?php endif; ?>
        <?php 
	}
}

$widgets_manager->register( new Provix_Faq() );