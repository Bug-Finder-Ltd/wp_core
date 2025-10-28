<?php

if (!class_exists('WP_List_Table')) {
    require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';
}

class ND_Payment_Log_Table extends WP_List_Table {

    public function get_columns() {
        return [
            'cb'              => '<input type="checkbox" />',
            'booking_id'      => __('Booking ID', 'nextdestina-booking'),
            'traveler_name'   => __('Traveler', 'nextdestina-booking'),
            'transaction_id'  => __('Transaction ID', 'nextdestina-booking'),
            'amount_paid'     => __('Amount', 'nextdestina-booking'),
            'payment_status'  => __('Status', 'nextdestina-booking'),
            'payment_method'  => __('Method', 'nextdestina-booking'),
            'created_at'      => __('Date', 'nextdestina-booking'),
            'action'      => __('Action', 'nextdestina-booking'),
        ];
    }

    public function get_sortable_columns() {
        return [
            'created_at'     => ['created_at', false],
            'amount_paid'    => ['amount_paid', false],
        ];
    }

    public function column_cb($item) {
        return sprintf('<input type="checkbox" name="id[]" value="%s" />', $item['id']);
    }

    public function prepare_items() {
        global $wpdb;

        $table_name = $wpdb->prefix . 'payment_history';

        $columns  = $this->get_columns();
        $hidden   = [];
        $sortable = $this->get_sortable_columns();
        $this->_column_headers = [$columns, $hidden, $sortable];

        $per_page = 20;
        $current_page = $this->get_pagenum();
        $offset = ($current_page - 1) * $per_page;

        // Search
        $search = isset($_REQUEST['s']) ? sanitize_text_field($_REQUEST['s']) : '';
        $from_date = !empty($_GET['from_date']) ? sanitize_text_field($_GET['from_date']) : '';
        $to_date   = !empty($_GET['to_date']) ? sanitize_text_field($_GET['to_date']) : '';

        $where = 'WHERE 1=1';
        $params = [];

        if ($search) {
            if (is_numeric($search)) {
                $where .= " AND (id = %d OR booking_id = %d)";
                $params[] = (int) $search;
                $params[] = (int) $search;
            } else {
                $where .= " AND (transaction_id LIKE %s)";
                $params[] = '%' . $wpdb->esc_like($search) . '%';
            }
        }

        // Date filtering
        if ($from_date) {
            $where .= " AND DATE(created_at) >= %s";
            $params[] = $from_date;
        }
        if ($to_date) {
            $where .= " AND DATE(created_at) <= %s";
            $params[] = $to_date;
        }

        // Sorting
        $orderby = !empty($_GET['orderby']) ? esc_sql($_GET['orderby']) : 'created_at';
        $order   = !empty($_GET['order']) ? esc_sql($_GET['order']) : 'DESC';

        $query = "SELECT * FROM $table_name $where ORDER BY $orderby $order LIMIT %d OFFSET %d";
        $count_query = "SELECT COUNT(*) FROM $table_name $where";

        $params[] = $per_page;
        $params[] = $offset;

        $this->items = $wpdb->get_results($wpdb->prepare($query, ...$params), ARRAY_A);

        // Count query params (exclude pagination params)
        $count_params = $params;
        array_splice($count_params, -2);

        // If we have placeholders, prepare; otherwise query directly
        if (!empty($count_params)) {
            $total_items = $wpdb->get_var($wpdb->prepare($count_query, ...$count_params));
        } else {
            $total_items = $wpdb->get_var($count_query);
        }

        $this->set_pagination_args([
            'total_items' => $total_items,
            'per_page'    => $per_page,
        ]);
    }

    public function column_default($item, $column_name) {
        switch ($column_name) {
            case 'booking_id':
            case 'transaction_id':
            case 'currency':
            //case 'payment_status':
            case 'payment_method':
                return esc_html($item[$column_name]);
            case 'traveler_name':
                $user = get_userdata($item['user_id']);
                if ($user) {
                    $url = esc_url(admin_url("user-edit.php?user_id={$user->ID}"));
                    $name = esc_html($user->display_name);
                    return "<a href='{$url}'>{$name}</a>";
                } else {
                    return __('Guest', 'nextdestina-booking');
                }
            case 'amount_paid':
                $amount = number_format((int) $item['amount_paid']);
                $currency = strtoupper($item['currency']);
                return esc_html("{$amount} {$currency}");
            case 'created_at':
                return esc_html(date_i18n('F j, Y', strtotime($item['created_at'])));
            case 'payment_status':
                $status = esc_html($item['payment_status']);
                $class  = sanitize_html_class( strtolower($item['payment_status']));
                return "<span class='{$class}'>{$status}</span>";
            case 'action':

                if ( strtolower($item['payment_method']) !== 'stripe' && strtolower($item['payment_method']) !== 'paypal' ) {
                    return sprintf(
                        '<button class="nd-payment-details-btn button" data-id="%d">%s</button>',
                        esc_attr($item['id']),
                        __('View', 'nextdestina-booking')
                    );
                }
                return '';


            default:
                return '';
        }
    }

    public function get_bulk_actions() {
        return [
            'delete' => __('Delete', 'nextdestina-booking'),
        ];
    }

    public function process_bulk_action() {
        if ($this->current_action() === 'delete' && !empty($_REQUEST['id'])) {
            global $wpdb;
            $ids = array_map('intval', $_REQUEST['id']);
            $placeholders = implode(',', array_fill(0, count($ids), '%d'));

            $query = "DELETE FROM {$wpdb->prefix}payment_history WHERE id IN ($placeholders)";
            $wpdb->query($wpdb->prepare($query, ...$ids));
        }
    }
}
