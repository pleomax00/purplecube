<?php get_header(); ?>

	<br class="clear" />
    
	<div class="defaultpage">
  
  
	<?php if ( have_posts() ) { the_post(); ?>
        <div class="two-thirds column">
			<?php the_content(); ?>
		</div>
	<?php } ?>
    
        <div class="one-third column">
             <?php get_template_part( 'sidebar', 'page' ); ?>
        </div>
	</div>	
<?php get_footer(); ?>
	