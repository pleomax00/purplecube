<?php
/*
	Plugin name: Juna IT Poll
	Plugin URI: http://juna-it.com/index.php/features/elements/juna-it-plugin/
	Description: Juna IT Poll - Wordpress Plugin is an instrument for understanding visitor's opinions.
	Version: 1.3.2
	Author: Juna-IT
	Author URI: http://juna-it.com/
	License: GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
*/	
 	require_once('poll-wp_widget.php');
 	require_once('ajax_in_poll.php');
 	require_once('shortcode_poll.php');
 	add_action('wp_enqueue_scripts',function(){
 		wp_register_style( 'poll-wp', plugins_url( '/Styles/WidgetStyle.css',__FILE__ ) );
		wp_enqueue_style( 'poll-wp' );	
		wp_enqueue_script('cwp-main', plugins_url('/Scripts/drawdiagram.js', __FILE__), array('jquery', 'jquery-ui-core'));
		wp_register_script('poll-wp',plugins_url('/Scripts/vote.js',__FILE__));
		wp_localize_script( 'poll-wp', 'object', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
		wp_enqueue_script( 'poll-wp' );
		wp_enqueue_script( "jquery" );
 	});
 	add_action('widgets_init', function() {
 		register_widget('Juna_IT_Poll');
 	} );
	add_action("admin_menu", function() {

		add_menu_page('poll-wp_Admin_Menu','Juna IT Poll', 'manage_options','Juna_IT_Poll', 'Add_Poll','http://juna-it.com/image/admin.png');
 		add_submenu_page('Juna_IT_Poll', 'poll-wp_Admin_Menu', 'Add Poll', 'manage_options', 'Juna_IT_Poll', 'Add_Poll');
		add_submenu_page('Juna_IT_Poll', 'poll-wp_Admin_Menu_Resultsget', 'Results', 'manage_options', 'Admin_Menu_Results', 'See_Results');
	});
	add_action('admin_init', function() {
		wp_register_style( 'poll-wp', plugins_url('/Styles/AdminStyle.css',__FILE__ ));
		wp_enqueue_style( 'poll-wp' );	
		wp_register_script('poll-wp', plugins_url('/Scripts/poll_wp_admin.js',__FILE__));
		wp_localize_script('poll-wp','object', array('ajaxurl'=>admin_url('admin-ajax.php')));
		wp_enqueue_script('poll-wp');
		wp_enqueue_script("jquery");
	});
	function Add_Poll()
	{
		require_once('admin_menu.php');
	}
	function See_Results()
	{
		require_once('submenu.php');
	}	
	function poll_wp_activate()
	{
		require_once('database_install.php');
	}
	register_activation_hook(__FILE__,'poll_wp_activate');
	register_deactivation_hook( __FILE__, 'poll_wp_deactivate');
	function poll_wp_deactivate()
	{
		require_once('poll_uninstall.php');
	}		
?>