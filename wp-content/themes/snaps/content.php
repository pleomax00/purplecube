<?php
/**
 * @package Snaps
 * @since Snaps 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="post-format-content">
		<div class="post-thumbnail">
			<?php if ( has_post_thumbnail() ) { ?>
				<?php the_post_thumbnail( 'thumbnail' ); ?>
			<?php } else { ?>
				<img src="<?php echo get_template_directory_uri();  ?>/images/canvas.png" />
			<?php } ?>
		</div>

		<div class="content-wrap">
			<h1 class="entry-title"><a href="<?php the_permalink(); ?>" class="featured-image" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'snaps' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
		</div>
	</div>

</article><!-- #post-<?php the_ID(); ?> -->