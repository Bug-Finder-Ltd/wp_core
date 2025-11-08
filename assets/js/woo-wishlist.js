jQuery(document).on('click', '.wishlist-btn', function (e) {
    e.preventDefault();

    var $btn = jQuery(this);
    var product_id = $btn.data('product-id');

    jQuery.ajax({
        type: 'POST',
        url: wooWishlist.ajax_url,
        data: {
            action: 'woo_wishlist_action',
            product_id: product_id,
            nonce: wooWishlist.nonce
        },
        success: function (response) {
            if (response.success) {
                if (response.data.action === 'added') {
                    $btn.addClass('added').find('i').removeClass('fa-regular').addClass('fa-solid');
                } else {
                    $btn.removeClass('added').find('i').removeClass('fa-solid').addClass('fa-regular');
                }
            }
        }
    });
});