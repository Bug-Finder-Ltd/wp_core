<?php
namespace ProtineCore\Widgets;

use Elementor\Controls_Manager;
use \Elementor\Repeater;

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Protine Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Protine_Brand extends \Elementor\Widget_Base {

	public function get_name() {
		return 'brand';
	}

	public function get_title() {
		return __( 'Brand', 'protinecore' );
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
         * Layout Section
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
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'layout-1' => esc_html__('Layout 1', 'protinecore'),
                    'layout-2' => esc_html__('Layout 2', 'protinecore'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();
		
		/**
		 * Repeater
		 */
		$this->start_controls_section(
            'protine_brand_section',
            [
                'label' => __( 'Brand Item', 'protinecore' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'protine_brand_image',
            [
                'type' => Controls_Manager::MEDIA,
                'label' => __( 'Image', 'protinecore' ),
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
                'name' => 'protine_image_size',
                'default' => 'full',
                'exclude' => [
                    'custom'
                ]
            ]
        );

        $repeater->add_control(
            'protine_brand_url',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'label' => __( 'URL', 'protinecore' ),
                'default' => __( '#', 'protinecore' ),
                'placeholder' => __( 'Type url here', 'protinecore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'protine_brand_slides',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => esc_html__( 'Brand Item', 'protinecore' ),
                'default' => [
                    [
                        'protine_brand_image' => [
                            'url' => \Elementor\Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'protine_brand_image' => [
                            'url' => \Elementor\Utils::get_placeholder_image_src(),
                        ],
					],
					[
                        'protine_brand_image' => [
                            'url' => \Elementor\Utils::get_placeholder_image_src(),
                        ],
					],
					[
                        'protine_brand_image' => [
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
				'label' => __( 'Style', 'protinecore' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'text_transform',
			[
				'label' => __( 'Text Transform', 'protinecore' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => __( 'None', 'protinecore' ),
					'uppercase' => __( 'UPPERCASE', 'protinecore' ),
					'lowercase' => __( 'lowercase', 'protinecore' ),
					'capitalize' => __( 'Capitalize', 'protinecore' ),
				],
				'selectors' => [
					'{{WRAPPER}} .title' => 'text-transform: {{VALUE}};',
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
		$settings = $this->get_settings_for_display();?>

		<?php if ( $settings['protine_design_style']  == 'layout-1' ): ?>
			
		<div class="brand style-one">
			<div class="marquee-item-wrapper">
				<div class="marquee-item-box">
					<?php foreach ($settings['protine_brand_slides'] as $item) : 
						if ( !empty($item['protine_brand_image']['url']) ) {
							$protine_brand_image_url = !empty($item['protine_brand_image']['id']) ? wp_get_attachment_image_url( $item['protine_brand_image']['id'], $item['protine_image_size_size']) : $item['protine_brand_image']['url'];
							$protine_brand_image_alt = get_post_meta($item["protine_brand_image"]["id"], "_wp_attachment_image_alt", true);
						}
						?>
						<div class="brand-item">
							<img src="<?php echo esc_url($protine_brand_image_url); ?>" alt="<?php echo esc_url($protine_brand_image_alt); ?>">
						</div>
					<?php endforeach; ?>
				</div>
			</div>
			<div class="marquee-item-wrapper">
				<div class="marquee-item-box">
					<?php foreach ($settings['protine_brand_slides'] as $item) : 
						if ( !empty($item['protine_brand_image']['url']) ) {
							$protine_brand_image_url = !empty($item['protine_brand_image']['id']) ? wp_get_attachment_image_url( $item['protine_brand_image']['id'], $item['protine_image_size_size']) : $item['protine_brand_image']['url'];
							$protine_brand_image_alt = get_post_meta($item["protine_brand_image"]["id"], "_wp_attachment_image_alt", true);
						}
						?>
						<div class="brand-item">
							<img src="<?php echo esc_url($protine_brand_image_url); ?>" alt="<?php echo esc_url($protine_brand_image_alt); ?>">
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>

		<?php elseif ( $settings['protine_design_style']  == 'layout-2' ): ?>

			<section class="logo-slider v1 protine-section-wrapper">
				<div class="container">
					<div class="slider">
						<div class="swiper-wrapper">
							<?php foreach ($settings['protine_brand_slides'] as $item) : 
								if ( !empty($item['protine_brand_image']['url']) ) {
									$protine_brand_image_url = !empty($item['protine_brand_image']['id']) ? wp_get_attachment_image_url( $item['protine_brand_image']['id'], $item['protine_image_size_size']) : $item['protine_brand_image']['url'];
									$protine_brand_image_alt = get_post_meta($item["protine_brand_image"]["id"], "_wp_attachment_image_alt", true);
								}
								?>
								<div class="swiper-slide">
									<?php if (!empty($item['protine_brand_url'])) : ?>
										<a href="<?php echo esc_url($item['protine_brand_url']); ?>">
											<img src="<?php echo esc_url($protine_brand_image_url); ?>" alt="<?php echo esc_url($protine_brand_image_alt); ?>">
										</a>
									<?php else : ?>
										<img src="<?php echo esc_url($protine_brand_image_url); ?>" alt="<?php echo esc_url($protine_brand_image_alt); ?>">
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

$widgets_manager->register( new Protine_Brand() );