<?php
get_header(); 
$dontshow_sidebar = of_get_option('md_posts_sidebar');
?>

	<br class="clear">     
	<div class="row searchpage">
		<div class="<?php if(!$dontshow_sidebar) { echo 'two-thirds column'; }else{ echo 'sixteen columns'; } ?>">
<?php if ( have_posts() ) : ?>
			<h1 class="border-color">
				<?php _e( 'Search Results for', 'dronetv' ); ?> : <?php echo '<strong>'.get_search_query().'</strong>';?>
            </h1>
                    <?php 
					// GET ITEMS
						get_template_part( 'loop', 'item' ); 
					
					?>
        
        <?php /* Display navigation to next/previous pages when applicable */ ?>
		<?php if (  $wp_query->max_num_pages > 1 ) : ?>
                <br class="clear" />
                <br class="clear" />
                        <div class="navigation-bottom">
                            <?php previous_posts_link( __( '<span class="meta-nav">&larr;</span> Back', 'dronetv' ) ); ?>
                            <?php next_posts_link( __( 'Next <span class="meta-nav">&rarr;</span>', 'dronetv' ) ); ?>
                        </div>
        <?php endif; ?>
        
        
<?php else : ?>
			<h1 class="border-color">
				<?php _e( 'No results for', 'dronetv' ); ?> <?php echo get_search_query(); ?>
            </h1>
            <div class="noresults">
            	<p><?php _e( 'Sorry, but nothing matched your search criteria. <br>Please try again with different keywords.', 'dronetv' ); ?></p>
                <?php get_search_form(); ?>
            </div>
            
<?php endif; ?>
		</div>
		
        <?php if(!$dontshow_sidebar) { ?>
        <div class="one-third column">
                    <?php get_template_part( 'sidebar', 'blog' ); ?>
        </div>
   		<?php } ?>
   </div>     
<?php get_footer(); ?>
