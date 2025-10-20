<?php
namespace ProtineCore\Widgets;

use Elementor\Controls_Manager;
use \Elementor\Repeater;

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Protine Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Protine_Product_Grid extends \Elementor\Widget_Base {

	public function get_name() {
		return 'protine-product-grid';
	}

	public function get_title() {
		return __( 'Product Grid', 'protinecore' );
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
         * Layout Section
         */
        $this->start_controls_section(
            'protine_layout',
            [
                'label' => esc_html__('Design Layout', 'protinecore'),
            ]
        );
        $this->add_control(
            'protine_design_style',
            [
                'label' => esc_html__('Select Layout', 'protinecore'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'layout-1' => esc_html__('Layout 1', 'protinecore'),
                    'layout-2' => esc_html__('Layout 2', 'protinecore'),
                ],
                'default' => 'layout-1',
            ]
        );

		$this->end_controls_section();
		
		$this->start_controls_section(
			'products_section',
			[
				'label' => __( 'Products', 'protinecore' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'products_per_page',
			[
				'label'   => __( 'Number of Products', 'protinecore' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 4,
			]
		);
		$this->add_control(
			'view_all_btn_text',
			[
				'label' => esc_html__( 'Button text', 'protinecore' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'View All', 'protinecore' ),
				'placeholder' => esc_html__( 'Type your text here', 'protinecore' ),
				'label_block' => true,
			]
		);
		$this->add_control(
			'view_all_btn_link',
			[
				'label' => esc_html__( 'Button Link', 'protinecore' ),
				'type' => \Elementor\Controls_Manager::URL,
				'options' => [ 'url', 'is_external', 'nofollow' ],
				'default' => [
					'url' => '#',
					'is_external' => true,
					'nofollow' => true,
					// 'custom_attributes' => '',
				],
				'label_block' => true,
			]
		);
		$this->end_controls_section();

		/**
		 * Style section
		 */
		$this->start_controls_section(
			'section_style',
			[
				'label' => __( 'Style', 'protinecore' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'text_transform',
			[
				'label' => __( 'Text Transform', 'protinecore' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => __( 'None', 'protinecore' ),
					'uppercase' => __( 'UPPERCASE', 'protinecore' ),
					'lowercase' => __( 'lowercase', 'protinecore' ),
					'capitalize' => __( 'Capitalize', 'protinecore' ),
				],
				'selectors' => [
					'{{WRAPPER}} .title' => 'text-transform: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

        $this->start_controls_section(
            'title_section',
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
                        '{{WRAPPER}} .lists li' => 'color: {{VALUE}}',
                    ],
                ]
            );
            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'title_typography',
                    'selector' => '{{WRAPPER}} .lists li',
                ]
            );
            $this->add_control(
                'title_margin',
                [
                    'label' => esc_html__( 'Margin', 'protinecore' ),
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .lists li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
        $this->end_controls_section();

	}

	/**
	 * Render the widget ouprotineut on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();?>

		<?php if ( $settings['protine_design_style']  == 'layout-1' ): ?>

			<?php

			$args = [
				'post_type'      => 'product',
				'posts_per_page' => $settings['products_per_page'],
			];

	        $loop = new \WP_Query( $args );

	        if ( $loop->have_posts() ) {
	        	?>
				<div class="protine-product-grid style-one">
					<?php
		            while ( $loop->have_posts() ) : $loop->the_post();
		                global $product;
		                ?>
						<div class="product-item">
							<div class="product-image">
								<?php echo woocommerce_get_product_thumbnail( 'product-grid-thumb' ); ?>
							</div>
							<div class="content">
								<div class="top">
									<div class="product-price">
										<?php echo $product->get_price_html(); ?>
									</div>
									<div class="details-btn">
										<a href="<?php the_permalink(); ?>">
											<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
												<path d="M14.6751 0.416992H3.10946C2.9437 0.416992 2.78473 0.48284 2.66752 0.60005C2.5503 0.717261 2.48446 0.876232 2.48446 1.04199C2.48446 1.20775 2.5503 1.36672 2.66752 1.48393C2.78473 1.60114 2.9437 1.66699 3.10946 1.66699H13.4495L0.625082 14.492C0.563088 14.5491 0.513271 14.6181 0.478625 14.6949C0.443979 14.7717 0.425219 14.8547 0.423474 14.9389C0.421729 15.0232 0.437034 15.1069 0.468469 15.185C0.499904 15.2632 0.546821 15.3342 0.606398 15.3938C0.665976 15.4534 0.736985 15.5003 0.815156 15.5317C0.893328 15.5632 0.977049 15.5785 1.06129 15.5767C1.14552 15.575 1.22854 15.5562 1.30534 15.5216C1.38214 15.4869 1.45115 15.4371 1.50821 15.3751L14.3332 2.55012V12.8907C14.3332 13.0565 14.3991 13.2155 14.5163 13.3327C14.6335 13.4499 14.7924 13.5157 14.9582 13.5157C15.124 13.5157 15.2829 13.4499 15.4001 13.3327C15.5174 13.2155 15.5832 13.0565 15.5832 12.8907V1.32574C15.5829 1.08494 15.4871 0.854079 15.3169 0.683744C15.1467 0.51341 14.9159 0.417488 14.6751 0.416992Z" fill="#0A0A0A"/>
											</svg>
										</a>
									</div>
								</div>
								<div class="bottom">
									<h3 class="product-title">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php echo get_the_title(); ?>
                                        </a>
									</h3>
									<div class="product-excerpt">
										<?php echo wp_trim_words( get_the_excerpt(), 8 ); ?>
									</div>
								</div>
							</div>
						</div>
		            <?php endwhile; ?>
				</div>
	            <?php
	        } else {
	            echo __( 'No products found', 'my-elementor-widgets' );
	        }

	        wp_reset_postdata();

			?>

		<?php elseif( $settings['protine_design_style'] == 'layout-2' ) : ?>

			<?php

			$args = [
				'post_type'      => 'product',
				'posts_per_page' => $settings['products_per_page'],
			];

			$loop = new \WP_Query( $args );

			if ( $loop->have_posts() ) {
				?>
				<div class="protine-product-grid style-two">
					<div class="row">
						<div class="col-md-6 col-lg-6">
							<?php
							$i = 0;
							while ( $loop->have_posts() ) : $loop->the_post();
								global $product;
								$i++;

								// First 2 items in left column
								if ( $i <= 2 ) :
									?>
									<div class="product-item item-<?php echo esc_attr( $i ); ?>">
										<div class="cursor">
											<?php esc_html_e( 'View Details', 'protinecore' ); ?>
										</div>
										<div class="product-image">
											<a href="<?php the_permalink(); ?>">
												<?php
												global $product;
												$image_id = get_post_meta($product->get_id(), '_custom_product_image_id', true);
												if ($image_id) {
													echo wp_get_attachment_image($image_id, 'full');
												}
												?>
												<?php //echo woocommerce_get_product_thumbnail( 'product-grid-thumb' ); ?>
											</a>
										</div>
									</div>
								<?php
								endif;
							endwhile;
							?>
							<div class="view-all">
								<a href="<?php echo esc_url($settings['view_all_btn_link']['url']); ?>">
									<?php echo esc_html($settings['view_all_btn_text']); ?>
									<div class="btn-icon">
                                        <span class="icon-first"><i class="pi-medicine"></i></span>
                                        <span class="icon-second"><i class="pi-medicine"></i></span>
                                    </div>
								</a>
							</div>
						</div>
						<div class="col-md-6 col-lg-6">
							<?php
							// Reset loop pointer
							$loop->rewind_posts();
							$i = 0;
							while ( $loop->have_posts() ) : $loop->the_post();
								global $product;
								$i++;

								// Last 2 items in right column
								if ( $i > 2 ) :
									?>
									<div class="product-item item-<?php echo esc_attr( $i ); ?>">
										<div class="cursor">
											<?php esc_html_e( 'View Details', 'protinecore' ); ?>
										</div>
										<div class="product-image">
											<a href="<?php the_permalink(); ?>">
												<?php
												global $product;
												$image_id = get_post_meta($product->get_id(), '_custom_product_image_id', true);
												if ($image_id) {
													echo wp_get_attachment_image($image_id, 'full');
												}
												?>
											</a>
										</div>
									</div>
								<?php
								endif;
							endwhile;
							?>
						</div>
					</div>
				</div>
	            <?php
	        } else {
	            echo __( 'No products found', 'protinecore' );
	        }

	        wp_reset_postdata();

			?>
		<?php endif; ?>

		<?php
	}
}

$widgets_manager->register( new Protine_Product_Grid() );