<?php
$current_user_id = get_current_user_id();

$args = [
    'post_type'      => 'nd_support_ticket',
    'post_status'    => 'publish',
    'posts_per_page' => -1,
    'author'         => $current_user_id,
];

$tickets = new WP_Query($args);
?>

<div class="card">
    <div class="card-header d-flex justify-content-between border-0">
        <h4><?php esc_html_e( 'My Support Tickets', 'nextdestina-booking' ); ?></h4>
        <div class="btn-area">
            <a class="cmn-btn" href="<?php echo esc_url(site_url('/my-dashboard/create-ticket')); ?>">Create Ticket</a>
        </div>
    </div>

    <div class="card-body">
        <div class="cmn-table">
            <div class="table-responsive overflow-hidden">
                <table class="table table-striped align-middle">
                    <thead>
                        <tr>
                            <th scope="col"><?php esc_html_e('Serial', 'nextdestina-booking'); ?></th>
                            <th scope="col"><?php esc_html_e('Subject', 'nextdestina-booking'); ?></th>
                            <th scope="col"><?php esc_html_e('status', 'nextdestina-booking'); ?></th>
                            <th scope="col"><?php esc_html_e('Last Reply', 'nextdestina-booking'); ?></th>
                            <th scope="col"><?php esc_html_e('Created At', 'nextdestina-booking'); ?></th>
                            <th scope="col"><?php esc_html_e('Action', 'nextdestina-booking'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($tickets->have_posts()) : ?>
                            <?php $serial = 0; ?>
                            <?php while ($tickets->have_posts()) : $tickets->the_post(); ?>
                                <?php $serial++; ?>
                                <tr>
                                    <td data-label="<?php esc_attr_e( 'serial', 'nextdestina-booking' ); ?>">
                                        <span><?php echo esc_html($serial); ?></span>
                                    </td>
                                    <td data-label="<?php esc_attr_e( 'subject', 'nextdestina-booking' ); ?>">
                                        <span><?php the_title(); ?></span>
                                    </td>

                                    <td data-label="<?php esc_attr_e( 'status', 'nextdestina-booking' ); ?>">
                                        <?php
                                            $status = get_post_meta(get_the_ID(), '_user_ticket_status', true);

                                            $status_classes = [
                                                'open'     => 'badge text-bg-info',
                                                'answered' => 'badge text-bg-success',
                                                'pending'  => 'badge text-bg-primary',
                                                'closed'   => 'badge text-bg-secondary',
                                            ];

                                            $badge_class = isset($status_classes[$status]) ? $status_classes[$status] : 'badge bg-light';

                                            echo '<span class="' . esc_attr($badge_class) . '">' . esc_html(ucfirst($status)) . '</span>';
                                        ?>
                                    </td>
                                    <td data-label="<?php esc_attr_e( 'reply', 'nextdestina-booking' ); ?>">
                                        <span>
                                        <?php
                                        $replies = get_post_meta(get_the_ID(), '_nd_ticket_replies', true);

                                        if (!empty($replies) && is_array($replies)) {
                                            $last_reply = end($replies);
                                            $datetime = $last_reply['datetime'] ?? '';

                                            if (!empty($datetime)) {
                                                $timestamp = strtotime($datetime);
                                                $human_diff = human_time_diff($timestamp, current_time('timestamp'));
                                                echo esc_html($human_diff . ' ago');
                                            } else {
                                                echo esc_html__('No reply yet', 'nextdestina-booking');
                                            }
                                        } else {
                                            echo esc_html__('No reply yet', 'nextdestina-booking');
                                        }
                                        ?>
                                        </span>
                                    </td>
                                    <td data-label="<?php esc_attr_e( 'created-at', 'nextdestina-booking' ); ?>">
                                        <span><?php echo get_the_date('F j, Y'); ?></span>
                                    </td>
                                    <td data-label="<?php esc_attr_e( 'action', 'nextdestina-booking' ); ?>">
                                        <a href="<?php echo esc_url(add_query_arg('ticket_id', get_the_ID(), site_url('/my-dashboard/ticket-details/'))); ?>" class="btn btn-outline-light btn-sm text-dark">
                                            <i class="fa-regular fa-eye pe-1"></i>
                                            Details
                                        </a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="5" class="text-center">
                                    <?php esc_html_e('No tickets found.', 'nextdestina-booking'); ?>
                                </td>
                            </tr>
                        <?php endif; ?>
                        <?php wp_reset_postdata(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

