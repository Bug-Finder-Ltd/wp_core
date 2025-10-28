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
<body <?php body_class('thank-you-page'); ?>>

    <div id="thank-you-content">
        <div class="text">
            <h1 class="title"><?php esc_html_e('Thank You!', 'nextdestina-booking'); ?></h1>
            <p class="description"><?php esc_html_e('Thanks a bunch for filling that out. It means a lot to us, just like you do! We really appreciate you giving us a moment of your time today. Thanks for being with us.', 'nextdestina-booking'); ?></p>
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