<?php
/************************************************************
/* Admin Area Scripts & Styles
/************************************************************/

add_action('admin_print_scripts', 'md_admin_scripts');
add_action('admin_print_styles', 'md_admin_styles');


if ( ! function_exists( 'md_admin_scripts' ) ) {			
	function md_admin_scripts() {
				
				global $pagenow, $current_screen;
				
				if ( ($current_screen->post_type == 'works' || $current_screen->post_type == 'inspiration') && ($pagenow=="post.php" || $pagenow=="post-new.php")) {
					
				/***************************************
				/* SCRIPTS
				/***************************************/
				/// upload scripts
				wp_enqueue_script( 'media-upload' );
				wp_enqueue_script(
					'upload-js', 
					get_template_directory_uri().'/functions/field_upload.js', 
					array('jquery', 'thickbox', 'media-upload','jquery-ui-core', 'jquery-ui-datepicker'),
					time(),
					true
				);
				wp_localize_script('upload-js', 'wpurl', array( 'siteurl' => ADMIN_IMG_DIRECTORY ));
				wp_enqueue_style('thickbox');
				
				wp_enqueue_style('color-picker', get_template_directory_uri() . '/admin/assets/css/colorpicker.css');
				
				}
				
	}
}
	

if ( ! function_exists( 'md_admin_styles' ) ) {	
	function md_admin_styles() {
				global $pagenow, $current_screen;
				
				if ( ($current_screen->post_type == 'works' || $current_screen->post_type == 'inspiration') && ($pagenow=="post.php" || $pagenow=="post-new.php")) {
				/***************************************
				/* STYLES
				/***************************************/
				wp_enqueue_style( 'thickbox' ); /// upload
				wp_enqueue_style( 'custom', get_template_directory_uri() . '/functions/css/custom-fields.css' ); /// custom styles
				wp_enqueue_style( 'jquery-ui-css', get_template_directory_uri() . '/functions/css/jquery-ui-aristo/aristo.css' ); /// date picker
				wp_enqueue_script('color-picker-js', get_template_directory_uri() .'/admin/assets/js/colorpicker.js', array('jquery'));
				}
	}
}

/************************************************************
/* wp_head() Front-End Scripts & Styles
/************************************************************/

add_action( 'wp_enqueue_scripts', 'md_add_wphead'); 
add_action( 'wp_footer', 'md_add_footer' ); 


if ( ! function_exists( 'md_add_wphead' ) ) {
	function md_add_wphead() {
		
		// Modernizr
		wp_register_script( 'modernizr', get_template_directory_uri() . '/js/modernizr.js' );
		wp_enqueue_script( 'modernizr' );
		
		// JQuery (Remove bundle ver. and include new)
		wp_deregister_script( 'jquery' );
		wp_register_script( 'jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js' );
		wp_enqueue_script( 'jquery' );
		
		// INCLUDE JS
		wp_register_script( 'include', get_template_directory_uri() . '/js/include.js');
		wp_enqueue_script( 'include' );
			
	}  
}



if ( ! function_exists( 'md_add_footer' ) ) {
	function md_add_footer() {
		
		// Drone JS
		wp_register_script( 'drone', get_template_directory_uri() . '/js/drone.js');
		wp_enqueue_script( 'drone' );
	
		wp_localize_script('drone', 'mdajaxurl', array('ajax'=>admin_url( 'admin-ajax.php')));	
		
	}  
}


?>