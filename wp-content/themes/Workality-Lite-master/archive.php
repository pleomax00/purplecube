<?php
global $wp_query;
$post_obj = $wp_query->get_queried_object();
?>
<?php get_header(); ?>

	<?php 
		if(isset($post_obj->taxonomy)) {
			if($post_obj->taxonomy=="works-categories") {
				get_template_part( 'works', 'index' );
			}else{
				get_template_part( 'loop', 'index' ); 
			}
		}else{
				get_template_part( 'loop', 'index' );	
		}
	?>

<?php get_footer(); ?>
