<?php

namespace ProvixCore\Widgets;

if ( ! defined( 'ABSPATH' )) exit;

/**
 * Provix Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Provix_Section_Title extends \Elementor\Widget_Base {

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
		return 'section-title';
	}

	public function get_title() {
		return __( 'Section Title', 'agenvix-core' );
	}

	public function get_icon() {
		return 'provix-icon';
	}

	public function get_categories() {
		return array( 'agenvix-core' );
	}

	public function get_script_depends() {
		return array( 'agenvix-core' );
	}

	protected function register_controls() {

		/**
		 * Layout section
		 */

		$this->start_controls_section(
			'provix_layout',
			[
				'label' => esc_html__( 'Design Layout', 'agenvix-core' ),
			]
		);
		$this->add_control(
			'provix_design_style',
			[
				'label' => esc_html__( 'Select Layout', 'agenvix-core' ),
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
                    'layout-9' => esc_html__( 'Layout 9', 'agenvix-core' ),
				],
				'default' => 'layout-1',
			]
		);

		$this->end_controls_section();

		/**
		 * Title and content section
		 */
		$this->start_controls_section(
			'provix_section_title',
			[
				'label' => esc_html__( 'Title & Content', 'agenvix-core' ),
			]
		);

		$this->add_control(
			'subtitle',
			[
				'label'       => esc_html__( 'Subtitle', 'agenvix-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => esc_html__( 'Subtitle Here', 'agenvix-core' ),
				'placeholder' => esc_html__( 'Type subtitle', 'agenvix-core' ),
				'label_block' => true,
			]
		);
		$this->add_control(
			'provix_title',
			[
				'label'       => esc_html__( 'Title', 'agenvix-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => esc_html__( 'Title Here', 'agenvix-core' ),
				'placeholder' => esc_html__( 'Type title', 'agenvix-core' ),
				'label_block' => true,
			]
		);

        $this->add_control(
			'provix_title2',
			[
				'label'       => esc_html__( 'Title 2', 'agenvix-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => esc_html__( 'Title Here', 'agenvix-core' ),
				'placeholder' => esc_html__( 'Type title', 'agenvix-core' ),
				'label_block' => true,
			]
		);
        $this->add_control(
			'provix_title3',
			[
				'label'       => esc_html__( 'Title 3', 'agenvix-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => esc_html__( 'Title Here', 'agenvix-core' ),
				'placeholder' => esc_html__( 'Type title', 'agenvix-core' ),
				'label_block' => true,
			]
		);

        $this->add_control(
            'provix_description',
            [
                'label' => esc_html__('Description', 'agenvix-core'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Provix section description here', 'agenvix-core'),
                'placeholder' => esc_html__('Type section description here', 'agenvix-core'),
            ]
        );

        $this->end_controls_section();

        /**
         * Image section
         */
        $this->start_controls_section(
            '_provix_image',
            [
                'label' => esc_html__('Image', 'agenvix-core'),
            ]
        );
        $this->add_control(
            'provix_about_left_image',
            [
                'label' => esc_html__('Left Image', 'agenvix-core'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'provix_about_right_image',
            [
                'label' => esc_html__('Right Image', 'agenvix-core'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'provix_about_right_image_2',
            [
                'label' => esc_html__('Right Image 2', 'agenvix-core'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'provix_design_style' => 'layout-1',
                ],
            ]
        );


        $this->add_group_control(
            \Elementor\Group_Control_Image_Size::get_type(),
            [
                'name' => 'provix_image_size',
                'default' => 'full',
                'exclude' => [
                    'custom'
                ]
            ]
        );
        $this->add_control(
            'provix_image_overlap',
            [
                'label' => esc_html__('Image overlap to top?', 'agenvix-core'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'agenvix-core'),
                'label_off' => esc_html__('No', 'agenvix-core'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );
        $this->add_responsive_control(
            'provix_image_height',
            [
                'label' => esc_html__('Image Height', 'agenvix-core'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
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
                    '{{WRAPPER}} .provix-overlap img' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'provix_image_overlap_x',
            [
                'label' => esc_html__('Image overlap position', 'agenvix-core'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
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
                    '{{WRAPPER}} .provix-overlap img' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
                'condition' => array(
                    'provix_image_overlap' => 'yes',
                ),
            ]
        );

        $this->end_controls_section();

        /**
         * Style section
         */

        $this->start_controls_section(
            'general_section',
            [
                'label' => esc_html__('General', 'agenvix-core'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'text_alignment',
            [
                'label' => esc_html__('Alignment', 'agenvix-core'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => '',
                'options' => [
                    '' => esc_html__('Left', 'agenvix-core'),
                    'center'  => esc_html__('Center', 'agenvix-core'),
                    'right' => esc_html__('Right', 'agenvix-core'),
                ],
            ]
        );
        $this->add_responsive_control(
            'width',
            [
                'label' => esc_html__('Width', 'agenvix-core'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
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
            'subtitle_section',
            [
                'label' => esc_html__( 'Subtitle', 'agenvix-core' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'subtitle_color',
            [
                'label' => esc_html__( 'Color', 'agenvix-core' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .section-title .subtitle' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'subtitle_typography',
                'selector' => '{{WRAPPER}} .section-title .subtitle',
            ]
        );
        $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'background',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .section-title .subtitle',
			]
		);
        $this->add_responsive_control(
            'subtitle_margin',
            [
                'label' => esc_html__('Margin', 'agenvix-core'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .section-title .subtitle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'title_section',
            [
                'label' => esc_html__('Title', 'agenvix-core'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Color', 'agenvix-core'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .section-title .title' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .section-title .title .title-1' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .section-title .title .title-2' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .section-title .title .title-3' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .section-title .title, {{WRAPPER}} .section-title .title .title-1, {{WRAPPER}} .section-title .title .title-2',
            ]
        );
        $this->add_responsive_control(
            'title_margin',
            [
                'label' => esc_html__('Margin', 'agenvix-core'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .section-title .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'highlight_text',
            [
                'label' => esc_html__('Highlight Text', 'agenvix-core'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'highlight_text_color',
            [
                'label' => esc_html__('Color', 'agenvix-core'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .section-title .title span' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_span_typography',
                'selector' => '{{WRAPPER}} .section-title .title span',
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'description_section',
            [
                'label' => esc_html__('Description', 'agenvix-core'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'description_color',
            [
                'label' => esc_html__('Color', 'agenvix-core'),
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
		$this->add_responsive_control(
			'description_margin',
			[
				'label' => esc_html__('Margin', 'agenvix-core'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .section-title p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->end_controls_section();

        $this->start_controls_section(
            'section_style',
            [
                'label' => __('Style', 'agenvix-core'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'text_transform',
            [
                'label' => __('Text Transform', 'agenvix-core'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => '',
                'options' => [
                    '' => __('None', 'agenvix-core'),
                    'uppercase' => __('UPPERCASE', 'agenvix-core'),
                    'lowercase' => __('lowercase', 'agenvix-core'),
                    'capitalize' => __('Capitalize', 'agenvix-core'),
                ],
                'selectors' => [
                    '{{WRAPPER}} .title' => 'text-transform: {{VALUE}};',
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
    protected function render()
    {
        $settings = $this->get_settings_for_display();
?>

        <?php if ($settings['provix_design_style']  == 'layout-1'):
			$star_url = PROTINE_ADDONS_URL . 'assets/img/icons/star10.png';
			?>

			<div class="section-title style-one <?php echo $settings['text_alignment']; ?>">
				<?php if (!empty($settings['subtitle'])) : ?>
					<h6 class="subtitle">
						<div class="icon">
							<img src="<?php echo esc_url($star_url); ?>" alt="">
						</div>
						<?php echo $settings['subtitle']; ?>
					</h6>
				<?php endif ?>
				<h2 class="title text-anim-2"><?php echo $settings['provix_title']; ?></h2>
				<?php if (!empty($settings['provix_description'])) : ?>
					<p><?php echo $settings['provix_description']; ?></p>
				<?php endif ?>
			</div>

        <?php elseif ($settings['provix_design_style']  == 'layout-2'):
            $star_url = PROTINE_ADDONS_URL . 'assets/img/icons/star10-dark.png';
            ?>

            <div class="section-title style-two <?php echo $settings['text_alignment']; ?>">
				<?php if (!empty($settings['subtitle'])) : ?>
					<h6 class="subtitle">
						<div class="icon">
							<img src="<?php echo esc_url($star_url); ?>" alt="">
						</div>
						<?php echo $settings['subtitle']; ?>
					</h6>
				<?php endif ?>
				<h2 class="title text-anim-2"><?php echo $settings['provix_title']; ?></h2>
				<?php if (!empty($settings['provix_description'])) : ?>
					<p><?php echo $settings['provix_description']; ?></p>
				<?php endif ?>
			</div>

		<?php elseif ($settings['provix_design_style']  == 'layout-3'):
            $star_url = PROTINE_ADDONS_URL . 'assets/img/icons/star12-dark.png';
            ?>

			<div class="section-title style-three <?php echo $settings['text_alignment']; ?>">
				<?php if (!empty($settings['subtitle'])) : ?>
					<h6 class="subtitle">
						<div class="icon">
							<img src="<?php echo esc_url($star_url); ?>" alt="">
						</div>
						<?php echo $settings['subtitle']; ?>
					</h6>
				<?php endif ?>
				<h2 class="title text-anim-3"><?php echo $settings['provix_title']; ?></h2>
				<?php if (!empty($settings['provix_description'])) : ?>
					<p><?php echo $settings['provix_description']; ?></p>
				<?php endif ?>
			</div>

		<?php elseif ($settings['provix_design_style']  == 'layout-4'):
			$star_url = PROTINE_ADDONS_URL . 'assets/img/icons/star10-dark.png';
			?>

			<div class="section-title style-four <?php echo $settings['text_alignment']; ?>">
				<?php if (!empty($settings['subtitle'])) : ?>
					<h6 class="subtitle">
						<div class="icon">
							<img src="<?php echo esc_url($star_url); ?>" alt="">
						</div>
						<?php echo $settings['subtitle']; ?>
					</h6>
				<?php endif ?>
				<h2 class="title wa-split-clr"><?php echo $settings['provix_title']; ?></h2>
				<?php if (!empty($settings['provix_description'])) : ?>
					<p><?php echo $settings['provix_description']; ?></p>
				<?php endif ?>
			</div>

        <?php elseif ($settings['provix_design_style']  == 'layout-5') : ?>

			<div class="section-title style-five <?php echo $settings['text_alignment']; ?>">
				<div class="title">
					<h2 class="title-1"><?php echo $settings['provix_title']; ?></h2>
					<h2 class="title-2"><?php echo $settings['provix_title2']; ?></h2>
				</div>
				<?php if (!empty($settings['provix_description'])) : ?>
					<p class="description"><?php echo $settings['provix_description']; ?></p>
				<?php endif ?>
			</div>

        <?php elseif ($settings['provix_design_style']  == 'layout-6') : ?>

			<div class="section-title style-six <?php echo $settings['text_alignment']; ?>">
				<div class="title">
					<h2 class="title-1"><?php echo $settings['provix_title']; ?></h2>

					<?php if( !empty($settings['provix_title2']) ) : ?>
						<h2 class="title-2"><?php echo $settings['provix_title2']; ?></h2>
					<?php endif; ?>

					<h2 class="title-3"><?php echo $settings['provix_title3']; ?></h2>
				</div>
				<?php if (!empty($settings['provix_description'])) : ?>
					<p class="description"><?php echo $settings['provix_description']; ?></p>
				<?php endif ?>
			</div>

        <?php elseif ( 'layout-7' === $settings['provix_design_style'] ) : ?>

            <div class="section-title style-seven <?php echo $settings['text_alignment']; ?>">
				<div class="title">
					<h2 class="title-1"><?php echo $settings['provix_title']; ?></h2>

					<?php if( !empty($settings['provix_title2']) ) : ?>
						<h2 class="title-2"><?php echo $settings['provix_title2']; ?></h2>
					<?php endif; ?>
                    
                    <?php if( !empty($settings['provix_title3']) ) : ?>
					    <h2 class="title-3"><?php echo $settings['provix_title3']; ?></h2>
                    <?php endif; ?>
				</div>
				<?php if (!empty($settings['provix_description'])) : ?>
					<p class="description"><?php echo $settings['provix_description']; ?></p>
				<?php endif ?>
			</div>

		<?php elseif ( 'layout-8' === $settings['provix_design_style'] ) : ?>

			<div class="section-title style-eight <?php echo $settings['text_alignment']; ?>">
				<div class="title">
					<?php if( !empty($settings['provix_title']) ) : ?>
						<h2 class="title-1"><?php echo $settings['provix_title']; ?></h2>
					<?php endif; ?>

					<?php if( !empty($settings['provix_title2']) ) : ?>
						<h2 class="title-2"><?php echo $settings['provix_title2']; ?></h2>
					<?php endif; ?>
				</div>
			</div>
			
		<?php elseif ( 'layout-9' === $settings['provix_design_style'] ) : ?>

			<div class="section-title style-nine <?php echo $settings['text_alignment']; ?>">
                
                <?php if (!empty($settings['subtitle'])) : ?>
					<h6 class="subtitle">
						<?php echo $settings['subtitle']; ?>
					</h6>
				<?php endif ?>
				
				<?php if( !empty($settings['provix_title']) ) : ?>
					<h2 class="title"><?php echo $settings['provix_title']; ?></h2>
				<?php endif; ?>
				
				<?php if (!empty($settings['provix_description'])) : ?>
					<p class="description"><?php echo $settings['provix_description']; ?></p>
				<?php endif ?>

			</div>

        <?php endif; ?>

<?php
    }
}

$widgets_manager->register(new Provix_Section_Title());
