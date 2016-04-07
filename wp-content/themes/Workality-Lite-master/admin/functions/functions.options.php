<?php

add_action('init','of_options');

if (!function_exists('of_options'))
{
	function of_options()
	{
		//Access the WordPress Categories via an Array
		$of_categories = array();  
		$of_categories_obj = get_categories('hide_empty=0');
		foreach ($of_categories_obj as $of_cat) {
		    $of_categories[$of_cat->cat_ID] = $of_cat->cat_name;}
		$categories_tmp = array_unshift($of_categories, "Select a category:");    
	       
		//Access the WordPress Pages via an Array
		$of_pages = array();
		$of_pages_obj = get_pages('sort_column=post_parent,menu_order');    
		foreach ($of_pages_obj as $of_page) {
		    $of_pages[$of_page->ID] = $of_page->post_name; }
		$of_pages_tmp = array_unshift($of_pages, "Select a page:");       
	
		//Testing 
		$of_options_select = array("one","two","three","four","five"); 
		$of_options_radio = array("one" => "One","two" => "Two","three" => "Three","four" => "Four","five" => "Five");
		
		//Sample Homepage blocks for the layout manager (sorter)
		$of_options_homepage_blocks = array
		( 
			"disabled" => array (
				"placebo" 		=> "placebo", //REQUIRED!
				"block_one"		=> "Block One",
				"block_two"		=> "Block Two",
				"block_three"	=> "Block Three",
			), 
			"enabled" => array (
				"placebo" => "placebo", //REQUIRED!
				"block_four"	=> "Block Four",
			),
		);


		//Stylesheets Reader
		$alt_stylesheet_path = LAYOUT_PATH;
		$alt_stylesheets = array();
		
		if ( is_dir($alt_stylesheet_path) ) 
		{
		    if ($alt_stylesheet_dir = opendir($alt_stylesheet_path) ) 
		    { 
		        while ( ($alt_stylesheet_file = readdir($alt_stylesheet_dir)) !== false ) 
		        {
		            if(stristr($alt_stylesheet_file, ".css") !== false)
		            {
		                $alt_stylesheets[] = $alt_stylesheet_file;
		            }
		        }    
		    }
		}


		//Background Images Reader
		$bg_images_path = STYLESHEETPATH. '/images/bg/'; // change this to where you store your bg images
		$bg_images_url = get_bloginfo('template_url').'/images/bg/'; // change this to where you store your bg images
		$bg_images = array();
		
		if ( is_dir($bg_images_path) ) {
		    if ($bg_images_dir = opendir($bg_images_path) ) { 
		        while ( ($bg_images_file = readdir($bg_images_dir)) !== false ) {
		            if(stristr($bg_images_file, ".png") !== false || stristr($bg_images_file, ".jpg") !== false) {
		                $bg_images[] = $bg_images_url . $bg_images_file;
		            }
		        }    
		    }
		}
		

		/*-----------------------------------------------------------------------------------*/
		/* TO DO: Add options/functions that use these */
		/*-----------------------------------------------------------------------------------*/
		
		//More Options
		$uploads_arr = wp_upload_dir();
		$all_uploads_path = $uploads_arr['path'];
		$all_uploads = get_option('of_uploads');
		$other_entries = array("Select a number:","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19");
		$body_repeat = array("no-repeat","repeat-x","repeat-y","repeat");
		$body_pos = array("top left","top center","top right","center left","center center","center right","bottom left","bottom center","bottom right");
		
		// Image Alignment radio box
		$of_options_thumb_align = array("alignleft" => "Left","alignright" => "Right","aligncenter" => "Center"); 
		
		// Image Links to Options
		$of_options_image_link_to = array("image" => "The Image","post" => "The Post"); 



/*-----------------------------------------------------------------------------------*/
/* The Options Array */
/*-----------------------------------------------------------------------------------*/

// Set the Options Array
global $of_options;
$of_options = array();


							
													
$of_options[] = array( "name" => "Header Settings",
					"type" => "heading");
	
										
$of_options[] =   		array(
						'id' => 'md_header_logo',
						'type' => 'upload',
						'name' => __('Site Logo', ''), 
						'desc' => __('Click browse button and upload image. In order to add image into your site, click "Insert into post" button', ''),
						'std'=>''
						);
						
$of_options[] =   		array(
						'id' => 'md_header_logo_text',
						'type' => 'text',
						'name' => __('Site Logo Text', ''),
						'desc' => __('If you don\'t add any logo image, this text will be shown as logo', ''),
						'std' => get_bloginfo('name')
						);
	
$of_options[] = 		array(
						'id' => 'md_header_logo_subtext',
						'type' => 'text',
						'name' => __('Site Logo Sub-Text', ''),
						'desc' => __('This text will be shown below your logo', ''),
						'std' => ''
						);

$of_options[] =			array(
						'id' => 'md_header_disable_search',
						'type' => 'checkbox',
						'name' => __('Disable Search Bar on the header', ''), 
						'desc' => __('', ''),
						'std' => '0'// 1 = on | 0 = off
						);
	
							
	
$of_options[] = array( "name" => "Posts",
					"type" => "heading");
						
														
$of_options[] =   array(
						'id' => 'md_post_featured_img_size',
						'type' => 'images',
						'name' => __('Works Thumbnail Size', ''), 
						'desc' => __('Select thumbnail size for your portfolio list', ''),
						'options' => array(
										'small' => ADMIN_IMG_DIRECTORY . 'thumbnail_size1.png',
										'medium' => ADMIN_IMG_DIRECTORY . 'thumbnail_size2.png',
										'large' => ADMIN_IMG_DIRECTORY . 'thumbnail_size3.png',
										'portrait' => ADMIN_IMG_DIRECTORY . 'thumbnail_size4.png',
									 ),
						'std' => 'medium'
						);

					
$of_options[] =			array(
						'id' => 'md_posts_sidebar',
						'type' => 'checkbox',
						'name' => 'Show Blog Siderbars', 
						'desc' => __('Disable sidebar in blog posts', ''),
						'std' => '0'// 1 = on | 0 = off
						);
						
					
$of_options[] =			array(
						'id' => 'md_posts_sidebar_single',
						'type' => 'checkbox',
						'name' => '', 
						'desc' => __('Disable sidebar in single post', ''),
						'std' => '0'// 1 = on | 0 = off
						);

$of_options[] = 		array(
						'id' => 'md_post_show_category',
						'type' => 'checkbox',
						'name' => 'Show Blog Post Info', 
						'desc' => __('Show Category', ''),
						'std' => '1'// 1 = on | 0 = off
						);
$of_options[] =			array(
						'id' => 'md_post_show_date',
						'type' => 'checkbox',
						'name' => '', 
						'desc' => __('Show Date', ''),
						'std' => '1'// 1 = on | 0 = off
						);

$of_options[] = 		array(
						'id' => 'md_post_show_author',
						'type' => 'checkbox',
						'name' => '',
						'desc' => __('Show Author info', ''), 
						'std' => '1'// 1 = on | 0 = off
						);	
$of_options[] = 		array(
						'id' => 'md_post_show_comments',
						'type' => 'checkbox',
						'name' => '', 
						'desc' => __('Show Comment Count', ''),
						'std' => '1'// 1 = on | 0 = off
						);





$of_options[] = array( "name" => "Posts Sharing",
					"type" => "heading");
							

$of_options[] = array( "name" => "Disable Top Share Buttons in Works Posts",
									"desc" => "This option will disable all share buttons on top right of the page",
									"id" => "md_social_post_disable_top",
									"std" => "0",
									"type" => "checkbox"); 
									
$of_options[] = array( "name" => "Disable Bottom Share Buttons in Works&Blog Posts",
									"desc" => "This option will disable all share buttons on bottom left of the page",
									"id" => "md_social_post_disable_bottom",
									"std" => "0",
									"type" => "checkbox"); 
													
														
$of_options[] = array( "name" => "Show Share Buttons in Posts",
									"desc" => "Facebook",
									"id" => "md_social_post_facebook",
									"std" => "1",
									"type" => "checkbox"); 																	
$of_options[] = array( "name" => "",
					"desc" => "Twitter",
					"id" => "md_social_post_twitter",
					"std" => "1",
					"type" => "checkbox");
					
$of_options[] = array( "name" => "",
					"desc" => "Google +",
					"id" => "md_social_post_googleplus",
					"std" => "0",
					"type" => "checkbox"); 	
										
$of_options[] = array( "name" => "",
					"desc" => "Pinterest",
					"id" => "md_social_post_pinterest",
					"std" => "0",
					"type" => "checkbox"); 
					
$of_options[] = array( "name" => "",
					"desc" => "Tumblr",
					"id" => "md_social_post_tumblr",
					"std" => "0",
					"type" => "checkbox"); 	

	
	
		
$of_options[] = array( "name" => "SEO",
					"type" => "heading");
															
$of_options[] = 		array(
						'id' => 'md_header_seo_description',
						'type' => 'textarea',
						'name' => __('Site Description', ''),
						'desc' => __('Your website\'s general description.', ''),
						'std' => ''
						);
$of_options[] = 		array(
						'id' => 'md_header_seo_keywords',
						'type' => 'textarea',
						'name' => __('Site Keywords', ''),
						'desc' => __('Your website keywords for SEO optimization. Seperate by comma. E.g. Design, Portfolio, Artist, Design Blog', ''),
						'std' => ''
						);
						
$of_options[] = 		array(
						'id' => 'md_footer_googleanalytics',
						'type' => 'textarea',
						'name' => __('Google Analytics Code', ''),
						'desc' => __('Simply paste your google analytics code in order to get statistics', ''),
						'std' => ''
						);
						
						

						

$of_options[] = array( "name" => "Footer Settings",
					"type" => "heading");
	

$of_options[] = 		array(
						'id' => 'md_footer_text',
						'type' => 'text',
						'name' => __('Footer Text', ''),
						'desc' => __('', ''),
						'std' => ''
						);


$of_options[] =			array(
						'id' => 'md_footer_widgets_disabled',
						'type' => 'checkbox',
						'name' => __('Disable Footer Widgets', ''), 
						'desc' => __('If you don\'t want to use footer widgets you can disable it', ''),
						'std' => '0'// 1 = on | 0 = off
						);
						

$of_options[] =			array(
						'id' => 'md_footer_widgets_columns',
						'name' => __('Footer Widgets Columns', ''), 
						'desc' => __('How many columns for footer widgets', ''),
						"type" => "select",
						'std' => '4',
						"options" => array(1,2,3,4));  	
						
						
						
												
					
				
$of_options[] = array( "name" => "Social Icons",
					"type" => "heading");
											
$of_options[] = 		array(
						'id' => 'md_social_facebook',
						'type' => 'text',
						'name' => __('Facebook', ''),
						'desc' => __('E.g. http://www.facebook.com/username', ''),
						'std' => ''
						);	
$of_options[] = 		array(
						'id' => 'md_social_twitter',
						'type' => 'text',
						'name' => __('Twitter', ''),
						'desc' => __('E.g. http://twitter.com/username', ''),
						'std' => ''
						);	
$of_options[] = 		array(
						'id' => 'md_social_tumblr',
						'type' => 'text',
						'name' => __('Tumblr', ''),
						'desc' => __('E.g. http://username.tumblr.com', ''),
						'std' => ''
						);	
$of_options[] = 		array(
						'id' => 'md_social_flickr',
						'type' => 'text',
						'name' => __('Flickr', ''),
						'desc' => __('E.g. http://www.flickr.com/photos/YourID', ''),
						'std' => ''
						);		
$of_options[] = 		array(
						'id' => 'md_social_pinterest',
						'type' => 'text',
						'name' => __('Pinterest', ''),
						'desc' => __('E.g. http://pinterest.com/username', ''),
						'std' => ''
						);		
$of_options[] = 		array(
						'id' => 'md_social_vimeo',
						'type' => 'text',
						'name' => __('Vimeo', ''),
						'desc' => __('E.g. http://vimeo.com/username', ''),
						'std' => ''
						);		
$of_options[] = 		array(
						'id' => 'md_social_google',
						'type' => 'text',
						'name' => __('Google+', ''),
						'desc' => __('E.g. https://plus.google.com/YourID', ''),
						'std' => ''
						);		
$of_options[] = 		array(
						'id' => 'md_social_linkedin',
						'type' => 'text',
						'name' => __('Linkedin', ''),
						'desc' => __('E.g. http://www.linkedin.com/profile/view?id=YourID', ''),
						'std' => ''
						);	
							
$of_options[] = 		array(
						'id' => 'md_social_behance',
						'type' => 'text',
						'name' => __('Behance', ''),
						'desc' => __('E.g. http://www.behance.net/username', ''),
						'std' => ''
						);		

$of_options[] = 		array(
						'id' => 'md_social_dribble',
						'type' => 'text',
						'name' => __('Dribbble', ''),
						'desc' => __('E.g. http://dribbble.com/username', ''),
						'std' => ''
						);	


													
											

// Backup Options
$of_options[] = array( "name" => "Transfer",
					"type" => "heading",
					"icon"=>'exchange'
					);
					
$of_options[] = array( "name" => "Backup and Restore Options",
                    "id" => "of_backup",
                    "std" => "",
                    "type" => "backup",
					"desc" => 'You can use the two buttons below to backup your current options, and then restore it back at a later time. This is useful if you want to experiment on the options but would like to keep the old settings in case you need it back.',
					);
					
$of_options[] = array( "name" => "Transfer Theme Options Data",
                    "id" => "of_transfer",
                    "std" => "",
                    "type" => "transfer",
					"desc" => 'You can tranfer the saved options data between different installs by copying the text inside the text box. To import data from another install, replace the data in the text box with the one from another install and click "Import Options".
						',
					);
					
	
$of_options[] = array( "name" => "",
                    "id" => "md_migrate_info",
                    "std" => "<strong>Update Your Domain Name for Works Images</strong><br>
					DO NOT USE THIS OPTION UNLESS YOUR DOMAIN NAME IS CHANGED<br>
					This option must be used when your Wordpress content has been moved/imported into another Wordpress (remote server/local server etc.). It allows you to update the current URLs of the \"Works\" post type images. This is a required step since Works images are using absolute URL paths.
					<br><br>
					In order to complete this step, enter your previous website URL and new website URL below, then click to Replace URLs button.<br><br>
					Before proceed, it's strongly recommended to backup your Database.
					",
                    "type" => "info",
					"desc" => '',
					);
					
										
$of_options[] = 		array(
						'id' => 'md_migrate_local',
						'type' => 'migrate',
						'name' => __('Replace URLs', ''),
						'desc' => __('', ''),
						'std' => '0'
						);	
						
						
												
										
	}
}
?>
