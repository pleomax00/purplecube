<?php 

/************************************************************
/* AJAX CALLS
/************************************************************/

add_action( "wp_ajax_md_work_post", "md_work_post" );
add_action( "wp_ajax_nopriv_md_work_post", "md_work_post" );
add_action( "wp_ajax_md_work_all_post", "md_work_all_post" );
add_action( "wp_ajax_nopriv_md_work_all_post", "md_work_all_post" );
add_action( "wp_ajax_md_quickslide", "md_quickslide" );
add_action( "wp_ajax_nopriv_md_quickslide", "md_quickslide" );
add_action('comment_post', 'ajaxify_comments',20, 2);


if ( ! function_exists( 'md_work_post' ) ) {
	function md_work_post($type) {
		global $withcomments;
		$withcomments = true; 
		
		if ( !wp_verify_nonce( $_REQUEST['token'], "wp_token" ) ) {
			exit(0);
		}  
		
		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
			// GET POST
			if($_REQUEST['type']=="blog") {
				get_template_part( 'loop', 'single' );
			}elseif($_REQUEST['type']=="works") {
				get_template_part( 'works', 'single' );	
			}
		}else {
			header("Location: ".$_SERVER["HTTP_REFERER"]);
		}
	
		die();
	}
}


if ( ! function_exists( 'md_work_all_post' ) ) {
	function md_work_all_post() {
		
		if ( !wp_verify_nonce( $_REQUEST['token'], "wp_token" ) ) {
			exit(0);
		}  
		
		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
			// GET POST
			if($_REQUEST['type']=="blog") {
				get_template_part( 'loop', 'index' );
			}elseif($_REQUEST['type']=="works") {
				get_template_part( 'works', 'index' );
			}
		}else {
			header("Location: ".$_SERVER["HTTP_REFERER"]);
		}
	
		die();
	}
}


/* Create PHP Handler ------------------------------------------------------------------[ajaxify_comments()]------- */


if ( ! function_exists( 'ajaxify_comments' ) ) {
	function ajaxify_comments($comment_ID, $comment_status){
		
		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
			switch($comment_status){
				case "0":
					wp_notify_moderator($comment_ID);
				case "1": //Approved comment
				echo "success";
					$commentdata =& get_comment($comment_ID, ARRAY_A);
					$post =& get_post($commentdata['comment_post_ID']);
					wp_notify_postauthor($comment_ID, $commentdata['comment_type']);
				break;
				default:
				echo 0;
			}
		exit;
		}
	}
}

?>