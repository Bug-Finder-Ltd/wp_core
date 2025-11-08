<?php
namespace ZupetCore\Widgets;

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Zupet Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Zupet_Blog_Post extends \Elementor\Widget_Base {

	public function get_name() {
		return 'blogpost';
	}

	public function get_title() {
		return __( 'Blog Post', 'zupetcore' );
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
         * Layout section
         */
        $this->start_controls_section(
            'zupet_post_',
            [
                'label' => esc_html__('Design Layout', 'zupetcore'),
            ]
        );
        $this->add_control(
            'zupet_design_style',
            [
                'label' => esc_html__('Select Layout', 'zupetcore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'layout-1' => esc_html__('Layout 1', 'zupetcore'),
                    'layout-2' => esc_html__('Layout 2', 'zupetcore'),
                ],
                'default' => 'layout-1',
            ]
        );
        
        $this->end_controls_section();
        
        /**
         * Blog query section
         */
		$this->start_controls_section(
            'zupet_post_query',
            [
                'label' => esc_html__('Blog Query', 'zupetcore'),
            ]
        );

        $post_type = 'post';
        $taxonomy = 'category';

        $this->add_control(
            'posts_per_page',
            [
                'label' => esc_html__('Posts Per Page', 'zupetcore'),
                'description' => esc_html__('Leave blank or enter -1 for all.', 'zupetcore'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => '3',
            ]
        );

        $this->add_control(
            'category',
            [
                'label' => esc_html__('Include Categories', 'zupetcore'),
                'description' => esc_html__('Select a category to include or leave blank for all.', 'zupetcore'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => zupet_get_categories($taxonomy),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'exclude_category',
            [
                'label' => esc_html__('Exclude Categories', 'zupetcore'),
                'description' => esc_html__('Select a category to exclude', 'zupetcore'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => zupet_get_categories($taxonomy),
                'label_block' => true
            ]
        );

        $this->add_control(
            'post__not_in',
            [
                'label' => esc_html__('Exclude Item', 'zupetcore'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'options' => zupet_get_all_types_post($post_type),
                'multiple' => true,
                'label_block' => true
            ]
        );

        $this->add_control(
            'offset',
            [
                'label' => esc_html__('Offset', 'zupetcore'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => '0',
            ]
        );

        $this->add_control(
            'orderby',
            [
                'label' => esc_html__('Order By', 'zupetcore'),
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
                'label' => esc_html__('Order', 'zupetcore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'asc' 	=> esc_html__( 'Ascending', 'zupetcore' ),
                    'desc' 	=> esc_html__( 'Descending', 'zupetcore' )
                ],
                'default' => 'desc',

            ]
        );
        $this->add_control(
            'ignore_sticky_posts',
            [
                'label' => esc_html__( 'Ignore Sticky Posts', 'zupetcore' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'zupetcore' ),
                'label_off' => esc_html__( 'No', 'zupetcore' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'zupet_blog_title_word',
            [
                'label' => esc_html__('Title Word Count', 'zupetcore'),
                'description' => esc_html__('Set how many word you want to display!', 'zupetcore'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => '6',
            ]
        );

        $this->add_control(
            'zupet_post_content',
            [
                'label' => __('Content', 'zupetcore'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'zupetcore'),
                'label_off' => __('Hide', 'zupetcore'),
                'return_value' => 'yes',
                'default' => '',
                'condition' => [
                    'zupet_design_style' => 'layout-1',
                ]
            ]
        );

        $this->add_control(
            'zupet_post_content_limit',
            [
                'label' => __('Content Limit', 'zupetcore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'default' => '14',
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'zupet_post_content' => 'yes',
                    'zupet_design_style' => 'layout-1',
                ]
            ]
        );

        $this->end_controls_section();


        /**
         * Style section
         */
		$this->start_controls_section(
			'date_style',
			[
				'label' => __( 'Date', 'zupetcore' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

            $this->add_responsive_control(
                'date_position',
                [
                    'label' => esc_html__( 'Date Position', 'zupetcore' ),
                    'type' => \Elementor\Controls_Manager::CHOOSE,
                    'options' => [
                        '' => [
                            'title' => esc_html__( 'Top', 'zupetcore' ),
                            'icon' => 'eicon-v-align-top',
                        ],
                        '20px' => [
                            'title' => esc_html__( 'Bottom', 'zupetcore' ),
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
                'label' => esc_html__( 'Title', 'zupetcore' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
            $this->add_control(
                'title_color',
                [
                    'label' => esc_html__( 'Color', 'zupetcore' ),
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
                    'label' => esc_html__( 'Margin', 'zupetcore' ),
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

        <?php if ( $settings['zupet_design_style']  == 'layout-1' ): ?>

            <div class="blog-posts style-one">
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
                                    <a class="title" href="<?php the_permalink(); ?>"><?php echo wp_trim_words(get_the_title(), $settings['zupet_blog_title_word'], ''); ?></a>
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
    
        <?php elseif ( $settings['zupet_design_style']  == 'layout-2' ): ?>

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
            <div class="blog-posts-1">
                <div class="row">
                    <?php if ($query2->have_posts()) : ?>
                        <?php while ($query2->have_posts()) : 
                                $query2->the_post();
                                global $post;
                                ?>
                            <div class="col-md-6 col-lg-4">
                                <div class="blog-container">
                                    <div class="blog-image">
                                        <?php
                                            if (has_post_thumbnail( $post->ID ) ){
                                                the_post_thumbnail();
                                            }
                                        ?>
                                        <span class="date"><?php echo get_the_date('M d Y')?></span>
                                    </div>
                                    <div class="blog-content">
                                        <a class="title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; wp_reset_query(); ?>
                    <?php endif; ?>
                </div>
            </div>

    	<?php endif; ?>
       <?php
	}
}

$widgets_manager->register( new Zupet_Blog_Post() );