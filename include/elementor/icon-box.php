<?php
namespace RaizenCore\Widgets;

use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Raizen Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Raizen_Icon_Box extends \Elementor\Widget_Base {

	public function get_name() {
		return 'next-iconbox';
	}

	public function get_title() {
		return __( 'Icon Box', 'raizencore' );
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
                'type' => Controls_Manager::SELECT,
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
            'section_icon',
            [
                'label' => esc_html__( 'Icon', 'raizencore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'icon',
            [
                'label' => esc_html__( 'Icon', 'raizencore' ),
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
                'label' => esc_html__( 'Choose Image', 'raizencore' ),
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
            'raizen_section_title',
            [
                'label' => esc_html__('Title & Content', 'raizencore'),
            ]
        );
        
        $this->add_control(
            'raizen_title',
            [
                'label' => esc_html__('Title', 'raizencore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Title Here', 'raizencore'),
                'placeholder' => esc_html__('Type title', 'raizencore'),
                'label_block' => true,
            ]
        );
        
        $this->add_control(
            'raizen_title_color',
            [
                'label' => __( 'Title Color', 'raizencore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .section-title h3' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'raizen_description',
            [
                'label' => esc_html__('Description', 'raizencore'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Raizen section description here', 'raizencore'),
                'placeholder' => esc_html__('Type section description here', 'raizencore'),
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
				'tab' => Controls_Manager::TAB_STYLE,
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
        $this->add_control(
            'animation_delay',
            [
                'label'       => __( 'Animation Delay (e.g. 200ms)', 'raizencore' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => __( '0ms', 'raizencore' ),
            ]
        );
        $this->add_control(
            'show_line',
            [
                'label' => esc_html__( 'Show Line', 'raizencore' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'raizencore' ),
                'label_off' => esc_html__( 'Hide', 'raizencore' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
		$this->end_controls_section();

        $this->start_controls_section(
            'icon_style',
            [
                'label' => __( 'Icon', 'raizencore' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs(
            'style_tabs'
        );
            $this->start_controls_tab(
                'style_normal_tab',
                [
                    'label' => esc_html__( 'Normal', 'raizencore' ),
                ]
            );
                $this->add_group_control(
                    \Elementor\Group_Control_Background::get_type(),
                    [
                        'name' => 'icon_background',
                        'types' => [ 'classic', 'gradient' ],
                        'selector' => '{{WRAPPER}} .box-icon .icon',
                    ]
                );
            $this->end_controls_tab();

            $this->start_controls_tab(
                'style_hover_tab',
                [
                    'label' => esc_html__( 'Hover', 'raizencore' ),
                ]
            );
                $this->add_group_control(
                    \Elementor\Group_Control_Background::get_type(),
                    [
                        'name' => 'icon_hover_background',
                        'types' => [ 'classic', 'gradient' ],
                        'selector' => '{{WRAPPER}} .box-icon:hover .icon::after',
                    ]
                );
            $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

            if ( !empty($settings['icon_image']['url']) ) {
                $icon = !empty($settings['icon_image']['id']) ? wp_get_attachment_image_url( $settings['icon_image']['id'], '') : $settings['icon_image']['url'];
            }
        ?>

		<?php if($settings['raizen_design_style'] == "layout-1" ){ ?>

            <div class="box-icon style-one wow fadeInLeft <?php echo $settings['show_line']; ?>" data-wow-delay="<?php echo esc_attr( $settings['animation_delay'] ); ?>">
                <div class="icon">
                    <img src="<?php echo esc_url($icon); ?>" alt="icon">
                </div>
                <div class="content">
                    <h4 class="title"><?php echo $settings['raizen_title']; ?></h4>
                    <p class="description"><?php echo $settings['raizen_description']; ?></p>
                </div>
            </div>

		<?php }elseif($settings['raizen_design_style'] == "layout-2" ){ ?>

            <div class="box-icon style-two">
                <div class="icon">
                    <?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?>
                </div>
                <div class="content">
                    <p class="title"><?php echo $settings['raizen_title']; ?></p>
                    <?php if(!empty($settings['raizen_description'])) : ?>
                        <p class="description"><?php echo $settings['raizen_description']; ?></p>
                    <?php endif; ?>
                </div>
            </div>

        <?php }elseif($settings['raizen_design_style'] == "layout-3" ){ ?>
            
            <div class="box-icon style-three">
                <div class="icon">
                    <img src="<?php echo esc_url($icon); ?>" alt="icon">
                </div>
                <div class="content">
                    <h4 class="title"><?php echo $settings['raizen_title']; ?></h4>
                    <?php if(!empty($settings['raizen_description'])) : ?>
                        <p><?php echo $settings['raizen_description']; ?></p>
                    <?php endif; ?>
                </div>
            </div>

        <?php } ?>

        <?php 
	}
}

$widgets_manager->register( new Raizen_Icon_Box() );