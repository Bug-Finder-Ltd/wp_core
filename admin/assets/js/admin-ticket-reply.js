jQuery(document).ready(function($) {

	$('#admin-reply-btn').on('click', function(e){
		e.preventDefault();

		var message = $('textarea[name="nd_ticket_reply_message"]').val();
		if (!message.trim()) {
			alert('Please enter a reply message.');
			return;
		}

		var formData = new FormData();
		formData.append('action', 'nd_send_ticket_reply');
		formData.append('ticket_id', nd_ticket_vars.ticket_id);
		formData.append('message', message);

		var files = $('#nd_ticket_reply_attachments')[0].files;
		for(var i=0; i < files.length; i++){
			formData.append('attachments[]', files[i]);
		}

		formData.append('nd_ticket_nonce', nd_ticket_vars.nonce);

		$.ajax({
			url: nd_ticket_vars.ajax_url,
			type: 'POST',
			data: formData,
			processData: false,
			contentType: false,
			success: function(response){
				if(response.success){
					//location.reload();

					var reply = response.data;

					// Clear inputs
					$('textarea[name="nd_ticket_reply_message"]').val('');
					$('#nd_ticket_reply_attachments').val('');

					// Build attachments HTML
					var attachmentsHtml = '';
					if(reply.attachments && reply.attachments.length > 0){
						attachmentsHtml = '<div class="attachments"><ul>';
						reply.attachments.forEach(function(file){
							attachmentsHtml += '<li><a href="' + file + '" target="_blank" download>' + file.split('/').pop() + '</a></li>';
						});
						attachmentsHtml += '</ul></div>';
					}

					// Build new reply HTML
					var newReplyHtml = '<div class="reply admin-reply">' +
					'<div class="author"><div class="image"><img src="'+nd_ticket_vars.current_user_avatar+'" alt="Avatar" /></div></div>' +
					'<div class="content"><p>' + reply.message.replace(/\n/g, "<br>") + '</p>' +
					attachmentsHtml +
					'</div></div>';

					$('.chat-list .ticket-replies').append(newReplyHtml);
					$('.chat-list').scrollTop($('.chat-list')[0].scrollHeight);

				} else {
					alert('Error: ' + response.data);
				}
			},
			error: function(){
				alert('Unexpected error occurred.');
			}
		});
	});

});