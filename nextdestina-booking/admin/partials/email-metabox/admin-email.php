<?php
$admin_email_subject      = get_post_meta($post->ID, '_admin_email_subject', true);
if (empty($admin_email_subject)) {
    $admin_email_subject = 'New Booking Received';
}

$admin_new_booking_switch    = get_post_meta($post->ID, '_admin_new_booking_switch', true);

$admin_email_message = get_post_meta($post->ID, '_admin_email_message', true);
if (empty($admin_email_message)) {
    $admin_email_message = 'A new booking has been received.<br><br>Booking ID: {booking_id}<br>Customer Email: {customer_email}';
}

// Payment

$admin_payment_subject      = get_post_meta($post->ID, '_admin_payment_subject', true);
if (empty($admin_payment_subject)) {
    $admin_payment_subject = 'New Payment Generated';
}

$admin_new_payment_switch    = get_post_meta($post->ID, '_admin_new_payment_switch', true);

$admin_payment_message = get_post_meta($post->ID, '_admin_payment_message', true);
if (empty($admin_payment_message)) {
    $admin_payment_message = '{customer_name} payment money amount {paid_amount}. {customer_name} request for take booking. Transaction: #{transaction}';
}

// Ticket

$admin_ticket_subject      = get_post_meta($post->ID, '_admin_ticket_subject', true);
if (empty($admin_ticket_subject)) {
    $admin_ticket_subject = 'New Support Request';
}
$admin_ticket_message = get_post_meta($post->ID, '_admin_ticket_message', true);
if (empty($admin_ticket_message)) {
    $admin_ticket_message = 'A new support ticket has been submitted by {user_name}.<br><br>Subject: {subject}<br>Message:<br>{message}<br><br>Attachment: {attachment}<br><a href="{ticket_link}">View Ticket</a>';
}
$support_request_email    = get_post_meta($post->ID, '_support_request_email', true);

// User Reply

$ticket_user_reply_subject      = get_post_meta($post->ID, '_ticket_user_reply_subject', true);
if (empty($ticket_user_reply_subject)) {
    $ticket_user_reply_subject = 'New User Reply';
}

$ticket_user_reply_switch    = get_post_meta($post->ID, '_ticket_user_reply_switch', true);

$ticket_user_reply_message = get_post_meta($post->ID, '_ticket_user_reply_message', true);
if (empty($ticket_user_reply_message)) {
    $ticket_user_reply_message = 'A new reply has been added by {user_name} to the ticket titled "{ticket_title}".<br><br>Message:<br>{message}';
}
?>

