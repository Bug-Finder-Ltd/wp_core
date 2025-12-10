(function($) {

	let wrapper = $('#social-icons-wrapper');

	$('#add-social-row').on('click', function(){
		let index = $('.social-row').length;

		let html = `
					<div class="social-row">
						<input type="text" name="social_icons[${index}][icon]" placeholder="Icon class (e.g. fab fa-facebook)">
						<input type="url" name="social_icons[${index}][url]" placeholder="URL">
						<button class="remove-row button">Remove</button>
					</div>
		`;

		wrapper.append(html);
	});

	wrapper.on('click', '.remove-row', function(e){
		e.preventDefault();
		$(this).closest('.social-row').remove();
	});

	// Portfolio Featured Image

	var frame;

	$('.upload-second-image').on('click', function(e) {
		e.preventDefault();

		if (frame) {
			frame.open();
			return;
		}

		frame = wp.media({
			title: 'Select Secondary Featured Image',
			button: { text: 'Use This Image' },
			multiple: false
		});

		frame.on('select', function(){
			var attachment = frame.state().get('selection').first().toJSON();
			$('#second_featured_image_id').val(attachment.id);
			$('.second-image-preview').html('<img src="'+attachment.url+'" style="max-width:100%;">');
		});

		frame.open();
	});

	$('.remove-second-image').on('click', function(e) {
		e.preventDefault();
		$('#second_featured_image_id').val('');
		$('.second-image-preview').html('');
	});

})(jQuery);