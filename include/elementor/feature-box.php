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
class Protine_Feature_Box extends \Elementor\Widget_Base {

	public function get_name() {
		return 'protine-feature-box';
	}

	public function get_title() {
		return __( 'Feature Box', 'protinecore' );
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
                    'layout-3' => esc_html__('Layout 3', 'protinecore'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_icon',
            [
                'label' => esc_html__( 'Icon', 'protinecore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'icon',
            [
                'label' => esc_html__( 'Icon', 'protinecore' ),
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
                'label' => esc_html__( 'Choose Image', 'protinecore' ),
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
            'protine_section_title',
            [
                'label' => esc_html__('Title & Content', 'protinecore'),
            ]
        );
        $this->add_control(
            'serial_number',
            [
                'label' => esc_html__('Serial Number', 'protinecore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('001', 'protinecore'),
                'placeholder' => esc_html__('Type number', 'protinecore'),
            ]
        );
        $this->add_control(
            'protine_title',
            [
                'label' => esc_html__('Title', 'protinecore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Title Here', 'protinecore'),
                'placeholder' => esc_html__('Type title', 'protinecore'),
                'label_block' => true,
            ]
        );
        $this->add_control(
            'protine_description',
            [
                'label' => esc_html__('Description', 'protinecore'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Protine section description here', 'protinecore'),
                'placeholder' => esc_html__('Type section description here', 'protinecore'),
            ]
        );

        $this->end_controls_section();

        /**
         * Image section
         */
		$this->start_controls_section(
            'feature_box_image',
            [
                'label' => esc_html__('Image', 'protinecore'),
            ]
        );
        $this->add_control(
            'image',
            [
                'label' => esc_html__( 'Image', 'protinecore' ),
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
			'general_section',
			[
				'label' => __( 'General', 'protinecore' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_control(
            'text_align',
            [
                'label' => esc_html__( 'Alignment', 'protinecore' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'protinecore' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'protinecore' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'protinecore' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'left',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .box-icon' => 'text-align: {{VALUE}};',
                ],
            ]
        );

		$this->end_controls_section();

        $this->start_controls_section(
            'title_style',
            [
                'label' => esc_html__( 'Title', 'protinecore' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
            $this->add_control(
                'title_color',
                [
                    'label' => esc_html__( 'Color', 'protinecore' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .feature-box .content .box-text .title' => 'color: {{VALUE}}',
                    ],
                ]
            );
            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'title_typography',
                    'selector' => '{{WRAPPER}} .feature-box .content .box-text .title',
                ]
            );
            $this->add_control(
                'title_margin',
                [
                    'label' => esc_html__( 'Margin', 'protinecore' ),
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .feature-box .content .box-text .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
        $this->end_controls_section();

        $this->start_controls_section(
            'description_style',
            [
                'label' => esc_html__( 'Description', 'protinecore' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
            $this->add_control(
                'description_color',
                [
                    'label' => esc_html__( 'Color', 'protinecore' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .feature-box.style-one .content .box-text p' => 'color: {{VALUE}}',
                    ],
                ]
            );
            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'description_typography',
                    'selector' => '{{WRAPPER}} .feature-box.style-one .content .box-text p',
                ]
            );
            $this->add_control(
                'description_margin',
                [
                    'label' => esc_html__( 'Margin', 'protinecore' ),
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .feature-box.style-one .content .box-text p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
        $this->end_controls_section();

        $this->start_controls_section(
            'image_style',
            [
                'label' => esc_html__( 'Image', 'protinecore' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_responsive_control(
                'image_align',
                [
                    'label' => esc_html__( 'Image Alignment', 'protinecore' ),
                    'type' => \Elementor\Controls_Manager::CHOOSE,
                    'options' => [
                        'row-reverse' => [
                            'title' => esc_html__( 'Left', 'protinecore' ),
                            'icon' => 'eicon-h-align-left',
                        ],
                        'row' => [
                            'title' => esc_html__( 'Right', 'protinecore' ),
                            'icon' => 'eicon-h-align-right',
                        ],
                    ],
                    'default' => 'right',
                    'toggle' => true,
                    'selectors' => [
                        '{{WRAPPER}} .feature-box' => 'flex-direction: {{VALUE}};',
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

            if ( !empty($settings['icon_image']['url']) ) {
                $icon = !empty($settings['icon_image']['id']) ? wp_get_attachment_image_url( $settings['icon_image']['id'], '') : $settings['icon_image']['url'];
            }
            if ( !empty($settings['image']['url']) ) {
                $image = !empty($settings['image']['id']) ? wp_get_attachment_image_url( $settings['image']['id'], '') : $settings['image']['url'];
            }
        ?>

		<?php if($settings['protine_design_style'] == "layout-1" ){ ?>

            <div class="feature-box style-one">
                <div class="content">
                    <div class="box-top">
                        <span class="number"><?php echo $settings['serial_number']; ?></span>
                        <span class="icon">
                            <img src="<?php echo esc_url($icon); ?>" alt="icon">
                        </span>
                    </div>
                    <div class="box-text">
                        <h4 class="title"><?php echo $settings['protine_title']; ?></h4>
                        <p><?php echo $settings['protine_description']; ?></p>
                    </div>
                </div>
                <div class="feature-image">
                    <img src="<?php echo esc_url($image); ?>" alt="image">
                </div>
            </div>

		<?php }elseif($settings['protine_design_style'] == "layout-2" ){ ?>

            <div class="box-icon style-two">
                <div class="icon">
                    <?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?>
                </div>
                <a href="#"><?php echo $settings['protine_title']; ?></a>
                <?php if(!empty($settings['protine_description'])) : ?>
                    <p><?php echo $settings['protine_description']; ?></p>
                <?php endif; ?>
            </div>

        <?php }elseif($settings['protine_design_style'] == "layout-3" ){ ?>
            
            <div class="box-icon style-three">
                <div class="icon">
                    <img src="<?php echo esc_url($icon); ?>" alt="icon">
                </div>
                <div class="content">
                    <h4 class="title"><?php echo $settings['protine_title']; ?></h4>
                    <?php if(!empty($settings['protine_description'])) : ?>
                        <p><?php echo $settings['protine_description']; ?></p>
                    <?php endif; ?>
                </div>
            </div>

        <?php } ?>

        <?php 
	}
}

$widgets_manager->register( new Protine_Feature_Box() );