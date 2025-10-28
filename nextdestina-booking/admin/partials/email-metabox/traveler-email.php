<?php

$registration_email_subject = get_post_meta($post->ID, '_registration_email_subject', true);
if (empty($registration_email_subject)) {
    $registration_email_subject = 'Verify Your Email';
}

$registration_email_switch    = get_post_meta($post->ID, '_registration_email_switch', true);

$registration_email_message = get_post_meta($post->ID, '_registration_email_message', true);
if (empty($registration_email_message)) {
    $registration_email_message = "Hello {first_name}, please click the link below to verify your email: {verification_link}";
}

// Booking

$user_email_subject = get_post_meta($post->ID, '_user_email_subject', true);
if (empty($user_email_subject)) {
    $user_email_subject = 'Booking Confirmation';
}

$user_booking_confirmation_switch    = get_post_meta($post->ID, '_user_booking_confirmation_switch', true);

$user_email_message = get_post_meta($post->ID, '_user_email_message', true);
if (empty($user_email_message)) {
    $user_email_message = "Dear {customer_name},\n\nYour booking (ID: {booking_id}) has been confirmed.";
}

// Password Reset

$reset_password_subject      = get_post_meta($post->ID, '_reset_password_subject', true);
if (empty($reset_password_subject)) {
    $reset_password_subject = 'Reset Your Password';
}

$user_pass_reset_switch    = get_post_meta($post->ID, '_user_pass_reset_switch', true);

$reset_password_message = get_post_meta($post->ID, '_reset_password_message', true);
if (empty($reset_password_message)) {
    $reset_password_message = 'Click the link to reset your password:';
}

// Support Reply

$support_reply_subject      = get_post_meta($post->ID, '_support_reply_subject', true);
if (empty($support_reply_subject)) {
    $support_reply_subject = 'New Reply to Ticket';
}
$support_reply_message = get_post_meta($post->ID, '_support_reply_message', true);
if (empty($support_reply_message)) {
    $support_reply_message = 'Hi {customer_name},<br><br>You have received a new reply to your support ticket #{ticket_id}.<br><br><strong>Message:</strong><br>{message}';
}
$send_support_reply_email    = get_post_meta($post->ID, '_send_support_reply_email', true);
?>

