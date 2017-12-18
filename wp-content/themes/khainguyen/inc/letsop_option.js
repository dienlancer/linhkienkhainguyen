jQuery(document).ready(function() {
	// Logo
	jQuery('#upload_image_button_ad_1').click(function() {
		var custom_uploader;
		//If the uploader object has already been created, reopen the dialog
        if (custom_uploader) {
            custom_uploader.open();
            return;
        }
 
        //Extend the wp.media object
        custom_uploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: {
                text: 'Choose Image'
            },
            multiple: false
        });
 
        //When a file is selected, grab the URL and set it as the text field's value
        custom_uploader.on('select', function() {
            attachment = custom_uploader.state().get('selection').first().toJSON();
            //$('#upload_image').val(attachment.url);
            jQuery('#upload_image_ad_1').val(attachment.url);
			jQuery('#upload_review_ad_1').attr("src", attachment.url);
        });
 
        //Open the uploader dialog
        custom_uploader.open();
	});
	// Logo hotline
	jQuery('#upload_image_button_ad_2').click(function() {
		var custom_uploader;
		//If the uploader object has already been created, reopen the dialog
        if (custom_uploader) {
            custom_uploader.open();
            return;
        }
 
        //Extend the wp.media object
        custom_uploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: {
                text: 'Choose Image'
            },
            multiple: false
        });
 
        //When a file is selected, grab the URL and set it as the text field's value
        custom_uploader.on('select', function() {
            attachment = custom_uploader.state().get('selection').first().toJSON();
			jQuery('#upload_image_ad_2').val(attachment.url);
			jQuery('#upload_review_ad_2').attr("src", attachment.url);
        });
 
        //Open the uploader dialog
        custom_uploader.open();
	});
	 
});