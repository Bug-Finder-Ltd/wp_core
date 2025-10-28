<?php
/**
 * Template for Booking success Page
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <?php wp_head(); ?>
</head>
<body <?php body_class('booking-success-page'); ?>>
    
<?php

require_once TRAVELER_DASHBOARD_PLUGIN_DIR . '/includes/stripe/init.php';

use Stripe\Stripe;
use Stripe\Checkout\Session;
use Stripe\PaymentIntent;

/**
 * Query stripe secret key meta
 */

$stripe_query = new WP_Query([
    'post_type'      => 'payment_method',
    'title'          => 'Stripe',
    'post_status'    => 'publish',
    'posts_per_page' => 1,
]);

if (!$stripe_query->have_posts()) {
    return false;
}

$stripe_post = $stripe_query->posts[0];
$post_id = $stripe_post->ID;

$stripe_secret_key = get_post_meta($post_id, '_stripe_secret_key', true);

/**
 * Set secret key to Stripe
 */

Stripe::setApiKey($stripe_secret_key);

$session_id = isset($_GET['session_id']) ? sanitize_text_field($_GET['session_id']) : '';

if ($session_id) {
    try {
        $session = Session::retrieve($session_id);
        $payment_intent = PaymentIntent::retrieve($session->payment_intent);

        $amount_paid    = $payment_intent->amount_received / 100;
        $currency       = strtoupper($payment_intent->currency);
        $transaction_id = $payment_intent->id;
        $status         = $payment_intent->status;

        if ($status !== 'succeeded') {
            wp_redirect(home_url('/booking-cancel'));
            exit;
        }

        $booking = get_posts([
            'post_type'   => 'tour_booking',
            'meta_key'    => 'stripe_session_id',
            'meta_value'  => $session_id,
            'numberposts' => 1,
        ]);

        if (!empty($booking)) {
            $booking_id = $booking[0]->ID;

            $user_id = get_post_meta($booking_id, 'user_id', true);

            global $wpdb;

           $wpdb->insert(
                $wpdb->prefix . 'payment_history',
                [
                    'booking_id'        => $booking_id,
                    'user_id'           => $user_id,
                    'transaction_id'    => $transaction_id,
                    'amount_paid'       => $amount_paid,
                    'currency'          => $currency,
                    'payment_status'    => $status,
                    'payment_method'    => 'stripe',
                    'created_at'        => current_time('mysql')
                ],
                [
                    '%d', '%d', '%s', '%f', '%s', '%s', '%s', '%s'
                ]
            );

        }

        ?>
        
        <div id="thank-you-content">
            <div class="text">
                <h1 class="title"><?php esc_html_e('Thank You!', 'nextdestina-booking'); ?></h1>
                <p class="description"><?php esc_html_e('Thanks a bunch for filling that out. It means a lot to us, just like you do! We really appreciate you giving us a moment of your time today. Thanks for being with us.', 'nextdestina-booking'); ?></p>
                <a class="btn-1" href="<?php echo esc_url(home_url( '/' )); ?>">
                    <?php esc_html_e('Go back to Home', 'nextdestina-booking'); ?>
                    <span></span>
                </a>
                <?php if ( function_exists( 'nextdestina_copyright_text' ) ) : ?>
                    <p class="copyright-text"><?php print nextdestina_copyright_text(); ?></p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Email Notification -->

        <?php nd_send_booking_notifications($booking_id, $amount_paid, $transaction_id); ?>

        <?php
        // Check if invoice already exists for this booking
        $existing_invoice = new WP_Query([
            'post_type'  => 'invoice',
            'meta_key'   => '_booking_id',
            'meta_value' => $booking_id,
            'fields'     => 'ids',
            'posts_per_page' => 1,
        ]);

        if ( class_exists( 'Traveler_Dashboard' ) ) {
            
            if (empty($existing_invoice->posts)) {
                $instance = Traveler_Dashboard::get_instance();
                $invoice_id = $instance->global_functions->nextdestina_generate_invoice($booking_id, $user_id, $amount_paid);
            }
        }

        ?>

        <?php

    } catch (Exception $e) {
        echo '<p style="color:red;">' . esc_html__('Stripe error:', 'nextdestina-booking') . ' ' . esc_html($e->getMessage()) . '</p>';
    }
} else {
    echo '<p>' . esc_html__('No session ID found.', 'nextdestina-booking') . '</p>';
}

?>

<?php wp_footer(); ?>
</body>
</html>


