<?php
namespace ProtineCore\Widgets;

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Protine Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Protine_Blog_Post extends \Elementor\Widget_Base {

	public function get_name() {
		return 'blogpost';
	}

	public function get_title() {
		return __( 'Blog Post', 'protinecore' );
	}

	public function get_icon() {
		return 'protine-icon';
	}

	public function get_categories() {
		return [ 'protinecore' ];
	}

	public function get_script_depends() {
		return [ 'protinecore' ];
	}

	protected function register_controls() {

        /**
         * Layout section
         */
        $this->start_controls_section(
            'protine_post_',
            [
                'label' => esc_html__('Design Layout', 'protinecore'),
            ]
        );
        $this->add_control(
            'protine_design_style',
            [
                'label' => esc_html__('Select Layout', 'protinecore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'layout-1' => esc_html__('Layout 1', 'protinecore'),
                    'layout-2' => esc_html__('Layout 2', 'protinecore'),
                ],
                'default' => 'layout-1',
            ]
        );
        
        $this->end_controls_section();
        
        /**
         * Blog query section
         */
		$this->start_controls_section(
            'protine_post_query',
            [
                'label' => esc_html__('Blog Query', 'protinecore'),
            ]
        );

        $post_type = 'post';
        $taxonomy = 'category';

        $this->add_control(
            'posts_per_page',
            [
                'label' => esc_html__('Posts Per Page', 'protinecore'),
                'description' => esc_html__('Leave blank or enter -1 for all.', 'protinecore'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => '3',
            ]
        );

        $this->add_control(
            'category',
            [
                'label' => esc_html__('Include Categories', 'protinecore'),
                'description' => esc_html__('Select a category to include or leave blank for all.', 'protinecore'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => protine_get_categories($taxonomy),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'exclude_category',
            [
                'label' => esc_html__('Exclude Categories', 'protinecore'),
                'description' => esc_html__('Select a category to exclude', 'protinecore'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => protine_get_categories($taxonomy),
                'label_block' => true
            ]
        );

        $this->add_control(
            'post__not_in',
            [
                'label' => esc_html__('Exclude Item', 'protinecore'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'options' => protine_get_all_types_post($post_type),
                'multiple' => true,
                'label_block' => true
            ]
        );

        $this->add_control(
            'offset',
            [
                'label' => esc_html__('Offset', 'protinecore'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => '0',
            ]
        );

        $this->add_control(
            'orderby',
            [
                'label' => esc_html__('Order By', 'protinecore'),
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
                'label' => esc_html__('Order', 'protinecore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'asc' 	=> esc_html__( 'Ascending', 'protinecore' ),
                    'desc' 	=> esc_html__( 'Descending', 'protinecore' )
                ],
                'default' => 'desc',

            ]
        );
        $this->add_control(
            'ignore_sticky_posts',
            [
                'label' => esc_html__( 'Ignore Sticky Posts', 'protinecore' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'protinecore' ),
                'label_off' => esc_html__( 'No', 'protinecore' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'protine_blog_title_word',
            [
                'label' => esc_html__('Title Word Count', 'protinecore'),
                'description' => esc_html__('Set how many word you want to display!', 'protinecore'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => '6',
            ]
        );

        $this->add_control(
            'protine_post_content',
            [
                'label' => __('Content', 'protinecore'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'protinecore'),
                'label_off' => __('Hide', 'protinecore'),
                'return_value' => 'yes',
                'default' => '',
                'condition' => [
                    'protine_design_style' => 'layout-1',
                ]
            ]
        );

        $this->add_control(
            'protine_post_content_limit',
            [
                'label' => __('Content Limit', 'protinecore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'default' => '14',
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'protine_post_content' => 'yes',
                    'protine_design_style' => 'layout-1',
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
				'label' => __( 'Date', 'protinecore' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

            $this->add_responsive_control(
                'date_position',
                [
                    'label' => esc_html__( 'Date Position', 'protinecore' ),
                    'type' => \Elementor\Controls_Manager::CHOOSE,
                    'options' => [
                        '' => [
                            'title' => esc_html__( 'Top', 'protinecore' ),
                            'icon' => 'eicon-v-align-top',
                        ],
                        '20px' => [
                            'title' => esc_html__( 'Bottom', 'protinecore' ),
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
                'label' => esc_html__( 'Title', 'protinecore' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
            $this->add_control(
                'title_color',
                [
                    'label' => esc_html__( 'Color', 'protinecore' ),
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
                    'label' => esc_html__( 'Margin', 'protinecore' ),
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

        <?php if ( $settings['protine_design_style']  == 'layout-2' ):
        ?>

            <div class="blog-posts style-two">
                <div class="row">
                        <?php if ($query->have_posts()) : ?>
                        <?php while ($query->have_posts()) : 
                            $query->the_post();
                            global $post;
                            $category =  get_the_terms($post->ID, 'category');
                        ?>
                        
                        <div class="col-md-6 col-lg-6">
                            <div class="blog-item">
                                <div class="blog-image">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php if (has_post_thumbnail( $post->ID ) ): ?>
                                            <img src="<?php the_post_thumbnail_url();?>" alt="Post image"/>
                                        <?php endif; ?>
                                    </a>
                                </div>
                                <div class="blog-content">
                                    <div class="post-meta">
                                        <h6 class="date"><?php echo get_the_date('d F, Y')?></h6>
                                        <span class="seperator"></span>
                                        <?php the_category(); ?>
                                    </div>
                                    <a class="title" href="<?php the_permalink(); ?>"><?php echo wp_trim_words(get_the_title(), $settings['protine_blog_title_word'], ''); ?></a>
                                </div>
                            </div>
                        </div>
                        
                        <?php endwhile; wp_reset_query(); ?>
                    <?php endif; ?>
                </div>
            </div>
    
        <?php else:  ?>

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

$widgets_manager->register( new Protine_Blog_Post() );