<?php
namespace BwallCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Bwall Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Bwall_Blog_Post extends Widget_Base {

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
		return __( 'Blog Post', 'bwallcore' );
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
		return 'bwall-icon';
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
		return [ 'bwallcore' ];
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
		return [ 'bwallcore' ];
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
            'bwall_post_',
            [
                'label' => esc_html__('Design Layout', 'bwallcore'),
            ]
        );
        $this->add_control(
            'bwall_design_style',
            [
                'label' => esc_html__('Select Layout', 'bwallcore'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'layout-1' => esc_html__('Layout 1', 'bwallcore'),
                    'layout-2' => esc_html__('Layout 2', 'bwallcore'),
                ],
                'default' => 'layout-1',
            ]
        );
        $this->add_control(
            'bwall_post__height',
            [
                'label' => esc_html__( 'Height', 'bwallcore' ),
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
                    '{{WRAPPER}} .bwall-project-img img' => 'height: {{SIZE}}{{UNIT}};object-fit: cover;',
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
            'bwall_post__pagination',
            [
                'label' => esc_html__( 'Pagination', 'bwallcore' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'bwallcore' ),
                'label_off' => esc_html__( 'Hide', 'bwallcore' ),
                'return_value' => 'yes',
                'default' => 'no',
                'condition' => array(
                    'bwall_design_style' => 'layout-1!',
                ),
            ]
        );

        $this->end_controls_section();
               

        /**
         * Title and content
         */

        $this->start_controls_section(
            'bwall_section_title',
            [
                'label' => esc_html__('Title & Content', 'bwallcore'),
            ]
        );
        $this->add_control(
            'bwall_section_title_show',
            [
                'label' => esc_html__( 'Section Title & Content', 'bwallcore' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'bwallcore' ),
                'label_off' => esc_html__( 'Hide', 'bwallcore' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'bwall_description',
            [
                'label' => esc_html__('Description', 'bwallcore'),
                'description' => bwall_get_allowed_html_desc( 'basic' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Bwall Description', 'bwallcore'),
                'placeholder' => esc_html__('Type Sub Heading Text', 'bwallcore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'bwall_description_color',
            [
                'label' => __( 'Description Color', 'bwallcore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .common-title-container-text p' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_control(
            'bwall_title',
            [
                'label' => esc_html__('Title', 'bwallcore'),
                'description' => bwall_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Bwall Title Here', 'bwallcore'),
                'placeholder' => esc_html__('Type Heading Text', 'bwallcore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'bwall_title_color',
            [
                'label' => __( 'Title Color', 'bwallcore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .common-title h3' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'bwall_title_tag',
            [
                'label' => esc_html__('Title HTML Tag', 'bwallcore'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'h1' => [
                        'title' => esc_html__('H1', 'bwallcore'),
                        'icon' => 'eicon-editor-h1'
                    ],
                    'h2' => [
                        'title' => esc_html__('H2', 'bwallcore'),
                        'icon' => 'eicon-editor-h2'
                    ],
                    'h3' => [
                        'title' => esc_html__('H3', 'bwallcore'),
                        'icon' => 'eicon-editor-h3'
                    ],
                    'h4' => [
                        'title' => esc_html__('H4', 'bwallcore'),
                        'icon' => 'eicon-editor-h4'
                    ],
                    'h5' => [
                        'title' => esc_html__('H5', 'bwallcore'),
                        'icon' => 'eicon-editor-h5'
                    ],
                    'h6' => [
                        'title' => esc_html__('H6', 'bwallcore'),
                        'icon' => 'eicon-editor-h6'
                    ]
                ],
                'default' => 'h2',
                'toggle' => false,
            ]
        );

        $this->add_responsive_control(
            'bwall_align',
            [
                'label' => esc_html__('Alignment', 'bwallcore'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'bwallcore'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'bwallcore'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'bwallcore'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'left',
                'toggle' => false,
                'selectors' => [
                    '{{WRAPPER}} .bwall-sec-box' => 'text-align: {{VALUE}};'
                ]
            ]
        );
        $this->end_controls_section();


        /**
         * Button
         */

        $this->start_controls_section(
            'bwall_btn_button_group',
            [
                'label' => esc_html__('Button', 'bwallcore'),
            ]
        );

        $this->add_control(
            'bwall_button_show',
            [
                'label' => esc_html__( 'Show Button', 'bwallcore' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'bwallcore' ),
                'label_off' => esc_html__( 'Hide', 'bwallcore' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'bwall_btn_text',
            [
                'label' => esc_html__('Button Text', 'bwallcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Button Text', 'bwallcore'),
                'title' => esc_html__('Enter button text', 'bwallcore'),
                'label_block' => true,
                'condition' => [
                    'bwall_button_show' => 'yes',
                    'bwall_design_style' => 'layout-1',
                ],
            ]
        );

        $this->add_control(
            'bwall_all_blog_btn_text',
            [
                'label' => esc_html__('All Blog Button Text', 'bwallcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('All Blog Button Text', 'bwallcore'),
                'title' => esc_html__('Enter all blog button text', 'bwallcore'),
                'label_block' => true,
                'condition' => array(
                    'bwall_button_show' => 'yes',
                ),
            ]
        );
        $this->add_control(
            'bwall_all_blog_btn_link',
            [
                'label' => esc_html__('All Blog Button link', 'bwallcore'),
                'type' => Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => esc_html__('https://your-link.com', 'bwallcore'),
                'show_external' => false,
                'default' => [
                    'url' => '#',
                    'is_external' => true,
                    'nofollow' => true,
                    'custom_attributes' => '',
                ],
                'condition' => array(
                    'bwall_button_show' => 'yes',
                ),
                'label_block' => true,
            ]
        );
        $this->end_controls_section();

        
        /**
         * Blog query section
         */
		$this->start_controls_section(
            'bwall_post_query',
            [
                'label' => esc_html__('Blog Query', 'bwallcore'),
            ]
        );

        $post_type = 'post';
        $taxonomy = 'category';

        $this->add_control(
            'posts_per_page',
            [
                'label' => esc_html__('Posts Per Page', 'bwallcore'),
                'description' => esc_html__('Leave blank or enter -1 for all.', 'bwallcore'),
                'type' => Controls_Manager::NUMBER,
                'default' => '3',
            ]
        );

        $this->add_control(
            'category',
            [
                'label' => esc_html__('Include Categories', 'bwallcore'),
                'description' => esc_html__('Select a category to include or leave blank for all.', 'bwallcore'),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => bwall_get_categories($taxonomy),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'exclude_category',
            [
                'label' => esc_html__('Exclude Categories', 'bwallcore'),
                'description' => esc_html__('Select a category to exclude', 'bwallcore'),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => bwall_get_categories($taxonomy),
                'label_block' => true
            ]
        );

        $this->add_control(
            'post__not_in',
            [
                'label' => esc_html__('Exclude Item', 'bwallcore'),
                'type' => Controls_Manager::SELECT2,
                'options' => bwall_get_all_types_post($post_type),
                'multiple' => true,
                'label_block' => true
            ]
        );

        $this->add_control(
            'offset',
            [
                'label' => esc_html__('Offset', 'bwallcore'),
                'type' => Controls_Manager::NUMBER,
                'default' => '0',
            ]
        );

        $this->add_control(
            'orderby',
            [
                'label' => esc_html__('Order By', 'bwallcore'),
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
                'label' => esc_html__('Order', 'bwallcore'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'asc' 	=> esc_html__( 'Ascending', 'bwallcore' ),
                    'desc' 	=> esc_html__( 'Descending', 'bwallcore' )
                ],
                'default' => 'desc',

            ]
        );
        $this->add_control(
            'ignore_sticky_posts',
            [
                'label' => esc_html__( 'Ignore Sticky Posts', 'bwallcore' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'bwallcore' ),
                'label_off' => esc_html__( 'No', 'bwallcore' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'bwall_blog_title_word',
            [
                'label' => esc_html__('Title Word Count', 'bwallcore'),
                'description' => esc_html__('Set how many word you want to display!', 'bwallcore'),
                'type' => Controls_Manager::NUMBER,
                'default' => '6',
            ]
        );

        $this->add_control(
            'bwall_post_content',
            [
                'label' => __('Content', 'bwallcore'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'bwallcore'),
                'label_off' => __('Hide', 'bwallcore'),
                'return_value' => 'yes',
                'default' => '',
                'condition' => [
                    'bwall_design_style' => 'layout-1',
                ]
            ]
        );

        $this->add_control(
            'bwall_post_content_limit',
            [
                'label' => __('Content Limit', 'bwallcore'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => '14',
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'bwall_post_content' => 'yes',
                    'bwall_design_style' => 'layout-1',
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
				'label' => __( 'Style', 'bwallcore' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'text_transform',
			[
				'label' => __( 'Text Transform', 'bwallcore' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => __( 'None', 'bwallcore' ),
					'uppercase' => __( 'UPPERCASE', 'bwallcore' ),
					'lowercase' => __( 'lowercase', 'bwallcore' ),
					'capitalize' => __( 'Capitalize', 'bwallcore' ),
				],
				'selectors' => [
					'{{WRAPPER}} .title' => 'text-transform: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render the widget oubwallut on the frontend.
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

        $args2 = array(
            'post_type' => 'post',
            'post_status' => 'publish',
            'posts_per_page' => $posts_per_page,
            'orderby' => $orderby,
            'order' => $order,
            'offset' => 1,
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
        $query2 = new \WP_Query($args2); 
        
        ?>

        <?php if ( $settings['bwall_design_style']  == 'layout-2' ):
        ?>
            <!-- blog -->
            <section class="bwall-blog">
                <div class="container">
                    <div class="common-title-container">
                        <div class="common-title">
                            <?php
                            if ( !empty($settings['bwall_title' ]) ) :
                                printf( '<%1$s %2$s>%3$s</%1$s>',
                                    tag_escape( $settings['bwall_title_tag'] ),
                                    $this->get_render_attribute_string( 'title_args' ),
                                    bwall_kses( $settings['bwall_title' ] )
                                    );
                            endif;
                            ?>
                        </div>
                        <div class="common-title-container-text">
                            <?php if ( !empty($settings['bwall_description']) ) : ?>    
                                <p><?php echo bwall_kses( $settings['bwall_description'] ); ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="blog-round-btn">
                            <a href="<?php echo esc_url($settings['bwall_all_blog_btn_link']['url'] ); ?>" class="round-btn">
                                <p><?php echo bwall_kses( $settings['bwall_all_blog_btn_text'] ); ?></p> <i class="icon-arrow-1"></i> <span></span>
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
                                        <a href="<?php the_permalink(); ?>"><?php echo wp_trim_words(get_the_title(), $settings['bwall_blog_title_word'], ''); ?></a>
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

            <!-- blog 2 -->
            <section class="blog-2 bwall-section-wrapper">
                <div class="container">
                    <div class="common-title-container">
                        <div class="common-title">
                            <?php if ( !empty($settings['bwall_title' ]) ) :
                                    printf( '<%1$s %2$s>%3$s</%1$s>',
                                        tag_escape( $settings['bwall_title_tag'] ),
                                        $this->get_render_attribute_string( 'title_args' ),
                                        bwall_kses( $settings['bwall_title' ] )
                                        );
                                endif;
                            ?>
                        </div>
                        <div class="choose-right-round-btn">
                            <?php 
                            if ( ! empty( $settings['bwall_all_blog_btn_link']['url'] ) ) : ?>
                                <a href="<?php echo esc_url($settings['bwall_all_blog_btn_link']['url'] ); ?>" class="round-btn">
                                    <p><?php echo bwall_kses( $settings['bwall_all_blog_btn_text'] ); ?></p> <i class="icon-arrow-1"></i> <span></span>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="blog-list">
                        <ul>
                        <?php if ($query2->have_posts()) : ?>
                            <?php while ($query2->have_posts()) : 
                                $query2->the_post();
                                global $post;
                                ?>
                                <li class="blog-list-container">
                                    <div class="service-list-left">
                                        <div class="blog-list-info">
                                            <h6>Painting</h6>
                                            <p><?php echo get_the_date('M d Y')?></p>
                                        </div>
                                        <div class="blog-list-image">
                                            <?php if (has_post_thumbnail( $post->ID ) ): ?>
                                                <img src="<?php the_post_thumbnail_url( $post->ID, $settings['thumbnail_size'] );?>" alt="Post image"/>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="blog-list-link">
                                        <a href="<?php the_permalink(); ?>"><?php echo wp_trim_words(get_the_title(), $settings['bwall_blog_title_word'], ''); ?></a>
                                    </div>
                                    <div class="blog-list-right">
                                        <a href="<?php the_permalink(); ?>"><i class="fa-sharp fa-regular fa-arrow-up-right"></i></a>
                                    </div>
                                </li>
                            <?php endwhile; wp_reset_query(); ?>
                        <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </section>
            <!-- blog 2 -->
    	<?php endif; ?>
       <?php
	}
}

$widgets_manager->register( new Bwall_Blog_Post() );