<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package Snaps
 * @since Snaps 1.0
 */
?>

	</div><!-- #main .site-main -->

	<?php get_sidebar(); ?>

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
			<?php do_action( 'snaps_credits' ); ?>
			<a href="http://wordpress.org/" title="<?php esc_attr_e( 'A Semantic Personal Publishing Platform', 'snaps' ); ?>" rel="generator"><?php printf( __( 'Proudly powered by %s', 'snaps' ), 'WordPress' ); ?></a>.
			<?php printf( __( 'Theme: %1$s by %2$s.', 'snaps' ), 'Snaps', '<a href="http://graphpaperpress.com/" rel="designer">Graph Paper Press</a>' ); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon .site-footer -->
</div><!-- #page .hfeed .site -->

<?php wp_footer(); ?>

</body>
</html>