<?php
namespace ZupetCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Zupet Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Zupet_Case_Study_Project extends Widget_Base {

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
		return 'case-study-project';
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
		return __( 'Case Study/Project', 'zupetcore' );
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
		return 'zupet-icon';
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
		return [ 'zupetcore' ];
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
		return [ 'zupetcore' ];
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
                    'layout-3' => esc_html__('Layout 3', 'zupetcore'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();


        $layout_array = ["layout-1", "layout-2"];

        /**
         * Title and content
         */
        $this->start_controls_section(
            'zupet_section_title',
            [
                'label' => esc_html__('Title & Content', 'zupetcore'),
                'condition' => [
                    'zupet_design_style' => $layout_array,
                ],
            ]
        );

        $this->add_control(
            'zupet_section_title_show',
            [
                'label' => esc_html__( 'Section Title & Content', 'zupetcore' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'zupetcore' ),
                'label_off' => esc_html__( 'Hide', 'zupetcore' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'zupet_design_style' => $layout_array,
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
                    'zupet_design_style' => $layout_array,
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
                    'zupet_design_style' => $layout_array,
                ],
            ]
        );

        $this->add_control(
            'zupet_title_tag',
            [
                'label' => esc_html__('Title HTML Tag', 'zupetcore'),
                'type' => Controls_Manager::CHOOSE,
                'condition' => [
                    'zupet_design_style' => $layout_array,
                ],
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
            ]
        );

        $this->add_responsive_control(
            'zupet_align',
            [
                'label' => esc_html__('Alignment', 'zupetcore'),
                'type' => Controls_Manager::CHOOSE,
                'condition' => [
                    'zupet_design_style' => $layout_array,
                ],
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'zupetcore'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'zupetcore'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'zupetcore'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'left',
                'toggle' => false,
                'selectors' => [
                    '{{WRAPPER}}' => 'text-align: {{VALUE}};'
                ]
            ]
        );

        $this->end_controls_section();


        /**
         * Show all button
         */
        $this->start_controls_section(
            'zupet_btn_button_group',
            [
                'label' => esc_html__('Button', 'zupetcore'),
                'condition' => [
                    'zupet_design_style' => $layout_array,
                ],
            ]
        );

        $this->add_control(
            'zupet_button_show',
            [
                'label' => esc_html__( 'Show Button', 'zupetcore' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'zupetcore' ),
                'label_off' => esc_html__( 'Hide', 'zupetcore' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'zupet_design_style' => $layout_array,
                ],
            ]
        );

        $this->add_control(
            'zupet_show_all_btn_text',
            [
                'label' => esc_html__('Show All Button Text', 'zupetcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Explore More', 'zupetcore'),
                'title' => esc_html__('Enter show all button text here', 'zupetcore'),
                'label_block' => true,
                'condition' => array(
                    'zupet_button_show' => 'yes',
                    'zupet_design_style' => $layout_array,
                ),
            ]
        );

        $this->add_control(
            'zupet_show_all_btn_link',
            [
                'label' => esc_html__('Show All Button link', 'zupetcore'),
                'type' => Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => esc_html__('https://your-link.com', 'zupetcore'),
                'show_external' => false,
                'default' => [
                    'url' => '#',
                    'is_external' => true,
                    'nofollow' => true,
                    'custom_attributes' => '',
                ],
                'condition' => array(
                    'zupet_button_show' => 'yes',
                    'zupet_design_style' => $layout_array,
                ),
                'label_block' => true,
            ]
        );

        $this->end_controls_section();

        
        /**
         * Project / Portfolio section
         */
        $this->start_controls_section(
            'zupet_portfolio',
            [
                'label' => esc_html__('Project/Portfolio', 'zupetcore'),
                'description' => esc_html__( 'Control all the style settings from Style tab', 'zupetcore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();


        $repeater->add_control(
            'zupet_portfolio_image',
            [
                'label' => esc_html__('Portfolio Image', 'zupetcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ]
            ]
        );
        $repeater->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'zupet_image_size',
                'default' => 'full',
                'exclude' => [
                    'custom'
                ]
            ]
        );
        $repeater->add_control(
            'zupet_portfolio_title', [
                'label' => esc_html__('Title', 'zupetcore'),
                'description' => zupet_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Portfolio Title', 'zupetcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'zupet_portfolio_title_color',
            [
                'label' => __( 'Title Color', 'zupetcore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .portfolio-single-caption-inner a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $repeater->add_control(
            'zupet_portfolio_description',
            [
                'label' => esc_html__('Description', 'zupetcore'),
                'description' => zupet_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered.',
                'label_block' => true,
            ]
        ); 

        $repeater->add_control(
            'zupet_portfolio_description_color',
            [
                'label' => __( 'Description Color', 'zupetcore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .portfolio-single-caption-inner h6' => 'color: {{VALUE}}',
                ],
            ]
        );

        $repeater->add_control(
            'zupet_portfolio_link_switcher',
            [
                'label' => esc_html__( 'Show Portfolio Link?', 'zupetcore' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'zupetcore' ),
                'label_off' => esc_html__( 'No', 'zupetcore' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',
            ]
        );
 
        $repeater->add_control(
            'zupet_portfolio_link_type',
            [
                'label' => esc_html__( 'Portfolio Link Type', 'zupetcore' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom Link',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'condition' => [
                    'zupet_portfolio_link_switcher' => 'yes'
                ]
            ]
        );
        $repeater->add_control(
            'zupet_portfolio_link',
            [
                'label' => esc_html__( 'Portfolio Link', 'zupetcore' ),
                'type' => \Elementor\Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => esc_html__( 'https://your-link.com', 'zupetcore' ),
                'show_external' => true,
                'default' => [
                    'url' => '#',
                    'is_external' => false,
                    'nofollow' => false,
                ],
                'condition' => [
                    'zupet_portfolio_link_type' => '1',
                    'zupet_portfolio_link_switcher' => 'yes',
                ]
            ]
        );
        $repeater->add_control(
            'zupet_portfolio_page_link',
            [
                'label' => esc_html__( 'Select Portfolio Link Page', 'zupetcore' ),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => zupet_get_all_pages(),
                'condition' => [
                    'zupet_portfolio_link_type' => '2',
                    'zupet_portfolio_link_switcher' => 'yes',
                ]
            ]
        );
        
        $repeater->add_control(
            'zupet_portfolio_icon_type',
            [
                'label' => esc_html__('Select Icon Type', 'zupetcore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'image',
                'options' => [
                    'image' => esc_html__('Image', 'zupetcore'),
                    'icon' => esc_html__('Icon', 'zupetcore'),
                ],
            ]
        );

        $repeater->add_control(
            'zupet_icon_image',
            [
                'label' => esc_html__('Upload Icon Image', 'zupetcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'zupet_portfolio_icon_type' => 'image',
                ]

            ]
        );

        if (zupet_is_elementor_version('<', '2.6.0')) {
            $repeater->add_control(
                'icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'fa fa-star',
                    'condition' => [
                        'zupet_portfolio_icon_type' => 'icon',
                    ]
                ]
            );
        } else {
            $repeater->add_control(
                'selected_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'icon',
                    'label_block' => true,
                    'default' => [
                        'value' => 'far fa-star',
                        'library' => 'regular',
                    ],
                    'condition' => [
                        'zupet_portfolio_icon_type' => 'icon',
                    ]
                ]
            );
        }

        $this->add_control(
            'zupet_portfolio_list',
            [
                'label' => esc_html__('Services - List', 'zupetcore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'zupet_portfolio_title' => esc_html__('Realistic Sitting Room Interior', 'zupetcore'),
                    ],
                    [
                        'zupet_portfolio_title' => esc_html__('Installation of Wall Coverings', 'zupetcore')
                    ],
                    [
                        'zupet_portfolio_title' => esc_html__('Picture of female artist  easel', 'zupetcore')
                    ]
                ],
                'title_field' => '{{{ zupet_portfolio_title }}}',
            ]
        );
        $this->add_responsive_control(
            'zupet_portfolio_align',
            [
                'label' => esc_html__( 'Alignment', 'zupetcore' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'text-left' => [
                        'title' => esc_html__( 'Left', 'zupetcore' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'text-center' => [
                        'title' => esc_html__( 'Center', 'zupetcore' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'text-right' => [
                        'title' => esc_html__( 'Right', 'zupetcore' ),
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

        if ( $settings['zupet_design_style']  == 'layout-3' ): ?>
            <!-- project page -->
            <section class="project-page">
                <div class="container">
                    <div class="row">
                        <?php foreach ($settings['zupet_portfolio_list'] as $key => $item) :
                            if ( !empty($item['zupet_portfolio_image']['url']) ) {
                                $zupet_portfolio_image_url = !empty($item['zupet_portfolio_image']['id']) ? wp_get_attachment_image_url( $item['zupet_portfolio_image']['id'], $item['zupet_image_size_size']) : $item['zupet_portfolio_image']['url'];
                                $zupet_portfolio_image_alt = get_post_meta($item["zupet_portfolio_image"]["id"], "_wp_attachment_image_alt", true);
                            }

                            if ('2' == $item['zupet_portfolio_link_type']) {
                                $link = get_permalink($item['zupet_portfolio_page_link']);
                                $target = '_self';
                                $rel = 'nofollow';
                            } else {
                                $link = !empty($item['zupet_portfolio_link']['url']) ? $item['zupet_portfolio_link']['url'] : '';
                                $target = !empty($item['zupet_portfolio_link']['is_external']) ? '_blank' : '';
                                $rel = !empty($item['zupet_portfolio_link']['nofollow']) ? 'nofollow' : '';
                            }
                            ?>
                            <div class="col-lg-4 col-md-6">
                                <div class="portfolio-single wow fadeInUp animated" data-wow-delay="400ms" data-wow-duration="1500ms">
                                    <div class="portfolio-single-image">
                                        <a href="<?php echo esc_url($link); ?>">
                                            <img src="<?php echo esc_url($zupet_portfolio_image_url); ?>" alt="<?php echo esc_url($zupet_portfolio_image_alt); ?>">
                                        </a>
                                    </div>
                                    <div class="portfolio-single-caption">
                                        <div class="portfolio-single-caption-inner">
                                            <?php if (!empty($item['zupet_portfolio_description' ])): ?>
                                                <h6><?php echo zupet_kses($item['zupet_portfolio_description']); ?></h6>
                                            <?php endif; ?>
                                            <?php if (!empty($item['zupet_portfolio_title' ])): ?>
                                                <a href="<?php echo esc_url($link); ?>"><?php echo zupet_kses($item['zupet_portfolio_title' ]); ?></a>
                                            <?php endif; ?>
                                        </div>
                                        <div class="portfolio-single-caption-icon">
                                            <a href="<?php echo esc_url($link); ?>"><i class="fa-sharp fa-regular fa-arrow-up-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>
            <!-- project page -->

        <?php elseif ( $settings['zupet_design_style']  == 'layout-2' ):?>

            <!-- portfolio -->
            <section class="portfolio">
                <div class="container">
                    <div class="row">
                        <div class="common-title-container">
                            <div class="common-title">
                                <img src="<?php echo get_template_directory_uri() . '/assets/img/shape/line-left-black.png';?>" alt="shape">
                                <?php if ( !empty($settings['zupet_section_title_show']) ) : ?> 
                                    <?php if ( !empty($settings['zupet_title' ]) ) :
                                        printf( '<%1$s %2$s>%3$s</%1$s>',
                                            tag_escape( $settings['zupet_title_tag'] ),
                                            $this->get_render_attribute_string( 'title_args' ),
                                            zupet_kses( $settings['zupet_title' ] )
                                        );
                                    endif; ?>
                                <?php endif; ?>
                            </div>
                            <div class="portfolio-round-btn">
                                <?php if ( ! empty( $settings['zupet_show_all_btn_link']['url'] ) ) : ?>
                                    <a href="<?php echo esc_url($settings['zupet_show_all_btn_link']['url'] ); ?>" class="round-btn">
                                        <p><?php echo zupet_kses( $settings['zupet_show_all_btn_text'] ); ?></p><i class="icon-arrow-1"></i> <span></span>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="portfolio-container">
                    <div class="portfolio-carousol">
                        <div class="four-item-carousel swiper-container portfolio-carousol-container">
                            <div class="swiper-wrapper">
                                <?php foreach ($settings['zupet_portfolio_list'] as $key => $item) :
                                    if ( !empty($item['zupet_portfolio_image']['url']) ) {
                                        $zupet_portfolio_image_url = !empty($item['zupet_portfolio_image']['id']) ? wp_get_attachment_image_url( $item['zupet_portfolio_image']['id'], $item['zupet_image_size_size']) : $item['zupet_portfolio_image']['url'];
                                        $zupet_portfolio_image_alt = get_post_meta($item["zupet_portfolio_image"]["id"], "_wp_attachment_image_alt", true);
                                    }

                                    if ('2' == $item['zupet_portfolio_link_type']) {
                                        $link = get_permalink($item['zupet_portfolio_page_link']);
                                        $target = '_self';
                                        $rel = 'nofollow';
                                    } else {
                                        $link = !empty($item['zupet_portfolio_link']['url']) ? $item['zupet_portfolio_link']['url'] : '';
                                        $target = !empty($item['zupet_portfolio_link']['is_external']) ? '_blank' : '';
                                        $rel = !empty($item['zupet_portfolio_link']['nofollow']) ? 'nofollow' : '';
                                    }
                                    ?>
                                    <div class="swiper-slide">
                                        <div class="portfolio-single wow fadeInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                                            <div class="portfolio-single-image">
                                                <a href="<?php echo esc_url($link); ?>">
                                                    <img src="<?php echo esc_url($zupet_portfolio_image_url); ?>" alt="<?php echo esc_url($zupet_portfolio_image_alt); ?>">
                                                </a>
                                            </div>
                                            <div class="portfolio-single-caption">
                                                <div class="portfolio-single-caption-inner">
                                                    <?php if (!empty($item['zupet_portfolio_description' ])): ?>
                                                        <h6><?php echo zupet_kses($item['zupet_portfolio_description']); ?></h6>
                                                    <?php endif; ?>
                                                    <a href="<?php echo esc_url($link); ?>"><?php echo zupet_kses($item['zupet_portfolio_title' ]); ?></a>
                                                </div>
                                                <div class="portfolio-single-caption-icon">
                                                    <a href="<?php echo esc_url($link); ?>"><i class="fa-sharp fa-regular fa-arrow-up-right"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- portfolio -->

		<?php else: ?>
    
            <!-- portfolio -->
            <section class="portfolio">
                <div class="container">
                    <div class="row">
                        <div class="common-title-container">
                            <div class="common-title">
                                <?php if ( !empty($settings['zupet_section_title_show']) ) : ?> 
                                    <?php if ( !empty($settings['zupet_title' ]) ) :
                                        printf( '<%1$s %2$s>%3$s</%1$s>',
                                            tag_escape( $settings['zupet_title_tag'] ),
                                            $this->get_render_attribute_string( 'title_args' ),
                                            zupet_kses( $settings['zupet_title' ] )
                                        );
                                    endif; ?>
                                <?php endif; ?>
                            </div>
                            <div class="portfolio-round-btn">
                                <?php if ( ! empty( $settings['zupet_show_all_btn_link']['url'] ) ) : ?>
                                    <a href="<?php echo esc_url($settings['zupet_show_all_btn_link']['url'] ); ?>" class="round-btn">
                                        <p><?php echo zupet_kses( $settings['zupet_show_all_btn_text'] ); ?></p><i class="icon-arrow-1"></i> <span></span>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="portfolio-container">
                    <div class="portfolio-carousol">
                        <div class="four-item-carousel swiper-container portfolio-carousol-container">
                            <div class="swiper-wrapper">
                                <?php foreach ($settings['zupet_portfolio_list'] as $key => $item) :
                                    if ( !empty($item['zupet_portfolio_image']['url']) ) {
                                        $zupet_portfolio_image_url = !empty($item['zupet_portfolio_image']['id']) ? wp_get_attachment_image_url( $item['zupet_portfolio_image']['id'], $item['zupet_image_size_size']) : $item['zupet_portfolio_image']['url'];
                                        $zupet_portfolio_image_alt = get_post_meta($item["zupet_portfolio_image"]["id"], "_wp_attachment_image_alt", true);
                                    }
                                    if ('2' == $item['zupet_portfolio_link_type']) {
                                        $link = get_permalink($item['zupet_portfolio_page_link']);
                                        $target = '_self';
                                        $rel = 'nofollow';
                                    } else {
                                        $link = !empty($item['zupet_portfolio_link']['url']) ? $item['zupet_portfolio_link']['url'] : '';
                                        $target = !empty($item['zupet_portfolio_link']['is_external']) ? '_blank' : '';
                                        $rel = !empty($item['zupet_portfolio_link']['nofollow']) ? 'nofollow' : '';
                                    }
                                    ?>
                                        <div class="swiper-slide">
                                            <div class="portfolio-single wow fadeInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                                                <div class="portfolio-single-image">
                                                    <img src="<?php echo esc_url($zupet_portfolio_image_url); ?>" alt="<?php echo esc_url($zupet_portfolio_image_alt); ?>">
                                                </div>
                                                <div class="portfolio-single-caption">
                                                    <div class="portfolio-single-caption-inner">
                                                        <?php if (!empty($item['zupet_portfolio_description' ])): ?>
                                                            <h6><?php echo zupet_kses($item['zupet_portfolio_description']); ?></h6>
                                                        <?php endif; ?>
                                                        <?php if (!empty($item['zupet_portfolio_title' ])): ?>
                                                            <a href="<?php echo esc_url($link); ?>"><?php echo zupet_kses($item['zupet_portfolio_title' ]); ?></a>
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="portfolio-single-caption-icon">
                                                        <?php if (!empty($item['zupet_portfolio_title' ])): ?>
                                                            <a href="<?php echo esc_url($link); ?>"><i class="fa-sharp fa-regular fa-arrow-up-right"></i></a>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- portfolio -->
        <?php endif; ?>
        <?php 
	}
}

$widgets_manager->register( new Zupet_Case_Study_Project() );