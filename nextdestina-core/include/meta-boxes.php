<?php

function nextdestina_add_post_format_metabox() {
    add_meta_box(
        'nextdestina_post_format_fields',
        __( 'Post Format Options', 'nextdestina' ),
        'nextdestina_post_format_metabox_callback',
        'post',
        'normal',
        'default'
    );
}
add_action( 'add_meta_boxes', 'nextdestina_add_post_format_metabox' );

function nextdestina_post_format_metabox_callback( $post ) {
    wp_nonce_field( 'nextdestina_save_post_format', 'nextdestina_post_format_nonce' );

    $gallery_images = get_post_meta( $post->ID, '_nextdestina_gallery_images', true );
    $video_url      = get_post_meta( $post->ID, '_nextdestina_video_url', true );
    $audio_url      = get_post_meta( $post->ID, '_nextdestina_audio_url', true );

    ?>
    <div id="nextdestina-format-fields-wrapper">

        <!-- Gallery -->
        <div class="nextdestina-field nextdestina-field-gallery">
            <p><strong><?php _e( 'Gallery Images', 'nextdestina' ); ?></strong></p>
            <div id="nextdestina-gallery-container">
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
            <input type="hidden" id="nextdestina_gallery_images" name="nextdestina_gallery_images" value="<?php echo esc_attr( implode( ',', (array) $gallery_images ) ); ?>">
            <button type="button" class="button" id="nextdestina-add-gallery"><?php _e( 'Add / Edit Gallery', 'nextdestina' ); ?></button>
        </div>

        <!-- Video -->
        <div class="nextdestina-field nextdestina-field-video">
            <p><strong><?php _e( 'Video URL', 'nextdestina' ); ?></strong></p>
            <input type="url" class="widefat" name="nextdestina_video_url" value="<?php echo esc_url( $video_url ); ?>" placeholder="https://">
        </div>

        <!-- Audio -->
        <div class="nextdestina-field nextdestina-field-audio">
            <p><strong><?php _e( 'Audio URL', 'nextdestina' ); ?></strong></p>
            <input type="url" class="widefat" name="nextdestina_audio_url" value="<?php echo esc_url( $audio_url ); ?>" placeholder="https://">
        </div>

    </div>
    <?php
}

function nextdestina_save_post_format_meta( $post_id ) {
    if ( ! isset( $_POST['nextdestina_post_format_nonce'] ) || ! wp_verify_nonce( $_POST['nextdestina_post_format_nonce'], 'nextdestina_save_post_format' ) ) {
        return;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;

    if ( isset( $_POST['nextdestina_gallery_images'] ) ) {
        $images = array_filter( array_map( 'intval', explode( ',', $_POST['nextdestina_gallery_images'] ) ) );
        update_post_meta( $post_id, '_nextdestina_gallery_images', $images );
    }
    if ( isset( $_POST['nextdestina_video_url'] ) ) {
        update_post_meta( $post_id, '_nextdestina_video_url', esc_url_raw( $_POST['nextdestina_video_url'] ) );
    }
    if ( isset( $_POST['nextdestina_audio_url'] ) ) {
        update_post_meta( $post_id, '_nextdestina_audio_url', esc_url_raw( $_POST['nextdestina_audio_url'] ) );
    }
}
add_action( 'save_post', 'nextdestina_save_post_format_meta' );
