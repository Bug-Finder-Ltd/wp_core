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
class Nextdestina_Testimonial extends Widget_Base {

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
		return 'nextdestina-testimonial';
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
		return __( 'Nextdestina Testimonial', 'nextdestinacore' );
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


    public function get_nextdestina_contact_form(){
        if ( ! class_exists( 'WPCF7' ) ) {
            return;
        }
        $nextdestina_cfa         = array();
        $nextdestina_cf_args     = array( 'posts_per_page' => -1, 'post_type'=> 'wpcf7_contact_form' );
        $nextdestina_forms       = get_posts( $nextdestina_cf_args );
        $nextdestina_cfa         = ['0' => esc_html__( 'Select Form', 'nextdestinacore' ) ];
        if( $nextdestina_forms ){
            foreach ( $nextdestina_forms as $nextdestina_form ){
                $nextdestina_cfa[$nextdestina_form->ID] = $nextdestina_form->post_title;
            }
        }else{
            $nextdestina_cfa[ esc_html__( 'No contact form found', 'nextdestinacore' ) ] = 0;
        }
        return $nextdestina_cfa;
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
                    'layout-3' => esc_html__('Layout 3', 'nextdestinacore'),
                ],
                'default' => 'layout-1',
            ]
        );
        $this->end_controls_section();

        $layout_1_2_array = ["layout-1", "layout-2"];
        $layout_2_3_array = ["layout-2", "layout-3"];

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
                    '{{WRAPPER}} .common-title h3' => 'color: {{VALUE}}',
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

        // testimonial image
        $this->add_control(
            'nextdestina_testimonial_image',
            [
                'label' => esc_html__( 'Testimonial Image', 'nextdestinacore' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'nextdestina_design_style' => $layout_2_3_array,
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'nextdestina_testimonial_image_size',
                'default' => 'full',
                'exclude' => [
                    'custom'
                ]
            ]
        );

        $this->end_controls_section();

        /**
         * Review section
         */
        $this->start_controls_section(
            'review_list',
            [
                'label' => esc_html__( 'Review List', 'nextdestinacore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();


        $repeater->add_control(
            'reviewer_image',
            [
                'label' => esc_html__( 'Reviewer Image', 'nextdestinacore' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'reviewer_name', [
                'label' => esc_html__( 'Reviewer Name', 'nextdestinacore' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Rasalina William' , 'nextdestinacore' ),
                'label_block' => true,
            ]
        );        

        $repeater->add_control(
            'reviewer_designation', [
                'label' => esc_html__( 'Designation', 'nextdestinacore' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( '- CEO' , 'nextdestinacore' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'reviewer_designation_color',
            [
                'label' => __( 'Designation Color', 'nextdestinacore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .testimonial-single-info h6' => 'color: {{VALUE}}',
                ],
            ]
        );

        $repeater->add_control(
            'review_content',
            [
                'label' => esc_html__( 'Review Content', 'nextdestinacore' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 10,
                'default' => 'Aklima The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections Bonorum et Malorum original.',
                'placeholder' => esc_html__( 'Type your review content here', 'nextdestinacore' ),
            ]
        );

        $repeater->add_control(
            'review_content_color',
            [
                'label' => __( 'Title Color', 'nextdestinacore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .testimonial-2-single-text p' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'reviews_list',
            [
                'label' => esc_html__( 'Review List', 'nextdestinacore' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' =>  $repeater->get_controls(),
                'default' => [
                    [
                        'reviewer_name' => esc_html__( 'Rasalina William', 'nextdestinacore' ),
                        'reviewer_designation' => esc_html__( 'CEO', 'nextdestinacore' ),
                        'review_content' => esc_html__( 'Put your trust in us &share in our people with a passion.We are motivated by the satisfaction H.Spond Asset Management is made up of a team of expert, committed and experienced for of clients financial markets. Our goal is to achieve continuous.', 'nextdestinacore' ),
                    ],
                    [
                        'reviewer_name' => esc_html__( 'Rasalina William', 'nextdestinacore' ),
                        'reviewer_designation' => esc_html__( 'MD', 'nextdestinacore' ),
                        'review_content' => esc_html__( 'Put your trust in us &share in our people with a passion.We are motivated by the satisfaction H.Spond Asset Management is made up of a team of expert, committed and experienced for of clients financial markets. Our goal is to achieve continuous.', 'nextdestinacore' ),
                    ],
                    [
                        'reviewer_name' => esc_html__( 'Rasalina William', 'nextdestinacore' ),
                        'reviewer_designation' => esc_html__( 'Manager', 'nextdestinacore' ),
                        'review_content' => esc_html__( 'Put your trust in us &share in our people with a passion.We are motivated by the satisfaction H.Spond Asset Management is made up of a team of expert, committed and experienced for of clients financial markets. Our goal is to achieve continuous.', 'nextdestinacore' ),
                    ],

                ],
                'title_field' => '{{{ reviewer_name }}}',
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'nextdestina_image_size',
                'default' => 'full',
                'exclude' => ['custom'],
            ]
        );

        $this->end_controls_section();
        

        /**
         * Style section
         */
        $this->start_controls_section(
            'name_section',
            [
                'label' => esc_html__( 'Name', 'nextdestinacore' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
            $this->add_control(
                'name_color',
                [
                    'label' => esc_html__( 'Color', 'nextdestinacore' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .testimonial-content h6' => 'color: {{VALUE}}',
                    ],
                ]
            );
            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'name_typography',
                    'selector' => '{{WRAPPER}} .testimonial-content h6',
                ]
            );
            $this->add_control(
                'name_margin',
                [
                    'label' => esc_html__( 'Margin', 'nextdestinacore' ),
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .testimonial-content h6' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
		$settings = $this->get_settings_for_display(); ?>

        <?php if ( $settings['nextdestina_design_style']  == 'layout-3' ): ?>  
            <?php
                if ( !empty($settings['nextdestina_testimonial_image']['url']) ) {
                    $nextdestina_testimonial_image = !empty($settings['nextdestina_testimonial_image']['id']) ? wp_get_attachment_image_url( $settings['nextdestina_testimonial_image']['id'], $settings['nextdestina_testimonial_image_size_size']) : $settings['nextdestina_testimonial_image']['url'];
                    $nextdestina_testimonial_image_alt = get_post_meta($settings["nextdestina_testimonial_image"]["id"], "_wp_attachment_image_alt", true);
                }
            ?>
            <!-- testimonial 2 -->
            <section class="testimonial-2 about-testimonial">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="common-title-container">
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
                                <div class="testimonial-2-single-shape">
                                    <img src="<?php echo get_template_directory_uri() . '/assets/img/shape/dot-shape-01.png';?>" alt="image">
                                </div>
                            </div>
                            <div class="testimonial-slider-container">
                                <div class="single-item-carousel swiper-container testimonial-slider">
                                    <div class="swiper-wrapper">
                                        <?php foreach ($settings['reviews_list'] as $index => $item) :
                                            if ( !empty($item['reviewer_image']['url']) ) {
                                                $nextdestina_reviewer_image = !empty($item['reviewer_image']['id']) ? wp_get_attachment_image_url( $item['reviewer_image']['id'], $settings['nextdestina_image_size_size']) : $item['reviewer_image']['url'];
                                                $nextdestina_reviewer_image_alt = get_post_meta($item["reviewer_image"]["id"], "_wp_attachment_image_alt", true);
                                            }
                                        ?>
                                            <div class="swiper-slide">
                                                <div class="testimonial-2-single">
                                                    <div class="testimonial-single-icon">
                                                        <img src="<?php echo get_template_directory_uri() . '/assets/img/icons/quote-02.png';?>" alt="icon">
                                                    </div>
                                                    <div class="testimonial-2-single-text">
                                                        <?php if ( !empty($item['review_content']) ) : ?>
                                                            <p><?php echo nextdestina_kses($item['review_content']); ?></p>
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="testimonial-2-single-info">
                                                        <div class="testimonial-2-single-image">
                                                            <img src="<?php echo esc_url($nextdestina_reviewer_image); ?>" alt="<?php echo esc_url($nextdestina_reviewer_image_alt); ?>">
                                                        </div>
                                                        <div class="testimonial-single-info">
                                                            <?php if ( !empty($item['reviewer_name']) ) : ?>
                                                                <h5><?php echo nextdestina_kses($item['reviewer_name']); ?></h5>
                                                            <?php endif; ?>
                                                            <?php if ( !empty($item['reviewer_designation']) ) : ?>
                                                                <h6><?php echo nextdestina_kses($item['reviewer_designation']); ?></h6>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                                <div class="swiper-button-next custom-next swiper-navigetions">
                                    <i class="fa-regular fa-arrow-right"></i>
                                </div>
                                <div class="swiper-button-prev custom-prev swiper-navigetions">
                                    <i class="fa-regular fa-arrow-left"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="about-testimonial-image">
                                <img src="<?php echo esc_url($nextdestina_testimonial_image); ?>" alt="<?php echo esc_url($nextdestina_testimonial_image_alt); ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- testimonial 2 -->

        <?php elseif ( $settings['nextdestina_design_style']  == 'layout-2' ): ?>
        
            <?php
                if ( !empty($settings['nextdestina_testimonial_image']['url']) ) {
                    $nextdestina_testimonial_image = !empty($settings['nextdestina_testimonial_image']['id']) ? wp_get_attachment_image_url( $settings['nextdestina_testimonial_image']['id'], $settings['nextdestina_testimonial_image_size_size']) : $settings['nextdestina_testimonial_image']['url'];
                    $nextdestina_testimonial_image_alt = get_post_meta($settings["nextdestina_testimonial_image"]["id"], "_wp_attachment_image_alt", true);
                }
            ?>

            <!-- testimonial -->
            <section class="testimonial">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-6 col-lg-12">
                            <div class="testimonial-left-container">
                                <div class="testimonial-left-container-inner">
                                    <div class="testimonial-round-text">
                                    </div>
                                    <div class="testimonial-left-image">
                                        <img src="<?php echo esc_url($nextdestina_testimonial_image); ?>" alt="<?php echo esc_url($nextdestina_testimonial_image_alt); ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-12">
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
                            <div class="testimonial-slider-container">
                                <div class="single-item-carousel swiper-container testimonial-slider">
                                    <div class="swiper-wrapper">
                                        <?php foreach ($settings['reviews_list'] as $index => $item) :
                                            if ( !empty($item['reviewer_image']['url']) ) {
                                                $nextdestina_reviewer_image = !empty($item['reviewer_image']['id']) ? wp_get_attachment_image_url( $item['reviewer_image']['id'], $settings['nextdestina_image_size_size']) : $item['reviewer_image']['url'];
                                                $nextdestina_reviewer_image_alt = get_post_meta($item["reviewer_image"]["id"], "_wp_attachment_image_alt", true);
                                            }
                                        ?>
                                            <div class="swiper-slide">
                                                <div class="testimonial-single">
                                                    <div class="testimonial-single-icon">
                                                        <img src="<?php echo get_template_directory_uri() . '/assets/img/icons/quote-01.png';?>" alt="icon">
                                                    </div>
                                                    <div class="testimonial-single-text">
                                                        <?php if ( !empty($item['review_content']) ) : ?>
                                                            <p><?php echo nextdestina_kses($item['review_content']); ?></p>
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="testimonial-single-info">
                                                        <?php if ( !empty($item['reviewer_name']) ) : ?>
                                                            <h5><?php echo nextdestina_kses($item['reviewer_name']); ?></h5>
                                                        <?php endif; ?>
                                                        <?php if ( !empty($item['reviewer_designation']) ) : ?>
                                                            <h6><?php echo nextdestina_kses($item['reviewer_designation']); ?></h6>
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="testimonial-single-image">
                                                        <img src="<?php echo esc_url($nextdestina_reviewer_image); ?>" alt="<?php echo esc_url($nextdestina_reviewer_image_alt); ?>">
                                                    </div>
                                                    <div class="testimonial-single-shape">
                                                
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                                <div class="swiper-button-next custom-next swiper-navigetions">
                                    <i class="icon-arrow-right"></i>
                                </div>
                                <div class="swiper-button-prev custom-prev swiper-navigetions">
                                    <i class="icon-arrow-left"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- testimonial -->

		<?php else: ?>

            <?php
                $image_1 = NEXTDESTINA_ADDONS_URL . 'assets/img/testimonial/testimonial-1.png';
                $image_2 = NEXTDESTINA_ADDONS_URL . 'assets/img/testimonial/testimonial-2.png';
                $image_3 = NEXTDESTINA_ADDONS_URL . 'assets/img/testimonial/testimonial-3.png';
                $image_4 = NEXTDESTINA_ADDONS_URL . 'assets/img/testimonial/testimonial-4.png';
                $image_5 = NEXTDESTINA_ADDONS_URL . 'assets/img/testimonial/testimonial-5.png';
                $image_6 = NEXTDESTINA_ADDONS_URL . 'assets/img/testimonial/testimonial-6.png';
                $image_7 = NEXTDESTINA_ADDONS_URL . 'assets/img/testimonial/testimonial-7.png';
                $testi_bg = NEXTDESTINA_ADDONS_URL . 'assets/img/testimonial/testimonial-bg-1.png';
            ?>

        <section class="testimonial">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="testimonial-left-container">
                            <div class="image-1">
                                <img src="<?php echo esc_url($image_1); ?>" alt="image">
                            </div>
                            <div class="image-2">
                                <img src="<?php echo esc_url($image_2); ?>" alt="image">
                            </div>
                            <div class="image-3">
                                <img src="<?php echo esc_url($image_3); ?>" alt="image">
                            </div>
                            <div class="image-4">
                                <img src="<?php echo esc_url($image_4); ?>" alt="image">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="common-title text-center">
                            <h2><?php echo $settings['nextdestina_title']; ?></h2>
                        </div>
                        <div class="testimonial-carousel-container">
                            <div class="testimonial-carousel-bg">
                                <img src="<?php echo esc_url($testi_bg); ?>" alt="image">
                            </div>
                            <div class="single-item-carousel swiper-container">
                                <div class="swiper-wrapper">
                                    <?php foreach (  $settings['reviews_list'] as $item ) { ?>
                                    <div class="swiper-slide testimonial-single">
                                        <div class="testimonial-content">
                                            <div class="icon">
                                                <i class="fa-thin fa-quote-left"></i>
                                            </div>
                                            <p><q><?php echo $item['review_content']; ?></q></p>
                                            <h6><?php echo $item['reviewer_name']; ?></h6>
                                        </div>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="testimonial-right-container">
                            <div class="image-5">
                                <img src="<?php echo esc_url($image_5); ?>" alt="image">
                            </div>
                            <div class="image-6">
                                <img src="<?php echo esc_url($image_6); ?>" alt="image">
                            </div>
                            <div class="image-7">
                                <img src="<?php echo esc_url($image_7); ?>" alt="image">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php endif; ?>
        <?php 
	}
}

$widgets_manager->register( new Nextdestina_Testimonial() );