<?php
// AJAX TOKEN
$token = wp_create_nonce("wp_token");
$theblogtitle = of_get_option('md_theblog_title');	

// SHOW SIDEBAR WHETHER OR NOT
$dontshow_sidebar = of_get_option('md_posts_sidebar');

// GET POSTS
if(!is_archive()) {
	global $more; $more = 0; 
	$page = (get_query_var('paged')) ? get_query_var('paged') : 1;
	
	$args = array(
		'more'=>1,
		'post_type' => 'post',
		'orderby' => 'post_date',
		'order'=>'desc',
		'paged'=>$page,
		'cat'=>$cat,
		'post_status' => array('publish')
	);
	query_posts( $args );
}

?>
      
         <div class="columns navibg withall border-color">
            <div class="four columns alpha">
            	<h3>
					<?php if(is_archive()) { ?>
					<?php if ( is_day() ) : ?>
                                    <?php printf( __( 'Daily Archives: <span>%s</span>', 'dronetv' ), get_the_date() ); ?>
                    <?php elseif ( is_month() ) : ?>
                                    <?php printf( __( 'Monthly Archives: <span>%s</span>', 'dronetv' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'dronetv' ) ) ); 			?>
                    <?php elseif ( is_year() ) : ?>
                                    <?php printf( __( 'Yearly Archives: <span>%s</span>', 'dronetv' ), get_the_date( _x( 'Y', 'yearly archives date format', 'dronetv' ) ) ); ?>
                    <?php else : ?>
                                    <?php _e('Blog','dronetv'); ?>
                    <?php endif; ?>
                    
                    <?php }else{ ?>
                    
						<?php if($theblogtitle=="") { echo _e('Blog','dronetv'); }else{ echo $theblogtitle; }  ?>
                    
					<?php } ?>
                </h3>
            </div>
            
            <div class="twelve columns omega">
            	<div class="navigate">
                	<hr class="resshow border-color" />
                    <div class="fullnav">
					<?php 
                        // GET CATEGORIES
                        $cats = get_categories(); 
                        $count_cats = count( $cats ); 
                        if ( $count_cats > 0 ) {
							
                       foreach ($cats as $catd) { 
                    ?>
                        <a href="<?php echo get_category_link( $catd->cat_ID ); ?>" class="activemenu-bg <?php if($catd->cat_ID==$cat) { echo 'selected'; } ?>" data-rel="<?php echo $catd->slug; ?>" title="<?php echo $catd->name; ?>"><?php echo strtoupper($catd->name); ?></a>
                    <?php } ?>
                    <?php	} ?>
                    </div>
                    <select class="responsiveselect reschangeblog border-color">
                    	<option value="all" selected=""><?php _e('Categories...','dronetv')?></option>
                        <?php		
                       foreach ($cats as $catd) { 
                    	?>
                        <option value="<?php echo get_category_link( $catd->cat_ID ); ?>" <?php if($catd->cat_ID==$cat) { echo 'selected'; } ?>><?php echo ($catd->name); ?></option>
                    	<?php } ?>
                    </select>
                    
            	</div>
            </div>	
        </div>
        

         	<div class="works-single hidden"></div>
            
			<br class="clear">
            
<div id="post-list" class="row blogpage fitvids">
	<div class="<?php if(!$dontshow_sidebar) { echo 'two-thirds column'; }else{ echo 'sixteen columns'; } ?>">
            <?php  while ( have_posts() ) : the_post(); ?>    
	
    <div <?php post_class('blogpost border-color'); ?>>
                   
                    <h3><a href="<?php the_permalink() ?>" data-type="blog" data-id="<?php echo $post->ID?>" data-token="<?php echo $token?>"><?php the_title(); ?></a></h3>
                    <div class="title border-color">
                      <?php if(of_get_option('md_post_show_category')) : ?>
					    <strong><?php _e('Category','dronetv'); ?> :</strong> <?php the_category(', '); ?> 
						<?php if(of_get_option('md_post_show_comments')) : ?>
			 · <a href="<?php comments_link(); ?>"><?php comments_number(__('No Comments', 'dronetv'), __('<strong>(1)</strong> Comment', 'dronetv'), __('<strong>(%)</strong> Comments', 'dronetv')); ?></a>
					  <?php endif; ?> 
                      <?php if(of_get_option('md_post_show_author')) { echo  ' · '; _e('by ', 'dronetv'); the_author_posts_link(); }?>
                        <span class="datetime">
                         <?php if(of_get_option('md_post_show_date')) { echo the_time( 'M jS, Y' ); } ?>
                        </span>
                      <?php  endif; ?>
                    </div>
                    <?php if(has_post_thumbnail()) { ?>										
		    			<a href="<?php the_permalink() ?>" data-type="blog" data-id="<?php echo $post->ID?>" data-token="<?php echo $token?>"><?php the_post_thumbnail('large', array('class' => 'postThumb', 'alt' => ''.get_the_title().'', 'title' => ''.get_the_title().'')); ?></a>		
				   
					  <?php the_excerpt(); ?>
                      
                       <?php }else{ ?>
                       
                         <?php the_content(''); ?>
                       
					   <?php } ?>	
                   	  <div class="bottom">
                     	<a href="<?php the_permalink() ?>" class="activemenu-bg readmore" data-type="blog" data-id="<?php echo $post->ID?>" data-token="<?php echo $token?>"><?php _e('Read More...','dronetv'); ?></a>
					  	
                        <span class="loop-tags">
                        <?php 
							$posttags = get_the_tags();
								if ($posttags) {
								  foreach($posttags as $tag) {
									echo '<a href="'.get_tag_link($tag->term_id).'" class="tags border-color">'.$tag->name . '</a>';
								  }
								}
						?>
                        </span>
					  </div>
                       
                   </div>
					
			<?php $p++; endwhile; ?>
		
                        <div class="navigation-bottom">
                            <?php previous_posts_link( __( '<span class="meta-nav">&larr;</span> Back', 'dronetv' ) ); ?>
                            <?php next_posts_link( __( 'Next <span class="meta-nav">&rarr;</span>', 'dronetv' ) ); ?>
                        </div>
    </div>


      <?php if(!$dontshow_sidebar) { ?>
        <div class="one-third column">
                    <?php get_template_part( 'sidebar', 'blog' ); ?>
        </div>
   	  <?php } ?>
</div>   
    