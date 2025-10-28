<?php
/**
 * Dashboard Home Page
 *
 * @package TravelerDashboard
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$user_id = get_current_user_id();

global $wpdb;

// Get all booking IDs for the current user
$booking_ids = $wpdb->get_col($wpdb->prepare("
    SELECT ID FROM {$wpdb->posts}
    WHERE post_type = 'tour_booking' AND post_author = %d
", $user_id));

$total_paid = 0;
$total_transactions = 0;
$payments_by_booking = [];

$payment_data = [];

if (!empty($booking_ids)) {
    $placeholders = implode(',', array_fill(0, count($booking_ids), '%d'));

    // Calculate total amount paid
    $query = $wpdb->prepare("
        SELECT SUM(amount_paid) FROM {$wpdb->prefix}payment_history
        WHERE booking_id IN ($placeholders) AND payment_status = 'succeeded'
    ", ...$booking_ids);

    $total_paid = $wpdb->get_var($query);

    // Get total transaction count
    $query_count = $wpdb->prepare("
        SELECT COUNT(*) FROM {$wpdb->prefix}payment_history
        WHERE booking_id IN ($placeholders) AND payment_status = 'succeeded'
    ", ...$booking_ids);
    $total_transactions = $wpdb->get_var($query_count);

    // Get all payment records
    $query_payments = $wpdb->prepare("
        SELECT * FROM {$wpdb->prefix}payment_history
        WHERE booking_id IN ($placeholders)
    ", ...$booking_ids);

    $payments = $wpdb->get_results($query_payments);

    foreach ($payments as $payment) {
        $booking_id = intval($payment->booking_id);
        if (!isset($payments_by_booking[$booking_id])) {
            $payments_by_booking[$booking_id] = [];
        }
        $payments_by_booking[$booking_id][] = $payment;
        $payment_data[$booking_id][] = $payment;
    }
}

// Tour query
$args = array(
    'post_type'      => 'tour_booking',
    'post_status'    => 'publish',
    'posts_per_page' => -1,
    'meta_query'     => array(
        array(
            'key'   => 'user_id',
            'value' => $user_id,
        ),
    ),
);

$bookings = new WP_Query($args);
$total_bookings = $bookings->found_posts;

$args_2 = [
    'post_type'      => 'tour_booking',
    'posts_per_page' => 10,
    'post_status'    => 'publish',
    'author'         => $user_id,
];

$bookings_2 = get_posts($args_2);

// Total Ticket

$ticket_count = new WP_Query([
    'post_type'      => 'nd_support_ticket',
    'post_status'    => 'publish',
    'posts_per_page' => -1,
    'author'         => $user_id,
    'fields'         => 'ids',
]);

$total_tickets = $ticket_count->found_posts;

?>

    <div class="breadcrumb-area">
        <h3 class="title"><?php esc_html_e('Overview', 'nextdestina-booking'); ?></h3>
    </div>

    <!-- Card section -->

        <div class="mb-30 ">
            <div class="row">
                <div class="col-12">
                    <div class="owl-carousel owl-theme card-carousel">
                        <div class="item">
                            <div class="box-card">
                                <div class="box-card-header">
                                    <p class="sub-title"><?php esc_html_e('Total Booked Tour', 'nextdestina-booking'); ?></p>
                                    <i class="fa-light fa-calendar-days"></i>
                                </div>
                                <div class="box-card-body">
                                    <h2 class="mb-0 title"><?php echo esc_html($total_bookings); ?></h2>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="box-card">
                                <div class="box-card-header">
                                    <p class="sub-title"><?php esc_html_e('Total Transaction', 'nextdestina-booking'); ?></p>
                                    <i class="fa-light fa-money-bill"></i>
                                </div>
                                <div class="box-card-body">
                                    <h2 class="mb-0 title"><?php echo esc_html($total_transactions); ?><span class="sub"></span></h2>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="box-card">
                                <div class="box-card-header">
                                    <p class="sub-title"><?php esc_html_e('Total Support Ticket', 'nextdestina-booking'); ?></p>
                                    <i class="fa-light fa-presentation-screen"></i>
                                </div>
                                <div class="box-card-body">
                                    <h2 class="mb-0 title"><?php echo esc_html($total_tickets); ?></h2>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="box-card">
                                <div class="box-card-header">
                                    <p class="sub-title"><?php esc_html_e('Total Paid Amount', 'nextdestina-booking'); ?></p>
                                    <i class="fa-light fa-wallet"></i>
                                </div>
                                <div class="box-card-body">
                                    <h2 class="mb-0 title"><?php echo esc_html('$') . esc_html(number_format((int)$total_paid)); ?></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Cmn table section start -->
        <div class="card mt-30">
            <div class="card-header d-flex justify-content-between align-items-center border-0 flex-wrap gap-3">
                <h4 class="mb-0"><?php esc_html_e('Recent Bookings', 'nextdestina-booking'); ?></h4>
                <div class="gap-3 d-flex">
                </div>
            </div>
            <div class="card-body pt-0">
                <div class="cmn-table">
                    <div class="table-responsive">
                        <table class="table table-striped align-middle">
                            <thead>
                                <tr>
                                    <th scope="col"><?php esc_html_e( 'Booking ID', 'nextdestina-booking' ); ?></th>
                                    <th scope="col"><?php esc_html_e( 'Destination', 'nextdestina-booking' ); ?></th>
                                    <th scope="col"><?php esc_html_e( 'Paid Amount', 'nextdestina-booking' ); ?></th>
                                    <th scope="col"><?php esc_html_e( 'Total Person', 'nextdestina-booking' ); ?></th>
                                    <th scope="col"><?php esc_html_e( 'Tour Date', 'nextdestina-booking' ); ?></th>
                                    <th scope="col"><?php esc_html_e( 'Status', 'nextdestina-booking' ); ?></th>
                                    <th scope="col"><?php esc_html_e( 'Payment Status', 'nextdestina-booking' ); ?></th>
                                    <th scope="col"><?php esc_html_e( 'Action', 'nextdestina-booking' ); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($bookings_2)) : ?>
                                <?php foreach ( $bookings_2 as $booking ) : ?>
                                    <?php
                                    $id            = $booking->ID;
                                    $tour_id       = get_post_meta($id, 'tour_id', true);
                                    $tour_title    = $tour_id ? get_the_title($tour_id) : '-';
                                    $travel_date   = get_post_meta($id, 'travel_date', true);
                                    $num_travelers = get_post_meta($id, 'num_travelers', true);
                                    $status        = get_post_meta($id, 'booking_status', true) ?: 'pending';
                                    $total_price   = get_post_meta($id, 'total_price', true);
                                    ?>
                                    <tr>
                                        <td data-label="<?php esc_attr_e( 'Booking ID', 'nextdestina-booking' ); ?>">
                                            <span><?php echo esc_html( '#' . $id ); ?></span>
                                        </td>
                                        <td data-label="<?php esc_attr_e( 'Destination', 'nextdestina-booking' ); ?>">
                                            <span><?php echo esc_html( $tour_title ); ?></span>
                                        </td>
                                        <td data-label="<?php esc_attr_e( 'Paid Amount', 'nextdestina-booking' ); ?>">
                                            <?php if( !empty($total_price) ) : ?>
                                                <span><?php echo esc_html( '$' . number_format_i18n( $total_price, 0 ) ); ?></span>
                                            <?php endif; ?>
                                        </td>
                                        <td data-label="<?php esc_attr_e( 'Total Person', 'nextdestina-booking' ); ?>">
                                            <span><?php echo esc_html( $num_travelers ) . ' ' . esc_html__( 'People', 'nextdestina-booking' ); ?></span>
                                        </td>
                                        <td data-label="<?php esc_attr_e( 'Tour Date', 'nextdestina-booking' ); ?>">
                                            <span><?php echo esc_html( $travel_date ); ?></span>
                                        </td>
                                        <td data-label="<?php esc_attr_e( 'Status', 'nextdestina-booking' ); ?>">
                                            <span class="badge text-bg-primary"><?php echo esc_html( ucfirst( $status ) ); ?></span>
                                        </td>
                                        <td data-label="<?php esc_attr_e( 'Payment Status', 'nextdestina-booking' ); ?>">
                                            <?php
                                            $pay_status = '-';
                                            foreach ( $payments as $payment ) {

                                                if ( intval($payment->booking_id) === intval($id) ) {
                                                    $pay_status = $payment->payment_status ?? '-';
                                                    break;
                                                }
                                            }

                                            if ( $pay_status === 'succeeded' ) {
                                                echo '<span class="badge text-bg-success">' . esc_html__( 'Succeeded', 'nextdestina-booking' ) . '</span>';
                                            } elseif ( $pay_status === 'pending' ) {
                                                echo '<span class="badge text-bg-primary">' . esc_html__( 'Pending', 'nextdestina-booking' ) . '</span>';
                                            } elseif ( $pay_status === 'rejected' ) {
                                                echo '<span class="badge text-bg-danger">' . esc_html__( 'Rejected', 'nextdestina-booking' ) . '</span>';
                                            } else {
                                                echo '<span class="badge text-bg-secondary">' . esc_html( ucfirst( $pay_status ) ) . '</span>';
                                            }
                                            ?>
                                        </td>
                                        <td data-label="<?php esc_attr_e( 'Action', 'nextdestina-booking' ); ?>">
                                            <div class="dropdown">
                                                <button class="action-btn-secondary" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fa-regular fa-ellipsis-stroke-vertical"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li>
                                                        <a class="dropdown-item" href="<?php echo esc_url(add_query_arg('booking_id', $id, site_url('/my-dashboard/booking-details/'))); ?>"><?php esc_html_e('Details', 'nextdestina-booking'); ?></a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="<?php echo esc_url( add_query_arg('download_invoice', $id, home_url('/')) ); ?>" target="_blank">
                                                            <?php esc_html_e('Download Invoice', 'nextdestina-booking'); ?>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                
                                <?php else : ?>
                                    <tr>
                                        <td colspan="7" class="text-center">
                                            <?php esc_html_e('You have no bookings yet.', 'nextdestina-booking'); ?>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Cmn table section end -->

        <!-- pagination section start -->
        <!-- <div class="pagination-section">
            <nav aria-label="...">
                <ul class="pagination">
                    <li class="page-item">
                        <a class="page-link" href="#"><i class="fal fa-long-arrow-left"></i></a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item active" aria-current="page">
                        <a class="page-link" href="#">2</a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#"><i class="fal fa-long-arrow-right"></i></a>
                    </li>
                </ul>
            </nav>
        </div> -->
        <!-- pagination section end -->

