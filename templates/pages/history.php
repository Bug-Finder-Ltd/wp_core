<?php
/**
 * Dashboard History Page
 *
 * @package NextdestinaBooking
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$user_id = get_current_user_id();

// Fetch bookings made by this user
$args = [
    'post_type'      => 'tour_booking',
    'posts_per_page' => -1,
    'post_status'    => 'publish',
    'author'         => $user_id,
];

$meta_query = [];

// Booking ID filter
if ( ! empty($_GET['filter_booking_id']) ) {
    $booking_id = absint($_GET['filter_booking_id']);
    $args['post__in'] = [ $booking_id ];
}

// Destination filter
if ( ! empty($_GET['filter_destination']) ) {
    $matching_tour_ids = get_posts([
        'post_type'   => 'tour',
        'numberposts' => -1,
        'fields'      => 'ids',
        's'           => sanitize_text_field($_GET['filter_destination']),
    ]);

    if ( ! empty($matching_tour_ids) ) {
        $meta_query[] = [
            'key'     => 'tour_id',
            'value'   => $matching_tour_ids,
            'compare' => 'IN',
        ];
    } else {
        // Prevent any results if no destination matched
        $args['post__in'] = [0];
    }
}

// Travel Date (Exact match)
if ( ! empty($_GET['filter_date_from']) || ! empty($_GET['filter_date_to']) ) {
    $date_query = [];

    if ( ! empty($_GET['filter_date_from']) ) {
        $date_query[] = [
            'key'     => 'travel_date',
            'value'   => sanitize_text_field($_GET['filter_date_from']),
            'compare' => '>=',
            'type'    => 'DATE',
        ];
    }

    if ( ! empty($_GET['filter_date_to']) ) {
        $date_query[] = [
            'key'     => 'travel_date',
            'value'   => sanitize_text_field($_GET['filter_date_to']),
            'compare' => '<=',
            'type'    => 'DATE',
        ];
    }

    $meta_query = array_merge($meta_query, $date_query);
}

// Status filter
if ( ! empty($_GET['filter_status']) ) {
    $meta_query[] = [
        'key'     => 'booking_status',
        'value'   => sanitize_text_field($_GET['filter_status']),
        'compare' => '=',
    ];
}

if ( ! empty($meta_query) ) {
    $args['meta_query'] = $meta_query;
}

$bookings = get_posts($args);

/**
 * Query payment details
 */

global $wpdb;

