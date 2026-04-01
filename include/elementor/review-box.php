<?php

namespace ProvixCore\Widgets;

use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;

if (! defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Provix Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Provix_Review_Box extends \Elementor\Widget_Base
{

	public function get_name()
	{
		return 'next-review';
	}

	public function get_title()
	{
		return __('Review Box', 'agenvix-core');
	}

	public function get_icon()
	{
		return 'provix-icon';
	}

	public function get_categories()
	{
		return ['agenvix-core'];
	}

	public function get_script_depends()
	{
		return ['agenvix-core'];
	}

	protected function register_controls()
	{
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

		$this->start_controls_section(
			'provix_reviewer_section',
			[
				'label' => __('Reviewer Image', 'agenvix-core'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'reviewer_img',
			[
				'label' => esc_html__('Add Images', 'agenvix-core'),
				'type' => \Elementor\Controls_Manager::GALLERY,
				'show_label' => false,
				'default' => [],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'text_section',
			[
				'label' => esc_html__('Text', 'agenvix-core'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		// $this->add_control(
		// 	'avg_rating',
		// 	[
		// 		'label' => esc_html__( 'Avg. Rating', 'agenvix-core' ),
		// 		'type' => \Elementor\Controls_Manager::TEXT,
		// 		'default' => esc_html__( '4.5', 'agenvix-core' ),
		// 		'placeholder' => esc_html__( 'Type your number here', 'agenvix-core' ),
		// 	]
		// );

		$this->add_control(
			'avg_rating',
			[
				'label' => esc_html__('Average Rating', 'agenvix-core'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 4.5,
				'min' => 0,
				'max' => 5,
				'step' => 0.1,
			]
		);

		$this->add_control(
			'title',
			[
				'label' => esc_html__('Title', 'agenvix-core'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Default title', 'agenvix-core'),
				'placeholder' => esc_html__('Type your title here', 'agenvix-core'),
			]
		);
		$this->add_control(
			'subtitle',
			[
				'label' => esc_html__('Subtitle', 'agenvix-core'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Default subtitle', 'agenvix-core'),
				'placeholder' => esc_html__('Type your subtitle here', 'agenvix-core'),
			]
		);
		$this->add_control(
			'number',
			[
				'label' => esc_html__('Number', 'agenvix-core'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('+880 123 (456) 7890', 'agenvix-core'),
				'placeholder' => esc_html__('Phone', 'agenvix-core'),
			]
		);

		$this->end_controls_section();

		/**
		 * Style section
		 */
		$this->start_controls_section(
			'section_style',
			[
				'label' => __('Style', 'agenvix-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'text_transform',
			[
				'label' => __('Text Transform', 'agenvix-core'),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => __('None', 'agenvix-core'),
					'uppercase' => __('UPPERCASE', 'agenvix-core'),
					'lowercase' => __('lowercase', 'agenvix-core'),
					'capitalize' => __('Capitalize', 'agenvix-core'),
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
		$settings = $this->get_settings_for_display();
		$rating     = floatval($settings['avg_rating']);
		$full_stars = floor($rating);
		$half_star  = ($rating - $full_stars) >= 0.5;
		$empty_stars = 5 - $full_stars - ($half_star ? 1 : 0);
		?>

		<?php if ($settings['provix_design_style']  == 'layout-1'): ?>

			<div class="review-box style-one">
				<div class="review-title">
					<div class="icon">
						<i class="fa-solid fa-star"></i>
					</div>
					<p class="title"><?php echo $settings['title']; ?></p>
				</div>
				<div class="seperator"></div>
				<div class="review-contact">
					<div class="rating">
						<h4><?php echo esc_html( number_format( $rating, 1 ) ); ?></h4>
						<div class="stars">
							<?php
							// Full stars.
							for ($i = 0; $i < $full_stars; $i++) {
								echo '<i class="fas fa-star"></i>';
							}
							// Half star.
							if ($half_star) {
								echo '<i class="fas fa-star-half-alt"></i>';
							}
							// Empty stars.
							for ($i = 0; $i < $empty_stars; $i++) {
								echo '<i class="far fa-star"></i>';
							}
							?>
						</div>
					</div>
					<p class="subtitle"><?php echo $settings['subtitle']; ?></p>
				</div>
			</div>

		<?php elseif ($settings['provix_design_style']  == 'layout-2'): ?>

			<div class="review-box style-two">
				<div class="avater-image">
					<ul>
						<?php foreach ($settings['reviewer_img'] as $image) { ?>
							<li><a href="#"><img src="<?php echo esc_attr($image['url']); ?>" alt="client"></a></li>
						<?php } ?>
						<li>
							<a href="#" class="client-icon">
								<i class="fa-solid fa-plus"></i>
							</a>
						</li>
					</ul>
				</div>
			</div>

		<?php elseif ( 'layout-3' === $settings['provix_design_style'] ): ?>

			<div class="review-box style-three">
				<div class="avater-image">
					<ul>
						<?php foreach ($settings['reviewer_img'] as $image) { ?>
							<li><a href="#"><img src="<?php echo esc_attr($image['url']); ?>" alt="client"></a></li>
						<?php } ?>
						<li>
							<a href="#" class="client-icon">
								<i class="fa-solid fa-plus"></i>
							</a>
						</li>
					</ul>
				</div>
				<p class="title"><?php echo $settings['title']; ?></p>
			</div>

		<?php endif; ?>

<?php
	}
}

$widgets_manager->register(new Provix_Review_Box());
