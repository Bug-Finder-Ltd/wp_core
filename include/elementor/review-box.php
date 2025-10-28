<?php
namespace NextdestinaCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Nextdestina Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Nextdestina_Review_Box extends Widget_Base {

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
		return __( 'Review Box', 'nextdestinacore' );
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
		return 'nextdestina-icon';
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
		return [ 'nextdestinacore' ];
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
		return [ 'nextdestinacore' ];
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
            'nextdestina_layout',
            [
                'label' => esc_html__('Design Layout', 'nextdestinacore'),
            ]
        );
        $this->add_control(
            'nextdestina_design_style',
            [
                'label' => esc_html__('Select Layout', 'nextdestinacore'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'layout-1' => esc_html__('Layout 1', 'nextdestinacore'),
                    'layout-2' => esc_html__('Layout 2', 'nextdestinacore'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();
		
		$this->start_controls_section(
            'nextdestina_reviewer_section',
            [
                'label' => __( 'Reviewer Image', 'nextdestinacore' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

		$this->add_control(
			'reviewer_img',
			[
				'label' => esc_html__( 'Add Images', 'nextdestinacore' ),
				'type' => \Elementor\Controls_Manager::GALLERY,
				'show_label' => false,
				'default' => [],
			]
		);

        $this->end_controls_section();

		$this->start_controls_section(
			'text_section',
			[
				'label' => esc_html__( 'Text', 'nextdestinacore' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'title',
			[
				'label' => esc_html__( 'Title', 'nextdestinacore' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Default title', 'nextdestinacore' ),
				'placeholder' => esc_html__( 'Type your title here', 'nextdestinacore' ),
			]
		);
		$this->add_control(
			'number_suffix',
			[
				'label' => esc_html__( 'Suffix', 'nextdestinacore' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'K+', 'nextdestinacore' ),
				'placeholder' => esc_html__( '+', 'nextdestinacore' ),
			]
		);

		$this->end_controls_section();

		/**
		 * Style section
		 */
		$this->start_controls_section(
			'section_style',
			[
				'label' => __( 'Style', 'nextdestinacore' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'text_transform',
			[
				'label' => __( 'Text Transform', 'nextdestinacore' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => __( 'None', 'nextdestinacore' ),
					'uppercase' => __( 'UPPERCASE', 'nextdestinacore' ),
					'lowercase' => __( 'lowercase', 'nextdestinacore' ),
					'capitalize' => __( 'Capitalize', 'nextdestinacore' ),
				],
				'selectors' => [
					'{{WRAPPER}} .title' => 'text-transform: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render the widget ounextdestinaut on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();?>

		<?php if ( $settings['nextdestina_design_style']  == 'layout-1' ): ?>

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

		<?php elseif ( $settings['nextdestina_design_style']  == 'layout-2' ): ?>

			<!-- Logos Slider Start -->
			<section class="logo-slider v1 nextdestina-section-wrapper">
				<div class="container">
					<div class="slider">
						<div class="swiper-wrapper">
							<?php foreach ($settings['nextdestina_brand_slides'] as $item) : 
								if ( !empty($item['nextdestina_brand_image']['url']) ) {
									$nextdestina_brand_image_url = !empty($item['nextdestina_brand_image']['id']) ? wp_get_attachment_image_url( $item['nextdestina_brand_image']['id'], $item['nextdestina_image_size_size']) : $item['nextdestina_brand_image']['url'];
									$nextdestina_brand_image_alt = get_post_meta($item["nextdestina_brand_image"]["id"], "_wp_attachment_image_alt", true);
								}
								?>
								<div class="swiper-slide">
									<?php if (!empty($item['nextdestina_brand_url'])) : ?>
										<a href="<?php echo esc_url($item['nextdestina_brand_url']); ?>">
											<img src="<?php echo esc_url($nextdestina_brand_image_url); ?>" alt="<?php echo esc_url($nextdestina_brand_image_alt); ?>">
										</a>
									<?php else : ?>
										<img src="<?php echo esc_url($nextdestina_brand_image_url); ?>" alt="<?php echo esc_url($nextdestina_brand_image_alt); ?>">
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

$widgets_manager->register( new Nextdestina_Review_Box() );