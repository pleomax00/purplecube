<?php
/*
Template Name: Full Width
*/
?>
<?php get_header(); ?>
    
    	
    	<br class="clear" />
        <div class="row fitvids">
        	<div class="sixteen columns">
			<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
                    <?php the_content(); ?>
            <?php endwhile; ?>
    		</div>
    	</div>
<?php get_footer(); ?>
	