// Get user's bookings
$booking_ids = $wpdb->get_col($wpdb->prepare("
    SELECT ID FROM {$wpdb->posts}
    WHERE post_type = 'tour_booking' AND post_author = %d
", $user_id));

$payments = [];
$total = 0;
$per_page = 10; // payments per page
$paged = isset($_GET['payment_page']) ? max(1, intval($_GET['payment_page'])) : 1;
$offset = ($paged - 1) * $per_page;

if (!empty($booking_ids)) {
    $placeholders = implode(',', array_fill(0, count($booking_ids), '%d'));

    // Get total count
    $total_query = $wpdb->prepare("
        SELECT COUNT(*) FROM {$wpdb->prefix}payment_history
        WHERE booking_id IN ($placeholders)
    ", ...$booking_ids);
    $total = $wpdb->get_var($total_query);

    // Get paginated results
    $args = array_merge($booking_ids, [$per_page, $offset]);

    $query = $wpdb->prepare("
        SELECT * FROM {$wpdb->prefix}payment_history
        WHERE booking_id IN ($placeholders)
        ORDER BY created_at DESC
        LIMIT %d OFFSET %d
    ", ...$args);
    
    $payments = $wpdb->get_results($query);
}

?>

    <div class="card">
        <div class="card-header d-flex justify-content-between border-0">
            <h4><?php esc_html_e( 'Tour History', 'nextdestina-booking' ); ?></h4>
            <div class="btn-area">
                <button type="button" class="cmn-btn" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                    <?php esc_html_e( 'Filter', 'nextdestina-booking' ); ?>
                    <i class="fa-regular fa-filter"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="cmn-table">
                <div class="table-responsive overflow-hidden">
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
                            <?php if (!empty($bookings)) : ?>
                            <?php foreach ( $bookings as $booking ) : ?>
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
                                        <?php
                                        if($status == 'confirmed'){
                                            ?><span class="badge text-bg-success"><?php echo esc_html( ucfirst( $status ) ); ?></span><?php
                                        }elseif($status == 'pending'){
                                            ?><span class="badge text-bg-primary"><?php echo esc_html( ucfirst( $status ) ); ?></span><?php
                                        }else{
                                            ?><span class="badge text-bg-secondary"><?php echo esc_html( ucfirst( $status ) ); ?></span><?php
                                        }
                                        ?>
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

                                <div class="modal fade" id="bookingDetailsModal-<?php echo esc_attr($id); ?>" tabindex="-1" aria-labelledby="bookingDetailsLabel-<?php echo esc_attr($id); ?>" aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="bookingDetailsLabel-<?php echo esc_attr($id); ?>">
                                          <?php esc_html_e('Booking Details', 'nextdestina-booking'); ?>
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="<?php esc_attr_e('Close', 'nextdestina-booking'); ?>"></button>
                                      </div>
                                      <div class="modal-body">
                                        <ul class="list-group">
                                            <li class="list-group-item"><strong><?php _e('Package Name:', 'nextdestina-booking'); ?></strong> <?php echo esc_html($tour_title); ?></li>
                                            <li class="list-group-item"><strong><?php _e('Travel Date:', 'nextdestina-booking'); ?></strong> <?php echo esc_html($travel_date); ?></li>
                                            <li class="list-group-item"><strong><?php _e('Number of People:', 'nextdestina-booking'); ?></strong> <?php echo esc_html($num_travelers); ?></li>
                                            <li class="list-group-item"><strong><?php _e('Total Price:', 'nextdestina-booking'); ?></strong> <?php echo esc_html( '$' . $total_price ); ?></li>
                                            <?php
                                            $transaction_id = '-';
                                            foreach ( $payments as $payment ) {
                                                if ( intval($payment->booking_id) === intval($id) ) {
                                                    $transaction_id = $payment->transaction_id ?? '-';
                                                    break;
                                                }
                                            }
                                            ?>
                                            <li class="list-group-item"><strong><?php _e('Transaction ID:', 'nextdestina-booking'); ?></strong> <?php echo esc_html($transaction_id); ?></li>
                                            <li class="list-group-item"><strong><?php _e('Status:', 'nextdestina-booking'); ?></strong> <?php echo esc_html(ucfirst($status)); ?></li>
                                        </ul>
                                      </div>
                                    </div>
                                    </div>
                                </div>
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

    <!-- Filter Offcanvas -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasExampleLabel"><?php esc_html_e('Filter Tour History', 'nextdestina-booking'); ?></h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="<?php esc_attr_e('Close', 'nextdestina-booking'); ?>"></button>
        </div>
        <div class="offcanvas-body">
            <form method="get" action="">
                <!-- Booking ID -->
                <div class="mb-3">
                    <label for="filter_booking_id" class="form-label"><?php esc_html_e('Booking ID', 'nextdestina-booking'); ?></label>
                    <input type="text" name="filter_booking_id" id="filter_booking_id" class="form-control" value="<?php echo isset($_GET['filter_booking_id']) ? esc_attr($_GET['filter_booking_id']) : ''; ?>">
                </div>

                <!-- Destination Filter -->
                <div class="mb-3">
                    <label for="filter_destination" class="form-label"><?php esc_html_e('Destination', 'nextdestina-booking'); ?></label>
                    <input type="text" name="filter_destination" id="filter_destination" class="form-control" value="<?php echo isset($_GET['filter_destination']) ? esc_attr($_GET['filter_destination']) : ''; ?>">
                </div>

                <!-- Date From -->
                <div class="mb-3">
                    <label for="filter_date_from" class="form-label"><?php esc_html_e('Date From', 'nextdestina-booking'); ?></label>
                    <input type="text" name="filter_date_from" id="filter_date_from" class="form-control dob-datepicker" style="background: #fff;" value="<?php echo isset($_GET['filter_date_from']) ? esc_attr($_GET['filter_date_from']) : ''; ?>">
                </div>

                <!-- Date To -->
                <div class="mb-3">
                    <label for="filter_date_to" class="form-label"><?php esc_html_e('Date To', 'nextdestina-booking'); ?></label>
                    <input type="text" name="filter_date_to" id="filter_date_to" class="form-control dob-datepicker" style="background: #fff;" value="<?php echo isset($_GET['filter_date_to']) ? esc_attr($_GET['filter_date_to']) : ''; ?>">
                </div>

                <!-- Status Filter -->
                <div class="mb-3">
                    <label for="filter_status" class="form-label"><?php esc_html_e('Status', 'nextdestina-booking'); ?></label>
                    <select name="filter_status" id="filter_status" class="form-select">
                        <option value=""><?php esc_html_e('All', 'nextdestina-booking'); ?></option>
                        <option value="pending" <?php selected($_GET['filter_status'] ?? '', 'pending'); ?>><?php esc_html_e('Pending', 'nextdestina-booking'); ?></option>
                        <option value="confirmed" <?php selected($_GET['filter_status'] ?? '', 'confirmed'); ?>><?php esc_html_e('Completed', 'nextdestina-booking'); ?></option>
                    </select>
                </div>

                <div class="mb-3">
                    <button type="submit" class="btn btn-primary w-100"><?php esc_html_e('Apply Filters', 'nextdestina-booking'); ?></button>
                </div>

                <a href="<?php echo esc_url( remove_query_arg( [ 'filter_booking_id', 'filter_destination', 'filter_date_from', 'filter_date_to', 'filter_status' ] ) ); ?>" class="btn btn-outline-secondary w-100 mt-2">
                    <?php esc_html_e('Reset Filters', 'nextdestina-booking'); ?>
                </a>
            </form>
        </div>
    </div>
