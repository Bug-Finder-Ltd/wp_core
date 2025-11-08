<?php
namespace ZupetCore\Widgets;

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Zupet Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Zupet_Hero_Banner extends \Elementor\Widget_Base {

	public function get_name() {
		return 'hero-banner';
	}

	public function get_title() {
		return __( 'Hero Banner', 'zupetcore' );
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
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'banner_content',
            [
                'label' => esc_html__( 'Content', 'zupetcore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
            $this->add_control(
                'subtitle',
                [
                    'label' => esc_html__( 'Subtitle', 'zupetcore' ),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => esc_html__( 'Default Subtitle' , 'zupetcore' ),
                    'label_block' => true,
                ]
            );
            $this->add_control(
                'title_1',
                [
                    'label' => esc_html__( 'Title 1', 'zupetcore' ),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => esc_html__( 'Default Title' , 'zupetcore' ),
                    'label_block' => true,
                ]
            );
            $this->add_control(
                'title_2',
                [
                    'label' => esc_html__( 'Title 2', 'zupetcore' ),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => esc_html__( 'Default Title' , 'zupetcore' ),
                    'label_block' => true,
                ]
            );
            $this->add_control(
                'title_3',
                [
                    'label' => esc_html__( 'Title 3', 'zupetcore' ),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => esc_html__( 'Default Title' , 'zupetcore' ),
                    'label_block' => true,
                ]
            );
            $this->add_control(
                'description',
                [
                    'label' => esc_html__( 'Description', 'zupetcore' ),
                    'type' => \Elementor\Controls_Manager::TEXTAREA,
                    'default' => esc_html__( 'Default Description' , 'zupetcore' ),
                ]
            );
            $this->add_control(
                'hero_shape1',
                [
                    'label' => esc_html__( 'Shape 1', 'zupetcore' ),
                    'type' => \Elementor\Controls_Manager::MEDIA,
                ]
            );
            $this->add_control(
                'hero_shape2',
                [
                    'label' => esc_html__( 'Shape 2', 'zupetcore' ),
                    'type' => \Elementor\Controls_Manager::MEDIA,
                ]
            );
            $this->add_control(
                'circuler_text',
                [
                    'label' => esc_html__( 'Circuler Text', 'zupetcore' ),
                    'type' => \Elementor\Controls_Manager::TEXTAREA,
                    'default' => esc_html__( 'Get free consultation get free consultation get free consultation' , 'zupetcore' ),
                ]
            );
        $this->end_controls_section();

        $this->start_controls_section(
            'quote_content',
            [
                'label' => esc_html__( 'Quote', 'zupetcore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

            $this->add_control(
                'quote',
                [
                    'label' => esc_html__( 'Quote', 'zupetcore' ),
                    'type' => \Elementor\Controls_Manager::TEXTAREA,
                    'default' => esc_html__( 'Believe in your strength, trust the process, overcome obstacles, and remember—limits exist only if you allow them to.', 'zupetcore' ),
                ]
            );
            $this->add_control(
                'quote_image',
                [
                    'label' => esc_html__( 'Image', 'zupetcore' ),
                    'type' => \Elementor\Controls_Manager::MEDIA,
                    'default' => [
                        'url' => \Elementor\Utils::get_placeholder_image_src(),
                    ],
                ]
            );
            $this->add_control(
                'quote_name',
                [
                    'label' => esc_html__( 'Name', 'zupetcore' ),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => esc_html__( 'Mildred Roth' , 'zupetcore' ),
                    'label_block' => true,
                ]
            );
            $this->add_control(
                'quote_designation',
                [
                    'label' => esc_html__( 'Designation', 'zupetcore' ),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => esc_html__( 'Nutrition Innovator' , 'zupetcore' ),
                    'label_block' => true,
                ]
            );

        $this->end_controls_section();

        $this->start_controls_section(
            'image_section',
            [
                'label' => esc_html__( 'Image', 'zupetcore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
            $this->add_control(
                'hero_image1',
                [
                    'label' => esc_html__( 'Image 1', 'zupetcore' ),
                    'type' => \Elementor\Controls_Manager::MEDIA,
                    'default' => [
                        'url' => \Elementor\Utils::get_placeholder_image_src(),
                    ],
                ]
            );
            $this->add_control(
                'hero_image2',
                [
                    'label' => esc_html__( 'Image 2', 'zupetcore' ),
                    'type' => \Elementor\Controls_Manager::MEDIA,
                    'default' => [
                        'url' => \Elementor\Utils::get_placeholder_image_src(),
                    ],
                ]
            );
            $this->add_control(
                'hero_image3',
                [
                    'label' => esc_html__( 'Image 3', 'zupetcore' ),
                    'type' => \Elementor\Controls_Manager::MEDIA,
                    'default' => [
                        'url' => \Elementor\Utils::get_placeholder_image_src(),
                    ],
                ]
            );

        $this->end_controls_section();

        $this->start_controls_section(
            'icon_box_section',
            [
                'label' => esc_html__( 'Icon Box', 'zupetcore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'box1_title',
            [
                'label' => esc_html__( 'Title', 'zupetcore' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Default title', 'zupetcore' ),
                'placeholder' => esc_html__( 'Type your title here', 'zupetcore' ),
            ]
        );
        $this->add_control(
            'box2_title',
            [
                'label' => esc_html__( 'Title', 'zupetcore' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Default title', 'zupetcore' ),
                'placeholder' => esc_html__( 'Type your title here', 'zupetcore' ),
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'button_section',
            [
                'label' => esc_html__( 'Button', 'zupetcore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
            $this->add_control(
                'button1_text',
                [
                    'label' => esc_html__( 'Button 1 Text', 'zupetcore' ),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => esc_html__( 'Click Here' , 'zupetcore' ),
                    'label_block' => true,
                ]
            );
            $this->add_control(
                'button1_link',
                [
                    'label' => esc_html__( 'Button 1 Link', 'zupetcore' ),
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
                'button2_text',
                [
                    'label' => esc_html__( 'Button 2 Text', 'zupetcore' ),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => esc_html__( 'Click Here' , 'zupetcore' ),
                    'label_block' => true,
                ]
            );
            $this->add_control(
                'button2_link',
                [
                    'label' => esc_html__( 'Button 2 Link', 'zupetcore' ),
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
        $this->end_controls_section();

		/**
         * Style section
         */
		$this->start_controls_section(
			'section_style',
			[
				'label' => __( 'Style', 'zupetcore' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'text_transform',
			[
				'label' => __( 'Text Transform', 'zupetcore' ),
				'type' => \Elementor\Controls_Manager::SELECT,
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
        ?>

        <?php if ( $settings['zupet_design_style']  == 'layout-1' ): 

            if ( !empty($settings['hero_image']['url']) ) {
                $zupet_hero_image = !empty($settings['hero_image']['id']) ? wp_get_attachment_image_url( $settings['hero_image']['id'], '') : $settings['hero_image']['url'];
                $zupet_hero_image_alt = get_post_meta($settings["hero_image"]["id"], "_wp_attachment_image_alt", true);
            }
            if ( !empty($settings['hero_shape1']['url']) ) {
                $hero_shape1 = !empty($settings['hero_shape1']['id']) ? wp_get_attachment_image_url( $settings['hero_shape1']['id'], '') : $settings['hero_shape1']['url'];
                $hero_shape1_alt = get_post_meta($settings["hero_shape1"]["id"], "_wp_attachment_image_alt", true);
            }
            if ( !empty($settings['hero_shape2']['url']) ) {
                $hero_shape2 = !empty($settings['hero_shape2']['id']) ? wp_get_attachment_image_url( $settings['hero_shape2']['id'], '') : $settings['hero_shape2']['url'];
                $hero_shape1_alt = get_post_meta($settings["hero_shape2"]["id"], "_wp_attachment_image_alt", true);
            }
            
            $this->add_render_attribute('title_args', 'class', 'banner-title');

            $icon_url = PROTINE_ADDONS_URL . 'assets/img/icons/footprint.png';
            $icon_url_2 = PROTINE_ADDONS_URL . 'assets/img/icons/footprint-2.png';

        ?>

        <div class="banner-area style-one">
            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="hero-content">
                     <div class="hero-two-content-inner">
                        <?php if(!empty($settings['subtitle'])) : ?>
                            <h6 class="sub-title"><i class="fa-thin fa-bone"></i> <?php echo $settings['subtitle']; ?></h6>
                        <?php endif; ?>
                        <div class="title">
                            <h2 class="wow zoomIn" data-wow-delay="00ms" data-wow-duration="2000ms"><?php echo $settings['title_1']; ?></h2>
                            <div class="title-image-one">
                                <div class="image">
                                    <img class="wow slideInUp" data-wow-delay="00ms" data-wow-duration="2000ms" src="<?php echo esc_url($hero_shape1); ?>" alt="image">
                                </div>
                            </div>
                            <h2 class="wow zoomIn" data-wow-delay="00ms" data-wow-duration="2000ms"><?php echo $settings['title_2']; ?></h2>
                        </div>
                        <div class="title">
                           <div class="btn-img-wrapper">
                              <img src="<?php echo esc_url($icon_url); ?>" alt="icon" class="btn-img btn-img-1">
                           </div>
                            <div class="line-shape"></div>
                           <h2 class="wow zoomIn"  data-wow-delay="00ms" data-wow-duration="2000ms"><?php echo $settings['title_3']; ?></h2>
                        </div>
                        <p class="description wow zoomIn" data-wow-delay="00ms" data-wow-duration="2000ms">
                            <?php echo $settings['description']; ?>
                        </p>
                        <div class="btn-area">
                            <?php if(!empty($settings['button1_text'])) : ?>
                                <a href="<?php echo $settings['button1_link']['url']; ?>" class="button">
                                    <span class="button-text">
                                        <span class="main-text"><?php echo $settings['button1_text']; ?></span>
                                        <span class="hover-text"><?php echo $settings['button1_text']; ?></span>
                                    </span>
                                    <span class="button-icon">
                                        <span class="main-text">
                                            <img src="<?php echo esc_url($icon_url); ?>" alt="icon">
                                        </span>
                                        <span class="hover-text">
                                            <img src="<?php echo esc_url($icon_url); ?>" alt="icon">
                                        </span>
                                    </span>
                                </a>
                            <?php endif; ?>
                            <?php if(!empty($settings['button2_text'])) : ?>
                                <a href="<?php echo $settings['button2_link']['url']; ?>" class="work-btn">
                                    <?php echo $settings['button2_text']; ?>
                                </a>
                            <?php endif; ?>
                        </div>
                        <div class="banner-frame">
                            <?php if(!empty($settings['box1_title'])) : ?>
                                <div class="frame-one wow zoomInUp" data-wow-delay="00ms" data-wow-duration="2000ms">
                                    <div class="frame-icon">
                                        <i class="fa-light fa-shield-check"></i>
                                    </div>
                                    <h5><?php echo $settings['box1_title']; ?></h5>
                                </div>
                            <?php endif; ?>

                            <?php if(!empty($settings['box2_title'])) : ?>
                                <div class="frame-two wow zoomInUp" data-wow-delay="00ms" data-wow-duration="2000ms">
                                    <div class="frame-icon">
                                        <i class="fa-light fa-shield-check"></i>
                                    </div>
                                    <h5><?php echo $settings['box2_title']; ?></h5>
                                </div>
                            <?php endif; ?>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-lg-6 ">
                    <div class="hero-image-container">
                        <div class="hero-image-container-inner">
                            <div class="hero-image-top">
                                <div class="hero-two-image-1 wow zoomIn" data-wow-delay="00ms" data-wow-duration="2000ms">
                                    <img src="<?php echo $settings['hero_image1']['url']; ?>" alt="image">
                                </div>
                                <div class="hero-two-image-wrapper wow fadeInDown" data-wow-delay="00ms" data-wow-duration="2000ms">
                                    <div class="hero-two-image-container">
                                        <div class="hero-two-image-2">
                                            <img src="<?php echo $settings['hero_image2']['url']; ?>" alt="image">
                                        </div>
                                        <div class="mew-image">
                                            <img src="<?php echo esc_url($hero_shape2); ?>" alt="mew">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="hero-image-bottom">
                                <div class="round-box-content">
                                  <span class="curved-circle"><?php echo $settings['circuler_text']; ?> </span>
                                    <div class="round-box-icon">
                                        <a href="#"><img src="<?php echo esc_url($icon_url_2); ?>" alt="image"></a>
                                    </div>
                                </div>
                                <div class="hero-two-image-3 wow fadeInRight" data-wow-delay="00ms" data-wow-duration="2000ms">
                                    <img src="<?php echo $settings['hero_image3']['url']; ?>" alt="image">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php elseif ( $settings['zupet_design_style']  == 'layout-2' ):

            if ( !empty($settings['hero_image']['url']) ) {
                $zupet_hero_image = !empty($settings['hero_image']['id']) ? wp_get_attachment_image_url( $settings['hero_image']['id'], '') : $settings['hero_image']['url'];
                $zupet_hero_image_alt = get_post_meta($settings["hero_image"]["id"], "_wp_attachment_image_alt", true);
            }
            if ( !empty($settings['quote_image']['url']) ) {
                $zupet_quote_image = !empty($settings['quote_image']['id']) ? wp_get_attachment_image_url( $settings['quote_image']['id'], '') : $settings['quote_image']['url'];
                $zupet_quote_image_alt = get_post_meta($settings["quote_image"]["id"], "_wp_attachment_image_alt", true);
            }
            if ( !empty($settings['hero_shape1']['url']) ) {
                $hero_shape1 = !empty($settings['hero_shape1']['id']) ? wp_get_attachment_image_url( $settings['hero_shape1']['id'], '') : $settings['hero_shape1']['url'];
                $hero_shape1_alt = get_post_meta($settings["hero_shape1"]["id"], "_wp_attachment_image_alt", true);
            }
            if ( !empty($settings['hero_shape2']['url']) ) {
                $hero_shape2 = !empty($settings['hero_shape2']['id']) ? wp_get_attachment_image_url( $settings['hero_shape2']['id'], '') : $settings['hero_shape2']['url'];
                $hero_shape1_alt = get_post_meta($settings["hero_shape2"]["id"], "_wp_attachment_image_alt", true);
            }
            
            $this->add_render_attribute('title_args', 'class', 'banner-title');

            ?>
        
            <div class="banner-area style-two">
                <div class="hero-main">
                    <div class="container">
                        <div class="banner-wrap">
                            <div class="banner-left">
                                <div class="main-video">
                                    <div class="video-wrapper">
                                        <video id="promoVideo" autoplay muted loop playsinline>
                                            <source src="<?php echo esc_url($settings['video_link']['url']); ?>" type="video/mp4" />
                                        </video>
                                    </div>
                                </div>
                                <div class="quote">
                                    <?php
                                    if(!empty($settings['quote'])){
                                        echo '<q class="quote-text">'.$settings['quote'].'</q>';
                                    }
                                    ?>
                                    <div class="user">
                                        <?php if(!empty($zupet_quote_image)) : ?>
                                            <div class="user-image">
                                                <img src="<?php echo esc_url($zupet_quote_image); ?>" alt="">
                                            </div>
                                        <?php endif; ?>

                                        <div class="bio">
                                            <h3 class="name"><?php echo $settings['quote_name']; ?></h3>
                                            <p class="designation"><?php echo $settings['quote_designation']; ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="seperator"></div>
                            <div class="banner-right">
                                <div class="title">
                                    <?php if(!empty($settings['title_1'])) : ?>
                                        <h3 class="title-1"><?php echo $settings['title_1']; ?></h3>
                                    <?php endif; ?>

                                    <?php if(!empty($settings['title_2'])) : ?>
                                        <h3 class="title-2"><?php echo $settings['title_2']; ?></h3>
                                    <?php endif; ?>

                                    <?php if(!empty($settings['title_3'])) : ?>
                                        <h3 class="title-3"><?php echo $settings['title_3']; ?></h3>
                                    <?php endif; ?>
                                </div>

                                <div class="description">
                                    <p><?php echo $settings['description']; ?></p>
                                </div>

                                <div class="banner-bottom">
                                    <div class="hero-btn">
                                        <a class="button" href="<?php echo $settings['button_link']['url']; ?>">
                                            <?php echo $settings['button_text']; ?>
                                            <i class="pi-medicine"></i>
                                        </a>
                                    </div>
                                    <div class="bottom-wrap">
                                        <?php if(!empty($hero_shape2)) : ?>
                                            <div class="shape2">
                                                <img src="<?php echo esc_url($hero_shape2); ?>" alt="">
                                            </div>
                                        <?php endif; ?>

                                        <ul class="features">
                                            <?php foreach (  $settings['list'] as $item ) : ?>
                                                <li><i class="pi-check"></i><?php echo $item['list_title']; ?></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="animation-area">
                    <div class="animated-text">
                        <h2 id="split-type-text"><?php echo $settings['animated_text'] ?></h2>
                    </div>
                </div>
            </div>

        <?php endif; ?>
        <?php
	}
}

$widgets_manager->register( new Zupet_Hero_Banner() );