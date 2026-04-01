<?php
namespace ProvixCore\Widgets;

use Elementor\Controls_Manager;
use \Elementor\Repeater;

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Provix Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Provix_Brand extends \Elementor\Widget_Base {

	public function get_name() {
		return 'brand';
	}

	public function get_title() {
		return __( 'Brand', 'agenvix-core' );
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
         * Layout Section
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
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'layout-1' => esc_html__('Layout 1', 'agenvix-core'),
                    'layout-2' => esc_html__('Layout 2', 'agenvix-core'),
                    'layout-3' => esc_html__('Layout 3', 'agenvix-core'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();
		
		/**
		 * Repeater
		 */
		$this->start_controls_section(
            'provix_brand_section',
            [
                'label' => __( 'Brand Item', 'agenvix-core' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'provix_brand_image',
            [
                'type' => Controls_Manager::MEDIA,
                'label' => __( 'Image', 'agenvix-core' ),
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
                'name' => 'provix_image_size',
                'default' => 'full',
                'exclude' => [
                    'custom'
                ]
            ]
        );

        $repeater->add_control(
            'provix_brand_url',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'label' => __( 'URL', 'agenvix-core' ),
                'default' => __( '#', 'agenvix-core' ),
                'placeholder' => __( 'Type url here', 'agenvix-core' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'provix_brand_slides',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => esc_html__( 'Brand Item', 'agenvix-core' ),
                'default' => [
                    [
                        'provix_brand_image' => [
                            'url' => \Elementor\Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'provix_brand_image' => [
                            'url' => \Elementor\Utils::get_placeholder_image_src(),
                        ],
					],
					[
                        'provix_brand_image' => [
                            'url' => \Elementor\Utils::get_placeholder_image_src(),
                        ],
					],
					[
                        'provix_brand_image' => [
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
				'label' => __( 'Style', 'agenvix-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'text_transform',
			[
				'label' => __( 'Text Transform', 'agenvix-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => __( 'None', 'agenvix-core' ),
					'uppercase' => __( 'UPPERCASE', 'agenvix-core' ),
					'lowercase' => __( 'lowercase', 'agenvix-core' ),
					'capitalize' => __( 'Capitalize', 'agenvix-core' ),
				],
				'selectors' => [
					'{{WRAPPER}} .title' => 'text-transform: {{VALUE}};',
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
		$settings = $this->get_settings_for_display();?>

		<?php if ( $settings['provix_design_style']  == 'layout-1' ): ?>
			
		<div class="brand style-one">
			<div class="marquee-item-wrapper">
				<div class="marquee-item-box">
					<?php foreach ($settings['provix_brand_slides'] as $item) : 
						if ( !empty($item['provix_brand_image']['url']) ) {
							$provix_brand_image_url = !empty($item['provix_brand_image']['id']) ? wp_get_attachment_image_url( $item['provix_brand_image']['id'], $item['provix_image_size_size']) : $item['provix_brand_image']['url'];
							$provix_brand_image_alt = get_post_meta($item["provix_brand_image"]["id"], "_wp_attachment_image_alt", true);
						}
						?>
						<div class="brand-item">
							<img src="<?php echo esc_url($provix_brand_image_url); ?>" alt="<?php echo esc_url($provix_brand_image_alt); ?>">
						</div>
					<?php endforeach; ?>
				</div>
			</div>
			<div class="marquee-item-wrapper">
				<div class="marquee-item-box">
					<?php foreach ($settings['provix_brand_slides'] as $item) : 
						if ( !empty($item['provix_brand_image']['url']) ) {
							$provix_brand_image_url = !empty($item['provix_brand_image']['id']) ? wp_get_attachment_image_url( $item['provix_brand_image']['id'], $item['provix_image_size_size']) : $item['provix_brand_image']['url'];
							$provix_brand_image_alt = get_post_meta($item["provix_brand_image"]["id"], "_wp_attachment_image_alt", true);
						}
						?>
						<div class="brand-item">
							<img src="<?php echo esc_url($provix_brand_image_url); ?>" alt="<?php echo esc_url($provix_brand_image_alt); ?>">
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>

		<?php elseif ( $settings['provix_design_style']  == 'layout-2' ) :
			$shape_url = PROTINE_ADDONS_URL . 'assets/img/brand-shape.png';
			?>

		<div class="brand style-two">
			<div class="marquee-item-wrapper">
				<div class="marquee-item-box">
					<?php foreach ($settings['provix_brand_slides'] as $item) : 
						if ( !empty($item['provix_brand_image']['url']) ) {
							$provix_brand_image_url = !empty($item['provix_brand_image']['id']) ? wp_get_attachment_image_url( $item['provix_brand_image']['id'], $item['provix_image_size_size']) : $item['provix_brand_image']['url'];
							$provix_brand_image_alt = get_post_meta($item["provix_brand_image"]["id"], "_wp_attachment_image_alt", true);
						}
						?>
						<div class="brand-item">
							<img src="<?php echo esc_url($provix_brand_image_url); ?>" alt="<?php echo esc_url($provix_brand_image_alt); ?>">
						</div>
						<div class="seperator">
							<img src="<?php echo esc_url($shape_url); ?>" alt="">
						</div>
					<?php endforeach; ?>
				</div>
			</div>
			<div class="marquee-item-wrapper">
				<div class="marquee-item-box">
					<?php foreach ($settings['provix_brand_slides'] as $item) : 
						if ( !empty($item['provix_brand_image']['url']) ) {
							$provix_brand_image_url = !empty($item['provix_brand_image']['id']) ? wp_get_attachment_image_url( $item['provix_brand_image']['id'], $item['provix_image_size_size']) : $item['provix_brand_image']['url'];
							$provix_brand_image_alt = get_post_meta($item["provix_brand_image"]["id"], "_wp_attachment_image_alt", true);
						}
						?>
						<div class="brand-item">
							<img src="<?php echo esc_url($provix_brand_image_url); ?>" alt="<?php echo esc_url($provix_brand_image_alt); ?>">
						</div>
						<div class="seperator">
							<img src="<?php echo esc_url($shape_url); ?>" alt="">
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>

		<?php elseif ( 'layout-3' === $settings['provix_design_style'] ) : ?>

			<div class="brand style-three">
				<div class="marquee-item-wrapper">
					<div class="marquee-item-box">
						<?php foreach ($settings['provix_brand_slides'] as $item) : 
							if ( !empty($item['provix_brand_image']['url']) ) {
								$provix_brand_image_url = !empty($item['provix_brand_image']['id']) ? wp_get_attachment_image_url( $item['provix_brand_image']['id'], $item['provix_image_size_size']) : $item['provix_brand_image']['url'];
								$provix_brand_image_alt = get_post_meta($item["provix_brand_image"]["id"], "_wp_attachment_image_alt", true);
							}
							?>
							<div class="brand-item">
								<img src="<?php echo esc_url($provix_brand_image_url); ?>" alt="<?php echo esc_url($provix_brand_image_alt); ?>">
							</div>
							<div class="seperator">
								
							</div>
						<?php endforeach; ?>
					</div>
				</div>
				<div class="marquee-item-wrapper">
					<div class="marquee-item-box">
						<?php foreach ($settings['provix_brand_slides'] as $item) : 
							if ( !empty($item['provix_brand_image']['url']) ) {
								$provix_brand_image_url = !empty($item['provix_brand_image']['id']) ? wp_get_attachment_image_url( $item['provix_brand_image']['id'], $item['provix_image_size_size']) : $item['provix_brand_image']['url'];
								$provix_brand_image_alt = get_post_meta($item["provix_brand_image"]["id"], "_wp_attachment_image_alt", true);
							}
							?>
							<div class="brand-item">
								<img src="<?php echo esc_url($provix_brand_image_url); ?>" alt="<?php echo esc_url($provix_brand_image_alt); ?>">
							</div>
							<div class="seperator">
								
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			</div>

		<?php endif; ?>

		<?php
	}
}

$widgets_manager->register( new Provix_Brand() );