<?php

namespace ProvixCore\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Repeater;
use Elementor\Utils;

if (! defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

/**
 * Provix Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class All_Portfolio extends \Elementor\Widget_Base
{


	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name()
	{
		return 'all-portfolio';
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
	public function get_title()
	{
		return __('All Portfolio', 'agenvix-core');
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
	public function get_icon()
	{
		return 'provix-icon';
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
	public function get_categories()
	{
		return array('agenvix-core');
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
	public function get_script_depends()
	{
		return array('agenvix-core');
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
	protected function register_controls()
	{

		/**
		 * Layout section
		 */
		$this->start_controls_section(
			'provix_layout',
			array(
				'label' => esc_html__('Design Layout', 'agenvix-core'),
			)
		);
		$this->add_control(
			'provix_design_style',
			array(
				'label'   => esc_html__('Select Layout', 'agenvix-core'),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'layout-1' => esc_html__('Layout 1', 'agenvix-core'),
					'layout-2' => esc_html__('Layout 2', 'agenvix-core'),
					'layout-3' => esc_html__('Layout 3', 'agenvix-core'),
				),
				'default' => 'layout-1',
			)
		);

		$this->end_controls_section();

		$layout_array = array('layout-1', 'layout-2');

		/**
		 * Title and content
		 */
		$this->start_controls_section(
			'provix_section_title',
			array(
				'label'     => esc_html__('Title & Content', 'agenvix-core'),
				'condition' => array(
					'provix_design_style' => $layout_array,
				),
			)
		);

		$this->add_control(
			'subtitle',
			array(
				'label'       => esc_html__('Subtitle', 'agenvix-core'),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__('Provix Subtitle', 'agenvix-core'),
				'placeholder' => esc_html__('Type Text', 'agenvix-core'),
				'label_block' => true,
			)
		);
		$this->add_control(
			'provix_title',
			array(
				'label'       => esc_html__('Title', 'agenvix-core'),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__('Provix Title Here', 'agenvix-core'),
				'placeholder' => esc_html__('Type Heading Text', 'agenvix-core'),
				'label_block' => true,
			)
		);
		$this->add_control(
			'description',
			[
				'label' => esc_html__('Description', 'agenvix-core'),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'rows' => 10,
				'default' => esc_html__('Default description', 'agenvix-core'),
				'placeholder' => esc_html__('Type your description here', 'agenvix-core'),
			]
		);
		$this->end_controls_section();

		/**
		 * Show all button
		 */
		$this->start_controls_section(
			'provix_btn_button_group',
			array(
				'label'     => esc_html__('Button', 'agenvix-core'),
				'condition' => array(
					'provix_design_style' => $layout_array,
				),
			)
		);

		$this->add_control(
			'provix_button_show',
			array(
				'label'        => esc_html__('Show Button', 'agenvix-core'),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__('Show', 'agenvix-core'),
				'label_off'    => esc_html__('Hide', 'agenvix-core'),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => array(
					'provix_design_style' => $layout_array,
				),
			)
		);

		$this->add_control(
			'item_btn_text',
			array(
				'label'   => esc_html__('Item Button Text', 'agenvix-core'),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__('View Details', 'agenvix-core'),
				'title'   => esc_html__('Enter button text here', 'agenvix-core'),
			)
		);

		$this->add_control(
			'view_all_btn_text',
			array(
				'label'       => esc_html__('View All Button Text', 'agenvix-core'),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__('Explore More', 'agenvix-core'),
				'title'       => esc_html__('Enter button text here', 'agenvix-core'),
				'label_block' => true,
				'condition'   => array(
					'provix_button_show'  => 'yes',
					'provix_design_style' => $layout_array,
				),
			)
		);

		$this->add_control(
			'show_all_btn_link',
			array(
				'label'         => esc_html__('Show All Button link', 'agenvix-core'),
				'type'          => Controls_Manager::URL,
				'dynamic'       => array(
					'active' => true,
				),
				'placeholder'   => esc_html__('https://your-link.com', 'agenvix-core'),
				'show_external' => false,
				'default'       => array(
					'url'               => '#',
					'is_external'       => true,
					'nofollow'          => true,
					'custom_attributes' => '',
				),
				'condition'     => array(
					'provix_button_show'  => 'yes',
					'provix_design_style' => $layout_array,
				),
				'label_block'   => true,
			)
		);

		$this->end_controls_section();

		/**
		 * Project / Portfolio section
		 */
		$this->start_controls_section(
			'provix_portfolio',
			array(
				'label'       => esc_html__('Project/Portfolio', 'agenvix-core'),
				'description' => esc_html__('Control all the style settings from Style tab', 'agenvix-core'),
				'tab'         => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'provix_portfolio_image',
			array(
				'label'   => esc_html__('Portfolio Image', 'agenvix-core'),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => Utils::get_placeholder_image_src(),
				),
			)
		);
		$repeater->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'    => 'provix_image_size',
				'default' => 'full',
				'exclude' => array(
					'custom',
				),
			)
		);
		$repeater->add_control(
			'provix_portfolio_title',
			array(
				'label'       => esc_html__('Title', 'agenvix-core'),
				'description' => provix_get_allowed_html_desc('basic'),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => esc_html__('Portfolio Title', 'agenvix-core'),
				'label_block' => true,
			)
		);

		$repeater->add_control(
			'provix_portfolio_title_color',
			array(
				'label'     => __('Title Color', 'agenvix-core'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .portfolio-single-caption-inner a' => 'color: {{VALUE}}',
				),
			)
		);

		$repeater->add_control(
			'provix_portfolio_description',
			array(
				'label'       => esc_html__('Description', 'agenvix-core'),
				'description' => provix_get_allowed_html_desc('intermediate'),
				'type'        => \Elementor\Controls_Manager::TEXTAREA,
				'default'     => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered.',
				'label_block' => true,
			)
		);

		$repeater->add_control(
			'provix_portfolio_description_color',
			array(
				'label'     => __('Description Color', 'agenvix-core'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .portfolio-single-caption-inner h6' => 'color: {{VALUE}}',
				),
			)
		);

		$repeater->add_control(
			'provix_portfolio_link_switcher',
			array(
				'label'        => esc_html__('Show Portfolio Link?', 'agenvix-core'),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__('Yes', 'agenvix-core'),
				'label_off'    => esc_html__('No', 'agenvix-core'),
				'return_value' => 'yes',
				'default'      => 'yes',
				'separator'    => 'before',
			)
		);

		$repeater->add_control(
			'provix_portfolio_link_type',
			array(
				'label'     => esc_html__('Portfolio Link Type', 'agenvix-core'),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   => array(
					'1' => 'Custom Link',
					'2' => 'Internal Page',
				),
				'default'   => '1',
				'condition' => array(
					'provix_portfolio_link_switcher' => 'yes',
				),
			)
		);
		$repeater->add_control(
			'provix_portfolio_link',
			array(
				'label'         => esc_html__('Portfolio Link', 'agenvix-core'),
				'type'          => \Elementor\Controls_Manager::URL,
				'dynamic'       => array(
					'active' => true,
				),
				'placeholder'   => esc_html__('https://your-link.com', 'agenvix-core'),
				'show_external' => true,
				'default'       => array(
					'url'         => '#',
					'is_external' => false,
					'nofollow'    => false,
				),
				'condition'     => array(
					'provix_portfolio_link_type'     => '1',
					'provix_portfolio_link_switcher' => 'yes',
				),
			)
		);
		$repeater->add_control(
			'provix_portfolio_page_link',
			array(
				'label'       => esc_html__('Select Portfolio Link Page', 'agenvix-core'),
				'type'        => \Elementor\Controls_Manager::SELECT2,
				'label_block' => true,
				'options'     => provix_get_all_pages(),
				'condition'   => array(
					'provix_portfolio_link_type'     => '2',
					'provix_portfolio_link_switcher' => 'yes',
				),
			)
		);

		$repeater->add_control(
			'provix_portfolio_icon_type',
			array(
				'label'   => esc_html__('Select Icon Type', 'agenvix-core'),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'image',
				'options' => array(
					'image' => esc_html__('Image', 'agenvix-core'),
					'icon'  => esc_html__('Icon', 'agenvix-core'),
				),
			)
		);

		$repeater->add_control(
			'provix_icon_image',
			array(
				'label'     => esc_html__('Upload Icon Image', 'agenvix-core'),
				'type'      => Controls_Manager::MEDIA,
				'default'   => array(
					'url' => Utils::get_placeholder_image_src(),
				),
				'condition' => array(
					'provix_portfolio_icon_type' => 'image',
				),

			)
		);

		if (provix_is_elementor_version('<', '2.6.0')) {
			$repeater->add_control(
				'icon',
				array(
					'show_label'  => false,
					'type'        => Controls_Manager::ICON,
					'label_block' => true,
					'default'     => 'fa fa-star',
					'condition'   => array(
						'provix_portfolio_icon_type' => 'icon',
					),
				)
			);
		} else {
			$repeater->add_control(
				'selected_icon',
				array(
					'show_label'       => false,
					'type'             => Controls_Manager::ICONS,
					'fa4compatibility' => 'icon',
					'label_block'      => true,
					'default'          => array(
						'value'   => 'far fa-star',
						'library' => 'regular',
					),
					'condition'        => array(
						'provix_portfolio_icon_type' => 'icon',
					),
				)
			);
		}

		$this->add_control(
			'provix_portfolio_list',
			array(
				'label'       => esc_html__('Services - List', 'agenvix-core'),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => array(
					array(
						'provix_portfolio_title' => esc_html__('Realistic Sitting Room Interior', 'agenvix-core'),
					),
					array(
						'provix_portfolio_title' => esc_html__('Installation of Wall Coverings', 'agenvix-core'),
					),
					array(
						'provix_portfolio_title' => esc_html__('Picture of female artist  easel', 'agenvix-core'),
					),
				),
				'title_field' => '{{{ provix_portfolio_title }}}',
			)
		);
		$this->add_responsive_control(
			'provix_portfolio_align',
			array(
				'label'     => esc_html__('Alignment', 'agenvix-core'),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'text-left'   => array(
						'title' => esc_html__('Left', 'agenvix-core'),
						'icon'  => 'eicon-text-align-left',
					),
					'text-center' => array(
						'title' => esc_html__('Center', 'agenvix-core'),
						'icon'  => 'eicon-text-align-center',
					),
					'text-right'  => array(
						'title' => esc_html__('Right', 'agenvix-core'),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'toggle'    => true,
				'separator' => 'before',
			)
		);

		$this->end_controls_section();

		/**
		 * Style section
		 */
		$this->start_controls_section(
			'section_style',
			array(
				'label' => __('Style', 'agenvix-core'),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'text_transform',
			array(
				'label'     => __('Text Transform', 'agenvix-core'),
				'type'      => Controls_Manager::SELECT,
				'default'   => '',
				'options'   => array(
					''           => __('None', 'agenvix-core'),
					'uppercase'  => __('UPPERCASE', 'agenvix-core'),
					'lowercase'  => __('lowercase', 'agenvix-core'),
					'capitalize' => __('Capitalize', 'agenvix-core'),
				),
				'selectors' => array(
					'{{WRAPPER}} .title' => 'text-transform: {{VALUE}};',
				),
			)
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

		if ($settings['provix_design_style'] == 'layout-1') :
			$star_url = PROTINE_ADDONS_URL . 'assets/img/icons/star10-dark.png';
			?>

			<div class="all-portfolio-grid style-one">
				<div class="items-wrapper">
					<?php
					$port_query_1 = new \WP_Query(
						array(
							'post_type'      => 'portfolio',
							'post_status'    => 'publish',
							'posts_per_page' => -1,
						)
					);
					?>

					<?php
					while ( $port_query_1->have_posts() ) :
						$port_query_1->the_post();
						?>
						<div class="portfolio-item wow fadeInUp" data-wow-delay="500ms">
							<div class="image">
								<?php the_post_thumbnail(); ?>
								<a href="<?php echo esc_url( get_the_permalink() ); ?>">
									<i class="fa-light fa-arrow-right"></i>
								</a>
							</div>
							<div class="content">
								<?php
								$terms = get_the_terms(get_the_ID(), 'portfolio_cat');

								if (! empty($terms) && ! is_wp_error($terms)) {
									echo '<ul class="portfolio-categories">';
									foreach ($terms as $term) {
										echo '<li>';
										echo '<a href="' . esc_url(get_term_link($term)) . '">';
										echo esc_html($term->name);
										echo '</a>';
										echo '</li>';
									}
									echo '</ul>';
								}
								?>
								<h3 class="title">
									<a href="<?php echo esc_url(get_the_permalink()); ?>"><?php echo get_the_title(); ?></a>
								</h3>
							</div>
						</div>
					<?php endwhile; ?>
				</div>
			</div>

		<?php elseif ($settings['provix_design_style'] == 'layout-2') : ?>

			<!-- portfolio -->
			<section class="portfolio">
				<div class="container">
					<div class="row">
						<div class="common-title-container">
							<div class="common-title">
								<img src="<?php echo get_template_directory_uri() . '/assets/img/shape/line-left-black.png'; ?>" alt="shape">
								<?php if (! empty($settings['provix_section_title_show'])) : ?>
									<?php
									if (! empty($settings['provix_title'])) :
										printf(
											'<%1$s %2$s>%3$s</%1$s>',
											tag_escape($settings['provix_title_tag']),
											$this->get_render_attribute_string('title_args'),
											provix_kses($settings['provix_title'])
										);
									endif;
									?>
								<?php endif; ?>
							</div>
							<div class="portfolio-round-btn">
								<?php if (! empty($settings['provix_show_all_btn_link']['url'])) : ?>
									<a href="<?php echo esc_url($settings['provix_show_all_btn_link']['url']); ?>" class="round-btn">
										<p><?php echo provix_kses($settings['provix_show_all_btn_text']); ?></p><i class="icon-arrow-1"></i> <span></span>
									</a>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
				<div class="portfolio-container">
					<div class="portfolio-carousol">
						<div class="four-item-carousel swiper-container portfolio-carousol-container">
							<div class="swiper-wrapper">
								<?php
								foreach ($settings['provix_portfolio_list'] as $key => $item) :
									if (! empty($item['provix_portfolio_image']['url'])) {
										$provix_portfolio_image_url = ! empty($item['provix_portfolio_image']['id']) ? wp_get_attachment_image_url($item['provix_portfolio_image']['id'], $item['provix_image_size_size']) : $item['provix_portfolio_image']['url'];
										$provix_portfolio_image_alt = get_post_meta($item['provix_portfolio_image']['id'], '_wp_attachment_image_alt', true);
									}

									if ('2' == $item['provix_portfolio_link_type']) {
										$link   = get_permalink($item['provix_portfolio_page_link']);
										$target = '_self';
										$rel    = 'nofollow';
									} else {
										$link   = ! empty($item['provix_portfolio_link']['url']) ? $item['provix_portfolio_link']['url'] : '';
										$target = ! empty($item['provix_portfolio_link']['is_external']) ? '_blank' : '';
										$rel    = ! empty($item['provix_portfolio_link']['nofollow']) ? 'nofollow' : '';
									}
								?>
									<div class="swiper-slide">
										<div class="portfolio-single wow fadeInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
											<div class="portfolio-single-image">
												<a href="<?php echo esc_url($link); ?>">
													<img src="<?php echo esc_url($provix_portfolio_image_url); ?>" alt="<?php echo esc_url($provix_portfolio_image_alt); ?>">
												</a>
											</div>
											<div class="portfolio-single-caption">
												<div class="portfolio-single-caption-inner">
													<?php if (! empty($item['provix_portfolio_description'])) : ?>
														<h6><?php echo provix_kses($item['provix_portfolio_description']); ?></h6>
													<?php endif; ?>
													<a href="<?php echo esc_url($link); ?>"><?php echo provix_kses($item['provix_portfolio_title']); ?></a>
												</div>
												<div class="portfolio-single-caption-icon">
													<a href="<?php echo esc_url($link); ?>"><i class="fa-sharp fa-regular fa-arrow-up-right"></i></a>
												</div>
											</div>
										</div>
									</div>
								<?php endforeach; ?>
							</div>
						</div>
					</div>
				</div>
			</section>
			<!-- portfolio -->

		<?php elseif ($settings['provix_design_style'] == 'layout-3') : ?>

			<!-- portfolio -->
			<section class="portfolio">
				<div class="container">
					<div class="row">
						<div class="common-title-container">
							<div class="common-title">
								<?php if (! empty($settings['provix_section_title_show'])) : ?>
									<?php
									if (! empty($settings['provix_title'])) :
										printf(
											'<%1$s %2$s>%3$s</%1$s>',
											tag_escape($settings['provix_title_tag']),
											$this->get_render_attribute_string('title_args'),
											provix_kses($settings['provix_title'])
										);
									endif;
									?>
								<?php endif; ?>
							</div>
							<div class="portfolio-round-btn">
								<?php if (! empty($settings['provix_show_all_btn_link']['url'])) : ?>
									<a href="<?php echo esc_url($settings['provix_show_all_btn_link']['url']); ?>" class="round-btn">
										<p><?php echo provix_kses($settings['provix_show_all_btn_text']); ?></p><i class="icon-arrow-1"></i> <span></span>
									</a>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
				<div class="portfolio-container">
					<div class="portfolio-carousol">
						<div class="four-item-carousel swiper-container portfolio-carousol-container">
							<div class="swiper-wrapper">
								<?php
								foreach ($settings['provix_portfolio_list'] as $key => $item) :
									if (! empty($item['provix_portfolio_image']['url'])) {
										$provix_portfolio_image_url = ! empty($item['provix_portfolio_image']['id']) ? wp_get_attachment_image_url($item['provix_portfolio_image']['id'], $item['provix_image_size_size']) : $item['provix_portfolio_image']['url'];
										$provix_portfolio_image_alt = get_post_meta($item['provix_portfolio_image']['id'], '_wp_attachment_image_alt', true);
									}
									if ('2' == $item['provix_portfolio_link_type']) {
										$link   = get_permalink($item['provix_portfolio_page_link']);
										$target = '_self';
										$rel    = 'nofollow';
									} else {
										$link   = ! empty($item['provix_portfolio_link']['url']) ? $item['provix_portfolio_link']['url'] : '';
										$target = ! empty($item['provix_portfolio_link']['is_external']) ? '_blank' : '';
										$rel    = ! empty($item['provix_portfolio_link']['nofollow']) ? 'nofollow' : '';
									}
								?>
									<div class="swiper-slide">
										<div class="portfolio-single wow fadeInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
											<div class="portfolio-single-image">
												<img src="<?php echo esc_url($provix_portfolio_image_url); ?>" alt="<?php echo esc_url($provix_portfolio_image_alt); ?>">
											</div>
											<div class="portfolio-single-caption">
												<div class="portfolio-single-caption-inner">
													<?php if (! empty($item['provix_portfolio_description'])) : ?>
														<h6><?php echo provix_kses($item['provix_portfolio_description']); ?></h6>
													<?php endif; ?>
													<?php if (! empty($item['provix_portfolio_title'])) : ?>
														<a href="<?php echo esc_url($link); ?>"><?php echo provix_kses($item['provix_portfolio_title']); ?></a>
													<?php endif; ?>
												</div>
												<div class="portfolio-single-caption-icon">
													<?php if (! empty($item['provix_portfolio_title'])) : ?>
														<a href="<?php echo esc_url($link); ?>"><i class="fa-sharp fa-regular fa-arrow-up-right"></i></a>
													<?php endif; ?>
												</div>
											</div>
										</div>
									</div>
								<?php endforeach; ?>
							</div>
						</div>
					</div>
				</div>
			</section>
			<!-- portfolio -->
		<?php endif; ?>
<?php
	}
}

$widgets_manager->register(new All_Portfolio());
