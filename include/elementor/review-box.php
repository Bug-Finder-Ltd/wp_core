<?php
namespace ZupetCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Zupet Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Zupet_Review_Box extends Widget_Base {

	public function get_name() {
		return 'next-review';
	}

	public function get_title() {
		return __( 'Review Box', 'zupetcore' );
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
		
		$this->start_controls_section(
            'zupet_reviewer_section',
            [
                'label' => __( 'Reviewer Image', 'zupetcore' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

		$this->add_control(
			'reviewer_img',
			[
				'label' => esc_html__( 'Add Images', 'zupetcore' ),
				'type' => \Elementor\Controls_Manager::GALLERY,
				'show_label' => false,
				'default' => [],
			]
		);

        $this->end_controls_section();

		$this->start_controls_section(
			'text_section',
			[
				'label' => esc_html__( 'Text', 'zupetcore' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'avg_rating',
			[
				'label' => esc_html__( 'Avg. Rating', 'zupetcore' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '4.5', 'zupetcore' ),
				'placeholder' => esc_html__( 'Type your number here', 'zupetcore' ),
			]
		);
		$this->add_control(
			'title',
			[
				'label' => esc_html__( 'Title', 'zupetcore' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Default title', 'zupetcore' ),
				'placeholder' => esc_html__( 'Type your title here', 'zupetcore' ),
			]
		);
		$this->add_control(
			'number',
			[
				'label' => esc_html__( 'Number', 'zupetcore' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '+880 123 (456) 7890', 'zupetcore' ),
				'placeholder' => esc_html__( 'Phone', 'zupetcore' ),
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

			<div class="rivew-box">
				<div class="avater-image">
					<ul>
						<?php foreach ( $settings['reviewer_img'] as $image ) { ?>
							<li><a href="#"><img src="<?php echo esc_attr( $image['url'] ); ?>" alt="client"></a></li>
						<?php } ?>
						<li>
							<a href="#" class="client-icon">
								<i class="fa-solid fa-star"></i>
								<?php echo esc_html($settings['avg_rating']); ?>
							</a>
						</li>
					</ul>
				</div>
				<div class="contact">
					<div class="icon">
						<i class="fa-thin fa-phone-volume"></i>
					</div>
					<div class="text">
						<p class="title"><?php echo esc_html($settings['title']); ?></p>
						<p class="number"><?php echo esc_html($settings['number']); ?></p>
					</div>
				</div>
			</div>

		<?php elseif ( $settings['zupet_design_style']  == 'layout-2' ): ?>

			<!-- Logos Slider Start -->
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

$widgets_manager->register( new Zupet_Review_Box() );