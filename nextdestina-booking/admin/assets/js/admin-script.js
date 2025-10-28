jQuery(document).ready(function($) {

    /**
     * Media uploader for logo/image
     */

    $('.upload-logo').on('click', function(e) {
        e.preventDefault();

        const button = $(this);
        const input = button.prev('input');

        const frame = wp.media({
            title: 'Select Logo',
            multiple: false
        });

        frame.on('select', function() {
            const attachment = frame.state().get('selection').first().toJSON();
            $('#payment_logo_preview').attr('src', attachment.url).show();
            input.val(attachment.url);
        });

        frame.open();
    });

    /**
     * Payment method OFF/ON switch
     */

    $('.toggle-payment-method').on('change', function () {
        var postId = $(this).data('id');
        var enabled = $(this).is(':checked') ? '1' : '0';

        $.ajax({
            url: admin_ajax.ajax_url,
            type: 'POST',
            data: {
                action: 'ndb_toggle_payment_method',
                post_id: postId,
                enabled: enabled,
                nonce: admin_ajax.nonce,
            },
        });
    });

    /**
     * Manual payment dynamic field
     */

    $('#add-field').on('click', function(){
        let rowCount = $('#payment-fields-table tbody tr').length;
        $('#payment-fields-table tbody').append(`
            <tr>
                <td><input type="text" name="payment_method_fields[${rowCount}][name]" /></td>
                <td>
                    <select name="payment_method_fields[${rowCount}][type]">
                        <option value="text">Text</option>
                        <option value="number">Number</option>
                        <option value="file">File Upload</option>
                        <option value="textarea">Textarea</option>
                        <option value="date">Date</option>
                    </select>
                </td>
                <td>
                    <select name="payment_method_fields[${rowCount}][validation]">
                        <option value="required">Required</option>
                        <option value="optional">Optional</option>
                    </select>
                </td>
                <td><button type="button" class="remove-field"><span class="dashicons dashicons-trash"></span></button></td>
            </tr>
        `);
    });

    $(document).on('click', '.remove-field', function(){
        $(this).closest('tr').remove();
    });

    /**
     * Secret key Show/Hide
     */

    $('.toggle-secret').on('click', function() {
        var $icon = $(this).find('i');
        var $input = $(this).siblings('input');

        if ($input.attr('type') === 'password') {
            $input.attr('type', 'text');
            $icon.removeClass('dashicons-visibility').addClass('dashicons-hidden');
        } else {
            $input.attr('type', 'password');
            $icon.removeClass('dashicons-hidden').addClass('dashicons-visibility');
        }
    });

    /**
     * Invoice Logo uploader
     */

    let mediaUploader;

    $('#upload_image_button').click(function(e) {
        e.preventDefault();

        if (mediaUploader) {
            mediaUploader.open();
            return;
        }

        mediaUploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: { text: 'Choose Image' },
            multiple: false
        });

        mediaUploader.on('select', function() {
            const attachment = mediaUploader.state().get('selection').first().toJSON();
            $('#invoice_logo').val(attachment.url);
            $('#invoice_logo_preview').attr('src', attachment.url).show();
        });

        mediaUploader.open();
    });

    $('#remove_image_button').click(function() {
        $('#invoice_logo').val('');
        $('#invoice_logo_preview').hide();
    });

});

