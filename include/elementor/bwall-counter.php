<?php
namespace BwallCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Bwall Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Bwall_Counter extends Widget_Base {

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
        return 'bwall-counter';
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
        return __( 'Bwall Counters', 'bwallcore' );
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
        return 'bwall-icon';
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
        return [ 'bwallcore' ];
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
        return [ 'bwallcore' ];
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
            'bwall_layout',
            [
                'label' => esc_html__('Design Layout', 'bwallcore'),
            ]
        );
        $this->add_control(
            'bwall_design_style',
            [
                'label' => esc_html__('Select Layout', 'bwallcore'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'layout-1' => esc_html__('Layout 1', 'bwallcore'),
                ],
                'default' => 'layout-1',
            ]
        );
        $this->end_controls_section();


                
        /**
         * Title and content section
         */
        $this->start_controls_section(
            'bwall_section_title',
            [
                'label' => esc_html__('Title & Content', 'bwallcore'),
            ]
        );

        $this->add_control(
            'bwall_section_title_show',
            [
                'label' => esc_html__( 'Section Title & Content', 'bwallcore' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'bwallcore' ),
                'label_off' => esc_html__( 'Hide', 'bwallcore' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        
        $this->add_control(
            'bwall_title',
            [
                'label' => esc_html__('Title', 'bwallcore'),
                'description' => bwall_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Our Result Speaks For Business Success', 'bwallcore'),
                'placeholder' => esc_html__('Type title', 'bwallcore'),
                'label_block' => true,
            ]
        );
        
        $this->add_control(
            'bwall_title_color',
            [
                'label' => __( 'Title Color', 'bwallcore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .common-title h3' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'bwall_description',
            [
                'label' => esc_html__('Description', 'bwallcore'),
                'description' => bwall_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Appropriately myocardinate performance based partnerships multifunctional Collaboratively promote optimal technologies ROI. Monotonectally engineer standard', 'bwallcore'),
                'placeholder' => esc_html__('Type section description here', 'bwallcore'),
            ]
        );

        $this->add_control(
            'bwall_description_color',
            [
                'label' => __( 'Description Color', 'bwallcore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .video-container-top-text p' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'bwall_title_tag',
            [
                'label' => esc_html__('Title HTML Tag', 'bwallcore'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'h1' => [
                        'title' => esc_html__('H1', 'bwallcore'),
                        'icon' => 'eicon-editor-h1'
                    ],
                    'h2' => [
                        'title' => esc_html__('H2', 'bwallcore'),
                        'icon' => 'eicon-editor-h2'
                    ],
                    'h3' => [
                        'title' => esc_html__('H3', 'bwallcore'),
                        'icon' => 'eicon-editor-h3'
                    ],
                    'h4' => [
                        'title' => esc_html__('H4', 'bwallcore'),
                        'icon' => 'eicon-editor-h4'
                    ],
                    'h5' => [
                        'title' => esc_html__('H5', 'bwallcore'),
                        'icon' => 'eicon-editor-h5'
                    ],
                    'h6' => [
                        'title' => esc_html__('H6', 'bwallcore'),
                        'icon' => 'eicon-editor-h6'
                    ]
                ],
                'default' => 'h2',
                'toggle' => false,
            ]
        );

        $this->add_responsive_control(
            'bwall_align',
            [
                'label' => esc_html__('Alignment', 'bwallcore'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'text-left' => [
                        'title' => esc_html__('Left', 'bwallcore'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'text-center' => [
                        'title' => esc_html__('Center', 'bwallcore'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'text-right' => [
                        'title' => esc_html__('Right', 'bwallcore'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'left',
                'toggle' => false,
            ]
        );

        $this->add_control(
            'bwall_video_url',
            [
                'label' => esc_html__('Video Url', 'bwallcore'),
                'description' => bwall_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('https://www.youtube.com/watch?v=kS0X-yIsB64', 'bwallcore'),
                'placeholder' => esc_html__('Type title', 'bwallcore'),
                'label_block' => true,
            ]
        );

        $this->end_controls_section();

        
        /**
         * Image section
         */
		$this->start_controls_section(
            '_bwall_image',
            [
                'label' => esc_html__('Image', 'bwallcore'),
            ]
        );

        $this->add_control(
            'bwall_counter_image',
            [
                'label' => esc_html__( 'Counter Image', 'bwallcore' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'bwall_image_size',
                'default' => 'full',
                'exclude' => [
                    'custom'
                ]
            ]
        );
        $this->add_control(
            'bwall_image_overlap',
            [
                'label' => esc_html__('Image overlap to top?', 'bwallcore'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'bwallcore'),
                'label_off' => esc_html__('No', 'bwallcore'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );
        $this->add_responsive_control(
            'bwall_image_height',
            [
                'label' => esc_html__( 'Image Height', 'bwallcore' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
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
                    '{{WRAPPER}} .bwall-overlap img' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'bwall_image_overlap_x',
            [
                'label' => esc_html__( 'Image overlap position', 'bwallcore' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
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
                    '{{WRAPPER}} .bwall-overlap img' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
                'condition' => array(
                    'bwall_image_overlap' => 'yes',
                ),
            ]
        );

        $this->end_controls_section();


        /**
         * Counter section
         */
        $this->start_controls_section(
            'bwall_counter_section',
            [
                'label' => esc_html__('Counters', 'bwallcore'),
                'description' => esc_html__( 'Control all the style settings from Style tab', 'bwallcore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();


        $repeater->add_control(
            'bwall_counter_title',
            [
                'label' => esc_html__('Counter Title', 'bwallcore'),
                'description' => bwall_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Winning award', 'bwallcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'bwall_count_number', [
                'label' => esc_html__('Count Number', 'bwallcore'),
                'description' => bwall_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('200', 'bwallcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'bwall_count_number_post_text',
            [
                'label' => esc_html__('Counter Number Post Text', 'bwallcore'),
                'description' => bwall_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('K', 'bwallcore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'bwall_counter_list',
            [
                'label' => esc_html__('Counters - List', 'bwallcore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'bwall_counter_title' => esc_html__('Years of Experience', 'bwallcore'),
                    ],
                    [
                        'bwall_counter_title' => esc_html__('Avg. Conversation Rate', 'bwallcore')
                    ],
                    [
                        'bwall_counter_title' => esc_html__('Projects Completed', 'bwallcore')
                    ]
                ],
                'title_field' => '{{{ bwall_counter_title }}}',
            ]
        );
  
        $this->end_controls_section();
    }

    /**
     * Render the widget oubwallut on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function render() {
        $settings = $this->get_settings_for_display();
        if ( !empty($settings['bwall_counter_image']['url']) ) {
            $bwall_counter_image = !empty($settings['bwall_counter_image']['id']) ? wp_get_attachment_image_url( $settings['bwall_counter_image']['id'], $settings['bwall_image_size_size']) : $settings['bwall_counter_image']['url'];
            $bwall_counter_image_alt = get_post_meta($settings["bwall_counter_image"]["id"], "_wp_attachment_image_alt", true);
        } 
        ?>
        
            <!-- counter and video  -->
            <section class="video-container">
                <div class="video-container-top">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="common-title">
                                    <?php
                                        if ( !empty($settings['bwall_title' ]) ) :
                                            printf( '<%1$s %2$s>%3$s</%1$s>',
                                                tag_escape( $settings['bwall_title_tag'] ),
                                                $this->get_render_attribute_string( 'title_args' ),
                                                bwall_kses( $settings['bwall_title' ] )
                                                );
                                        endif;
                                    ?>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="video-container-top-shape">
                                    <img src="<?php echo get_template_directory_uri() . '/assets/img/shape/dot-shape-02.png';?>" alt="shape">
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="video-container-top-text">
                                    <?php if ( !empty($settings['bwall_description']) ) : ?>    
                                        <p><?php echo bwall_kses( $settings['bwall_description'] ); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="video-container-bottom">
                    <div class="container">
                        <div class="row">
                            <div class="video-container-bottom-wrapper">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="video-counter-content">
                                            <?php foreach ($settings['bwall_counter_list'] as $item) : ?>
                                                <div class="video-counter-single">
                                                    <div class="odometer-box">
                                                        <h5 class="odometer" data-count="<?php echo bwall_kses($item['bwall_count_number']);?>">00</h5>
                                                        <div class="odometer-text"><?php echo bwall_kses($item['bwall_count_number_post_text']);?></div>
                                                    </div>
                                                    <p><?php echo bwall_kses($item['bwall_counter_title' ]); ?></p>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="video-bottom-right-container">
                                            <div class="video-bottom-right-image">
                                                <?php if ($settings['bwall_counter_image']['url'] || $settings['bwall_counter_image']['id']) : ?>
                                                    <img src="<?php echo esc_url($bwall_counter_image); ?>" alt="<?php echo esc_attr($bwall_counter_image_alt); ?>">
                                                <?php endif; ?>
                                            </div>
                                            <div class="video-bottom-right-btn">
                                                <a class="play_btn hv-popup-link" href="<?php echo esc_url($settings['bwall_video_url']); ?>">
                                                    <i class="fas fa-play"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>     
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- counter and video -->
       
        
        <?php 
    }
}

$widgets_manager->register( new Bwall_Counter() );