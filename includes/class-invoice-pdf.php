<?php
// Exit if accessed directly
if (!defined('ABSPATH')) exit;

require_once plugin_dir_path(__FILE__) . 'dompdf/autoload.inc.php';

use Dompdf\Dompdf;
use Dompdf\Options;

class Nextdestina_Invoice_PDF {

    public static function render_invoice_pdf($invoice_id) {

        $invoice = get_post($invoice_id);

        if (!$invoice || $invoice->post_type !== 'invoice') return;

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

        global $wpdb;
        $payment_method_table = $wpdb->prefix . 'payment_history';

        $payment_method = $wpdb->get_var(
            $wpdb->prepare(
                "SELECT payment_method FROM $payment_method_table WHERE booking_id = %d",
                $booking_id
            )
        );

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
                <?php
                    $image_url = get_option('invoice_logo');
                    if ($image_url && strpos($image_url, 'http') !== 0) {
                        $image_url = site_url($image_url);
                    }
                    if ($image_url) {
                        echo '<img src="' . esc_url($image_url) . '" alt="Uploaded Image" style="max-width: 100%;">';
                    }else{
                        echo '<h2>'.get_bloginfo( 'name' ).'</h2>';
                    }
                ?>
                <p>
                    <?php echo esc_html(get_option('invoice_address')); ?>
                </p>
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
                    <li><strong><?php esc_html_e('Payment Method:', 'nextdestina-booking'); ?></strong> <?php echo esc_html($payment_method); ?></li>
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
                <?php echo get_option('invoice_phone_number'); ?> | <?php echo get_option( 'admin_email' ); ?> | <?php echo get_option( 'siteurl' ); ?>
            </div>
        </div>

        <?php
        $html = ob_get_clean();

        $options = new Options();
        $options->set('isRemoteEnabled', true);
        $dompdf = new Dompdf($options);

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream("invoice-{$number}.pdf", ['Attachment' => true]);

        exit;
    }
}
