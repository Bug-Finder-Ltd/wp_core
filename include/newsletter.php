<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function nd_render_newsletter_form() {
    ob_start();

    if ( isset( $_GET['newsletter'] ) && $_GET['newsletter'] === 'success' ) {
        echo '<p class="newsletter-success">' . esc_html__( 'Thanks for subscribing!', 'protinecore' ) . '</p>';
    }
    ?>
    <form method="post" class="protine-newsletter-form">
        <input type="email" name="nd_newsletter_email" id="nd_newsletter_email" required placeholder="<?php esc_attr_e( 'Enter your email', 'protinecore' ); ?>">
        <?php wp_nonce_field( 'nd_newsletter_subscribe', 'nd_newsletter_nonce' ); ?>
        <button type="submit" name="nd_newsletter_submit">
            <i class="pi-paper-plane"></i>
        </button>
    </form>
    <?php
    return ob_get_clean();
}

function nd_handle_newsletter_form_submission() {
    if ( isset( $_POST['nd_newsletter_submit'] ) ) {
        if ( ! isset( $_POST['nd_newsletter_nonce'] ) || ! wp_verify_nonce( $_POST['nd_newsletter_nonce'], 'nd_newsletter_subscribe' ) ) {
            return;
        }

        global $wpdb;
        $table_name = $wpdb->prefix . 'nd_newsletter';

        $email = sanitize_email( $_POST['nd_newsletter_email'] );

        if ( ! is_email( $email ) ) {
            return; // Invalid email
        }

        // Insert (ignore duplicate emails)
        $wpdb->query(
            $wpdb->prepare(
                "INSERT IGNORE INTO $table_name (email) VALUES (%s)",
                $email
            )
        );

        // Redirect to avoid resubmission
        wp_safe_redirect( add_query_arg( 'newsletter', 'success', wp_get_referer() ) );
        exit;
    }
}
add_action( 'init', 'nd_handle_newsletter_form_submission' );

function nd_newsletter_admin_menu() {
    add_menu_page(
        __( 'Newsletter Subscribers', 'protinecore' ),
        __( 'Newsletter', 'protinecore' ),
        'manage_options',
        'nd-newsletter',
        'nd_newsletter_admin_page',
        'dashicons-email-alt',
        25
    );
}
add_action( 'admin_menu', 'nd_newsletter_admin_menu' );

function nd_newsletter_admin_page() {
    global $wpdb;
    $table_name  = $wpdb->prefix . 'nd_newsletter';
    $subscribers = $wpdb->get_results( "SELECT * FROM $table_name ORDER BY subscribed_at DESC" );

    if ( isset( $_GET['deleted'] ) && $_GET['deleted'] == 1 ) {
        echo '<div class="notice notice-success is-dismissible"><p>'
             . esc_html__( 'Subscriber deleted successfully.', 'protine-booking' )
             . '</p></div>';
    }
    ?>
    <div class="wrap">
        <h1><?php esc_html_e( 'Newsletter Subscribers', 'protinecore' ); ?></h1>

        <form method="post">
            <?php submit_button( __( 'Export as CSV', 'protinecore' ), 'secondary', 'nd_export_csv' ); ?>
        </form>

        <table class="widefat striped">
            <thead>
                <tr>
                    <th><?php esc_html_e( 'ID', 'protinecore' ); ?></th>
                    <th><?php esc_html_e( 'Email', 'protinecore' ); ?></th>
                    <th><?php esc_html_e( 'Subscribed At', 'protinecore' ); ?></th>
                    <th><?php esc_html_e( 'Action', 'protinecore' ); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php if ( $subscribers ) : ?>
                    <?php foreach ( $subscribers as $subscriber ) : ?>
                        <tr>
                            <td><?php echo esc_html( $subscriber->id ); ?></td>
                            <td><?php echo esc_html( $subscriber->email ); ?></td>
                            <td><?php echo esc_html( $subscriber->subscribed_at ); ?></td>
                            <td>
                                <a class="button" href="<?php echo wp_nonce_url( admin_url( 'admin.php?page=nd-newsletter&delete=' . $subscriber->id ), 'nd_delete_subscriber_' . $subscriber->id ); ?>" 
                                   onclick="return confirm('<?php esc_attr_e( 'Are you sure you want to delete this subscriber?', 'protine-booking' ); ?>')">
                                   <?php esc_html_e( 'Delete', 'protinecore' ); ?>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="3"><?php esc_html_e( 'No subscribers found.', 'protinecore' ); ?></td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php
}

function nd_newsletter_export_csv() {
    if ( isset( $_POST['nd_export_csv'] ) ) {
        global $wpdb;
        $table_name  = $wpdb->prefix . 'nd_newsletter';
        $subscribers = $wpdb->get_results( "SELECT * FROM $table_name ORDER BY subscribed_at DESC", ARRAY_A );

        if ( ! $subscribers ) {
            wp_die( __( 'No subscribers to export.', 'protinecore' ) );
        }

        // Set headers
        header( 'Content-Type: text/csv' );
        header( 'Content-Disposition: attachment;filename=newsletter-subscribers.csv' );

        $output = fopen( 'php://output', 'w' );

        // Column headers
        fputcsv( $output, [ 'ID', 'Email', 'Subscribed At' ] );

        // Rows
        foreach ( $subscribers as $subscriber ) {
            fputcsv( $output, $subscriber );
        }

        fclose( $output );
        exit;
    }
}
add_action( 'admin_init', 'nd_newsletter_export_csv' );

function nd_handle_delete_subscriber() {
    if ( isset( $_GET['delete'] ) ) {
        $id = intval( $_GET['delete'] );
        if ( ! $id ) return;

        if ( ! isset( $_GET['_wpnonce'] ) || ! wp_verify_nonce( $_GET['_wpnonce'], 'nd_delete_subscriber_' . $id ) ) {
            wp_die( __( 'Security check failed.', 'protinecore' ) );
        }

        global $wpdb;
        $table_name = $wpdb->prefix . 'nd_newsletter';
        $wpdb->delete( $table_name, [ 'id' => $id ], [ '%d' ] );

        // Redirect to avoid resubmission
        wp_safe_redirect( admin_url( 'admin.php?page=nd-newsletter&deleted=1' ) );
        exit;
    }
}
add_action( 'admin_init', 'nd_handle_delete_subscriber' );


