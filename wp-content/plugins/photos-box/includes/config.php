<?php
defined('ABSPATH') or die();

/* ADD SETTINGS PAGE
------------------------------------------------------*/
if( !function_exists('photo_box_add_options_page') ){
	function photo_box_add_options_page() {
		add_options_page(
			'Photo Box Settings',
			'Photo Box',
			'manage_options',
			'photo-box-setting',
			'photo_box_setting_display'
		);
		
	}
}
add_action('admin_menu','photo_box_add_options_page');

function photo_box_add_test_again() {
	echo '<b>Error</b>';
	echo '<b>C</b>';
}