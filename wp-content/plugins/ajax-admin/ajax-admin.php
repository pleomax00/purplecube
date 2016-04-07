<?php
/*
Plugin Name: Ajax Admin
Plugin URI: http://wp-plugins.in/ajax-admin
Description: Save settings and posts using Ajax! Fast and easy, no options.. just activate plugin! translation ready, RTL Support, Arabic language included.
Version: 1.0.0
Author: Alobaidi
Author URI: http://wp-plugins.in
License: GPLv2 or later
Text Domain: oba-ajax-admin
*/

/*  Copyright 2016 Alobaidi (email: wp-plugins@outlook.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/


defined( 'ABSPATH' ) or die( 'No script kiddies please!' );


function alobaidi_ajax_admin_plugin_row_meta( $links, $file ) {

	if ( strpos( $file, 'ajax-admin.php' ) !== false ) {
		
		$new_links = array(
						'<a href="http://wp-plugins.in/ajax-admin" target="_blank">Explanation of Use</a>',
						'<a href="https://profiles.wordpress.org/alobaidi#content-plugins" target="_blank">More Plugins</a>',
						'<a href="http://j.mp/ET_WPTime_ref_pl" target="_blank">Elegant Themes</a>'
					);
		
		$links = array_merge( $links, $new_links );
		
	}
	
	return $links;
	
}
add_filter( 'plugin_row_meta', 'alobaidi_ajax_admin_plugin_row_meta', 10, 2 );


function alobaidi_ajax_admin_load_plugin_textdomain() {
	load_plugin_textdomain( 'oba-ajax-admin', false, plugin_basename( dirname( __FILE__ ) ) . '/languages' );
}
add_action( 'plugins_loaded', 'alobaidi_ajax_admin_load_plugin_textdomain' );


include( plugin_dir_path( __FILE__ ) . '/settings.php' );


function alobaidi_ajax_admin_include_javascript() {
	wp_enqueue_style( 'alobaidi_ajax_admin_css', plugins_url( '/css/alobaidi_ajax_admin.css', __FILE__ ), false, false);

	if( is_rtl() ){
		wp_enqueue_style( 'alobaidi_ajax_admin_css_rtl', plugins_url( '/css/alobaidi_ajax_admin_rtl.css', __FILE__ ), false, false);
	}

	if( !get_option('oba_ajax_admin_settings') ){
		wp_enqueue_script( 'alobaidi_ajax_admin_settings', plugins_url( '/js/alobaidi_ajax_admin_settings.js', __FILE__ ), array('jquery-form'), false, false);
	}
	
	if( !get_option('oba_ajax_admin_posts') ){
		wp_enqueue_script( 'alobaidi_ajax_admin_posts', plugins_url( '/js/alobaidi_ajax_admin_posts.js', __FILE__ ), array('jquery-form'), false, false);
	}
}
add_action( 'admin_enqueue_scripts', 'alobaidi_ajax_admin_include_javascript' );


function alobaidi_ajax_admin_elements() {
	?>
		<div id="alobaidi-ajax-admin-wrap">
			<div class="alobaidi-ajax-admin-save"><p><?php _e('Saved!', 'oba-ajax-admin'); ?></p><span title="<?php _e('Close', 'oba-ajax-admin'); ?>" class="alobaidi-ajax-admin-close"></span></div>
		</div>
	<?php
}
add_action('admin_footer', 'alobaidi_ajax_admin_elements');

?>