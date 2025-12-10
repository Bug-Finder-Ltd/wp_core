<?php
namespace RaizenCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Raizen Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0 
 */
class Raizen_Process extends Widget_Base {

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
		return __( 'Process Step', 'raizencore' );
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
		return 'raizen-icon';
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
		return [ 'raizencore' ];
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
		return [ 'raizencore' ];
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
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        
        /**
         * Title and content section
         */
        $this->start_controls_section(
            'raizen_section_title',
            [
                'label' => esc_html__('Title & Content', 'raizencore'),
            ]
        );

        $this->add_control(
            'raizen_section_title_show',
            [
                'label' => esc_html__( 'Section Title & Content', 'raizencore' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'raizencore' ),
                'label_off' => esc_html__( 'Hide', 'raizencore' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        
        $this->add_control(
            'raizen_sub_title',
            [
                'label' => esc_html__('Sub Title', 'raizencore'),
                'description' => raizen_get_allowed_html_desc( 'basic' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Raizen Sub Title', 'raizencore'),
                'placeholder' => esc_html__('Type Sub Heading Text', 'raizencore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'raizen_sub_title_color',
            [
                'label' => __( 'Sub Title Color', 'raizencore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .section-title-center-white h6' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_control(
            'raizen_title',
            [
                'label' => esc_html__('Title', 'raizencore'),
                'description' => raizen_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Raizen Title Here', 'raizencore'),
                'placeholder' => esc_html__('Type Heading Text', 'raizencore'),
                'label_block' => true,
            ]
        );
        
        $this->add_control(
            'raizen_title_color',
            [
                'label' => __( 'Title Color', 'raizencore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .section-title-center-white h3' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'raizen_title_tag',
            [
                'label' => esc_html__('Title HTML Tag', 'raizencore'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'h1' => [
                        'title' => esc_html__('H1', 'raizencore'),
                        'icon' => 'eicon-editor-h1'
                    ],
                    'h2' => [
                        'title' => esc_html__('H2', 'raizencore'),
                        'icon' => 'eicon-editor-h2'
                    ],
                    'h3' => [
                        'title' => esc_html__('H3', 'raizencore'),
                        'icon' => 'eicon-editor-h3'
                    ],
                    'h4' => [
                        'title' => esc_html__('H4', 'raizencore'),
                        'icon' => 'eicon-editor-h4'
                    ],
                    'h5' => [
                        'title' => esc_html__('H5', 'raizencore'),
                        'icon' => 'eicon-editor-h5'
                    ],
                    'h6' => [
                        'title' => esc_html__('H6', 'raizencore'),
                        'icon' => 'eicon-editor-h6'
                    ]
                ],
                'default' => 'h2',
                'toggle' => false,
            ]
        );

        $this->add_responsive_control(
            'raizen_align',
            [
                'label' => esc_html__('Alignment', 'raizencore'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'text-left' => [
                        'title' => esc_html__('Left', 'raizencore'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'text-center' => [
                        'title' => esc_html__('Center', 'raizencore'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'text-right' => [
                        'title' => esc_html__('Right', 'raizencore'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'left',
                'toggle' => false,
            ]
        );

        $this->add_control(
            'raizen_description',
            [
                'label' => esc_html__('Description', 'raizencore'),
                'description' => raizen_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Raizen section description here', 'raizencore'),
                'placeholder' => esc_html__('Type section description here', 'raizencore'),
            ]
        );

        $this->add_control(
            'raizen_process_bg_image',
            [
                'label' => esc_html__( 'Process Background Image', 'raizencore' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'raizen_image_size',
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
            'raizen_process',
            [
                'label' => esc_html__('Process List', 'raizencore'),
                'description' => esc_html__( 'Control all the style settings from Style tab', 'raizencore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        // process step
        $repeater->add_control(
            'raizen_process_step', [
                'label' => esc_html__('Process Step', 'raizencore'),
                'description' => raizen_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Step - 01', 'raizencore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'raizen_process_step_color',
            [
                'label' => __( 'Step Color', 'raizencore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .counter-item span' => 'color: {{VALUE}}',
                ],
            ]
        );

        $repeater->add_control(
            'raizen_process_title', [
                'label' => esc_html__('Process Title', 'raizencore'),
                'description' => raizen_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Process title here', 'raizencore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'raizen_process_title_color',
            [
                'label' => __( 'Process Title Color', 'raizencore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .main-item h4' => 'color: {{VALUE}}',
                ],
            ]
        );

        $repeater->add_control(
            'raizen_process_description',
            [
                'label' => esc_html__('Description', 'raizencore'),
                'description' => raizen_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered.',
                'label_block' => true,
            ]
        );

        $this->add_control(
            'raizen_process_list',
            [
                'label' => esc_html__('Process - List', 'raizencore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'raizen_process_title' => esc_html__('Start Framing', 'raizencore'),
                    ],
                    [
                        'raizen_process_title' => esc_html__('Design Theme', 'raizencore')
                    ],
                    [
                        'raizen_process_title' => esc_html__('Well Layer', 'raizencore')
                    ],
                    [
                        'raizen_process_title' => esc_html__('Finished Work', 'raizencore')
                    ]
                ],
                'title_field' => '{{{ raizen_process_title }}}',
            ]
        );
        $this->add_responsive_control(
            'raizen_process_align',
            [
                'label' => esc_html__( 'Alignment', 'raizencore' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'text-left' => [
                        'title' => esc_html__( 'Left', 'raizencore' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'text-center' => [
                        'title' => esc_html__( 'Center', 'raizencore' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'text-right' => [
                        'title' => esc_html__( 'Right', 'raizencore' ),
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
            <!-- Counting Items Start -->
            <section class="counting-items v4 pt-0 raizen-section-wrapper">
                <div class="container">
                    <div class="section-title-center-white v1">
                    <?php if ( !empty($settings['raizen_sub_title']) ) : ?>
                        <h6><?php echo raizen_kses( $settings['raizen_sub_title'] ); ?></h6>
                    <?php endif; ?>
                    <?php
                        if ( !empty($settings['raizen_title' ]) ) :
                            printf( '<%1$s %2$s>%3$s</%1$s>',
                                tag_escape( $settings['raizen_title_tag'] ),
                                $this->get_render_attribute_string( 'title_args' ),
                                raizen_kses( $settings['raizen_title' ] )
                            );
                        endif;
                    ?>
                    </div>
                    <ul class="counter-item">
                        <?php foreach ($settings['raizen_process_list'] as $key => $item) : ?> 
                            <li>
                                <span class="list-num">
                                    <?php if (!empty($item['raizen_process_step' ])): ?>
                                        <?php echo raizen_kses($item['raizen_process_step' ]); ?>
                                    <?php endif; ?>
                                </span>
                                <div class="main-item">
                                    <?php if (!empty($item['raizen_process_title' ])): ?>
                                        <h4><?php echo raizen_kses($item['raizen_process_title' ]); ?></h4>
                                    <?php endif; ?>
                                    <?php if (!empty($item['raizen_process_description' ])): ?>
                                        <p><?php echo raizen_kses($item['raizen_process_description']); ?></p>
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

$widgets_manager->register( new Raizen_Process() );