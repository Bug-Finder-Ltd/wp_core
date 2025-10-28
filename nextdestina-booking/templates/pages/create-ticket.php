<?php
/**
 * Dashboard Create Ticket Page
 *
 * @package NextdestinaBooking
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

?>

<div class="card">
    <div class="card-body">
        <?php if (is_user_logged_in()): ?>
            <form id="create-ticket-form" enctype="multipart/form-data">
                <input class="form-control" type="text" name="subject" placeholder="Subject" required><br>
                <textarea class="form-control" name="message" rows="5" placeholder="Describe your issue" required></textarea><br>
                <input class="form-control" type="file" name="attachment[]" multiple><br>
                <button type="submit" class="btn-1">
                    <?php esc_html_e('Submit Ticket', 'nextdestina-booking'); ?>
                    <span></span>
                </button>
            </form>
            <div id="nd-ticket-response"></div>
        <?php else: ?>
            <p><?php esc_html_e('You must be logged in to submit a ticket.', 'nextdestina-booking'); ?></p>
        <?php endif; ?>
    </div>
</div>
