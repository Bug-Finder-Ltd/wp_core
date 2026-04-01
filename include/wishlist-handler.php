<?php

function handle_wishlist_action() {
    check_ajax_referer('woo_wishlist_nonce', 'nonce');

    $product_id = absint($_POST['product_id']);
    $user_id    = get_current_user_id();

    if ( $user_id ) {
        $wishlist = get_user_meta( $user_id, '_wishlist_products', true );
        $wishlist = is_array($wishlist) ? $wishlist : array();

        if ( in_array( $product_id, $wishlist ) ) {
            $wishlist = array_diff( $wishlist, array( $product_id ) );
            $action = 'removed';
        } else {
            $wishlist[] = $product_id;
            $action = 'added';
        }

        update_user_meta( $user_id, '_wishlist_products', $wishlist );
    } else {
        // Guest users → use cookie
        $wishlist = isset($_COOKIE['nd_wishlist']) ? json_decode(stripslashes($_COOKIE['nd_wishlist']), true) : array();

        if ( in_array( $product_id, $wishlist ) ) {
            $wishlist = array_diff( $wishlist, array( $product_id ) );
            $action = 'removed';
        } else {
            $wishlist[] = $product_id;
            $action = 'added';
        }

        setcookie('nd_wishlist', wp_json_encode(array_values($wishlist)), time() + 3600 * 24 * 30, '/');
    }

    wp_send_json_success(array('action' => $action));
}
add_action('wp_ajax_woo_wishlist_action', 'handle_wishlist_action');
add_action('wp_ajax_nopriv_woo_wishlist_action', 'handle_wishlist_action');

/*
 * Wishlist Shortcode
*/

function render_wishlist() {
    $user_id = get_current_user_id();

    // Logged-in users → user meta; guests → cookie
    if ( $user_id ) {
        $wishlist = get_user_meta( $user_id, '_wishlist_products', true );
    } else {
        $wishlist = isset( $_COOKIE['nd_wishlist'] )
            ? json_decode( stripslashes( $_COOKIE['nd_wishlist'] ), true )
            : [];
    }

    $wishlist = is_array( $wishlist ) ? $wishlist : [];

    ob_start();
    ?>
        <div class="provix-wishlist-page">
            <h3 class="wishlist-title"><?php esc_html_e( 'My Wishlist', 'agenvix-core' ); ?></h3>

            <?php if ( $wishlist ) : ?>
                <div class="products-grid">
                    <?php foreach ( $wishlist as $product_id ) :
                        $product = wc_get_product( $product_id );
                        if ( ! $product ) continue;

                        $is_in_wishlist = in_array( $product_id, $wishlist, true );
                        ?>
                        <div class="product-item">
                            <div class="top">
                                <h3 class="product-title">
                                    <a href="<?php echo esc_url( get_permalink( $product_id ) ); ?>">
                                        <?php echo esc_html( $product->get_name() ); ?>
                                    </a>
                                </h3>
                                <div class="details-btn">
                                    <a href="#" class="wishlist-btn <?php echo $is_in_wishlist ? 'added' : ''; ?>" data-product-id="<?php echo esc_attr( $product_id ); ?>">
                                        <i class="<?php echo $is_in_wishlist ? 'fa-solid' : 'fa-regular'; ?> fa-heart"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="product-image">
                                <?php echo $product->get_image('shop-product-thumb'); ?>
                            </div>
                            <div class="bottom">
                                <div class="product-price">
                                    <?php echo wp_kses_post( $product->get_price_html() ); ?>
                                </div>
                                <div class="buy-btn">
                                    <a href="<?php echo esc_url( get_permalink( $product_id ) ); ?>">
                                        <?php esc_html_e('Buy Now', 'agenvix-core'); ?>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else : ?>
                <p><?php esc_html_e( 'Your wishlist is empty.', 'agenvix-core' ); ?></p>
            <?php endif; ?>
        </div>
    <?php
    return ob_get_clean();
}

add_shortcode( 'provix_wishlist', 'render_wishlist');


/**
 * Add "Wishlist" tab in WooCommerce My Account page
 */
function provix_add_wishlist_tab( $items ) {
    // Add new tab after "Dashboard"
    $new_items = [];
    foreach ( $items as $key => $label ) {
        $new_items[ $key ] = $label;
        if ( 'dashboard' === $key ) {
            $new_items['wishlist'] = __( 'Wishlist', 'agenvix-core' );
        }
    }
    return $new_items;
}
add_filter( 'woocommerce_account_menu_items', 'provix_add_wishlist_tab' );

function provix_add_wishlist_endpoint() {
    add_rewrite_endpoint( 'wishlist', EP_ROOT | EP_PAGES );
}
add_action( 'init', 'provix_add_wishlist_endpoint' );

function provix_wishlist_content() {
    echo do_shortcode( '[provix_wishlist]' );
}
add_action( 'woocommerce_account_wishlist_endpoint', 'provix_wishlist_content' );


