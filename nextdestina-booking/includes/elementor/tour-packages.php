<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Tour_Packages extends \Elementor\Widget_Base {

	public function get_name() {
		return 'tour_packages';
	}

	public function get_title() {
		return esc_html__( 'Tour Packages', 'nextdestina-booking' );
	}

	public function get_icon() {
		return 'eicon-archive';
	}

	public function get_categories() {
		return [ 'nextdestina-booking-category' ];
	}

	protected function register_controls() {

        $this->start_controls_section(
            'nextdestina_layout',
            [
                'label' => esc_html__('Design Layout', 'nextdestina-booking'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'nextdestina_design_style',
            [
                'label' => esc_html__('Select Layout', 'nextdestina-booking'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'layout-1' => esc_html__('Layout 1', 'nextdestina-booking'),
                    'layout-2' => esc_html__('Layout 2', 'nextdestina-booking'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

		$this->start_controls_section(
			'section_packages',
			[
				'label' => esc_html__( 'Packages', 'nextdestina-booking' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'item_number',
			[
				'label' => esc_html__( 'Number of Item', 'nextdestina-booking' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 100,
				'step' => 1,
				'default' => 3,
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$currency_symbol = apply_filters( 'nextdestina_currency_symbol', '$' );

		$pack_args = array(
			'post_type' => 'tour',
			'post_status' => 'publish',
			'posts_per_page' => $settings['item_number'],
		);
		$pack_query = new \WP_Query($pack_args);
		?>

        <?php if($settings['nextdestina_design_style'] == "layout-1" ) : ?>

        <div class="tour-pack style-one">
            <div class="container">
                <div class="row">
                    <?php if ($pack_query->have_posts()) :
                        while ($pack_query->have_posts()) : $pack_query->the_post();
                        global $post;

                        $location = get_post_meta(get_the_ID(), '_package_location', true);
                        $duration = get_field('duration');
                        $discount = get_field('discount');
                        $price = get_field('price');
                    ?>
                        <div class="col-lg-4 col-md-6">
                            <div class="destination-single wow fadeInUp" data-wow-delay="100ms">
                                <div class="destination-single-image">
                                    <?php the_post_thumbnail();?>
                                </div>
                                <div class="destination-single-content">
                                    <h6><?php echo esc_html($location); ?></h6>
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    <div class="destination-single-review">
                                        <div class="destination-single-review-inner">
                                        	<?php
												$instance = Traveler_Dashboard::get_instance();
                            					$instance->global_functions->render_rating_summary();
                                        	?>

                                            <?php if( !empty($price) ) : ?>
	                                            <div class="destination-single-price">
	                                                <p><?php esc_html_e('Starting From', 'nextdestina-booking'); ?> <span><?php echo esc_html($currency_symbol . $price); ?></span></p>
	                                            </div>
                                        	<?php endif; ?>
                                        </div>
                                        <div class="destination-single-review-inner text-end">
                                            <div class="destination-single-date">
                                                <p><i class="fa-light fa-clock"></i><?php echo esc_html($duration); ?></p>
                                            </div>
                                            <?php if( !empty($discount) ) : ?>
                                                <div class="destination-single-discount">
                                                    <?php echo esc_html($discount); ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; wp_reset_query(); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <?php elseif($settings['nextdestina_design_style'] == "layout-2" ) : ?>

        <?php endif; ?>

		<?php
	}
}
