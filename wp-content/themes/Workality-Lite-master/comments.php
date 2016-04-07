  <div class="commentform">
<?php if ( post_password_required() ) : ?>
		<p class="nopassword"><?php _e( 'This post is password protected. In order to view any comments please enter the password.', 'dronetv' ); ?></p>
	</div>
<?php return; endif; ?>


<?php if ( have_comments() ) : ?>
	<h2 id="comments" class="border-color">
	  <?php comments_number( __( 'No Comments', 'dronetv' ), __( '(1) Comment', 'dronetv' ), _n( '(%) comment', '(%) comments', get_comments_number(), 'dronetv' ) ); ?>
    </h2>

	<div class="comment-list">
		<?php wp_list_comments( array( 'callback' => 'drone_comments' ) ); ?>
	</div>
	
	<div class="comments_nav">
    	<?php paginate_comments_links(); ?> 
    </div>
	
 <?php else : // if there is no comments or comments are closed ?>

	<?php if ( ! comments_open() ) : ?>
		
		<p class="nocomments"><?php _e( 'Comments are closed.', 'dronetv' ); ?></p>
        
	<?php endif; ?>
    
<?php endif; ?>


<?php if ( comments_open() ) : ?>
	<?php comment_form(); ?> 
<?php endif;  ?>
  </div>