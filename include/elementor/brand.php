<?php
namespace RaizenCore\Widgets;

use \Elementor\Repeater;

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Raizen Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Raizen_Brand extends \Elementor\Widget_Base {

	public function get_name() {
		return 'brand';
	}

	public function get_title() {
		return __( 'Brand', 'raizencore' );
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
         * Layout Section
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
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();
		
		/**
		 * Repeater
		 */
		$this->start_controls_section(
            'raizen_brand_section',
            [
                'label' => __( 'Brand Item', 'raizencore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'raizen_brand_image',
            [
                'type' => \Elementor\Controls_Manager::MEDIA,
                'label' => __( 'Image', 'raizencore' ),
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
		);
		
		$repeater->add_group_control(
            \Elementor\Group_Control_Image_Size::get_type(),
            [
                'name' => 'raizen_image_size',
                'default' => 'full',
                'exclude' => [
                    'custom'
                ]
            ]
        );

        $repeater->add_control(
            'brand_text',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'label' => __( 'Text', 'raizencore' ),
                'default' => __( 'Title', 'raizencore' ),
                'placeholder' => __( 'Type text here', 'raizencore' ),
            ]
        );

        $repeater->add_control(
            'raizen_brand_url',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'label' => __( 'URL', 'raizencore' ),
                'default' => __( '#', 'raizencore' ),
                'placeholder' => __( 'Type url here', 'raizencore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'raizen_brand_slides',
            [
                'show_label' => false,
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => esc_html__( 'Brand Item', 'raizencore' ),
                'default' => [
                    [
                        'raizen_brand_image' => [
                            'url' => \Elementor\Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'raizen_brand_image' => [
                            'url' => \Elementor\Utils::get_placeholder_image_src(),
                        ],
					],
					[
                        'raizen_brand_image' => [
                            'url' => \Elementor\Utils::get_placeholder_image_src(),
                        ],
					],
					[
                        'raizen_brand_image' => [
                            'url' => \Elementor\Utils::get_placeholder_image_src(),
                        ],
                    ],
                ]
            ]
        );

        $this->end_controls_section();


		/**
		 * Style section
		 */
		$this->start_controls_section(
			'section_style',
			[
				'label' => __( 'Style', 'raizencore' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'text_transform',
			[
				'label' => __( 'Text Transform', 'raizencore' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => __( 'None', 'raizencore' ),
					'uppercase' => __( 'UPPERCASE', 'raizencore' ),
					'lowercase' => __( 'lowercase', 'raizencore' ),
					'capitalize' => __( 'Capitalize', 'raizencore' ),
				],
				'selectors' => [
					'{{WRAPPER}} .title' => 'text-transform: {{VALUE}};',
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
		$settings = $this->get_settings_for_display();?>

		<?php if ( $settings['raizen_design_style']  == 'layout-1' ): ?>
			
		<div class="brand style-one">
			<div class="marquee-item-wrapper">
				<div class="marquee-item-box">
					<?php foreach ($settings['raizen_brand_slides'] as $item) : ?>
						<div class="brand-item">
							<h2><?php echo $item['brand_text']; ?></h2>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
			<div class="marquee-item-wrapper">
				<div class="marquee-item-box">
					<?php foreach ($settings['raizen_brand_slides'] as $item) : ?>
						<div class="brand-item">
							<h2><?php echo $item['brand_text']; ?></h2>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>

		<?php elseif ( $settings['raizen_design_style']  == 'layout-2' ): ?>

		<div class="brand style-two">
			<div class="marquee-item-wrapper">
				<div class="marquee-item-box">
					<?php foreach ($settings['raizen_brand_slides'] as $item) : 
						if ( !empty($item['raizen_brand_image']['url']) ) {
							$raizen_brand_image_url = !empty($item['raizen_brand_image']['id']) ? wp_get_attachment_image_url( $item['raizen_brand_image']['id'], $item['raizen_image_size_size']) : $item['raizen_brand_image']['url'];
							$raizen_brand_image_alt = get_post_meta($item["raizen_brand_image"]["id"], "_wp_attachment_image_alt", true);
						}
						?>
						<div class="brand-item">
							<img src="<?php echo esc_url($raizen_brand_image_url); ?>" alt="<?php echo esc_url($raizen_brand_image_alt); ?>">
						</div>
					<?php endforeach; ?>
				</div>
			</div>
			<div class="marquee-item-wrapper">
				<div class="marquee-item-box">
					<?php foreach ($settings['raizen_brand_slides'] as $item) : 
						if ( !empty($item['raizen_brand_image']['url']) ) {
							$raizen_brand_image_url = !empty($item['raizen_brand_image']['id']) ? wp_get_attachment_image_url( $item['raizen_brand_image']['id'], $item['raizen_image_size_size']) : $item['raizen_brand_image']['url'];
							$raizen_brand_image_alt = get_post_meta($item["raizen_brand_image"]["id"], "_wp_attachment_image_alt", true);
						}
						?>
						<div class="brand-item">
							<img src="<?php echo esc_url($raizen_brand_image_url); ?>" alt="<?php echo esc_url($raizen_brand_image_alt); ?>">
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
			
		<?php endif; ?>

		<?php
	}
}

$widgets_manager->register( new Raizen_Brand() );