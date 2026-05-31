<?php
namespace AgenvixCore\Widgets;

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Agenvix Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Agenvix_Skill_List extends \Elementor\Widget_Base {

	public function get_name() {
		return 'agenvix-skill-list';
	}

	public function get_title() {
		return __( 'Skill List', 'agenvix-core' );
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
            'agenvix_layout',
            [
                'label' => esc_html__('Design Layout', 'agenvix-core'),
            ]
        );
        $this->add_control(
            'agenvix_design_style',
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
            'skills_section',
            [
                'label' => esc_html__( 'Skills', 'agenvix-core' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'skill_name',
            [
                'label' => esc_html__( 'Skill Name', 'agenvix-core' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Figma' , 'agenvix-core' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'icon_image',
            [
                'label' => esc_html__( 'Icon Image', 'agenvix-core' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'progress_lavel',
            [
                'label' => esc_html__( 'Progress', 'agenvix-core' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( '50%' , 'agenvix-core' ),
            ]
        );

        $this->add_control(
            'list',
            [
                'label' => esc_html__( 'Skill List', 'agenvix-core' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'skill_name' => esc_html__( 'Figma', 'agenvix-core' ),
                    ],
                    [
                        'skill_name' => esc_html__( 'Photoshop', 'agenvix-core' ),
                    ],
                ],
                'title_field' => '{{{ skill_name }}}',
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
            'item_style',
            [
                'label' => esc_html__( 'Item', 'agenvix-core' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
            $this->add_group_control(
                \Elementor\Group_Control_Background::get_type(),
                [
                    'name' => 'item_background',
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .skill-list .skill-item',
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
                        '{{WRAPPER}} .skill-list .skill-item .name' => 'color: {{VALUE}}',
                    ],
                ]
            );
            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'title_typography',
                    'selector' => '{{WRAPPER}} .skill-list .skill-item .name',
                ]
            );
            $this->add_control(
                'title_margin',
                [
                    'label' => esc_html__( 'Margin', 'agenvix-core' ),
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .skill-list .skill-item .name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
        $this->end_controls_section();

        $this->start_controls_section(
            'icon_style',
            [
                'label' => esc_html__( 'Icon', 'agenvix-core' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
            $this->add_control(
                'icon_color',
                [
                    'label' => esc_html__( 'Color', 'agenvix-core' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .skill-list .skill-item .icon' => 'color: {{VALUE}}',
                    ],
                ]
            );
            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'icon_typography',
                    'selector' => '{{WRAPPER}} .skill-list .skill-item .icon',
                ]
            );
            $this->add_group_control(
                \Elementor\Group_Control_Background::get_type(),
                [
                    'name' => 'icon_background',
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .skill-list .skill-item .icon',
                ]
            );
            $this->add_control(
                'icon_margin',
                [
                    'label' => esc_html__( 'Margin', 'agenvix-core' ),
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .skill-list .skill-item .icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
        $this->end_controls_section();

        $this->start_controls_section(
            'progress_style',
            [
                'label' => esc_html__( 'Progress', 'agenvix-core' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
            $this->add_control(
                'progress_color',
                [
                    'label' => esc_html__( 'Color', 'agenvix-core' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .skill-list .skill-item .progress-lavel' => 'color: {{VALUE}}',
                    ],
                ]
            );
            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'progress_typography',
                    'selector' => '{{WRAPPER}} .skill-list .skill-item .progress-lavel',
                ]
            );
            $this->add_group_control(
                \Elementor\Group_Control_Background::get_type(),
                [
                    'name' => 'progress_background',
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .skill-list .skill-item .progress-lavel',
                ]
            );
            $this->add_control(
                'progress_margin',
                [
                    'label' => esc_html__( 'Margin', 'agenvix-core' ),
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .skill-list .skill-item .progress-lavel' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

            if ( !empty($settings['image']['url']) ) {
                $image = !empty($settings['image']['id']) ? wp_get_attachment_image_url( $settings['image']['id'], '') : $settings['image']['url'];
            }
        ?>

		<?php if($settings['agenvix_design_style'] == "layout-1" ){ ?>

            <div class="skill-list style-one">
                <div class="skill-capsule-wrapper-box" data-t-throwable-scene="true">
                    <div class="skill-capsule-wrapper">
                        <?php foreach (  $settings['list'] as $item ) :
                            if ( !empty($item['icon_image']['url']) ) {
                                $icon = !empty($item['icon_image']['id']) ? wp_get_attachment_image_url( $item['icon_image']['id'], '') : $item['icon_image']['url'];
                            }
                            ?>
                            <p data-t-throwable-el>
                                <span class="skill-box">
                                    <span class="icon">
                                        <img src="<?php echo esc_url($icon); ?>" alt="icon">
                                    </span>
                                </span>
                            </p>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="lines">
                    <div class="line"></div>
                    <div class="line"></div>
                    <div class="line"></div>
                    <div class="line"></div>
                </div>
            </div>

		<?php }elseif($settings['agenvix_design_style'] == "layout-2" ){ ?>

            <div class="skill-list style-two">
                <div class="skill-capsule-wrapper-box" data-t-throwable-scene="true">
                    <div class="skill-capsule-wrapper">
                        <?php foreach (  $settings['list'] as $item ) :
                            if ( !empty($item['icon_image']['url']) ) {
                                $icon = !empty($item['icon_image']['id']) ? wp_get_attachment_image_url( $item['icon_image']['id'], '') : $item['icon_image']['url'];
                            }
                            ?>
                            <p data-t-throwable-el>
                                <span class="skill-box">
                                    <span class="icon">
                                        <img src="<?php echo esc_url($icon); ?>" alt="icon">
                                    </span>
                                </span>
                            </p>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="lines">
                    <div class="line"></div>
                    <div class="line"></div>
                    <div class="line"></div>
                    <div class="line"></div>
                </div>
            </div>

        <?php }elseif($settings['agenvix_design_style'] == "layout-3" ){ ?>
            
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

$widgets_manager->register( new Agenvix_Skill_List() );