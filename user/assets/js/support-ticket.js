jQuery(document).ready(function($) {

    $('#create-ticket-form').on('submit', function(e) {
        e.preventDefault();

        Notiflix.Loading.standard('Sending...');

        const form = $('#create-ticket-form')[0];
        const formData = new FormData(form);
        formData.append('action', 'create_ticket_submit');

        $.ajax({
            url: ndTicket.ajaxurl,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {

                Notiflix.Loading.remove();

                if (response.success) {
                    Notiflix.Notify.success(response.data.message || 'Ticket submitted successfully!');
                    $('#nd-ticket-response').html('<div class="alert alert-success">' + response.data.message + '</div>');
                } else {
                    Notiflix.Notify.failure(response.data.message || 'Failed to submit.');
                    $('#nd-ticket-response').html('<div class="alert alert-danger">' + response.data.message + '</div>');
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                Notiflix.Loading.remove();
                $('#nd-ticket-response').html('<div class="alert alert-danger">AJAX error. See console.</div>');
            }
        });
    });

    // Ticket reply form

    $('#user-ticket-reply-form').on('submit', function (e) {
        e.preventDefault();

        Notiflix.Loading.standard('Sending...');

        const form = this;
        const formData = new FormData(form);

        ndFiles.forEach(({ file }) => {
            formData.append('reply_attachments[]', file);
        });

        formData.append('action', 'nd_submit_ticket_reply');

        $.ajax({
            url: ndTicket.ajaxurl,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function (res) {

                Notiflix.Loading.remove();

                if (res.success) {
                    $('.file-preview-grid').empty();
                    ndFiles = [];
                    form.reset();
                    $('.chat-box-inner').append(res.data.html);
                    $('.chat-box-inner').animate({ scrollTop: $('.chat-box-inner')[0].scrollHeight }, 300);
                } else {
                    $('#nd-reply-response').html('<div class="error">' + res.data.message + '</div>');
                }
            },
            error: function () {

                Notiflix.Loading.remove();
                
                $('#nd-reply-response').html('<div class="error">Something went wrong.</div>');
            }
        });
    });

    // File Upload

    let ndFiles = [];

    $('.file-upload-input').on('change', function () {
        const previewGrid = $('.file-preview-grid');
        const files = Array.from(this.files);

        files.forEach(file => {
            if (!file.type.startsWith('image/')) return;

            const fileId = file.name + '-' + file.lastModified;
            if (ndFiles.some(f => f.id === fileId)) return;

            ndFiles.push({ id: fileId, file });

            const url = URL.createObjectURL(file);

            const thumb = $(`
                <div class="file-thumb" data-id="${fileId}">
                    <img src="${url}" />
                    <button type="button" class="file-remove-btn">&times;</button>
                </div>
            `);

            thumb.find('.file-remove-btn').on('click', function () {
                ndFiles = ndFiles.filter(f => f.id !== fileId);
                thumb.remove();
            });

            previewGrid.append(thumb);
        });

        $(this).val('');
    });

});
