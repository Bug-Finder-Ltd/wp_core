<?php
namespace ZupetCore\Widgets;

if ( ! defined( 'ABSPATH' ) ) exit;

class Zupet_Testimonial extends \Elementor\Widget_Base {

	public function get_name() {
		return 'zupet-testimonial';
	}

	public function get_title() {
		return __( 'Zupet Testimonial', 'zupetcore' );
	}

	public function get_icon() {
		return 'zupet-icon';
	}

	public function get_categories() {
		return [ 'zupetcore' ];
	}

	public function get_script_depends() {
		return [ 'zupetcore' ];
	}

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
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'layout-1' => esc_html__('Layout 1', 'zupetcore'),
                    'layout-2' => esc_html__('Layout 2', 'zupetcore'),
                    'layout-3' => esc_html__('Layout 3', 'zupetcore'),
                    'layout-4' => esc_html__('Layout 4', 'zupetcore'),
                ],
                'default' => 'layout-1',
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'title_section',
            [
                'label' => esc_html__('Title', 'zupetcore'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
            $this->add_control(
                'testi_title',
                [
                    'label' => esc_html__( 'Title', 'zupetcore' ),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => esc_html__( 'Default title', 'zupetcore' ),
                    'placeholder' => esc_html__( 'Type your title here', 'zupetcore' ),
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
                'label' => esc_html__( 'Review List', 'zupetcore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();


        $repeater->add_control(
            'reviewer_image',
            [
                'label' => esc_html__( 'Reviewer Image', 'zupetcore' ),
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
                'label' => esc_html__( 'Reviewer Name', 'zupetcore' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Rasalina William' , 'zupetcore' ),
                'label_block' => true,
            ]
        );        

        $repeater->add_control(
            'reviewer_designation', [
                'label' => esc_html__( 'Designation', 'zupetcore' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( '- CEO' , 'zupetcore' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'rating',
            [
                'label' => esc_html__( 'Rating', 'zupetcore' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 5,
                'step' => 1,
                'default' => 5,
            ]
        );

        $repeater->add_control(
            'review_content',
            [
                'label' => esc_html__( 'Review Content', 'zupetcore' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 10,
                'default' => 'Aklima The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections Bonorum et Malorum original.',
                'placeholder' => esc_html__( 'Type your review content here', 'zupetcore' ),
            ]
        );

        $repeater->add_control(
            'quote_icon',
            [
                'label' => esc_html__( 'Quote Icon', 'zupetcore' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'reviews_list',
            [
                'label' => esc_html__( 'Review List', 'zupetcore' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' =>  $repeater->get_controls(),
                'default' => [
                    [
                        'reviewer_name' => esc_html__( 'Rasalina William', 'zupetcore' ),
                        'reviewer_designation' => esc_html__( 'CEO', 'zupetcore' ),
                        'review_content' => esc_html__( 'Put your trust in us &share in our people with a passion.We are motivated by the satisfaction H.Spond Asset Management is made up of a team of expert, committed and experienced for of clients financial markets. Our goal is to achieve continuous.', 'zupetcore' ),
                    ],
                    [
                        'reviewer_name' => esc_html__( 'Rasalina William', 'zupetcore' ),
                        'reviewer_designation' => esc_html__( 'MD', 'zupetcore' ),
                        'review_content' => esc_html__( 'Put your trust in us &share in our people with a passion.We are motivated by the satisfaction H.Spond Asset Management is made up of a team of expert, committed and experienced for of clients financial markets. Our goal is to achieve continuous.', 'zupetcore' ),
                    ],
                    [
                        'reviewer_name' => esc_html__( 'Rasalina William', 'zupetcore' ),
                        'reviewer_designation' => esc_html__( 'Manager', 'zupetcore' ),
                        'review_content' => esc_html__( 'Put your trust in us &share in our people with a passion.We are motivated by the satisfaction H.Spond Asset Management is made up of a team of expert, committed and experienced for of clients financial markets. Our goal is to achieve continuous.', 'zupetcore' ),
                    ],

                ],
                'title_field' => '{{{ reviewer_name }}}',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Image_Size::get_type(),
            [
                'name' => 'zupet_image_size',
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
                'label' => esc_html__( 'Name', 'zupetcore' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
            $this->add_control(
                'name_color',
                [
                    'label' => esc_html__( 'Color', 'zupetcore' ),
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
                    'label' => esc_html__( 'Margin', 'zupetcore' ),
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
                'label' => esc_html__( 'Designation', 'zupetcore' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
            $this->add_control(
                'designation_color',
                [
                    'label' => esc_html__( 'Color', 'zupetcore' ),
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
                    'label' => esc_html__( 'Margin', 'zupetcore' ),
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
                'label' => esc_html__( 'Quote', 'zupetcore' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
            $this->add_control(
                'quote_color',
                [
                    'label' => esc_html__( 'Color', 'zupetcore' ),
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
                    'label' => esc_html__( 'Margin', 'zupetcore' ),
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
    ?>

        <?php if ( $settings['zupet_design_style']  == 'layout-1' ):
            $quote_icon = PROTINE_ADDONS_URL . 'assets/img/icons/quote-icon.png';
            ?>
        
        <div class="testimonial style-one">
            <div class="row">
                <div class="col-lg-3">
                    <div class="testimonial-icon">
                        <img src="<?php echo esc_url($quote_icon); ?>" alt="<?php esc_html_e('quote-icon', 'zupetcore'); ?>">
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="single-item-carousel swiper-container">
                        <div class="swiper-wrapper">
                            <?php foreach (  $settings['reviews_list'] as $item ) :
                                if ( !empty($item['reviewer_image']['url']) ) {
                                    $reviewer_image = !empty($item['reviewer_image']['id']) ? wp_get_attachment_image_url( $item['reviewer_image']['id']) : $item['reviewer_image']['url'];
                                }
                                ?>
                                <div class="swiper-slide testimonial-single">
                                    <div class="testimonial-content">
                                        <?php if($item['rating'] == 5) : ?>
                                        <div class="star-rating">
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                        </div>
                                        <?php elseif($item['rating'] == 4) : ?>
                                        <div class="star-rating">
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-regular fa-star"></i>
                                        </div>
                                        <?php elseif($item['rating'] == 3) : ?>
                                        <div class="star-rating">
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-regular fa-star"></i>
                                            <i class="fa-regular fa-star"></i>
                                        </div>
                                        <?php elseif($item['rating'] == 2) : ?>
                                        <div class="star-rating">
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-regular fa-star"></i>
                                            <i class="fa-regular fa-star"></i>
                                            <i class="fa-regular fa-star"></i>
                                        </div>
                                        <?php elseif($item['rating'] == 1) : ?>
                                        <div class="star-rating">
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-regular fa-star"></i>
                                            <i class="fa-regular fa-star"></i>
                                            <i class="fa-regular fa-star"></i>
                                            <i class="fa-regular fa-star"></i>
                                        </div>
                                        <?php endif; ?>

                                        <div class="quote">
                                            <p><?php echo $item['review_content']; ?></p>
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
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="arrow-nav">
                <div class="custom-prev swiper-navigetions">
                    <i class="icon-arrow-left"></i>
                </div>
                <div class="custom-next swiper-navigetions">
                    <i class="icon-arrow-right"></i>
                </div>
            </div>
        </div>

		<?php elseif ( $settings['zupet_design_style']  == 'layout-2' ): ?>

        <div class="testimonial style-two">
            <div class="single-item-carousel swiper-container">
                <div class="swiper-wrapper">
                    <?php foreach ( $settings['reviews_list'] as $item ) :
                        if ( !empty($item['reviewer_image']['url']) ) {
                            $reviewer_image = !empty($item['reviewer_image']['id']) ? wp_get_attachment_image_url( $item['reviewer_image']['id']) : $item['reviewer_image']['url'];
                        }
                        ?>
                        <div class="swiper-slide testimonial-single">
                            <div class="testimonial-content">
                                <?php if($item['rating'] == 5) : ?>
                                    <div class="star-rating">
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                    </div>
                                <?php elseif($item['rating'] == 4) : ?>
                                    <div class="star-rating">
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-regular fa-star"></i>
                                    </div>
                                <?php elseif($item['rating'] == 3) : ?>
                                    <div class="star-rating">
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-regular fa-star"></i>
                                        <i class="fa-regular fa-star"></i>
                                    </div>
                                <?php elseif($item['rating'] == 2) : ?>
                                    <div class="star-rating">
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-regular fa-star"></i>
                                        <i class="fa-regular fa-star"></i>
                                        <i class="fa-regular fa-star"></i>
                                    </div>
                                <?php elseif($item['rating'] == 1) : ?>
                                    <div class="star-rating">
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-regular fa-star"></i>
                                        <i class="fa-regular fa-star"></i>
                                        <i class="fa-regular fa-star"></i>
                                        <i class="fa-regular fa-star"></i>
                                    </div>
                                <?php endif; ?>

                                <div class="quote">
                                    <p><?php echo $item['review_content']; ?></p>
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
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="nav-seperator"></div>
            <div class="arrow-nav">
                <div class="custom-prev swiper-navigetions">
                    <i class="icon-arrow-left"></i>
                </div>
                <div class="custom-next swiper-navigetions">
                    <i class="icon-arrow-right"></i>
                </div>
            </div>
        </div>

        <?php elseif ( $settings['zupet_design_style']  == 'layout-3' ): ?>

            <div class="testimonial style-three">
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

        <?php elseif ( $settings['zupet_design_style']  == 'layout-4' ): ?>

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

$widgets_manager->register( new Zupet_Testimonial() );