jQuery(document).ready(function() {

	/*
		Alobaidi Ajax Admin.
		By Alobaidi - www.wp-plugins.in
	*/

	jQuery('#alobaidi-ajax-admin-wrap').click(function() {
		jQuery("#alobaidi-ajax-admin-wrap").hide();
	});

	jQuery('div.wrap form #submit').click(function() {

		jQuery("div.wrap form").ajaxForm({
			target: false,
			success: function() 
			{
				jQuery("#alobaidi-ajax-admin-wrap").fadeIn(250).delay(2000).fadeOut(250);
			},
		});
		
	});
	
});