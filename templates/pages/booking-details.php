<?php
/**
 * Template: Booking Details
 * @package NextdestinaBooking
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! is_user_logged_in() ) {
    wp_redirect( wp_login_url() );
    exit;
}

$user_id = get_current_user_id();
$booking_id = isset($_GET['booking_id']) ? absint($_GET['booking_id']) : 0;

if ( ! $booking_id ) {
    echo '<p>' . esc_html__( 'Invalid booking ID.', 'nextdestina-booking' ) . '</p>';
    return;
}

$booking = get_post($booking_id);

// Validate ownership
if ( ! $booking || $booking->post_type !== 'tour_booking' || $booking->post_author != $user_id ) {
    echo '<p>' . esc_html__( 'You are not allowed to view this booking.', 'nextdestina-booking' ) . '</p>';
    return;
}

// Booking meta
$tour_id       = get_post_meta($booking_id, 'tour_id', true);
$tour_title    = $tour_id ? get_the_title($tour_id) : '-';
$travel_date   = get_post_meta($booking_id, 'travel_date', true);
$num_travelers = get_post_meta($booking_id, 'num_travelers', true);
$status        = get_post_meta($booking_id, 'booking_status', true) ?: 'pending';
$total_price   = get_post_meta($booking_id, 'total_price', true);
$travelers     = get_post_meta($booking_id, 'travelers', true);


$duration = get_field('duration', $tour_id);
$location = get_post_meta($tour_id, '_package_location', true);
$tour_type  = get_field('tour_type', $tour_id);

$start_time = get_field('start_time', $tour_id);


// Transaction
global $wpdb;
$transaction_id = $wpdb->get_var($wpdb->prepare("
    SELECT transaction_id FROM {$wpdb->prefix}payment_history
    WHERE booking_id = %d
    ORDER BY created_at DESC
    LIMIT 1
", $booking_id));

// Payment method & status

$payment_history_table = $wpdb->prefix . 'payment_history';

$payment = $wpdb->get_row($wpdb->prepare(
    "SELECT * FROM $payment_history_table WHERE booking_id = %d ORDER BY id DESC LIMIT 1",
    $booking_id
));

?>

<div class="card">
    <div class="card-header">
        <h4><?php esc_html_e( 'Booking Details', 'nextdestina-booking' ); ?></h4>
    </div>
    <div class="card-body">
        <div class="card-block">
            <div class="block-head">
                <h5 class="title"><i class="fa-solid fa-info"></i><?php esc_html_e('Package Information', 'nextdestina-booking'); ?></h5>
            </div>
            <div class="block-content">
                <div class="box-group">
                    <div class="box">
                        <h6 class="box-title">
                            <i class="fa-regular fa-box-archive"></i><?php esc_html_e( 'Package', 'nextdestina-booking' ); ?>
                        </h6>
                        <table>
                            <tr>
                                <th><?php esc_html_e('Package Name', 'nextdestina'); ?></th>
                                <td><?php echo esc_html($tour_title); ?></td>
                                
                            </tr>
                            <tr>
                                <th><?php esc_html_e('Duration', 'nextdestina'); ?></th>
                                <td><?php echo esc_html($duration); ?></td>
                            </tr>
                            <tr>
                                <th><?php esc_html_e('Location', 'nextdestina'); ?></th>
                                <td><?php echo esc_html($location); ?></td>
                            </tr>
                            <tr>
                                <th><?php esc_html_e('Tour Type', 'nextdestina'); ?></th>
                                <td><?php echo esc_html($tour_type); ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="box">
                        <h6 class="box-title">
                            <i class="fa-regular fa-timer"></i><?php esc_html_e( 'Schedule', 'nextdestina-booking' ); ?>
                        </h6>
                        <table>
                            <tr>
                                <th><?php esc_html_e('Tour Date', 'nextdestina'); ?></th>
                                <td><?php echo esc_html($travel_date); ?></td>
                            </tr>
                            <tr>
                                <th><?php esc_html_e('Start Time', 'nextdestina'); ?></th>
                                <td><?php echo esc_html($start_time); ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-block">
            <div class="block-head">
                <h5 class="title"><i class="fa-solid fa-person-hiking"></i><?php esc_html_e('Traveler Information', 'nextdestina-booking'); ?></h5>
            </div>
            <div class="block-content">
                <?php if (!empty($travelers) && is_array($travelers)) : ?>
                    <div class="box-group">
                        <?php
                        // Separate counters for each type
                        $adult_counter  = 1;
                        $child_counter  = 1;
                        $infant_counter = 1;

                        // Loop through each traveler
                        foreach ($travelers as $traveler) :
                            $type = $traveler['type'];
                            $icon = '';
                            $label = '';

                            // Set icon and label based on type
                            switch ($type) {
                                case 'adult':
                                    $icon  = 'fa-solid fa-user-tie';
                                    $label = 'Adult ' . $adult_counter++;
                                    break;
                                case 'child':
                                    $icon  = 'fa-solid fa-child';
                                    $label = 'Child ' . $child_counter++;
                                    break;
                                case 'infant':
                                    $icon  = 'fa-solid fa-baby';
                                    $label = 'Infant ' . $infant_counter++;
                                    break;
                            }
                        ?>
                            <div class="box">
                                <h6 class="box-title">
                                    <i class="<?php echo esc_attr($icon); ?>"></i> <?php echo esc_html($label); ?>
                                </h6>
                                <table>
                                    <tr>
                                        <th><?php esc_html_e('First Name', 'nextdestina'); ?></th>
                                        <th><?php esc_html_e('Last Name', 'nextdestina'); ?></th>
                                        <th><?php esc_html_e('Date of Birth', 'nextdestina'); ?></th>
                                    </tr>
                                    <tr>
                                        <td><?php echo esc_html($traveler['first_name']); ?></td>
                                        <td><?php echo esc_html($traveler['last_name']); ?></td>
                                        <td><?php echo esc_html($traveler['dob']); ?></td>
                                    </tr>
                                </table>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="card-block">
            <div class="block-head">
                <h5 class="title"><i class="fa-solid fa-money-bill-1-wave"></i><?php esc_html_e('Payment Information', 'nextdestina-booking'); ?></h5>
            </div>
            <div class="block-content">
                <div class="box-group">
                    <div class="box">
                        <h6 class="box-title">
                            <i class="fa-solid fa-file-invoice"></i><?php esc_html_e('Summary', 'nextdestina-booking'); ?>
                        </h6>
                        <table>
                            <tr>
                                <th><?php esc_html_e('Total Amount', 'nextdestina'); ?></th>
                                <td><?php echo esc_html( '$' . number_format_i18n($total_price, 0) ); ?></td>
                            </tr>
                            <tr>
                                <th><?php esc_html_e('Transaction ID', 'nextdestina'); ?></th>
                                <td><?php echo esc_html($transaction_id ?: '-'); ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="box">
                        <h6 class="box-title">
                            <i class="fa-brands fa-paypal"></i></i><?php esc_html_e('Payment Method', 'nextdestina-booking'); ?>
                        </h6>
                        <table>
                            <tr>
                                <th><?php esc_html_e('Paid Via', 'nextdestina'); ?></th>
                                <td><?php echo esc_html(ucfirst($payment->payment_method)); ?></td>
                            </tr>
                            <tr>
                                <th><?php esc_html_e('Payment Status', 'nextdestina'); ?></th>
                                <td><?php echo esc_html(ucfirst($payment->payment_status)); ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <a href="<?php echo esc_url( add_query_arg( 'download_invoice', $booking_id, home_url('/') ) ); ?>" id="invoice-download" class="btn" target="_blank">
            <?php esc_html_e('Download Invoice', 'nextdestina-booking'); ?>
        </a>
    </div>
</div>
