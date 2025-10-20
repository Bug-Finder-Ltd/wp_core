<?php
namespace BwallCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Bwall Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Bwall_Brand extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'brand';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Brand', 'bwallcore' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'bwall-icon';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'bwallcore' ];
	}

	/**
	 * Retrieve the list of scripts the widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
	public function get_script_depends() {
		return [ 'bwallcore' ];
	}

	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function register_controls() {
		/**
         * Layout Section
         */
        $this->start_controls_section(
            'bwall_layout',
            [
                'label' => esc_html__('Design Layout', 'bwallcore'),
            ]
        );
        $this->add_control(
            'bwall_design_style',
            [
                'label' => esc_html__('Select Layout', 'bwallcore'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'layout-1' => esc_html__('Layout 1', 'bwallcore'),
                    'layout-2' => esc_html__('Layout 2', 'bwallcore'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();
		
		/**
		 * Repeater
		 */
		$this->start_controls_section(
            'bwall_brand_section',
            [
                'label' => __( 'Brand Item', 'bwallcore' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'bwall_brand_image',
            [
                'type' => Controls_Manager::MEDIA,
                'label' => __( 'Image', 'bwallcore' ),
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
		);
		
		$repeater->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'bwall_image_size',
                'default' => 'full',
                'exclude' => [
                    'custom'
                ]
            ]
        );

        $repeater->add_control(
            'bwall_brand_url',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'label' => __( 'URL', 'bwallcore' ),
                'default' => __( '#', 'bwallcore' ),
                'placeholder' => __( 'Type url here', 'bwallcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'bwall_brand_slides',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => esc_html__( 'Brand Item', 'bwallcore' ),
                'default' => [
                    [
                        'bwall_brand_image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'bwall_brand_image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
					],
					[
                        'bwall_brand_image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
					],
					[
                        'bwall_brand_image' => [
                            'url' => Utils::get_placeholder_image_src(),
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
				'label' => __( 'Style', 'bwallcore' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'text_transform',
			[
				'label' => __( 'Text Transform', 'bwallcore' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => __( 'None', 'bwallcore' ),
					'uppercase' => __( 'UPPERCASE', 'bwallcore' ),
					'lowercase' => __( 'lowercase', 'bwallcore' ),
					'capitalize' => __( 'Capitalize', 'bwallcore' ),
				],
				'selectors' => [
					'{{WRAPPER}} .title' => 'text-transform: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render the widget oubwallut on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();?>

		<?php if ( $settings['bwall_design_style']  == 'layout-2' ): ?>
			<!-- Logos Slider Start -->
			<section class="logo-slider v1 pt-xl-spach bwall-section-wrapper">
				<div class="container">
					<div class="slider">
						<div class="swiper-wrapper">
							<?php foreach ($settings['bwall_brand_slides'] as $item) : 
								if ( !empty($item['bwall_brand_image']['url']) ) {
									$bwall_brand_image_url = !empty($item['bwall_brand_image']['id']) ? wp_get_attachment_image_url( $item['bwall_brand_image']['id'], $item['bwall_image_size_size']) : $item['bwall_brand_image']['url'];
									$bwall_brand_image_alt = get_post_meta($item["bwall_brand_image"]["id"], "_wp_attachment_image_alt", true);
								}
								?>
								<div class="swiper-slide">
									<?php if (!empty($item['bwall_brand_url'])) : ?>
										<a href="<?php echo esc_url($item['bwall_brand_url']); ?>">
											<img src="<?php echo esc_url($bwall_brand_image_url); ?>" alt="<?php echo esc_url($bwall_brand_image_alt); ?>">
										</a>
									<?php else : ?>
										<img src="<?php echo esc_url($bwall_brand_image_url); ?>" alt="<?php echo esc_url($bwall_brand_image_alt); ?>">
									<?php endif; ?>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
			</section>
			<!-- Logos Slider End -->

		<?php else: ?>

			<!-- Logos Slider Start -->
			<section class="logo-slider v1 bwall-section-wrapper">
				<div class="container">
					<div class="slider">
						<div class="swiper-wrapper">
							<?php foreach ($settings['bwall_brand_slides'] as $item) : 
								if ( !empty($item['bwall_brand_image']['url']) ) {
									$bwall_brand_image_url = !empty($item['bwall_brand_image']['id']) ? wp_get_attachment_image_url( $item['bwall_brand_image']['id'], $item['bwall_image_size_size']) : $item['bwall_brand_image']['url'];
									$bwall_brand_image_alt = get_post_meta($item["bwall_brand_image"]["id"], "_wp_attachment_image_alt", true);
								}
								?>
								<div class="swiper-slide">
									<?php if (!empty($item['bwall_brand_url'])) : ?>
										<a href="<?php echo esc_url($item['bwall_brand_url']); ?>">
											<img src="<?php echo esc_url($bwall_brand_image_url); ?>" alt="<?php echo esc_url($bwall_brand_image_alt); ?>">
										</a>
									<?php else : ?>
										<img src="<?php echo esc_url($bwall_brand_image_url); ?>" alt="<?php echo esc_url($bwall_brand_image_alt); ?>">
									<?php endif; ?>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
			</section>
			<!-- Logos Slider End -->
		<?php endif; ?>

		<?php
	}
}

$widgets_manager->register( new Bwall_Brand() );