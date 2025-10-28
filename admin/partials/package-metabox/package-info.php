<?php
$package_location      = get_post_meta($post->ID, '_package_location', true);
$package_discount      = get_post_meta($post->ID, '_package_discount', true);

$gallery_images = get_post_meta( $post->ID, '_nextdestina_tour_gallery_images', true );

// Make sure we have an array of IDs
if ( is_string( $gallery_images ) ) {
    $gallery_images = explode( ',', $gallery_images );
}
$gallery_images = array_filter( array_map( 'intval', (array) $gallery_images ) );
?>
<style>

</style>
<div class="meta-box-group">
    <div class="group-head">
        <h4><?php esc_html_e('Package Info', 'nextdestina-booking'); ?></h4>
    </div>
    <div class="meta-box-grid">
        <div class="field">
            <label for="package_location"><?php esc_html_e('Location', 'nextdestina-booking'); ?></label>
            <input type="text" name="_package_location" id="package_location" value="<?php echo esc_attr($package_location); ?>">
        </div>
        <div class="field">
            <label for="package_discount"><?php esc_html_e('Discount', 'nextdestina-booking'); ?></label>
            <input type="text" name="_package_discount" id="package_discount" value="<?php echo esc_attr($package_discount); ?>">
        </div>
        <div class="field">
            <label for="nextdestina_tour_gallery_images"><?php esc_html_e( 'Tour Gallery Images', 'nextdestina-booking' ); ?></label>
            <?php if ( ! empty( $gallery_images ) ) : ?>
                <div id="nextdestina-tour-gallery-container">
                    <?php
                    foreach ( $gallery_images as $image_id ) {
                        echo '<div class="gallery-thumb" data-id="' . esc_attr( $image_id ) . '">'
                        . wp_get_attachment_image( $image_id, 'thumbnail' )
                        . '<span class="remove-image">&times;</span>'
                        . '</div>';
                    }
                    ?>
                </div>
            <?php endif; ?>
            <input type="hidden" id="nextdestina_tour_gallery_images" name="nextdestina_tour_gallery_images" value="<?php echo esc_attr( implode( ',', $gallery_images ) ); ?>">
            <button type="button" class="button" id="nextdestina-tour-add-gallery"><?php esc_html_e( 'Add / Edit Gallery', 'nextdestina' ); ?></button>
        </div>
    </div>
</div>
