<?php
/**
 * The template for displaying all single tour
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package nextdestina-booking
 */

get_header();

$post_id = get_the_ID();
$location = get_post_meta($post_id, '_package_location', true);
$duration = get_field('duration');
$price = get_field('price');
$price_includes = get_field('price_includes');
$price_excludes = get_field('price_excludes');
$tour_type = get_field('tour_type');
$max_user = get_field('max_travelers');
$min_user = get_field('min_travelers');
$start_point = get_field('start_point');
$end_point = get_field('end_point');
$start_time = get_field('start_time');

?>
    <!-- Package details -->

    <section class="blog-details nextdestina-section-wrapper tour-details aaa">
        <div class="container">
            <div class="head">
                <h6 class="title"><?php the_title(); ?></h6>
                <div class="head-meta">
                    <?php
                    global $wpdb;
                    $tour_id = get_the_ID();
                    $table = $wpdb->prefix . 'tour_ratings';

                    // Calculate average and total reviews
                    $average = $wpdb->get_var(
                        $wpdb->prepare("SELECT AVG(rating) FROM $table WHERE tour_id = %d AND status = %s", $tour_id, 'approved')
                    );
                    $count = $wpdb->get_var(
                        $wpdb->prepare("SELECT COUNT(*) FROM $table WHERE tour_id = %d AND status = %s", $tour_id, 'approved')
                    );

                    $average = round((float)$average, 1); // round safely
                    ?>
                    <div class="tour-rating-summary">
                        <div class="rating-stars">
                            <?php
                            for ( $i = 1; $i <= 5; $i++ ) {
                                if ( $average >= $i ) {
                                    echo '<i class="fas fa-star text-warning"></i>';
                                } elseif ( $average >= ($i - 0.5) ) {
                                    echo '<i class="fas fa-star-half-alt text-warning"></i>';
                                } else {
                                    echo '<i class="far fa-star text-warning"></i>';
                                }
                            }
                            ?>
                        </div>
                        <div class="rating-meta">
                            <strong><?php echo esc_html( $average ); ?>/5</strong>
                            <span>(<?php echo intval( $count ); ?> reviews)</span>
                        </div>
                    </div>

                    <?php if($location){
                        echo '<h6 class="location"><i class="fa-regular fa-location-dot"></i>'.esc_html($location).'</h6>';
                    } ?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8">
                    <div class="blog-details-left-container">
                        <div class="package-thumbnail">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('full'); ?>
                            <?php endif; ?>
                        </div>
                        <div class="package-content">
                            <?php the_content(); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-9 col-lg-11">
                            <div class="row">
                                <?php if ( $price_includes ) : ?>
                                <div class="col-lg-6">
                                    <div class="pack-include">
                                        <h5><?php esc_html_e('Price Includes', 'nextdestina-booking'); ?></h5>
                                        <ul>
                                            <?php foreach ( $price_includes as $price_include ) { ?>
                                                <li><i class="fa-light fa-check"></i><?php echo esc_html($price_include) ?></li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                </div>
                                <?php endif; ?>

                                <?php if ( $price_excludes ) : ?>
                                <div class="col-lg-6">
                                    <div class="pack-exclude">
                                        <h5><?php esc_html_e('Price Excludes', 'nextdestina-booking'); ?></h5>
                                        <ul>
                                            <?php foreach ( $price_excludes as $price_exclude ) { ?>
                                                <li><i class="fa-light fa-check"></i><?php echo esc_html($price_exclude) ?></li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                </div>
                                <?php endif; ?>
                            </div>
                            <ul class="pack-meta">
                                <li><i class="fa-thin fa-clock"></i><?php echo esc_html($duration); ?></li>
                                <li><i class="fa-thin fa-user"></i><?php echo esc_html( sprintf( __( 'Max Travelers : %s', 'nextdestina-booking' ), $max_user ) ); ?></li>
                                <li><i class="fa-thin fa-user"></i><?php echo esc_html( sprintf( __( 'Min Travelers : %s', 'nextdestina-booking' ), $min_user ) ); ?></li>
                                <li><i class="fa-thin fa-list"></i><?php echo esc_html( sprintf( __( 'Package Type : %s', 'nextdestina-booking' ), $tour_type ) ); ?></li>
                            </ul>
                        </div>
                    </div>

                    <?php if( !empty($start_point) || !empty($start_time) || !empty($end_point) ) : ?>
                    <div class="meeting-pickup">
                        <h3 class="title"><?php esc_html_e('Meeting And Pickup', 'nextdestina-booking'); ?></h3>
                        <div class="row">
                            <?php if ( $start_point ) : ?>
                                <div class="col-lg-4">
                                    <h6><?php esc_html_e('Start point', 'nextdestina-booking'); ?></h6>
                                    <p><?php echo esc_html($start_point); ?></p>
                                    <a href="#"><?php esc_html_e('Open in Google Maps', 'nextdestina-booking'); ?></a>
                                </div>
                            <?php endif; ?>
                            <?php if ( $start_time ) : ?>
                                <div class="col-lg-4">
                                    <h6><?php esc_html_e('Start time', 'nextdestina-booking'); ?></h6>
                                    <p><?php echo esc_html($start_time); ?></p>
                                </div>
                            <?php endif; ?>
                            <?php if ( $end_point ) : ?>
                                <div class="col-lg-4">
                                    <h6><?php esc_html_e('End point', 'nextdestina-booking'); ?></h6>
                                    <p><?php echo esc_html($end_point); ?></p>
                                    <a href="#"><?php esc_html_e('Open in Google Maps', 'nextdestina-booking'); ?></a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endif; ?>

                </div>

                <?php if ( is_active_sidebar( 'blog-sidebar' ) ): ?>
                    <div class="col-lg-4">
                        <div class="blog-details-right-container">
                            <?php
                            
                            $gallery_image_ids = get_post_meta( get_the_ID(), '_nextdestina_tour_gallery_images', true );

                            // Make sure it's an array of integers
                            if ( ! empty( $gallery_image_ids ) ) {
                                if ( is_string( $gallery_image_ids ) ) {
                                    $gallery_image_ids = explode( ',', $gallery_image_ids );
                                }
                                $gallery_image_ids = array_filter( array_map( 'intval', (array) $gallery_image_ids ) );
                            }

                            if ( ! empty( $gallery_image_ids ) ) : ?>
                                <div class="nextdestina-tour-gallery acf-gallery">
                                    <?php foreach ( $gallery_image_ids as $image_id ) :
                                        // Get image src and alt
                                        $image_src = wp_get_attachment_image_url( $image_id, 'full' );
                                        $image_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
                                        ?>
                                        <?php if ( $image_src ) : ?>
                                            <div class="tour-gallery-item">
                                                <img src="<?php echo esc_url( $image_src ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>" />
                                            </div>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                            <div class="mini-booking-form">
                                <h4 class="price-title"><?php esc_html_e('Price Includes', 'nextdestina-booking'); ?></h4>
                                <p class="price-text">
                                    <i class="fa-thin fa-bag-shopping"></i>
                                    <?php echo esc_html__( 'Start From', 'nextdestina-booking' ) . ' $' . esc_html( $price ); ?>
                                </p>
                                <h6><?php esc_html_e('Booking Form', 'nextdestina-booking'); ?></h6>
                                <form method="get" action="<?php echo is_user_logged_in() ? site_url('/book-tour') : site_url('/traveler-login'); ?>">
                                    <input type="hidden" name="tour_id" value="<?php echo esc_attr( get_the_ID() ); ?>">
                                    <p>
                                        <input class="form-control datepicker" type="text" id="travel_date" name="travel_date" value="<?php echo esc_attr($_GET['travel_date'] ?? ''); ?>" placeholder="Select Date" required>
                                    </p>
                                    <div class="traveler-dropdown-wrapper">
                                        <?php
                                            $adults   = isset($_GET['adults']) ? (int) $_GET['adults'] : 0;
                                            $children = isset($_GET['children']) ? (int) $_GET['children'] : 0;
                                            $infants  = isset($_GET['infants']) ? (int) $_GET['infants'] : 0;
                                            $total    = $adults + $children + $infants;
                                        ?>
                                        <input type="text" id="num_travelers_display" class="form-control" readonly value="<?php echo esc_attr($total . ' Travelers'); ?>" placeholder="Select Travelers">
                                        <div class="traveler-dropdown">
                                            <div class="traveler-row">
                                                <span><?php esc_html_e('Adults', 'nextdestina-booking'); ?></span>
                                                <div class="counter">
                                                    <button type="button" class="minus" data-target="adults">-</button>
                                                    <input type="number" name="adults" id="adults" min="0" value="<?php echo esc_attr($adults); ?>" readonly>
                                                    <button type="button" class="plus" data-target="adults">+</button>
                                                </div>
                                            </div>
                                            <div class="traveler-row">
                                                <span><?php esc_html_e('Children', 'nextdestina-booking'); ?></span>
                                                <div class="counter">
                                                    <button type="button" class="minus" data-target="children">-</button>
                                                    <input type="number" name="children" id="children" min="0" value="<?php echo esc_attr($children); ?>" readonly>
                                                    <button type="button" class="plus" data-target="children">+</button>
                                                </div>
                                            </div>
                                            <div class="traveler-row">
                                                <span><?php esc_html_e('Infants', 'nextdestina-booking'); ?></span>
                                                <div class="counter">
                                                    <button type="button" class="minus" data-target="infants">-</button>
                                                    <input type="number" name="infants" id="infants" min="0" value="<?php echo esc_attr($infants); ?>" readonly>
                                                    <button type="button" class="plus" data-target="infants">+</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <p>
                                        <button type="submit" class="btn-1"><?php esc_html_e('Proceed Booking', 'nextdestina-booking'); ?>
                                            <span></span>
                                        </button>
                                    </p>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endif;?>
                <div class="col-lg-10">
                    <div class="daily-review">
                        <?php
                        // Get reviews
                        $reviews = $wpdb->get_results(
                            $wpdb->prepare(
                                "SELECT * FROM $table WHERE tour_id = %d AND status = %s ORDER BY created_at DESC", $tour_id, 'approved'
                            )
                        );

                        if ( ! empty( $reviews ) ) :
                            ?>
                                <h5 class="review-title"><?php esc_html_e('Reviews', 'nextdestina-booking'); ?></h5>
                            <?php
                            foreach ( $reviews as $review ) :
                                $user = $review->user_id ? get_userdata( $review->user_id ) : null;
                                $name = $user ? $user->display_name : esc_html__('Guest', 'nextdestina-booking');
                                $stars = intval( $review->rating );
                                $text = esc_html($review->review);
                                $user_info = $review->user_id ? get_userdata( $review->user_id ) : null;
                                $formatted_date = date_i18n( get_option('date_format'), strtotime($review->created_at) );
                        ?>
                            <div class="daily-review-box wow fadeInUp">
                                <div class="daily-review-image">
                                    <?php
                                        // Display avatar (defaults to mystery man if none)
                                        if ( $user_info ) {
                                            echo get_avatar( $user_info->ID, 60 );
                                        } else {
                                            echo get_avatar( '', 60 ); // Anonymous or guest fallback
                                        }
                                    ?>
                                </div>
                                <div class="daily-review-info">
                                    <?php echo '<small class="review-date">' . esc_html( $formatted_date ) . '</small>'; ?>
                                    <h6><?php echo esc_html($name); ?></h6>
                                    <?php
                                    echo '<div class="review-stars">';
                                    for ( $i = 1; $i <= 5; $i++ ) {
                                        if ( $i <= $stars ) {
                                            echo '<i class="fas fa-star text-warning"></i>';
                                        } else {
                                            echo '<i class="far fa-star text-warning"></i>';
                                        }
                                    }
                                    echo '</div>';
                                    ?>

                                    <p><?php echo $text; ?></p>
                                </div>
                            </div>
                        <?php
                            endforeach;
                        endif;
                        ?>
                    </div>

                    <?php
                    if ( is_user_logged_in() && current_user_can('traveler') ) :
                        $notice = get_transient('tour_rating_notice_' . get_current_user_id());
                        if ( $notice ) {
                            ?>
                            <div class="alert alert-info" role="alert">
                                <?php echo esc_html($notice); ?>
                            </div>
                            <?php
                            delete_transient('tour_rating_notice_' . get_current_user_id());
                        }
                    ?>
                        <form id="tour-rating-form" method="post">
                            <?php wp_nonce_field('submit_tour_rating', 'tour_rating_nonce'); ?>
                            <input type="hidden" name="tour_id" value="<?php echo get_the_ID(); ?>">
                            <input type="hidden" name="rating" id="rating-value" value="0">

                            <div class="form-group">
                                <h5 class="form-title"><?php esc_html_e('Add your reviews', 'nextdestina-booking'); ?></h5>
                                <div class="star-rating" id="rating-stars">
                                    <?php for ( $i = 1; $i <= 5; $i++ ) : ?>
                                        <span class="star" data-value="<?php echo esc_attr($i); ?>" role="button" aria-label="<?php echo esc_attr($i); ?> star">&#9733;</span>
                                    <?php endfor; ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <textarea name="review" rows="6" placeholder="<?php esc_html_e('Write your reviews', 'nextdestina-booking'); ?>" required><?php echo isset($_POST['review']) ? esc_textarea($_POST['review']) : ''; ?></textarea>
                            </div>

                            <button type="submit" class="btn-1" name="submit_tour_rating">
                                <?php esc_html_e('Submit Rating', 'nextdestina-booking'); ?>
                                <span></span>
                            </button>
                        </form>
                    <?php else : ?>
                        <p><?php esc_html_e('Please log in as a traveler to submit your rating.', 'nextdestina-booking'); ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <?php
    $current_id = get_the_ID();
    $terms = wp_get_post_terms($current_id, 'destination', array('fields' => 'ids'));
    if (!empty($terms)) {
        $related_args = array(
            'post_type' => 'tour',
            'posts_per_page' => 3,
            'post__not_in' => array($current_id),
            'tax_query' => array(
                array(
                    'taxonomy' => 'destination',
                    'field' => 'term_id',
                    'terms' => $terms,
                ),
            ),
        );
        $related_query = new WP_Query($related_args);
    }
    ?>

    <?php if ($related_query->have_posts()) : ?>
        <section class="related-package">
            <div class="container">
                <h3 class="title"><?php echo esc_html_e('Related Tours', 'nextdestina-booking'); ?></h3>
                <div class="row">
                    <?php while ($related_query->have_posts()) : $related_query->the_post();
                        $location = get_field('location');
                        $duration = get_field('duration');
                        $price = get_field('price');
                        $discount = get_field('discount');
                    ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="destination-single wow fadeInUp" data-wow-delay="100ms">
                            <div class="destination-single-image">
                                <?php if (has_post_thumbnail()) {
                                    the_post_thumbnail();
                                } ?>
                            </div>
                            <div class="destination-single-content">
                                <h6><?php echo esc_html($location); ?></h6>
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                <div class="destination-single-review">
                                    <div class="destination-single-review-inner">
                                        <?php
                                            if ( class_exists( 'Traveler_Dashboard' ) ) {
                                                $instance = Traveler_Dashboard::get_instance();
                                                $instance->global_functions->render_rating_summary();
                                            }
                                        ?>
                                        <div class="destination-single-price">
                                            <p><?php echo esc_html_e('Starting From', 'nextdestina-booking'); ?> <span><?php echo esc_html( sprintf( __( '$%s', 'nextdestina-booking' ), $price ) ); ?></span></p>
                                        </div>
                                    </div>
                                    <div class="destination-single-review-inner text-end">
                                        <div class="package-duration">
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
                    <?php endwhile; wp_reset_postdata(); ?>
                </div>
            </div>
        </section>

    <?php endif; ?>

<?php
get_footer();
