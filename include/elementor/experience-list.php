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
class Raizen_Experience_List extends \Elementor\Widget_Base {

	public function get_name() {
		return 'experience-list';
	}

	public function get_title() {
		return __( 'Experience List', 'raizencore' );
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
                    'layout-3' => esc_html__('Layout 3', 'raizencore'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'experience_section',
            [
                'label' => esc_html__( 'Experience', 'raizencore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'company_name',
            [
                'label' => esc_html__( 'Company Name', 'raizencore' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'ThemeDevs' , 'raizencore' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'icon_image',
            [
                'label' => esc_html__( 'Icon Image', 'raizencore' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'duration',
            [
                'label' => esc_html__( 'Duration', 'raizencore' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( '2020 - 2021' , 'raizencore' ),
            ]
        );

        $this->add_control(
            'list',
            [
                'label' => esc_html__( 'Experience List', 'raizencore' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'company_name' => esc_html__( 'ThemeDevs', 'raizencore' ),
                        'duration' => esc_html__( '2020 - 2021', 'raizencore' ),
                    ],
                    [
                        'company_name' => esc_html__( 'Softwer Agency', 'raizencore' ),
                        'duration' => esc_html__( '2019 - 2020', 'raizencore' ),
                    ],
                ],
                'title_field' => '{{{ company_name }}}',
            ]
        );

        $this->end_controls_section();

        /**
         * Style section
         */
		$this->start_controls_section(
			'general_section',
			[
				'label' => __( 'General', 'raizencore' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_control(
            'text_align',
            [
                'label' => esc_html__( 'Alignment', 'raizencore' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'raizencore' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'raizencore' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'raizencore' ),
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
                'label' => esc_html__( 'Title', 'raizencore' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_control(
                'title_color',
                [
                    'label' => esc_html__( 'Color', 'raizencore' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .experience-list .exp-item .year' => 'color: {{VALUE}}',
                    ],
                ]
            );
            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'title_typography',
                    'selector' => '{{WRAPPER}} .experience-list .exp-item .year',
                ]
            );
            $this->add_control(
                'title_margin',
                [
                    'label' => esc_html__( 'Margin', 'raizencore' ),
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .experience-list .exp-item .year' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
        $this->end_controls_section();

        $this->start_controls_section(
            'description_style',
            [
                'label' => esc_html__( 'Description', 'raizencore' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
            $this->add_control(
                'description_color',
                [
                    'label' => esc_html__( 'Color', 'raizencore' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .experience-list .exp-item .company' => 'color: {{VALUE}}',
                    ],
                ]
            );
            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'description_typography',
                    'selector' => '{{WRAPPER}} .experience-list .exp-item .company',
                ]
            );
            $this->add_control(
                'description_margin',
                [
                    'label' => esc_html__( 'Margin', 'raizencore' ),
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .experience-list .exp-item .company' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
        $this->end_controls_section();

        $this->start_controls_section(
            'icon_style',
            [
                'label' => esc_html__( 'Icon', 'raizencore' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
            $this->add_control(
                'icon_color',
                [
                    'label' => esc_html__( 'Color', 'raizencore' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .experience-list .exp-item .icon' => 'color: {{VALUE}}',
                    ],
                ]
            );
            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'icon_typography',
                    'selector' => '{{WRAPPER}} .experience-list .exp-item .icon',
                ]
            );
            $this->add_group_control(
                \Elementor\Group_Control_Background::get_type(),
                [
                    'name' => 'icon_background',
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .experience-list .exp-item .icon',
                ]
            );
            $this->add_group_control(
                \Elementor\Group_Control_Border::get_type(),
                [
                    'name' => 'icon_border',
                    'selector' => '{{WRAPPER}} .experience-list .exp-item .icon',
                ]
            );
            $this->add_control(
                'icon_margin',
                [
                    'label' => esc_html__( 'Margin', 'raizencore' ),
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .experience-list .exp-item .icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

		<?php if($settings['raizen_design_style'] == "layout-1" ){ ?>

            <div class="experience-list style-one">
                <?php
                $delay = 0;
                foreach (  $settings['list'] as $item ) :
                    if ( !empty($item['icon_image']['url']) ) {
                        $icon = !empty($item['icon_image']['id']) ? wp_get_attachment_image_url( $item['icon_image']['id'], '') : $item['icon_image']['url'];
                    }
                    $ms_delay = 100 + ($delay * 100);
                ?>
                <div class="exp-item wow fadeInRight" data-wow-delay="<?php echo $ms_delay; ?>ms">
                    <div class="icon">
                        <img src="<?php echo esc_url($icon); ?>" alt="icon">
                    </div>
                    <div class="content">
                        <h6 class="year">
                            <?php echo $item['duration']; ?>
                        </h6>
                        <p class="company">
                            <?php echo $item['company_name']; ?>
                        </p>
                    </div>
                </div>
                <?php
                $delay++;
                endforeach; ?>
            </div>

		<?php }elseif($settings['raizen_design_style'] == "layout-2" ){ ?>

        <div class="skill-list style-two">
            <?php foreach (  $settings['list'] as $item ) :
                    if ( !empty($item['icon_image']['url']) ) {
                        $icon = !empty($item['icon_image']['id']) ? wp_get_attachment_image_url( $item['icon_image']['id'], '') : $item['icon_image']['url'];
                    }
                ?>
                <div class="skill-item">
                    <div class="icon">
                        <img src="<?php echo esc_url($icon); ?>" alt="icon">
                    </div>
                    <div class="name">
                        <?php echo $item['skill_name']; ?>
                    </div>
                    <div class="progress-lavel">
                        <?php echo $item['progress_lavel']; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <?php }elseif($settings['raizen_design_style'] == "layout-3" ){ ?>
            
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

$widgets_manager->register( new Raizen_Experience_List() );