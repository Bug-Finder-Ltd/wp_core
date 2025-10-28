<?php if (isset($_GET['ticket_id'])):
    $ticket_id = absint($_GET['ticket_id']);
    $ticket = get_post($ticket_id);

    if ($ticket && $ticket->post_type === 'nd_support_ticket' && $ticket->post_author == get_current_user_id()):
        $replies = get_post_meta($ticket_id, '_nd_ticket_replies', true);
        if (!is_array($replies)) $replies = [];

        // Add original message to replies
        array_unshift($replies, [
            'user_id'     => $ticket->post_author,
            'message'     => $ticket->post_content,
            'datetime'    => get_the_date('Y-m-d H:i:s', $ticket),
            'is_original' => true
        ]);
        ?>

        <div class="message-container">
            <?php
                $admin_user = null;
                foreach ($replies as $reply) {
                    $user = get_userdata($reply['user_id']);
                    if (in_array('administrator', (array)$user->roles)) {
                        $admin_user = $user;
                        break;
                    }
                }
            ?>

            <div class="chat-box">
                <?php if ($admin_user): ?>
                    <div class="header-section">
                        <div class="profile-info">
                            <div class="thumbs-area">
                                <?php echo get_avatar($admin_user->ID, 45); ?>
                            </div>
                            <div class="content-area">
                                <div class="title"><?php echo esc_html($admin_user->display_name); ?></div>
                                <div class="description">
                                    <?php
                                    printf(
                                        esc_html__('Ticket #%1$s [%2$s]', 'nextdestina-booking'),
                                        esc_html($ticket_id),
                                        esc_html($ticket->post_title)
                                    );
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="chat-box-inner">
                    <?php foreach ($replies as $reply): 
                        $user = get_userdata($reply['user_id']);
                        $is_current_user = $reply['user_id'] === get_current_user_id();
                        $is_original = !empty($reply['is_original']);
                        $bubble_class = $is_current_user ? 'message-bubble-right' : 'message-bubble-left';
                        if ($is_original) {
                            $bubble_class = 'message-bubble-right original-message';
                        }
                        ?>
                        <div class="message-bubble <?php echo esc_attr($bubble_class); ?>">
                            <div class="message-thumbs"><?php echo get_avatar($user->ID, 30); ?></div>
                            <div class="message-text">
                                <?php echo nl2br(esc_html($reply['message'])); ?>

                                <?php if (!empty($reply['attachments'])): ?>
                                    <div class="attachments">
                                        <?php foreach ($reply['attachments'] as $url): ?>
                                            <div class="attachment">
                                                <a href="<?php echo esc_url($url); ?>" target="_blank"><?php esc_html_e('View Attachment', 'nextdestina-booking'); ?></a>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="chat-box-bottom">
                    <form id="user-ticket-reply-form" enctype="multipart/form-data">
                        <div class="file-preview-grid"></div>
                        <div class="input-group">
                            <div class="file-upload-wrapper">
                                <label class="file-upload-label">
                                    <i class="fa fa-paperclip"></i>
                                    <input type="file" name="reply_attachments[]" class="file-upload-input" multiple />
                                </label>
                            </div>
                            <textarea name="reply_message" class="form-control" placeholder="Your message..." required></textarea>
                            <input type="hidden" name="ticket_id" value="<?php echo esc_attr($ticket_id); ?>">
                            <button type="submit" class="message-send-btn">
                                <i class="fa-thin fa-paper-plane"></i><span></span>
                            </button>
                        </div>
                    </form>
                    <div id="nd-reply-response"></div>
                </div>
            </div>
        </div>
    <?php endif;
endif; ?>
