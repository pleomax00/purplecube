<?php

///// WORKS REGISTER

if ( ! function_exists( 'md_works' ) ) {	
	function md_works() {
		 
		$labels = array(
			'name' => _x( "Works", "Post type name", 'dronetv' ),
			'singular_name' => _x( "Works", "Post type singular name", 'dronetv' ),
			'add_new' => _x( "Add New Project", "work item", 'dronetv' ),
			'add_new_item' => __( "Add New Project", 'dronetv' ),
			'edit_item' => __( "Edit Project", 'dronetv' ),
			'new_item' => __( "New Project", 'dronetv' ),
			'view_item' => __( "View Project", 'dronetv' ),
			'search_items' => __( "Search Project", 'dronetv' ),
			'not_found' =>  __( "Not found", 'dronetv' ),
			'not_found_in_trash' => __( "Trash is empty", 'dronetv' ),
			'parent_item_colon' => ''
		);
		
		register_post_type( 'works' , array(
			'label'=>_x('Works','Type','dronetv'),
			'description'=>__('Special type of post for creating project','dronetv'),
			'labels' => $labels,
			'public' => true,
			'menu_position' => 5,
			'show_ui' => true,
			'show_in_menu' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => true,
			'query_var' => true,
			'menu_icon'=>get_template_directory_uri() . '/images/portfolio_icon.png',
			'rewrite' => true,
			'capability_type' => 'post',
			'hierarchical' => false,
			'supports' => array( 'title', 'editor','thumbnail')
			)
		  ); 
		
		//$wp_rewrite->flush_rules();
		flush_rewrite_rules();
	}
}


register_taxonomy( "works-categories", 
	array( 	"works" ), 
	array( 	"hierarchical" => true,
			"labels" => array('name'=>"Creative Fields",'add_new_item'=>"Add New Field"), 
			"singular_label" => __( "Field", 'dronetv' ), 
			"rewrite" => array( 'slug' => 'fields', // This controls the base slug that will display before each term 
							'with_front' => false)
		 ) 
);


// Custom post type for works
add_action( 'init', 'md_works' );

add_action( "manage_posts_custom_column",  "md_works_custom_columns" );
add_filter( "manage_edit-works_columns", "md_works_edit_columns" );


if ( ! function_exists( 'md_works_edit_columns' ) ) {		 
	function md_works_edit_columns( $columns ) {
	  
	  $columns = array(
		"cb" => "<input type=\"checkbox\" />",
		"title" => __( "Project Title", 'dronetv' ),
		"description" => __( "Description", 'dronetv' ),
		"works-categories" => __( "Fields", 'dronetv' ),
		//"work_tags" => __( "Tags", 'dronetv' ),
		"date" => __( "Date", 'dronetv' )
	  );
	 
	  return $columns;
	  
	}
}



if ( ! function_exists( 'md_works_custom_columns' ) ) {		
	function md_works_custom_columns( $column ) {
		
	  global $post;
	 
	  switch ($column) {
		case "description":
		  the_excerpt();
		  break;
		case "works-categories":
		  echo get_the_term_list( $post->ID, 'works-categories', '', ', ','' );
		  break;
		case "work_tags":
		  //echo get_the_term_list( $post->ID, 'work_tags', '', ', ','' );
		break;
	  }
	  
	}
}

?>