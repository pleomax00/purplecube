<?php
/**
 * snaps functions and definitions
 *
 * @package Snaps
 * @since Snaps 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since Snaps 1.0
 */
if ( ! isset( $content_width ) )
	$content_width = 640; /* pixels */

/*
 * Load Jetpack compatibility file.
 */
require( get_template_directory() . '/inc/jetpack.php' );

if ( ! function_exists( 'snaps_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since Snaps 1.0
 */
function snaps_setup() {

	/**
	 * Custom template tags for this theme.
	 */
	require( get_template_directory() . '/inc/template-tags.php' );

	/**
	 * Custom functions that act independently of the theme templates
	 */
	require( get_template_directory() . '/inc/extras.php' );

	/**
	 * Customizer additions
	 */
	require( get_template_directory() . '/inc/customizer.php' );

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on snaps, use a find and replace
	 * to change 'snaps' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'snaps', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable support for Post Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	set_post_thumbnail_size( 480, 640, true ); // default thumbnail

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'snaps' ),
	) );

	/**
	 * Enable support for Post Formats
	 */
	add_theme_support( 'post-formats', array( 'image', 'gallery' ) );
}
endif; // snaps_setup
add_action( 'after_setup_theme', 'snaps_setup' );

/**
 * Setup the WordPress core custom background feature.
 *
 * Use add_theme_support to register support for WordPress 3.4+
 * as well as provide backward compatibility for WordPress 3.3
 * using feature detection of wp_get_theme() which was introduced
 * in WordPress 3.4.
 *
 * @todo Remove the 3.3 support when WordPress 3.6 is released.
 *
 * Hooks into the after_setup_theme action.
 */
function snaps_register_custom_background() {
	$args = array(
		'default-color' => 'eeeeee',
		'default-image' => '',
	);

	$args = apply_filters( 'snaps_custom_background_args', $args );

	if ( function_exists( 'wp_get_theme' ) ) {
		add_theme_support( 'custom-background', $args );
	}
}
add_action( 'after_setup_theme', 'snaps_register_custom_background' );

/**
 * Register widgetized area and update sidebar with default widgets
 *
 * @since Snaps 1.0
 */
/**
 * Enqueue sidebar styles, which change widths depending on the number of sidebars present
 */
function snaps_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Footer One', 'snaps' ),
		'id' => 'footer-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
	register_sidebar( array(
		'name' => __( 'Footer Two', 'snaps' ),
		'id' => 'footer-2',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
	register_sidebar( array(
		'name' => __( 'Footer Three', 'snaps' ),
		'id' => 'footer-3',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
}
add_action( 'widgets_init', 'snaps_widgets_init' );

function snaps_sidebar_styles() {

	if ( ! is_active_sidebar( 'footer-1' ) && ! is_active_sidebar( 'footer-2' ) && ! is_active_sidebar( 'footer-3' ) )
		return;

	$num_sidebars = 0;

	if ( is_active_sidebar( 'footer-1' ) )
		$num_sidebars++;

	if ( is_active_sidebar( 'footer-2' ) )
		$num_sidebars++;

	if ( is_active_sidebar( 'footer-3' ) )
		$num_sidebars++;

	switch( $num_sidebars ) :

		case 1:
			$width = '100%';
			break;

		case 2:
			$width = '49%';
			break;

		default:
			$width = '32%';

	endswitch; ?>

	<style type="text/css">
		 .widget-area {
		 	width: <?php echo esc_html( $width ); ?>;
		 }
	</style>
<?php }
add_action( 'wp_enqueue_scripts', 'snaps_sidebar_styles' );

/**
 * Enqueue scripts and styles
 */
function snaps_scripts() {
	wp_enqueue_style( 'snaps-style', get_stylesheet_uri() );

	wp_enqueue_script( 'snaps-scripts', get_template_directory_uri() . '/js/scripts.js', array( 'jquery' ), '20120206', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'snaps-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}
}
add_action( 'wp_enqueue_scripts', 'snaps_scripts' );

/**
 * Implement the Custom Header feature
 */
require( get_template_directory() . '/inc/custom-header.php' );
