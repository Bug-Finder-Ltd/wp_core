<?php
namespace ProtineCore\Widgets;

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Protine Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Protine_Testimonial extends \Elementor\Widget_Base {

	public function get_name() {
		return 'protine-testimonial';
	}

	public function get_title() {
		return __( 'Protine Testimonial', 'protinecore' );
	}

	public function get_icon() {
		return 'protine-icon';
	}

	public function get_categories() {
		return [ 'protinecore' ];
	}

	public function get_script_depends() {
		return [ 'protinecore' ];
	}

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
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'layout-1' => esc_html__('Layout 1', 'protinecore'),
                    'layout-2' => esc_html__('Layout 2', 'protinecore'),
                    'layout-3' => esc_html__('Layout 3', 'protinecore'),
                    'layout-4' => esc_html__('Layout 4', 'protinecore'),
                ],
                'default' => 'layout-1',
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'title_section',
            [
                'label' => esc_html__('Title', 'protinecore'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
            $this->add_control(
                'testi_title',
                [
                    'label' => esc_html__( 'Title', 'protinecore' ),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => esc_html__( 'Default title', 'protinecore' ),
                    'placeholder' => esc_html__( 'Type your title here', 'protinecore' ),
                    'label_block' => true,
                ]
            );
        $this->end_controls_section();

        /**
         * Review section
         */
        $this->start_controls_section(
            'review_list',
            [
                'label' => esc_html__( 'Review List', 'protinecore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();


        $repeater->add_control(
            'reviewer_image',
            [
                'label' => esc_html__( 'Reviewer Image', 'protinecore' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'reviewer_name', [
                'label' => esc_html__( 'Reviewer Name', 'protinecore' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Rasalina William' , 'protinecore' ),
                'label_block' => true,
            ]
        );        

        $repeater->add_control(
            'reviewer_designation', [
                'label' => esc_html__( 'Designation', 'protinecore' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( '- CEO' , 'protinecore' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'reviewer_designation_color',
            [
                'label' => __( 'Designation Color', 'protinecore' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .testimonial-single-info h6' => 'color: {{VALUE}}',
                ],
            ]
        );

        $repeater->add_control(
            'review_content',
            [
                'label' => esc_html__( 'Review Content', 'protinecore' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 10,
                'default' => 'Aklima The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections Bonorum et Malorum original.',
                'placeholder' => esc_html__( 'Type your review content here', 'protinecore' ),
            ]
        );

        $repeater->add_control(
            'quote_icon',
            [
                'label' => esc_html__( 'Quote Icon', 'protinecore' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'reviews_list',
            [
                'label' => esc_html__( 'Review List', 'protinecore' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' =>  $repeater->get_controls(),
                'default' => [
                    [
                        'reviewer_name' => esc_html__( 'Rasalina William', 'protinecore' ),
                        'reviewer_designation' => esc_html__( 'CEO', 'protinecore' ),
                        'review_content' => esc_html__( 'Put your trust in us &share in our people with a passion.We are motivated by the satisfaction H.Spond Asset Management is made up of a team of expert, committed and experienced for of clients financial markets. Our goal is to achieve continuous.', 'protinecore' ),
                    ],
                    [
                        'reviewer_name' => esc_html__( 'Rasalina William', 'protinecore' ),
                        'reviewer_designation' => esc_html__( 'MD', 'protinecore' ),
                        'review_content' => esc_html__( 'Put your trust in us &share in our people with a passion.We are motivated by the satisfaction H.Spond Asset Management is made up of a team of expert, committed and experienced for of clients financial markets. Our goal is to achieve continuous.', 'protinecore' ),
                    ],
                    [
                        'reviewer_name' => esc_html__( 'Rasalina William', 'protinecore' ),
                        'reviewer_designation' => esc_html__( 'Manager', 'protinecore' ),
                        'review_content' => esc_html__( 'Put your trust in us &share in our people with a passion.We are motivated by the satisfaction H.Spond Asset Management is made up of a team of expert, committed and experienced for of clients financial markets. Our goal is to achieve continuous.', 'protinecore' ),
                    ],

                ],
                'title_field' => '{{{ reviewer_name }}}',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Image_Size::get_type(),
            [
                'name' => 'protine_image_size',
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
                'label' => esc_html__( 'Name', 'protinecore' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
            $this->add_control(
                'name_color',
                [
                    'label' => esc_html__( 'Color', 'protinecore' ),
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
                    'label' => esc_html__( 'Margin', 'protinecore' ),
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .testimonial-content h6' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
        $this->end_controls_section();

        $this->start_controls_section(
            'designation_section',
            [
                'label' => esc_html__( 'Designation', 'protinecore' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
            $this->add_control(
                'designation_color',
                [
                    'label' => esc_html__( 'Color', 'protinecore' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .testimonial .client-info .designation' => 'color: {{VALUE}}',
                    ],
                ]
            );
            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'designation_typography',
                    'selector' => '{{WRAPPER}} .testimonial .client-info .designation',
                ]
            );
            $this->add_control(
                'designation_margin',
                [
                    'label' => esc_html__( 'Margin', 'protinecore' ),
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .testimonial .client-info .designation' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
        $this->end_controls_section();

        $this->start_controls_section(
            'quote_section',
            [
                'label' => esc_html__( 'Quote', 'protinecore' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
            $this->add_control(
                'quote_color',
                [
                    'label' => esc_html__( 'Color', 'protinecore' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .testimonial .testimonial-content .quote p' => 'color: {{VALUE}}',
                    ],
                ]
            );
            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'quote_typography',
                    'selector' => '{{WRAPPER}} .testimonial .testimonial-content .quote p',
                ]
            );
            $this->add_control(
                'quote_margin',
                [
                    'label' => esc_html__( 'Margin', 'protinecore' ),
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .testimonial .testimonial-content .quote p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

        <?php if ( $settings['protine_design_style']  == 'layout-1' ): ?>
        
        <div class="testimonial style-one">
            <div class="testimonial-carousel-container">
                    <div class="single-item-carousel swiper-container">
                        <div class="swiper-wrapper">
                            <?php foreach (  $settings['reviews_list'] as $item ) :
                                if ( !empty($item['reviewer_image']['url']) ) {
                                    $reviewer_image = !empty($item['reviewer_image']['id']) ? wp_get_attachment_image_url( $item['reviewer_image']['id']) : $item['reviewer_image']['url'];
                                }
                                if ( !empty($item['quote_icon']['url']) ) {
                                    $quote_icon = !empty($item['quote_icon']['id']) ? wp_get_attachment_image_url( $item['quote_icon']['id']) : $item['quote_icon']['url'];
                                }
                                ?>
                                <div class="swiper-slide testimonial-single">
                                    <div class="testimonial-content">
                                        <div class="testi-left">
                                            <div class="client-info">
                                                <?php if(!empty($reviewer_image)) : ?>
                                                    <img src="<?php echo esc_url($reviewer_image); ?>" alt="image">
                                                <?php endif; ?>
                                                <div class="text">
                                                    <h6 class="name"><?php echo $item['reviewer_name']; ?></h6>
                                                    <p class="designation"><?php echo $item['reviewer_designation']; ?></p>
                                                </div>
                                            </div>
                                            <?php if(!empty($quote_icon)) : ?>
                                                <div class="quote-icon">
                                                    <img src="<?php echo esc_url($quote_icon); ?>" alt="icon">
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="quote">
                                            <p><q><?php echo $item['review_content']; ?></q></p>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="arrow-nav">
                        <div class="custom-prev swiper-navigetions">
                            <i class="icon-arrow-left"></i>
                        </div>
                        <div class="seperator"></div>
                        <div class="custom-next swiper-navigetions">
                            <i class="icon-arrow-right"></i>
                        </div>
                    </div>
            </div>
        </div>

		<?php elseif ( $settings['protine_design_style']  == 'layout-2' ): ?>

            <div class="testimonial style-two">
                <div class="testimonial-slider-container">
                    <div class="single-item-carousel swiper-container testimonial-slider">
                        <div class="swiper-wrapper">
                            <?php foreach ($settings['reviews_list'] as $index => $item) :
                                if ( !empty($item['reviewer_image']['url']) ) {
                                    $reviewer_image = !empty($item['reviewer_image']['id']) ? wp_get_attachment_image_url( $item['reviewer_image']['id']) : $item['reviewer_image']['url'];
                                }
                            ?>
                            <div class="swiper-slide">
                                <div class="testimonial-single">
                                    <div class="client-info">
                                        <?php if(!empty($reviewer_image)) : ?>
                                            <img src="<?php echo esc_url($reviewer_image); ?>" alt="image">
                                        <?php endif; ?>
                                    </div>
                                    <div class="quote">
                                        <div class="icon">
                                            <i class="fa-solid fa-quote-left"></i>
                                        </div>
                                        <p><q><?php echo $item['review_content']; ?></q></p>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="arrow-nav">
                        <div class="custom-prev swiper-navigetions">
                            <i class="fa-regular fa-angle-left"></i>
                        </div>
                        <div class="custom-next swiper-navigetions">
                            <i class="fa-regular fa-angle-right"></i>
                        </div>
                    </div>
                </div>
            </div>

        <?php elseif ( $settings['protine_design_style']  == 'layout-3' ): ?>

            <div class="testimonial style-three">
                <div class="testimonial-slider-container">
                    <div class="testi-wrapper">
                        <?php
                            $i = 0;
                            foreach ($settings['reviews_list'] as $index => $item) :
                                $i++;
                                if ( !empty($item['reviewer_image']['url']) ) {
                                    $reviewer_image = !empty($item['reviewer_image']['id']) ? wp_get_attachment_image_url( $item['reviewer_image']['id']) : $item['reviewer_image']['url'];
                                }
                        ?>
                            <div class="testimonial-single item-<?php echo $i; ?>">
                                <div class="content">
                                    <div class="quote">
                                        <q><?php echo $item['review_content']; ?></q>
                                    </div>
                                    <div class="client-info">
                                        <?php if(!empty($reviewer_image)) : ?>
                                            <img src="<?php echo esc_url($reviewer_image); ?>" alt="image">
                                        <?php endif; ?>
                                        <div class="text">
                                            <h6 class="name"><?php echo $item['reviewer_name']; ?></h6>
                                            <p class="designation"><?php echo $item['reviewer_designation']; ?></p>
                                        </div>
                                    </div>
                                    <div class="quote-icon">
                                        <i class="pi-quote-3"></i>
                                    </div>
                                </div>
                                <div class="bg"></div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

        <?php elseif ( $settings['protine_design_style']  == 'layout-4' ): ?>

            <div class="testimonial style-four">
                <div class="testi-wrapper">
                    <div class="testi-center">
                        <div class="shape"></div>
                        <h2 class="title"><?php echo $settings['testi_title']; ?></h2>
                    </div>
                    <?php
                    $i = 0;
                    foreach ($settings['reviews_list'] as $index => $item) :
                        $i++;
                        if ( !empty($item['reviewer_image']['url']) ) {
                            $reviewer_image = !empty($item['reviewer_image']['id']) ? wp_get_attachment_image_url( $item['reviewer_image']['id']) : $item['reviewer_image']['url'];
                        }
                    ?>
                    <div class="single-testimonial item-<?php echo $i; ?>">
                        <div class="testi-head">
                            <div class="client-info">
                                <div class="text">
                                    <div class="quote-icon">
                                        <i class="pi-quote-2"></i>
                                    </div>
                                    <div class="info">
                                        <h6 class="name"><?php echo $item['reviewer_name']; ?></h6>
                                        <p class="designation"><?php echo $item['reviewer_designation']; ?></p>
                                    </div>
                                </div>
                                <?php if(!empty($reviewer_image)) : ?>
                                    <div class="image">
                                        <img src="<?php echo esc_url($reviewer_image); ?>" alt="image">
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="testi-content">
                            <?php if ( !empty($item['review_content']) ) : ?>
                                <p><?php echo $item['review_content']; ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
        <?php 
	}
}

$widgets_manager->register( new Protine_Testimonial() );