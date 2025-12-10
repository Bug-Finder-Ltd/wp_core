<?php

/**
 * Add Page Settings Meta Box
 */
function raizen_add_page_settings_metabox() {
    add_meta_box(
        'raizen_page_settings',
        __( 'Page Settings', 'raizencore' ),
        'raizen_page_settings_metabox',
        'page',
        'normal',
        'default'
    );
}
add_action( 'add_meta_boxes', 'raizen_add_page_settings_metabox' );

function raizen_page_settings_metabox( $post ) {
    // Security nonce
    wp_nonce_field( 'raizen_save_page_settings', 'raizen_page_settings_nonce' );

    // Get saved values
    $transparent_menu = get_post_meta( $post->ID, '_raizen_transparent_menu', true );

    $saved_footer = get_post_meta( $post->ID, '_page_footer_id', true );
    $footer_posts = get_posts([
        'post_type'      => 'site_footer',
        'posts_per_page' => -1,
        'orderby'        => 'title',
        'order'          => 'ASC',
    ]);

    ?>

    <div class="metabox-grid column-4">
        <div class="metabox-column">
            <p class="field-title"><?php esc_html_e( 'Transparent Header', 'raizencore' ); ?></p>
            <div class="toggle-switch">
                <label class="raizen-switch">
                    <input type="checkbox" name="raizen_transparent_menu" value="1" <?php checked( $transparent_menu, '1' ); ?>>
                    <span class="raizen-slider round"></span>
                </label>
                <span class="switch-label"><?php esc_html_e( 'Enable transparent menu for this page', 'raizencore' ); ?></span>
            </div>
        </div>
        <div class="metabox-column">
            <p class="field-title"><?php esc_html_e( 'Select Footer', 'raizencore' ); ?></p>
            <select name="site_footer_select">
                <option value=""><?php esc_html_e( 'Default Theme Footer', 'raizencore' )?></option>
                <?php
                if ( ! empty( $footer_posts ) ) {
                    foreach ( $footer_posts as $footer ) {
                        echo '<option value="' . esc_attr( $footer->ID ) . '" ' . selected( $saved_footer, $footer->ID, false ) . '>';
                        echo esc_html( $footer->post_title );
                        echo '</option>';
                    }
                }
                ?>
            </select>
        </div>
    </div>

    <?php
}

