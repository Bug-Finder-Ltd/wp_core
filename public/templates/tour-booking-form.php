<?php

if (!is_user_logged_in()) {
    wp_redirect( esc_url( wp_login_url($_SERVER['REQUEST_URI']) ) );
    exit;
}

get_header();

$tour_id     = filter_input(INPUT_GET, 'tour_id', FILTER_VALIDATE_INT) ?: 0;
$travel_date_raw = filter_input(INPUT_GET, 'travel_date', FILTER_UNSAFE_RAW);
$travel_date     = $travel_date_raw ? sanitize_text_field($travel_date_raw) : '';
$adults      = filter_input(INPUT_GET, 'adults', FILTER_VALIDATE_INT) ?: 0;
$children    = filter_input(INPUT_GET, 'children', FILTER_VALIDATE_INT) ?: 0;
$infants     = filter_input(INPUT_GET, 'infants', FILTER_VALIDATE_INT) ?: 0;

$num_travelers    = $adults + $children + $infants;

$price_per_person = get_field('price', $tour_id);
$total_price = $price_per_person * $num_travelers;

if ($tour_id && get_post_status($tour_id)) {
    $tour_title = get_the_title($tour_id);
    $location = get_post_meta($tour_id, '_package_location', true);
    $tour_type  = get_field('tour_type', $tour_id);
    $duration   = get_field('duration', $tour_id);
} else {
    wp_die(__('Invalid Tour ID', 'nextdestina-booking'));
}

/**
 * Query paypal client id
 */

$paypal_query = new WP_Query([
    'post_type'      => 'payment_method',
    'title'          => 'PayPal',
    'post_status'    => 'publish',
    'posts_per_page' => 1,
]);

if (!$paypal_query->have_posts()) {
    return false;
}

$paypal_post = $paypal_query->posts[0];
$post_id = $paypal_post->ID;

$paypal_client_id = get_post_meta($post_id, '_paypal_client_id', true);

?>

<?php
/**
 * Breadcrumb
 */
$_id = get_the_ID();
$breadcrumb_switch = get_theme_mod( 'breadcrumb_switch', true );
$nextdestina_breadcumb_static_bg = get_template_directory_uri() . '/assets/img/banner/common-banner-bg.jpg';
$nextdestina_breadcumb_from_customizer = get_theme_mod( 'breadcrumb_bg_img', $nextdestina_breadcumb_static_bg );
$bg_img_from_page = function_exists('get_field') ? get_field('breadcrumb_background_image',$_id) : '';
$bg_img = !empty($bg_img_from_page['url']) ? $bg_img_from_page['url'] : $nextdestina_breadcumb_from_customizer;
$hide_bg_img = function_exists('get_field') ? get_field('hide_breadcrumb_background_image',$_id) : '';

if ( $hide_bg_img ) {
    $bg_img = '';
} else {
    $bg_img = !empty( $bg_img_from_page ) ? $bg_img_from_page['url'] : $bg_img;
}

    if ( get_query_var('nextdestina_booking_page') === '1' ) {
        $title = esc_html__('Confirmation', 'nextdestina-booking');
    }
?>

    <?php if(!empty($breadcrumb_switch)) : ?>
        <section class="common-banner">
            <div class="bg-layer" style="background: url(<?php print esc_attr($bg_img);?>);"></div>
            <div class="common-banner-content">
                <div class="common-banner-content-inner">
                    <h2><?php echo nextdestina_kses( $title ?? '' ); ?></h2>
                    <div class="common-banner-btn">
                        <?php echo esc_html($tour_title); ?>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>

