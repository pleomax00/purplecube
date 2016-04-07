<?php

// SETTINGS PAGE SHELL
function testimonial_rotator_settings_callback()
{
?>
	<div class="wrap">
	    <h2><?php _e('Testimonial Rotator Settings', 'testimonial_rotator'); ?></h2>

		<?php settings_errors( 'testimonial-rotator-error-handling' ); ?>

	    <form action="options.php" method="POST">
	        <?php settings_fields( 'testimonial_rotator_group' ); ?>
	        <?php do_settings_sections( 'testimonial_rotator' ); ?>
	        <?php submit_button(); ?>
	    </form>
	</div>
<?php
}


function testimonial_rotator_settings_init()
{
	register_setting( 'testimonial_rotator_group', 'testimonial-rotator-error-handling', 'testimonial_rotator_settings_sanitize' );
	register_setting( 'testimonial_rotator_group', 'testimonial-rotator-creator-role' );
	register_setting( 'testimonial_rotator_group', 'testimonial-rotator-hide-fontawesome' );
	
	add_settings_section( 'testimonial_rotator', '', 'testimonial_rotator_empty_function', 'testimonial_rotator' );
	add_settings_field( 'testimonial-rotator-error-handling', __('Error Handling', 'testimonial_rotator'), 'testimonial_rotator_error_handling_callback', 'testimonial_rotator', 'testimonial_rotator' );
	add_settings_field( 'testimonial-rotator-creator-role', __('Who Sees Rotator Menu?', 'testimonial_rotator'), 'testimonial_rotator_creator_role_callback', 'testimonial_rotator', 'testimonial_rotator' );
	add_settings_field( 'testimonial-rotator-hide-fontawesome', __('Hide Font Awesome?', 'testimonial_rotator'), 'testimonial_rotator_fontawesome_callback', 'testimonial_rotator', 'testimonial_rotator' );
}

function testimonial_rotator_empty_function() { return ''; }

function testimonial_rotator_settings_sanitize( $data = array() )
{
	add_settings_error( 'testimonial-rotator-error-handling', '', __( 'Settings Updated', 'testimonial_rotator' ), 'updated' );
	return $data;
}

function testimonial_rotator_error_handling_callback()
{
	$setting = esc_attr( get_option( 'testimonial-rotator-error-handling' ) );
	if(!$setting) $setting = "source";
	
	echo "<input type='radio' name='testimonial-rotator-error-handling' value='source' " . checked( $setting, 'source', false ) . " /> " . __('Hidden in Source', 'testimonial_rotator') . " &nbsp; &nbsp; ";
	echo "<input type='radio' name='testimonial-rotator-error-handling' value='display-admin' " . checked( $setting, 'display-admin', false ) . " /> " . __('Display if Admin', 'testimonial_rotator') . " &nbsp; &nbsp; ";
	echo "<input type='radio' name='testimonial-rotator-error-handling' value='display-all' " . checked( $setting, 'display-all', false ) . " /> " . __('Display for Anyone', 'testimonial_rotator') . " &nbsp; &nbsp; ";
	
	echo "<p>";
	echo __("What should the plugin do when there is an error?", 'testimonial-rotator');
	echo "</p>";
}

function testimonial_rotator_creator_role_callback()
{
	$setting = (array) get_option( 'testimonial-rotator-creator-role' );

	foreach (get_editable_roles() as $role_name => $role_info)
	{
		if( $role_name == "administrator") continue;
		$checkd = "";
		if( in_array( $role_name, $setting ) ) $checkd = " checked='checked' ";

		echo "<div style='padding: 0 10px 10px 0; float: left; '><input type='checkbox' name='testimonial-rotator-creator-role[]' value='{$role_name}' {$checkd} /> " . $role_name . "</div>";
	}
	
	echo "<p style='clear: both;'>";
	echo __("Select the roles that will be able to see the Rotator List View and 'Add New' Button in the admin menu.", 'testimonial-rotator');
	echo "</p>";
}

function testimonial_rotator_fontawesome_callback()
{
	$setting = get_option( 'testimonial-rotator-hide-fontawesome' );
	?>
	<input type="checkbox" name="testimonial-rotator-hide-fontawesome" value="1" <?php if($setting) echo "checked='checked'"; ?> />
	
	<?php
	echo "<p>";
	echo __("Already loading Font Awesome with your theme or another plugin? You can turn off our version here.", 'testimonial-rotator');
	echo "</p>";
}
