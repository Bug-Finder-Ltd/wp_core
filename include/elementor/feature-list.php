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
class Provix_Feature_List extends \Elementor\Widget_Base {

	public function get_name() {
		return 'provix-feature-list';
	}

	public function get_title() {
		return __( 'Feature List', 'agenvix-core' );
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
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Content', 'agenvix-core' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'feature_title',
            [
                'label' => esc_html__( 'Title', 'agenvix-core' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__( 'Default title', 'agenvix-core' ),
                'placeholder' => esc_html__( 'Type your title here', 'agenvix-core' ),
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => esc_html__( 'Button Text', 'agenvix-core' ),
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

        $this->start_controls_section(
            'features',
            [
                'label' => esc_html__( 'Features', 'agenvix-core' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

            $repeater = new \Elementor\Repeater();

            $repeater->add_control(
                'list_number',
                [
                    'label' => esc_html__( 'Number', 'agenvix-core' ),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => esc_html__( '01' , 'agenvix-core' ),
                ]
            );

            $repeater->add_control(
                'list_title',
                [
                    'label' => esc_html__( 'Title', 'agenvix-core' ),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => esc_html__( 'List Title' , 'agenvix-core' ),
                    'label_block' => true,
                ]
            );

            $repeater->add_control(
                'list_content',
                [
                    'label' => esc_html__( 'Content', 'agenvix-core' ),
                    'type' => \Elementor\Controls_Manager::TEXTAREA,
                    'default' => esc_html__( 'List Content' , 'agenvix-core' ),
                    'show_label' => false,
                ]
            );
            $repeater->add_control(
                'icon_image',
                [
                    'label' => esc_html__( 'Choose Icon', 'agenvix-core' ),
                    'type' => \Elementor\Controls_Manager::MEDIA,
                ]
            );
            $this->add_control(
                'list',
                [
                    'label' => esc_html__( 'Features List', 'agenvix-core' ),
                    'type' => \Elementor\Controls_Manager::REPEATER,
                    'fields' => $repeater->get_controls(),
                    'default' => [
                        [
                            'list_title' => esc_html__( 'Title #1', 'agenvix-core' ),
                            'list_content' => esc_html__( 'Item content. Click the edit button to change this text.', 'agenvix-core' ),
                        ],
                        [
                            'list_title' => esc_html__( 'Title #2', 'agenvix-core' ),
                            'list_content' => esc_html__( 'Item content. Click the edit button to change this text.', 'agenvix-core' ),
                        ],
                    ],
                    'title_field' => '{{{ list_title }}}',
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
                    '{{WRAPPER}} .box-icon' => 'text-align: {{VALUE}};',
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

            $this->add_responsive_control(
                'width',
                [
                    'label' => esc_html__( 'Width', 'agenvix-core' ),
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
                        '{{WRAPPER}} .features-list .feature-title' => 'max-width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_control(
                'title_color',
                [
                    'label' => esc_html__( 'Color', 'agenvix-core' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .features-list .feature-title' => 'color: {{VALUE}}',
                    ],
                ]
            );
            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'title_typography',
                    'selector' => '{{WRAPPER}} .features-list .feature-title',
                ]
            );
            $this->add_control(
                'title_margin',
                [
                    'label' => esc_html__( 'Margin', 'agenvix-core' ),
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .features-list .feature-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    'label' => esc_html__( 'Margin', 'agenvix-core' ),
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
                'label' => esc_html__( 'Image', 'agenvix-core' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_responsive_control(
                'image_align',
                [
                    'label' => esc_html__( 'Image Alignment', 'agenvix-core' ),
                    'type' => \Elementor\Controls_Manager::CHOOSE,
                    'options' => [
                        'row-reverse' => [
                            'title' => esc_html__( 'Left', 'agenvix-core' ),
                            'icon' => 'eicon-h-align-left',
                        ],
                        'row' => [
                            'title' => esc_html__( 'Right', 'agenvix-core' ),
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

            if ( !empty($settings['image']['url']) ) {
                $image = !empty($settings['image']['id']) ? wp_get_attachment_image_url( $settings['image']['id'], '') : $settings['image']['url'];
            }
        ?>

		<?php if($settings['provix_design_style'] == "layout-1" ){ ?>

            <div class="features-list style-one">
                <div class="row">
                    <div class="col-md-6 col-lg-6">
                        <div class="feature-left">
                            <?php if(!empty($settings['feature_title'])) : ?>
                                <h2 class="feature-title"><?php echo $settings['feature_title']; ?></h2>
                            <?php endif; ?>
                            <div class="button-area">
                                <div class="shape"></div>
                                <div class="view-all">
                                    <a href="<?php echo esc_url($settings['button_link']['url']); ?>">
                                        <?php echo $settings['button_text']; ?>
                                        <i class="pi-medicine"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <div class='cards'>
                            <?php
                            $i = 0;
                            foreach (  $settings['list'] as $item ) :
                                $icon = "";
                                $i++;
                                if ( !empty($item['icon_image']['url']) ) {
                                    $icon = !empty($item['icon_image']['id']) ? wp_get_attachment_image_url( $item['icon_image']['id'], '') : $item['icon_image']['url'];
                                }
                            ?>
                                <div class="feature-item item-<?php echo $i; ?>">
                                    <div class="box-head">
                                        <?php if(!empty($item['list_number'])) : ?>
                                            <span class="number">
                                                <?php echo $item['list_number']; ?>
                                            </span>
                                        <?php endif; ?>
                                        
                                        <?php if(!empty($icon)) : ?>
                                            <span class="icon">
                                                <img src="<?php echo esc_url($icon); ?>" alt="icon">
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                    <h3 class="title"><?php echo $item['list_title']; ?></h3>
                                    <p class="description"><?php echo $item['list_content']; ?></p>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>

		<?php }elseif($settings['provix_design_style'] == "layout-2" ){ ?>

        <div class="features-list style-two">
            <div class="border-one">
                <div class="dot1"></div>
                <div class="border-two">
                    <div class="dot2"></div>
                    <div class="circle-center">
                        <h2 class="title"><?php echo $settings['feature_title']; ?></h2>
                    </div>
                </div>
            </div>
            <div class="item-wrapper">
            <?php
                $i = 0;
                foreach (  $settings['list'] as $item ) {
                    $icon = "";
                    $i++;
                    if ( !empty($item['icon_image']['url']) ) {
                        $icon = !empty($item['icon_image']['id']) ? wp_get_attachment_image_url( $item['icon_image']['id'], '') : $item['icon_image']['url'];
                    }
                ?>
                <div class="feature-item item-<?php echo $i; ?>">
                    <div class="box-head">
                        <?php if(!empty($item['list_number'])) : ?>
                            <span class="number">
                                <?php echo $item['list_number']; ?>
                            </span>
                        <?php endif; ?>
                        
                        <?php if(!empty($icon)) : ?>
                            <span class="icon">
                                <img src="<?php echo esc_url($icon); ?>" alt="icon">
                            </span>
                        <?php endif; ?>
                    </div>
                    <h3 class="title"><?php echo $item['list_title']; ?></h3>
                    <p class="description"><?php echo $item['list_content']; ?></p>
                </div>
                <?php } ?>
            </div>
        </div>

        <?php }elseif($settings['provix_design_style'] == "layout-3" ){ ?>
            
        <div class="features-list style-three">
            <?php if(!empty($settings['feature_title'])) : ?>
                <h2 class="section-title"><?php echo $settings['feature_title']; ?></h2>
            <?php endif; ?>
            <div class="border-one">
                <div class="dot1"></div>
                <div class="border-two">
                    <div class="dot2"></div>
                </div>
            </div>
            <div class="item-wrapper">
                <?php
                $i = 0;
                foreach (  $settings['list'] as $item ) {
                    $icon = "";
                    $i++;
                    if ( !empty($item['icon_image']['url']) ) {
                        $icon = !empty($item['icon_image']['id']) ? wp_get_attachment_image_url( $item['icon_image']['id'], '') : $item['icon_image']['url'];
                    }
                ?>
                <div class="feature-item item-<?php echo $i; ?>">
                    <div class="box-head">
                        <?php if(!empty($item['list_number'])) : ?>
                            <span class="number">
                                <?php echo $item['list_number']; ?>
                            </span>
                        <?php endif; ?>
                        
                        <?php if(!empty($icon)) : ?>
                            <span class="icon">
                                <img src="<?php echo esc_url($icon); ?>" alt="icon">
                            </span>
                        <?php endif; ?>
                    </div>
                    <h3 class="title"><?php echo $item['list_title']; ?></h3>
                    <p class="description"><?php echo $item['list_content']; ?></p>
                </div>
                <?php } ?>
            </div>
        </div>

        <?php } ?>

        <?php 
	}
}

$widgets_manager->register( new Provix_Feature_List() );