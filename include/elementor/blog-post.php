<?php
namespace RaizenCore\Widgets;

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Raizen Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Raizen_Blog_Post extends \Elementor\Widget_Base {

	public function get_name() {
		return 'blogpost';
	}

	public function get_title() {
		return __( 'Blog Post', 'raizencore' );
	}

	public function get_icon() {
		return 'raizen-icon';
	}

	public function get_categories() {
		return [ 'raizencore' ];
	}

	public function get_script_depends() {
		return [ 'raizencore' ];
	}

	protected function register_controls() {

        /**
         * Layout section
         */
        $this->start_controls_section(
            'raizen_post_',
            [
                'label' => esc_html__('Design Layout', 'raizencore'),
            ]
        );
        $this->add_control(
            'raizen_design_style',
            [
                'label' => esc_html__('Select Layout', 'raizencore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'layout-1' => esc_html__('Layout 1', 'raizencore'),
                    'layout-2' => esc_html__('Layout 2', 'raizencore'),
                    'layout-3' => esc_html__('Layout 3', 'raizencore'),
                ],
                'default' => 'layout-1',
            ]
        );
        
        $this->end_controls_section();
        
        /**
         * Blog query section
         */
		$this->start_controls_section(
            'raizen_post_query',
            [
                'label' => esc_html__('Blog Query', 'raizencore'),
            ]
        );

        $post_type = 'post';
        $taxonomy = 'category';

        $this->add_control(
            'posts_per_page',
            [
                'label' => esc_html__('Posts Per Page', 'raizencore'),
                'description' => esc_html__('Leave blank or enter -1 for all.', 'raizencore'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => '3',
            ]
        );

        $this->add_control(
            'category',
            [
                'label' => esc_html__('Include Categories', 'raizencore'),
                'description' => esc_html__('Select a category to include or leave blank for all.', 'raizencore'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => raizen_get_categories($taxonomy),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'exclude_category',
            [
                'label' => esc_html__('Exclude Categories', 'raizencore'),
                'description' => esc_html__('Select a category to exclude', 'raizencore'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => raizen_get_categories($taxonomy),
                'label_block' => true
            ]
        );

        $this->add_control(
            'post__not_in',
            [
                'label' => esc_html__('Exclude Item', 'raizencore'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'options' => raizen_get_all_types_post($post_type),
                'multiple' => true,
                'label_block' => true
            ]
        );

        $this->add_control(
            'offset',
            [
                'label' => esc_html__('Offset', 'raizencore'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => '0',
            ]
        );

        $this->add_control(
            'orderby',
            [
                'label' => esc_html__('Order By', 'raizencore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => array(
			        'ID' => 'Post ID',
			        'author' => 'Post Author',
			        'title' => 'Title',
			        'date' => 'Date',
			        'modified' => 'Last Modified Date',
			        'parent' => 'Parent Id',
			        'rand' => 'Random',
			        'comment_count' => 'Comment Count',
			        'menu_order' => 'Menu Order',
			    ),
                'default' => 'date',
            ]
        );

        $this->add_control(
            'order',
            [
                'label' => esc_html__('Order', 'raizencore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'asc' 	=> esc_html__( 'Ascending', 'raizencore' ),
                    'desc' 	=> esc_html__( 'Descending', 'raizencore' )
                ],
                'default' => 'desc',

            ]
        );
        $this->add_control(
            'ignore_sticky_posts',
            [
                'label' => esc_html__( 'Ignore Sticky Posts', 'raizencore' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'raizencore' ),
                'label_off' => esc_html__( 'No', 'raizencore' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'raizen_blog_title_word',
            [
                'label' => esc_html__('Title Word Count', 'raizencore'),
                'description' => esc_html__('Set how many word you want to display!', 'raizencore'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => '6',
            ]
        );

        $this->add_control(
            'raizen_post_content',
            [
                'label' => __('Content', 'raizencore'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'raizencore'),
                'label_off' => __('Hide', 'raizencore'),
                'return_value' => 'yes',
                'default' => '',
                'condition' => [
                    'raizen_design_style' => 'layout-1',
                ]
            ]
        );

        $this->add_control(
            'raizen_post_content_limit',
            [
                'label' => __('Content Limit', 'raizencore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'default' => '14',
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'raizen_post_content' => 'yes',
                    'raizen_design_style' => 'layout-1',
                ]
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'button_section',
            [
                'label' => esc_html__( 'Button', 'raizencore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => esc_html__( 'Text', 'raizencore' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Read More', 'raizencore' ),
                'placeholder' => esc_html__( 'Type your text here', 'raizencore' ),
            ]
        );

        $this->end_controls_section();


        /**
         * Style section
         */
		$this->start_controls_section(
			'date_style',
			[
				'label' => __( 'Date', 'raizencore' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

            $this->add_responsive_control(
                'date_position',
                [
                    'label' => esc_html__( 'Date Position', 'raizencore' ),
                    'type' => \Elementor\Controls_Manager::CHOOSE,
                    'options' => [
                        '' => [
                            'title' => esc_html__( 'Top', 'raizencore' ),
                            'icon' => 'eicon-v-align-top',
                        ],
                        '20px' => [
                            'title' => esc_html__( 'Bottom', 'raizencore' ),
                            'icon' => 'eicon-v-align-bottom',
                        ],
                    ],
                    'default' => '',
                    'toggle' => true,
                    'selectors' => [
                        '{{WRAPPER}} .blog-posts-1 .blog-image .date' => 'top: inherit; bottom: {{VALUE}};',
                    ],
                ]
            );

		$this->end_controls_section();

        $this->start_controls_section(
            'title_style',
            [
                'label' => esc_html__( 'Title', 'raizencore' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
            $this->add_control(
                'title_color',
                [
                    'label' => esc_html__( 'Color', 'raizencore' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .blog-posts-1 .blog-content .title' => 'color: {{VALUE}}',
                    ],
                ]
            );
            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'title_typography',
                    'selector' => '{{WRAPPER}} .blog-posts-1 .blog-content .title',
                ]
            );
            $this->add_control(
                'title_margin',
                [
                    'label' => esc_html__( 'Margin', 'raizencore' ),
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .blog-posts-1 .blog-content .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_controls_section();


	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		if (get_query_var('paged')) {
            $paged = get_query_var('paged');
        } else if (get_query_var('page')) {
            $paged = get_query_var('page');
        } else {
            $paged = 1;
        }

        // include_categories
        $category_list = '';
        if (!empty($settings['category'])) {
            $category_list = implode(", ", $settings['category']);
        }
        $category_list_value = explode(" ", $category_list);

        // exclude_categories
        $exclude_categories = '';
        if(!empty($settings['exclude_category'])){
            $exclude_categories = implode(", ", $settings['exclude_category']);
        }
        $exclude_category_list_value = explode(" ", $exclude_categories);

        $post__not_in = '';
        if (!empty($settings['post__not_in'])) {
            $post__not_in = $settings['post__not_in'];
            $args['post__not_in'] = $post__not_in;
        }
        $posts_per_page = (!empty($settings['posts_per_page'])) ? $settings['posts_per_page'] : '-1';
        $orderby = (!empty($settings['orderby'])) ? $settings['orderby'] : 'post_date';
        $order = (!empty($settings['order'])) ? $settings['order'] : 'desc';
        $offset_value = (!empty($settings['offset'])) ? $settings['offset'] : '0';
        $ignore_sticky_posts = (! empty( $settings['ignore_sticky_posts'] ) && 'yes' == $settings['ignore_sticky_posts']) ? true : false ;


        // number
        $off = (!empty($offset_value)) ? $offset_value : 0;
        $offset = $off + (($paged - 1) * $posts_per_page);
        $p_ids = array();

        // build up the array
        if (!empty($settings['post__not_in'])) {
            foreach ($settings['post__not_in'] as $p_idsn) {
                $p_ids[] = $p_idsn;
            }
        }

        $args = array(
            'post_type' => 'post',
            'post_status' => 'publish',
            'posts_per_page' => $posts_per_page,
            'orderby' => $orderby,
            'order' => $order,
            'offset' => $offset,
            'paged' => $paged,
            'post__not_in' => $p_ids,
            'ignore_sticky_posts' => $ignore_sticky_posts
        );

        // exclude_categories
        if ( !empty($settings['exclude_category'])) {

            // Exclude the correct cats from tax_query
            $args['tax_query'] = array(
                array(
                    'taxonomy'	=> 'category',
                    'field'	 	=> 'slug',
                    'terms'		=> $exclude_category_list_value,
                    'operator'	=> 'NOT IN'
                )
            );

            // Include the correct cats in tax_query
            if ( !empty($settings['category'])) {
                $args['tax_query']['relation'] = 'AND';
                $args['tax_query'][] = array(
                    'taxonomy'	=> 'category',
                    'field'		=> 'slug',
                    'terms'		=> $category_list_value,
                    'operator'	=> 'IN'
                );
            }

        } else {
            // Include the cats from $cat_slugs in tax_query
            if (!empty($settings['category'])) {
                $args['tax_query'][] = [
                    'taxonomy' => 'category',
                    'field' => 'slug',
                    'terms' => $category_list_value,
                ];
            }
        }

        $filter_list = $settings['category'];

        // The Query
        $query = new \WP_Query($args); 
        
        ?>

        <?php if ( $settings['raizen_design_style']  == 'layout-1' ):

            $post_args = array(
                'post_type' => 'post',
                'post_status' => 'publish',
                'posts_per_page' => 3,
            );
            $post_query = new \WP_Query($post_args);
            ?>
            <div class="blog-posts style-one">
                <div class="post-wrapper">
                        <?php if ($post_query->have_posts()) : ?>
                        <?php
                        $i = 0;
                        while ($post_query->have_posts()) : 
                            $post_query->the_post();
                            global $post;
                            $category =  get_the_terms($post->ID, 'category');

                            $delay = 100 + ($i * 400);
                        ?>
                            <div class="blog-item wow fadeInUp" data-wow-delay="<?php echo esc_attr($delay); ?>ms" data-wow-duration="2000ms">
                                <?php if (has_post_thumbnail( $post->ID ) ): ?>
                                    <div class="blog-image">
                                        <a href="<?php the_permalink(); ?>">
                                            <img src="<?php the_post_thumbnail_url();?>" alt="Post image"/>
                                        </a>
                                        <span class="date"><?php echo get_the_date('d F, Y')?></span>
                                    </div>
                                <?php endif; ?>
                                <h6 class="title">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php echo wp_trim_words(get_the_title(), $settings['raizen_blog_title_word'], ''); ?>
                                    </a>
                                </h6>
                            </div>
                        <?php
                        $i++;
                        endwhile; wp_reset_query(); ?>
                    <?php endif; ?>
                </div>
            </div>
    
        <?php elseif ( $settings['raizen_design_style']  == 'layout-2' ): ?>

            <?php
                $args2 = array(
                    'post_type' => 'post',
                    'post_status' => 'publish',
                    'posts_per_page' => $posts_per_page,
                    'orderby' => $orderby,
                    'order' => $order,
                    'paged' => $paged,
                    'post__not_in' => $p_ids,
                    'ignore_sticky_posts' => $ignore_sticky_posts
                );
                $query2 = new \WP_Query($args2);
            ?>
            <div class="blog-posts style-two">
                <?php if ($query2->have_posts()) : ?>
                    <?php while ($query2->have_posts()) : $query2->the_post(); ?>
                        <div class="post-item">
                            <div class="blog-image">
                                <?php 
                                if ( has_post_thumbnail() ) {
                                    the_post_thumbnail( 'full', array(
                                        'alt' => esc_attr( get_the_title() )
                                    ) );
                                }
                                ?>
                            </div>
                            <div class="blog-content">
                                <div class="post-meta">
                                    <div class="category">
                                        <?php
                                            $cats = get_the_category_list( ', ' );
                                            if ( $cats ) {
                                                echo wp_kses_post( $cats );
                                            }
                                        ?>
                                    </div>
                                    <div class="dot"></div>
                                    <span class="date">
                                        <?php echo esc_html( get_the_date( 'M d Y' ) ); ?>
                                    </span>
                                </div>
                                <h6 class="title">
                                    <a href="<?php echo esc_url( get_permalink() ); ?>">
                                        <?php echo esc_html( get_the_title() ); ?>
                                    </a>
                                </h6>
                                <a class="button" href="<?php echo esc_url( get_permalink() ); ?>">
                                    <?php echo esc_html( $settings['button_text'] ); ?>
                                    <span class="btn-icon">
                                        <span class="icon-first">
                                            <i class="fa-thin fa-arrow-right-long"></i>
                                        </span>
                                        <span class="icon-second">
                                            <i class="fa-thin fa-arrow-right-long"></i>
                                        </span>
                                    </span>
                                </a>
                            </div>
                        </div>
                    <?php endwhile; wp_reset_query(); ?>
                <?php endif; ?>
            </div>

        <?php elseif ( $settings['raizen_design_style']  == 'layout-3' ): ?>

            <div class="blog-posts style-three">
                <div class="row">
                        <?php if ($query->have_posts()) : ?>
                        <?php
                        $i = 0;
                        while ($query->have_posts()) : 
                            $query->the_post();
                            global $post;
                            $category =  get_the_terms($post->ID, 'category');

                            $delay = 100 + ($i * 500);
                        ?>
                        
                        <div class="col-md-6 col-lg-4">
                            <div class="blog-item wow fadeInUp" data-wow-delay="<?php echo esc_attr($delay); ?>ms" data-wow-duration="2000ms">
                                <div class="blog-content">
                                    <div class="post-meta">
                                        <h6 class="date"><?php echo get_the_date('d F, Y')?></h6>
                                        <?php the_category(); ?>
                                    </div>
                                    <a class="title" href="<?php the_permalink(); ?>"><?php echo wp_trim_words(get_the_title(), $settings['raizen_blog_title_word'], ''); ?></a>
                                    <div class="read-more">
                                        <div class="line"></div>
                                        <a href="<?php the_permalink(); ?>"><?php esc_html_e('Read More'); ?></a>
                                    </div>
                                </div>
                                <div class="blog-image">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php if (has_post_thumbnail( $post->ID ) ): ?>
                                            <img src="<?php the_post_thumbnail_url();?>" alt="Post image"/>
                                        <?php endif; ?>
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        <?php
                        $i++;
                        endwhile; wp_reset_query(); ?>
                    <?php endif; ?>
                </div>
            </div>

    	<?php endif; ?>
       <?php
	}
}

$widgets_manager->register( new Raizen_Blog_Post() );