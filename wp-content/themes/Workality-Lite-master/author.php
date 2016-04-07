<?php
get_header(); 
$dontshow_sidebar = of_get_option('md_posts_sidebar');
?>

	<br class="clear">     
	<div class="row searchpage">
		<div class="<?php if(!$dontshow_sidebar) { echo 'two-thirds column'; }else{ echo 'sixteen columns'; } ?>">

<?php if ( have_posts() ) : the_post(); ?>
			<h1 class="border-color">
				<?php _e( 'Author Archives: '. get_the_author(), 'dronetv' ); ?>
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
        
<?php endif; ?>
		</div>
		
        <?php if(!$dontshow_sidebar) { ?>
        <div class="one-third column">
                    <?php get_template_part( 'sidebar', 'blog' ); ?>
        </div>
   		<?php } ?>
   </div>     
<?php get_footer(); ?>

