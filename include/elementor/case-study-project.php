<?php
namespace RaizenCore\Widgets;

use Elementor\Controls_Manager;
use \Elementor\Repeater;

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Raizen Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Raizen_Case_Study_Project extends \Elementor\Widget_Base {

	public function get_name() {
		return 'case-study-project';
	}

	public function get_title() {
		return __( 'Case Study/Project', 'raizencore' );
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
            'raizen_layout',
            [
                'label' => esc_html__('Design Layout', 'raizencore'),
            ]
        );
        $this->add_control(
            'raizen_design_style',
            [
                'label' => esc_html__('Select Layout', 'raizencore'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'layout-1' => esc_html__('Layout 1', 'raizencore'),
                    'layout-2' => esc_html__('Layout 2', 'raizencore'),
                    'layout-3' => esc_html__('Layout 3', 'raizencore'),
                    'layout-4' => esc_html__('Layout 4', 'raizencore'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        /**
         * Project / Portfolio section
         */
        $this->start_controls_section(
            'raizen_portfolio',
            [
                'label' => esc_html__('Project/Portfolio', 'raizencore'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'number_of_post',
            [
                'label' => esc_html__( 'Posts per page', 'raizencore' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 100,
                'step' => 1,
                'default' => 4,
            ]
        );

        $this->end_controls_section();

        /**
         * Show all button
         */
        $this->start_controls_section(
            'raizen_btn_button_group',
            [
                'label' => esc_html__('Button', 'raizencore'),
            ]
        );

        $this->add_control(
            'raizen_show_all_btn_text',
            [
                'label' => esc_html__('Show All Button Text', 'raizencore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Explore More', 'raizencore'),
                'title' => esc_html__('Enter show all button text here', 'raizencore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'raizen_show_all_btn_link',
            [
                'label' => esc_html__('Show All Button link', 'raizencore'),
                'type' => Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => esc_html__('https://your-link.com', 'raizencore'),
                'show_external' => false,
                'default' => [
                    'url' => '#',
                    'is_external' => true,
                    'nofollow' => true,
                    'custom_attributes' => '',
                ],
            ]
        );

        $this->end_controls_section();

        /**
         * Style section
         */
		$this->start_controls_section(
			'section_style',
			[
				'label' => __( 'Style', 'raizencore' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'text_transform',
			[
				'label' => __( 'Text Transform', 'raizencore' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => __( 'None', 'raizencore' ),
					'uppercase' => __( 'UPPERCASE', 'raizencore' ),
					'lowercase' => __( 'lowercase', 'raizencore' ),
					'capitalize' => __( 'Capitalize', 'raizencore' ),
				],
				'selectors' => [
					'{{WRAPPER}} .title' => 'text-transform: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render the widget ouraizenut on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function render() {
        $settings = $this->get_settings_for_display();

        if ( $settings['raizen_design_style']  == 'layout-1' ):
            $icon_url = PROTINE_ADDONS_URL . 'assets/img/icons/arrow-2.png';
            ?>

            <div class="portfolio-grid style-one">
                
                <?php $query = new \WP_Query( [
                    'post_type'      => 'portfolio',
                    'posts_per_page' => $settings['number_of_post'],
                ] ); ?>
                <?php while ( $query->have_posts() ) : $query->the_post(); ?>
                    
                    <div class="portfolio-item wow fadeInUpBig">
                        <a href="<?php the_permalink(); ?>">
                            <div class="thumbnail">
                                <?php the_post_thumbnail(); ?>
                                
                            
                            <?php $terms = get_the_terms( get_the_ID(), 'portfolio_cat' ); ?>

                            <?php if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) : ?>
                                <ul class="portfolio-categories">
                                    <?php foreach ( $terms as $term ) : ?>
                                        <li><?php echo esc_html( $term->name ); ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                            </div>
                        </a>
                    </div>
                    
                <?php endwhile; wp_reset_query(); ?>
                
                <div class="btn-area">
                <?php if ( ! empty( $settings['raizen_show_all_btn_link']['url'] ) ) : ?>
                    <a href="<?php echo esc_url($settings['raizen_show_all_btn_link']['url'] ); ?>" class="read-more-btn">
                        <img src="<?php echo esc_url($icon_url); ?>" alt="<?php esc_html_e('icon', 'raizencore'); ?>">
                        <?php echo raizen_kses( $settings['raizen_show_all_btn_text'] ); ?>
                    </a>
                <?php endif; ?>
                </div>
            </div>

        <?php elseif ( $settings['raizen_design_style']  == 'layout-2' ):?>

            <div class="portfolio-grid style-two">
                <div class="row">
                    <?php $query = new \WP_Query( [
                        'post_type'      => 'portfolio',
                        'posts_per_page' => $settings['number_of_post'],
                    ] ); ?>
                    <?php while ( $query->have_posts() ) : $query->the_post(); ?>
                    <div class="col-md-6 col-lg-6">
                        <div class="portfolio-item">
                            <div class="thumbnail">
                                <?php
                                    $image_id = get_post_meta(get_the_ID(), '_second_featured_image_id', true);
                                    if ($image_id) {
                                        echo wp_get_attachment_image($image_id, 'full', false, [
                                        'class' => 'portfolio-second-image'
                                        ]);
                                    }
                                ?>
                                <h5 class="title">
                                    <a href="<?php echo esc_url(get_the_permalink()); ?>">
                                        <?php echo get_the_title(); ?>
                                    </a>
                                </h5>
                            </div>
                            <?php $terms = get_the_terms( get_the_ID(), 'portfolio_cat' ); ?>

                            <?php if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) : ?>
                                <ul class="portfolio-categories">
                                    <?php foreach ( $terms as $term ) : ?>
                                        <li><?php echo esc_html( $term->name ); ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endwhile; wp_reset_query(); ?>
                </div>
            </div>

		<?php elseif ( $settings['raizen_design_style']  == 'layout-3' ):?>
    
            <div class="portfolio-grid style-three">
                <div class="row">
                    <?php $query = new \WP_Query( [
                        'post_type'      => 'portfolio',
                        'nopaging'       => true,
                        'posts_per_page' => $settings['number_of_post'],
                    ] ); ?>
                    <?php while ( $query->have_posts() ) : $query->the_post(); ?>
                    <div class="col-lg-6 col-xl-4">
                        <div class="portfolio-item">
                            <div class="thumbnail">
                                <?php the_post_thumbnail(); ?>
                            </div>
                            <h6 class="title">
                                <a href="<?php echo esc_url(get_permalink()); ?>"><?php echo get_the_title(); ?></a>
                            </h6>

                            <?php $terms = get_the_terms( get_the_ID(), 'portfolio_cat' ); ?>

                            <?php if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) : ?>
                                <ul class="portfolio-categories">
                                    <?php foreach ( $terms as $term ) : ?>
                                        <li><?php echo esc_html( $term->name ); ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endwhile; wp_reset_query(); ?>
                </div>
            </div>

        <?php elseif ( $settings['raizen_design_style']  == 'layout-4' ):?>
            
            <div class="portfolio-grid style-four">
                <?php $query = new \WP_Query( [
                    'post_type'      => 'portfolio',
                    'nopaging'       => true,
                    'posts_per_page' => $settings['number_of_post'],
                ] ); ?>
                <?php
                $i = 0;
                while ( $query->have_posts() ) : $query->the_post();
                    $serial = $i + 1;
                ?>
                <div class="portfolio-item">
                    <div class="row">
                        <div class="col-md-12 col-lg-2 col-xl-3">
                            <h6 class="serial"><?php echo '{' . str_pad( esc_html( $serial ), 3, '0', STR_PAD_LEFT ) . '}'; ?></h6>
                        </div>
                        <div class="col-md-12 col-lg-6 col-xl-5">
                            <div class="content">
                                <h4 class="title">
                                    <a href="<?php echo esc_url(get_permalink()); ?>"><?php echo get_the_title(); ?></a>
                                </h4>
                                <p><?php echo wp_trim_words(get_the_content(), 20, ''); ?></p>

                                <?php
                                $tags = get_the_tags();
                                if ( $tags ) {
                                    echo '<ul class="post-tags">';
                                        foreach ( $tags as $tag ) {
                                            echo '<li>' . esc_html( $tag->name ) . '</li>';
                                        }
                                    echo '</ul>';
                                }
                                ?>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-4 col-xl-4">
                            <div class="thumbnail wow rotateInUpLeft">
                                <?php the_post_thumbnail(); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                $i++;
                endwhile; wp_reset_query(); ?>
            </div>
        <?php endif; ?>
        <?php 
	}
}

$widgets_manager->register( new Raizen_Case_Study_Project() );