<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Nextdestina_Search extends \Elementor\Widget_Base {

	public function get_name() {
		return 'tour-search';
	}

	public function get_title() {
		return __( 'Tour Search', 'nextdestina-booking' );
	}

	public function get_icon() {
		return 'nextdestina-icon';
	}

	public function get_categories() {
		return [ 'nextdestina-booking-category' ];
	}

	protected function register_controls() {

        /**
         * Layout section
         */
        
        $this->start_controls_section(
            'nextdestina_layout',
            [
                'label' => esc_html__('Design Layout', 'nextdestina-booking'),
            ]
        );
        $this->add_control(
            'nextdestina_design_style',
            [
                'label' => esc_html__('Select Layout', 'nextdestina-booking'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'layout-1' => esc_html__('Layout 1', 'nextdestina-booking'),
                    'layout-2' => esc_html__('Layout 2', 'nextdestina-booking'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        
        /**
         * Title and content section
         */
        $this->start_controls_section(
            'nextdestina_form_text',
            [
                'label' => esc_html__('Form Text', 'nextdestina-booking'),
            ]
        );
        
        $this->add_control(
            'form_title',
            [
                'label' => esc_html__('Form Title', 'nextdestina-booking'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Title Here', 'nextdestina-booking'),
                'placeholder' => esc_html__('Type title', 'nextdestina-booking'),
                'label_block' => true,
            ]
        );

        $this->end_controls_section();

        /**
         * Style section
         */

        $this->start_controls_section(
            'general_section',
            [
                'label' => esc_html__( 'General', 'nextdestina-booking' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'text_alignment',
            [
                'label' => esc_html__( 'Alignment', 'nextdestina-booking' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => '',
                'options' => [
                    '' => esc_html__( 'Left', 'nextdestina-booking' ),
                    'center'  => esc_html__( 'Center', 'nextdestina-booking' ),
                    'right' => esc_html__( 'Right', 'nextdestina-booking' ),
                ],
            ]
        );
        $this->add_responsive_control(
            'width',
            [
                'label' => esc_html__( 'Width', 'nextdestina-booking' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .section-title' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'title_section',
            [
                'label' => esc_html__( 'Title', 'nextdestina-booking' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
            $this->add_control(
                'title_color',
                [
                    'label' => esc_html__( 'Color', 'nextdestina-booking' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .section-title h2' => 'color: {{VALUE}}',
                    ],
                ]
            );
            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'title_typography',
                    'selector' => '{{WRAPPER}} .section-title h2',
                ]
            );
            $this->add_control(
                'title_margin',
                [
                    'label' => esc_html__( 'Margin', 'nextdestina-booking' ),
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .section-title h2' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
        $this->end_controls_section();

        $this->start_controls_section(
            'description_section',
            [
                'label' => esc_html__( 'Description', 'nextdestina-booking' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
            $this->add_control(
                'description_color',
                [
                    'label' => esc_html__( 'Color', 'nextdestina-booking' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .section-title p' => 'color: {{VALUE}}',
                    ],
                ]
            );
            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'description_typography',
                    'selector' => '{{WRAPPER}} .section-title p',
                ]
            );
            $this->add_control(
                'description_margin',
                [
                    'label' => esc_html__( 'Margin', 'nextdestina-booking' ),
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .section-title p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
        $this->end_controls_section();
        
		$this->start_controls_section(
			'section_style',
			[
				'label' => __( 'Style', 'nextdestina-booking' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'text_transform',
			[
				'label' => __( 'Text Transform', 'nextdestina-booking' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => __( 'None', 'nextdestina-booking' ),
					'uppercase' => __( 'UPPERCASE', 'nextdestina-booking' ),
					'lowercase' => __( 'lowercase', 'nextdestina-booking' ),
					'capitalize' => __( 'Capitalize', 'nextdestina-booking' ),
				],
				'selectors' => [
					'{{WRAPPER}} .title' => 'text-transform: {{VALUE}};',
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
		$settings = $this->get_settings_for_display();
        ?>

		<?php if ( $settings['nextdestina_design_style']  == 'layout-1' ): ?>
            
        <div class="search tour-search style-one wow fadeInUp" data-wow-delay="100ms">
            <div class="container">
                <div class="search-form">
                    <form action="<?php echo esc_url( get_post_type_archive_link( 'tour' ) ); ?>" method="get">
                        <div class="serach-title">
                            <h6>
                                <i class="fa-light fa-earth-americas"></i>
                                <?php echo esc_html($settings['form_title']); ?>
                            </h6>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-lg-3">
                                <div class="location search-box">
                                    <i class="fa-light fa-location-dot"></i>
                                    <div class="select-option">
                                        <input type="text" id="tour-search-input" placeholder="<?php esc_attr_e( 'Where to', 'nextdestina-booking' ); ?>" name="keyword" autocomplete="off" value="<?php echo esc_attr($_GET['keyword'] ?? ''); ?>">
                                        <div id="tour-suggestions" class="suggestions-box"></div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <div class="date">
                                    <input type="text" class="datepicker" name="travel_date" value="<?php echo esc_attr($_GET['travel_date'] ?? ''); ?>" placeholder="<?php esc_attr_e( 'Feb24  - Feb26', 'nextdestina-booking' ); ?>">
                                    <i class="fa-thin fa-calendar-days"></i>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <div class="count">
                                    <input type="hidden" name="adults" id="search_adults" value="<?php echo esc_attr($_GET['adults'] ?? 0); ?>">
                                    <input type="hidden" name="children" id="search_children" value="<?php echo esc_attr($_GET['children'] ?? 0); ?>">
                                    <input type="hidden" name="infants" id="search_infants" value="<?php echo esc_attr($_GET['infants'] ?? 0); ?>">
                                    <div class="count-counter">
                                        <i class="fa-light fa-user"></i>
                                        <div class="count-counter-inner">
                                            <span class="adult"><?php esc_html_e('2', 'nextdestina-booking'); ?></span>
                                            <p><?php esc_html_e('adult', 'nextdestina-booking'); ?></p>
                                        </div>
                                        <div class="count-counter-inner">
                                            <span class="childeren"><?php esc_html_e('0', 'nextdestina-booking'); ?></span>
                                            <p><?php esc_html_e('childeren', 'nextdestina-booking'); ?></p>
                                        </div>
                                        <div class="count-counter-inner">
                                            <span class="infants"><?php esc_html_e('1', 'nextdestina-booking'); ?></span>
                                            <p><?php esc_html_e('infant', 'nextdestina-booking'); ?></p>
                                        </div> 
                                    </div>
                                    <div class="count-container">
                                        <div class="count-single">
                                            <div class="count-single-text">
                                                <h6><?php esc_html_e('Adult', 'nextdestina-booking'); ?></h6>
                                                <p><?php esc_html_e('Over 12 Years', 'nextdestina-booking'); ?></p>
                                            </div>
                                            <div class="count-single-inner">
                                                <button type="button"  class="decrement">-</button>
                                                <span class="adult"><?php esc_html_e('0', 'nextdestina-booking'); ?></span>
                                                <button type="button" class="increment">+</button>
                                            </div>
                                        </div>
                                        <div class="count-single">
                                            <div class="count-single-text">
                                                <h6><?php esc_html_e('Childeren', 'nextdestina-booking'); ?></h6>
                                                <p><?php esc_html_e('Below 12 Years', 'nextdestina-booking'); ?></p>
                                            </div>
                                            <div class="count-single-inner">
                                                <button type="button"  class="decrementTwo">-</button>
                                                <span class="childeren"><?php esc_html_e('0', 'nextdestina-booking'); ?></span>
                                                <button type="button" class="incrementTwo">+</button>
                                            </div> 
                                        </div>
                                        <div class="count-single">
                                            <div class="count-single-text">
                                                <h6><?php esc_html_e('Infants', 'nextdestina-booking'); ?></h6>
                                                <p><?php esc_html_e('Below 3 Years', 'nextdestina-booking'); ?></p>
                                            </div>
                                            <div class="count-single-inner">
                                                <button type="button"  class="decrementThree">-</button>
                                                <span class="infants"><?php esc_html_e('0', 'nextdestina-booking'); ?></span>
                                                <button type="button" class="incrementThree">+</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <button type="submit" class="btn-1">
                                    <?php esc_html_e('Search Now', 'nextdestina-booking'); ?>
                                    <span></span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

		<?php elseif ( $settings['nextdestina_design_style']  == 'layout-2' ): ?>

        <div class="tour-search style-two">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="search-container">
                            <div class="bg-layer"></div>
                            <div class="search-form">
                                <form action="<?php echo esc_url( get_post_type_archive_link( 'tour' ) ); ?>" method="get">
                                    <div class="serach-title">
                                        <h6>
                                            <?php echo esc_html($settings['form_title']); ?>
                                        </h6>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-lg-6 col-xl-3">
                                            <div class="location search-box">
                                                <i class="fa-light fa-location-dot"></i>
                                                <div class="select-option">
                                                    <input type="text" id="tour-search-input" placeholder="<?php esc_attr_e( 'Where to', 'nextdestina-booking' ); ?>" name="keyword" autocomplete="off" value="<?php echo esc_attr($_GET['keyword'] ?? ''); ?>">
                                                    <div id="tour-suggestions" class="suggestions-box"></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-lg-6 col-xl-3">
                                            <div class="date">
                                                <input type="text" class="datepicker" name="travel_date"
                                                    value="<?php echo esc_attr($_GET['travel_date'] ?? ''); ?>"
                                                    placeholder="<?php esc_attr_e( 'Feb24 - Feb26', 'nextdestina-booking' ); ?>">
                                                <i class="fa-thin fa-calendar-days"></i>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-lg-6 col-xl-3">
                                            <div class="count">
                                                <input type="hidden" name="adults" id="search_adults" value="<?php echo esc_attr($_GET['adults'] ?? 0); ?>">
                                                <input type="hidden" name="children" id="search_children" value="<?php echo esc_attr($_GET['children'] ?? 0); ?>">
                                                <input type="hidden" name="infants" id="search_infants" value="<?php echo esc_attr($_GET['infants'] ?? 0); ?>">
                                                <div class="count-counter">
                                                    <i class="fa-light fa-user"></i>
                                                    <div class="count-counter-inner">
                                                        <span class="adult"><?php esc_html_e('2', 'nextdestina-booking'); ?></span>
                                                        <p><?php esc_html_e('adult', 'nextdestina-booking'); ?></p>
                                                    </div>
                                                    <div class="count-counter-inner">
                                                        <span class="childeren"><?php esc_html_e('0', 'nextdestina-booking'); ?></span>
                                                        <p><?php esc_html_e('childeren', 'nextdestina-booking'); ?></p>
                                                    </div>
                                                    <div class="count-counter-inner">
                                                        <span class="infants"><?php esc_html_e('0', 'nextdestina-booking'); ?></span>
                                                        <p><?php esc_html_e('infant', 'nextdestina-booking'); ?></p>
                                                    </div> 
                                                </div>
                                                <div class="count-container">
                                                    <div class="count-single">
                                                        <div class="count-single-text">
                                                            <h6><?php esc_html_e('Adult', 'nextdestina-booking'); ?></h6>
                                                            <p><?php esc_html_e('Over 12 Years', 'nextdestina-booking'); ?></p>
                                                        </div>
                                                        <div class="count-single-inner">
                                                            <button type="button"  class="decrement">-</button>
                                                            <span class="adult"><?php esc_html_e('0', 'nextdestina-booking'); ?></span>
                                                            <button type="button" class="increment">+</button>
                                                        </div>
                                                    </div>
                                                    <div class="count-single">
                                                        <div class="count-single-text">
                                                            <h6><?php esc_html_e('Childeren', 'nextdestina-booking'); ?></h6>
                                                            <p><?php esc_html_e('Below 12 Years', 'nextdestina-booking'); ?></p>
                                                        </div>
                                                        <div class="count-single-inner">
                                                            <button type="button"  class="decrementTwo">-</button>
                                                            <span class="childeren"><?php esc_html_e('0', 'nextdestina-booking'); ?></span>
                                                            <button type="button" class="incrementTwo">+</button>
                                                        </div> 
                                                    </div>
                                                    <div class="count-single">
                                                        <div class="count-single-text">
                                                            <h6><?php esc_html_e('Infants', 'nextdestina-booking'); ?></h6>
                                                            <p><?php esc_html_e('Below 3 Years', 'nextdestina-booking'); ?></p>
                                                        </div>
                                                        <div class="count-single-inner">
                                                            <button type="button"  class="decrementThree">-</button>
                                                            <span class="infants"><?php esc_html_e('0', 'nextdestina-booking'); ?></span>
                                                            <button type="button" class="incrementThree">+</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-lg-6 col-xl-3">
                                            <button type="submit" class="btn-1">
                                                <?php esc_html_e('Search Now', 'nextdestina-booking'); ?>
                                                <span></span>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php endif; ?>

        <?php 
	}
}
