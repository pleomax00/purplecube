<?php

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );


function alobaidi_ajax_admin_settings(){
	add_settings_section('oba_ajax_admin_section', __('Ajax Admin', 'oba-ajax-admin'), false, 'general');
	
	add_settings_field( "oba_ajax_admin_settings", __('Settings Save', 'oba-ajax-admin'), "oba_ajax_admin_settings_callback", "general", "oba_ajax_admin_section" );
	register_setting( 'general', 'oba_ajax_admin_settings' );

	add_settings_field( "oba_ajax_admin_posts", __('Posts Save', 'oba-ajax-admin'), "oba_ajax_admin_posts_callback", "general", "oba_ajax_admin_section" );
	register_setting( 'general', 'oba_ajax_admin_posts' );
}
add_action( 'admin_init', 'alobaidi_ajax_admin_settings' );


function oba_ajax_admin_settings_callback(){
    ?>
        <label for="oba_ajax_admin_settings"><input id="oba_ajax_admin_settings" name="oba_ajax_admin_settings" type="checkbox" value="1" <?php checked( get_option('oba_ajax_admin_settings'), 1, true ); ?>><?php _e('Disable ajax save for settings.', 'oba-ajax-admin'); ?></label>
    <?php
}


function oba_ajax_admin_posts_callback(){
    ?>
        <label for="oba_ajax_admin_posts"><input id="oba_ajax_admin_posts" name="oba_ajax_admin_posts" type="checkbox" value="1" <?php checked( get_option('oba_ajax_admin_posts'), 1, true ); ?>><?php _e('Disable ajax save for posts.', 'oba-ajax-admin'); ?></label>
    <?php
}


?>