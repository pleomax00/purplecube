<?php 
	if(have_posts()) the_post(); 
	
	//$prev_post = get_next_post();
	//$next_post = get_previous_post();
	
	$prev_post = getNextBack('prev','post',$post->menu_order,$post->post_date);
	$next_post = getNextBack('next','post',$post->menu_order,$post->post_date);
	
// SHOW SIDEBAR WHETHER OR NOT
$dontshow_sidebar_single = of_get_option('md_posts_sidebar_single');
$theblogtitle = of_get_option('md_theblog_title');

?>
<div id="singlecontent">

<br class="clear">
      
         <div class="columns navibg withall border-color">
            <div class="four columns alpha">
            	<h3><?php _e('Blog','dronetv'); ?></h3>
            </div>
            
           <div class="twelve columns omega">
            	<div class="navigate_blog">
                	<hr class="resshow border-color" /> 
                    <span class="pname"></span>
                    <?php if(!empty( $prev_post['ID'])) { ?>
                    <a href="<?php echo get_permalink($prev_post['ID']); ?>" data-type="blog" data-token="<?php echo $token?>" data-id="<?php echo $prev_post['ID']?>" title="<?php echo htmlspecialchars($prev_post['post_title'])?>" class="navigate back getworks-showmsg">&nbsp;</a>
                    <?php } ?>
                    <?php if(!empty( $next_post['ID'] )) { ?>
                    <a href="<?php echo get_permalink($next_post['ID']); ?>" data-type="blog" data-token="<?php echo $token?>" data-id="<?php echo $next_post['ID']?>" title="<?php echo htmlspecialchars($next_post['post_title'])?>" class="navigate next getworks-showmsg">&nbsp;</a>
					<?php } ?>
            	</div>
            </div>	
        </div>
        
<br class="clear">

<div class="row blogpage fitvids">
	<div class="<?php if(!$dontshow_sidebar_single) { echo 'two-thirds column'; }else{ echo 'sixteen columns'; } ?>">
                   <div <?php post_class('blogpost blogpost_single border-color showajaxcontent'); ?>>
                   
                    <h3><a href="<?php the_permalink() ?>" rel="bookmark" ><?php the_title(); ?></a></h3>
                    <div class="title border-color">
                      <?php if(of_get_option('md_post_show_category')) : ?>
					    <strong><?php _e('Category','dronetv'); ?> :</strong> <?php the_category(', '); ?> 
					  	<?php if(of_get_option('md_post_show_author')) { echo  ' · '; _e('by ', 'dronetv'); the_author_posts_link(); }?>
                      
                        <span class="datetime">
                          <?php if(of_get_option('md_post_show_date')) { echo the_time( 'M jS, Y' ); } ?>
                        </span>
                      <?php  endif; ?>
                    </div>
                      <div class="thecontent">	
							<?php the_content(); ?>
                   	  </div>
                      <div class="bottom">
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
		
                    <div class="sharingbottom"> 
                    	<div class="resdontshow shr"><strong><?php _e('SHARE : ','dronetv');?></strong></div>
						<?php
							$pimg = getThumb('large');
							$ptitle = get_the_title();
							$permalink = get_permalink();
                            echo showshareingpost($permalink,$pimg[0], $ptitle,false); 
                        ?>
                    </div>
                    
                    <br class="clear" />
                    
					<?php if(comments_open()) { comments_template(); } ?>
                       
    </div>

        <?php if(!$dontshow_sidebar_single) { ?>
            <div class="one-third column">
                 <?php get_template_part( 'sidebar', 'blog' ); ?>
            </div>
   		<?php } ?>
    </div>   
        
</div>  