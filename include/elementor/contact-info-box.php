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
class Contact_info_Box extends \Elementor\Widget_Base {

	public function get_name() {
		return 'contact-info-box';
	}

	public function get_title() {
		return __( 'Contact Info Box', 'agenvix-core' );
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
                    'layout-3' => esc_html__('Layout 3', 'agenvix-core'),
                    'layout-4' => esc_html__('Layout 4', 'agenvix-core'),
                    'layout-5' => esc_html__('Layout 5', 'agenvix-core'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_icon',
            [
                'label' => esc_html__( 'Icon', 'agenvix-core' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'icon',
            [
                'label' => esc_html__( 'Icon', 'agenvix-core' ),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-circle',
                    'library' => 'fa-solid',
                ],
                'recommended' => [
                    'fa-solid' => [
                        'circle',
                        'dot-circle',
                        'square-full',
                    ],
                    'fa-regular' => [
                        'circle',
                        'dot-circle',
                        'square-full',
                    ],
                ],
            ]
        );
        $this->add_control(
            'icon_image',
            [
                'label' => esc_html__( 'Choose Icon', 'agenvix-core' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
            ]
        );
        $this->end_controls_section();

		$this->start_controls_section(
            'image_section',
            [
                'label' => esc_html__( 'Image', 'agenvix-core' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
		$this->add_control(
			'image',
			[
				'label' => esc_html__( 'Choose Image', 'agenvix-core' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->end_controls_section();
        
        /**
         * Title and content section
         */
        $this->start_controls_section(
            'provix_section_title',
            [
                'label' => esc_html__('Title & Content', 'agenvix-core'),
            ]
        );
        $this->add_control(
            'provix_title',
            [
                'label' => esc_html__('Title', 'agenvix-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Title Here', 'agenvix-core'),
                'placeholder' => esc_html__('Type title', 'agenvix-core'),
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
         * Button section
         */
		$this->start_controls_section(
            'button',
            [
                'label' => esc_html__('Button', 'agenvix-core'),
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => esc_html__( 'Text', 'agenvix-core' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Click Here', 'agenvix-core' ),
                'placeholder' => esc_html__( 'Type your text here', 'agenvix-core' ),
            ]
        );
        $this->add_control(
            'button_link',
            [
                'label' => esc_html__( 'Link', 'agenvix-core' ),
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


        /**
         * Style section
         */
		$this->start_controls_section(
			'general_section',
			[
				'label' => __( 'General', 'agenvix-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_control(
            'text_align',
            [
                'label' => esc_html__( 'Alignment', 'agenvix-core' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'agenvix-core' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'agenvix-core' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'agenvix-core' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'left',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .contact-info-box' => 'text-align: {{VALUE}};',
                ],
            ]
        );

		$this->end_controls_section();

        $this->start_controls_section(
            'title_style',
            [
                'label' => esc_html__( 'Title', 'agenvix-core' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
            $this->add_control(
                'title_color',
                [
                    'label' => esc_html__( 'Color', 'agenvix-core' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .contact-info-box .title' => 'color: {{VALUE}}',
                    ],
                ]
            );
            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'title_typography',
                    'selector' => '{{WRAPPER}} .contact-info-box .title',
                ]
            );
            $this->add_control(
                'title_margin',
                [
                    'label' => esc_html__( 'Margin', 'agenvix-core' ),
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .contact-info-box .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
        $this->end_controls_section();

        $this->start_controls_section(
            'description_style',
            [
                'label' => esc_html__( 'Description', 'agenvix-core' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
            $this->add_control(
                'description_color',
                [
                    'label' => esc_html__( 'Color', 'agenvix-core' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .contact-info-box .description' => 'color: {{VALUE}}',
                    ],
                ]
            );
            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'description_typography',
                    'selector' => '{{WRAPPER}} .contact-info-box .description',
                ]
            );
            $this->add_responsive_control(
                'description_margin',
                [
                    'label' => esc_html__( 'Margin', 'agenvix-core' ),
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .contact-info-box .description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
        $this->end_controls_section();

        $this->start_controls_section(
            'button_style',
            [
                'label' => esc_html__( 'Button', 'agenvix-core' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_control(
                'button_color',
                [
                    'label' => esc_html__( 'Color', 'agenvix-core' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .contact-info-box .button' => 'color: {{VALUE}}',
                    ],
                ]
            );
            $this->add_group_control(
                \Elementor\Group_Control_Background::get_type(),
                [
                    'name' => 'button_background',
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .contact-info-box .button',
                ]
            );
            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'button_typography',
                    'selector' => '{{WRAPPER}} .contact-info-box .button',
                ]
            );
            $this->add_control(
                'button_margin',
                [
                    'label' => esc_html__( 'Margin', 'agenvix-core' ),
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .contact-info-box .button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

            if ( !empty($settings['icon_image']['url']) ) {
                $icon = !empty($settings['icon_image']['id']) ? wp_get_attachment_image_url( $settings['icon_image']['id'], '') : $settings['icon_image']['url'];
            }
        ?>

		<?php if($settings['provix_design_style'] == "layout-1" ){ ?>

            <div class="contact-info-box style-one">
                <div class="icon">
                    <?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?>

                    <?php if(!empty($icon)) : ?>
                        <img src="<?php echo esc_url($icon); ?>" alt="icon">
                    <?php endif; ?>
                </div>
                <h4 class="title"><?php echo $settings['provix_title']; ?></h4>
                <p class="description"><?php echo $settings['provix_description']; ?></p>
                <a class="button" href="<?php echo esc_url($settings['button_link']['url']); ?>">
                    <?php echo $settings['button_text']; ?>
                </a>
            </div>

		<?php }elseif($settings['provix_design_style'] == "layout-2" ){ ?>

            <div class="box-icon style-two">
                <div class="icon">
                    <?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?>
                </div>
                <a href="#"><?php echo $settings['provix_title']; ?></a>
                <?php if(!empty($settings['provix_description'])) : ?>
                    <p><?php echo $settings['provix_description']; ?></p>
                <?php endif; ?>
            </div>

        <?php }elseif($settings['provix_design_style'] == "layout-3" ){ ?>
            
            <div class="box-icon style-three">
                <div class="icon">
                    <img src="<?php echo esc_url($icon); ?>" alt="icon">
                </div>
                <div class="content">
                    <h4 class="title"><?php echo $settings['provix_title']; ?></h4>
                    <?php if(!empty($settings['provix_description'])) : ?>
                        <p><?php echo $settings['provix_description']; ?></p>
                    <?php endif; ?>
                </div>
            </div>

        <?php }elseif( "layout-4" === $settings['provix_design_style'] ){ ?>

            <div class="contact-info-box style-four">
                <div class="icon">
                    <?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?>

                    <?php if(!empty($icon)) : ?>
                        <img src="<?php echo esc_url($icon); ?>" alt="icon">
                    <?php endif; ?>
                </div>
                <div class="content">
                    <h4 class="title"><?php echo $settings['provix_title']; ?></h4>
                    <p class="description"><?php echo $settings['provix_description']; ?></p>
                    <a class="button" href="<?php echo esc_url($settings['button_link']['url']); ?>">
                        <?php echo $settings['button_text']; ?>
                    </a>
                </div>
            </div>

        <?php }elseif( "layout-5" === $settings['provix_design_style'] ){
			if (! empty($settings['image']['url'])) {
				$image     = ! empty($settings['image']['id']) ? wp_get_attachment_image_url($settings['image']['id'], '') : $settings['image']['url'];
				$image_alt = get_post_meta($settings['image']['id'], '_wp_attachment_image_alt', true);
			}
			?>
			
			<div class="contact-info-box style-five">
				<h4 class="title"><?php echo $settings['provix_title']; ?></h4>
				<div class="image">
					<img src="<?php echo esc_url($image); ?>" alt="image">
				</div>
				<div class="content">
					<p class="description"><?php echo $settings['provix_description']; ?></p>
					<a class="button" href="<?php echo esc_url($settings['button_link']['url']); ?>">
						<?php echo $settings['button_text']; ?>
					</a>
				</div>
			</div>

		<?php } ?>

		<?php 
	}
}

$widgets_manager->register( new Contact_info_Box() );