jQuery(document).ready(function($) {
	
	$('.title-section').click(function() {
   		$(this).next().slideToggle('slow');
	});
	jQuery('.fw_upload input[type="button"]').click(function(){
    var upField = $(this).parent().find('input[type="text"]');
    tb_show('', 'media-upload.php?type=image&TB_iframe=true');
   
    window.send_to_editor = function(html) {
			imgurl = $('img', html).attr('src');
			upField.val(imgurl);
	 		tb_remove();
		}          	
		return false;
	});
});   

  