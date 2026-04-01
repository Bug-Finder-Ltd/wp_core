<?php
namespace ProvixCore\Widgets;

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Provix Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TestimonialBox extends \Elementor\Widget_Base {

	public function get_name() {
		return 'testimonial-box';
	}

	public function get_title() {
		return __( 'Testimonial Box', 'agenvix-core' );
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
                    'layout-1' => esc_html__('Layout 1', 'agenvix-core'),
                    'layout-2' => esc_html__('Layout 2', 'agenvix-core'),
                ],
                'default' => 'layout-1',
            ]
        );
        $this->end_controls_section();

        /**
         * Review section
         */
        $this->start_controls_section(
            'review_section',
            [
                'label' => esc_html__( 'Review', 'agenvix-core' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'reviewer_image',
            [
                'label' => esc_html__( 'Reviewer Image', 'agenvix-core' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'reviewer_name', [
                'label' => esc_html__( 'Reviewer Name', 'agenvix-core' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Rasalina William' , 'agenvix-core' ),
                'label_block' => true,
            ]
        );        

        $this->add_control(
            'reviewer_designation', [
                'label' => esc_html__( 'Designation', 'agenvix-core' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( '- CEO' , 'agenvix-core' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'review_content',
            [
                'label' => esc_html__( 'Review Content', 'agenvix-core' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 10,
                'default' => 'Aklima The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections Bonorum et Malorum original.',
                'placeholder' => esc_html__( 'Type your review content here', 'agenvix-core' ),
            ]
        );

        $this->add_control(
            'quote_icon',
            [
                'label' => esc_html__( 'Quote Icon', 'agenvix-core' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
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

        <?php if ( $settings['provix_design_style']  == 'layout-2' ): ?>
        
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

		<?php else: ?>

            <div class="testimonial-box style-one">
                <?php
                    if ( !empty($settings['reviewer_image']['url']) ) {
                        $provix_reviewer_image = !empty($settings['reviewer_image']['id']) ? wp_get_attachment_image_url( $settings['reviewer_image']['id'], '') : $settings['reviewer_image']['url'];
                    }
                ?>
                <div class="single-testimonial">
                    <div class="testi-head">
                        <div class="client-info">
                            <div class="text">
                                <div class="quote-icon">
                                    <i class="pi-quote-2"></i>
                                </div>
                                <div class="info">
                                    <h6 class="name"><?php echo $settings['reviewer_name']; ?></h6>
                                    <p class="designation"><?php echo $settings['reviewer_designation']; ?></p>
                                </div>
                            </div>
                            <?php if(!empty($provix_reviewer_image)) : ?>
                                <div class="image">
                                    <img src="<?php echo esc_url($provix_reviewer_image); ?>" alt="image">
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="testi-content">
                        <?php if ( !empty($settings['review_content']) ) : ?>
                            <p><?php echo provix_kses($settings['review_content']); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <?php 
	}
}

$widgets_manager->register( new TestimonialBox() );