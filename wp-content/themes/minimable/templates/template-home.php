<?php
/**
 * Template Name: Template Home 
 * 
 */?>
<section id="<?php if (get_post_meta($post->ID, 'fw_page_link_alternative', true)) { echo get_post_meta($post->ID, 'fw_page_link_alternative', true); } else { echo the_fw_title(); } ?>" class="section-page <?php echo the_slug(); ?>">
	<div class="container">
		<div class="row" id="home-header">
			<div id="logo" class="span4">
				<img src="<?php echo $fw_logo; ?>" alt="<?php bloginfo('name') ?>" height="45" />
			</div>
			<h2 class="span8 right" id="mini-slogan"><?php bloginfo( 'description' ); ?></h2>
		</div>
	  <?php 
			if 	(get_post_meta($post->ID, 'fw_big_one', true) && 
				 get_post_meta($post->ID, 'fw_big_two', true) && 
				 get_post_meta($post->ID, 'fw_big_three', true))
			{ 
		?>
		<div class="row three-big" id="slogan">
   		<h1 id="first-title" class="big-title"><?php $first_title = get_post_meta($post->ID, 'fw_big_one', true); echo do_shortcode( $first_title );?></h1>
   		<h1 id="second-title" class="big-title"><?php $second_title = get_post_meta($post->ID, 'fw_big_two', true); echo do_shortcode( $second_title );?></h1>
   		<h1 id="third-title" class="big-title"><?php $third_title =  get_post_meta($post->ID, 'fw_big_three', true); echo do_shortcode( $third_title );?></h1>
   	</div>
   	<?php } 
   	else if (get_post_meta($post->ID, 'fw_big_one', true) && 
			 get_post_meta($post->ID, 'fw_big_two', true)) 
		{ 
 		?>
   	<div class="row two-big" id="slogan">
   		<h1 id="first-title" class="big-title"><?php $first_title = get_post_meta($post->ID, 'fw_big_one', true); echo do_shortcode( $first_title );?></h1>
   		<h1 id="second-title" class="big-title"><?php $second_title = get_post_meta($post->ID, 'fw_big_two', true); echo do_shortcode( $second_title );?></h1>
   	</div>
   	<?php  } else if (get_post_meta($post->ID, 'fw_big_one', true)) { ?>
   	<div class="row one-big" id="slogan">
   		<h1 id="first-title" class="big-title"><?php $first_title = get_post_meta($post->ID, 'fw_big_one', true); echo do_shortcode( $first_title );?></h1>
 		</div>
   	<?php } ?>
	   	
   	<div class="row">
   		<nav class="<?php if (get_post_meta($post->ID, 'fw_label_six', true)) { ?>offset0 <?php } else if (get_post_meta($post->ID, 'fw_label_five', true)) { ?> offset1 <?php } else if (get_post_meta($post->ID, 'fw_label_four', true)) { ?> offset2 <?php } else {?>offset3 <?php } ?> span12" id="nav-home">
	   		<ul class="row">
	   			<li class="span2">
	   				<a class="circle-menu circle-black" href="<?php echo get_post_meta($post->ID, 'fw_bubble_link_one', true);?>"><span class="label-link"><?php echo get_post_meta($post->ID, 'fw_label_one', true);?></span></a>
	   				<span class="arrow"></span>
	   			</li>
	   			<li class="span2">
	   				<a class="circle-menu" href="<?php echo get_post_meta($post->ID, 'fw_bubble_link_two', true);?>"><span class="label-link"><?php echo get_post_meta($post->ID, 'fw_label_two', true);?></span></a>
	   				<span class="arrow"></span>
	   			</li>
	   			<li class="span2">
	   				<a class="circle-menu circle-black" href="<?php echo get_post_meta($post->ID, 'fw_bubble_link_three', true);?>"><span class="label-link"><?php echo get_post_meta($post->ID, 'fw_label_three', true);?></span></a>
	   				<span class="arrow"></span>
	   			</li>
	   			<?php if (get_post_meta($post->ID, 'fw_label_four', true)) { ?>
	   			<li class="span2">
	   				<a class="circle-menu" href="<?php echo get_post_meta($post->ID, 'fw_bubble_link_four', true);?>"><span class="label-link"><?php echo get_post_meta($post->ID, 'fw_label_four', true);?></span></a>
	   				<span class="arrow"></span>
	   			</li>
	   			<?php } ?>
	   			<?php if (get_post_meta($post->ID, 'fw_label_five', true)) { ?>
	   			<li class="span2">
	   				<a class="circle-menu circle-black" href="<?php echo get_post_meta($post->ID, 'fw_bubble_link_five', true);?>"><span class="label-link"><?php echo get_post_meta($post->ID, 'fw_label_five', true);?></span></a>
	   				<span class="arrow"></span>
	   			</li>
	   			<?php } ?>
	   			<?php if (get_post_meta($post->ID, 'fw_label_six', true)) { ?>
	   			<li class="span2">
	   				<a class="circle-menu" href="<?php echo get_post_meta($post->ID, 'fw_bubble_link_six', true);?>"><span class="label-link"><?php echo get_post_meta($post->ID, 'fw_label_six', true);?></span></a>
	   				<span class="arrow"></span>
	   			</li>
	   			<?php } ?>
	   		</ul>
   		</nav>
   	</div>
	</div>
</section>