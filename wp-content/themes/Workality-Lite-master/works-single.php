<?php 

	if(have_posts()) { 
		the_post(); 
	}elseif(wp_verify_nonce( $_REQUEST['token'], "wp_token" )) { 
		$post = get_post( $_REQUEST['id'] );
		setup_postdata($post);
	}	
	
	// AJAX TOKEN
	$token = wp_create_nonce("wp_token");
	
	
	$prev_post = getNextBack('prev','works',$post->menu_order,$post->post_date);
	$next_post = getNextBack('next','works',$post->menu_order,$post->post_date);

		?>	
        
<div id="singlecontent">

		<div class="columns navibg border-color">
            <div class="four columns alpha">
            	<h3><?php _e('Works','dronetv'); ?></h3>
            </div>
            
            <div class="twelve columns omega">
            	<div class="navigate">
                	<hr class="resshow border-color" /> 
                    <span class="pname"></span>
                    <a href="<?php echo get_home_url(); ?>" data-title="All" title="<?php echo __("All Projects","dronetv");?>" data-type="works" data-token="<?php echo $token?>" class="navigate parent getworks-showmsg gohome">&nbsp;</a>
                    <?php if(!empty( $prev_post['ID'] )) { ?>
                    <a href="<?php echo get_permalink($prev_post['ID']); ?>" data-type="works" data-token="<?php echo $token?>" data-id="<?php echo $prev_post['ID']?>" title="<?php echo htmlspecialchars($prev_post['post_title'])?>" class="navigate back getworks-nextback getworks-showmsg">&nbsp;</a>
                    <?php } ?>
                    <?php if(!empty( $next_post['ID'] )) { ?>
                    <a href="<?php echo get_permalink($next_post['ID']); ?>" data-type="works" data-token="<?php echo $token?>" data-id="<?php echo $next_post['ID']?>" title="<?php echo htmlspecialchars($next_post['post_title'])?>" class="navigate next getworks-nextback getworks-showmsg">&nbsp;</a>
					<?php } ?>
            	</div>
            </div>	
        </div>
  
	<?php
    
        $permalink = get_permalink( $post->ID );
        $work_media = unserialize(get_post_meta( $post->ID, 'work-media', true ));
        $work_client = get_post_meta( $post->ID, 'work-client', true );
        $work_url = get_post_meta( $post->ID, 'work-url', true );
        $work_date = date('M jS, Y',strtotime(get_post_meta( $post->ID, 'work-date', true )));
        $terms = get_the_terms( $post->ID , 'works-categories', 'string' );
		$descpos = get_post_meta( $post->ID , 'work-desc-position', true );
		 
        
        if ( $terms && ! is_wp_error( $terms ) ) {
        $draught_links = array();
        foreach ( $terms as $term ) {
            $draught_links[] = '<a href="'.esc_attr(get_term_link( $term, 'works-categories' )).'">'.$term->name.'</a>';
        }
        $categories = join( ", ", $draught_links );
        }
        
    ?>      
       <div class="postwraps sixteen columns showajaxcontent border-color">
                      <div class="fifteensp columns offset-by-half alpha">
                           <h2 class="titles" style="text-shadow:none!important;"><a href="<?php echo $permalink ?>" style="text-shadow:none!important;"><?php the_title(); ?></a></h2>
                           <hr />
                      </div>  
                      <div class="fifteensp columns offset-by-half alpha pinfo">
                           <div class="four columns alpha">
                           		<?php if($categories!="") {?>
                                <strong><?php _e('Creative Fields','dronetv')?></strong> <br />
                                <?php echo $categories; ?>  
                                <?php } ?>
                          </div> 
                          <div class="four columns">
                           		<?php if($work_client!="") {?>
                                <strong><?php _e('Client','dronetv')?></strong> <br />
                                <?php echo $work_client; ?>
                                <?php } ?>
                          </div> 
                           <div class="four columns">
                           		<?php if($work_url!="") {?>
                                <strong><?php _e('Project URL','dronetv')?></strong> <br />
                                <a href="<?php echo $work_url; ?>" target="_blank"><?php 
								$work_url = str_replace('http://','',$work_url);
								if(strlen($work_url) > 30) {
								echo substr($work_url,0,30)."..."; 
								}else{
								echo $work_url;	
								}
								?></a>  
                          		<?php } ?>
                          </div>
                           <div class="three columns omega">
                           		<?php if(get_post_meta( $post->ID, 'work-date', true )) {?>
                                <strong><?php _e('Completion Date','dronetv')?></strong><br />
                                <?php echo $work_date; ?> 
                                <?php } ?>  
                          </div>
            			  <br class="clear" />
                          <hr />
                      </div>
                      
                      <?php 
					  	  $sharittop = of_get_option('md_social_post_disable_top');
						 if(!$sharittop) { $coln = 'twelve'; }else{ $coln = 'fifteen'; }
						  
						  $workdesc = '<br class="clear" /><div class="fifteensp columns offset-by-half alpha fitvids">';
						  
						  if(!$sharittop) {
						  	$workdesc .=  '<div class="'.$coln.' columns alpha">';
						  }
						  $workdesc .= apply_filters('the_content', $post->post_content);
						  
						  if(!$sharittop) {
						  	$workdesc .= '&nbsp;</div>';
						  }
						 
						 if(!$sharittop) {
							$workdesc .= '<div class="three columns resdontshow omega sharing">';
				   			$workdesc .= '<div class="sharingbottom border-color tops">
											<strong>'.__('SHARE','dronetv').'</strong>
											<br class="clear" />
											<div class="buttons">';
							
							$pimg = getThumb('large');
							$ptitle = get_the_title();
							$workdesc .= showshareingpost($permalink,@$pimg[0], @$ptitle,false,1); 
								
							$workdesc .= '</div></div></div>';
						 } 
                        $workdesc .='</div>';
					  ?>
              	
                      <?php 
					  	  /// SHOW PROJECT DESCRIPTION
						  if($descpos=='top') {
							echo $workdesc;  
						  }
					  ?>
                      
              <br class="clear" />
              
              <div class="postcontent fitvids">
              		<?php 
						$s1=0;
						$s2=0;
						$mediacaption = unserialize(get_post_meta( $post->ID, 'work-media-caption', true ));
						$mediavideo = unserialize(get_post_meta( $post->ID, 'work-media-video', true ));
						if(is_array($work_media)) {
						foreach($work_media as $v) {
							if($v=='videoembed') {
							echo '<div class="contentvideos fifteen columns offset-by-half alpha">'.stripslashes($mediavideo[$s1]).'</div>';
							$s1++;
							}else{
							echo '<div class="contentimages fifteen columns offset-by-half alpha">';
							echo '<img src="'.stripslashes($v).'" />';
								if($mediacaption[$s2]!="") {
									echo '<div class="caption">'.stripslashes($mediacaption[$s2]).'</div>';
								}
							echo '</div>';
							$s2++;	
							}
							echo '<div class="fifteen columns offset-by-half alpha resdontshow"><hr></div>';
						}
						}
					?>
                    <br class="clear" />
		 	</div>     
            
             		<?php 
						  /// SHOW PROJECT DESCRIPTION
						  if($descpos=='bottom') {
							echo $workdesc;  
							echo '<div class="fifteen columns offset-by-half alpha resdontshow"><hr></div>';
						  }
					?> 
            
           
                <div class="fifteensp columns offset-by-half alpha" style="margin-bottom:10px;">
                    <div class="sharingbottom border-color bottoms"> 
                  	<?php if(!of_get_option('md_social_post_disable_bottom')) {?>
                    	<div class="resdontshow shr"><strong><?php _e('SHARE : ','dronetv');?></strong></div>
                       <?php echo showshareingpost($permalink,@$pimg[0], @$ptitle,false); ?>
					<?php } ?>
                    &nbsp;
                    </div>
                        <hr class="resshow border-color-works" /> 
                    <div class="navigate pull-right">
                        <span class="pname"></span> 
                    <a href="<?php echo get_home_url(); ?>" data-title="All" title="<?php echo __("All Projects","dronetv");?>" data-type="works" data-token="<?php echo $token?>" class="navigate parent getworks-showmsg gohome">&nbsp;</a>
                    <?php if(!empty( $prev_post['ID'] )) { ?>
                    <a href="<?php echo get_permalink($prev_post['ID']); ?>" data-type="works" data-token="<?php echo $token?>" data-id="<?php echo $prev_post['ID']?>" title="<?php echo htmlspecialchars($prev_post['post_title'])?>" class="navigate back getworks-nextback getworks-showmsg">&nbsp;</a>
                    <?php } ?>
                    <?php if(!empty( $next_post['ID'] )) { ?>
                    <a href="<?php echo get_permalink($next_post['ID']); ?>" data-type="works" data-token="<?php echo $token?>" data-id="<?php echo $next_post['ID']?>" title="<?php echo htmlspecialchars($next_post['post_title'])?>" class="navigate next getworks-nextback getworks-showmsg">&nbsp;</a>
					<?php } ?>
                    </div>
                </div>
                        <br class="clear" />
                        <br class="clear" />
           
		 </div>     
  </div> 
                        
