<?php

function nd_generate_invoice_pdf($invoice_id) {
    if (!$invoice_id) return false;

    $upload_dir = wp_upload_dir();
    $invoice_dir = trailingslashit($upload_dir['basedir']) . 'invoices/';
    wp_mkdir_p($invoice_dir);

    $pdf_file = $invoice_dir . 'invoice-' . $invoice_id . '.pdf';

    // Generate only if not exists
    if (!file_exists($pdf_file)) {
        // Render the HTML

        $number = get_post_meta($invoice_id, '_invoice_number', true);
        $date   = get_post_meta($invoice_id, '_invoice_date', true);

        $user_id = get_post_meta($invoice_id, '_user_id', true);
        $user = get_userdata($user_id);
        $booking_id = get_post_meta($invoice_id, '_booking_id', true);

        $tour_id       = get_post_meta($booking_id, 'tour_id', true);
        $tour_title    = $tour_id ? get_the_title($tour_id) : '-';
        $travel_date   = get_post_meta($booking_id, 'travel_date', true);
        $num_travelers = get_post_meta($booking_id, 'num_travelers', true);
        $amount        = get_post_meta($invoice_id, '_amount', true);

        ob_start();
        ?>

        <style>
           .invoice-box {
                max-width: 850px;
                margin: auto;
                padding: 60px 30px 30px;
                border: 1px solid #ccc;
                line-height: 22px;
                font-family: "Inter", sans-serif;
            }
            .invoice-box .header {
                text-align: center;
                margin-bottom: 60px;
            }
            .invoice-box .header img {
                max-width: 180px;
                margin-bottom: 10px;
                background-color: ;
            }
            .invoice-box .header h2{
                margin: 0 0 10px;
            }
            .invoice-box .header p{
                margin: 0;
            }
            .invoice-box .section {
                margin-bottom: 20px;
            }
            .invoice-box .section-title {
                font-weight: bold;
                font-size: 15px;
                margin-bottom: 10px;
            }
            .invoice-box .two-column {
                margin-bottom: 30px;
            }
            .invoice-box .two-column .booking-info{
                float: left;
                margin: 0;
                padding: 0;
                list-style: none;
            }
            .invoice-box .two-column .booking-info li{
                color: #304137;
                font-size: 15px;
                margin-bottom: 5px;
            }
            .invoice-box .two-column .customer-info{
                float: right;
                margin: 0;
                padding: 0;
                list-style: none;
            }
            .invoice-box .two-column .customer-info li{
                color: #304137;
                font-size: 15px;
                margin-bottom: 5px;
            }
            .invoice-box .table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 10px;
            }
            .invoice-box .table td {
                padding: 10px;
                border: 1px solid #ddd;
                text-align: left;
                line-height: 1.3;
            }
            .invoice-box .table th {
                color: #fff;
                background: #ff8e3f;
                font-weight: bold;
                text-align: left;
                padding: 12px 10px;
                border: 1px solid #fff;
            }
            .invoice-box .totals {
                margin-top: 10px;
                width: 100%;
            }
            .invoice-box .totals td {
                padding: 8px;
                text-align: right;
            }
            .invoice-box .totals .label {
                text-align: left;
            }
            .invoice-box .footer {
                margin-top: 30px;
                font-size: 12px;
                text-align: center;
                color: #555;
            }
        </style>

        <div class="invoice-box">
            <div class="header">
                <h2><?php echo get_bloginfo( 'name' ); ?></h2>
                <p><?php esc_html_e('House 1A, Gulshan 1, Dhaka 1212', 'nextdestina-booking'); ?></p>
            </div>

            <div class="section two-column">
                <ul class="booking-info">
                    <li><strong><?php esc_html_e('Booking ID:', 'nextdestina-booking'); ?></strong> HB-<?php echo esc_html($booking_id); ?></li>
                    <li><strong><?php esc_html_e('Date:', 'nextdestina-booking'); ?></strong> <?php echo esc_html(date('D, d M, Y', strtotime($date))); ?></li>
                    <li><strong><?php esc_html_e('Receipt:', 'nextdestina-booking'); ?></strong> <?php echo esc_html($number); ?></li>
                </ul>
                <ul class="customer-info">
                    <li><strong><?php esc_html_e('Customer Name:', 'nextdestina-booking'); ?></strong> <?php echo esc_html($user->display_name); ?></li>
                    <li><strong><?php esc_html_e('Email:', 'nextdestina-booking'); ?></strong> <?php echo esc_html($user->user_email); ?></li>
                    <li><strong><?php esc_html_e('Payment Mode:', 'nextdestina-booking'); ?></strong> <?php esc_html_e('Online', 'nextdestina-booking'); ?></li>
                </ul>
                <div class="clear" style="clear: both; display: table;"></div>
            </div>

            <div class="section">
                <div class="section-title"><?php esc_html_e('Item Details', 'nextdestina-booking'); ?></div>
                <table class="table">
                    <thead>
                        <tr>
                            <th><?php esc_html_e('Item', 'nextdestina-booking'); ?></th>
                            <th><?php esc_html_e('Details', 'nextdestina-booking'); ?></th>
                            <th style="text-align:right;"><?php esc_html_e('Amount (USD)', 'nextdestina-booking'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php esc_html_e('Tour Booking', 'nextdestina-booking'); ?></td>
                            <td>
                                <?php echo esc_html($tour_title); ?><br>
                                <?php esc_html_e('Travel Date:', 'nextdestina-booking'); ?> <?php echo esc_html($travel_date); ?><br>
                                <?php esc_html_e('Persons:', 'nextdestina-booking'); ?> <?php echo esc_html($num_travelers); ?>
                            </td>
                            <td style="text-align:right;"><?php echo number_format_i18n($amount, 0); ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <table class="totals">
                <tr>
                    <td class="label"><?php esc_html_e('Sub Total:', 'nextdestina-booking'); ?></td>
                    <td><?php esc_html_e('USD', 'nextdestina-booking'); ?> <?php echo number_format_i18n($amount, 0); ?></td>
                </tr>
                <tr>
                    <td class="label"><?php esc_html_e('Discount:', 'nextdestina-booking'); ?></td>
                    <td><?php esc_html_e('USD 0', 'nextdestina-booking'); ?></td>
                </tr>
                <tr>
                    <td class="label"><?php esc_html_e('Convenience Charge:', 'nextdestina-booking'); ?></td>
                    <td><?php esc_html_e('USD 0', 'nextdestina-booking'); ?></td>
                </tr>
                <tr>
                    <td class="label"><strong><?php esc_html_e('Total Payment (Refundable):', 'nextdestina-booking'); ?></strong></td>
                    <td><strong><?php esc_html_e('USD', 'nextdestina-booking'); ?> <?php echo number_format_i18n($amount, 0); ?></strong></td>
                </tr>
            </table>

            <div class="footer">
                <?php esc_html_e('Need Help?', 'nextdestina-booking'); ?><br>
                <?php esc_html_e('+88 09678 332211', 'nextdestina-booking'); ?> | <?php echo get_option( 'admin_email' ); ?> | <?php echo get_option( 'siteurl' ); ?>
            </div>
        </div>

        <?php

        $html = ob_get_clean();

        // Generate PDF
        require_once TRAVELER_DASHBOARD_PLUGIN_DIR . 'includes/dompdf/autoload.inc.php';

        $dompdf = new \Dompdf\Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        file_put_contents($pdf_file, $dompdf->output());
    }

    return $pdf_file;
}

