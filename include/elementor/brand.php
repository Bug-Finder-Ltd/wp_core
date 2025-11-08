<?php
namespace ZupetCore\Widgets;

use Elementor\Controls_Manager;
use \Elementor\Repeater;

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Zupet Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Zupet_Brand extends \Elementor\Widget_Base {

	public function get_name() {
		return 'brand';
	}

	public function get_title() {
		return __( 'Brand', 'zupetcore' );
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
         * Layout Section
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
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();
		
		/**
		 * Repeater
		 */
		$this->start_controls_section(
            'zupet_brand_section',
            [
                'label' => __( 'Brand Item', 'zupetcore' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'zupet_brand_image',
            [
                'type' => Controls_Manager::MEDIA,
                'label' => __( 'Image', 'zupetcore' ),
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
                'name' => 'zupet_image_size',
                'default' => 'full',
                'exclude' => [
                    'custom'
                ]
            ]
        );

        $repeater->add_control(
            'zupet_brand_url',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'label' => __( 'URL', 'zupetcore' ),
                'default' => __( '#', 'zupetcore' ),
                'placeholder' => __( 'Type url here', 'zupetcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'zupet_brand_slides',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => esc_html__( 'Brand Item', 'zupetcore' ),
                'default' => [
                    [
                        'zupet_brand_image' => [
                            'url' => \Elementor\Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'zupet_brand_image' => [
                            'url' => \Elementor\Utils::get_placeholder_image_src(),
                        ],
					],
					[
                        'zupet_brand_image' => [
                            'url' => \Elementor\Utils::get_placeholder_image_src(),
                        ],
					],
					[
                        'zupet_brand_image' => [
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
				'label' => __( 'Style', 'zupetcore' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'text_transform',
			[
				'label' => __( 'Text Transform', 'zupetcore' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => __( 'None', 'zupetcore' ),
					'uppercase' => __( 'UPPERCASE', 'zupetcore' ),
					'lowercase' => __( 'lowercase', 'zupetcore' ),
					'capitalize' => __( 'Capitalize', 'zupetcore' ),
				],
				'selectors' => [
					'{{WRAPPER}} .title' => 'text-transform: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render the widget ouzupetut on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();?>

		<?php if ( $settings['zupet_design_style']  == 'layout-1' ): ?>
			
		<div class="brand style-one">
			<div class="marquee-item-wrapper">
				<div class="marquee-item-box">
					<?php foreach ($settings['zupet_brand_slides'] as $item) : 
						if ( !empty($item['zupet_brand_image']['url']) ) {
							$zupet_brand_image_url = !empty($item['zupet_brand_image']['id']) ? wp_get_attachment_image_url( $item['zupet_brand_image']['id'], $item['zupet_image_size_size']) : $item['zupet_brand_image']['url'];
							$zupet_brand_image_alt = get_post_meta($item["zupet_brand_image"]["id"], "_wp_attachment_image_alt", true);
						}
						?>
						<div class="brand-item">
							<img src="<?php echo esc_url($zupet_brand_image_url); ?>" alt="<?php echo esc_url($zupet_brand_image_alt); ?>">
						</div>
					<?php endforeach; ?>
				</div>
			</div>
			<div class="marquee-item-wrapper">
				<div class="marquee-item-box">
					<?php foreach ($settings['zupet_brand_slides'] as $item) : 
						if ( !empty($item['zupet_brand_image']['url']) ) {
							$zupet_brand_image_url = !empty($item['zupet_brand_image']['id']) ? wp_get_attachment_image_url( $item['zupet_brand_image']['id'], $item['zupet_image_size_size']) : $item['zupet_brand_image']['url'];
							$zupet_brand_image_alt = get_post_meta($item["zupet_brand_image"]["id"], "_wp_attachment_image_alt", true);
						}
						?>
						<div class="brand-item">
							<img src="<?php echo esc_url($zupet_brand_image_url); ?>" alt="<?php echo esc_url($zupet_brand_image_alt); ?>">
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>

		<?php elseif ( $settings['zupet_design_style']  == 'layout-2' ): ?>

			<section class="logo-slider v1 zupet-section-wrapper">
				<div class="container">
					<div class="slider">
						<div class="swiper-wrapper">
							<?php foreach ($settings['zupet_brand_slides'] as $item) : 
								if ( !empty($item['zupet_brand_image']['url']) ) {
									$zupet_brand_image_url = !empty($item['zupet_brand_image']['id']) ? wp_get_attachment_image_url( $item['zupet_brand_image']['id'], $item['zupet_image_size_size']) : $item['zupet_brand_image']['url'];
									$zupet_brand_image_alt = get_post_meta($item["zupet_brand_image"]["id"], "_wp_attachment_image_alt", true);
								}
								?>
								<div class="swiper-slide">
									<?php if (!empty($item['zupet_brand_url'])) : ?>
										<a href="<?php echo esc_url($item['zupet_brand_url']); ?>">
											<img src="<?php echo esc_url($zupet_brand_image_url); ?>" alt="<?php echo esc_url($zupet_brand_image_alt); ?>">
										</a>
									<?php else : ?>
										<img src="<?php echo esc_url($zupet_brand_image_url); ?>" alt="<?php echo esc_url($zupet_brand_image_alt); ?>">
									<?php endif; ?>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
			</section>
			
		<?php endif; ?>

		<?php
	}
}

$widgets_manager->register( new Zupet_Brand() );