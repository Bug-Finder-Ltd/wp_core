<?php
namespace ZupetCore\Widgets;

use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Zupet Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Zupet_Icon_Box extends \Elementor\Widget_Base {

	public function get_name() {
		return 'next-iconbox';
	}

	public function get_title() {
		return __( 'Icon Box', 'zupetcore' );
	}

	public function get_icon() {
		return 'zupet-icon';
	}

	public function get_categories() {
		return [ 'zupetcore' ];
	}

	public function get_script_depends() {
		return [ 'zupetcore' ];
	}

	protected function register_controls() {

        /**
         * Layout section
         */
        
        $this->start_controls_section(
            'zupet_layout',
            [
                'label' => esc_html__('Design Layout', 'zupetcore'),
            ]
        );
        $this->add_control(
            'zupet_design_style',
            [
                'label' => esc_html__('Select Layout', 'zupetcore'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'layout-1' => esc_html__('Layout 1', 'zupetcore'),
                    'layout-2' => esc_html__('Layout 2', 'zupetcore'),
                    'layout-3' => esc_html__('Layout 3', 'zupetcore'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_icon',
            [
                'label' => esc_html__( 'Icon', 'zupetcore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'icon',
            [
                'label' => esc_html__( 'Icon', 'zupetcore' ),
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
                'label' => esc_html__( 'Choose Image', 'zupetcore' ),
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
            'zupet_section_title',
            [
                'label' => esc_html__('Title & Content', 'zupetcore'),
            ]
        );
        
        $this->add_control(
            'zupet_title',
            [
                'label' => esc_html__('Title', 'zupetcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Title Here', 'zupetcore'),
                'placeholder' => esc_html__('Type title', 'zupetcore'),
                'label_block' => true,
            ]
        );
        
        $this->add_control(
            'zupet_title_color',
            [
                'label' => __( 'Title Color', 'zupetcore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .section-title h3' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'zupet_description',
            [
                'label' => esc_html__('Description', 'zupetcore'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Zupet section description here', 'zupetcore'),
                'placeholder' => esc_html__('Type section description here', 'zupetcore'),
            ]
        );

        $this->end_controls_section();

        /**
         * Style section
         */
		$this->start_controls_section(
			'general_section',
			[
				'label' => __( 'General', 'zupetcore' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_control(
            'text_align',
            [
                'label' => esc_html__( 'Alignment', 'zupetcore' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'zupetcore' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'zupetcore' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'zupetcore' ),
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
                'label'       => __( 'Animation Delay (e.g. 200ms)', 'zupetcore' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => __( '0ms', 'zupetcore' ),
            ]
        );
        $this->add_control(
            'show_line',
            [
                'label' => esc_html__( 'Show Line', 'zupetcore' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'zupetcore' ),
                'label_off' => esc_html__( 'Hide', 'zupetcore' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
		$this->end_controls_section();

        $this->start_controls_section(
            'icon_style',
            [
                'label' => __( 'Icon', 'zupetcore' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs(
            'style_tabs'
        );
            $this->start_controls_tab(
                'style_normal_tab',
                [
                    'label' => esc_html__( 'Normal', 'zupetcore' ),
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
                    'label' => esc_html__( 'Hover', 'zupetcore' ),
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

		<?php if($settings['zupet_design_style'] == "layout-1" ){ ?>

            <div class="box-icon style-one wow fadeInLeft <?php echo $settings['show_line']; ?>" data-wow-delay="<?php echo esc_attr( $settings['animation_delay'] ); ?>">
                <div class="icon">
                    <img src="<?php echo esc_url($icon); ?>" alt="icon">
                </div>
                <div class="content">
                    <h4 class="title"><?php echo $settings['zupet_title']; ?></h4>
                    <p class="description"><?php echo $settings['zupet_description']; ?></p>
                </div>
            </div>

		<?php }elseif($settings['zupet_design_style'] == "layout-2" ){ ?>

            <div class="box-icon style-two">
                <div class="icon">
                    <?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?>
                </div>
                <div class="content">
                    <p class="title"><?php echo $settings['zupet_title']; ?></p>
                    <?php if(!empty($settings['zupet_description'])) : ?>
                        <p class="description"><?php echo $settings['zupet_description']; ?></p>
                    <?php endif; ?>
                </div>
            </div>

        <?php }elseif($settings['zupet_design_style'] == "layout-3" ){ ?>
            
            <div class="box-icon style-three">
                <div class="icon">
                    <img src="<?php echo esc_url($icon); ?>" alt="icon">
                </div>
                <div class="content">
                    <h4 class="title"><?php echo $settings['zupet_title']; ?></h4>
                    <?php if(!empty($settings['zupet_description'])) : ?>
                        <p><?php echo $settings['zupet_description']; ?></p>
                    <?php endif; ?>
                </div>
            </div>

        <?php } ?>

        <?php 
	}
}

$widgets_manager->register( new Zupet_Icon_Box() );