function raizen_save_page_settings( $post_id ) {
    // Verify nonce
    if ( ! isset( $_POST['raizen_page_settings_nonce'] ) || 
         ! wp_verify_nonce( $_POST['raizen_page_settings_nonce'], 'raizen_save_page_settings' ) ) {
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
    $transparent_menu = isset( $_POST['raizen_transparent_menu'] ) ? '1' : '';
    update_post_meta( $post_id, '_raizen_transparent_menu', $transparent_menu );

    // Footer
    if ( isset( $_POST['site_footer_select'] ) ) {
        update_post_meta( $post_id, '_page_footer_id', sanitize_text_field( $_POST['site_footer_select'] ) );
    }

}
add_action( 'save_post', 'raizen_save_page_settings' );

/**
 * Portfolio Meta Box
 */

function raizen_portfolio_options_metabox() {
    add_meta_box(
        'raizen_portfolio_options',
        __( 'Portfolio Options', 'raizencore' ),
        'portfolio_options_callback',
        'portfolio',
        'normal',
        'default'
    );
}
add_action( 'add_meta_boxes', 'raizen_portfolio_options_metabox' );

function portfolio_options_callback( $post ) {
    // Security nonce
    wp_nonce_field( 'raizen_save_portfolio_options', 'raizen_portfolio_options_nonce' );

    $client_name   = get_post_meta( $post->ID, '_client_name', true );
    $duration      = get_post_meta( $post->ID, '_duration', true );
    $project_link  = get_post_meta( $post->ID, '_project_link', true );
    $social_icons = get_post_meta( $post->ID, '_social_icons', true ); // array
    ?>

    <div class="metabox-grid column-4">
        <div class="metabox-column">
            <p class="field-title"><?php esc_html_e( 'Client Name', 'raizencore' ); ?></p>
            <input type="text" name="client_name" class="regular-text" value="<?php echo esc_attr( $client_name ); ?>">
        </div>
        <div class="metabox-column">
            <p class="field-title"><?php esc_html_e( 'Project Duration', 'raizencore' ); ?></p>
            <input type="text" name="duration" class="regular-text" value="<?php echo esc_attr( $duration ); ?>">
        </div>
        <div class="metabox-column">
            <p class="field-title"><?php esc_html_e( 'Project URL', 'raizencore' ); ?></p>
            <input type="url" name="project_link" class="regular-text" value="<?php echo esc_attr( $project_link ); ?>">
        </div>
        <div class="metabox-column">
            <p class="field-title"><?php esc_html_e( 'Social Icons', 'raizencore' ); ?></p>
            <div id="social-icons-wrapper">
                <?php if ( !empty($social_icons) && is_array($social_icons) ) : ?>

                    <?php foreach ( $social_icons as $index => $icon ) : ?>

                        <div class="social-row">
                            <input type="text" name="social_icons[<?php echo $index; ?>][icon]"
                                placeholder="Icon class (e.g. fab fa-facebook)"
                                value="<?php echo esc_attr($icon['icon']); ?>">

                            <input type="url" name="social_icons[<?php echo $index; ?>][url]"
                                placeholder="URL"
                                value="<?php echo esc_attr($icon['url']); ?>">

                            <button class="remove-row button"><?php esc_html_e( 'Remove', 'raizencore' ); ?></button>
                        </div>

                    <?php endforeach; ?>

                <?php endif; ?>
            </div>
            <button type="button" id="add-social-row" class="button"><?php esc_html_e( '+ Add Social Icon', 'raizencore' ); ?></button>
        </div>
    </div>

    <?php
}

function raizen_save_portfolio_options( $post_id ) {
    // Verify nonce
    if ( ! isset( $_POST['raizen_portfolio_options_nonce'] ) || 
         ! wp_verify_nonce( $_POST['raizen_portfolio_options_nonce'], 'raizen_save_portfolio_options' ) ) {
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

    $fields = [
        'client_name'  => '_client_name',
        'duration'     => '_duration',
        'project_link' => '_project_link',
    ];

    foreach ( $fields as $form_field => $meta_key ) {
        if ( isset( $_POST[ $form_field ] ) ) {
            update_post_meta( $post_id, $meta_key, sanitize_text_field( $_POST[ $form_field ] ) );
        }
    }

    // Save repeater social icons
    if ( isset($_POST['social_icons']) && is_array($_POST['social_icons']) ) {

        $clean = [];

        foreach ( $_POST['social_icons'] as $row ) {
            if ( empty($row['icon']) && empty($row['url']) ) continue;

            $clean[] = [
                'icon' => sanitize_text_field($row['icon']),
                'url'  => esc_url_raw($row['url']),
            ];
        }

        update_post_meta( $post_id, '_social_icons', $clean );

    } else {
        // IMPORTANT: Remove meta if no fields left
        delete_post_meta( $post_id, '_social_icons' );
    }
}
add_action( 'save_post', 'raizen_save_portfolio_options' );

/**
 * Add secondary featured image meta box for Portfolio CPT
 */
function portfolio_second_featured_image_metabox() {
    add_meta_box(
        'portfolio_second_featured_image',
        __('Secondary Featured Image', 'raizencore'),
        'portfolio_second_featured_image_callback',
        'portfolio',
        'side',
        'low'
    );
}
add_action('add_meta_boxes', 'portfolio_second_featured_image_metabox');

function portfolio_second_featured_image_callback( $post ) {

    wp_nonce_field('save_portfolio_second_image', 'portfolio_second_image_nonce');

    $image_id = get_post_meta($post->ID, '_second_featured_image_id', true);
    $image_url = $image_id ? wp_get_attachment_image_url($image_id, 'medium') : '';

    ?>
    <div>
        <div class="second-image-preview" style="margin-bottom:10px;">
            <?php if ($image_url): ?>
                <img src="<?php echo esc_url($image_url); ?>" style="max-width:100%; height:auto;">
            <?php endif; ?>
        </div>

        <input type="hidden" name="second_featured_image_id" id="second_featured_image_id" 
               value="<?php echo esc_attr($image_id); ?>">

        <button type="button" class="button upload-second-image">
            <?php echo $image_id ? __('Change Image', 'raizencore') : __('Upload Image', 'raizencore'); ?>
        </button>

        <?php if ($image_id): ?>
            <button type="button" class="button remove-second-image">
                <?php _e('Remove Image', 'raizencore'); ?>
            </button>
        <?php endif; ?>
    </div>

    <?php
}

function save_portfolio_second_image( $post_id ) {

    if (!isset($_POST['portfolio_second_image_nonce']) ||
        !wp_verify_nonce($_POST['portfolio_second_image_nonce'], 'save_portfolio_second_image')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

    if (!current_user_can('edit_post', $post_id)) return;

    if (isset($_POST['second_featured_image_id'])) {
        update_post_meta(
            $post_id,
            '_second_featured_image_id',
            intval($_POST['second_featured_image_id'])
        );
    }
}
add_action('save_post_portfolio', 'save_portfolio_second_image');

/**
 * Post Format Meta Box
 */

function raizen_add_post_format_metabox() {
    add_meta_box(
        'raizen_post_format_fields',
        __( 'Post Format Options', 'raizencore' ),
        'raizen_post_format_metabox_callback',
        'post',
        'normal',
        'default'
    );
}
add_action( 'add_meta_boxes', 'raizen_add_post_format_metabox' );

function raizen_post_format_metabox_callback( $post ) {
    wp_nonce_field( 'raizen_save_post_format', 'raizen_post_format_nonce' );

    $gallery_images = get_post_meta( $post->ID, '_raizen_gallery_images', true );
    $video_url      = get_post_meta( $post->ID, '_raizen_video_url', true );
    $audio_url      = get_post_meta( $post->ID, '_raizen_audio_url', true );

    ?>
    <div id="raizen-format-fields-wrapper">

        <!-- Gallery -->
        <div class="raizen-field raizen-field-gallery">
            <p><strong><?php _e( 'Gallery Images', 'raizencore' ); ?></strong></p>
            <div id="raizen-gallery-container">
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
            <input type="hidden" id="raizen_gallery_images" name="raizen_gallery_images" value="<?php echo esc_attr( implode( ',', (array) $gallery_images ) ); ?>">
            <button type="button" class="button" id="raizen-add-gallery"><?php _e( 'Add / Edit Gallery', 'raizencore' ); ?></button>
        </div>

        <!-- Video -->
        <div class="raizen-field raizen-field-video">
            <p><strong><?php _e( 'Video URL', 'raizencore' ); ?></strong></p>
            <input type="url" class="widefat" name="raizen_video_url" value="<?php echo esc_url( $video_url ); ?>" placeholder="https://">
        </div>

        <!-- Audio -->
        <div class="raizen-field raizen-field-audio">
            <p><strong><?php _e( 'Audio URL', 'raizencore' ); ?></strong></p>
            <input type="url" class="widefat" name="raizen_audio_url" value="<?php echo esc_url( $audio_url ); ?>" placeholder="https://">
        </div>

    </div>
    <?php
}

function raizen_save_post_format_meta( $post_id ) {
    if ( ! isset( $_POST['raizen_post_format_nonce'] ) || ! wp_verify_nonce( $_POST['raizen_post_format_nonce'], 'raizen_save_post_format' ) ) {
        return;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;

    if ( isset( $_POST['raizen_gallery_images'] ) ) {
        $images = array_filter( array_map( 'intval', explode( ',', $_POST['raizen_gallery_images'] ) ) );
        update_post_meta( $post_id, '_raizen_gallery_images', $images );
    }
    if ( isset( $_POST['raizen_video_url'] ) ) {
        update_post_meta( $post_id, '_raizen_video_url', esc_url_raw( $_POST['raizen_video_url'] ) );
    }
    if ( isset( $_POST['raizen_audio_url'] ) ) {
        update_post_meta( $post_id, '_raizen_audio_url', esc_url_raw( $_POST['raizen_audio_url'] ) );
    }
}
add_action( 'save_post', 'raizen_save_post_format_meta' );

/*------------------
 Custom Image field
--------------------*/

function add_custom_product_image_metabox() {
    add_meta_box(
        'custom_product_image_box',
        esc_html__( 'Product Image for Home 2', 'raizencore' ),
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
                <?php esc_html_e( 'Set product image', 'raizencore' ); ?>
            </button>
            <button type="button" class="button remove_custom_image_button">
                <?php esc_html_e( 'Remove', 'raizencore' ); ?>
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
