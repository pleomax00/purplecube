   <div class="widget_wrapper border-color">
                    <?php if ( is_active_sidebar( 'page-right' ) ) : ?>
                        <?php dynamic_sidebar( 'page-right' ); ?>
                    <?php else : ?>
                        <div><h4><strong>Page Sidebar</strong></h4>
                       <p><?php printf ( __( 'In order to use this area go to Appearance &raquo; Widgets tab in admin panel and select widget you want to use. <br><br>If you don\'t want to use widgets and use this page as full width, you should edit this page and select "Full Width" page template from "Page Attributes" section', 'dronetv' ) ); ?></p>
                       </div>
                    <?php endif; ?>
   </div>
                