<?php
/**
 * @package Snaps
 * @since Snaps 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<div class="entry-meta-wrap">
			<span class="entry-meta">
				<?php snaps_posted_on(); ?>
			</span><!-- .entry-meta -->
			<?php
				/* translators: used between list items, there is a space after the comma */
				$category_list = get_the_category_list( __( ', ', 'snaps' ) );

				/* translators: used between list items, there is a space after the comma */
				$tag_list = get_the_tag_list( '', __( ', ', 'snaps' ) );

				if ( ! snaps_categorized_blog() ) {
					// This blog only has 1 category so we just need to worry about tags in the meta text
					if ( '' != $tag_list ) {
						$meta_text = __( '<span class="entry-meta">Tags: %2$s</span>', 'snaps' );
					}

				} else {
					// But this blog has loads of categories so we should probably display them here
					if ( '' != $tag_list ) {
						$meta_text = __( '<span class="entry-meta">Categories: %1$s.</span>', 'snaps' );
						$meta_text .=__( '<span class="entry-meta">Tags: %2$s</span>', 'snaps' );
					} else {
						$meta_text = __( '<span class="entry-meta">Category: %1$s</span>', 'snaps' );
					}

				} // end check for categories on this blog
				$meta_text .=  __( '<span class="entry-meta">Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a></span>', 'snaps' );

				printf(
					$meta_text,
					$category_list,
					$tag_list,
					get_permalink(),
					the_title_attribute( 'echo=0' )
				);
			?>

			<?php edit_post_link( __( 'Edit', 'snaps' ), '<span class="edit-link entry-meta">', '</span>' ); ?>
		</div>
		<div class="single-content-wrap">
			<?php the_content(); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'snaps' ), 'after' => '</div>' ) ); ?>
		</div>
	</div><!-- .entry-content -->

</article><!-- #post-<?php the_ID(); ?> -->
