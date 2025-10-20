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
class Bwall_Testimonial extends Widget_Base {

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
		return 'bwall-testimonial';
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
		return __( 'Bwall Testimonial', 'bwallcore' );
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


    public function get_bwall_contact_form(){
        if ( ! class_exists( 'WPCF7' ) ) {
            return;
        }
        $bwall_cfa         = array();
        $bwall_cf_args     = array( 'posts_per_page' => -1, 'post_type'=> 'wpcf7_contact_form' );
        $bwall_forms       = get_posts( $bwall_cf_args );
        $bwall_cfa         = ['0' => esc_html__( 'Select Form', 'bwallcore' ) ];
        if( $bwall_forms ){
            foreach ( $bwall_forms as $bwall_form ){
                $bwall_cfa[$bwall_form->ID] = $bwall_form->post_title;
            }
        }else{
            $bwall_cfa[ esc_html__( 'No contact form found', 'bwallcore' ) ] = 0;
        }
        return $bwall_cfa;
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
                    'layout-2' => esc_html__('Layout 2', 'bwallcore'),
                    'layout-3' => esc_html__('Layout 3', 'bwallcore'),
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
                'default' => esc_html__('Bwall Title Here', 'bwallcore'),
                'placeholder' => esc_html__('Type Heading Text', 'bwallcore'),
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
            'bwall_contact_form_title',
            [
                'label' => esc_html__('Contact Form Title', 'bwallcore'),
                'description' => bwall_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Bwall Title Here', 'bwallcore'),
                'placeholder' => esc_html__('Type title text', 'bwallcore'),
                'label_block' => true,
                'condition' => [
                    'bwall_design_style' => 'layout-1',
                ],
            ]
        );

