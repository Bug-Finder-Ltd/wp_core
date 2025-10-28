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

if (!is_user_logged_in()) {
    wp_redirect(wp_login_url());
    exit;
}

global $wpdb;
$current_user_id = get_current_user_id();

// Get user's bookings
$booking_ids = $wpdb->get_col($wpdb->prepare("
    SELECT ID FROM {$wpdb->posts}
    WHERE post_type = 'tour_booking' AND post_author = %d
", $current_user_id));

$payments = [];
$total = 0;
$per_page = 10;
$paged = isset($_GET['payment_page']) ? max(1, intval($_GET['payment_page'])) : 1;
$offset = ($paged - 1) * $per_page;

$where_clauses = [];
$params = [];

if (!empty($booking_ids)) {
    $placeholders = implode(',', array_fill(0, count($booking_ids), '%d'));
    $where_clauses[] = "booking_id IN ($placeholders)";
    $params = array_merge($params, $booking_ids);
}

// Transaction ID filter
if (!empty($_GET['filter_transaction'])) {
    $where_clauses[] = "transaction_id LIKE %s";
    $params[] = '%' . $wpdb->esc_like(sanitize_text_field($_GET['filter_transaction'])) . '%';
}

// Date From filter
if (!empty($_GET['filter_date_from'])) {
    $where_clauses[] = "DATE(created_at) >= %s";
    $params[] = sanitize_text_field($_GET['filter_date_from']);
}

// Date To filter
if (!empty($_GET['filter_date_to'])) {
    $where_clauses[] = "DATE(created_at) <= %s";
    $params[] = sanitize_text_field($_GET['filter_date_to']);
}

if (!empty($where_clauses)) {
    $where_sql = implode(' AND ', $where_clauses);

    // Get total
    $total_sql = "SELECT COUNT(*) FROM {$wpdb->prefix}payment_history WHERE $where_sql";
    $total = $wpdb->get_var($wpdb->prepare($total_sql, ...$params));

    // Get data
    $params_with_limit = array_merge($params, [$per_page, $offset]);
    $data_sql = "SELECT * FROM {$wpdb->prefix}payment_history WHERE $where_sql ORDER BY created_at DESC LIMIT %d OFFSET %d";
    $payments = $wpdb->get_results($wpdb->prepare($data_sql, ...$params_with_limit));
}
?>

<div class="card">
    <div class="card-header d-flex justify-content-between border-0">
        <h4><?php esc_html_e( 'Payment History', 'nextdestina-booking' ); ?></h4>
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
                            <th scope="col"><?php esc_html_e('Booking ID', 'nextdestina-booking'); ?></th>
                            <th scope="col"><?php esc_html_e('Method', 'nextdestina-booking'); ?></th>
                            <th scope="col"><?php esc_html_e('Total Price', 'nextdestina-booking'); ?></th>
                            <th scope="col"><?php esc_html_e('Payment Status', 'nextdestina-booking'); ?></th>
                            <th scope="col"><?php esc_html_e('Transaction ID', 'nextdestina-booking'); ?></th>
                            <th scope="col"><?php esc_html_e('Date', 'nextdestina-booking'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($payments)) : ?>

                            <?php foreach ($payments as $payment): ?>
                                <tr>
                                    <td data-label="<?php esc_attr_e( 'Booking ID', 'nextdestina-booking' ); ?>">
                                        <span><?php echo esc_html($payment->booking_id); ?></span>
                                    </td>
                                    <td data-label="<?php esc_attr_e( 'method', 'nextdestina-booking' ); ?>">
                                        <span><?php echo esc_html($payment->payment_method); ?></span>
                                    </td>
                                    <td data-label="<?php esc_attr_e( 'Total Price', 'nextdestina-booking' ); ?>">
                                        <span>
                                            <?php echo esc_html( number_format( $payment->amount_paid, 2 ) ) . ' ' . esc_html__( 'USD', 'nextdestina-booking' ); ?>
                                        </span>
                                    </td>
                                    <td data-label="<?php esc_attr_e( 'Payment Status', 'nextdestina-booking' ); ?>">
                                        <?php
                                        if($payment->payment_status == 'succeeded'){
                                            ?><span class="badge text-bg-success"><?php echo esc_html(ucfirst($payment->payment_status)); ?></span><?php
                                        }elseif($payment->payment_status == 'pending'){
                                            ?><span class="badge text-bg-primary"><?php echo esc_html(ucfirst($payment->payment_status)); ?></span><?php
                                        }else{
                                            ?><span class="badge text-bg-secondary"><?php echo esc_html(ucfirst($payment->payment_status)); ?></span><?php
                                        }
                                        ?>
                                    </td>
                                    <td data-label="<?php esc_attr_e( 'Transaction ID', 'nextdestina-booking' ); ?>">
                                        <span><?php echo esc_html($payment->transaction_id); ?></span>
                                    </td>
                                    <td data-label="<?php esc_attr_e( 'Date', 'nextdestina-booking' ); ?>">
                                        <span><?php echo esc_html(date_i18n('F j, Y', strtotime($payment->created_at))); ?></span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="text-center">
                                    <?php esc_html_e('No payment history found.', 'nextdestina-booking'); ?>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php
$total_pages = ceil($total / $per_page);
if ($total_pages > 1) : ?>
    <div class="pagination-section">
        <nav aria-label="...">
            <ul class="pagination">
                <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
                    <?php $is_current = $i === $paged ? 'class="active"' : ''; ?>
                    <li <?php echo $is_current; ?>>
                        <a class="page-link" href="<?php echo esc_url(add_query_arg(array_merge($_GET, ['payment_page' => $i]))); ?>"><?php echo $i; ?></a>
                    </li>
                <?php endfor; ?>
            </ul>
        </nav>
    </div>
<?php endif; ?>

<!-- Offcanvas Filter Form -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
  <div class="offcanvas-header">
    <h5 id="offcanvasExampleLabel"><?php esc_html_e('Filter Payments', 'nextdestina-booking'); ?></h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <form method="get">
        <div class="mb-3">
            <label class="form-label"><?php esc_html_e('Transaction ID', 'nextdestina-booking'); ?></label>
            <input type="text" name="filter_transaction" class="form-control" value="<?php echo esc_attr($_GET['filter_transaction'] ?? ''); ?>">
        </div>
        <div class="mb-3">
            <label class="form-label"><?php esc_html_e('Date From', 'nextdestina-booking'); ?></label>
            <input type="text" name="filter_date_from" class="form-control dob-datepicker" style="background: #fff;" value="<?php echo esc_attr($_GET['filter_date_from'] ?? ''); ?>">
        </div>
        <div class="mb-3">
            <label class="form-label"><?php esc_html_e('Date To', 'nextdestina-booking'); ?></label>
            <input type="text" name="filter_date_to" class="form-control dob-datepicker" style="background: #fff;" value="<?php echo esc_attr($_GET['filter_date_to'] ?? ''); ?>">
        </div>

        <button type="submit" class="btn btn-primary w-100"><?php esc_html_e('Apply Filter', 'nextdestina-booking'); ?></button>

        <?php if (!empty($_GET['filter_transaction']) || !empty($_GET['filter_date_from']) || !empty($_GET['filter_date_to'])) : ?>
            <a href="<?php echo esc_url(remove_query_arg(['filter_transaction', 'filter_date_from', 'filter_date_to', 'payment_page'])); ?>" class="btn btn-outline-secondary w-100 mt-2">
                <?php esc_html_e('Reset Filter', 'nextdestina-booking'); ?>
            </a>
        <?php endif; ?>
    </form>
  </div>
</div>
