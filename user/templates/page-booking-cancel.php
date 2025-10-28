<?php
/**
 * Template for Thank You Page
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <?php wp_head(); ?>
</head>
<body <?php body_class('booking-cancel-page'); ?>>

    <div id="booking-cancel-content">
        <div class="text">
            <h1 class="title"><?php esc_html_e('Booking Cancelled', 'nextdestina-booking'); ?></h1>
            <p class="description"><?php esc_html_e('Your booking was not completed. If you believe this is an error, please try again or contact us for help.', 'nextdestina-booking'); ?></p>
            <a class="btn-1" href="<?php echo esc_url(home_url( '/' )); ?>">
                <?php esc_html_e('Go back to Home', 'nextdestina-booking'); ?>
                <span></span>
            </a>
            <?php if ( function_exists( 'nextdestina_copyright_text' ) ) : ?>
                <p class="copyright-text"><?php print nextdestina_copyright_text(); ?></p>
            <?php endif; ?>
        </div>
    </div>

<?php wp_footer(); ?>
</body>
</html>