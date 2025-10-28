<?php
/**
 * Dashboard Bookings Page with Filters
 *
 * @package TravelerDashboard
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Get filters from URL (sanitize)
$filter_package   = isset($_GET['package']) ? sanitize_text_field($_GET['package']) : '';
$filter_date_from = isset($_GET['date_from']) ? sanitize_text_field($_GET['date_from']) : '';
$filter_date_to   = isset($_GET['date_to']) ? sanitize_text_field($_GET['date_to']) : '';

// Get all user favorites (array: [tour_id => added_date])
$favorites = Nextdestina_Favorites::get_user_favorites();

// Filter favorites by date range if filter is set
if (!empty($filter_date_from) || !empty($filter_date_to)) {
    $from_timestamp = !empty($filter_date_from) ? strtotime($filter_date_from . ' 00:00:00') : false;
    $to_timestamp   = !empty($filter_date_to) ? strtotime($filter_date_to . ' 23:59:59') : false;

    foreach ($favorites as $tour_id => $added_at) {
        if (empty($added_at)) {
            unset($favorites[$tour_id]);
            continue;
        }

        $added_timestamp = strtotime($added_at);
        if ($added_timestamp === false) {
            // Invalid date format in stored favorite, skip it
            unset($favorites[$tour_id]);
            continue;
        }

        if ($from_timestamp && $added_timestamp < $from_timestamp) {
            unset($favorites[$tour_id]);
            continue;
        }

        if ($to_timestamp && $added_timestamp > $to_timestamp) {
            unset($favorites[$tour_id]);
            continue;
        }
    }
}

// Get the filtered tour IDs
$tour_ids = is_array($favorites) ? array_keys($favorites) : [];

// Prepare query only if we have tour IDs to show
if (!empty($tour_ids)) {
    $query_args = [
        'post_type'      => 'tour',
        'post__in'       => $tour_ids,
        'orderby'        => 'post__in',
        'posts_per_page' => -1,
    ];

    // Search filter by package name
    if ($filter_package) {
        $query_args['s'] = $filter_package;
    }

    $query = new WP_Query($query_args);
} else {
    $query = null; // no favorites match filter, no query needed
}
?>

<div class="card">
    <div class="card-header d-flex justify-content-between border-0">
        <h4><?php esc_html_e('Favourite List', 'nextdestina-booking'); ?></h4>
        <div class="btn-area">
            <button type="button" class="cmn-btn" data-bs-toggle="offcanvas" data-bs-target="#favoritesFilter" aria-controls="favoritesFilter">
                <?php esc_html_e('Filter', 'nextdestina-booking'); ?>
                <i class="fa-regular fa-filter"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        <div class="cmn-table">
            <div class="table-responsive overflow-hidden">
                <table class="table table-striped align-middle">
                    <thead>
                        <tr>
                            <th scope="col"><?php esc_html_e('SL No.', 'nextdestina-booking'); ?></th>
                            <th scope="col"><?php esc_html_e('Package', 'nextdestina-booking'); ?></th>
                            <th scope="col"><?php esc_html_e('Price', 'nextdestina-booking'); ?></th>
                            <th scope="col"><?php esc_html_e('Added At', 'nextdestina-booking'); ?></th>
                            <th scope="col"><?php esc_html_e('Action', 'nextdestina-booking'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($query && $query->have_posts()) : ?>
                            <?php $index = 1; ?>
                            <?php while ($query->have_posts()) : $query->the_post(); ?>
                                <?php
                                $tour_id  = get_the_ID();
                                $title    = get_the_title();
                                $link     = get_permalink();
                                $price    = get_field('price', $tour_id);
                                $added_at = isset($favorites[$tour_id]) ? $favorites[$tour_id] : '';
                                ?>
                                <tr>
                                    <td data-label="<?php esc_attr_e('SL No.', 'nextdestina-booking'); ?>">
                                        <span><?php echo esc_html($index++); ?></span>
                                    </td>
                                    <td data-label="<?php esc_attr_e('Package', 'nextdestina-booking'); ?>">
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="image">
                                                <?php the_post_thumbnail(); ?>
                                            </div>
                                            <span><?php echo esc_html($title); ?></span>
                                        </div>
                                    </td>
                                    <td data-label="<?php esc_attr_e('Price', 'nextdestina-booking'); ?>">
                                        <span><?php echo esc_html($price ? '$' . number_format_i18n($price, 0) : '-'); ?></span>
                                    </td>
                                    <td data-label="<?php esc_attr_e('Added At', 'nextdestina-booking'); ?>">
                                        <span><?php echo esc_html($added_at ? date_i18n('F j, Y', strtotime($added_at)) : '-'); ?></span>
                                    </td>
                                    <td data-label="<?php esc_attr_e('Action', 'nextdestina-booking'); ?>">
                                        <a href="<?php echo esc_url($link); ?>" class="btn btn-outline-light btn-sm text-dark">
                                            <i class="fa-regular fa-eye"></i>
                                            <?php esc_html_e('Details', 'nextdestina-booking'); ?>
                                        </a>
                                    </td>
                                </tr>
                            <?php endwhile; wp_reset_postdata(); ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="5" class="text-center">
                                    <?php esc_html_e('You haven’t saved any favorites yet!', 'nextdestina-booking'); ?>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Offcanvas Filter -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="favoritesFilter" aria-labelledby="favoritesFilterLabel">
    <div class="offcanvas-header">
        <h5 id="favoritesFilterLabel"><?php esc_html_e('Filter Favorites', 'nextdestina-booking'); ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <form method="get">
            <div class="mb-3">
                <label class="form-label"><?php esc_html_e('Package Name', 'nextdestina-booking'); ?></label>
                <input type="text" name="package" class="form-control" value="<?php echo esc_attr($_GET['package'] ?? ''); ?>">
            </div>
            <div class="mb-3">
                <label class="form-label"><?php esc_html_e('Date From', 'nextdestina-booking'); ?></label>
                <input type="text" name="date_from" class="form-control dob-datepicker" style="background: #fff;" value="<?php echo esc_attr($_GET['date_from'] ?? ''); ?>">
            </div>
            <div class="mb-3">
                <label class="form-label"><?php esc_html_e('Date To', 'nextdestina-booking'); ?></label>
                <input type="text" name="date_to" class="form-control dob-datepicker" style="background: #fff;" value="<?php echo esc_attr($_GET['date_to'] ?? ''); ?>">
            </div>
            <button type="submit" class="btn btn-primary w-100"><?php esc_html_e('Apply Filter', 'nextdestina-booking'); ?></button>

            <?php if (!empty($_GET['package']) || !empty($_GET['date_from']) || !empty($_GET['date_to'])) : ?>
                <a href="<?php echo esc_url(remove_query_arg(['package', 'date_from', 'date_to'])); ?>" class="btn btn-outline-secondary w-100 mt-2">
                    <?php esc_html_e('Reset Filter', 'nextdestina-booking'); ?>
                </a>
            <?php endif; ?>
        </form>
    </div>
</div>
