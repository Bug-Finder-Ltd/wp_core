<?php
namespace RaizenCore\Widgets;

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Raizen Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Raizen_About_Tab extends \Elementor\Widget_Base {

	public function get_name() {
		return 'about-tab';
	}

	public function get_title() {
		return __( 'About Tab', 'raizencore' );
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
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        
        /**
         * Title and content section
         */
        $this->start_controls_section(
            'tab_1',
            [
                'label' => esc_html__('Tab 1', 'raizencore'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        
        $this->add_control(
            'tab1_title',
            [
                'label' => esc_html__('Title', 'raizencore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Mission', 'raizencore'),
                'placeholder' => esc_html__('Type title', 'raizencore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'tab1_description',
            [
                'label' => esc_html__('Description', 'raizencore'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Raizen section description here', 'raizencore'),
                'placeholder' => esc_html__('Type section description here', 'raizencore'),
            ]
        );

        $this->add_control(
            'tab1_button_text',
            [
                'label' => esc_html__('Button Text', 'raizencore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Click Here', 'raizencore'),
                'placeholder' => esc_html__('Type text', 'raizencore'),
                'label_block' => true,
            ]
        );
        $this->add_control(
            'tab1_button_link',
            [
                'label' => esc_html__( 'Button Link', 'raizencore' ),
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
        $this->add_control(
            'tab1_image',
            [
                'label' => esc_html__( 'Choose Image', 'raizencore' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $this->end_controls_section();

        // Tab 2

        $this->start_controls_section(
            'tab_2',
            [
                'label' => esc_html__('Tab 2', 'raizencore'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        
        $this->add_control(
            'tab2_title',
            [
                'label' => esc_html__('Title', 'raizencore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Vision', 'raizencore'),
                'placeholder' => esc_html__('Type title', 'raizencore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'tab2_description',
            [
                'label' => esc_html__('Description', 'raizencore'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Raizen section description here', 'raizencore'),
                'placeholder' => esc_html__('Type section description here', 'raizencore'),
            ]
        );

        $this->add_control(
            'tab2_button_text',
            [
                'label' => esc_html__('Button Text', 'raizencore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Click Here', 'raizencore'),
                'placeholder' => esc_html__('Type text', 'raizencore'),
                'label_block' => true,
            ]
        );
        $this->add_control(
            'tab2_button_link',
            [
                'label' => esc_html__( 'Button Link', 'raizencore' ),
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
        $this->add_control(
            'tab2_image',
            [
                'label' => esc_html__( 'Choose Image', 'raizencore' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $this->end_controls_section();

        // Tab 3

        $this->start_controls_section(
            'tab_3',
            [
                'label' => esc_html__('Tab 3', 'raizencore'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        
        $this->add_control(
            'tab3_title',
            [
                'label' => esc_html__('Title', 'raizencore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('History', 'raizencore'),
                'placeholder' => esc_html__('Type title', 'raizencore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'tab3_description',
            [
                'label' => esc_html__('Description', 'raizencore'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Raizen section description here', 'raizencore'),
                'placeholder' => esc_html__('Type section description here', 'raizencore'),
            ]
        );

        $this->add_control(
            'tab3_button_text',
            [
                'label' => esc_html__('Button Text', 'raizencore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Click Here', 'raizencore'),
                'placeholder' => esc_html__('Type text', 'raizencore'),
                'label_block' => true,
            ]
        );
        $this->add_control(
            'tab3_button_link',
            [
                'label' => esc_html__( 'Button Link', 'raizencore' ),
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
        $this->add_control(
            'tab3_image',
            [
                'label' => esc_html__( 'Choose Image', 'raizencore' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $this->end_controls_section();

        /**
         * Style section
         */
		$this->start_controls_section(
			'section_style',
			[
				'label' => __( 'Style', 'raizencore' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'text_transform',
			[
				'label' => __( 'Text Transform', 'raizencore' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => __( 'None', 'raizencore' ),
					'uppercase' => __( 'UPPERCASE', 'raizencore' ),
					'lowercase' => __( 'lowercase', 'raizencore' ),
					'capitalize' => __( 'Capitalize', 'raizencore' ),
				],
				'selectors' => [
					'{{WRAPPER}} .title' => 'text-transform: {{VALUE}};',
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
            
            if ( !empty($settings['tab1_image']['url']) ) {
                $tab1_image = !empty($settings['tab1_image']['id']) ? wp_get_attachment_image_url( $settings['tab1_image']['id'], '') : $settings['tab1_image']['url'];
                $raizen_about_left_image_alt = get_post_meta($settings["tab1_image"]["id"], "_wp_attachment_image_alt", true);
            }

            if ( !empty($settings['tab2_image']['url']) ) {
                $tab2_image = !empty($settings['tab2_image']['id']) ? wp_get_attachment_image_url( $settings['tab2_image']['id'], '') : $settings['tab2_image']['url'];
                $raizen_about_right_image_alt = get_post_meta($settings["tab2_image"]["id"], "_wp_attachment_image_alt", true);
            }

            if ( !empty($settings['tab3_image']['url']) ) {
                $tab3_image = !empty($settings['tab3_image']['id']) ? wp_get_attachment_image_url( $settings['tab3_image']['id'], '') : $settings['tab3_image']['url'];
                $raizen_about_right_image_alt = get_post_meta($settings["tab3_image"]["id"], "_wp_attachment_image_alt", true);
            }
            $icon_url = PROTINE_ADDONS_URL . 'assets/img/icons/footprint.png';
        ?>
            <div class="about-tab style-one">
                <div class="tab-images">
                    <img id="aboutImage" src="<?php echo esc_url($tab1_image); ?>" alt="<?php echo esc_attr('about-img'); ?>">
                </div>

                <div class="about-two-tab-container wow fadeInRight" data-wow-delay="200ms" data-wow-duration="2000ms">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <button class="nav-link active" id="nav-one-tab" data-bs-toggle="tab" data-bs-target="#nav-one" type="button"
                              role="tab" aria-controls="nav-one" aria-selected="true"
                              data-image="<?php echo esc_url($tab1_image); ?>"><?php echo $settings['tab1_title']; ?></button>
                  
                            <button class="nav-link" id="nav-two-tab" data-bs-toggle="tab" data-bs-target="#nav-two" type="button"
                              role="tab" aria-controls="nav-two" aria-selected="false"
                              data-image="<?php echo esc_url($tab2_image); ?>"><?php echo $settings['tab2_title']; ?></button>
                  
                            <button class="nav-link" id="nav-three-tab" data-bs-toggle="tab" data-bs-target="#nav-three" type="button"
                              role="tab" aria-controls="nav-three" aria-selected="false"
                              data-image="<?php echo esc_url($tab3_image); ?>"><?php echo $settings['tab3_title']; ?></button>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-one" role="tabpanel" aria-labelledby="nav-one-tab">
                            <div class="about-two-content">
                                <p class="about-two-desc"><?php echo $settings['tab1_description']; ?></p>
                                <div class="about-two-btn">
                                    <a href="<?php echo esc_url($settings['tab1_button_link']['url']); ?>" class="button">
                                        <span class="button-text">
                                            <span class="main-text"><?php echo $settings['tab1_button_text']; ?></span>
                                            <span class="hover-text"><?php echo $settings['tab1_button_text']; ?></span>
                                        </span>
                                        <span class="button-icon">
                                            <span class="main-text">
                                                <img src="<?php echo esc_url($icon_url); ?>" alt="<?php echo esc_attr('icon'); ?>">
                                            </span>
                                            <span class="hover-text">
                                                <img src="<?php echo esc_url($icon_url); ?>" alt="<?php echo esc_attr('icon'); ?>">
                                            </span>
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-two" role="tabpanel" aria-labelledby="nav-two-tab">
                            <div class="about-two-content">
                                <p class="about-two-desc"><?php echo $settings['tab2_description']; ?></p>
                                <div class="about-two-btn">
                                    <a href="<?php echo esc_url($settings['tab2_button_link']['url']); ?>" class="button">
                                        <span class="button-text">
                                            <span class="main-text"><?php echo $settings['tab2_button_text']; ?></span>
                                            <span class="hover-text"><?php echo $settings['tab2_button_text']; ?></span>
                                        </span>
                                        <span class="button-icon">
                                            <span class="main-text">
                                                <img src="<?php echo esc_url($icon_url); ?>" alt="<?php echo esc_attr('icon'); ?>">
                                            </span>
                                            <span class="hover-text">
                                                <img src="<?php echo esc_url($icon_url); ?>" alt="<?php echo esc_attr('icon'); ?>">
                                            </span>
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-three" role="tabpanel" aria-labelledby="nav-three-tab">
                            <div class="about-two-content">
                                <p class="about-two-desc"><?php echo $settings['tab3_description']; ?></p>
                                <div class="about-two-btn">
                                    <a href="<?php echo esc_url($settings['tab3_button_link']['url']); ?>" class="button">
                                        <span class="button-text">
                                            <span class="main-text"><?php echo $settings['tab3_button_text']; ?></span>
                                            <span class="hover-text"><?php echo $settings['tab3_button_text']; ?></span>
                                        </span>
                                        <span class="button-icon">
                                            <span class="main-text">
                                                <img src="<?php echo esc_url($icon_url); ?>" alt="<?php echo esc_attr('icon'); ?>">
                                            </span>
                                            <span class="hover-text">
                                                <img src="<?php echo esc_url($icon_url); ?>" alt="<?php echo esc_attr('icon'); ?>">
                                            </span>
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

		<?php elseif ( $settings['raizen_design_style']  == 'layout-2' ): 
            if ( !empty($settings['raizen_about_left_image']['url']) ) {
                $raizen_about_left_image = !empty($settings['raizen_about_left_image']['id']) ? wp_get_attachment_image_url( $settings['raizen_about_left_image']['id'], $settings['raizen_image_size_size']) : $settings['raizen_about_left_image']['url'];
                $raizen_about_left_image_alt = get_post_meta($settings["raizen_about_left_image"]["id"], "_wp_attachment_image_alt", true);
            } 
            if ( !empty($settings['raizen_about_right_image']['url']) ) {
                $raizen_about_right_image = !empty($settings['raizen_about_right_image']['id']) ? wp_get_attachment_image_url( $settings['raizen_about_right_image']['id'], $settings['raizen_image_size_size']) : $settings['raizen_about_right_image']['url'];
                $raizen_about_right_image_alt = get_post_meta($settings["raizen_about_right_image"]["id"], "_wp_attachment_image_alt", true);
            } 
            if ( !empty($settings['raizen_about_right_image_2']['url']) ) {
                $raizen_about_right_image_2 = !empty($settings['raizen_about_right_image_2']['id']) ? wp_get_attachment_image_url( $settings['raizen_about_right_image_2']['id'], $settings['raizen_image_size_size']) : $settings['raizen_about_right_image_2']['url'];
                $raizen_about_right_image_2_alt = get_post_meta($settings["raizen_about_right_image_2"]["id"], "_wp_attachment_image_alt", true);
            } 
        ?>
            <!-- about-two -->
            <div class="about-two">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="common-title">
                            <?php
                                if ( !empty($settings['raizen_title' ]) ) :
                                    printf( '<%1$s %2$s>%3$s</%1$s>',
                                        tag_escape( $settings['raizen_title_tag'] ),
                                        $this->get_render_attribute_string( 'title_args' ),
                                        raizen_kses( $settings['raizen_title' ] )
                                        );
                                endif;
                            ?>
                            </div>
                            <div class="about-two-left-image">
                                <?php if ($settings['raizen_about_left_image']['url'] || $settings['raizen_about_left_image']['id']) : ?>
                                    <img src="<?php echo esc_url($raizen_about_left_image); ?>" alt="<?php echo esc_attr($raizen_about_left_image_alt); ?>">
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="about-two-right-container">
                                <div class="about-two-right-icon">
                                    <div class="icon">
                                        <img src="<?php echo get_template_directory_uri() . '/assets/img/shape/arrow-shape-two.png';?>" alt="icon">
                                    </div>
                                    <div class="about-two-round-text">
                                        <div class="round-box-content">
                                            <span class="curved-circle"><?php echo raizen_kses($settings['text_inside_circle']); ?> </span>
                                            <div class="round-box-icon">
                                                <a href="<?php echo esc_url($settings['raizen_page_link']); ?>"><img src="<?php echo get_template_directory_uri() . '/assets/img/icons/arrow-big-white.png';?>" alt="arrow"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="about-two-right-content">
                                    <?php if ( !empty($settings['raizen_description']) ) : ?>
                                        <p><?php echo raizen_kses( $settings['raizen_description'] ); ?></p>
                                    <?php endif; ?>
                                    <div class="about-two-right-image-box">
                                        <div class="about-two-right-image-one">
                                            <?php if ($settings['raizen_about_right_image']['url'] || $settings['raizen_about_right_image']['id']) : ?>
                                                <img src="<?php echo esc_url($raizen_about_right_image); ?>" alt="<?php echo esc_attr($raizen_about_right_image_alt); ?>">
                                            <?php endif; ?>
                                        </div>
                                        <div class="about-two-right-image-two">
                                            <?php if ($settings['raizen_about_right_image_2']['url'] || $settings['raizen_about_right_image_2']['id']) : ?>
                                                <img src="<?php echo esc_url($raizen_about_right_image_2); ?>" alt="<?php echo esc_attr($raizen_about_right_image_2_alt); ?>">
                                            <?php endif; ?>
                                        </div>
                                        <div class="about-two-dot-shape">
                                            <img src="<?php echo get_template_directory_uri() . '/assets/img/shape/dot-shape-03.png';?>" alt="image">
                                        </div>
                                        <div class="about-two-star-shape">
                                            <img src="<?php echo get_template_directory_uri() . '/assets/img/shape/star-shape-01.png';?>" alt="image">
                                        </div>
                                        <div class="about-two-right-round">
                                            <div class="round-box-content">
                                                <span class="curved-circle-3"><?php echo raizen_kses($settings['text_inside_circle']); ?> </span>
                                                <div class="round-box-icon">
                                                    <a class="play_btn hv-popup-link" href="<?php echo esc_url($settings['raizen_video_url']); ?>">
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
                </div>
            </div>
            <!-- about-two -->

        <?php endif; ?>

        <?php 
	}
}

$widgets_manager->register( new Raizen_About_Tab() );