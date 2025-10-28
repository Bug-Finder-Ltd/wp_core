<?php
namespace NextdestinaCore\Widgets;

use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Nextdestina Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Nextdestina_Counter extends \Elementor\Widget_Base {

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
        return 'nextdestina-counter';
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
        return __( 'Nextdestina Counters', 'nextdestinacore' );
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
            'nextdestina_title',
            [
                'label' => esc_html__('Title', 'nextdestinacore'),
                'description' => nextdestina_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Our Result Speaks For Business Success', 'nextdestinacore'),
                'placeholder' => esc_html__('Type title', 'nextdestinacore'),
                'label_block' => true,
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
            ]
        );

        $this->add_control(
            'nextdestina_description',
            [
                'label' => esc_html__('Description', 'nextdestinacore'),
                'description' => nextdestina_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Appropriately myocardinate performance based partnerships multifunctional Collaboratively promote optimal technologies ROI. Monotonectally engineer standard', 'nextdestinacore'),
                'placeholder' => esc_html__('Type section description here', 'nextdestinacore'),
            ]
        );

        $this->add_control(
            'nextdestina_description_color',
            [
                'label' => __( 'Description Color', 'nextdestinacore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .video-container-top-text p' => 'color: {{VALUE}}',
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
            'nextdestina_video_url',
            [
                'label' => esc_html__('Video Url', 'nextdestinacore'),
                'description' => nextdestina_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('https://www.youtube.com/watch?v=kS0X-yIsB64', 'nextdestinacore'),
                'placeholder' => esc_html__('Type title', 'nextdestinacore'),
                'label_block' => true,
            ]
        );

        $this->end_controls_section();

        
        /**
         * Image section
         */
		$this->start_controls_section(
            '_nextdestina_image',
            [
                'label' => esc_html__('Image', 'nextdestinacore'),
            ]
        );

        $this->add_control(
            'nextdestina_counter_image',
            [
                'label' => esc_html__( 'Counter Image', 'nextdestinacore' ),
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
        $this->add_control(
            'nextdestina_image_overlap',
            [
                'label' => esc_html__('Image overlap to top?', 'nextdestinacore'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'nextdestinacore'),
                'label_off' => esc_html__('No', 'nextdestinacore'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );
        $this->add_responsive_control(
            'nextdestina_image_height',
            [
                'label' => esc_html__( 'Image Height', 'nextdestinacore' ),
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
                    '{{WRAPPER}} .nextdestina-overlap img' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'nextdestina_image_overlap_x',
            [
                'label' => esc_html__( 'Image overlap position', 'nextdestinacore' ),
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
                    '{{WRAPPER}} .nextdestina-overlap img' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
                'condition' => array(
                    'nextdestina_image_overlap' => 'yes',
                ),
            ]
        );

        $this->end_controls_section();


        /**
         * Counter section
         */
        $this->start_controls_section(
            'nextdestina_counter_section',
            [
                'label' => esc_html__('Counters', 'nextdestinacore'),
                'description' => esc_html__( 'Control all the style settings from Style tab', 'nextdestinacore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();


        $this->add_control(
            'nextdestina_counter_title',
            [
                'label' => esc_html__('Counter Title', 'nextdestinacore'),
                'description' => nextdestina_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Winning award', 'nextdestinacore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'nextdestina_count_number', [
                'label' => esc_html__('Count Number', 'nextdestinacore'),
                'description' => nextdestina_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('200', 'nextdestinacore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'nextdestina_count_number_post_text',
            [
                'label' => esc_html__('Counter Number Post Text', 'nextdestinacore'),
                'description' => nextdestina_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('K', 'nextdestinacore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'nextdestina_counter_list',
            [
                'label' => esc_html__('Counters - List', 'nextdestinacore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'nextdestina_counter_title' => esc_html__('Years of Experience', 'nextdestinacore'),
                    ],
                    [
                        'nextdestina_counter_title' => esc_html__('Avg. Conversation Rate', 'nextdestinacore')
                    ],
                    [
                        'nextdestina_counter_title' => esc_html__('Projects Completed', 'nextdestinacore')
                    ]
                ],
                'title_field' => '{{{ nextdestina_counter_title }}}',
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
        if ( !empty($settings['nextdestina_counter_image']['url']) ) {
            $nextdestina_counter_image = !empty($settings['nextdestina_counter_image']['id']) ? wp_get_attachment_image_url( $settings['nextdestina_counter_image']['id'], $settings['nextdestina_image_size_size']) : $settings['nextdestina_counter_image']['url'];
            $nextdestina_counter_image_alt = get_post_meta($settings["nextdestina_counter_image"]["id"], "_wp_attachment_image_alt", true);
        } 
        ?>
        
        <div class="single-counter style-one">
            <div class="counter-box">
                <h5 class="odometer" data-count="<?php echo nextdestina_kses($settings['nextdestina_count_number']);?>">00</h5>
                <div class="odometer-text"><?php echo nextdestina_kses($settings['nextdestina_count_number_post_text']);?></div>
            </div>
            <p class="text"><?php echo nextdestina_kses($settings['nextdestina_counter_title' ]); ?></p>
        </div>
       
        <?php 
    }
}

$widgets_manager->register( new Nextdestina_Counter() );