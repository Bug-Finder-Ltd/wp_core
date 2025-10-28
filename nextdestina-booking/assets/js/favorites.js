jQuery(function($) {
    $('.favorite-toggle').on('click', function (e) {
        e.preventDefault();
        const $btn = $(this);
        const postId = $btn.data('post-id');

        $.post(TravelerFavoritesData.ajaxurl, {
            action: 'toggle_favorite',
            nonce: TravelerFavoritesData.nonce,
            post_id: postId
        }, function (response) {
            if (response.success) {
                const icon = $btn.find('i');
                icon.toggleClass('fa-light fa-solid');
            }
        });
    });
});
