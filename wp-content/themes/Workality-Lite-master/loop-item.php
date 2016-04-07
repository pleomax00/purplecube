	<?php while ( have_posts() ) : the_post(); ?>
        
			 <?php 
				$ptype = get_post_type();
				if($ptype=="post")  { 
					$ptype_echo = __('Blog','dronetv');
				}elseif($ptype=="works")  { 
					$ptype_echo = __('Project','dronetv');
					$thumb = getThumb('mini');
				}else{
					$ptype_echo = __('Page','dronetv');
				}
				?>
            <div class="search-item border-color">
            	<?php if(has_post_thumbnail() && $ptype=="post") : ?>										
		    	    <a href="<?php the_permalink() ?>" class="img" title=""><?php the_post_thumbnail('thumbnail', array('class'=>'border-color','alt' => ''.get_the_title().'', 'title' => ''.get_the_title().'')); ?></a>		
				<?php endif; ?>	
                <?php 
				if(isset($thumb[0])) :
					if($ptype=="works") : ?>										
		    	    <a href="<?php the_permalink() ?>" class="img" title=""><img src="<?php echo $thumb[0];?>" class="border-color" title="<?php echo get_the_title()?>" alt="<?php echo get_the_title()?>" /></a>		
				<?php endif; 
				endif;
				?>	
                        
				<h2 class="post-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
             
				<?php the_excerpt(); ?> 
                
                <a class="ptype border-color">
               	<?php echo $ptype_echo; ?>
                </a>
                <a href="<?php the_permalink(); ?>" class="activemenu-bg readmore"><?php _e('Read More','dronetv') ?></a>
			</div>
		<?php endwhile; ?>