<div class="main-booking">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <script src="https://js.stripe.com/v3/"></script>
                <script src="https://www.paypal.com/sdk/js?client-id=<?php echo esc_attr($paypal_client_id); ?>&currency=USD"></script>
                <form method="post" id="booking-form">
                    <?php wp_nonce_field('submit_tour_booking', 'tour_booking_nonce'); ?>

                    <div id="step-1">
                        <div class="head">
                            <h5><?php esc_html_e('Step 1: Contact Info', 'nextdestina-booking') ?></h5>
                        </div>
                        <div class="body">
                            <div class="row">
                                <?php
                                $current_user = wp_get_current_user();
                                $first_name   = get_user_meta($current_user->ID, 'first_name', true);
                                $last_name    = get_user_meta($current_user->ID, 'last_name', true);
                                $phone        = get_user_meta($current_user->ID, 'phone', true);
                                $address_1    = get_user_meta($current_user->ID, 'address', true);
                                $state        = get_user_meta($current_user->ID, 'state', true);
                                $zip          = get_user_meta($current_user->ID, 'zipcode', true);
                                $country      = get_user_meta($current_user->ID, 'country', true);
                                ?>
                                <div class="col-lg-6">
                                    <label><?php esc_html_e('First Name*', 'nextdestina-booking') ?></label>
                                    <input class="form-control" type="text" name="first_name" value="<?php echo esc_attr($first_name); ?>" required>
                                </div>
                                <div class="col-lg-6">
                                    <label><?php esc_html_e('Last Name*', 'nextdestina-booking') ?></label><br>
                                    <input class="form-control" type="text" name="last_name" value="<?php echo esc_attr($last_name); ?>" required>
                                </div>
                                <div class="col-lg-6">
                                    <label><?php esc_html_e('Email*', 'nextdestina-booking') ?></label><br>
                                    <input class="form-control" type="email" name="email" value="<?php echo esc_attr($current_user->user_email); ?>" required>
                                </div>
                                <div class="col-lg-6">
                                    <label><?php esc_html_e('Phone*', 'nextdestina-booking') ?></label><br>
                                    <input class="form-control" type="text" name="phone" value="<?php echo esc_attr($phone); ?>" required>
                                </div>
                                <div class="col-lg-6">
                                    <label><?php esc_html_e('Address Line 1*', 'nextdestina-booking') ?></label><br>
                                    <input class="form-control" type="text" name="address_1" value="<?php echo esc_attr($address_1); ?>" required>
                                </div>
                                <div class="col-lg-6">
                                    <label><?php esc_html_e('Address Line 2', 'nextdestina-booking') ?></label><br>
                                    <input class="form-control" type="text" name="address_2">
                                </div>
                                <div class="col-lg-6">
                                    <label><?php esc_html_e('City*', 'nextdestina-booking') ?></label><br>
                                    <input class="form-control" type="text" name="city" required>
                                </div>
                                <div class="col-lg-6">
                                    <label><?php esc_html_e('State / Province / Region', 'nextdestina-booking') ?></label><br>
                                    <input class="form-control" type="text" name="state" value="<?php echo esc_attr($state); ?>">
                                </div>
                                <div class="col-lg-6">
                                    <label><?php esc_html_e('ZIP / Postal Code*', 'nextdestina-booking') ?></label><br>
                                    <input class="form-control" type="text" name="zip" value="<?php echo esc_attr($zip); ?>" required>
                                </div>
                                <div class="col-lg-6">
                                    <label><?php esc_html_e('Country*', 'nextdestina-booking') ?></label><br>
                                    <input class="form-control" type="text" name="country" value="<?php echo esc_attr($country); ?>" required>
                                </div>
                                <div class="col-lg-12">
                                    <label><?php esc_html_e('Message', 'nextdestina-booking') ?></label><br>
                                    <textarea class="form-control" name="message" rows="5"></textarea>
                                </div>
                                <div class="col-lg-12">
                                    <button type="button" id="next-step"><?php esc_html_e('Next', 'nextdestina-booking') ?><i class="fa-regular fa-arrow-right"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="step1-summary" class="step-summary" style="display:none;">
                        <div class="head">
                            <h5><?php esc_html_e('Your Contact Info', 'nextdestina-booking'); ?></h5>
                            <button type="button" id="edit-step-1">
                                <?php esc_html_e('Edit', 'nextdestina-booking'); ?>
                            </button>
                        </div>
                        <div class="body">
                            <p><strong><?php esc_html_e('Name:', 'nextdestina-booking'); ?></strong> <span id="summary-name"></span></p>
                            <p><strong><?php esc_html_e('Email:', 'nextdestina-booking'); ?></strong> <span id="summary-email"></span></p>
                            <p><strong><?php esc_html_e('Phone:', 'nextdestina-booking'); ?></strong> <span id="summary-phone"></span></p>
                        </div>
                    </div>

                    <div id="step-2" style="display:none;">
                        <input type="hidden" name="tour_id" value="<?php echo esc_attr($tour_id); ?>">
                        <input type="hidden" name="travel_date" value="<?php echo esc_attr($travel_date); ?>">
                        <input type="hidden" name="num_travelers" value="<?php echo esc_attr($num_travelers); ?>">
                        <input type="hidden" name="price_per_person" value="<?php echo esc_attr($price_per_person); ?>">
                        <input type="hidden" name="total_price" value="<?php echo esc_attr($total_price); ?>">

                        <input type="hidden" name="adults" value="<?php echo esc_attr($adults); ?>">
                        <input type="hidden" name="children" value="<?php echo esc_attr($children); ?>">
                        <input type="hidden" name="infants" value="<?php echo esc_attr($infants); ?>">

                        <div class="head">
                            <h5><?php esc_html_e('Step 2: Traveler Information', 'nextdestina-booking') ?></h5>
                        </div>
                        <div class="body">
                            <?php
                            $traveler_index = 1;

                            // Loop through adults
                            for ($i = 1; $i <= $adults; $i++, $traveler_index++) :
                            ?>
                                <fieldset>
                                    <legend><?php esc_html_e('Adult', 'nextdestina-booking'); ?> <?php echo esc_html($i); ?></legend>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <label><?php esc_html_e('First Name*', 'nextdestina-booking') ?></label>
                                            <input class="form-control" type="text" name="travelers[<?php echo $traveler_index; ?>][first_name]" required>
                                        </div>
                                        <div class="col-lg-6">
                                            <label><?php esc_html_e('Last Name*', 'nextdestina-booking') ?></label>
                                            <input class="form-control" type="text" name="travelers[<?php echo $traveler_index; ?>][last_name]" required>
                                        </div>
                                        <div class="col-lg-6">
                                            <label><?php esc_html_e('Date of Birth*', 'nextdestina-booking') ?></label>
                                            <input class="form-control dob-datepicker" type="text" name="travelers[<?php echo $traveler_index; ?>][dob]" required>
                                        </div>
                                        <input type="hidden" name="travelers[<?php echo $traveler_index; ?>][type]" value="adult">
                                    </div>
                                </fieldset>
                            <?php endfor; ?>

                            <?php
                            // Loop through children
                            for ($i = 1; $i <= $children; $i++, $traveler_index++) :
                            ?>
                                <fieldset>
                                    <legend><?php esc_html_e('Child', 'nextdestina-booking'); ?> <?php echo esc_html($i); ?></legend>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <label><?php esc_html_e('First Name*', 'nextdestina-booking') ?></label>
                                            <input class="form-control" type="text" name="travelers[<?php echo $traveler_index; ?>][first_name]" required>
                                        </div>
                                        <div class="col-lg-6">
                                            <label><?php esc_html_e('Last Name*', 'nextdestina-booking') ?></label>
                                            <input class="form-control" type="text" name="travelers[<?php echo $traveler_index; ?>][last_name]" required>
                                        </div>
                                        <div class="col-lg-6">
                                            <label><?php esc_html_e('Date of Birth*', 'nextdestina-booking') ?></label>
                                            <input class="form-control dob-datepicker" type="text" name="travelers[<?php echo $traveler_index; ?>][dob]" required>
                                        </div>
                                        <input type="hidden" name="travelers[<?php echo $traveler_index; ?>][type]" value="child">
                                    </div>
                                </fieldset>
                            <?php endfor; ?>

                            <?php
                            // Loop through infants
                            for ($i = 1; $i <= $infants; $i++, $traveler_index++) :
                            ?>
                                <fieldset>
                                    <legend><?php esc_html_e('Infant', 'nextdestina-booking'); ?> <?php echo esc_html($i); ?></legend>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <label><?php esc_html_e('First Name*', 'nextdestina-booking') ?></label>
                                            <input class="form-control" type="text" name="travelers[<?php echo $traveler_index; ?>][first_name]" required>
                                        </div>
                                        <div class="col-lg-6">
                                            <label><?php esc_html_e('Last Name*', 'nextdestina-booking') ?></label>
                                            <input class="form-control" type="text" name="travelers[<?php echo $traveler_index; ?>][last_name]" required>
                                        </div>
                                        <div class="col-lg-6">
                                            <label><?php esc_html_e('Date of Birth*', 'nextdestina-booking') ?></label>
                                            <input class="form-control dob-datepicker" type="text" name="travelers[<?php echo $traveler_index; ?>][dob]" required>
                                        </div>
                                        <input type="hidden" name="travelers[<?php echo $traveler_index; ?>][type]" value="infant">
                                    </div>
                                </fieldset>
                            <?php endfor; ?>
                            <p>
                                <button type="button" id="next-step-2"><?php esc_html_e('Next', 'nextdestina-booking') ?><i class="fa-regular fa-arrow-right"></i></button>
                            </p>
                        </div>
                    </div>

                    <div id="step2-summary" class="step-summary" style="display:none;">
                        <div class="head">
                            <h5><?php esc_html_e('Traveler Information', 'nextdestina-booking'); ?></h5>
                            <button type="button" id="edit-step-2"><?php esc_html_e('Edit', 'nextdestina-booking'); ?></button>
                        </div>
                    </div>

                    <div id="step-3" style="display:none;">
                        <div class="head">
                            <h5><?php esc_html_e('Step 3: Payment', 'nextdestina-booking') ?></h5>
                        </div>
                        <div class="body">
                            <div class="payment-methods">
                                <ul>
                                    <?php
                                    $payment_query = new WP_Query([
                                        'post_type'      => 'payment_method',
                                        'post_status'    => 'publish',
                                        'posts_per_page' => -1,
                                        'meta_query'     => [
                                            [
                                                'key'     => '_payment_enabled',
                                                'value'   => '1',
                                                'compare' => '='
                                            ]
                                        ]
                                    ]);

                                    if ($payment_query->have_posts()) :
                                        $first = true;
                                        while ($payment_query->have_posts()) : $payment_query->the_post();
                                            $id          = get_the_ID();
                                            $method_slug = sanitize_title(get_the_title());
                                            $logo        = get_post_meta($id, '_payment_logo', true);
                                            $description = get_post_meta($id, '_payment_description', true);
                                    ?>
                                        <li>
                                            <label for="payment_<?php echo esc_attr($method_slug); ?>">
                                                <span class="image-area">
                                                    <?php if ($logo): ?>
                                                        <img src="<?php echo esc_url($logo); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" />
                                                    <?php endif; ?>
                                                </span>
                                                <span class="content-area">
                                                    <h5><?php echo esc_html(get_the_title()); ?></h5>
                                                    <p><?php echo esc_html($description); ?></p>
                                                </span>
                                            </label>
                                            <input
                                                type="radio"
                                                id="payment_<?php echo esc_attr($method_slug); ?>"
                                                name="payment_method"
                                                value="<?php echo esc_attr($method_slug); ?>"
                                                <?php checked($first); ?>>
                                        </li>
                                    <?php
                                            $first = false;
                                        endwhile;
                                        wp_reset_postdata();
                                    endif;
                                    ?>
                                </ul>

                                <div class="payment-extra-fields-wrapper">
                                    <?php
                                    $payment_query = new WP_Query([
                                        'post_type'      => 'payment_method',
                                        'post_status'    => 'publish',
                                        'posts_per_page' => -1,
                                        'meta_query'     => [
                                            [
                                                'key'     => '_payment_enabled',
                                                'value'   => '1',
                                                'compare' => '='
                                            ]
                                        ]
                                    ]);

                                    if ( $payment_query->have_posts() ) :
                                        while ( $payment_query->have_posts() ) :
                                            $payment_query->the_post();
                                            $id          = get_the_ID();
                                            $method_slug = sanitize_title( get_the_title() );
                                            $fields      = get_post_meta( $id, '_payment_method_fields', true );

                                            $manual_description = get_post_meta($id, '_manual_payment_description', true);

                                            if ( is_array( $fields ) && ! empty( $fields ) ) :
                                    ?>
                                        <div class="payment-extra-fields" id="fields_<?php echo esc_attr( $method_slug ); ?>" style="display:none;">
                                            <h4 class="title"><?php esc_html_e('Please follow the instruction below', 'nextdestina-booking'); ?></h4>
                                            <p class="manual-description"><?php echo esc_html($manual_description); ?></p>
                                            <div class="row">

                                                <?php foreach ( $fields as $field ) :
                                                    $name_attr = 'payment_fields[' . sanitize_title( $field['name'] ) . ']';
                                                    $required  = ( isset( $field['validation'] ) && $field['validation'] === 'required' ) ? 'required' : '';
                                                ?>
                                                    <div class="col-lg-6">
                                                    <label><?php echo esc_html( $field['name'] ); ?></label>
                                                    <?php
                                                    switch ( $field['type'] ) {
                                                        case 'number':
                                                            echo '<input type="number" name="' . esc_attr( $name_attr ) . '" ' . esc_attr( $required ) . '>';
                                                            break;
                                                        case 'file':
                                                            echo '<input class="form-control" type="file" name="' . esc_attr( $name_attr ) . '" ' . esc_attr( $required ) . '>';
                                                            break;
                                                        case 'textarea':
                                                            echo '<textarea name="' . esc_attr( $name_attr ) . '" ' . esc_attr( $required ) . '></textarea>';
                                                            break;
                                                        case 'date':
                                                            echo '<input type="date" name="' . esc_attr( $name_attr ) . '" ' . esc_attr( $required ) . '>';
                                                            break;
                                                        default:
                                                            echo '<input type="text" name="' . esc_attr( $name_attr ) . '" ' . esc_attr( $required ) . '>';
                                                            break;
                                                    }
                                                    ?>
                                                    </div>
                                                <?php endforeach; ?>

                                            </div>
                                        </div>
                                    <?php
                                            endif;
                                        endwhile;
                                        wp_reset_postdata();
                                    endif;
                                    ?>
                                </div>

                            </div>
                            <div class="payment-summery">
                                <h5 class="title"><?php esc_html_e('Payment Summery', 'nextdestina-booking') ?></h5>
                                <div class="item">
                                    <h5><?php esc_html_e('Amount', 'nextdestina-booking') ?></h5>
                                    <h5 id="base-price" class="amount" data-price="<?php echo esc_attr($total_price); ?>">
                                        <?php echo esc_html( sprintf( __( '$%s', 'nextdestina-booking' ), $total_price ) ); ?>
                                    </h5>
                                </div>
                                <div class="item charge">
                                    <h5><?php esc_html_e('Charge', 'nextdestina-booking') ?></h5>
                                    <h5 id="gateway-charge" class="amount"></h5>
                                </div>
                                <div class="item">
                                    <h5><?php esc_html_e('Payable Amount', 'nextdestina-booking') ?></h5>
                                    <h5 id="final-total" class="amount"></h5>
                                </div>
                            </div>

                            <!-- PayPal Button Container -->
                            <div id="paypal-button-container" style="display:none; margin-top:20px;"></div>
                            <p>
                                <button type="submit" id="pay-button"><?php esc_html_e('Pay & Confirm Booking', 'nextdestina-booking') ?></button>
                            </p>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-4">
                <div class="booking-info">
                    <div class="box-head">
                        <h5><?php esc_html_e('Booking Info', 'nextdestina-booking') ?></h5>
                    </div>
                    <div class="box-body">
                        <?php if($tour_id) : ?>
                            <div class="tour-post">
                                <div class="image">
                                    <?php echo wp_kses_post(get_the_post_thumbnail($tour_id)); ?>
                                </div>
                                <div class="content">
                                    <h6><?php echo esc_html($tour_title); ?></h6>
                                    <p><i class="fa-regular fa-location-dot"></i><?php echo esc_html($location); ?></p>
                                </div>
                            </div>
                        <?php endif; ?>
                        <ul class="info-list">
                            <li>
                                <h6><?php esc_html_e('Tour type', 'nextdestina-booking') ?></h6>
                                <h6><?php echo esc_html($tour_type); ?></h6>
                            </li>
                            <li>
                                <h6><?php esc_html_e('Departure date', 'nextdestina-booking') ?></h6>
                                <h6><?php echo esc_html($travel_date); ?></h6>
                            </li>
                            <li>
                                <h6><?php esc_html_e('Duration', 'nextdestina-booking') ?></h6>
                                <h6><?php echo esc_html($duration); ?></h6>
                            </li>
                            <li>
                                <h6><?php esc_html_e('Number of Travellers', 'nextdestina-booking') ?></h6>
                                <h6><?php echo esc_html($num_travelers); ?></h6>
                            </li>
                        </ul>
                        <div class="total-cost">
                            <h5><?php esc_html_e('Price Summary', 'nextdestina-booking') ?></h5>
                            <div class="total-amount">
                                <span><?php esc_html_e('Total Amount', 'nextdestina-booking') ?></span>
                                <span><?php echo esc_html( sprintf( __( '$%s', 'nextdestina-booking' ), $total_price ) ); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>