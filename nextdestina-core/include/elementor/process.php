<?php
namespace NextdestinaCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Nextdestina Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0 
 */
class Nextdestina_Process extends Widget_Base {

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
		return __( 'Process Step', 'nextdestinacore' );
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
		return 'nextdestina-icon';
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
		return [ 'nextdestinacore' ];
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
		return [ 'nextdestinacore' ];
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
            'nextdestina_layout',
            [
                'label' => esc_html__('Design Layout', 'nextdestinacore'),
            ]
        );
        $this->add_control(
            'nextdestina_design_style',
            [
                'label' => esc_html__('Select Layout', 'nextdestinacore'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'layout-1' => esc_html__('Layout 1', 'nextdestinacore'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        
        /**
         * Title and content section
         */
        $this->start_controls_section(
            'nextdestina_section_title',
            [
                'label' => esc_html__('Title & Content', 'nextdestinacore'),
            ]
        );

        $this->add_control(
            'nextdestina_section_title_show',
            [
                'label' => esc_html__( 'Section Title & Content', 'nextdestinacore' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'nextdestinacore' ),
                'label_off' => esc_html__( 'Hide', 'nextdestinacore' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        
        $this->add_control(
            'nextdestina_sub_title',
            [
                'label' => esc_html__('Sub Title', 'nextdestinacore'),
                'description' => nextdestina_get_allowed_html_desc( 'basic' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Nextdestina Sub Title', 'nextdestinacore'),
                'placeholder' => esc_html__('Type Sub Heading Text', 'nextdestinacore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'nextdestina_sub_title_color',
            [
                'label' => __( 'Sub Title Color', 'nextdestinacore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .section-title-center-white h6' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_control(
            'nextdestina_title',
            [
                'label' => esc_html__('Title', 'nextdestinacore'),
                'description' => nextdestina_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Nextdestina Title Here', 'nextdestinacore'),
                'placeholder' => esc_html__('Type Heading Text', 'nextdestinacore'),
                'label_block' => true,
            ]
        );
        
        $this->add_control(
            'nextdestina_title_color',
            [
                'label' => __( 'Title Color', 'nextdestinacore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .section-title-center-white h3' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'nextdestina_title_tag',
            [
                'label' => esc_html__('Title HTML Tag', 'nextdestinacore'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'h1' => [
                        'title' => esc_html__('H1', 'nextdestinacore'),
                        'icon' => 'eicon-editor-h1'
                    ],
                    'h2' => [
                        'title' => esc_html__('H2', 'nextdestinacore'),
                        'icon' => 'eicon-editor-h2'
                    ],
                    'h3' => [
                        'title' => esc_html__('H3', 'nextdestinacore'),
                        'icon' => 'eicon-editor-h3'
                    ],
                    'h4' => [
                        'title' => esc_html__('H4', 'nextdestinacore'),
                        'icon' => 'eicon-editor-h4'
                    ],
                    'h5' => [
                        'title' => esc_html__('H5', 'nextdestinacore'),
                        'icon' => 'eicon-editor-h5'
                    ],
                    'h6' => [
                        'title' => esc_html__('H6', 'nextdestinacore'),
                        'icon' => 'eicon-editor-h6'
                    ]
                ],
                'default' => 'h2',
                'toggle' => false,
            ]
        );

        $this->add_responsive_control(
            'nextdestina_align',
            [
                'label' => esc_html__('Alignment', 'nextdestinacore'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'text-left' => [
                        'title' => esc_html__('Left', 'nextdestinacore'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'text-center' => [
                        'title' => esc_html__('Center', 'nextdestinacore'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'text-right' => [
                        'title' => esc_html__('Right', 'nextdestinacore'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'left',
                'toggle' => false,
            ]
        );

        $this->add_control(
            'nextdestina_description',
            [
                'label' => esc_html__('Description', 'nextdestinacore'),
                'description' => nextdestina_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Nextdestina section description here', 'nextdestinacore'),
                'placeholder' => esc_html__('Type section description here', 'nextdestinacore'),
            ]
        );

        $this->add_control(
            'nextdestina_process_bg_image',
            [
                'label' => esc_html__( 'Process Background Image', 'nextdestinacore' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'nextdestina_image_size',
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
            'nextdestina_process',
            [
                'label' => esc_html__('Process List', 'nextdestinacore'),
                'description' => esc_html__( 'Control all the style settings from Style tab', 'nextdestinacore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        // process step
        $repeater->add_control(
            'nextdestina_process_step', [
                'label' => esc_html__('Process Step', 'nextdestinacore'),
                'description' => nextdestina_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Step - 01', 'nextdestinacore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'nextdestina_process_step_color',
            [
                'label' => __( 'Step Color', 'nextdestinacore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .counter-item span' => 'color: {{VALUE}}',
                ],
            ]
        );

        $repeater->add_control(
            'nextdestina_process_title', [
                'label' => esc_html__('Process Title', 'nextdestinacore'),
                'description' => nextdestina_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Process title here', 'nextdestinacore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'nextdestina_process_title_color',
            [
                'label' => __( 'Process Title Color', 'nextdestinacore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .main-item h4' => 'color: {{VALUE}}',
                ],
            ]
        );

        $repeater->add_control(
            'nextdestina_process_description',
            [
                'label' => esc_html__('Description', 'nextdestinacore'),
                'description' => nextdestina_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered.',
                'label_block' => true,
            ]
        );

        $this->add_control(
            'nextdestina_process_list',
            [
                'label' => esc_html__('Process - List', 'nextdestinacore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'nextdestina_process_title' => esc_html__('Start Framing', 'nextdestinacore'),
                    ],
                    [
                        'nextdestina_process_title' => esc_html__('Design Theme', 'nextdestinacore')
                    ],
                    [
                        'nextdestina_process_title' => esc_html__('Well Layer', 'nextdestinacore')
                    ],
                    [
                        'nextdestina_process_title' => esc_html__('Finished Work', 'nextdestinacore')
                    ]
                ],
                'title_field' => '{{{ nextdestina_process_title }}}',
            ]
        );
        $this->add_responsive_control(
            'nextdestina_process_align',
            [
                'label' => esc_html__( 'Alignment', 'nextdestinacore' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'text-left' => [
                        'title' => esc_html__( 'Left', 'nextdestinacore' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'text-center' => [
                        'title' => esc_html__( 'Center', 'nextdestinacore' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'text-right' => [
                        'title' => esc_html__( 'Right', 'nextdestinacore' ),
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
				'label' => __( 'Style', 'nextdestinacore' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'text_transform',
			[
				'label' => __( 'Text Transform', 'nextdestinacore' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => __( 'None', 'nextdestinacore' ),
					'uppercase' => __( 'UPPERCASE', 'nextdestinacore' ),
					'lowercase' => __( 'lowercase', 'nextdestinacore' ),
					'capitalize' => __( 'Capitalize', 'nextdestinacore' ),
				],
				'selectors' => [
					'{{WRAPPER}} .title' => 'text-transform: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render the widget ounextdestinaut on the frontend.
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
            <section class="counting-items v4 pt-0 nextdestina-section-wrapper">
                <div class="container">
                    <div class="section-title-center-white v1">
                    <?php if ( !empty($settings['nextdestina_sub_title']) ) : ?>
                        <h6><?php echo nextdestina_kses( $settings['nextdestina_sub_title'] ); ?></h6>
                    <?php endif; ?>
                    <?php
                        if ( !empty($settings['nextdestina_title' ]) ) :
                            printf( '<%1$s %2$s>%3$s</%1$s>',
                                tag_escape( $settings['nextdestina_title_tag'] ),
                                $this->get_render_attribute_string( 'title_args' ),
                                nextdestina_kses( $settings['nextdestina_title' ] )
                            );
                        endif;
                    ?>
                    </div>
                    <ul class="counter-item">
                        <?php foreach ($settings['nextdestina_process_list'] as $key => $item) : ?> 
                            <li>
                                <span class="list-num">
                                    <?php if (!empty($item['nextdestina_process_step' ])): ?>
                                        <?php echo nextdestina_kses($item['nextdestina_process_step' ]); ?>
                                    <?php endif; ?>
                                </span>
                                <div class="main-item">
                                    <?php if (!empty($item['nextdestina_process_title' ])): ?>
                                        <h4><?php echo nextdestina_kses($item['nextdestina_process_title' ]); ?></h4>
                                    <?php endif; ?>
                                    <?php if (!empty($item['nextdestina_process_description' ])): ?>
                                        <p><?php echo nextdestina_kses($item['nextdestina_process_description']); ?></p>
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

$widgets_manager->register( new Nextdestina_Process() );