<?php global $options;
			foreach ($options as $value) {
    			if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); }
			}
		?>
<header>
	<nav class="navbar navbar-inverse navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container">
				<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<div id="mini-logo">
					<a href="#page-1" id="mini-link">
						<img src="<?php echo $fw_logo_mini; ?>" alt="<?php bloginfo('name') ?>"/>
					</a>
				</div>
				<div class="nav-collapse collapse">
					<ul class="nav top-nav" id="nav-menu">
						<?php wp_nav_menu( array( 'theme_location' => 'primary','items_wrap' => '%3$s','container' => '' ) ); ?>
				   </ul>
				</div>
			</div>
		</div>
	</nav>
</header>