<div class="meta-box-group">
    <div class="group-head">
        <h4><?php esc_html_e('New Booking', 'nextdestina-booking'); ?></h4>
    </div>
    <div class="meta-box-grid">
        <div class="field">
            <label for="admin_email_subject"><?php esc_html_e('Admin Email Subject', 'nextdestina-booking'); ?></label>
            <input type="text" name="_admin_email_subject" id="admin_email_subject" value="<?php echo esc_attr($admin_email_subject); ?>">
        </div>
        <div class="field">
            <label class="switch">
                <input type="checkbox" name="_admin_new_booking_switch" value="yes" <?php checked($admin_new_booking_switch, 'yes'); ?>>
                <span class="slider round"></span>
            </label>
            <p style="margin-top:6px;"><?php esc_html_e('Enable status for email notification.', 'nextdestina-booking'); ?></p>
        </div>
        <div class="field">
            <label for="admin_email_message"><?php esc_html_e('Admin Email Message', 'nextdestina-booking'); ?></label>
            <?php
            wp_editor(
                $admin_email_message,
                '_admin_email_message',
                [
                    'textarea_name' => '_admin_email_message',
                    'media_buttons' => false,
                    'textarea_rows' => 8,
                    'teeny'         => true,
                ]
            );
            ?>
        </div>
        <div class="available-shortcode">
            <table>
                <thead class="thead-light">
                    <tr>
                        <th><?php esc_html_e('Shortcode', 'nextdestina-booking'); ?></th>
                        <th><?php esc_html_e('Description', 'nextdestina-booking'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><pre><?php echo esc_html('{customer_email}'); ?></pre></td>
                        <td><?php esc_html_e('User Email', 'nextdestina-booking'); ?></td>
                    </tr>
                    <tr>
                        <td><pre><?php echo esc_html('{booking_id}'); ?></pre></td>
                        <td><?php esc_html_e('Booking ID', 'nextdestina-booking'); ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="meta-box-group">
    <div class="group-head">
        <h4><?php esc_html_e('Payment', 'nextdestina-booking'); ?></h4>
    </div>
    <div class="meta-box-grid">
        <div class="field">
            <label for="admin_payment_subject"><?php esc_html_e('Admin Payment Subject', 'nextdestina-booking'); ?></label>
            <input type="text" name="_admin_payment_subject" id="admin_payment_subject" value="<?php echo esc_attr($admin_payment_subject); ?>">
        </div>
        <div class="field">
            <label class="switch">
                <input type="checkbox" name="_admin_new_payment_switch" value="yes" <?php checked($admin_new_payment_switch, 'yes'); ?>>
                <span class="slider round"></span>
            </label>
            <p style="margin-top:6px;"><?php esc_html_e('Enable status for email notification.', 'nextdestina-booking'); ?></p>
        </div>
        <div class="field">
            <label for="admin_payment_message"><?php esc_html_e('Admin Payment Message', 'nextdestina-booking'); ?></label>
            <?php
            wp_editor(
                $admin_payment_message,
                '_admin_payment_message',
                [
                    'textarea_name' => '_admin_payment_message',
                    'media_buttons' => false,
                    'textarea_rows' => 8,
                    'teeny'         => true,
                ]
            );
            ?>
        </div>
        <div class="available-shortcode">
            <table>
                <thead class="thead-light">
                    <tr>
                        <th><?php esc_html_e('Shortcode', 'nextdestina-booking'); ?></th>
                        <th><?php esc_html_e('Description', 'nextdestina-booking'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><pre><?php echo esc_html('{customer_name}'); ?></pre></td>
                        <td><?php esc_html_e('User Name', 'nextdestina-booking'); ?></td>
                    </tr>
                    <tr>
                        <td><pre><?php echo esc_html('{paid_amount}'); ?></pre></td>
                        <td><?php esc_html_e('Total Paid amount', 'nextdestina-booking'); ?></td>
                    </tr>
                    <tr>
                        <td><pre><?php echo esc_html('{transaction}'); ?></pre></td>
                        <td><?php esc_html_e('Transaction ID', 'nextdestina-booking'); ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="meta-box-group">
    <div class="group-head">
        <h4><?php esc_html_e('Support Request', 'nextdestina-booking'); ?></h4>
    </div>
    <div class="meta-box-grid">
        <div class="field">
            <label for="admin_ticket_subject"><?php esc_html_e('Admin Ticket Subject', 'nextdestina-booking'); ?></label>
            <input type="text" name="_admin_ticket_subject" id="admin_ticket_subject" value="<?php echo esc_attr($admin_ticket_subject); ?>">
        </div>
        <div class="field">
            <label class="switch">
                <input type="checkbox" name="_support_request_email" value="yes" <?php checked($support_request_email, 'yes'); ?>>
                <span class="slider round"></span>
            </label>
            <p style="margin-top:6px;"><?php esc_html_e('Enable status for email notification.', 'nextdestina-booking'); ?></p>
        </div>
        <div class="field">
            <label for="admin_ticket_message"><?php esc_html_e('Admin Ticket Message', 'nextdestina-booking'); ?></label>
            <?php
            wp_editor(
                $admin_ticket_message,
                '_admin_ticket_message',
                [
                    'textarea_name' => '_admin_ticket_message',
                    'media_buttons' => false,
                    'textarea_rows' => 8,
                    'teeny'         => true,
                ]
            );
            ?>
        </div>
        <div class="available-shortcode">
            <table>
                <thead class="thead-light">
                    <tr>
                        <th><?php esc_html_e('Shortcode', 'nextdestina-booking'); ?></th>
                        <th><?php esc_html_e('Description', 'nextdestina-booking'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><pre><?php echo esc_html('{user_name}'); ?></pre></td>
                        <td><?php esc_html_e('User Name', 'nextdestina-booking'); ?></td>
                    </tr>
                    <tr>
                        <td><pre><?php echo esc_html('{subject}'); ?></pre></td>
                        <td><?php esc_html_e('Subject', 'nextdestina-booking'); ?></td>
                    </tr>
                    <tr>
                        <td><pre><?php echo esc_html('{message}'); ?></pre></td>
                        <td><?php esc_html_e('Message', 'nextdestina-booking'); ?></td>
                    </tr>
                    <tr>
                        <td><pre><?php echo esc_html('{attachment}'); ?></pre></td>
                        <td><?php esc_html_e('Attachment', 'nextdestina-booking'); ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="meta-box-group">
    <div class="group-head">
        <h4><?php esc_html_e('Support User Reply', 'nextdestina-booking'); ?></h4>
    </div>
    <div class="meta-box-grid">
        <div class="field">
            <label for="ticket_user_reply_subject"><?php esc_html_e('Reply Ticket Subject', 'nextdestina-booking'); ?></label>
            <input type="text" name="_ticket_user_reply_subject" id="ticket_user_reply_subject" value="<?php echo esc_attr($ticket_user_reply_subject); ?>">
        </div>
        <div class="field">
            <label class="switch">
                <input type="checkbox" name="_ticket_user_reply_switch" value="yes" <?php checked($ticket_user_reply_switch, 'yes'); ?>>
                <span class="slider round"></span>
            </label>
            <p style="margin-top:6px;"><?php esc_html_e('Enable status for email notification.', 'nextdestina-booking'); ?></p>
        </div>
        <div class="field">
            <label for="ticket_user_reply_message"><?php esc_html_e('User Reply Message', 'nextdestina-booking'); ?></label>
            <?php
            wp_editor(
                $ticket_user_reply_message,
                '_ticket_user_reply_message',
                [
                    'textarea_name' => '_ticket_user_reply_message',
                    'media_buttons' => false,
                    'textarea_rows' => 8,
                    'teeny'         => true,
                ]
            );
            ?>
        </div>
        <div class="available-shortcode">
            <table>
                <thead class="thead-light">
                    <tr>
                        <th><?php esc_html_e('Shortcode', 'nextdestina-booking'); ?></th>
                        <th><?php esc_html_e('Description', 'nextdestina-booking'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><pre><?php echo esc_html('{user_name}'); ?></pre></td>
                        <td><?php esc_html_e('User Name', 'nextdestina-booking'); ?></td>
                    </tr>
                    <tr>
                        <td><pre><?php echo esc_html('{ticket_title}'); ?></pre></td>
                        <td><?php esc_html_e('Subject', 'nextdestina-booking'); ?></td>
                    </tr>
                    <tr>
                        <td><pre><?php echo esc_html('{message}'); ?></pre></td>
                        <td><?php esc_html_e('Message', 'nextdestina-booking'); ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>