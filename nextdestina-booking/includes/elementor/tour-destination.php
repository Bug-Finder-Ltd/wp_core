<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Tour_Destination extends \Elementor\Widget_Base {

	public function get_name() {
		return 'tour_destination';
	}

	public function get_title() {
		return esc_html__( 'Tour Destination', 'nextdestina-booking' );
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
				'min' => -1,
				'max' => 100,
				'step' => 1,
				'default' => 3,
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$term_limit = !empty($settings['item_number']) ? absint($settings['item_number']) : 0;

		$terms = get_terms([
			'taxonomy' => 'destination',
			'number'     => $term_limit,
			'hide_empty' => false
		]);

		?>

        <?php if($settings['nextdestina_design_style'] == "layout-1" ) : ?>

        <div class="tour-destination style-one">
            <div class="container">
                <div class="row">
                    <?php foreach ($terms as $term) {
                        $thumbnail = get_field('my_thumbnail', 'destination_' . $term->term_id);
                        $link = get_term_link($term);
                    ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="popular-single wow fadeInUp" data-wow-delay="100ms">
                            <div class="popular-single-image">
                                <?php if ( ! empty( $thumbnail ) ) : ?>
                                    <img src="<?php echo esc_url( $thumbnail['url'] ); ?>" alt="<?php echo esc_attr( $thumbnail['alt'] ?? esc_html__( 'Thumbnail image', 'nextdestina-booking' ) ); ?>">
                                <?php else : ?>
                                    <img src="<?php echo esc_url( NEXTDESTINA_ADDONS_URL . 'assets/img/image-placeholder.png' ); ?>" alt="<?php esc_attr_e( 'Placeholder image', 'nextdestina-booking' ); ?>">
                                <?php endif; ?>
                            </div>
                            <div class="popular-single-content">
                                <div class="icon">
                                    <i class="fa-thin fa-heart"></i>
                                </div>
                                <div class="popular-single-content-inner">
                                    <div class="popular-single-title">
                                        <a href="<?php echo esc_url($link); ?>"><?php echo esc_html($term->name); ?></a>
                                        <p><?php echo esc_html($term->description); ?></p>
                                    </div>
                                    <div class="popular-single-btn">
                                        <a href="<?php echo esc_url($link); ?>" class="btn-2"><?php esc_html_e('Discover Now', 'nextdestina-booking'); ?><span></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>

        <?php elseif($settings['nextdestina_design_style'] == "layout-2" ) : ?>

        <div class="destination style-two">
            <div class="adventure-container">
                <div class="adventure-carousol">
                    <div class="destination-carousel swiper-container adventure-carousol-container">
                        <div class="swiper-wrapper">
                            <?php foreach ($terms as $term) {
                                $thumbnail = get_field('my_thumbnail', 'destination_' . $term->term_id);
                                $link = get_term_link($term);
                            ?>
                            <div class="swiper-slide">
                                <div class="adventure-carousol-single wow fadeInUp" data-wow-delay="00ms" data-wow-duration="1500ms">
                                    <?php if( !empty($thumbnail['url']) ) : ?>
                                        <div class="adventure-carousol-single-image">
                                            <img src="<?php echo esc_url($thumbnail['url']); ?>" alt="image">
                                        </div>
                                    <?php endif; ?>
                                    <div class="adventure-carousol-single-content">
                                        <a href="<?php echo esc_url($link); ?>"><?php echo esc_html($term->name); ?></a>
                                        <p><?php echo esc_html($term->description); ?></p>
                                        <div class="review">
                                            <p><i class="fa-sharp fa-thin fa-location-dot"></i> <?php esc_html_e('Austria', 'nextdestina-booking'); ?></p>
                                            <p><i class="fa-sharp fa-solid fa-star"></i> <?php esc_html_e('2k reviews', 'nextdestina-booking'); ?></p>
                                        </div>
                                    </div> 
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>

        <?php endif; ?>

		<?php
	}
}
