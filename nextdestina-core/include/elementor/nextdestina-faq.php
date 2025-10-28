<?php
namespace NextdestinaCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Control_Media;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Nextdestina Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Nextdestina_Faq extends Widget_Base {

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
		return 'nextdestina-faq';
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
		return __( 'FAQ / Your Answer', 'nextdestinacore' );
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
                    'layout-2' => esc_html__('Layout 2', 'nextdestinacore'),
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
                'condition' => [
                    'nextdestina_design_style' => 'layout-2'
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
                'condition' => [
                    'nextdestina_design_style' => 'layout-2'
                ],
            ]
        );

        $this->add_control(
            'nextdestina_title_color',
            [
                'label' => __( 'Title Color', 'nextdestinacore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .common-title h3' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'nextdestina_design_style' => 'layout-2'
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
                'condition' => [
                    'nextdestina_design_style' => 'layout-2'
                ],
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
                'condition' => [
                    'nextdestina_design_style' => 'layout-2'
                ],
            ]
        );

        $this->add_control(
            'nextdestina_client_box_text',
            [
                'label' => esc_html__('Client Box Text', 'nextdestinacore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('100+ Happy Clients  ', 'nextdestinacore'),
                'title' => esc_html__('Enter client box text', 'nextdestinacore'),
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
                'label' => esc_html__( 'Accordion', 'nextdestinacore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'accordion_title', [
                'label' => esc_html__( 'Accordion Item', 'nextdestinacore' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'This is accordion item title' , 'nextdestinacore' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'accordion_title_color',
            [
                'label' => __( 'Accordion Color', 'nextdestinacore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .accordion-button span' => 'color: {{VALUE}}',
                ],
            ]
        );

        $repeater->add_control(
            'accordion_description',
            [
                'label' => esc_html__('Description', 'nextdestinacore'),
                'description' => nextdestina_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Quickly coordinate resource-leveling mindshare rather than pandemic new img Professionally empower just in time metrics for seamless total linkage. It’ an untinually impact mission-critical',
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'accordion_description_color',
            [
                'label' => __( 'Description Color', 'nextdestinacore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .accordion-body p' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'accordions',
            [
                'label' => esc_html__( 'Repeater Accordion', 'nextdestinacore' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'accordion_title' => esc_html__( 'Credibly initiate efficient e-commerce whereas services?', 'nextdestinacore' ),
                    ],
                    [
                        'accordion_title' => esc_html__( 'How Much Does Nextdestina Monthly Cost?', 'nextdestinacore' ),
                    ],
                    [
                        'accordion_title' => esc_html__( 'What Payment Method do you Supports?', 'nextdestinacore' ),
                    ]
                ],
                'title_field' => '{{{ accordion_title }}}',
            ]
        );

        $this->add_control(
            'space_accordion_item',
            [
                'label' => esc_html__( 'Accordion space gap', 'nextdestinacore' ),
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

        <?php if ( $settings['nextdestina_design_style']  == 'layout-2' ):
            if ( !empty($settings['nextdestina_faq_image']['url']) ) {
                $nextdestina_faq_image = !empty($settings['nextdestina_faq_image']['id']) ? wp_get_attachment_image_url( $settings['nextdestina_faq_image']['id'], $settings['nextdestina_image_size_size']) : $settings['nextdestina_faq_image']['url'];
                $nextdestina_faq_image_alt = get_post_meta($settings["nextdestina_faq_image"]["id"], "_wp_attachment_image_alt", true);
            }
            if ( !empty($settings['nextdestina_faq_image_2']['url']) ) {
                $nextdestina_faq_image_2 = !empty($settings['nextdestina_faq_image_2']['id']) ? wp_get_attachment_image_url( $settings['nextdestina_faq_image_2']['id'], $settings['nextdestina_image_size_size']) : $settings['nextdestina_faq_image_2']['url'];
                $nextdestina_faq_image_2_alt = get_post_meta($settings["nextdestina_faq_image_2"]["id"], "_wp_attachment_image_alt", true);
            }
        ?>
            <!-- faq -->
            <section class="faq">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6">
                            <div class="faq-left-container">
                                <div class="faq-left-container-inner">
                                    <div class="common-title">
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
                                    <div class="accordion" id="accordionExample">
                                        <?php foreach ($settings['accordions'] as $index => $item) :
                                            $collapsed = ($index == '0' ) ? '' : 'collapsed';
                                            $show = ($index == '0' ) ? "show" : "";
                                            ?>
                                            <div class="accordion-item">
                                                <h2 class="accordion-header">
                                                    <button class="accordion-button <?php echo esc_attr($collapsed);?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo esc_attr($index);?>" aria-expanded="true" aria-controls="collapse<?php echo esc_attr($index);?>">
                                                        <span><?php echo esc_html($item['accordion_title']); ?></span>
                                                        <i class="fa-regular fa-angle-right"></i>
                                                    </button>
                                                </h2>
                                                <div id="collapse<?php echo esc_attr($index);?>" class="accordion-collapse collapse <?php echo esc_attr($show); ?>" aria-label="heading<?php echo esc_attr($index);?>" data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                        <p><?php echo nextdestina_kses($item['accordion_description']); ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>                                    
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-5 offset-xl-1 col-lg-6">
                            <div class="faq-right-container">
                                <div class="faq-right-sun-icon">
                                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/img/shape/sun-shape-01.png');?>" alt="icon">
                                </div>
                                <div class="faq-image-1">
                                    <?php if ($settings['nextdestina_faq_image']['url'] || $settings['nextdestina_faq_image']['id']) : ?>
                                        <img src="<?php echo esc_url($nextdestina_faq_image); ?>" alt="<?php echo esc_attr($nextdestina_faq_image_alt); ?>">
                                    <?php endif; ?>
                                </div>
                                <div class="faq-image-2">
                                    <?php if ($settings['nextdestina_faq_image_2']['url'] || $settings['nextdestina_faq_image_2']['id']) : ?>
                                        <img src="<?php echo esc_url($nextdestina_faq_image_2); ?>" alt="<?php echo esc_attr($nextdestina_faq_image_2_alt); ?>">
                                    <?php endif; ?>
                                </div>
                                <div class="faq-transparent">
                                    <div class="border-box">
                                        <img src="<?php echo esc_url(get_template_directory_uri(). '/assets/img/shape/border-box-01.png');?>" alt="border">
                                    </div>
                                    <div class="border-box-2">
                                        <img src="<?php echo esc_url(get_template_directory_uri(). '/assets/img/shape/border-box-02.png');?>" alt="border">
                                    </div>
                                    <div class="faq-right-icon">
                                        <img src="<?php echo esc_url(get_template_directory_uri(). '/assets/img/icons/faq-icon.png');?>" alt="icon">
                                    </div>
                                </div>
                                <div class="faq-client-box">
                                    <div class="faq-client-box-icon">
                                        <i class="icon-user"></i>
                                    </div>
                                    <?php if ( !empty($settings['nextdestina_client_box_text']) ) : ?>
                                        <p><?php echo nextdestina_kses( $settings['nextdestina_client_box_text'] ); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- faq -->
        <?php else: ?>
            
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
                            <p class="text"><?php echo nextdestina_kses($item['accordion_description']); ?></p>
                        </div>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            
        <?php endif; ?>
        <?php 
	}
}

$widgets_manager->register( new Nextdestina_Faq() );