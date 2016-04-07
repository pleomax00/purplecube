<?php
  /*
    This file initializes all constants needed by this plugin
  */
  namespace WebsitePopups;
  defined('ABSPATH') or die("Invalid access!");

  /***************************************************
   * Common Constants - used in all wishpond plugins *
   ***************************************************
   * In the future we might want to create a common
   * framework to all wishpond plugins
   ****************************************************/
  set_wishpond_constant( "SITE_URL", 'http://www.wishpond.com' );
  set_wishpond_constant( "SECURE_SITE_URL", 'https://www.wishpond.com' );
  
  /***************************************************
   * Unique Constants - used only in this plugin *
   ***************************************************
   * These constants need to be namespaced properly
   * to avoid conflicts.
   ***************************************************/

  set_plugin_constant( "SLUG", 'wishpond-website-popups' );

  $wishpond_constants = array(
    'SIGNUP_URL'       => wishpond_constant("SECURE_SITE_URL") . "/central/merchant_signups/new/",
    'GUEST_SIGNUP_URL' => wishpond_constant("SECURE_SITE_URL") . "/central/merchant_signups/new/",
    'LOGIN_URL'        => wishpond_constant("SECURE_SITE_URL") . "/login",
  );

  $plugin_constants = array(
    'PLUGIN_NAME' => "Website Popups",
    'GET_AUTH_TOKEN_URL'   => wishpond_constant("SECURE_SITE_URL") . '/central/sessions/get_wordpress_auth_token',
    'AUTH_WITH_TOKEN_URL'  => wishpond_constant("SECURE_SITE_URL") . "/central/sessions/auth_with_wordpress",

    'ADMIN_EMAIL'   => plugin_constant("SLUG") . "-admin-email",
    'FIRST_VISIT'   => plugin_constant("SLUG") . "-first-visit",
    'DISABLE_GUEST_SIGNUP_OPTION' => plugin_constant("SLUG") . "-guest-signup",

    // token-based authentication
    'MASTER_TOKEN'       => plugin_constant("SLUG") . '_master_token',
    'AUTH_TOKEN'         => plugin_constant("SLUG") . '_auth_token',
    'AUTH_TOKEN_EXPIRY'  => plugin_constant("SLUG") . '_auth_token_expiry',
    'AUTH_TOKEN_TTL'     => 300,

    // Activation hook name
    'ACTIVATION_REDIRECT_FLAG'  => plugin_constant("SLUG") . '_do_activation_redirect',
    'MENU_INDEX' => '59.39647'
  );

  foreach( $wishpond_constants as $name => $value) {
    set_wishpond_constant( $name, $value );
  }

  foreach( $plugin_constants as $name => $value) {
    set_plugin_constant( $name, $value );
  }
?>
