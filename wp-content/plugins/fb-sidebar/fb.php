<?php
/**
* Plugin Name: FB
* Plugin URI: http://www.lukas.onecomp.net/
* Description: FB plugin sidebar
* Version: 1.0.0
* Author: Lukáš Linhart
* Author URI: http://www.lukas.onecomp.net/
* License: GPL2
*/

add_action( 'admin_menu', 'fb_add_admin_menu' );
add_action( 'admin_init', 'fb_settings_init' );


function fb_add_admin_menu(  ) { 

  add_options_page( 'FB', 'FB', 'manage_options', 'fb', 'fb_options_page' );

}


function fb_settings_init(  ) { 

  register_setting( 'pluginPage', 'fb_settings' );

  add_settings_section(
    'fb_pluginPage_section', 
    __( 'Settings', 'wordpress' ), 
    'fb_settings_section_callback', 
    'pluginPage'
  );

  add_settings_field( 
    'fb_text_field_0', 
    __( 'FB URL', 'wordpress' ), 
    'fb_text_field_0_render', 
    'pluginPage', 
    'fb_pluginPage_section' 
  );

  add_settings_field( 
    'fb_text_field_1', 
    __( 'Quote', 'wordpress' ), 
    'fb_text_field_1_render', 
    'pluginPage', 
    'fb_pluginPage_section' 
  );


}


function fb_text_field_0_render(  ) { 

  $options = get_option( 'fb_settings' );
  ?>
  <input type='text' name='fb_settings[fb_text_field_0]' value='<?php echo $options['fb_text_field_0']; ?>'>
  <?php

}


function fb_text_field_1_render(  ) { 

  $options = get_option( 'fb_settings' );
  ?>
  <input type='text' name='fb_settings[fb_text_field_1]' value='<?php echo $options['fb_text_field_1']; ?>'>
  <?php

}


function fb_settings_section_callback(  ) { 


}


function fb_options_page(  ) { 

  ?>
  <form action='options.php' method='post'>
    
    <h2>FB</h2>
    
    <?php
    settings_fields( 'pluginPage' );
    do_settings_sections( 'pluginPage' );
    submit_button();
    ?>
    
  </form>
  <?php

}




function fb_show(){
  include("user.php");
}
add_action('wp_footer', 'fb_show');

?>