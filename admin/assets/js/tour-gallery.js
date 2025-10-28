jQuery(document).ready(function($) {
    var frame;

    $('#nextdestina-tour-add-gallery').on('click', function(e) {
        e.preventDefault();

        if (frame) {
            frame.open();
            return;
        }

        frame = wp.media({
            title: 'Select Gallery Images',
            button: { text: 'Use These Images' },
            multiple: true
        });

        frame.on('select', function() {
            var selection = frame.state().get('selection');
            var ids = [];
            var container = $('#nextdestina-tour-gallery-container');
            container.empty();

            selection.each(function(attachment) {
                attachment = attachment.toJSON();
                ids.push(attachment.id);

                container.append(
                    '<div class="gallery-thumb" data-id="' + attachment.id + '">' +
                        '<img src="' + attachment.sizes.thumbnail.url + '" />' +
                        '<span class="remove-image">&times;</span>' +
                    '</div>'
                );
            });

            $('#nextdestina_tour_gallery_images').val(ids.join(','));
        });

        frame.open();
    });

    $(document).on('click', '.gallery-thumb .remove-image', function(e) {
        e.preventDefault();

        var thumb = $(this).closest('.gallery-thumb');
        thumb.remove();

        var ids = [];
        $('#nextdestina-tour-gallery-container .gallery-thumb').each(function() {
            ids.push($(this).data('id'));
        });
        $('#nextdestina_tour_gallery_images').val(ids.join(','));
    });
});
