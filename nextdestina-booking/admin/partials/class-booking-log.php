<?php
if ( ! class_exists( 'WP_List_Table' ) ) {
    require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';
}

class ND_Booking_Log_Table extends WP_List_Table {

    public function get_columns() {
        return [
            'cb'            => '<input type="checkbox" />',
            'id'            => __('ID', 'nextdestina-booking'),
            'tour'          => __('Tour', 'nextdestina-booking'),
            'travel_date'   => __('Travel Date', 'nextdestina-booking'),
            'num_travelers' => __('Travellers', 'nextdestina-booking'),
            'total_price'   => __('Total Price', 'nextdestina-booking'),
            'status'        => __('Status', 'nextdestina-booking'),
            'contact'       => __('Contact', 'nextdestina-booking'),
            'actions'       => __('Actions', 'nextdestina-booking'),
        ];
    }

    public function get_sortable_columns() {
        return [
            'id' => ['ID', false],
            'travel_date' => ['travel_date', false],
            'total_price' => ['total_price', false],
        ];
    }

    public function column_cb($item) {
        return sprintf('<input type="checkbox" name="booking_ids[]" value="%s" />', $item->ID);
    }

    public function get_bulk_actions() {
        return [
            'confirm' => __('Confirm', 'nextdestina-booking'),
            'cancel'  => __('Cancel', 'nextdestina-booking'),
            'delete'  => __('Delete', 'nextdestina-booking'),
        ];
    }

    public function process_bulk_action() {
        // Check if we have POST data and current action
        if (!empty($_POST['booking_ids']) && $this->current_action()) {
            // Verify nonce for security (recommended)
            if (!isset($_POST['_wpnonce']) || !wp_verify_nonce($_POST['_wpnonce'], 'bulk-' . $this->_args['plural'])) {
                wp_die(__('Security check failed.', 'nextdestina-booking'));
            }
            
            $action = $this->current_action();
            $ids    = array_map('intval', $_POST['booking_ids']);

            foreach ($ids as $id) {
                switch ($action) {
                    case 'confirm':
                        update_post_meta($id, 'booking_status', 'confirmed');
                        break;
                    case 'cancel':
                        update_post_meta($id, 'booking_status', 'cancelled');
                        break;
                    case 'delete':
                        wp_delete_post($id, true);
                        break;
                }
            }

            $redirect_url = add_query_arg([
                'page'      => 'booking-history',
                'bulk_done' => $action,
                'count'     => count($ids),
            ], admin_url('admin.php'));

            if (!headers_sent()) {
                wp_safe_redirect($redirect_url);
                exit;
            }
        }
    }

    private function search_booking_ids_by_meta($search) {
        global $wpdb;
        $like = '%' . $wpdb->esc_like($search) . '%';
        $booking_ids = [];

        if (is_numeric($search)) {
            $booking_ids[] = (int)$search;
        }

        $results = $wpdb->get_col($wpdb->prepare("
            SELECT post_id
            FROM {$wpdb->postmeta}
            WHERE meta_key IN ('first_name','last_name','email','phone')
            AND meta_value LIKE %s
        ", $like));

        if (!empty($results)) {
            $booking_ids = array_merge($booking_ids, $results);
        }

        return array_unique($booking_ids);
    }

    public function prepare_items() {
        $per_page     = 20;
        $current_page = $this->get_pagenum();
        $offset       = ($current_page - 1) * $per_page;

        $search_term = isset($_GET['s']) ? sanitize_text_field($_GET['s']) : '';
        $from_date   = isset($_GET['from_date']) ? sanitize_text_field($_GET['from_date']) : '';
        $to_date     = isset($_GET['to_date']) ? sanitize_text_field($_GET['to_date']) : '';

        $meta_query = [];

        if (!empty($from_date) || !empty($to_date)) {
            $meta_query[] = [
                'key'     => 'travel_date',
                'type'    => 'DATE',
                'compare' => 'BETWEEN',
                'value'   => [
                    !empty($from_date) ? $from_date : '1900-01-01',
                    !empty($to_date)   ? $to_date   : date('Y-m-d'),
                ],
            ];
        }

        $post__in = [];
        if (!empty($search_term)) {
            $post__in = $this->search_booking_ids_by_meta($search_term);
        }

        $args = [
            'post_type'      => 'tour_booking',
            'posts_per_page' => $per_page,
            'offset'         => $offset,
            'orderby'        => 'date',
            'order'          => 'DESC',
            'meta_query'     => $meta_query,
        ];

        if (!empty($search_term)) {
            $args['post__in'] = !empty($post__in) ? $post__in : [0];
        }

        $query = new WP_Query($args);
        $this->items = $query->posts;

        $this->set_pagination_args([
            'total_items' => $query->found_posts,
            'per_page'    => $per_page,
        ]);

        $columns  = $this->get_columns();
        $hidden   = [];
        $sortable = $this->get_sortable_columns();
        $this->_column_headers = [$columns, $hidden, $sortable];
    }

    public function column_default($item, $column_name) {
        switch ($column_name) {
            case 'id':
                return '#' . $item->ID;
            case 'tour':
                $tour_id = get_post_meta($item->ID, 'tour_id', true);
                return $tour_id ? get_the_title($tour_id) : '-';
            case 'travel_date':
                return esc_html(get_post_meta($item->ID, 'travel_date', true));
            case 'num_travelers':
                return esc_html(get_post_meta($item->ID, 'num_travelers', true));
            case 'total_price':
                $total_price = get_post_meta($item->ID, 'total_price', true);
                return '$' . number_format((float)$total_price, 2);
            case 'status':
                $status = get_post_meta($item->ID, 'booking_status', true) ?: 'pending';
                return '<span class="' . esc_attr($status) . '">' . ucfirst($status) . '</span>';
            case 'contact':
                $first = get_post_meta($item->ID, 'first_name', true);
                $last  = get_post_meta($item->ID, 'last_name', true);
                $email = get_post_meta($item->ID, 'email', true);
                $phone = get_post_meta($item->ID, 'phone', true);
                return esc_html("{$first} {$last}") . '<br>' .
                       "<a href='mailto:{$email}'>" . esc_html($email) . "</a><br>" .
                       "<a href='tel:{$phone}'>" . esc_html($phone) . "</a>";
            case 'actions':
                $booking_id   = $item->ID;
                $view_url     = admin_url("admin.php?page=booking-history&view_booking={$booking_id}");
                $download_url = admin_url("admin.php?page=booking-history&action=download_invoice&booking_id={$booking_id}");
                return '<a href="' . esc_url($view_url) . '" class="button button-small" style="margin-right:5px;">' .
                            esc_html__('View Details', 'nextdestina-booking') . '</a>' .
                       '<a href="' . esc_url($download_url) . '" class="button button-small">' .
                            esc_html__('Download Invoice', 'nextdestina-booking') . '</a>';
            default:
                return '';
        }
    }
}