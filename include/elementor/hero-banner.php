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
class Protine_Hero_Banner extends \Elementor\Widget_Base {

	public function get_name() {
		return 'hero-banner';
	}

	public function get_title() {
		return __( 'Hero Banner', 'protinecore' );
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
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'banner_content',
            [
                'label' => esc_html__( 'Content', 'protinecore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
            $this->add_control(
                'title_1',
                [
                    'label' => esc_html__( 'Title 1', 'protinecore' ),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => esc_html__( 'Default Title' , 'protinecore' ),
                    'label_block' => true,
                ]
            );
            $this->add_control(
                'title_2',
                [
                    'label' => esc_html__( 'Title 2', 'protinecore' ),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => esc_html__( 'Default Title' , 'protinecore' ),
                    'label_block' => true,
                ]
            );
            $this->add_control(
                'title_3',
                [
                    'label' => esc_html__( 'Title 3', 'protinecore' ),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => esc_html__( 'Default Title' , 'protinecore' ),
                    'label_block' => true,
                ]
            );
            $this->add_control(
                'description',
                [
                    'label' => esc_html__( 'Description', 'protinecore' ),
                    'type' => \Elementor\Controls_Manager::TEXTAREA,
                    'default' => esc_html__( 'Default Description' , 'protinecore' ),
                ]
            );
            $this->add_control(
                'hero_shape1',
                [
                    'label' => esc_html__( 'Shape 1', 'protinecore' ),
                    'type' => \Elementor\Controls_Manager::MEDIA,
                ]
            );
            $this->add_control(
                'hero_shape2',
                [
                    'label' => esc_html__( 'Shape 2', 'protinecore' ),
                    'type' => \Elementor\Controls_Manager::MEDIA,
                ]
            );
            $this->add_control(
                'animated_text',
                [
                    'label' => esc_html__( 'Animated Text', 'protinecore' ),
                    'type' => \Elementor\Controls_Manager::TEXTAREA,
                    'default' => esc_html__( '“At Protine, we believe wellness should be simple, enjoyable, and effective. That’s why we’ve crafted nutrient-rich Gummies designed to fit seamlessly into your daily life. Our focus is on quality ingredients, backed by science, to support your health goals. Every gummy is made with care to ensure taste and results go hand in hand. Join thousands who trust Protine for their daily wellness boost.”' , 'protinecore' ),
                ]
            );
        $this->end_controls_section();

        $this->start_controls_section(
            'quote_content',
            [
                'label' => esc_html__( 'Quote', 'protinecore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

            $this->add_control(
                'quote',
                [
                    'label' => esc_html__( 'Quote', 'protinecore' ),
                    'type' => \Elementor\Controls_Manager::TEXTAREA,
                    'default' => esc_html__( 'Believe in your strength, trust the process, overcome obstacles, and remember—limits exist only if you allow them to.', 'protinecore' ),
                ]
            );
            $this->add_control(
                'quote_image',
                [
                    'label' => esc_html__( 'Image', 'protinecore' ),
                    'type' => \Elementor\Controls_Manager::MEDIA,
                    'default' => [
                        'url' => \Elementor\Utils::get_placeholder_image_src(),
                    ],
                ]
            );
            $this->add_control(
                'quote_name',
                [
                    'label' => esc_html__( 'Name', 'protinecore' ),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => esc_html__( 'Mildred Roth' , 'protinecore' ),
                    'label_block' => true,
                ]
            );
            $this->add_control(
                'quote_designation',
                [
                    'label' => esc_html__( 'Designation', 'protinecore' ),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => esc_html__( 'Nutrition Innovator' , 'protinecore' ),
                    'label_block' => true,
                ]
            );

        $this->end_controls_section();

        $this->start_controls_section(
            'image_section',
            [
                'label' => esc_html__( 'Image', 'protinecore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
            $this->add_control(
                'hero_image',
                [
                    'label' => esc_html__( 'Image', 'protinecore' ),
                    'type' => \Elementor\Controls_Manager::MEDIA,
                    'default' => [
                        'url' => \Elementor\Utils::get_placeholder_image_src(),
                    ],
                ]
            );

            $repeater = new \Elementor\Repeater();

            $repeater->add_control(
                'list_title',
                [
                    'label' => esc_html__( 'Title', 'protinecore' ),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => esc_html__( 'List Title' , 'protinecore' ),
                    'label_block' => true,
                ]
            );
            $repeater->add_control(
                'indicator_line',
                [
                    'label' => esc_html__( 'Indicator line', 'protinecore' ),
                    'type' => \Elementor\Controls_Manager::MEDIA,
                ]
            );
            $repeater->add_control(
                'list_icon',
                [
                    'label' => esc_html__( 'Icon', 'protinecore' ),
                    'type' => \Elementor\Controls_Manager::MEDIA,
                ]
            );
            $this->add_control(
                'list',
                [
                    'label' => esc_html__( 'Features List', 'protinecore' ),
                    'type' => \Elementor\Controls_Manager::REPEATER,
                    'fields' => $repeater->get_controls(),
                    'default' => [
                        [
                            'list_title' => esc_html__( 'Title #1', 'protinecore' ),
                        ],
                        [
                            'list_title' => esc_html__( 'Title #2', 'protinecore' ),
                        ],
                    ],
                    'title_field' => '{{{ list_title }}}',
                ]
            );

        $this->end_controls_section();

        $this->start_controls_section(
            'video_section',
            [
                'label' => esc_html__( 'Video', 'protinecore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

            $this->add_control(
                'video_link',
                [
                    'label' => esc_html__( 'Link', 'protinecore' ),
                    'type' => \Elementor\Controls_Manager::URL,
                    'options' => [ 'url', 'is_external', 'nofollow' ],
                    'default' => [
                        'url' => '',
                        'is_external' => true,
                        'nofollow' => true,
                        // 'custom_attributes' => '',
                    ],
                    'label_block' => true,
                ]
            );
        $this->end_controls_section();

        $this->start_controls_section(
            'button_section',
            [
                'label' => esc_html__( 'Button', 'protinecore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
            $this->add_control(
                'button_text',
                [
                    'label' => esc_html__( 'Text', 'protinecore' ),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => esc_html__( 'Click Here' , 'protinecore' ),
                    'label_block' => true,
                ]
            );
            $this->add_control(
                'button_link',
                [
                    'label' => esc_html__( 'Link', 'protinecore' ),
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
				'label' => __( 'Style', 'protinecore' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'text_transform',
			[
				'label' => __( 'Text Transform', 'protinecore' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => __( 'None', 'protinecore' ),
					'uppercase' => __( 'UPPERCASE', 'protinecore' ),
					'lowercase' => __( 'lowercase', 'protinecore' ),
					'capitalize' => __( 'Capitalize', 'protinecore' ),
				],
				'selectors' => [
					'{{WRAPPER}} .title' => 'text-transform: {{VALUE}};',
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

        <?php if ( $settings['protine_design_style']  == 'layout-1' ): 

            if ( !empty($settings['hero_image']['url']) ) {
                $protine_hero_image = !empty($settings['hero_image']['id']) ? wp_get_attachment_image_url( $settings['hero_image']['id'], '') : $settings['hero_image']['url'];
                $protine_hero_image_alt = get_post_meta($settings["hero_image"]["id"], "_wp_attachment_image_alt", true);
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

            <div class="banner-area style-one">
                <div class="title">
                    <h3 class="title-1"><?php echo $settings['title_1']; ?></h3>
                    <h3 class="title-2"><?php echo $settings['title_2']; ?></h3>
                    <h3 class="title-3"><?php echo $settings['title_3']; ?></h3>
                </div>
                <div class="image">
                    <img id="hero3-img" src="<?php echo esc_url($protine_hero_image); ?>" alt="">
                    <?php
                    $x = 1;
                    foreach (  $settings['list'] as $item ) :
                        $indicator_line = '';
                        if ( !empty($item['indicator_line']['url']) ) {
                            $indicator_line = !empty($item['indicator_line']['id']) ? wp_get_attachment_image_url( $item['indicator_line']['id'], '') : $item['indicator_line']['url'];
                        }
                        $list_icon = '';
                        if ( !empty($item['list_icon']['url']) ) {
                            $list_icon = !empty($item['list_icon']['id']) ? wp_get_attachment_image_url( $item['list_icon']['id'], '') : $item['list_icon']['url'];
                        }
                        ?>
                        <div class="item item-<?php echo $x++?>">
                            <div class="indicator">
                                <img src="<?php echo esc_url($indicator_line); ?>" alt="">
                            </div>
                            
                            <div class="text">
                                <p><?php echo $item['list_title']; ?></p>
                                <div class="icon">
                                    <img src="<?php echo esc_url($list_icon); ?>" alt="">
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="banner-bottom">
                    <div class="description">
                        <?php if(!empty($hero_shape1)) : ?>
                            <div class="shape1">
                                <img src="<?php echo esc_url($hero_shape1); ?>" alt="">
                            </div>
                        <?php endif; ?>
                        <p><?php echo $settings['description']; ?></p>
                    </div>
                    <?php if(!empty($hero_shape2)) : ?>
                        <div class="shape2">
                            <img src="<?php echo esc_url($hero_shape2); ?>" alt="">
                        </div>
                    <?php endif; ?>
                    <div class="hero-btn">
                        <a class="button" href="<?php echo $settings['button_link']['url']; ?>">
                            <?php echo $settings['button_text']; ?>
                            <i class="pi-medicine"></i>
                        </a>
                    </div>
                </div>
            </div>

        <?php elseif ( $settings['protine_design_style']  == 'layout-2' ):

            if ( !empty($settings['hero_image']['url']) ) {
                $protine_hero_image = !empty($settings['hero_image']['id']) ? wp_get_attachment_image_url( $settings['hero_image']['id'], '') : $settings['hero_image']['url'];
                $protine_hero_image_alt = get_post_meta($settings["hero_image"]["id"], "_wp_attachment_image_alt", true);
            }
            if ( !empty($settings['quote_image']['url']) ) {
                $protine_quote_image = !empty($settings['quote_image']['id']) ? wp_get_attachment_image_url( $settings['quote_image']['id'], '') : $settings['quote_image']['url'];
                $protine_quote_image_alt = get_post_meta($settings["quote_image"]["id"], "_wp_attachment_image_alt", true);
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
                                        <?php if(!empty($protine_quote_image)) : ?>
                                            <div class="user-image">
                                                <img src="<?php echo esc_url($protine_quote_image); ?>" alt="">
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

$widgets_manager->register( new Protine_Hero_Banner() );