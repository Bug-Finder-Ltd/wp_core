<?php

/**
 * Add Page Settings Meta Box
 */
function provix_add_page_settings_metabox() {
	add_meta_box(
		'provix_page_settings',
		__( 'Page Settings', 'agenvix-core' ),
		'provix_page_settings_metabox',
		'page',
		'normal',
		'default'
	);
}
add_action( 'add_meta_boxes', 'provix_add_page_settings_metabox' );

function provix_page_settings_metabox( $post ) {
	// Security nonce.
	wp_nonce_field( 'provix_save_page_settings', 'provix_page_settings_nonce' );

	// Get saved values.
	$transparent_menu  = get_post_meta( $post->ID, '_provix_transparent_menu', true );
	$header_layout     = get_post_meta( $post->ID, '_header_layout', true );
	$breadcrumb        = get_post_meta( $post->ID, '_page_breadcrumb_toggle', true );
	$breadcrumb_layout = get_post_meta( $post->ID, '_breadcrumb_layout', true );
	$logo_id           = get_post_meta( $post->ID, '_custom_page_logo_id', true );
	$logo_url          = $logo_id ? wp_get_attachment_url( $logo_id ) : '';

	$saved_header = get_post_meta( $post->ID, '_page_header_id', true );
	$header_posts = get_posts(
		array(
			'post_type'      => 'site_header',
			'posts_per_page' => -1,
			'orderby'        => 'title',
			'order'          => 'ASC',
		)
	);

	$saved_footer = get_post_meta( $post->ID, '_page_footer_id', true );
	$footer_posts = get_posts(
		array(
			'post_type'      => 'site_footer',
			'posts_per_page' => -1,
			'orderby'        => 'title',
			'order'          => 'ASC',
		)
	);

	?>

	<div class="metabox-grid column-4">
		<div class="metabox-column">
			<p class="field-title"><?php esc_html_e( 'Transparent Header', 'agenvix-core' ); ?></p>
			<div class="toggle-switch">
				<label class="provix-switch">
					<input type="checkbox" name="provix_transparent_menu" value="1" <?php checked( $transparent_menu, '1' ); ?>>
					<span class="provix-slider round"></span>
				</label>
				<span class="switch-label"><?php esc_html_e( 'Enable transparent menu for this page', 'agenvix-core' ); ?></span>
			</div>
		</div>
		<div class="metabox-column">
			<p class="field-title"><?php esc_html_e( 'Disable Breadcrumb ', 'agenvix-core' ); ?></p>
			<div class="toggle-switch">
				<label class="provix-switch">
					<input type="checkbox" name="provix_breadcrumb" value="1" <?php checked( $breadcrumb, '1' ); ?>>
					<span class="provix-slider round"></span>
				</label>
				<span class="switch-label"><?php esc_html_e( 'Disable Breadcrumb for this page', 'agenvix-core' ); ?></span>
			</div>
		</div>
		<div class="metabox-column">
			<label class="field-title"><?php esc_html_e( 'Header Logo', 'agenvix-core' ); ?></label>
			<div class="custom-page-logo-wrapper">
				<img id="custom-page-logo-preview" src="<?php echo esc_url( $logo_url ); ?>" style="<?php echo $logo_url ? '' : 'display:none;'; ?>" />
				<input type="hidden" id="custom-page-logo-id" name="custom_page_logo_id" value="<?php echo esc_attr( $logo_id ); ?>" />
				<button type="button" class="button" id="custom-page-logo-upload"><?php echo $logo_url ? 'Change Logo' : 'Upload Logo'; ?></button>
				<button type="button" class="button" id="custom-page-logo-remove" <?php echo $logo_url ? '' : 'style="display:none;"'; ?>>
					<?php esc_html_e( 'Remove Logo', 'agenvix-core' ); ?>
				</button>
			</div>
		</div>
		<div class="metabox-column">
			<label class="field-title"><?php esc_html_e( 'Header Layout', 'agenvix-core' ); ?></label>
			<select name="header_layout">
				<option value=""><?php esc_html_e( 'Default (Customizer)', 'agenvix-core' ); ?></option>
				<option value="header-style-1" <?php selected( $header_layout, 'header-style-1' ); ?>><?php esc_html_e( 'Layout One', 'agenvix-core' ); ?></option>
				<option value="header-style-2" <?php selected( $header_layout, 'header-style-2' ); ?>><?php esc_html_e( 'Layout Two', 'agenvix-core' ); ?></option>
				<option value="header-style-3" <?php selected( $header_layout, 'header-style-3' ); ?>><?php esc_html_e( 'Layout Three', 'agenvix-core' ); ?></option>
				<option value="header-style-4" <?php selected( $header_layout, 'header-style-4' ); ?>><?php esc_html_e( 'Landing One', 'agenvix-core' ); ?></option>
				<option value="header-style-5" <?php selected( $header_layout, 'header-style-5' ); ?>><?php esc_html_e( 'Landing Two', 'agenvix-core' ); ?></option>
				<option value="header-style-6" <?php selected( $header_layout, 'header-style-6' ); ?>><?php esc_html_e( 'Landing Three', 'agenvix-core' ); ?></option>
			</select>
		</div>
		<div class="metabox-column">
			<label class="field-title"><?php esc_html_e( 'Header Layout', 'agenvix-core' ); ?></label>
			<select name="site_header_select">
				<option value=""><?php esc_html_e( 'Default Theme Header', 'agenvix-core' ); ?></option>
				<?php
				if ( ! empty( $header_posts ) ) {
					foreach ( $header_posts as $header ) {
						echo '<option value="' . esc_attr( $header->ID ) . '" ' . selected( $saved_header, $header->ID, false ) . '>';
						echo esc_html( $header->post_title );
						echo '</option>';
					}
				}
				?>
			</select>
		</div>
		<div class="metabox-column">
			<label class="field-title"><?php esc_html_e( 'Breadcrumb Layout', 'agenvix-core' ); ?></label>
			<select name="breadcrumb_layout">
				<option value=""><?php esc_html_e( 'Default (Customizer)', 'agenvix-core' ); ?></option>
				<option value="one" <?php selected( $breadcrumb_layout, 'one' ); ?>><?php esc_html_e( 'Layout One', 'agenvix-core' ); ?></option>
				<option value="two" <?php selected( $breadcrumb_layout, 'two' ); ?>><?php esc_html_e( 'Layout Two', 'agenvix-core' ); ?></option>
				<option value="three" <?php selected( $breadcrumb_layout, 'three' ); ?>><?php esc_html_e( 'Layout Three', 'agenvix-core' ); ?></option>
			</select>
		</div>
		<div class="metabox-column">
			<label class="field-title"><?php esc_html_e( 'Footer Layout', 'agenvix-core' ); ?></label>
			<select name="site_footer_select">
				<option value=""><?php esc_html_e( 'Default Theme Footer', 'agenvix-core' ); ?></option>
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

function provix_save_page_settings( $post_id ) {
	// Verify nonce.
	if (
		! isset( $_POST['provix_page_settings_nonce'] ) ||
		! wp_verify_nonce( $_POST['provix_page_settings_nonce'], 'provix_save_page_settings' )
	) {
		return;
	}

	// Prevent autosave / quick edit overwriting.
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// Check user capability.
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	// Transparent header toggle.
	$transparent_menu = isset( $_POST['provix_transparent_menu'] ) ? '1' : '';
	update_post_meta( $post_id, '_provix_transparent_menu', $transparent_menu );

	if ( isset( $_POST['header_layout'] ) ) {
		update_post_meta( $post_id, '_header_layout', sanitize_text_field( $_POST['header_layout'] ) );
	}

	// Save or delete logo.
	if ( isset( $_POST['custom_page_logo_id'] ) && ! empty( $_POST['custom_page_logo_id'] ) ) {
		update_post_meta( $post_id, '_custom_page_logo_id', intval( $_POST['custom_page_logo_id'] ) );
	} else {
		delete_post_meta( $post_id, '_custom_page_logo_id' );
	}

	// Header.
	if ( isset( $_POST['site_header_select'] ) ) {
		update_post_meta( $post_id, '_page_header_id', sanitize_text_field( $_POST['site_header_select'] ) );
	}

	// Breadcrumb.
	$breadcrumb = isset( $_POST['provix_breadcrumb'] ) ? '1' : '';
	update_post_meta( $post_id, '_page_breadcrumb_toggle', $breadcrumb );

	if ( isset( $_POST['breadcrumb_layout'] ) ) {
		update_post_meta( $post_id, '_breadcrumb_layout', sanitize_text_field( $_POST['breadcrumb_layout'] ) );
	}

	// Footer.
	if ( isset( $_POST['site_footer_select'] ) ) {
		update_post_meta( $post_id, '_page_footer_id', sanitize_text_field( $_POST['site_footer_select'] ) );
	}
}
add_action( 'save_post', 'provix_save_page_settings' );

/**
 * Portfolio Meta Box
 */
function provix_portfolio_options_metabox() {
	add_meta_box(
		'provix_portfolio_options',
		__( 'Portfolio Options', 'agenvix-core' ),
		'portfolio_options_callback',
		'portfolio',
		'normal',
		'default'
	);
}
add_action( 'add_meta_boxes', 'provix_portfolio_options_metabox' );

function portfolio_options_callback( $post ) {

	wp_nonce_field( 'provix_save_portfolio_options', 'provix_portfolio_options_nonce' );

	$client_name  = get_post_meta( $post->ID, '_client_name', true );
	$duration     = get_post_meta( $post->ID, '_duration', true );
	$project_link = get_post_meta( $post->ID, '_project_link', true );
	$project_cost = get_post_meta( $post->ID, '_project_cost', true );
	$social_icons = get_post_meta( $post->ID, '_social_icons', true ); // array
	?>

	<div class="metabox-grid column-4">
		<div class="metabox-column">
			<p class="field-title"><?php esc_html_e( 'Client Name', 'agenvix-core' ); ?></p>
			<input type="text" name="client_name" class="regular-text" value="<?php echo esc_attr( $client_name ); ?>">
		</div>
		<div class="metabox-column">
			<p class="field-title"><?php esc_html_e( 'Project Duration', 'agenvix-core' ); ?></p>
			<input type="text" name="duration" class="regular-text" value="<?php echo esc_attr( $duration ); ?>">
		</div>
		<div class="metabox-column">
			<p class="field-title"><?php esc_html_e( 'Project URL', 'agenvix-core' ); ?></p>
			<input type="url" name="project_link" class="regular-text" value="<?php echo esc_attr( $project_link ); ?>">
		</div>
		<div class="metabox-column">
			<p class="field-title"><?php esc_html_e( 'Project Cost', 'agenvix-core' ); ?></p>
			<input type="text" name="project_cost" class="regular-text" value="<?php echo esc_attr( $project_cost ); ?>">
		</div>
		<div class="metabox-column">
			<p class="field-title"><?php esc_html_e( 'Social Icons', 'agenvix-core' ); ?></p>
			<div id="social-icons-wrapper">
				<?php if ( ! empty( $social_icons ) && is_array( $social_icons ) ) : ?>

					<?php foreach ( $social_icons as $index => $icon ) : ?>

						<div class="social-row">
							<input type="text" name="social_icons[<?php echo $index; ?>][icon]"
								placeholder="Icon class (e.g. fab fa-facebook)"
								value="<?php echo esc_attr( $icon['icon'] ); ?>">

							<input type="url" name="social_icons[<?php echo $index; ?>][url]"
								placeholder="URL"
								value="<?php echo esc_attr( $icon['url'] ); ?>">

							<button class="remove-row button"><?php esc_html_e( 'Remove', 'agenvix-core' ); ?></button>
						</div>

					<?php endforeach; ?>

				<?php endif; ?>
			</div>
			<button type="button" id="add-social-row" class="button"><?php esc_html_e( '+ Add Social Icon', 'agenvix-core' ); ?></button>
		</div>
	</div>

	<?php
}

function provix_save_portfolio_options( $post_id ) {
	// Verify nonce
	if (
		! isset( $_POST['provix_portfolio_options_nonce'] ) ||
		! wp_verify_nonce( $_POST['provix_portfolio_options_nonce'], 'provix_save_portfolio_options' )
	) {
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

	$fields = array(
		'client_name'  => '_client_name',
		'duration'     => '_duration',
		'project_link' => '_project_link',
		'project_cost' => '_project_cost',
	);

	foreach ( $fields as $form_field => $meta_key ) {
		if ( isset( $_POST[ $form_field ] ) ) {
			update_post_meta( $post_id, $meta_key, sanitize_text_field( $_POST[ $form_field ] ) );
		}
	}

	// Save repeater social icons
	if ( isset( $_POST['social_icons'] ) && is_array( $_POST['social_icons'] ) ) {

		$clean = array();

		foreach ( $_POST['social_icons'] as $row ) {
			if ( empty( $row['icon'] ) && empty( $row['url'] ) ) {
				continue;
			}

			$clean[] = array(
				'icon' => sanitize_text_field( $row['icon'] ),
				'url'  => esc_url_raw( $row['url'] ),
			);
		}

		update_post_meta( $post_id, '_social_icons', $clean );
	} else {
		// IMPORTANT: Remove meta if no fields left
		delete_post_meta( $post_id, '_social_icons' );
	}
}
add_action( 'save_post', 'provix_save_portfolio_options' );

/**
 * Post Format
 */
function provix_add_post_format_metabox() {
	add_meta_box(
		'provix_post_format_fields',
		__( 'Post Format Options', 'agenvix-core' ),
		'provix_post_format_metabox_callback',
		'post',
		'normal',
		'default'
	);
}
add_action( 'add_meta_boxes', 'provix_add_post_format_metabox' );

function provix_post_format_metabox_callback( $post ) {
	wp_nonce_field( 'provix_save_post_format', 'provix_post_format_nonce' );

	$gallery_images = get_post_meta( $post->ID, '_provix_gallery_images', true );
	$video_url      = get_post_meta( $post->ID, '_provix_video_url', true );
	$audio_url      = get_post_meta( $post->ID, '_provix_audio_url', true );

	?>
	<div id="provix-format-fields-wrapper">

		<!-- Gallery -->
		<div class="provix-field provix-field-gallery">
			<p><strong><?php _e( 'Gallery Images', 'agenvix-core' ); ?></strong></p>
			<div id="provix-gallery-container">
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
			<input type="hidden" id="provix_gallery_images" name="provix_gallery_images" value="<?php echo esc_attr( implode( ',', (array) $gallery_images ) ); ?>">
			<button type="button" class="button" id="provix-add-gallery"><?php _e( 'Add / Edit Gallery', 'agenvix-core' ); ?></button>
		</div>

		<!-- Video -->
		<div class="provix-field provix-field-video">
			<p><strong><?php _e( 'Video URL', 'agenvix-core' ); ?></strong></p>
			<input type="url" class="widefat" name="provix_video_url" value="<?php echo esc_url( $video_url ); ?>" placeholder="https://">
		</div>

		<!-- Audio -->
		<div class="provix-field provix-field-audio">
			<p><strong><?php _e( 'Audio URL', 'agenvix-core' ); ?></strong></p>
			<input type="url" class="widefat" name="provix_audio_url" value="<?php echo esc_url( $audio_url ); ?>" placeholder="https://">
		</div>

	</div>
	<?php
}

function provix_save_post_format_meta( $post_id ) {
	if ( ! isset( $_POST['provix_post_format_nonce'] ) || ! wp_verify_nonce( $_POST['provix_post_format_nonce'], 'provix_save_post_format' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	if ( isset( $_POST['provix_gallery_images'] ) ) {
		$images = array_filter( array_map( 'intval', explode( ',', $_POST['provix_gallery_images'] ) ) );
		update_post_meta( $post_id, '_provix_gallery_images', $images );
	}
	if ( isset( $_POST['provix_video_url'] ) ) {
		update_post_meta( $post_id, '_provix_video_url', esc_url_raw( $_POST['provix_video_url'] ) );
	}
	if ( isset( $_POST['provix_audio_url'] ) ) {
		update_post_meta( $post_id, '_provix_audio_url', esc_url_raw( $_POST['provix_audio_url'] ) );
	}
}
add_action( 'save_post', 'provix_save_post_format_meta' );

/*
------------------
Custom Image field
--------------------*/

function add_custom_product_image_metabox() {
	add_meta_box(
		'custom_product_image_box',
		esc_html__( 'Product Image for Home 2', 'agenvix-core' ),
		'render_custom_product_image_metabox',
		'product',
		'side',
		'low'
	);
}
add_action( 'add_meta_boxes', 'add_custom_product_image_metabox' );

function render_custom_product_image_metabox( $post ) {
	$image_id        = get_post_meta( $post->ID, '_custom_product_image_id', true );
	$image_url       = $image_id ? wp_get_attachment_image_url( $image_id, 'thumbnail' ) : '';
	$has_image_class = $image_url ? 'has-image' : '';

	wp_nonce_field( 'save_custom_product_image', 'custom_product_image_nonce' );
	?>
	<div class="custom-product-image-field">
		<img id="custom_product_image_preview" class="custom-image-preview <?php echo esc_attr( $has_image_class ); ?>" src="<?php echo esc_url( $image_url ); ?>" />
		<input type="hidden" id="custom_product_image_id" name="custom_product_image_id" value="<?php echo esc_attr( $image_id ); ?>">
		<p>
			<button type="button" class="button upload_custom_image_button">
				<?php esc_html_e( 'Set product image', 'agenvix-core' ); ?>
			</button>
			<button type="button" class="button remove_custom_image_button">
				<?php esc_html_e( 'Remove', 'agenvix-core' ); ?>
			</button>
		</p>
	</div>
	<?php
}

function save_custom_product_image_metabox( $post_id ) {
	// Verify nonce
	if ( ! isset( $_POST['custom_product_image_nonce'] ) || ! wp_verify_nonce( $_POST['custom_product_image_nonce'], 'save_custom_product_image' ) ) {
		return;
	}

	// Check autosave
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// Check user permissions
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	// Save field
	if ( isset( $_POST['custom_product_image_id'] ) ) {
		update_post_meta( $post_id, '_custom_product_image_id', sanitize_text_field( $_POST['custom_product_image_id'] ) );
	}
}
add_action( 'save_post_product', 'save_custom_product_image_metabox' );
