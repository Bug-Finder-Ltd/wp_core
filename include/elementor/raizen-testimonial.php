<?php
namespace RaizenCore\Widgets;

if ( ! defined( 'ABSPATH' ) ) exit;

class Raizen_Testimonial extends \Elementor\Widget_Base {

	public function get_name() {
		return 'raizen-testimonial';
	}

	public function get_title() {
		return __( 'Raizen Testimonial', 'raizencore' );
	}

	public function get_icon() {
		return 'raizen-icon';
	}

	public function get_categories() {
		return [ 'raizencore' ];
	}

	public function get_script_depends() {
		return [ 'raizencore' ];
	}

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
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'layout-1' => esc_html__('Layout 1', 'raizencore'),
                    'layout-2' => esc_html__('Layout 2', 'raizencore'),
                    'layout-3' => esc_html__('Layout 3', 'raizencore'),
                    'layout-4' => esc_html__('Layout 4', 'raizencore'),
                    'layout-5' => esc_html__('Layout 5', 'raizencore'),
                    'layout-6' => esc_html__('Layout 6', 'raizencore'),
                ],
                'default' => 'layout-1',
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'title_section',
            [
                'label' => esc_html__('Title', 'raizencore'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
            $this->add_control(
                'testi_title',
                [
                    'label' => esc_html__( 'Title', 'raizencore' ),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => esc_html__( 'Default title', 'raizencore' ),
                    'placeholder' => esc_html__( 'Type your title here', 'raizencore' ),
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
                'label' => esc_html__( 'Review List', 'raizencore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();


        $repeater->add_control(
            'reviewer_image',
            [
                'label' => esc_html__( 'Reviewer Image', 'raizencore' ),
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
            'circuler_image',
            [
                'label' => esc_html__( 'Circuler Image', 'raizencore' ),
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
                'label' => esc_html__( 'Reviewer Name', 'raizencore' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Rasalina William' , 'raizencore' ),
                'label_block' => true,
            ]
        );        

        $repeater->add_control(
            'reviewer_designation', [
                'label' => esc_html__( 'Designation', 'raizencore' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( '- CEO' , 'raizencore' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'rating',
            [
                'label' => esc_html__( 'Rating', 'raizencore' ),
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
                'label' => esc_html__( 'Review Content', 'raizencore' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 10,
                'default' => 'Aklima The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections Bonorum et Malorum original.',
                'placeholder' => esc_html__( 'Type your review content here', 'raizencore' ),
            ]
        );

        $repeater->add_control(
            'quote_icon',
            [
                'label' => esc_html__( 'Quote Icon', 'raizencore' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'reviews_list',
            [
                'label' => esc_html__( 'Review List', 'raizencore' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' =>  $repeater->get_controls(),
                'default' => [
                    [
                        'reviewer_name' => esc_html__( 'Rasalina William', 'raizencore' ),
                        'reviewer_designation' => esc_html__( 'CEO', 'raizencore' ),
                        'review_content' => esc_html__( 'Put your trust in us &share in our people with a passion.We are motivated by the satisfaction H.Spond Asset Management is made up of a team of expert, committed and experienced for of clients financial markets. Our goal is to achieve continuous.', 'raizencore' ),
                    ],
                    [
                        'reviewer_name' => esc_html__( 'Rasalina William', 'raizencore' ),
                        'reviewer_designation' => esc_html__( 'MD', 'raizencore' ),
                        'review_content' => esc_html__( 'Put your trust in us &share in our people with a passion.We are motivated by the satisfaction H.Spond Asset Management is made up of a team of expert, committed and experienced for of clients financial markets. Our goal is to achieve continuous.', 'raizencore' ),
                    ],
                    [
                        'reviewer_name' => esc_html__( 'Rasalina William', 'raizencore' ),
                        'reviewer_designation' => esc_html__( 'Manager', 'raizencore' ),
                        'review_content' => esc_html__( 'Put your trust in us &share in our people with a passion.We are motivated by the satisfaction H.Spond Asset Management is made up of a team of expert, committed and experienced for of clients financial markets. Our goal is to achieve continuous.', 'raizencore' ),
                    ],

                ],
                'title_field' => '{{{ reviewer_name }}}',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Image_Size::get_type(),
            [
                'name' => 'raizen_image_size',
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
                'label' => esc_html__( 'Name', 'raizencore' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
            $this->add_control(
                'name_color',
                [
                    'label' => esc_html__( 'Color', 'raizencore' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .testimonial-content .name' => 'color: {{VALUE}}',
                    ],
                ]
            );
            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'name_typography',
                    'selector' => '{{WRAPPER}} .testimonial-content .name',
                ]
            );
            $this->add_control(
                'name_margin',
                [
                    'label' => esc_html__( 'Margin', 'raizencore' ),
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .testimonial-content .name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
        $this->end_controls_section();

        $this->start_controls_section(
            'designation_section',
            [
                'label' => esc_html__( 'Designation', 'raizencore' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
            $this->add_control(
                'designation_color',
                [
                    'label' => esc_html__( 'Color', 'raizencore' ),
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
                    'label' => esc_html__( 'Margin', 'raizencore' ),
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
                'label' => esc_html__( 'Quote', 'raizencore' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
            $this->add_control(
                'quote_color',
                [
                    'label' => esc_html__( 'Color', 'raizencore' ),
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
                    'label' => esc_html__( 'Margin', 'raizencore' ),
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

        <?php if ( $settings['raizen_design_style']  == 'layout-1' ):
            $quote_icon = PROTINE_ADDONS_URL . 'assets/img/icons/quote-icon.png';
            ?>
        
        <div class="testimonial style-one">
            <div class="single-item-carousel swiper-container">
                <div class="swiper-wrapper">
                    <?php foreach (  $settings['reviews_list'] as $item ) :
                        if ( !empty($item['reviewer_image']['url']) ) {
                            $reviewer_image = !empty($item['reviewer_image']['id']) ? wp_get_attachment_image_url( $item['reviewer_image']['id'], '') : $item['reviewer_image']['url'];
                        }
                        if ( !empty($item['circuler_image']['url']) ) {
                            $circuler_image = !empty($item['circuler_image']['id']) ? wp_get_attachment_image_url( $item['circuler_image']['id'], '') : $item['circuler_image']['url'];
                        }
                        ?>
                        <div class="swiper-slide testimonial-single">
                            <div class="testimonial-content">
                                <div class="client-image">
                                    <?php if(!empty($reviewer_image)) : ?>
                                        <div class="circuler-center">
                                            <img src="<?php echo esc_url($reviewer_image); ?>" alt="image">
                                        </div>
                                    <?php endif; ?>
                                    <div class="circuler-text">
                                        <img src="<?php echo esc_url($circuler_image); ?>" alt="image">
                                    </div>
                                </div>
                                <div class="quote">
                                    <p><?php echo $item['review_content']; ?></p>
                                </div>
                                <div class="client-info">
                                    <div class="text">
                                        <h5 class="name"><?php echo $item['reviewer_name']; ?></h5>
                                        <p class="designation"><?php echo $item['reviewer_designation']; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

		<?php elseif ( $settings['raizen_design_style']  == 'layout-2' ):
            $quote_icon = PROTINE_ADDONS_URL . 'assets/img/icons/quote-icon.png';
            ?>

        <div class="testimonial style-two">
            <div class="three-item-carousel swiper-container">
                <div class="swiper-wrapper">
                    <?php foreach (  $settings['reviews_list'] as $item ) :
                        if ( !empty($item['reviewer_image']['url']) ) {
                            $reviewer_image = !empty($item['reviewer_image']['id']) ? wp_get_attachment_image_url( $item['reviewer_image']['id'], '') : $item['reviewer_image']['url'];
                        }
                        if ( !empty($item['circuler_image']['url']) ) {
                            $circuler_image = !empty($item['circuler_image']['id']) ? wp_get_attachment_image_url( $item['circuler_image']['id'], '') : $item['circuler_image']['url'];
                        }
                        ?>
                        <div class="swiper-slide testimonial-item">
                            <div class="testimonial-content">
                                <div class="quote-icon">
                                    <img src="<?php echo esc_url($quote_icon); ?>" alt="<?php esc_html_e('icon', 'raizencore'); ?>">
                                </div>
                                <div class="quote">
                                    <p><?php echo $item['review_content']; ?></p>
                                </div>
                                <div class="client-info">
                                    <h5 class="name"><?php echo $item['reviewer_name']; ?></h5>
                                    <p class="designation"><?php echo $item['reviewer_designation']; ?></p>
                                </div>
                            </div>
                            <?php if(!empty($reviewer_image)) : ?>
                                <div class="client-image">
                                    <img src="<?php echo esc_url($reviewer_image); ?>" alt="image">
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <?php elseif ( $settings['raizen_design_style']  == 'layout-3' ):
            $quote_icon = PROTINE_ADDONS_URL . 'assets/img/icons/quote-icon.png';

            $arrow_1 = PROTINE_ADDONS_URL . 'assets/img/icons/arrow-3.png';
            $arrow_2 = PROTINE_ADDONS_URL . 'assets/img/icons/arrow-4.png';
            ?>

            <div class="testimonial style-three">
                <div class="testi-carousel">
                    <div class="swiper-wrapper">
                        <?php foreach (  $settings['reviews_list'] as $item ) :
                        if ( !empty($item['reviewer_image']['url']) ) {
                            $reviewer_image = !empty($item['reviewer_image']['id']) ? wp_get_attachment_image_url( $item['reviewer_image']['id'], '') : $item['reviewer_image']['url'];
                        }
                        if ( !empty($item['circuler_image']['url']) ) {
                            $circuler_image = !empty($item['circuler_image']['id']) ? wp_get_attachment_image_url( $item['circuler_image']['id'], '') : $item['circuler_image']['url'];
                        }
                        ?>
                        <div class="swiper-slide testimonial-item">
                            <div class="testimonial-content">
                                <div class="quote-icon">
                                    <img src="<?php echo esc_url($quote_icon); ?>" alt="<?php esc_html_e('icon', 'raizencore'); ?>">
                                </div>
                                <div class="quote">
                                    <p><?php echo $item['review_content']; ?></p>
                                </div>
                                <div class="client-info">
                                    <h5 class="name"><?php echo $item['reviewer_name']; ?></h5>
                                    <p class="designation"><?php echo $item['reviewer_designation']; ?></p>
                                </div>
                            </div>
                            <?php if(!empty($reviewer_image)) : ?>
                                <div class="client-image">
                                    <img src="<?php echo esc_url($reviewer_image); ?>" alt="image">
                                </div>
                            <?php endif; ?>
                        </div>

                        <?php endforeach; ?>
                    </div>

                    <!-- Navigation -->
                    <div class="button-prev" aria-label="Previous slide">
                        <img src="<?php echo esc_url($arrow_1); ?>" alt="<?php esc_html_e('icon', 'raizencore'); ?>">
                    </div>
                    <div class="button-next" aria-label="Next slide">
                        <img src="<?php echo esc_url($arrow_2); ?>" alt="<?php esc_html_e('icon', 'raizencore'); ?>">
                    </div>
                </div>
            </div>

        <?php elseif ( $settings['raizen_design_style']  == 'layout-4' ): ?>

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

        <?php elseif ( $settings['raizen_design_style']  == 'layout-5' ): ?>

        <div class="testimonial style-five">
            <div class="row">
                <div class="col-lg-3">
                    <div class="testimonial-icon">
                        <img src="<?php echo esc_url($quote_icon); ?>" alt="<?php esc_html_e('quote-icon', 'raizencore'); ?>">
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

    <?php elseif ( $settings['raizen_design_style']  == 'layout-6' ): ?>

        <div class="testimonial style-six">
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

    <?php endif; ?>
        <?php 
	}
}

$widgets_manager->register( new Raizen_Testimonial() );