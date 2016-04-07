jQuery(document).ready(function(){
	var divs = 1;
	
	jQuery('.get-datepicker').datepicker();
	
	jQuery('#md-sortable-media').sortable();
		
				
					
	/*
	 *
	 * UPLOAD VIDEOS
	 *
	 */
	jQuery('a.add-more-videos').live('click',function() { 
		divs++;
		var ids = 'new-md-field-'+divs;
		var cont = '<div id="vdiv'+ids+'" class="imgarr"><span class="imgside"> \
					<input type="hidden" id="'+ids+'" name="work-media[]" value="videoembed" /> \
					<img width="120" class="screenshot" src="'+wpurl.siteurl+'youtube.png" /></span><span> \
					<strong>Video Embed</strong><br class="clear" ><textarea id="v'+ids+'" cols="60" rows="3" class="work-caption" name="work-media-video[]"></textarea> \
					<a href="javascript:void(0);" class="admin-upload-remove button-secondary" rel-id="vdiv'+ids+'">Remove</a> \
					</span><br class="clear"></div>';
		jQuery('#md-sortable-media').prepend(cont);
	});
	
	
		
					
	/*
	 *
	 * UPLOAD IMAGES
	 *
	 */

	jQuery('.nhp-opts-upload').click(function() {
	 post_id = jQuery('#post_ID').val();
	 tb_show('', 'media-upload.php?post_id='+post_id+'&amp;type=image&amp;TB_iframe=true');
	 return false;
	});
	
	window.send_to_editor = function(html) {
		imgurl = jQuery('img',html).attr('src');
		divs++;
		var ids = 'new-md-field-'+divs;
		var cont = '<div id="d'+ids+'" class="imgarr" style="display:none">\
					<span class="imgside"><input type="hidden" id="'+ids+'" name="work-media[]" value="'+imgurl+'" /> \
					<div class="imgwindow"><img width="120" class="screenshot" id="sc-'+ids+'" src="'+imgurl+'" /></div></span><span> \
					<strong>Caption</strong><br class="clear" ><textarea id="v'+ids+'" cols="60" rows="3" class="work-caption" name="work-media-caption[]"></textarea> \
					<a href="javascript:void(0);" class="admin-upload-remove button-secondary" rel-id="d'+ids+'">Remove</a><br class="clear">\
					</span><br class="clear"></div>';
		jQuery('#md-sortable-media').append(cont);
		jQuery('#d'+ids).fadeIn('slow');
		
		tb_remove();
	}

	jQuery('.admin-upload-remove').live('click',function(){
		jQuery(this).parent().parent().fadeOut('slow',function() {
		jQuery(this).remove();
		});
	});



	
					
	/*
	 *
	 * COLOR PICKER
	 *
	 */
	 
		
	jQuery('.colorSelector').each(function(){
			var Othis = this; //cache a copy of the this variable for use inside nested function
				
			jQuery(this).ColorPicker({
					color: '#ff0000',
					onShow: function (colpkr) {
						jQuery(colpkr).fadeIn(500);
						return false;
					},
					onHide: function (colpkr) {
						jQuery(colpkr).fadeOut(500);
						return false;
					},
					onChange: function (hsb, hex, rgb) {
						jQuery(Othis).children('div').css('backgroundColor', '#' + hex);
						jQuery(Othis).next('input').attr('value','#' + hex);
						
					}
			});
				  
	}); //end color picker
	
	
});