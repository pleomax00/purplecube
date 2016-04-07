   <div class="widget_wrapper border-color">
                    <?php if ( is_active_sidebar( 'blog-right' ) ) : ?>
                        <?php dynamic_sidebar( 'blog-right' ); ?>
                    <?php else : ?>
                        <div><h4><strong>Blog Sidebar</strong></h4>
                       <p><?php printf ( __( 'In order to use this area go to Appearance &raquo; Widgets tab in admin panel and select widget you want to use. <br><br>If you don\'t want to use widgets and use this page as full width you can disable blog widgets options under the Appearance &raquo; Theme Options &raquo; Posts menu.', 'dronetv' ) ); ?></p>
                       </div>
                    <?php endif; ?>
   </div>
                