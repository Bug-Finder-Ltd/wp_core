<?php
namespace ProtineCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Protine Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0 
 */
class Protine_Process extends Widget_Base {

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
		return 'process';
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
		return __( 'Process Step', 'protinecore' );
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
		return 'protine-icon';
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
		return [ 'protinecore' ];
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
		return [ 'protinecore' ];
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
            'protine_layout',
            [
                'label' => esc_html__('Design Layout', 'protinecore'),
            ]
        );
        $this->add_control(
            'protine_design_style',
            [
                'label' => esc_html__('Select Layout', 'protinecore'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'layout-1' => esc_html__('Layout 1', 'protinecore'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        
        /**
         * Title and content section
         */
        $this->start_controls_section(
            'protine_section_title',
            [
                'label' => esc_html__('Title & Content', 'protinecore'),
            ]
        );

        $this->add_control(
            'protine_section_title_show',
            [
                'label' => esc_html__( 'Section Title & Content', 'protinecore' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'protinecore' ),
                'label_off' => esc_html__( 'Hide', 'protinecore' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        
        $this->add_control(
            'protine_sub_title',
            [
                'label' => esc_html__('Sub Title', 'protinecore'),
                'description' => protine_get_allowed_html_desc( 'basic' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Protine Sub Title', 'protinecore'),
                'placeholder' => esc_html__('Type Sub Heading Text', 'protinecore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'protine_sub_title_color',
            [
                'label' => __( 'Sub Title Color', 'protinecore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .section-title-center-white h6' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_control(
            'protine_title',
            [
                'label' => esc_html__('Title', 'protinecore'),
                'description' => protine_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Protine Title Here', 'protinecore'),
                'placeholder' => esc_html__('Type Heading Text', 'protinecore'),
                'label_block' => true,
            ]
        );
        
        $this->add_control(
            'protine_title_color',
            [
                'label' => __( 'Title Color', 'protinecore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .section-title-center-white h3' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'protine_title_tag',
            [
                'label' => esc_html__('Title HTML Tag', 'protinecore'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'h1' => [
                        'title' => esc_html__('H1', 'protinecore'),
                        'icon' => 'eicon-editor-h1'
                    ],
                    'h2' => [
                        'title' => esc_html__('H2', 'protinecore'),
                        'icon' => 'eicon-editor-h2'
                    ],
                    'h3' => [
                        'title' => esc_html__('H3', 'protinecore'),
                        'icon' => 'eicon-editor-h3'
                    ],
                    'h4' => [
                        'title' => esc_html__('H4', 'protinecore'),
                        'icon' => 'eicon-editor-h4'
                    ],
                    'h5' => [
                        'title' => esc_html__('H5', 'protinecore'),
                        'icon' => 'eicon-editor-h5'
                    ],
                    'h6' => [
                        'title' => esc_html__('H6', 'protinecore'),
                        'icon' => 'eicon-editor-h6'
                    ]
                ],
                'default' => 'h2',
                'toggle' => false,
            ]
        );

        $this->add_responsive_control(
            'protine_align',
            [
                'label' => esc_html__('Alignment', 'protinecore'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'text-left' => [
                        'title' => esc_html__('Left', 'protinecore'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'text-center' => [
                        'title' => esc_html__('Center', 'protinecore'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'text-right' => [
                        'title' => esc_html__('Right', 'protinecore'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'left',
                'toggle' => false,
            ]
        );

        $this->add_control(
            'protine_description',
            [
                'label' => esc_html__('Description', 'protinecore'),
                'description' => protine_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Protine section description here', 'protinecore'),
                'placeholder' => esc_html__('Type section description here', 'protinecore'),
            ]
        );

        $this->add_control(
            'protine_process_bg_image',
            [
                'label' => esc_html__( 'Process Background Image', 'protinecore' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'protine_image_size',
                'default' => 'full',
                'exclude' => [
                    'custom'
                ]
            ]
        );

        $this->end_controls_section();

        
        /**
         * Process list
         */
        $this->start_controls_section(
            'protine_process',
            [
                'label' => esc_html__('Process List', 'protinecore'),
                'description' => esc_html__( 'Control all the style settings from Style tab', 'protinecore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        // process step
        $repeater->add_control(
            'protine_process_step', [
                'label' => esc_html__('Process Step', 'protinecore'),
                'description' => protine_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Step - 01', 'protinecore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'protine_process_step_color',
            [
                'label' => __( 'Step Color', 'protinecore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .counter-item span' => 'color: {{VALUE}}',
                ],
            ]
        );

        $repeater->add_control(
            'protine_process_title', [
                'label' => esc_html__('Process Title', 'protinecore'),
                'description' => protine_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Process title here', 'protinecore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'protine_process_title_color',
            [
                'label' => __( 'Process Title Color', 'protinecore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .main-item h4' => 'color: {{VALUE}}',
                ],
            ]
        );

        $repeater->add_control(
            'protine_process_description',
            [
                'label' => esc_html__('Description', 'protinecore'),
                'description' => protine_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered.',
                'label_block' => true,
            ]
        );

        $this->add_control(
            'protine_process_list',
            [
                'label' => esc_html__('Process - List', 'protinecore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'protine_process_title' => esc_html__('Start Framing', 'protinecore'),
                    ],
                    [
                        'protine_process_title' => esc_html__('Design Theme', 'protinecore')
                    ],
                    [
                        'protine_process_title' => esc_html__('Well Layer', 'protinecore')
                    ],
                    [
                        'protine_process_title' => esc_html__('Finished Work', 'protinecore')
                    ]
                ],
                'title_field' => '{{{ protine_process_title }}}',
            ]
        );
        $this->add_responsive_control(
            'protine_process_align',
            [
                'label' => esc_html__( 'Alignment', 'protinecore' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'text-left' => [
                        'title' => esc_html__( 'Left', 'protinecore' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'text-center' => [
                        'title' => esc_html__( 'Center', 'protinecore' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'text-right' => [
                        'title' => esc_html__( 'Right', 'protinecore' ),
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
				'label' => __( 'Style', 'protinecore' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'text_transform',
			[
				'label' => __( 'Text Transform', 'protinecore' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => __( 'None', 'protinecore' ),
					'uppercase' => __( 'UPPERCASE', 'protinecore' ),
					'lowercase' => __( 'lowercase', 'protinecore' ),
					'capitalize' => __( 'Capitalize', 'protinecore' ),
				],
				'selectors' => [
					'{{WRAPPER}} .title' => 'text-transform: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render the widget ouprotineut on the frontend.
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
            <!-- Counting Items Start -->
            <section class="counting-items v4 pt-0 protine-section-wrapper">
                <div class="container">
                    <div class="section-title-center-white v1">
                    <?php if ( !empty($settings['protine_sub_title']) ) : ?>
                        <h6><?php echo protine_kses( $settings['protine_sub_title'] ); ?></h6>
                    <?php endif; ?>
                    <?php
                        if ( !empty($settings['protine_title' ]) ) :
                            printf( '<%1$s %2$s>%3$s</%1$s>',
                                tag_escape( $settings['protine_title_tag'] ),
                                $this->get_render_attribute_string( 'title_args' ),
                                protine_kses( $settings['protine_title' ] )
                            );
                        endif;
                    ?>
                    </div>
                    <ul class="counter-item">
                        <?php foreach ($settings['protine_process_list'] as $key => $item) : ?> 
                            <li>
                                <span class="list-num">
                                    <?php if (!empty($item['protine_process_step' ])): ?>
                                        <?php echo protine_kses($item['protine_process_step' ]); ?>
                                    <?php endif; ?>
                                </span>
                                <div class="main-item">
                                    <?php if (!empty($item['protine_process_title' ])): ?>
                                        <h4><?php echo protine_kses($item['protine_process_title' ]); ?></h4>
                                    <?php endif; ?>
                                    <?php if (!empty($item['protine_process_description' ])): ?>
                                        <p><?php echo protine_kses($item['protine_process_description']); ?></p>
                                    <?php endif; ?>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </section>
            <!-- Counting Items End -->
        <?php 
	}
}

$widgets_manager->register( new Protine_Process() );