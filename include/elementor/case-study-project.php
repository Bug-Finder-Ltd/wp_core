<?php

namespace ProvixCore\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Image_Size;
use Elementor\Repeater;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Provix Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Provix_Case_Study_Project extends \Elementor\Widget_Base {


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
		return 'case-study-project';
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
		return __( 'Case Study/Project', 'agenvix-core' );
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
	public function get_categories() {
		return array( 'agenvix-core' );
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
		return array( 'agenvix-core' );
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
		 * Layout section
		 */
		$this->start_controls_section(
			'provix_layout',
			array(
				'label' => esc_html__( 'Design Layout', 'agenvix-core' ),
			)
		);
		$this->add_control(
			'provix_design_style',
			array(
				'label'   => esc_html__( 'Select Layout', 'agenvix-core' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'layout-1' => esc_html__( 'Layout 1', 'agenvix-core' ),
					'layout-2' => esc_html__( 'Layout 2', 'agenvix-core' ),
					'layout-3' => esc_html__( 'Layout 3', 'agenvix-core' ),
					'layout-4' => esc_html__( 'Layout 4', 'agenvix-core' ),
					'layout-5' => esc_html__( 'Layout 5', 'agenvix-core' ),
					'layout-6' => esc_html__( 'Layout 6', 'agenvix-core' ),
					'layout-7' => esc_html__( 'Layout 7', 'agenvix-core' ),
				),
				'default' => 'layout-1',
			)
		);

		$this->end_controls_section();

		$layout_array = array( 'layout-1', 'layout-2', 'layout-3', 'layout-4', 'layout-5' );

		/**
		 * Title and content
		 */
		$this->start_controls_section(
			'provix_section_title',
			array(
				'label'     => esc_html__( 'Title & Content', 'agenvix-core' ),
				'condition' => array(
					'provix_design_style' => $layout_array,
				),
			)
		);

		$this->add_control(
			'subtitle',
			array(
				'label'       => esc_html__( 'Subtitle', 'agenvix-core' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Provix Subtitle', 'agenvix-core' ),
				'placeholder' => esc_html__( 'Type Text', 'agenvix-core' ),
				'label_block' => true,
			)
		);
		$this->add_control(
			'provix_title',
			array(
				'label'       => esc_html__( 'Title 1', 'agenvix-core' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Provix Title Here', 'agenvix-core' ),
				'placeholder' => esc_html__( 'Type Heading Text', 'agenvix-core' ),
				'label_block' => true,
			)
		);
		$this->add_control(
			'title2',
			array(
				'label'       => esc_html__( 'Title 2', 'agenvix-core' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Provix Title Here', 'agenvix-core' ),
				'placeholder' => esc_html__( 'Type Heading Text', 'agenvix-core' ),
				'label_block' => true,
			)
		);
		$this->add_control(
			'description',
			[
				'label' => esc_html__( 'Description', 'agenvix-core' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'rows' => 10,
				'default' => esc_html__( 'Default description', 'agenvix-core' ),
				'placeholder' => esc_html__( 'Type your description here', 'agenvix-core' ),
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'image_section',
			[
				'label' => esc_html__( 'Image', 'agenvix-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$img_repeater = new \Elementor\Repeater();

		$img_repeater->add_control(
			'custom_image',
			[
				'label' => __('Custom Image', 'agenvix-core'),
				'type'  => \Elementor\Controls_Manager::MEDIA,
			]
		);

		$this->add_control(
			'portfolio_items',
			[
				'label'       => __('Portfolio Image Overrides', 'agenvix-core'),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $img_repeater->get_controls(),
				'default'     => [],
				'title_field' => 'Item',
			]
		);
		$this->end_controls_section();
		
		$this->start_controls_section(
			'items_section',
			[
				'label' => esc_html__( 'Portfolio Items', 'agenvix-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		
		$repeater = new \Elementor\Repeater();
		
		$repeater->add_control(
			'portfolio_title',
			[
				'label' => esc_html__( 'Title', 'agenvix-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'List Title' , 'agenvix-core' ),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'portfolio_category',
			[
				'label' => esc_html__( 'Category', 'agenvix-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Branding & Identity' , 'agenvix-core' ),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'portfolio_image',
			[
				'label' => esc_html__( 'Choose Image', 'agenvix-core' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
		$repeater->add_control(
			'portfolio_description',
			[
				'label' => esc_html__( 'Description', 'agenvix-core' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'rows' => 6,
				'default' => esc_html__( 'Default description', 'agenvix-core' ),
				'placeholder' => esc_html__( 'Type your description here', 'agenvix-core' ),
			]
		);
		$repeater->add_control(
			'button_text',
			[
				'label' => esc_html__( 'Button Text', 'agenvix-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Explore Project' , 'agenvix-core' ),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'portfolio_link',
			[
				'label' => esc_html__( 'Link', 'agenvix-core' ),
				'type' => \Elementor\Controls_Manager::URL,
				'options' => [ 'url', 'is_external', 'nofollow' ],
				'default' => [
					'url' => '#',
					'is_external' => false,
					'nofollow' => false,
					// 'custom_attributes' => '',
				],
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'portfolio_bg_image',
			[
				'label' => esc_html__( 'Background Image', 'agenvix-core' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->add_control(
			'portfolio_list',
			[
				'label' => esc_html__( 'Portfolio List', 'agenvix-core' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'portfolio_title' => esc_html__( 'Lumina Cosmetics Rebrand', 'agenvix-core' ),
						'portfolio_category' => esc_html__( 'Branding & Identity', 'agenvix-core' ),
					],
					[
						'portfolio_title' => esc_html__( 'Sustainability Campaign', 'agenvix-core' ),
						'portfolio_category' => esc_html__( 'Campaign & Advertising', 'agenvix-core' ),
					],
				],
				'title_field' => '{{{ portfolio_title }}}',
			]
		);
		$this->end_controls_section();

		/**
		 * Show all button
		 */
		$this->start_controls_section(
			'provix_btn_button_group',
			array(
				'label'     => esc_html__( 'Button', 'agenvix-core' ),
				'condition' => array(
					'provix_design_style' => $layout_array,
				),
			)
		);

		$this->add_control(
			'provix_button_show',
			array(
				'label'        => esc_html__( 'Show Button', 'agenvix-core' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'agenvix-core' ),
				'label_off'    => esc_html__( 'Hide', 'agenvix-core' ),
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
				'label'   => esc_html__( 'Item Button Text', 'agenvix-core' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'View Details', 'agenvix-core' ),
				'title'   => esc_html__( 'Enter button text here', 'agenvix-core' ),
			)
		);

		$this->add_control(
			'view_all_btn_text',
			array(
				'label'       => esc_html__( 'View All Button Text', 'agenvix-core' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Explore More', 'agenvix-core' ),
				'title'       => esc_html__( 'Enter button text here', 'agenvix-core' ),
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
				'label'         => esc_html__( 'Show All Button link', 'agenvix-core' ),
				'type'          => Controls_Manager::URL,
				'dynamic'       => array(
					'active' => true,
				),
				'placeholder'   => esc_html__( 'https://your-link.com', 'agenvix-core' ),
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
		 * Style section
		 */
		$this->start_controls_section(
			'section_title_style',
			array(
				'label' => __( 'Section Title', 'agenvix-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'title1_color',
			[
				'label' => esc_html__( 'Title 1 Color', 'agenvix-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .portfolio-grid .section-title .title .title1' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'title2_color',
			[
				'label' => esc_html__( 'Title 2 Color', 'agenvix-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .portfolio-grid .section-title .title .title2' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'item_style',
			array(
				'label' => __( 'Portfolio Item', 'agenvix-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'item_title_color',
			[
				'label' => esc_html__( 'Title Color', 'agenvix-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .portfolio-grid .portfolio-item .title a' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'item_cat_color',
			[
				'label' => esc_html__( 'Category Color', 'agenvix-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .portfolio-grid .portfolio-categories li' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'button_style',
			array(
				'label' => __( 'Button', 'agenvix-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->start_controls_tabs(
			'btn_tabs'
		);
		$this->start_controls_tab(
			'btn_normal_tab',
			[
				'label' => esc_html__( 'Normal', 'agenvix-core' ),
			]
		);
			$this->add_control(
				'btn_text_color',
				[
					'label' => esc_html__( 'Text Color', 'agenvix-core' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .portfolio-grid .portfolio-item .button' => 'color: {{VALUE}}',
					],
				]
			);
			$this->add_group_control(
				\Elementor\Group_Control_Background::get_type(),
				[
					'name' => 'btn_background',
					'types' => [ 'classic', 'gradient' ],
					'selector' => '{{WRAPPER}} .portfolio-grid .portfolio-item .button',
				]
			);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'btn_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'agenvix-core' ),
			]
		);
			$this->add_control(
				'btn_hover_text_color',
				[
					'label' => esc_html__( 'Text Color', 'agenvix-core' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .portfolio-grid .portfolio-item .button:hover' => 'color: {{VALUE}}',
					],
				]
			);
			$this->add_group_control(
				\Elementor\Group_Control_Background::get_type(),
				[
					'name' => 'btn_hover_background',
					'types' => [ 'classic', 'gradient' ],
					'selector' => '{{WRAPPER}} .portfolio-grid .portfolio-item .button:hover',
				]
			);
		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'btn_border',
				'selector' => '{{WRAPPER}} .portfolio-grid .portfolio-item .button',
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

		if ( 'layout-1' === $settings['provix_design_style'] ) :
			$star_url = PROTINE_ADDONS_URL . 'assets/img/icons/star10-dark.png';
			?>

			<div class="portfolio-grid style-one">
				<div class="row">
					<div class="col-lg-6">
						<div class="left-column">
							<div class="section-title style-two">
								<?php if ( ! empty( $settings['subtitle'] ) ) : ?>
									<h6 class="subtitle">
										<div class="icon">
											<img src="<?php echo esc_url( $star_url ); ?>" alt="">
										</div>
										<?php echo $settings['subtitle']; ?>
									</h6>
								<?php endif ?>
								<h2 class="title text-anim-2"><?php echo $settings['provix_title']; ?></h2>
							</div>

							<?php
							$port_query_1 = new \WP_Query(
								array(
									'post_type'      => 'portfolio',
									'post_status'    => 'publish',
									'posts_per_page' => 1,
								)
							);
							?>

							<?php
							while ( $port_query_1->have_posts() ) :
								$port_query_1->the_post();
								?>
								<div class="portfolio-item">
									<div class="image">
										<?php the_post_thumbnail(); ?>
									</div>
									<div class="content">
										<div class="text">
											<?php
											$terms = get_the_terms( get_the_ID(), 'portfolio_cat' );

											if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
												echo '<ul class="portfolio-categories">';
												foreach ( $terms as $term ) {
													echo '<li>';
													echo '<a href="' . esc_url( get_term_link( $term ) ) . '">';
													echo esc_html( $term->name );
													echo '</a>';
													echo '</li>';
												}
												echo '</ul>';
											}
											?>
											<h5 class="title">
											    <a href="<?php echo esc_url( get_the_permalink() ); ?>">
											        <?php echo get_the_title(); ?>
											    </a>
											</h5>
										</div>
										<a class="button" href="<?php echo esc_url( get_the_permalink() ); ?>">
											<?php echo $settings['item_btn_text']; ?>
											<div class="btn-icon">
												<span class="icon-first"><i class="fa-light fa-arrow-right"></i></span>
												<span class="icon-second"><i class="fa-light fa-arrow-right"></i></span>
											</div>
										</a>
									</div>
								</div>
								<?php
							endwhile;
							wp_reset_postdata();
							?>
							<div class="section-footer">
								<?php if( !empty( $settings['description'] ) ) : ?>
									<p class="description"><?php echo $settings['description']; ?></p>
								<?php endif; ?>

								<?php if( !empty( $settings['view_all_btn_text'] ) ) : ?>
									<a class="button" href="<?php echo esc_url( $settings['show_all_btn_link']['url'] ); ?>">
										<?php echo $settings['view_all_btn_text']; ?>
										<i class="fa-light fa-arrow-right-long"></i>
									</a>
								<?php endif; ?>
							</div>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="right-column">
							<?php
							$port_query_2 = new \WP_Query(
								array(
									'post_type'      => 'portfolio',
									'post_status'    => 'publish',
									'posts_per_page' => 2,
									'offset'         => 1,
								)
							);
							?>

							<?php
							while ( $port_query_2->have_posts() ) :
								$port_query_2->the_post();
								?>
								<div class="portfolio-item">
									<div class="image">
										<?php the_post_thumbnail(); ?>
									</div>
									<div class="content">
										<div class="text">
											<?php
											$terms = get_the_terms( get_the_ID(), 'portfolio_cat' );

											if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
												echo '<ul class="portfolio-categories">';
												foreach ( $terms as $term ) {
													echo '<li>';
													echo '<a href="' . esc_url( get_term_link( $term ) ) . '">';
													echo esc_html( $term->name );
													echo '</a>';
													echo '</li>';
												}
												echo '</ul>';
											}
											?>
											<h5 class="title">
                                                <a href="<?php echo esc_url( get_the_permalink() ); ?>">
                                                    <?php echo get_the_title(); ?>
                                                </a>
											</h5>
										</div>
										<a class="button" href="<?php echo esc_url( get_the_permalink() ); ?>">
											<?php echo $settings['item_btn_text']; ?>
											<div class="btn-icon">
												<span class="icon-first"><i class="fa-light fa-arrow-right"></i></span>
												<span class="icon-second"><i class="fa-light fa-arrow-right"></i></span>
											</div>
										</a>
									</div>
								</div>
								<?php
							endwhile;
							wp_reset_postdata();
							?>
						</div>
					</div>
				</div>
			</div>

		<?php elseif ( 'layout-2' === $settings['provix_design_style'] ) : ?>

			<div class="portfolio-grid style-two">
				<div class="portfolio-container">
					<div class="portfolio-carousol">
						<div class="swiper-wrapper">
							<?php
							$port_query = new \WP_Query(
								array(
									'post_type'      => 'portfolio',
									'post_status'    => 'publish',
									'posts_per_page' => -1,
								)
							);
							?>

							<?php
							while ( $port_query->have_posts() ) :
								$port_query->the_post();
								?>
									<div class="swiper-slide">
										<div class="portfolio-item">
											<div class="image">
												<?php the_post_thumbnail(); ?>
											</div>
											<div class="content">
												<div class="text">
													<?php
													$terms = get_the_terms( get_the_ID(), 'portfolio_cat' );

													if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
														echo '<ul class="portfolio-categories">';
														foreach ( $terms as $term ) {
															echo '<li>';
															echo '<a href="' . esc_url( get_term_link( $term ) ) . '">';
															echo esc_html( $term->name );
															echo '</a>';
															echo '</li>';
														}
														echo '</ul>';
													}
													?>
													<h5 class="title">
													    <a href="<?php echo esc_url( get_the_permalink() ); ?>"><?php echo get_the_title(); ?></a>
													</h5>
												</div>
												<a class="button" href="<?php echo esc_url( get_the_permalink() ); ?>">
													<div class="btn-icon">
														<span class="icon-first"><i class="fa-light fa-arrow-right"></i></span>
														<span class="icon-second"><i class="fa-light fa-arrow-right"></i></span>
													</div>
												</a>
											</div>
										</div>
									</div>
								<?php
							endwhile;
							wp_reset_postdata();
							?>
						</div>
					</div>
				</div>
			</div>

		<?php elseif ( $settings['provix_design_style'] == 'layout-3' ) : ?>

			<div class="portfolio-grid style-three">
				<div class="section-title">
					<?php if( !empty($settings['subtitle']) ) : ?>
						<h2 class="subtitle"><?php echo $settings['subtitle']; ?></h2>
					<?php endif; ?>

					<div class="title">
						<h2 class="title1"><?php echo $settings['provix_title']; ?></h2>
						<h2 class="title2"><?php echo $settings['title2']; ?></h2>
					</div>
					<div class="row section-title-content">
						<div class="col-md-12 col-lg-6"></div>
						<div class="col-md-12 col-lg-6">
							<?php if( !empty($settings['description']) ) : ?>
								<p class="description"><?php echo $settings['description']; ?></p>
							<?php endif; ?>
							<?php if( !empty( $settings['view_all_btn_text'] ) ) : ?>
									<a class="button" href="<?php echo esc_url( $settings['show_all_btn_link']['url'] ); ?>">
										<?php echo $settings['view_all_btn_text']; ?>
										<i class="fa-light fa-arrow-right-long"></i>
									</a>
							<?php endif; ?>
						</div>
					</div>
				</div>
				<div class="grid-wrapper">
					<?php 
                        $items = ! empty( $settings['portfolio_list'] ) ? $settings['portfolio_list'] : [];
                        $total = count( $items );
                        
                        // Split items: first 3 left, next 3 right
                        $left_items  = array_slice( $items, 0, 3 );
                        $right_items = array_slice( $items, 3, 3 );
                    ?>
						<div class="left-column">
                            
							<?php foreach ( $left_items as $index => $item ) :
                                if ( !empty($item['portfolio_image']['url']) ) {
                                    $portfolio_image = !empty($item['portfolio_image']['id']) ? wp_get_attachment_image_url( $item['portfolio_image']['id'], '') : $item['portfolio_image']['url'];
                                    $portfolio_image_alt = get_post_meta($item["portfolio_image"]["id"], "_wp_attachment_image_alt", true);
                                }
                                
                                $this->remove_render_attribute( 'portfolio_link_' . $index );
                                
                                if ( ! empty( $item['portfolio_link']['url'] ) ) {
                                    $this->add_link_attributes( 'portfolio_link_' . $index, $item['portfolio_link'] );
                                }
                                ?>
							
								<div class="portfolio-item">
									<div class="image imagewrapper">
                                        <img class="imageinside" src="<?php echo esc_url($portfolio_image); ?>" alt="<?php echo esc_url($portfolio_image_alt); ?>">
									</div>
									<div class="content">
										<h2 class="title">
											<a <?php $this->print_render_attribute_string( 'portfolio_link_' . $index ); ?>>
											    <?php echo esc_html( $item['portfolio_title'] ); ?>
										    </a>
										</h2>
											
										<ul class="portfolio-categories">
                                            <li><?php echo esc_html( $item['portfolio_category'] ); ?></li>
                                        </ul>
                                        
                                        <a class="button" <?php $this->print_render_attribute_string( 'portfolio_link_' . $index ); ?>>
                                            <?php echo $item['button_text']; ?>
                                            <i class="fa-solid fa-circle-arrow-right"></i>
                                        </a>
										
									</div>
								</div>
							<?php endforeach; ?>
						</div>
					
					
						<div class="right-column">
							
							<?php foreach ( $right_items as $index => $item ) :
                                if ( !empty($item['portfolio_image']['url']) ) {
                                    $portfolio_image = !empty($item['portfolio_image']['id']) ? wp_get_attachment_image_url( $item['portfolio_image']['id'], '') : $item['portfolio_image']['url'];
                                    $portfolio_image_alt = get_post_meta($item["portfolio_image"]["id"], "_wp_attachment_image_alt", true);
                                }
                                
                                $this->remove_render_attribute( 'portfolio_link_' . $index );
                                
                                if ( ! empty( $item['portfolio_link']['url'] ) ) {
                                    $this->add_link_attributes( 'portfolio_link_' . $index, $item['portfolio_link'] );
                                }
							?>
							
								<div class="portfolio-item">
									<div class="image imagewrapper">
										<img class="imageinside" src="<?php echo esc_url($portfolio_image); ?>" alt="<?php echo esc_url($portfolio_image_alt); ?>">
									</div>
									<div class="content">
                                        <h2 class="title">
											<a <?php $this->print_render_attribute_string( 'portfolio_link_' . $index ); ?>>
											    <?php echo esc_html( $item['portfolio_title'] ); ?>
											</a>
										</h2>
										
										<ul class="portfolio-categories">
                                            <li><?php echo esc_html( $item['portfolio_category'] ); ?></li>
                                        </ul>
										
                                        <a class="button" <?php $this->print_render_attribute_string( 'portfolio_link_' . $index ); ?>>
                                            <?php echo $item['button_text']; ?>
                                            <i class="fa-solid fa-circle-arrow-right"></i>
                                        </a>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
					
				</div>
			</div>

		<?php elseif ( 'layout-4' === $settings['provix_design_style'] ) : ?>

			<div class="portfolio-grid style-four">
				<div class="section-title">
					<?php if( !empty($settings['subtitle']) ) : ?>
						<h4 class="subtitle"><?php echo $settings['subtitle']; ?></h4>
					<?php endif; ?>

					<?php if( !empty($settings['provix_title']) ) : ?>
						<h2 class="title"><?php echo $settings['provix_title']; ?></h2>
					<?php endif; ?>

					<?php if( !empty($settings['description']) ) : ?>
						<p class="description"><?php echo $settings['description']; ?></p>
					<?php endif; ?>
				</div>
				<?php
					$port_query_1 = new \WP_Query(
						array(
							'post_type'      => 'portfolio',
							'post_status'    => 'publish',
							'posts_per_page' => 4,
						)
					);

					$repeater_items = ! empty( $settings['portfolio_items'] ) ? $settings['portfolio_items'] : [];
					$index = 0;

					while ( $port_query_1->have_posts() ) :
						$port_query_1->the_post();

						if ( isset( $repeater_items[$index]['custom_image']['id'] ) && ! empty( $repeater_items[$index]['custom_image']['id'] ) ) {

							$image_html = wp_get_attachment_image(
								$repeater_items[$index]['custom_image']['id'],
								'full'
							);

						} else {

							$image_html = get_the_post_thumbnail( get_the_ID(), 'full' );

						}
						?>
						<div class="portfolio-item">
							<div class="image">
								<?php echo $image_html; ?>
							</div>
							<div class="content">
								<h2 class="title"><?php echo get_the_title(); ?></h2>
											
								<div class="item-footer">
									<?php
									$terms = get_the_terms( get_the_ID(), 'portfolio_cat' );

									if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
										echo '<ul class="portfolio-categories">';
											foreach ( $terms as $term ) {
												echo '<li>';
												echo '<a href="' . esc_url( get_term_link( $term ) ) . '">';
												echo esc_html( $term->name );
												echo '</a>';
												echo '</li>';
											}
										echo '</ul>';
									}
									?>
									<a class="button" href="<?php echo esc_url( get_the_permalink() ); ?>">
										<?php echo $settings['item_btn_text']; ?>
									</a>
								</div>
							</div>
						</div>
						<?php
						$index++;
					endwhile;
					wp_reset_postdata();
				?>
			</div>

		<?php elseif ( 'layout-5' === $settings['provix_design_style'] ) : ?>

			<?php
			$repeater_items = ! empty( $settings['portfolio_items'] ) ? $settings['portfolio_items'] : [];
			$global_index = 0;
			?>

			<div class="portfolio-grid style-five">
				<?php
				$port_query = new \WP_Query(
					array(
						'post_type'      => 'portfolio',
						'post_status'    => 'publish',
						'posts_per_page' => 6,
					)
				);
				?>

				<div class="all-items">
					<?php
					$i = 1;
					while ( $port_query->have_posts() ) :
						$port_query->the_post();

						if ( isset( $repeater_items[$global_index]['custom_image']['id'] ) && ! empty( $repeater_items[$global_index]['custom_image']['id'] ) ) {
							$image_html = wp_get_attachment_image(
								$repeater_items[$global_index]['custom_image']['id'],
								'full'
							);
						} else {
							$image_html = get_the_post_thumbnail( get_the_ID(), 'full' );
						}
						?>
						<div class="top-item top-item-<?php echo esc_attr( $i ); ?>">
							<?php echo $image_html; ?>
							<?php
								$terms = get_the_terms( get_the_ID(), 'portfolio_cat' );

								if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
									echo '<ul class="portfolio-categories">';
									foreach ( $terms as $term ) {
										echo '<li>';
										echo '<a href="' . esc_url( get_term_link( $term ) ) . '">';
										echo esc_html( $term->name );
										echo '</a>';
										echo '</li>';
									}
									echo '</ul>';
								}
							?>
						</div>
						<?php
						$i++;
						$global_index++;
					endwhile;
					wp_reset_postdata();
					?>
				</div>

				<div class="grid-wrapper">
					<div class="left-column">
						<div class="section-title">
							<h2 class="title"><?php echo $settings['provix_title']; ?></h2>
							<?php if( !empty( $settings['view_all_btn_text'] ) ) : ?>
								<a class="button" href="<?php echo esc_url( $settings['show_all_btn_link']['url'] ); ?>">
									<?php echo $settings['view_all_btn_text']; ?>
									<i class="fa-light fa-arrow-right-long"></i>
								</a>
							<?php endif; ?>
						</div>

							<?php
							$port_query_1 = new \WP_Query(
								array(
									'post_type'      => 'portfolio',
									'post_status'    => 'publish',
									'posts_per_page' => 3,
								)
							);
							
							$i1 = 1;
							while ( $port_query_1->have_posts() ) :
								$port_query_1->the_post();
								?>
								<div class="portfolio-item port-item-<?php echo esc_attr( $i1 ); ?>">
									<div class="image">
										
									</div>
									<div class="content">
										<div class="text">
											<h2 class="title"><?php echo get_the_title(); ?></h2>
										</div>
										<a class="button" href="<?php echo esc_url( get_the_permalink() ); ?>">
											<?php echo $settings['item_btn_text']; ?>
											<i class="fa-solid fa-circle-arrow-right"></i>
										</a>
									</div>
								</div>
								<?php
								$i1++;
							endwhile;
							wp_reset_postdata();
							?>
						</div>
					
						<div class="right-column">
							<?php
							$port_query_2 = new \WP_Query(
								array(
									'post_type'      => 'portfolio',
									'post_status'    => 'publish',
									'posts_per_page' => 3,
									'offset'         => 3,
								)
							);
							?>

							<?php
							$i2 = 4;
							while ( $port_query_2->have_posts() ) :
								$port_query_2->the_post();
								?>
								<div class="portfolio-item port-item-<?php echo $i2; ?>">
									<div class="image">
										
									</div>
									<div class="content">
										<div class="text">
											<h2 class="title"><?php echo get_the_title(); ?></h2>
										</div>
										<a class="button" href="<?php echo esc_url( get_the_permalink() ); ?>">
											<?php echo $settings['item_btn_text']; ?>
											<i class="fa-solid fa-circle-arrow-right"></i>
										</a>
									</div>
								</div>
								<?php
								$i2++;
							endwhile;
							wp_reset_postdata();
							?>
					</div>
				</div>
			</div>

		<?php elseif ( 'layout-6' === $settings['provix_design_style'] ) : ?>

			<div class="portfolio-grid style-six">

				<?php foreach (  $settings['portfolio_list'] as $index => $item ) :
					if (! empty($item['portfolio_image']['url'])) {
						$image     = ! empty($item['portfolio_image']['id']) ? wp_get_attachment_image_url($item['portfolio_image']['id'], 'full') : $item['portfolio_image']['url'];
						$image_alt = get_post_meta($item['portfolio_image']['id'], '_wp_attachment_image_alt', true);
					}

					$bg_url = ! empty( $item['portfolio_bg_image']['url'] ) ? $item['portfolio_bg_image']['url'] : '';

					$this->add_render_attribute(
						'item-' . $index,
						'class',
						'bg one'
					);

					if ( $bg_url ) {

						$background = sprintf(
							'background-image: linear-gradient(180deg, rgba(13, 0, 38, 0.5) 50%%, rgba(16, 0, 47, 1) 100%%), url(%s);',
							esc_url( $bg_url )
						);

						$this->add_render_attribute(
							'item-' . $index,
							'style',
							$background
						);
					}
					?>
					<div class="item first">
						<div class="outer">
							<div class="inner">
							<div <?php echo $this->get_render_attribute_string( 'item-' . $index ); ?>>
								<div class="content">
									<h2 class="section-heading"><?php echo $item['portfolio_title']; ?></h2>
									<div class="image">
										<img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($image_alt); ?>">
									</div>
									<p class="description"><?php echo $item['portfolio_description']; ?></p>
								</div>
							</div>
							</div>
						</div>
					</div>
				<?php endforeach; ?>

			</div>

		<?php elseif ( 'layout-7' === $settings['provix_design_style'] ) :
			$eye   = PROTINE_ADDONS_URL . 'assets/img/icons/eye.gif';
			?>

			<div class="portfolio-grid style-seven">
				<div class="wrapper">
					<?php foreach (  $settings['portfolio_list'] as $index => $item ) :
						if (! empty($item['portfolio_image']['url'])) {
							$image     = ! empty($item['portfolio_image']['id']) ? wp_get_attachment_image_url($item['portfolio_image']['id'], 'full') : $item['portfolio_image']['url'];
							$image_alt = get_post_meta($item['portfolio_image']['id'], '_wp_attachment_image_alt', true);
						}

						$bg_url = ! empty( $item['portfolio_bg_image']['url'] ) ? $item['portfolio_bg_image']['url'] : '';

						$this->add_render_attribute(
							'item-' . $index,
							'class',
							'slide'
						);

						if ( $bg_url ) {

							$background = sprintf(
								'background-image: linear-gradient(180deg, rgba(13, 0, 38, 0.5) 50%%, rgba(16, 0, 47, 1) 100%%), url(%s);',
								esc_url( $bg_url )
							);

							$this->add_render_attribute(
								'item-' . $index,
								'style',
								$background
							);
						}

						?>

						<div <?php echo $this->get_render_attribute_string( 'item-' . $index ); ?>>
							
								<div class="content">
									<h2 class="title"><?php echo $item['portfolio_title']; ?></h2>
									<div class="image">
										<img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($image_alt); ?>">
										<a class="view-btn" href="<?php echo esc_url($item['portfolio_link']['url']); ?>">
											<img src="<?php echo esc_url($eye); ?>" alt="">
										</a>
									</div>
									<p class="description"><?php echo $item['portfolio_description']; ?></p>
								</div>
							
						</div>

					<?php endforeach; ?>

				</div>
			</div>

		<?php endif; ?>
		<?php
	}
}

$widgets_manager->register( new Provix_Case_Study_Project() );
