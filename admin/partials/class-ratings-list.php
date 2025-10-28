<?php
if ( ! class_exists( 'WP_List_Table' ) ) {
    require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';
}

class Nextdestina_Tour_Ratings_List_Table extends WP_List_Table {

    private $ratings;

    public function __construct() {
        parent::__construct( [
            'singular' => 'tour_rating',
            'plural'   => 'tour_ratings',
            'ajax'     => false
        ] );
    }

    /**
     * Define table columns
     */
    public function get_columns() {
        return [
            'cb'       => '<input type="checkbox" />',
            'id'       => __( 'ID', 'nextdestina-booking' ),
            'tour'     => __( 'Tour', 'nextdestina-booking' ),
            'user'     => __( 'User', 'nextdestina-booking' ),
            'rating'   => __( 'Rating', 'nextdestina-booking' ),
            'review'   => __( 'Review', 'nextdestina-booking' ),
            'status'   => __( 'Status', 'nextdestina-booking' ),
            'date'     => __( 'Date', 'nextdestina-booking' ),
        ];
    }

    /**
     * Sortable columns
     */
    protected function get_sortable_columns() {
        return [
            'id'     => [ 'id', true ],
            'rating' => [ 'rating', false ],
            'date'   => [ 'created_at', false ],
        ];
    }

    /**
     * Bulk actions
     */
    protected function get_bulk_actions() {
        return [
            'approve' => __( 'Approve', 'nextdestina-booking' ),
            'delete'  => __( 'Delete', 'nextdestina-booking' ),
        ];
    }

    public function process_bulk_action() {
        global $wpdb;
        $table = $wpdb->prefix . 'tour_ratings';

        // Security check
        if ( isset( $_POST['_wpnonce'] ) && ! empty( $_POST['id'] ) ) {
            $ids = array_map( 'intval', (array) $_POST['id'] );

            if ( $this->current_action() === 'approve' ) {
                foreach ( $ids as $id ) {
                    $wpdb->update( 
                        $table, 
                        [ 'status' => 'approved' ], 
                        [ 'id' => $id ], 
                        [ '%s' ], 
                        [ '%d' ] 
                    );
                }
            }

            if ( $this->current_action() === 'delete' ) {
                foreach ( $ids as $id ) {
                    $wpdb->delete( 
                        $table, 
                        [ 'id' => $id ], 
                        [ '%d' ] 
                    );
                }
            }
        }
    }
    
    /**
     * Checkbox column
     */
    protected function column_cb( $item ) {
        return sprintf(
            '<input type="checkbox" name="id[]" value="%s" />',
            $item['id']
        );
    }

    /**
     * Default column rendering
     */
    protected function column_default( $item, $column_name ) {
        switch ( $column_name ) {
            case 'id':
            case 'rating':
            case 'review':
            case 'date':
                return esc_html( $item[$column_name] );
            case 'tour':
                return '<a href="' . esc_url( get_edit_post_link( $item['tour_id'] ) ) . '">' . esc_html( $item['tour'] ) . '</a>';
            case 'user':
                return esc_html( $item['user'] );
            case 'status':
                return '<span class='.sanitize_html_class( strtolower($item['status'])).'>'.esc_html( $item['status'] ).'</span>';
            default:
                return print_r( $item, true ); // debug
        }
    }

    /**
     * Actions column
     */
    protected function column_id( $item ) {
        $actions = [];

        if ( $item['status'] === 'pending' ) {
            $actions['approve'] = sprintf(
                '<a href="%s">%s</a>',
                esc_url( wp_nonce_url( admin_url( 'admin-post.php?action=approve_tour_rating&id=' . $item['id'] ), 'approve_rating_' . $item['id'] ) ),
                __( 'Approve', 'nextdestina-booking' )
            );
        }

        $actions['delete'] = sprintf(
            '<a href="%s" onclick="return confirm(\'%s\')">%s</a>',
            esc_url( wp_nonce_url( admin_url( 'admin-post.php?action=delete_tour_rating&id=' . $item['id'] ), 'delete_rating_' . $item['id'] ) ),
            __( 'Are you sure?', 'nextdestina-booking' ),
            __( 'Delete', 'nextdestina-booking' )
        );

        return sprintf( '%s %s', $item['id'], $this->row_actions( $actions ) );
    }

    /**
     * Prepare data for display
     */
    public function prepare_items() {
        global $wpdb;
        $table = $wpdb->prefix . 'tour_ratings';
        
        // Process bulk actions first
        $this->process_bulk_action();

        // Sorting
        $orderby = ! empty( $_GET['orderby'] ) ? sanitize_sql_orderby( $_GET['orderby'] ) : 'created_at';
        $order   = ! empty( $_GET['order'] ) && in_array( strtoupper( $_GET['order'] ), ['ASC','DESC'] ) ? $_GET['order'] : 'DESC';

        $sql = "SELECT * FROM $table ORDER BY $orderby $order";
        $data = $wpdb->get_results( $sql, ARRAY_A );

        // Pagination
        $per_page     = 20;
        $current_page = $this->get_pagenum();
        $total_items  = count( $data );

        $this->items = array_slice( $data, ( $current_page-1 ) * $per_page, $per_page );

        // Format rows
        $this->items = array_map( function( $rating ) {
            $tour = get_post( $rating['tour_id'] );
            $user = $rating['user_id'] ? get_userdata( $rating['user_id'] ) : null;

            return [
                'id'       => intval( $rating['id'] ),
                'tour'     => $tour ? $tour->post_title : __( '(Deleted Tour)', 'nextdestina-booking' ),
                'tour_id'  => $rating['tour_id'],
                'user'     => $user ? $user->display_name : __( 'Guest', 'nextdestina-booking' ),
                'rating'   => intval( $rating['rating'] ) . ' ★',
                'review'   => $rating['review'],
                'status'   => ucfirst( $rating['status'] ),
                'date'     => $rating['created_at'],
            ];
        }, $this->items );

        // Set pagination
        $this->set_pagination_args( [
            'total_items' => $total_items,
            'per_page'    => $per_page,
            'total_pages' => ceil( $total_items / $per_page )
        ] );

        $this->_column_headers = [ $this->get_columns(), [], $this->get_sortable_columns() ];
    }
}