function nd_send_booking_notifications($booking_id, $amount_paid, $transaction_id) {
    $admin_email = get_option('admin_email');

    $user_id     = get_post_meta($booking_id, 'user_id', true);
    $user        = get_user_by('ID', $user_id);
    $user_email  = $user ? $user->user_email : get_post_meta($booking_id, 'guest_email', true);
    $user_name   = $user ? $user->display_name : 'Guest';

    $traveler_template = get_posts([
        'post_type'      => 'email_template',
        'title'          => 'traveler',
        'posts_per_page' => 1,
        'post_status'    => 'publish',
    ])[0] ?? null;

    $admin_template = get_posts([
        'post_type'      => 'email_template',
        'title'          => 'admin',
        'posts_per_page' => 1,
        'post_status'    => 'publish',
    ])[0] ?? null;

    // Extract template fields if available
    $user_subject      = $traveler_template ? get_post_meta($traveler_template->ID, '_user_email_subject', true) : '';
    $user_message_raw  = $traveler_template ? get_post_meta($traveler_template->ID, '_user_email_message', true) : '';

    $admin_subject     = $admin_template ? get_post_meta($admin_template->ID, '_admin_email_subject', true) : '';
    $admin_message_raw = $admin_template ? get_post_meta($admin_template->ID, '_admin_email_message', true) : '';

    $admin_payment_subject = $admin_template ? get_post_meta($admin_template->ID, '_admin_payment_subject', true) : '';
    $admin_payment_message = $admin_template ? get_post_meta($admin_template->ID, '_admin_payment_message', true) : '';

    //var_dump($admin_message_raw);

    // Fallback values if empty
    if (empty($user_subject)) {
        $user_subject = 'Booking Confirmation';
    }

    if (empty($user_message_raw)) {
        $user_message_raw = 'Dear {customer_name},<br><br>Your booking (ID: {booking_id}) has been confirmed.{transaction}';
    }

    if (empty($admin_subject)) {
        $admin_subject = 'New Booking Received';
    }

    if (empty($admin_message_raw)) {
        $admin_message_raw = 'A new booking has been received.<br><br>Booking ID: {booking_id}<br>Customer Email: {customer_email}';
    }

    if (empty($admin_payment_subject)) {
        $admin_payment_subject = 'New Payment Generated';
    }

    if (empty($admin_payment_message)) {
        $admin_payment_message = '{customer_name} payment money amount {paid_amount}. {customer_name} request for take booking. Transaction: #{transaction}';
    }

    // Replace placeholders
    $replacements = [
        '{booking_id}'     => $booking_id,
        '{customer_email}' => $user_email,
        '{customer_name}'  => $user_name,
        '{paid_amount}'  => $amount_paid,
        '{transaction}'  => $transaction_id,
    ];

    $message        = str_replace( array_keys($replacements), array_values($replacements), $user_message_raw );
    $admin_message  = str_replace(array_keys($replacements), array_values($replacements), $admin_message_raw);
    $payment_message  = str_replace(array_keys($replacements), array_values($replacements), $admin_payment_message);

    // Generate or retrieve invoice PDF path
    if ( class_exists( 'Traveler_Dashboard' ) ) {
        $instance = Traveler_Dashboard::get_instance();
        $invoice_id = $instance->global_functions->get_invoice_id_by_booking_id($booking_id);
    }

    $invoice_pdf_path = nd_generate_invoice_pdf($invoice_id);
    $attachments = file_exists($invoice_pdf_path) ? [$invoice_pdf_path] : [];
    
    // === Email Setup ===
    
    $email_notification = get_option('email_notification');

    $traveler_email_template = get_posts([
        'post_type'      => 'email_template',
        'title'          => 'Traveler',
        'posts_per_page' => 1,
        'post_status'    => 'publish',
    ]);
    $traveler_template_id = !empty($traveler_email_template) ? $traveler_email_template[0]->ID : 0;

    $user_booking_confirmation = get_post_meta($traveler_template_id, '_user_booking_confirmation_switch', true);

    $admin_email_template = get_posts([
        'post_type'      => 'email_template',
        'title'          => 'Admin',
        'posts_per_page' => 1,
        'post_status'    => 'publish',
    ]);
    $admin_template_id = !empty($admin_email_template) ? $admin_email_template[0]->ID : 0;

    $admin_booking_notice = get_post_meta($admin_template_id, '_admin_new_booking_switch', true);
    $admin_payment_notice = get_post_meta($admin_template_id, '_admin_new_payment_switch', true);

    // Send to traveler
    if ($email_notification == 1) {
        if ($user_booking_confirmation === 'yes') {
            if ( Nextdestina_Global_Functions::is_wp_mail_smtp_configured() ) {
                wp_mail($user_email, $user_subject, nl2br($message), ['Content-Type: text/html; charset=UTF-8'], $attachments);
            }
        }
    }

    // Send to admin
    if ($email_notification == 1) {
        if ($admin_booking_notice === 'yes') {
            if ( Nextdestina_Global_Functions::is_wp_mail_smtp_configured() ) {
                wp_mail($admin_email, $admin_subject, nl2br($admin_message), ['Content-Type: text/html; charset=UTF-8'], $attachments);
            }
        }
    }

    // Send to admin
    if ($email_notification == 1) {
        if ($admin_payment_notice === 'yes') {
            if ( Nextdestina_Global_Functions::is_wp_mail_smtp_configured() ) {
                wp_mail($admin_email, $admin_payment_subject, nl2br($payment_message), ['Content-Type: text/html; charset=UTF-8'], $attachments);
            }
        }
    }
}
