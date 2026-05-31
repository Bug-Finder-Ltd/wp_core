<?php
namespace ProvixCore\Widgets;

if ( ! defined( 'ABSPATH' ) ) exit;

class Provix_Testimonial extends \Elementor\Widget_Base {

	public function get_name() {
		return 'provix-testimonial';
	}

	public function get_title() {
		return __( 'Testimonial', 'agenvix-core' );
	}

	public function get_icon() {
		return 'provix-icon';
	}

	public function get_categories() {
		return [ 'agenvix-core' ];
	}

	public function get_script_depends() {
		return [ 'agenvix-core' ];
	}

	protected function register_controls() {

        /**
         * Layout section
         */
        $this->start_controls_section(
            'provix_layout',
            [
                'label' => esc_html__('Design Layout', 'agenvix-core'),
            ]
        );
        $this->add_control(
            'provix_design_style',
            [
                'label' => esc_html__('Select Layout', 'agenvix-core'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'layout-1' => esc_html__( 'Layout 1', 'agenvix-core' ),
                    'layout-2' => esc_html__( 'Layout 2', 'agenvix-core' ),
                    'layout-3' => esc_html__( 'Layout 3', 'agenvix-core' ),
                    'layout-4' => esc_html__( 'Layout 4', 'agenvix-core' ),
                    'layout-5' => esc_html__( 'Layout 5', 'agenvix-core' ),
                    'layout-6' => esc_html__( 'Layout 6', 'agenvix-core' ),
                    'layout-7' => esc_html__( 'Layout 7', 'agenvix-core' ),
                    'layout-8' => esc_html__( 'Layout 8', 'agenvix-core' ),
                ],
                'default' => 'layout-1',
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'title_section',
            [
                'label' => esc_html__('Title', 'agenvix-core'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
            $this->add_control(
                'testi_title',
                [
                    'label' => esc_html__( 'Title', 'agenvix-core' ),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => esc_html__( 'Default title', 'agenvix-core' ),
                    'placeholder' => esc_html__( 'Type your title here', 'agenvix-core' ),
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
                'label' => esc_html__( 'Review List', 'agenvix-core' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'media_type',
			[
				'label'   => esc_html__( 'Media Type', 'agenvix-core' ),
				'type'    => \Elementor\Controls_Manager::CHOOSE,
				'default' => 'image',
				'options' => [
					'image' => [
						'title' => esc_html__( 'Image', 'agenvix-core' ),
						'icon' => 'eicon-image',
					],
					'video' => [
						'title' => esc_html__( 'Video', 'agenvix-core' ),
						'icon' => 'eicon-video',
					],
				],
			]
		);
        $repeater->add_control(
            'reviewer_image',
            [
                'label' => esc_html__( 'Reviewer Image', 'agenvix-core' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
				'condition' => [
					'media_type' => 'image',
				],
            ]
        );
		$repeater->add_control(
			'reviewer_video',
			[
				'label'     => esc_html__( 'Video', 'agenvix-core' ),
				'type'      => \Elementor\Controls_Manager::MEDIA,
				'media_types' => [ 'video' ],
				'condition' => [
					'media_type' => 'video',
				],
			]
		);
        $repeater->add_control(
            'reviewer_name', [
                'label' => esc_html__( 'Reviewer Name', 'agenvix-core' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Rasalina William' , 'agenvix-core' ),
                'label_block' => true,
            ]
        );        

        $repeater->add_control(
            'reviewer_designation', [
                'label' => esc_html__( 'Designation', 'agenvix-core' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( '- CEO' , 'agenvix-core' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'rating',
            [
                'label' => esc_html__( 'Rating', 'agenvix-core' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 5,
                'step' => 0.1,
                'default' => 5,
            ]
        );

        $repeater->add_control(
            'review_content',
            [
                'label' => esc_html__( 'Review Content', 'agenvix-core' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 10,
                'default' => 'Aklima The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections Bonorum et Malorum original.',
                'placeholder' => esc_html__( 'Type your review content here', 'agenvix-core' ),
            ]
        );
        $repeater->add_control(
            'quote_icon',
            [
                'label' => esc_html__( 'Quote Icon', 'agenvix-core' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $repeater->add_control(
			'facebook_link',
			[
				'label' => esc_html__( 'Facebook Link', 'agenvix-core' ),
				'type' => \Elementor\Controls_Manager::URL,
				'options' => [ 'url', 'is_external', 'nofollow' ],
				'default' => [
					'url' => '#',
					'is_external' => true,
					'nofollow' => true,
					// 'custom_attributes' => '',
				],
				'label_block' => true,
			]
		);
        $repeater->add_control(
			'instagram_link',
			[
				'label' => esc_html__( 'Instagram Link', 'agenvix-core' ),
				'type' => \Elementor\Controls_Manager::URL,
				'options' => [ 'url', 'is_external', 'nofollow' ],
				'default' => [
					'url' => '#',
					'is_external' => true,
					'nofollow' => true,
					// 'custom_attributes' => '',
				],
				'label_block' => true,
			]
		);
        $repeater->add_control(
			'twitter_link',
			[
				'label' => esc_html__( 'Twitter Link', 'agenvix-core' ),
				'type' => \Elementor\Controls_Manager::URL,
				'options' => [ 'url', 'is_external', 'nofollow' ],
				'default' => [
					'url' => '#',
					'is_external' => true,
					'nofollow' => true,
					// 'custom_attributes' => '',
				],
				'label_block' => true,
			]
		);
        $repeater->add_control(
			'linkedin_link',
			[
				'label' => esc_html__( 'Linkedin Link', 'agenvix-core' ),
				'type' => \Elementor\Controls_Manager::URL,
				'options' => [ 'url', 'is_external', 'nofollow' ],
				'default' => [
					'url' => '#',
					'is_external' => true,
					'nofollow' => true,
					// 'custom_attributes' => '',
				],
				'label_block' => true,
			]
		);

        $this->add_control(
            'reviews_list',
            [
                'label' => esc_html__( 'Review List', 'agenvix-core' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' =>  $repeater->get_controls(),
                'default' => [
                    [
                        'reviewer_name' => esc_html__( 'Rasalina William', 'agenvix-core' ),
                        'reviewer_designation' => esc_html__( 'CEO', 'agenvix-core' ),
                        'review_content' => esc_html__( 'Put your trust in us &share in our people with a passion.We are motivated by the satisfaction H.Spond Asset Management is made up of a team of expert, committed and experienced for of clients financial markets. Our goal is to achieve continuous.', 'agenvix-core' ),
                    ],
                    [
                        'reviewer_name' => esc_html__( 'Rasalina William', 'agenvix-core' ),
                        'reviewer_designation' => esc_html__( 'MD', 'agenvix-core' ),
                        'review_content' => esc_html__( 'Put your trust in us &share in our people with a passion.We are motivated by the satisfaction H.Spond Asset Management is made up of a team of expert, committed and experienced for of clients financial markets. Our goal is to achieve continuous.', 'agenvix-core' ),
                    ],
                    [
                        'reviewer_name' => esc_html__( 'Rasalina William', 'agenvix-core' ),
                        'reviewer_designation' => esc_html__( 'Manager', 'agenvix-core' ),
                        'review_content' => esc_html__( 'Put your trust in us &share in our people with a passion.We are motivated by the satisfaction H.Spond Asset Management is made up of a team of expert, committed and experienced for of clients financial markets. Our goal is to achieve continuous.', 'agenvix-core' ),
                    ],

                ],
                'title_field' => '{{{ reviewer_name }}}',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Image_Size::get_type(),
            [
                'name' => 'provix_image_size',
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
                'label' => esc_html__( 'Name', 'agenvix-core' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
            $this->add_control(
                'name_color',
                [
                    'label' => esc_html__( 'Color', 'agenvix-core' ),
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
                    'label' => esc_html__( 'Margin', 'agenvix-core' ),
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
                'label' => esc_html__( 'Designation', 'agenvix-core' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
            $this->add_control(
                'designation_color',
                [
                    'label' => esc_html__( 'Color', 'agenvix-core' ),
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
                    'label' => esc_html__( 'Margin', 'agenvix-core' ),
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
                'label' => esc_html__( 'Quote', 'agenvix-core' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
            $this->add_control(
                'quote_color',
                [
                    'label' => esc_html__( 'Color', 'agenvix-core' ),
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
                    'label' => esc_html__( 'Margin', 'agenvix-core' ),
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
	 * Render the widget ouprovixut on the frontend.
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

    <?php if ( $settings['provix_design_style']  == 'layout-1' ):
        $quote_icon = PROTINE_ADDONS_URL . 'assets/img/icons/quote-icon.png';
        ?>
        
        <div class="testimonial style-one">
            <div class="row">
                <div class="col-lg-3">
                    <div class="testimonial-icon">
                        <img src="<?php echo esc_url($quote_icon); ?>" alt="<?php esc_html_e('quote-icon', 'agenvix-core'); ?>">
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

	<?php elseif ( $settings['provix_design_style']  == 'layout-2' ): ?>

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
                                <div class="quote-icon">
									<i class="fa-solid fa-quote-left"></i>
								</div>
                                <div class="quote">
                                    <p><?php echo $item['review_content']; ?></p>
                                </div>
                                <div class="client-info">
                                    <h6 class="name"><?php echo $item['reviewer_name']; ?></h6>
                                    <p class="designation"><?php echo $item['reviewer_designation']; ?></p>
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
                <div class="custom-next swiper-navigetions">
                    <i class="icon-arrow-right"></i>
                </div>
            </div>
        </div>

    <?php elseif ( $settings['provix_design_style']  == 'layout-3' ): ?>

            <div class="testimonial style-three">
                <div class="testimonial-slider-container">
                    <div class="two-item-carousel swiper-container testimonial-slider">
                        <div class="swiper-wrapper">
                            <?php foreach ($settings['reviews_list'] as $index => $item) :
                                if ( !empty($item['reviewer_image']['url']) ) {
                                    $reviewer_image = !empty($item['reviewer_image']['id']) ? wp_get_attachment_image_url( $item['reviewer_image']['id'], '') : $item['reviewer_image']['url'];
                                }
                            ?>
                            <div class="swiper-slide">
                                <div class="testimonial-item">
                                    <div class="client-info">
                                        <?php if(!empty($reviewer_image)) : ?>
                                            <img src="<?php echo esc_url($reviewer_image); ?>" alt="image">
                                        <?php endif; ?>
                                    </div>
                                    <div class="content">
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
                                        <p class="quote"><?php echo $item['review_content']; ?></p>
                                        <div class="bio">
                                            <h5 class="name"><?php echo $item['reviewer_name']; ?></h5>
                                            <p class="designation"><?php echo $item['reviewer_designation']; ?></p>
                                        </div>
                                        <div class="icon">
                                            <i class="fa-solid fa-quote-left"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="arrow-nav">
                        <div class="custom-prev swiper-navigetions">
                            <i class="fa-regular fa-arrow-left"></i>
                        </div>
                        <div class="custom-next swiper-navigetions">
                            <i class="fa-regular fa-arrow-right"></i>
                        </div>
                    </div>
                </div>
            </div>

    <?php elseif ( $settings['provix_design_style']  == 'layout-4' ): ?>

        <div class="testimonial style-four">
            <div class="slider__pagination"></div>
            <div class="testimonial-wrapper">
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <?php foreach ( $settings['reviews_list'] as $item ) :
                        if ( !empty($item['reviewer_image']['url']) ) {
                            $reviewer_image = !empty($item['reviewer_image']['id']) ? wp_get_attachment_image_url( $item['reviewer_image']['id'], '' ) : $item['reviewer_image']['url'];
                        }
                        ?>
                        <div class="swiper-slide testimonial-single">
                            <div class="testimonial-image">
                                <ul class="social-icons">
                                    <?php if( !empty($item['facebook_link']['url']) ) : ?>
                                    <li><span class="dot"></span><a href="<?php echo esc_url($item['facebook_link']['url']); ?>"><?php echo esc_html_e("Facebook", 'agenvix-core'); ?></a></li>
                                    <?php endif; ?>
                                    
                                    <?php if( !empty($item['instagram_link']['url']) ) : ?>
                                    <li><span class="dot"></span><a href="<?php echo esc_url($item['instagram_link']['url']); ?>"><?php echo esc_html_e("Instagram", 'agenvix-core'); ?></a></li>
                                    <?php endif; ?>

                                    <?php if( !empty($item['twitter_link']['url']) ) : ?>
                                    <li><span class="dot"></span><a href="<?php echo esc_url($item['twitter_link']['url']); ?>"><?php echo esc_html_e("Twitter", 'agenvix-core'); ?></a></li>
                                    <?php endif; ?>
                                    
                                    <?php if( !empty($item['linkedin_link']['url']) ) : ?>
                                    <li><span class="dot"></span><a href="<?php echo esc_url($item['linkedin_link']['url']); ?>"><?php echo esc_html_e("Linkedin", 'agenvix-core'); ?></a></li>
                                    <?php endif; ?>
                                </ul>
                                <?php if(!empty($reviewer_image)) : ?>
                                    <img src="<?php echo esc_url($reviewer_image); ?>" alt="image">
                                <?php endif; ?>
                            </div>
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
                                    <h6 class="name"><?php echo $item['reviewer_name']; ?></h6>
                                    <p class="designation"><?php echo $item['reviewer_designation']; ?></p>
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
                <div class="custom-next swiper-navigetions">
                    <i class="icon-arrow-right"></i>
                </div>
            </div>
            </div>
        </div>

    <?php elseif ( $settings['provix_design_style']  == 'layout-5' ) : ?>

        <div class="testimonial style-five">
			<div class="section-ttile">
				<div class="left"></div>
				<div class="right">
					<h2 class="title"><?php echo $settings['testi_title']; ?></h2>
				</div>
			</div>
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <?php foreach ( $settings['reviews_list'] as $item ) :
                        if ( !empty($item['reviewer_image']['url']) ) {
                            $reviewer_image = !empty($item['reviewer_image']['id']) ? wp_get_attachment_image_url( $item['reviewer_image']['id'], '' ) : $item['reviewer_image']['url'];
                        }
                        ?>
                        <div class="swiper-slide testimonial-single">
                            <div class="testimonial-image" data-swiper-parallax="-200">
                                <ul class="social-icons">
                                    <?php if( !empty($item['facebook_link']['url']) ) : ?>
                                    <li><span class="dot"></span><a href="<?php echo esc_url($item['facebook_link']['url']); ?>"><?php echo esc_html_e("Facebook", 'agenvix-core'); ?></a></li>
                                    <?php endif; ?>
                                    
                                    <?php if( !empty($item['instagram_link']['url']) ) : ?>
                                    <li><span class="dot"></span><a href="<?php echo esc_url($item['instagram_link']['url']); ?>"><?php echo esc_html_e("Instagram", 'agenvix-core'); ?></a></li>
                                    <?php endif; ?>

                                    <?php if( !empty($item['twitter_link']['url']) ) : ?>
                                    <li><span class="dot"></span><a href="<?php echo esc_url($item['twitter_link']['url']); ?>"><?php echo esc_html_e("Twitter", 'agenvix-core'); ?></a></li>
                                    <?php endif; ?>
                                    
                                    <?php if( !empty($item['linkedin_link']['url']) ) : ?>
                                    <li><span class="dot"></span><a href="<?php echo esc_url($item['linkedin_link']['url']); ?>"><?php echo esc_html_e("Linkedin", 'agenvix-core'); ?></a></li>
                                    <?php endif; ?>
                                </ul>
                                
								<?php if( !empty($item['reviewer_video']['url']) ) : ?>
                                <div class="video is-playing">
									<video 
                                        autoplay
										muted 
										loop 
										playsinline
										class="custom-video"
									>
										<source src="<?php echo esc_url( $item['reviewer_video']['url'] ); ?>" type="video/mp4">
									</video>

									<button class="video-toggle-btn" aria-label="Play / Pause video">
										<span class="icon-play">
											<i class="fa-solid fa-play"></i>
										</span>
										<span class="icon-pause">
											<i class="fa-solid fa-pause"></i>
										</span>
									</button>
								</div>
								<?php endif; ?>
                            </div>
                            <div class="testimonial-content" data-swiper-parallax="0">
                                <div class="quote">
                                    <p><?php echo $item['review_content']; ?></p>
                                </div>
                                <div class="client-info">
                                    <h6 class="name"><?php echo $item['reviewer_name']; ?></h6>
                                    <p class="designation"><?php echo $item['reviewer_designation']; ?></p>
                                </div>
                                <div class="rating">
                                    <?php
                                        $rating = floatval($item['rating']);
                                        $full   = floor($rating);
                                        $half   = ($rating - $full) >= 0.5 ? 1 : 0;
                                        $empty  = 5 - $full - $half;
                                    ?>
                                    <div class="rating-number">
										<?php echo esc_html($rating); ?>
									</div>
									<div>
										<div class="star-rating">
											<?php for ($i = 0; $i < $full; $i++) : ?>
												<i class="fa-solid fa-star"></i>
											<?php endfor; ?>
											
											<?php if ($half) : ?>
										        <i class="fa-solid fa-star-half-stroke"></i>
											<?php endif; ?>
											
											<?php for ($i = 0; $i < $empty; $i++) : ?>
											    <i class="fa-regular fa-star"></i>
											<?php endfor; ?>
										</div>
										<p class="avg-rating"><?php esc_html_e('Average Rating', 'agenvix-core'); ?></p>
									</div>
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
                <div class="custom-next swiper-navigetions">
                    <i class="icon-arrow-right"></i>
                </div>
            </div>
            
        </div>

        <?php elseif ( 'layout-6' === $settings['provix_design_style'] ) : ?>

			<div class="testimonial style-six">
				<div class="testimonial-slider-container">
                    <div class="two-item-carousel swiper-container testimonial-slider">
                        <div class="swiper-wrapper">
                            <?php foreach ($settings['reviews_list'] as $index => $item) :
                                if ( !empty($item['reviewer_image']['url']) ) {
                                    $reviewer_image = !empty($item['reviewer_image']['id']) ? wp_get_attachment_image_url( $item['reviewer_image']['id'], '') : $item['reviewer_image']['url'];
                                }
                            ?>
                            <div class="swiper-slide">
                                <div class="testimonial-item">
                                    <div class="client-info">
                                        <?php if(!empty($reviewer_image)) : ?>
                                            <img src="<?php echo esc_url($reviewer_image); ?>" alt="image">
                                        <?php endif; ?>
                                    </div>
                                    <div class="content">
                                        <p class="quote"><?php echo $item['review_content']; ?></p>
										<div class="name-rating">
											<div class="bio">
												<h5 class="name"><?php echo $item['reviewer_name']; ?></h5>
												<p class="designation"><?php echo $item['reviewer_designation']; ?></p>
											</div>
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
										</div>
                                        <div class="icon">
											<i class="fa-solid fa-quote-right"></i>
                                        </div>
										<ul class="social-icons">
											<?php if( !empty($item['facebook_link']['url']) ) : ?>
                                    			<li><a href="<?php echo esc_url($item['facebook_link']['url']); ?>"><i class="fa-brands fa-facebook-f"></i></a></li>
                                    		<?php endif; ?>
                                    
											<?php if( !empty($item['instagram_link']['url']) ) : ?>
												<li><a href="<?php echo esc_url($item['instagram_link']['url']); ?>"><i class="fa-brands fa-instagram"></i></a></li>
											<?php endif; ?>

											<?php if( !empty($item['twitter_link']['url']) ) : ?>
												<li><a href="<?php echo esc_url($item['twitter_link']['url']); ?>"><i class="fa-brands fa-twitter"></i></a></li>
											<?php endif; ?>
                                    
											<?php if( !empty($item['linkedin_link']['url']) ) : ?>
												<li><a href="<?php echo esc_url($item['linkedin_link']['url']); ?>"><i class="fa-brands fa-linkedin-in"></i></a></li>
											<?php endif; ?>
										</ul>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="arrow-nav">
                        <div class="custom-prev swiper-navigetions">
                            <i class="fa-solid fa-arrow-left"></i>
                        </div>
                        <div class="custom-next swiper-navigetions">
                            <i class="fa-solid fa-arrow-right"></i>
                        </div>
                    </div>
                </div>
            </div>
            
        <?php elseif ( 'layout-7' === $settings['provix_design_style'] ) : ?>
            
            <div class="testimonial style-seven">
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        <?php foreach (  $settings['reviews_list'] as $item ) :
                            if ( !empty($item['reviewer_image']['url']) ) {
                                $reviewer_image = !empty($item['reviewer_image']['id']) ? wp_get_attachment_image_url( $item['reviewer_image']['id']) : $item['reviewer_image']['url'];
                            }
                            ?>
                            <div class="swiper-slide testimonial-single">
                                <div class="testimonial-content">
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

        <?php elseif ( 'layout-8' === $settings['provix_design_style'] ) : ?>
            
            <div class="testimonial style-eight">
				<div class="testimonial-slider-container">
                    <div class="two-item-carousel swiper-container testimonial-slider">
                        <div class="swiper-wrapper">
                            <?php foreach ($settings['reviews_list'] as $index => $item) :
                                if ( !empty($item['reviewer_image']['url']) ) {
                                    $reviewer_image = !empty($item['reviewer_image']['id']) ? wp_get_attachment_image_url( $item['reviewer_image']['id'], '') : $item['reviewer_image']['url'];
                                }
                            ?>
                            <div class="swiper-slide">
                                <div class="testimonial-item">
                                    <div class="client-info">
										<div class="name-rating">
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
                                            <div class="bio">
												<h5 class="name"><?php echo $item['reviewer_name']; ?></h5>
												<p class="designation"><?php echo $item['reviewer_designation']; ?></p>
											</div>
										</div>
                                        <?php if( !empty( $reviewer_image ) ) : ?>
                                            <img src="<?php echo esc_url( $reviewer_image ); ?>" alt="image">
                                        <?php endif; ?>
                                    </div>

                                    <div class="icon">
										<i class="fa-solid fa-quote-right"></i>
                                    </div>
                                    <p class="quote"><?php echo $item['review_content']; ?></p>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="arrow-nav">
                        <div class="custom-prev swiper-navigetions">
                            <i class="fa-solid fa-arrow-left"></i>
                        </div>
                        <div class="custom-next swiper-navigetions">
                            <i class="fa-solid fa-arrow-right"></i>
                        </div>
                    </div>
                </div>
                <?php if( !empty( $settings['testi_title'] ) ) : ?>
                    <h2 class="title"><?php echo $settings['testi_title']; ?></h2>
                <?php endif; ?>
            </div>

        <?php endif; ?>
        <?php 
	}
}

$widgets_manager->register( new Provix_Testimonial() );