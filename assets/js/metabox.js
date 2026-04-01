jQuery(document).ready(function ($) {
	var mediaUploader;

	$("#custom-page-logo-upload").click(function (e) {
		e.preventDefault();
		if (mediaUploader) {
			mediaUploader.open();
			return;
		}

		mediaUploader = wp.media.frames.file_frame = wp.media({
			title: "Select Page Logo",
			button: { text: "Select Logo" },
			multiple: false,
		});

		mediaUploader.on("select", function () {
			var attachment = mediaUploader.state().get("selection").first().toJSON();
			$("#custom-page-logo-id").val(attachment.id);
			$("#custom-page-logo-preview").attr("src", attachment.url).show();
			$("#custom-page-logo-remove").show();
		});

		mediaUploader.open();
	});

	$("#custom-page-logo-remove").click(function (e) {
		e.preventDefault();
		$("#custom-page-logo-id").val("");
		$("#custom-page-logo-preview").hide();
		$(this).hide();
	});
});
