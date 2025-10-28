<?php
namespace NextdestinaCore\Widgets;

use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Nextdestina Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Nextdestina_Blog_Post extends \Elementor\Widget_Base {

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
		return 'blogpost';
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
		return __( 'Blog Post', 'nextdestinacore' );
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
         * Layout section
         */
        $this->start_controls_section(
            'nextdestina_post_',
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
        $this->add_control(
            'nextdestina_post__height',
            [
                'label' => esc_html__( 'Height', 'nextdestinacore' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .nextdestina-project-img img' => 'height: {{SIZE}}{{UNIT}};object-fit: cover;',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'exclude' => ['custom'],
            ]
        );
        $this->add_control(
            'nextdestina_post__pagination',
            [
                'label' => esc_html__( 'Pagination', 'nextdestinacore' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'nextdestinacore' ),
                'label_off' => esc_html__( 'Hide', 'nextdestinacore' ),
                'return_value' => 'yes',
                'default' => 'no',
                'condition' => array(
                    'nextdestina_design_style' => 'layout-1!',
                ),
            ]
        );

        $this->end_controls_section();

        /**
         * Button
         */

        $this->start_controls_section(
            'nextdestina_btn_button_group',
            [
                'label' => esc_html__('Button', 'nextdestinacore'),
            ]
        );

        $this->add_control(
            'nextdestina_button_show',
            [
                'label' => esc_html__( 'Show Button', 'nextdestinacore' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'nextdestinacore' ),
                'label_off' => esc_html__( 'Hide', 'nextdestinacore' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'nextdestina_btn_text',
            [
                'label' => esc_html__('Button Text', 'nextdestinacore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Button Text', 'nextdestinacore'),
                'title' => esc_html__('Enter button text', 'nextdestinacore'),
                'label_block' => true,
                'condition' => [
                    'nextdestina_button_show' => 'yes',
                    'nextdestina_design_style' => 'layout-1',
                ],
            ]
        );

        $this->add_control(
            'nextdestina_all_blog_btn_text',
            [
                'label' => esc_html__('All Blog Button Text', 'nextdestinacore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('All Blog Button Text', 'nextdestinacore'),
                'title' => esc_html__('Enter all blog button text', 'nextdestinacore'),
                'label_block' => true,
                'condition' => array(
                    'nextdestina_button_show' => 'yes',
                ),
            ]
        );
        $this->add_control(
            'nextdestina_all_blog_btn_link',
            [
                'label' => esc_html__('All Blog Button link', 'nextdestinacore'),
                'type' => Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => esc_html__('https://your-link.com', 'nextdestinacore'),
                'show_external' => false,
                'default' => [
                    'url' => '#',
                    'is_external' => true,
                    'nofollow' => true,
                    'custom_attributes' => '',
                ],
                'condition' => array(
                    'nextdestina_button_show' => 'yes',
                ),
                'label_block' => true,
            ]
        );
        $this->end_controls_section();

        
        /**
         * Blog query section
         */
		$this->start_controls_section(
            'nextdestina_post_query',
            [
                'label' => esc_html__('Blog Query', 'nextdestinacore'),
            ]
        );

        $post_type = 'post';
        $taxonomy = 'category';

        $this->add_control(
            'posts_per_page',
            [
                'label' => esc_html__('Posts Per Page', 'nextdestinacore'),
                'description' => esc_html__('Leave blank or enter -1 for all.', 'nextdestinacore'),
                'type' => Controls_Manager::NUMBER,
                'default' => '4',
            ]
        );

        $this->add_control(
            'category',
            [
                'label' => esc_html__('Include Categories', 'nextdestinacore'),
                'description' => esc_html__('Select a category to include or leave blank for all.', 'nextdestinacore'),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => nextdestina_get_categories($taxonomy),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'exclude_category',
            [
                'label' => esc_html__('Exclude Categories', 'nextdestinacore'),
                'description' => esc_html__('Select a category to exclude', 'nextdestinacore'),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => nextdestina_get_categories($taxonomy),
                'label_block' => true
            ]
        );

        $this->add_control(
            'post__not_in',
            [
                'label' => esc_html__('Exclude Item', 'nextdestinacore'),
                'type' => Controls_Manager::SELECT2,
                'options' => nextdestina_get_all_types_post($post_type),
                'multiple' => true,
                'label_block' => true
            ]
        );

        $this->add_control(
            'offset',
            [
                'label' => esc_html__('Offset', 'nextdestinacore'),
                'type' => Controls_Manager::NUMBER,
                'default' => '0',
            ]
        );

        $this->add_control(
            'orderby',
            [
                'label' => esc_html__('Order By', 'nextdestinacore'),
                'type' => Controls_Manager::SELECT,
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
                'label' => esc_html__('Order', 'nextdestinacore'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'asc' 	=> esc_html__( 'Ascending', 'nextdestinacore' ),
                    'desc' 	=> esc_html__( 'Descending', 'nextdestinacore' )
                ],
                'default' => 'desc',

            ]
        );
        $this->add_control(
            'ignore_sticky_posts',
            [
                'label' => esc_html__( 'Ignore Sticky Posts', 'nextdestinacore' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'nextdestinacore' ),
                'label_off' => esc_html__( 'No', 'nextdestinacore' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'nextdestina_blog_title_word',
            [
                'label' => esc_html__('Title Word Count', 'nextdestinacore'),
                'description' => esc_html__('Set how many word you want to display!', 'nextdestinacore'),
                'type' => Controls_Manager::NUMBER,
                'default' => '6',
            ]
        );

        $this->add_control(
            'nextdestina_post_content',
            [
                'label' => __('Content', 'nextdestinacore'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'nextdestinacore'),
                'label_off' => __('Hide', 'nextdestinacore'),
                'return_value' => 'yes',
                'default' => '',
                'condition' => [
                    'nextdestina_design_style' => 'layout-1',
                ]
            ]
        );

        $this->add_control(
            'nextdestina_post_content_limit',
            [
                'label' => __('Content Limit', 'nextdestinacore'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => '14',
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'nextdestina_post_content' => 'yes',
                    'nextdestina_design_style' => 'layout-1',
                ]
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

        <?php if ( $settings['nextdestina_design_style']  == 'layout-2' ):
        ?>
            <!-- blog -->
            <section class="nextdestina-blog">
                <div class="container">
                    <div class="common-title-container">
                        <div class="blog-round-btn">
                            <a href="<?php echo esc_url($settings['nextdestina_all_blog_btn_link']['url'] ); ?>" class="round-btn">
                                <p><?php echo nextdestina_kses( $settings['nextdestina_all_blog_btn_text'] ); ?></p> <i class="icon-arrow-1"></i> <span></span>
                            </a>
                        </div>
                    </div>
                    <div class="row">
                    
                        <?php if ($query->have_posts()) : ?>
                        <?php while ($query->have_posts()) : 
                            $query->the_post();
                            global $post;
                            $category =  get_the_terms($post->ID, 'category');
                        ?>
                        
                        <div class="col-lg-4">
                            <div class="blog-single">
                                <div class="blog-single-content blog-single-content-two">
                                    <div class="blog-single-info">
                                        <p>Wallpaper</p>
                                        <h6><?php echo get_the_date('M d Y')?></h6>
                                    </div>
                                    <div class="blog-single-title">
                                        <a href="<?php the_permalink(); ?>"><?php echo wp_trim_words(get_the_title(), $settings['nextdestina_blog_title_word'], ''); ?></a>
                                    </div>
                                </div>
                                <div class="blog-single-image blog-single-image-two">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php if (has_post_thumbnail( $post->ID ) ): ?>
                                            <img src="<?php the_post_thumbnail_url( $post->ID, $settings['thumbnail_size'] );?>" alt="Post image"/>
                                        <?php endif; ?>
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        <?php endwhile; wp_reset_query(); ?>
                    <?php endif; ?>

                    </div>
                </div>
            </section>
            <!-- blog -->
    
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
                            <div class="col-lg-6 col-md-6">
                                <div class="blog-container wow fadeInLeft" data-wow-delay="100ms">
                                    <div class="blog-image">
                                        <?php if (has_post_thumbnail( $post->ID ) ): ?>
                                            <img src="<?php the_post_thumbnail_url( $post->ID, $settings['thumbnail_size'] );?>" alt="Post image"/>
                                        <?php endif; ?>
                                    </div>
                                    <div class="blog-content">
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                        <p><?php echo wp_trim_words(get_the_excerpt(), 15); ?></p>
                                        <div class="blog-info">
                                            <div class="blog-member">
                                                <div class="image">
                                                    <?php echo get_avatar( get_the_author_meta( 'ID' ), 33 ); ?>
                                                </div>
                                                <span><?php the_author(); ?></span>
                                            </div>
                                            <div class="blog-time"><i class="fa-light fa-calendar-days"></i><?php echo get_the_date('d M, Y')?></div>
                                        </div>
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

$widgets_manager->register( new Nextdestina_Blog_Post() );