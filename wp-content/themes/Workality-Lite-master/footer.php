	<?php 
		$footer_widgets_disabled = of_get_option( 'md_footer_widgets_disabled');
		$footer_widgets_columns = of_get_option( 'md_footer_widgets_columns');
		
		if($footer_widgets_columns==4) { 
			$columnclass = "four columns";
		}elseif($footer_widgets_columns==3) {
			$columnclass = "one-third column";
		}elseif($footer_widgets_columns==2) {
			$columnclass = "eight columns";
		}elseif($footer_widgets_columns==1) {
			$columnclass = "sixteen columns";
		}
	?>
        <br class="clear" />
        <footer>	
                <div class="sixteen columns">
                    <hr class="footer border-color" />
                    <span class="footertext">
					<?php echo $ftext = of_get_option('md_footer_text'); if($ftext!="") { echo '<br />'; }?> 
                    <small>
                    Powered by <a href="http://www.wordpress.org" target="_blank">Wordpress</a>. <a href="http://www.northeme.com/themes/workality-lite" target="_blank">Workality Theme</a> by <a href="http://www.northeme.com" target="_blank">Northeme</a>
                    </small>
                    </span>
                    <hr class="resshow border-color" />
                    <span class="social"><?php showSharing(); ?></span>
                    
                    <hr class="footer border-color" />
                    <?php 
						if($footer_widgets_disabled!=1) {	
					?>
                    	<?php 
                        	for($i=1;$i <= $footer_widgets_columns; $i++) {
                        ?>
                            <div class="<?php echo $columnclass; if($i==1) echo ' alpha'; if($i==$footer_widgets_columns) echo ' omega'; ?>">
								<?php if(is_active_sidebar( 'bottom-' . $i)) { ?>
                                    <?php dynamic_sidebar( 'bottom-'.$i ); ?>
                                <?php } ?>
                            </div>
                    	<?php } ?>
                        
					<?php } ?>
                </div>
                   <?php 
						if($footer_widgets_disabled!=1) {
					?>
                <br class="clear" />
                <div class="sixteen columns">
                    <hr class="border-color" />
                </div>
                	<?php } ?>   
        </footer>
        
    </div> 
    <div class="mobilemenu">
            <?php if(!of_get_option('md_header_disable_search')) : ?>
              <form>
            	<input type="text" class="medium" value=""><button type="submit"><i class='icon-search'></i></button>
              </form>
            <?php endif; ?>
            
             <?php wp_nav_menu(array(
                        'theme_location' => 'main_menu',
                        'container' => '',
                        'menu_class' => 'mob-nav',
                        'before' => '',
                        'fallback_cb' => ''
                    ));
			 ?>  
    </div>
    
    <a href="#" class="backtotop"></a>
	<div class="ajaxloader"><img src="<?php echo get_template_directory_uri();?>/images/loader.gif" /></div>
<?php 
// ADD ANALYTICS CODE
echo of_get_option('md_footer_googleanalytics');

// ADD SHARING SCRIPTS
echo showshareingpost('','','',1);
?>


<?php
  get_template_part( 'admin', 'custom' );
  wp_footer();
?>
</body>
</html>

