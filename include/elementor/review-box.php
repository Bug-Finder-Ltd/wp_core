<?php
namespace ProtineCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Protine Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Protine_Review_Box extends Widget_Base {

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
		return 'next-review';
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
		return __( 'Review Box', 'protinecore' );
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
		return 'protine-icon';
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
		return [ 'protinecore' ];
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
		return [ 'protinecore' ];
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
		
		$this->start_controls_section(
            'protine_reviewer_section',
            [
                'label' => __( 'Reviewer Image', 'protinecore' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

		$this->add_control(
			'reviewer_img',
			[
				'label' => esc_html__( 'Add Images', 'protinecore' ),
				'type' => \Elementor\Controls_Manager::GALLERY,
				'show_label' => false,
				'default' => [],
			]
		);

        $this->end_controls_section();

		$this->start_controls_section(
			'text_section',
			[
				'label' => esc_html__( 'Text', 'protinecore' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'title',
			[
				'label' => esc_html__( 'Title', 'protinecore' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Default title', 'protinecore' ),
				'placeholder' => esc_html__( 'Type your title here', 'protinecore' ),
			]
		);
		$this->add_control(
			'number_suffix',
			[
				'label' => esc_html__( 'Suffix', 'protinecore' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'K+', 'protinecore' ),
				'placeholder' => esc_html__( '+', 'protinecore' ),
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

			<div class="rivew-box">
				<div class="avater-image">
					<ul>
						<?php foreach ( $settings['reviewer_img'] as $image ) { ?>
							<li><a href="#"><img src="<?php echo esc_attr( $image['url'] ); ?>" alt="client"></a></li>
						<?php } ?>
						<li><a href="#" class="client-icon">+</a></li>
					</ul>
				</div>
				<div class="counter">
					<div class="odometer-box">
						<h5 class="odometer" data-count="400"><?php echo esc_html('00'); ?></h5>
						<div class="odometer-text"><?php echo esc_html($settings['number_suffix']); ?></div>
					</div>
					<p><?php echo esc_html($settings['title']); ?></p>
				</div>
			</div>

		<?php elseif ( $settings['protine_design_style']  == 'layout-2' ): ?>

			<!-- Logos Slider Start -->
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

$widgets_manager->register( new Protine_Review_Box() );