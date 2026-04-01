<?php

namespace ProvixCore\Widgets;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Provix Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class All_Blog_Post extends \Elementor\Widget_Base {



	public function get_name() {
		return 'all-blog-post';
	}

	public function get_title() {
		return __( 'All Blog Post', 'agenvix-core' );
	}

	public function get_icon() {
		return 'provix-icon';
	}

	public function get_categories() {
		return array( 'agenvix-core' );
	}

	public function get_script_depends() {
		return array( 'agenvix-core' );
	}

	protected function register_controls() {

		/**
		 * Layout section
		 */
		$this->start_controls_section(
			'provix_post_',
			array(
				'label' => esc_html__( 'Design Layout', 'agenvix-core' ),
			)
		);
		$this->add_control(
			'provix_design_style',
			array(
				'label'   => esc_html__( 'Select Layout', 'agenvix-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'layout-1' => esc_html__( 'Layout 1', 'agenvix-core' ),
					'layout-2' => esc_html__( 'Layout 2', 'agenvix-core' ),
					'layout-3' => esc_html__( 'Layout 3', 'agenvix-core' ),
					'layout-4' => esc_html__( 'Layout 4', 'agenvix-core' ),
					'layout-5' => esc_html__( 'Layout 5', 'agenvix-core' ),
				),
				'default' => 'layout-1',
			)
		);

		$this->end_controls_section();

		/**
		 * Title and content
		 */
		$this->start_controls_section(
			'provix_section_title',
			array(
				'label' => esc_html__( 'Title & Content', 'agenvix-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'subtitle',
			array(
				'label'       => esc_html__( 'Subtitle', 'agenvix-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => esc_html__( 'Provix Subtitle', 'agenvix-core' ),
				'placeholder' => esc_html__( 'Type Text', 'agenvix-core' ),
				'label_block' => true,
			)
		);
		$this->add_control(
			'title',
			array(
				'label'       => esc_html__( 'Title', 'agenvix-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => esc_html__( 'Provix Title Here', 'agenvix-core' ),
				'placeholder' => esc_html__( 'Type Heading Text', 'agenvix-core' ),
				'label_block' => true,
			)
		);
		$this->end_controls_section();

		/**
		 * Blog query section
		 */
		$this->start_controls_section(
			'provix_post_query',
			array(
				'label' => esc_html__( 'Blog Query', 'agenvix-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$post_type = 'post';
		$taxonomy  = 'category';

		$this->add_control(
			'posts_per_page',
			array(
				'label'       => esc_html__( 'Posts Per Page', 'agenvix-core' ),
				'description' => esc_html__( 'Leave blank or enter -1 for all.', 'agenvix-core' ),
				'type'        => \Elementor\Controls_Manager::NUMBER,
				'default'     => '3',
			)
		);

		$this->add_control(
			'category',
			array(
				'label'       => esc_html__( 'Include Categories', 'agenvix-core' ),
				'description' => esc_html__( 'Select a category to include or leave blank for all.', 'agenvix-core' ),
				'type'        => \Elementor\Controls_Manager::SELECT2,
				'multiple'    => true,
				'options'     => provix_get_categories( $taxonomy ),
				'label_block' => true,
			)
		);

		$this->add_control(
			'exclude_category',
			array(
				'label'       => esc_html__( 'Exclude Categories', 'agenvix-core' ),
				'description' => esc_html__( 'Select a category to exclude', 'agenvix-core' ),
				'type'        => \Elementor\Controls_Manager::SELECT2,
				'multiple'    => true,
				'options'     => provix_get_categories( $taxonomy ),
				'label_block' => true,
			)
		);

		$this->add_control(
			'post__not_in',
			array(
				'label'       => esc_html__( 'Exclude Item', 'agenvix-core' ),
				'type'        => \Elementor\Controls_Manager::SELECT2,
				'options'     => provix_get_all_types_post( $post_type ),
				'multiple'    => true,
				'label_block' => true,
			)
		);

		$this->add_control(
			'offset',
			array(
				'label'   => esc_html__( 'Offset', 'agenvix-core' ),
				'type'    => \Elementor\Controls_Manager::NUMBER,
				'default' => '0',
			)
		);

		$this->add_control(
			'orderby',
			array(
				'label'   => esc_html__( 'Order By', 'agenvix-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'ID'            => 'Post ID',
					'author'        => 'Post Author',
					'title'         => 'Title',
					'date'          => 'Date',
					'modified'      => 'Last Modified Date',
					'parent'        => 'Parent Id',
					'rand'          => 'Random',
					'comment_count' => 'Comment Count',
					'menu_order'    => 'Menu Order',
				),
				'default' => 'date',
			)
		);

		$this->add_control(
			'order',
			array(
				'label'   => esc_html__( 'Order', 'agenvix-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'asc'  => esc_html__( 'Ascending', 'agenvix-core' ),
					'desc' => esc_html__( 'Descending', 'agenvix-core' ),
				),
				'default' => 'desc',

			)
		);
		$this->add_control(
			'ignore_sticky_posts',
			array(
				'label'        => esc_html__( 'Ignore Sticky Posts', 'agenvix-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'agenvix-core' ),
				'label_off'    => esc_html__( 'No', 'agenvix-core' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$this->add_control(
			'provix_blog_title_word',
			array(
				'label'       => esc_html__( 'Title Word Count', 'agenvix-core' ),
				'description' => esc_html__( 'Set how many word you want to display!', 'agenvix-core' ),
				'type'        => \Elementor\Controls_Manager::NUMBER,
				'default'     => '10',
			)
		);

		$this->add_control(
			'provix_post_content',
			array(
				'label'        => __( 'Content', 'agenvix-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'agenvix-core' ),
				'label_off'    => __( 'Hide', 'agenvix-core' ),
				'return_value' => 'yes',
				'default'      => '',
				'condition'    => array(
					'provix_design_style' => 'layout-1',
				),
			)
		);

		$this->add_control(
			'provix_post_content_limit',
			array(
				'label'       => __( 'Content Limit', 'agenvix-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => '14',
				'dynamic'     => array(
					'active' => true,
				),
				'condition'   => array(
					'provix_post_content' => 'yes',
					'provix_design_style' => 'layout-1',
				),
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
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'section_title_width',
			array(
				'label'      => esc_html__( 'Width', 'agenvix-core' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%', 'em', 'rem', 'custom' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 1,
					),
					'%'  => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .blog-posts .section-title' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'date_style',
			array(
				'label' => __( 'Date', 'agenvix-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'date_position',
			array(
				'label'     => esc_html__( 'Date Position', 'agenvix-core' ),
				'type'      => \Elementor\Controls_Manager::CHOOSE,
				'options'   => array(
					''     => array(
						'title' => esc_html__( 'Top', 'agenvix-core' ),
						'icon'  => 'eicon-v-align-top',
					),
					'20px' => array(
						'title' => esc_html__( 'Bottom', 'agenvix-core' ),
						'icon'  => 'eicon-v-align-bottom',
					),
				),
				'default'   => '',
				'toggle'    => true,
				'selectors' => array(
					'{{WRAPPER}} .blog-posts-1 .blog-image .date' => 'top: inherit; bottom: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'title_style',
			array(
				'label' => esc_html__( 'Title', 'agenvix-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'title_color',
			array(
				'label'     => esc_html__( 'Color', 'agenvix-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .blog-posts-1 .blog-content .title' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			array(
				'name'     => 'title_typography',
				'selector' => '{{WRAPPER}} .blog-posts-1 .blog-content .title',
			)
		);
		$this->add_control(
			'title_margin',
			array(
				'label'      => esc_html__( 'Margin', 'agenvix-core' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em', 'rem', 'custom' ),
				'selectors'  => array(
					'{{WRAPPER}} .blog-posts-1 .blog-content .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		
		$paged = get_query_var('paged') ? get_query_var('paged') : 1;

		$query = new \WP_Query( array(
			'post_type'      => 'post',
			'paged'          => $paged,
		) );

		?>

		<?php
		if ( 'layout-1' === $settings['provix_design_style'] ) : ?>

			<div class="all-blog style-one">
				<div class="row">
					<?php
					if ( $query->have_posts() ) :
						while ( $query->have_posts() ) : $query->the_post();
						?>
						<div class="col-md-6 col-lg-6 col-xl-4">
							<article id="post-<?php the_ID(); ?>" <?php post_class( 'post-format-standard' );?>>
								<div class="blog-single">
									<div class="blog-single-content">
										<div class="post-meta">
											<span class="date"><?php the_time(get_option('date_format')); ?></span>
											<?php
												$categories_list = get_the_category_list(', ');
												if ($categories_list) {
													echo '<span class="cat-links">' . wp_kses_post($categories_list) . '</span>';
												}
											?>
										</div>
										<div class="blog-single-title">
											<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
										</div>
									</div>
									<?php if (has_post_thumbnail()) : ?>
										<div class="blog-single-image">
											<a href="<?php the_permalink() ?>">
												<?php the_post_thumbnail('full', [
													'class' => 'img-responsive',
													'alt'   => esc_attr(get_the_title())
												]); ?>
											</a>
										</div>
									<?php endif; ?>
									<p class="excerpt">
										<?php echo wp_trim_words(get_the_content(), 16, ''); ?>
									</p>
								</div>
							</article>
						</div>
						<?php
						endwhile;

						// Pagination (optional)
						?>
						<?php if ( $query->max_num_pages > 1 ) : ?>
							<div class="blog-pagination">
								<?php
								echo paginate_links([
									'total'   => $query->max_num_pages,
									'current' => $paged,
									'type'    => 'list',
									'prev_next' => false,
								]);
								?>
							</div>
						<?php endif; ?>
						<?php
					
					else :
						echo 'No posts found';
					endif;
					wp_reset_postdata();
					?>
				</div>
			</div>

		<?php elseif ( 'layout-2' === $settings['provix_design_style'] ) : ?>

			<div class="blog-posts style-two">
				<div class="row">
					<?php if ( $query->have_posts() ) : ?>
						<?php
						$i = 0;
						while ( $query->have_posts() ) :
							$query->the_post();
							global $post;
							$category = get_the_terms( $post->ID, 'category' );

							$delay = 100 + ( $i * 500 );
							?>

							<div class="col-md-6 col-lg-4">
								<div class="blog-item wow fadeInUp" data-wow-delay="<?php echo esc_attr( $delay ); ?>ms" data-wow-duration="2000ms">
									<div class="blog-content">
										<div class="post-meta">
											<h6 class="date"><?php echo get_the_date( 'd F, Y' ); ?></h6>
											<?php the_category(); ?>
										</div>
										<a class="title" href="<?php the_permalink(); ?>">
											<?php echo wp_trim_words( get_the_title(), $settings['provix_blog_title_word'], '' ); ?>
										</a>
										<div class="read-more">
											<div class="line"></div>
											<a href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read More' ); ?></a>
										</div>
									</div>
									<div class="blog-image">
										<a href="<?php the_permalink(); ?>">
											<?php if ( has_post_thumbnail( $post->ID ) ) : ?>
												<img src="<?php the_post_thumbnail_url(); ?>" alt="Post image" />
											<?php endif; ?>
										</a>
									</div>
								</div>
							</div>

							<?php
							++$i;
						endwhile;
						wp_reset_postdata();
						?>
					<?php endif; ?>
				</div>
			</div>

		<?php elseif ( 'layout-3' === $settings['provix_design_style'] ) : ?>

			<div class="blog-posts style-three">
				<div class="top-column">
					<?php
					$blog_query_1 = new \WP_Query(
						array(
							'post_type'      => 'post',
							'post_status'    => 'publish',
							'posts_per_page' => 1,
						)
					);
					?>
					<?php if ( $blog_query_1->have_posts() ) : ?>
						<?php
						$i = 0;
						while ( $blog_query_1->have_posts() ) :
							$blog_query_1->the_post();
							global $post;
							$category = get_the_terms( $post->ID, 'category' );

							$delay = 100 + ( $i * 500 );
							?>

							<div class="blog-item wow fadeInUp" data-wow-delay="<?php echo esc_attr( $delay ); ?>ms" data-wow-duration="2000ms">
								<?php if ( has_post_thumbnail( $post->ID ) ) : ?>
									<div class="blog-image">
										<a href="<?php the_permalink(); ?>">
											<img src="<?php the_post_thumbnail_url(); ?>" alt="Post image" />
										</a>
										<?php the_category(); ?>
									</div>
								<?php endif; ?>

								<div class="blog-content">
									<div class="blog-meta">
										<span class="author">
											<i class="fa-light fa-user"></i>
											<?php echo esc_html( get_the_author() ); ?>
										</span>

										<span class="comments">
											<i class="fa-light fa-comments"></i>
											<?php
											printf(
												esc_html__( '%s Comments', 'agenvix-core' ),
												number_format_i18n( get_comments_number() )
											);
											?>
										</span>
									</div>
									<a class="title" href="<?php the_permalink(); ?>">
										<?php echo wp_trim_words( get_the_title(), $settings['provix_blog_title_word'], '' ); ?>
									</a>
									<div class="line"></div>
									<p class="excerpt">
										<?php echo wp_trim_words( get_the_content(), 20, '' ); ?>
									</p>
									<div class="read-more">
										<a href="<?php the_permalink(); ?>">
											<?php esc_html_e( 'Read More' ); ?>
											<i class="fa-light fa-arrow-right"></i>
										</a>
									</div>
								</div>
							</div>

							<?php
							++$i;
						endwhile;
						wp_reset_postdata();
						?>
					<?php endif; ?>
				</div>
				<div class="right-column">
					<div class="row">

						<?php
						$blog_query_2 = new \WP_Query(
							array(
								'post_type'      => 'post',
								'post_status'    => 'publish',
								'posts_per_page' => 3,
								'offset'         => 1,
							)
						);
						?>

						<?php
						while ( $blog_query_2->have_posts() ) :
							$blog_query_2->the_post();
							?>
							<div class="col-md-4">
								<div class="blog-item wow fadeInUp" data-wow-delay="<?php echo esc_attr( $delay ); ?>ms" data-wow-duration="2000ms">
									<div class="blog-image">
										<a href="<?php the_permalink(); ?>">
											<?php if ( has_post_thumbnail( $post->ID ) ) : ?>
												<img src="<?php the_post_thumbnail_url(); ?>" alt="Post image" />
											<?php endif; ?>
										</a>
									</div>
									<div class="blog-content">
										<a class="title" href="<?php the_permalink(); ?>">
											<?php echo wp_trim_words( get_the_title(), $settings['provix_blog_title_word'], '' ); ?>
										</a>
									</div>
								</div>
							</div>
							<?php
						endwhile;
						wp_reset_postdata()
						?>
					</div>
				</div>
			</div>

		<?php elseif ( 'layout-4' === $settings['provix_design_style'] ) : ?>

			<div class="blog-posts style-four">
				<div class="row">
					<?php if ( $query->have_posts() ) : ?>
						<?php
						$i = 0;
						while ( $query->have_posts() ) :
							$query->the_post();
							global $post;
							$category = get_the_terms( $post->ID, 'category' );

							$delay = 100 + ( $i * 500 );
							?>

							<div class="col-md-6 col-lg-4">
								<div class="blog-item wow fadeInUp" data-wow-delay="<?php echo esc_attr( $delay ); ?>ms" data-wow-duration="2000ms">
									<div class="blog-content">
										<div class="post-meta">
											<h6 class="date"><?php echo get_the_date( 'd F, Y' ); ?></h6>
											<div class="line"></div>
											<?php the_category(); ?>
										</div>
										<a class="title" href="<?php the_permalink(); ?>">
											<?php echo wp_trim_words( get_the_title(), $settings['provix_blog_title_word'], '' ); ?>
										</a>
										
									</div>
									<div class="blog-image">
										<a href="<?php the_permalink(); ?>">
											<?php if ( has_post_thumbnail( $post->ID ) ) : ?>
												<img src="<?php the_post_thumbnail_url(); ?>" alt="Post image" />
											<?php endif; ?>
										</a>
									</div>
									<p class="excerpt"><?php echo wp_trim_words( get_the_content(), 16, '' ); ?></p>
									<div class="read-more">
										<a href="<?php the_permalink(); ?>">
											<?php esc_html_e( 'Read More' ); ?>
											<i class="fa-solid fa-circle-arrow-right"></i>
										</a>
									</div>
								</div>
							</div>

							<?php
							++$i;
						endwhile;
						wp_reset_postdata();
						?>
					<?php endif; ?>
				</div>
			</div>

		<?php elseif ( 'layout-5' === $settings['provix_design_style'] ) : ?>

			<div class="blog-posts style-five">
				<div class="row">
					<div class="col-lg-6 first-item">
						<?php
						$blog_query_1 = new \WP_Query(
							array(
								'post_type'      => 'post',
								'post_status'    => 'publish',
								'posts_per_page' => 1,
							)
						);
						?>
						<?php if ( $blog_query_1->have_posts() ) : ?>
							<?php
							$i = 0;
							while ( $blog_query_1->have_posts() ) :
								$blog_query_1->the_post();
								global $post;
								$category = get_the_terms( $post->ID, 'category' );

								$delay = 100 + ( $i * 500 );
								?>

								<div class="blog-item">
									<?php if ( has_post_thumbnail( $post->ID ) ) : ?>
										<div class="blog-image">
											<img src="<?php the_post_thumbnail_url(); ?>" alt="Post image" />
										</div>
									<?php endif; ?>

									<div class="blog-content">
										<div class="date">
											<?php echo get_the_date('F j, Y'); ?>
										</div>
										<div class="text">
											<a class="title" href="<?php the_permalink(); ?>">
												<?php echo wp_trim_words( get_the_title(), $settings['provix_blog_title_word'], '' ); ?>
											</a>
											<div class="read-more">
												<a href="<?php the_permalink(); ?>">
													<?php esc_html_e( 'Read More' ); ?>
													<i class="fa-light fa-arrow-right"></i>
												</a>
											</div>
										</div>
									</div>
								</div>

								<?php
								++$i;
							endwhile;
							wp_reset_postdata();
							?>
						<?php endif; ?>
					</div>
					
					<?php
						$blog_query_2 = new \WP_Query(
							array(
								'post_type'      => 'post',
								'post_status'    => 'publish',
								'posts_per_page' => 2,
								'offset'         => 1,
							)
						);
					?>

					<?php
						while ( $blog_query_2->have_posts() ) :
						$blog_query_2->the_post();
						?>
						<div class="col-md-6 col-lg-3 second-item">
							<div class="blog-item">
								<div class="blog-image">
									<a href="<?php the_permalink(); ?>">
										<?php if ( has_post_thumbnail( $post->ID ) ) : ?>
											<img src="<?php the_post_thumbnail_url(); ?>" alt="Post image" />
										<?php endif; ?>
									</a>
								</div>
								<div class="blog-content">
									<div class="post-meta">
										<div class="date"><?php echo get_the_date('F j, Y'); ?></div>
										<?php the_category(); ?>
									</div>
									<a class="title" href="<?php the_permalink(); ?>">
										<?php echo wp_trim_words( get_the_title(), $settings['provix_blog_title_word'], '' ); ?>
									</a>
									<div class="read-more">
										<a href="<?php the_permalink(); ?>">
											<?php esc_html_e( 'Read More' ); ?>
											<i class="fa-solid fa-arrow-right"></i>
										</a>
									</div>
								</div>
							</div>
						</div>
						<?php
						endwhile;
						wp_reset_postdata()
					?>
					
				</div>
			</div>

		<?php endif; ?>
		<?php
	}
}

$widgets_manager->register( new All_Blog_Post() );
