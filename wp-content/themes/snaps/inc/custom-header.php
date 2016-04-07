<?php
/**
 * Sample implementation of the Custom Header feature
 * http://codex.wordpress.org/Custom_Headers
 *
 * You can add an optional custom header image to header.php like so ...
 *
 * @package Snaps
 * @since Snaps 1.0
 */

/**
 * Setup the WordPress core custom header feature.
 *
 * Use add_theme_support to register support for WordPress 3.4+
 * as well as provide backward compatibility for previous versions.
 * Use feature detection of wp_get_theme() which was introduced
 * in WordPress 3.4.
 * *
 * @uses snaps_header_style()
 * @uses snaps_admin_header_style()
 * @uses snaps_admin_header_image()
 *
 * @package Snaps
 */
function snaps_custom_header_setup() {
	$args = array(
		'default-image'          => '',
		'default-text-color'     => 'fff',
		'width'                  => 1200,
		'height'                 => 500,
		'flex-height'            => true,
		'wp-head-callback'       => 'snaps_header_style',
		'admin-head-callback'    => 'snaps_admin_header_style',
		'admin-preview-callback' => 'snaps_admin_header_image',
	);

	$args = apply_filters( 'snaps_custom_header_args', $args );

	if ( function_exists( 'wp_get_theme' ) ) {
		add_theme_support( 'custom-header', $args );
	}
}
add_action( 'after_setup_theme', 'snaps_custom_header_setup' );


if ( ! function_exists( 'snaps_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see snaps_custom_header_setup().
 *
 * @since Snaps 1.0
 */
function snaps_header_style() {

	// If no custom options for text are set, let's bail
	// get_header_textcolor() options: HEADER_TEXTCOLOR is default, hide text (returns 'blank') or any hex value
	if ( HEADER_TEXTCOLOR == get_header_textcolor() )
		return;
	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
	<?php
		// Has the text been hidden?
		if ( 'blank' == get_header_textcolor() ) :
	?>
		.site-title,
		.site-description {
			position: absolute !important;
			clip: rect(1px 1px 1px 1px); /* IE6, IE7 */
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
		// If the user has set a custom color for the text use that
		else :
	?>
		.site-title a,
		.site-description {
			color: #<?php echo get_header_textcolor(); ?> !important;
		}
	<?php endif; ?>
	</style>
	<?php
}
endif; // snaps_header_style

if ( ! function_exists( 'snaps_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * @see snaps_custom_header_setup().
 *
 * @since Snaps 1.0
 */
function snaps_admin_header_style() {
?>
	<style type="text/css">
	.appearance_page_custom-header #headimg {
		border: none;
		position: relative;
	}
	#headimg h1 {
		opacity: 0.8;
    	text-decoration: none;
    	font-size: 8em;
	    font-weight: bold;
	    line-height: 1.2;
	    padding-top: 40px;
	    text-shadow: 7px 7px 0 rgba(0, 0, 0, 0.5);
	    text-transform: uppercase;
	    position: absolute;
	    text-align: center;
	    width: 100%;
	    bottom: 30px;
	}
	#headimg h1 a {
		text-decoration: none;
	}
	#desc {
		opacity: 0.8;
	    font-weight: normal;
	    line-height: 1.2;
	    padding-top: 40px;
	    text-transform: uppercase;
	    position: absolute;
	    text-align: center;
	    width: 100%;
	    bottom: 50px;
	    font-size: 1.8em;
	}

	</style>
<?php
}
endif; // snaps_admin_header_style

if ( ! function_exists( 'snaps_admin_header_image' ) ) :
/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 *
 * @see snaps_custom_header_setup().
 *
 * @since Snaps 1.0
 */
function snaps_admin_header_image() { ?>
	<div id="headimg">
		<?php
		if ( 'blank' == get_header_textcolor() || '' == get_header_textcolor() )
			$style = ' style="display:none;"';
		else
			$style = ' style="color:#' . get_header_textcolor() . ';"';
		?>
		<h1><a id="name"<?php echo $style; ?> onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
		<div id="desc"<?php echo $style; ?>><?php bloginfo( 'description' ); ?></div>
		<?php $header_image = get_header_image();
		if ( ! empty( $header_image ) ) : ?>
			<img src="<?php echo esc_url( $header_image ); ?>" alt="" />
		<?php endif; ?>
	</div>
<?php }
endif; // snaps_admin_header_image