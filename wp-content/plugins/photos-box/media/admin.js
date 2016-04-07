/*
 * Photo Box
 * Author: http://photoboxone.com/
 */
 
jQuery(document).ready(function($){
	var tgm_media_frame_img,
		clicked_on_imgbtn = false;
	
    $(document.body).on('click.tgmOpenMediaManager', '#upload_image_button', function(e){
        e.preventDefault();
		
        if ( tgm_media_frame_img ) {
            tgm_media_frame_img.open();
            return;
        }

        tgm_media_frame_img = wp.media.frames.tgm_media_frame = wp.media({
            className: 'media-frame tgm-media-frame',
            frame: 'select',
            multiple: false,
            title: 'Upload Image',
            library: {
                type: 'image'
            },
            button: {
                text: 'Use this image'
            }
        });

        tgm_media_frame_img.on('select', function(){
            var media_attachment = tgm_media_frame_img.state().get('selection').first().toJSON();
            jQuery('#photo_box_display_image_id').val(media_attachment.id);
			jQuery('#photo_box_display_image_thumb').html('<img src="'+media_attachment.url+'" height=100 alt=""/>');
        });
		
        tgm_media_frame_img.open();
		
    });
	/* set click for remove_image_button */
	$('#remove_image_button').click(function(e) {
		e.preventDefault();
		$('#photo_box_display_image_id').attr('value','');
		$('#photo_box_display_image_thumb').html('');
	});
	
	$('#upload_image_button').click(function() {
		formfield = jQuery('#photo_box_display_image_id').attr('name');
		clicked_on_imgbtn = true;
		// if tb_show is function
		tb_show('Add Image', 'media-upload.php?type=image&amp;TB_iframe=true');
		return false;
	});
	
	$('.button').click(function() {
		console.log(this,'click');
		
	});
	
});