<div class="meta-box-group">
    <div class="group-head">
        <h4><?php esc_html_e('Registration', 'nextdestina-booking'); ?></h4>
    </div>
    <div class="meta-box-grid">
        <div class="field">
            <label for="registration_email_subject"><?php esc_html_e('Email Subject', 'nextdestina-booking'); ?></label>
            <input type="text" name="_registration_email_subject" id="registration_email_subject" value="<?php echo esc_attr($registration_email_subject); ?>">
        </div>
        <div class="field">
            <label class="switch">
                <input type="checkbox" name="_registration_email_switch" value="yes" <?php checked($registration_email_switch, 'yes'); ?>>
                <span class="slider round"></span>
            </label>
            <p style="margin-top:6px;"><?php esc_html_e('Enable status for email notification.', 'nextdestina-booking'); ?></p>
        </div>
        <div class="field">
            <label for="registration_email_message"><?php esc_html_e('User Email Message', 'nextdestina-booking'); ?></label>
            <?php
            wp_editor(
                $registration_email_message,
                '_registration_email_message',
                [
                    'textarea_name' => '_registration_email_message',
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
                        <td><pre><?php echo esc_html('{first_name}'); ?></pre></td>
                        <td><?php esc_html_e('User Name', 'nextdestina-booking'); ?></td>
                    </tr>
                    <tr>
                        <td><pre><?php echo esc_html('{verification_link}'); ?></pre></td>
                        <td><?php esc_html_e('Email Verification Link', 'nextdestina-booking'); ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="meta-box-group">
    <div class="group-head">
        <h4><?php esc_html_e('Booking Confirmation', 'nextdestina-booking'); ?></h4>
    </div>
    <div class="meta-box-grid">
        <div class="field">
            <label for="user_email_subject"><?php esc_html_e('User Email Subject', 'nextdestina-booking'); ?></label>
            <input type="text" name="_user_email_subject" id="user_email_subject" value="<?php echo esc_attr($user_email_subject); ?>">
        </div>
        <div class="field">
            <label class="switch">
                <input type="checkbox" name="_user_booking_confirmation_switch" value="yes" <?php checked($user_booking_confirmation_switch, 'yes'); ?>>
                <span class="slider round"></span>
            </label>
            <p style="margin-top:6px;"><?php esc_html_e('Enable status for email notification.', 'nextdestina-booking'); ?></p>
        </div>
        <div class="field">
            <label for="user_email_message"><?php esc_html_e('User Email Message', 'nextdestina-booking'); ?></label>
            <?php
            wp_editor(
                $user_email_message,
                '_user_email_message',
                [
                    'textarea_name' => '_user_email_message',
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
        <h4><?php esc_html_e('Password Reset', 'nextdestina-booking'); ?></h4>
    </div>
    <div class="meta-box-grid">
        <div class="field">
            <label for="reset_password_subject"><?php esc_html_e('Reset Password Subject', 'nextdestina-booking'); ?></label>
            <input type="text" name="_reset_password_subject" id="reset_password_subject" value="<?php echo esc_attr($reset_password_subject); ?>">
        </div>
        <div class="field">
            <label class="switch">
                <input type="checkbox" name="_user_pass_reset_switch" value="yes" <?php checked($user_pass_reset_switch, 'yes'); ?>>
                <span class="slider round"></span>
            </label>
            <p style="margin-top:6px;"><?php esc_html_e('Enable status for email notification.', 'nextdestina-booking'); ?></p>
        </div>
        <div class="field">
            <label for="reset_password_message"><?php esc_html_e('Reset Password Message', 'nextdestina-booking'); ?></label>
            <?php
            wp_editor(
                $reset_password_message,
                '_reset_password_message',
                [
                    'textarea_name' => '_reset_password_message',
                    'media_buttons' => false,
                    'textarea_rows' => 8,
                    'teeny'         => true,
                ]
            );
            ?>
        </div>
    </div>
</div>

<div class="meta-box-group">
    <div class="group-head">
        <h4><?php esc_html_e('Support Reply', 'nextdestina-booking'); ?></h4>
    </div>
    <div class="meta-box-grid">
        <div class="field">
            <label for="support_reply_subject"><?php esc_html_e('Support Reply Subject', 'nextdestina-booking'); ?></label>
            <input type="text" name="_support_reply_subject" id="support_reply_subject" value="<?php echo esc_attr($support_reply_subject); ?>">
        </div>
        <div class="field">
            <label class="switch">
                <input type="checkbox" name="_send_support_reply_email" value="yes" <?php checked($send_support_reply_email, 'yes'); ?>>
                <span class="slider round"></span>
            </label>
            <p style="margin-top:6px;"><?php esc_html_e('Enable status for email notification.', 'nextdestina-booking'); ?></p>
        </div>
        <div class="field">
            <label for="support_reply_message"><?php esc_html_e('Support Reply Message', 'nextdestina-booking'); ?></label>
            <?php
            wp_editor(
                $support_reply_message,
                '_support_reply_message',
                [
                    'textarea_name' => '_support_reply_message',
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
                        <td><pre><?php echo esc_html('{ticket_id}'); ?></pre></td>
                        <td><?php esc_html_e('Ticket ID', 'nextdestina-booking'); ?></td>
                    </tr>
                    <tr>
                        <td><pre><?php echo esc_html('{message}'); ?></pre></td>
                        <td><?php esc_html_e('Message', 'nextdestina-booking'); ?></td>
                    </tr>
                    <tr>
                        <td><pre><?php echo esc_html('{ticket_link}'); ?></pre></td>
                        <td><?php esc_html_e('Ticket Link', 'nextdestina-booking'); ?></td>
                    </tr>
                </tbody>
            </table>
            <span></span>
        </div>
    </div>
</div>