<?php

function protine_add_post_format_metabox() {
    add_meta_box(
        'protine_post_format_fields',
        __( 'Post Format Options', 'protinecore' ),
        'protine_post_format_metabox_callback',
        'post',
        'normal',
        'default'
    );
}
add_action( 'add_meta_boxes', 'protine_add_post_format_metabox' );

function protine_post_format_metabox_callback( $post ) {
    wp_nonce_field( 'protine_save_post_format', 'protine_post_format_nonce' );

    $gallery_images = get_post_meta( $post->ID, '_protine_gallery_images', true );
    $video_url      = get_post_meta( $post->ID, '_protine_video_url', true );
    $audio_url      = get_post_meta( $post->ID, '_protine_audio_url', true );

    ?>
    <div id="protine-format-fields-wrapper">

        <!-- Gallery -->
        <div class="protine-field protine-field-gallery">
            <p><strong><?php _e( 'Gallery Images', 'protinecore' ); ?></strong></p>
            <div id="protine-gallery-container">
                <?php
                    if ( is_array( $gallery_images ) ) {
                        foreach ( $gallery_images as $image_id ) {
                            $thumb = wp_get_attachment_image( $image_id, 'thumbnail' );
                            echo '<div class="gallery-thumb a" data-id="' . esc_attr( $image_id ) . '">
                                    ' . $thumb . '
                                    <span class="remove-image"><span class="dashicons dashicons-no"></span></span>
                                  </div>';
                        }
                    }
                ?>
            </div>
            <input type="hidden" id="protine_gallery_images" name="protine_gallery_images" value="<?php echo esc_attr( implode( ',', (array) $gallery_images ) ); ?>">
            <button type="button" class="button" id="protine-add-gallery"><?php _e( 'Add / Edit Gallery', 'protinecore' ); ?></button>
        </div>

        <!-- Video -->
        <div class="protine-field protine-field-video">
            <p><strong><?php _e( 'Video URL', 'protinecore' ); ?></strong></p>
            <input type="url" class="widefat" name="protine_video_url" value="<?php echo esc_url( $video_url ); ?>" placeholder="https://">
        </div>

        <!-- Audio -->
        <div class="protine-field protine-field-audio">
            <p><strong><?php _e( 'Audio URL', 'protinecore' ); ?></strong></p>
            <input type="url" class="widefat" name="protine_audio_url" value="<?php echo esc_url( $audio_url ); ?>" placeholder="https://">
        </div>

    </div>
    <?php
}

function protine_save_post_format_meta( $post_id ) {
    if ( ! isset( $_POST['protine_post_format_nonce'] ) || ! wp_verify_nonce( $_POST['protine_post_format_nonce'], 'protine_save_post_format' ) ) {
        return;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;

    if ( isset( $_POST['protine_gallery_images'] ) ) {
        $images = array_filter( array_map( 'intval', explode( ',', $_POST['protine_gallery_images'] ) ) );
        update_post_meta( $post_id, '_protine_gallery_images', $images );
    }
    if ( isset( $_POST['protine_video_url'] ) ) {
        update_post_meta( $post_id, '_protine_video_url', esc_url_raw( $_POST['protine_video_url'] ) );
    }
    if ( isset( $_POST['protine_audio_url'] ) ) {
        update_post_meta( $post_id, '_protine_audio_url', esc_url_raw( $_POST['protine_audio_url'] ) );
    }
}
add_action( 'save_post', 'protine_save_post_format_meta' );

/*------------------
 Custom Image field
--------------------*/

function add_custom_product_image_metabox() {
    add_meta_box(
        'custom_product_image_box',
        esc_html__( 'Product Image for Home 2', 'protinecore' ),
        'render_custom_product_image_metabox',
        'product',
        'side',
        'low'
    );
}
add_action('add_meta_boxes', 'add_custom_product_image_metabox');

function render_custom_product_image_metabox($post) {
    $image_id = get_post_meta($post->ID, '_custom_product_image_id', true);
    $image_url = $image_id ? wp_get_attachment_image_url($image_id, 'thumbnail') : '';
    $has_image_class = $image_url ? 'has-image' : '';

    wp_nonce_field('save_custom_product_image', 'custom_product_image_nonce');
    ?>
    <div class="custom-product-image-field">
        <img id="custom_product_image_preview" class="custom-image-preview <?php echo esc_attr( $has_image_class ); ?>" src="<?php echo esc_url($image_url); ?>" />
        <input type="hidden" id="custom_product_image_id" name="custom_product_image_id" value="<?php echo esc_attr($image_id); ?>">
        <p>
            <button type="button" class="button upload_custom_image_button">
                <?php esc_html_e( 'Set product image', 'protinecore' ); ?>
            </button>
            <button type="button" class="button remove_custom_image_button">
                <?php esc_html_e( 'Remove', 'protinecore' ); ?>
            </button>
        </p>
    </div>
    <?php
}

function save_custom_product_image_metabox($post_id) {
    // Verify nonce
    if (!isset($_POST['custom_product_image_nonce']) || !wp_verify_nonce($_POST['custom_product_image_nonce'], 'save_custom_product_image')) {
        return;
    }

    // Check autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // Check user permissions
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    // Save field
    if (isset($_POST['custom_product_image_id'])) {
        update_post_meta($post_id, '_custom_product_image_id', sanitize_text_field($_POST['custom_product_image_id']));
    }
}
add_action('save_post_product', 'save_custom_product_image_metabox');
