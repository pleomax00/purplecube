<?php
  namespace WebsitePopups;
  defined('ABSPATH') or die("Invalid access!");

  class ActivationHandler {
    public function __construct($plugin_file)
    {
      /*************************
      * Register Activation Hook
      **************************/
      register_activation_hook( $plugin_file, array( $this, 'on_activate' ) );
      add_action( 'admin_init', array( $this, 'redirect_on_activation' ) );
    }

    public static function on_activate() {
      add_option(plugin_constant('ACTIVATION_REDIRECT_FLAG'), true);
    }

    public static function redirect_on_activation() {
      if ( get_option( plugin_constant('ACTIVATION_REDIRECT_FLAG'), false ) ) {
        $url = admin_url( "admin.php" )."?page=".plugin_constant("SLUG")."-website-popups";
        delete_option( plugin_constant('ACTIVATION_REDIRECT_FLAG') );
        exit( wp_redirect( $url ) );
      }
    }
  }
?>
