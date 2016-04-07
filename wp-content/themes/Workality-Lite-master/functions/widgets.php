<?php

	register_sidebar( array(
		'name' => __( "Blog Sidebar", 'dronetv' ),
		'id' => 'blog-right',
		'before_widget' => '<div id="%1$s" class="%2$s widget blog-sidebar">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>'
	));
	register_sidebar( array(
		'name' => __( "Page Sidebar", 'dronetv' ),
		'id' => 'page-right',
		'before_widget' => '<div id="%1$s" class="%2$s page-sidebar widget">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>'
	));
	
	register_sidebar( array(
		'name' => __( "Bottom 1", 'dronetv' ),
		'id' => 'bottom-1',
		'before_widget' => '<div id="%1$s" class="%2$s bottom-sidebar widget">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>'
	));
	
	register_sidebar( array(
		'name' => __( "Bottom 2", 'dronetv' ),
		'id' => 'bottom-2',
		'before_widget' => '<div id="%1$s" class="%2$s bottom-sidebar widget">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>'
	));
	
	register_sidebar( array(
		'name' => __( "Bottom 3", 'dronetv' ),
		'id' => 'bottom-3',
		'before_widget' => '<div id="%1$s" class="%2$s bottom-sidebar widget">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>'
	));
	
	register_sidebar( array(
		'name' => __( "Bottom 4", 'dronetv' ),
		'id' => 'bottom-4',
		'before_widget' => '<div id="%1$s" class="%2$s bottom-sidebar widget">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>'
	));
	
?>
