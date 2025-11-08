<?php

/**
 * Add Page Settings Meta Box
 */
function zupet_add_page_settings_metabox() {
    add_meta_box(
        'zupet_page_settings',
        __( 'Page Settings', 'zupetcore' ),
        'zupet_page_settings_metabox',
        'page',
        'normal',
        'default'
    );
}
add_action( 'add_meta_boxes', 'zupet_add_page_settings_metabox' );

function zupet_page_settings_metabox( $post ) {
    // Security nonce
    wp_nonce_field( 'zupet_save_page_settings', 'zupet_page_settings_nonce' );

    // Get saved values
    $transparent_menu = get_post_meta( $post->ID, '_zupet_transparent_menu', true );
    ?>

    <div class="metabox-grid column-4">
        <div class="metabox-column">
            <p class="field-title"><?php esc_html_e( 'Transparent Header', 'zupetcore' ); ?></p>
            <div class="toggle-switch">
                <label class="zupet-switch">
                    <input type="checkbox" name="zupet_transparent_menu" value="1" <?php checked( $transparent_menu, '1' ); ?>>
                    <span class="zupet-slider round"></span>
                </label>
                <span class="switch-label"><?php esc_html_e( 'Enable transparent menu for this page', 'zupetcore' ); ?></span>
            </div>
        </div>
    </div>

    <?php
}

function zupet_save_page_settings( $post_id ) {
    // Verify nonce
    if ( ! isset( $_POST['zupet_page_settings_nonce'] ) || 
         ! wp_verify_nonce( $_POST['zupet_page_settings_nonce'], 'zupet_save_page_settings' ) ) {
        return;
    }

    // Prevent autosave / quick edit overwriting
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    // Check user capability
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    // Transparent header toggle
    $transparent_menu = isset( $_POST['zupet_transparent_menu'] ) ? '1' : '';
    update_post_meta( $post_id, '_zupet_transparent_menu', $transparent_menu );

}
add_action( 'save_post', 'zupet_save_page_settings' );


function zupet_add_post_format_metabox() {
    add_meta_box(
        'zupet_post_format_fields',
        __( 'Post Format Options', 'zupetcore' ),
        'zupet_post_format_metabox_callback',
        'post',
        'normal',
        'default'
    );
}
add_action( 'add_meta_boxes', 'zupet_add_post_format_metabox' );

function zupet_post_format_metabox_callback( $post ) {
    wp_nonce_field( 'zupet_save_post_format', 'zupet_post_format_nonce' );

    $gallery_images = get_post_meta( $post->ID, '_zupet_gallery_images', true );
    $video_url      = get_post_meta( $post->ID, '_zupet_video_url', true );
    $audio_url      = get_post_meta( $post->ID, '_zupet_audio_url', true );

    ?>
    <div id="zupet-format-fields-wrapper">

        <!-- Gallery -->
        <div class="zupet-field zupet-field-gallery">
            <p><strong><?php _e( 'Gallery Images', 'zupetcore' ); ?></strong></p>
            <div id="zupet-gallery-container">
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
            <input type="hidden" id="zupet_gallery_images" name="zupet_gallery_images" value="<?php echo esc_attr( implode( ',', (array) $gallery_images ) ); ?>">
            <button type="button" class="button" id="zupet-add-gallery"><?php _e( 'Add / Edit Gallery', 'zupetcore' ); ?></button>
        </div>

        <!-- Video -->
        <div class="zupet-field zupet-field-video">
            <p><strong><?php _e( 'Video URL', 'zupetcore' ); ?></strong></p>
            <input type="url" class="widefat" name="zupet_video_url" value="<?php echo esc_url( $video_url ); ?>" placeholder="https://">
        </div>

        <!-- Audio -->
        <div class="zupet-field zupet-field-audio">
            <p><strong><?php _e( 'Audio URL', 'zupetcore' ); ?></strong></p>
            <input type="url" class="widefat" name="zupet_audio_url" value="<?php echo esc_url( $audio_url ); ?>" placeholder="https://">
        </div>

    </div>
    <?php
}

function zupet_save_post_format_meta( $post_id ) {
    if ( ! isset( $_POST['zupet_post_format_nonce'] ) || ! wp_verify_nonce( $_POST['zupet_post_format_nonce'], 'zupet_save_post_format' ) ) {
        return;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;

    if ( isset( $_POST['zupet_gallery_images'] ) ) {
        $images = array_filter( array_map( 'intval', explode( ',', $_POST['zupet_gallery_images'] ) ) );
        update_post_meta( $post_id, '_zupet_gallery_images', $images );
    }
    if ( isset( $_POST['zupet_video_url'] ) ) {
        update_post_meta( $post_id, '_zupet_video_url', esc_url_raw( $_POST['zupet_video_url'] ) );
    }
    if ( isset( $_POST['zupet_audio_url'] ) ) {
        update_post_meta( $post_id, '_zupet_audio_url', esc_url_raw( $_POST['zupet_audio_url'] ) );
    }
}
add_action( 'save_post', 'zupet_save_post_format_meta' );

/*------------------
 Custom Image field
--------------------*/

function add_custom_product_image_metabox() {
    add_meta_box(
        'custom_product_image_box',
        esc_html__( 'Product Image for Home 2', 'zupetcore' ),
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
                <?php esc_html_e( 'Set product image', 'zupetcore' ); ?>
            </button>
            <button type="button" class="button remove_custom_image_button">
                <?php esc_html_e( 'Remove', 'zupetcore' ); ?>
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