        $this->add_control(
            'bwall_contact_form_title_color',
            [
                'label' => __( 'Contact Form Title Color', 'bwallcore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .common-title h3' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'bwall_design_style' => 'layout-1',
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

        // testimonial image
        $this->add_control(
            'bwall_testimonial_image',
            [
                'label' => esc_html__( 'Testimonial Image', 'bwallcore' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'bwall_design_style' => $layout_2_3_array,
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'bwall_testimonial_image_size',
                'default' => 'full',
                'exclude' => [
                    'custom'
                ]
            ]
        );

        $this->end_controls_section();

        /**
		 * Form
		 */

         $this->start_controls_section(
            'bwallcore_contact',
            [
                'label' => esc_html__('Contact Form', 'bwallcore'),
                'condition' => [
                    'bwall_design_style' => 'layout-1',
                ],
            ]
		);

        $this->add_control(
            'bwallcore_select_contact_form',
            [
                'label'   => esc_html__( 'Select Form', 'bwallcore' ),
                'type'    => Controls_Manager::SELECT,
                'default' => '0',
                'options' => $this->get_bwall_contact_form(),
                'condition' => [
                    'bwall_design_style' => 'layout-1',
                ],
            ]
        );
        $this->end_controls_section();


        /**
         * Review section
         */
        $this->start_controls_section(
            'review_list',
            [
                'label' => esc_html__( 'Review List', 'bwallcore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();


        $repeater->add_control(
            'reviewer_image',
            [
                'label' => esc_html__( 'Reviewer Image', 'bwallcore' ),
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
                'label' => esc_html__( 'Reviewer Name', 'bwallcore' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Rasalina William' , 'bwallcore' ),
                'label_block' => true,
            ]
        );        

        $repeater->add_control(
            'reviewer_designation', [
                'label' => esc_html__( 'Designation', 'bwallcore' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( '- CEO' , 'bwallcore' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'reviewer_designation_color',
            [
                'label' => __( 'Designation Color', 'bwallcore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .testimonial-single-info h6' => 'color: {{VALUE}}',
                ],
            ]
        );

        $repeater->add_control(
            'review_content',
            [
                'label' => esc_html__( 'Review Content', 'bwallcore' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 10,
                'default' => 'Aklima The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections Bonorum et Malorum original.',
                'placeholder' => esc_html__( 'Type your review content here', 'bwallcore' ),
            ]
        );

        $repeater->add_control(
            'review_content_color',
            [
                'label' => __( 'Title Color', 'bwallcore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .testimonial-2-single-text p' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'reviews_list',
            [
                'label' => esc_html__( 'Review List', 'bwallcore' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' =>  $repeater->get_controls(),
                'default' => [
                    [
                        'reviewer_name' => esc_html__( 'Rasalina William', 'bwallcore' ),
                        'reviewer_designation' => esc_html__( 'CEO', 'bwallcore' ),
                        'review_content' => esc_html__( 'Put your trust in us &share in our people with a passion.We are motivated by the satisfaction H.Spond Asset Management is made up of a team of expert, committed and experienced for of clients financial markets. Our goal is to achieve continuous.', 'bwallcore' ),
                    ],
                    [
                        'reviewer_name' => esc_html__( 'Rasalina William', 'bwallcore' ),
                        'reviewer_designation' => esc_html__( 'MD', 'bwallcore' ),
                        'review_content' => esc_html__( 'Put your trust in us &share in our people with a passion.We are motivated by the satisfaction H.Spond Asset Management is made up of a team of expert, committed and experienced for of clients financial markets. Our goal is to achieve continuous.', 'bwallcore' ),
                    ],
                    [
                        'reviewer_name' => esc_html__( 'Rasalina William', 'bwallcore' ),
                        'reviewer_designation' => esc_html__( 'Manager', 'bwallcore' ),
                        'review_content' => esc_html__( 'Put your trust in us &share in our people with a passion.We are motivated by the satisfaction H.Spond Asset Management is made up of a team of expert, committed and experienced for of clients financial markets. Our goal is to achieve continuous.', 'bwallcore' ),
                    ],

                ],
                'title_field' => '{{{ reviewer_name }}}',
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'bwall_image_size',
                'default' => 'full',
                'exclude' => ['custom'],
            ]
        );

        $this->end_controls_section();
        

        /**
         * Style section
         */
		$this->start_controls_section(
			'section_style',
			[
				'label' => __( 'Style', 'bwallcore' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'text_transform',
			[
				'label' => __( 'Text Transform', 'bwallcore' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => __( 'None', 'bwallcore' ),
					'uppercase' => __( 'UPPERCASE', 'bwallcore' ),
					'lowercase' => __( 'lowercase', 'bwallcore' ),
					'capitalize' => __( 'Capitalize', 'bwallcore' ),
				],
				'selectors' => [
					'{{WRAPPER}} .title' => 'text-transform: {{VALUE}};',
				],
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
		$settings = $this->get_settings_for_display(); ?>

        <?php if ( $settings['bwall_design_style']  == 'layout-3' ): ?>  
            <?php
                if ( !empty($settings['bwall_testimonial_image']['url']) ) {
                    $bwall_testimonial_image = !empty($settings['bwall_testimonial_image']['id']) ? wp_get_attachment_image_url( $settings['bwall_testimonial_image']['id'], $settings['bwall_testimonial_image_size_size']) : $settings['bwall_testimonial_image']['url'];
                    $bwall_testimonial_image_alt = get_post_meta($settings["bwall_testimonial_image"]["id"], "_wp_attachment_image_alt", true);
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
                                        if ( !empty($settings['bwall_title' ]) ) :
                                            printf( '<%1$s %2$s>%3$s</%1$s>',
                                                tag_escape( $settings['bwall_title_tag'] ),
                                                $this->get_render_attribute_string( 'title_args' ),
                                                bwall_kses( $settings['bwall_title' ] )
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
                                                $bwall_reviewer_image = !empty($item['reviewer_image']['id']) ? wp_get_attachment_image_url( $item['reviewer_image']['id'], $settings['bwall_image_size_size']) : $item['reviewer_image']['url'];
                                                $bwall_reviewer_image_alt = get_post_meta($item["reviewer_image"]["id"], "_wp_attachment_image_alt", true);
                                            }
                                        ?>
                                            <div class="swiper-slide">
                                                <div class="testimonial-2-single">
                                                    <div class="testimonial-single-icon">
                                                        <img src="<?php echo get_template_directory_uri() . '/assets/img/icons/quote-02.png';?>" alt="icon">
                                                    </div>
                                                    <div class="testimonial-2-single-text">
                                                        <?php if ( !empty($item['review_content']) ) : ?>
                                                            <p><?php echo bwall_kses($item['review_content']); ?></p>
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="testimonial-2-single-info">
                                                        <div class="testimonial-2-single-image">
                                                            <img src="<?php echo esc_url($bwall_reviewer_image); ?>" alt="<?php echo esc_url($bwall_reviewer_image_alt); ?>">
                                                        </div>
                                                        <div class="testimonial-single-info">
                                                            <?php if ( !empty($item['reviewer_name']) ) : ?>
                                                                <h5><?php echo bwall_kses($item['reviewer_name']); ?></h5>
                                                            <?php endif; ?>
                                                            <?php if ( !empty($item['reviewer_designation']) ) : ?>
                                                                <h6><?php echo bwall_kses($item['reviewer_designation']); ?></h6>
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
                                <img src="<?php echo esc_url($bwall_testimonial_image); ?>" alt="<?php echo esc_url($bwall_testimonial_image_alt); ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- testimonial 2 -->

        <?php elseif ( $settings['bwall_design_style']  == 'layout-2' ): ?>
        
            <?php
                if ( !empty($settings['bwall_testimonial_image']['url']) ) {
                    $bwall_testimonial_image = !empty($settings['bwall_testimonial_image']['id']) ? wp_get_attachment_image_url( $settings['bwall_testimonial_image']['id'], $settings['bwall_testimonial_image_size_size']) : $settings['bwall_testimonial_image']['url'];
                    $bwall_testimonial_image_alt = get_post_meta($settings["bwall_testimonial_image"]["id"], "_wp_attachment_image_alt", true);
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
                                        <img src="<?php echo esc_url($bwall_testimonial_image); ?>" alt="<?php echo esc_url($bwall_testimonial_image_alt); ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-12">
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
                            <div class="testimonial-slider-container">
                                <div class="single-item-carousel swiper-container testimonial-slider">
                                    <div class="swiper-wrapper">
                                        <?php foreach ($settings['reviews_list'] as $index => $item) :
                                            if ( !empty($item['reviewer_image']['url']) ) {
                                                $bwall_reviewer_image = !empty($item['reviewer_image']['id']) ? wp_get_attachment_image_url( $item['reviewer_image']['id'], $settings['bwall_image_size_size']) : $item['reviewer_image']['url'];
                                                $bwall_reviewer_image_alt = get_post_meta($item["reviewer_image"]["id"], "_wp_attachment_image_alt", true);
                                            }
                                        ?>
                                            <div class="swiper-slide">
                                                <div class="testimonial-single">
                                                    <div class="testimonial-single-icon">
                                                        <img src="<?php echo get_template_directory_uri() . '/assets/img/icons/quote-01.png';?>" alt="icon">
                                                    </div>
                                                    <div class="testimonial-single-text">
                                                        <?php if ( !empty($item['review_content']) ) : ?>
                                                            <p><?php echo bwall_kses($item['review_content']); ?></p>
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="testimonial-single-info">
                                                        <?php if ( !empty($item['reviewer_name']) ) : ?>
                                                            <h5><?php echo bwall_kses($item['reviewer_name']); ?></h5>
                                                        <?php endif; ?>
                                                        <?php if ( !empty($item['reviewer_designation']) ) : ?>
                                                            <h6><?php echo bwall_kses($item['reviewer_designation']); ?></h6>
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="testimonial-single-image">
                                                        <img src="<?php echo esc_url($bwall_reviewer_image); ?>" alt="<?php echo esc_url($bwall_reviewer_image_alt); ?>">
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

            <!-- testimonial 2 -->
            <section class="testimonial-2">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="common-title">
                                <?php
                                    if ( !empty($settings['bwall_contact_form_title' ]) ) :
                                        printf( '<%1$s %2$s>%3$s</%1$s>',
                                            tag_escape( $settings['bwall_title_tag'] ),
                                            $this->get_render_attribute_string( 'title_args' ),
                                            bwall_kses( $settings['bwall_contact_form_title' ] )
                                        );
                                    endif;
                                ?>
                            </div>
                            <?php if( !empty($settings['bwallcore_select_contact_form']) ) : ?> 
                                <div class="testimonial-2-form"> 
                                    <?php echo do_shortcode( '[contact-form-7  id="'.$settings['bwallcore_select_contact_form'].'"]' ); ?>
                                </div>
                            <?php else : ?>
                                <?php echo '<div class="alert alert-warning"><p class="m-0">' . __('Please Select contact form.', 'bwallcore' ). '</p></div>'; ?>
                            <?php endif; ?>
                            
                        </div>
                        <div class="col-lg-6">
                            <div class="common-title-container">
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
                                <div class="testimonial-2-single-shape">
                                    <img src="<?php echo get_template_directory_uri() . '/assets/img/shape/dot-shape-01.png';?>" alt="shape">
                                </div>
                            </div>
                            <div class="testimonial-slider-container">
                                <div class="single-item-carousel swiper-container testimonial-slider">
                                    <div class="swiper-wrapper">
                                        <?php foreach ($settings['reviews_list'] as $index => $item) :
                                            if ( !empty($item['reviewer_image']['url']) ) {
                                                $bwall_reviewer_image = !empty($item['reviewer_image']['id']) ? wp_get_attachment_image_url( $item['reviewer_image']['id'], $settings['bwall_image_size_size']) : $item['reviewer_image']['url'];
                                                $bwall_reviewer_image_alt = get_post_meta($item["reviewer_image"]["id"], "_wp_attachment_image_alt", true);
                                            }
                                        ?>
                                            <div class="swiper-slide">
                                                <div class="testimonial-2-single">
                                                    <div class="testimonial-single-icon">
                                                        <img src="<?php echo get_template_directory_uri() . '/assets/img/icons/quote-02.png';?>" alt="image">
                                                    </div>
                                                    <div class="testimonial-2-single-text">
                                                        <?php if ( !empty($item['review_content']) ) : ?>
                                                            <p><?php echo bwall_kses($item['review_content']); ?></p>
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="testimonial-2-single-info">
                                                        <div class="testimonial-2-single-image">
                                                            <img src="<?php echo esc_url($bwall_reviewer_image); ?>" alt="<?php echo esc_url($bwall_reviewer_image_alt); ?>">
                                                        </div>
                                                        <div class="testimonial-single-info">
                                                            <?php if ( !empty($item['reviewer_name']) ) : ?>
                                                                <h5><?php echo bwall_kses($item['reviewer_name']); ?></h5>
                                                            <?php endif; ?>
                                                            <?php if ( !empty($item['reviewer_designation']) ) : ?>
                                                                <h6><?php echo bwall_kses($item['reviewer_designation']); ?></h6>
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
                    </div>
                </div>
            </section>
            <!-- testimonial 2 -->
        <?php endif; ?>
        <?php 
	}
}

$widgets_manager->register( new Bwall_Testimonial() );