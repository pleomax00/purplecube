<?php
  /*
    Functions used by the plugin core.
  */

  namespace WebsitePopups;
  defined('ABSPATH') or die("Invalid access!");

  function set_constant( $name, $value ) {
    if ( ! defined( $name ) ) {
      define( $name , $value );
    }
  }

  function set_plugin_constant( $name, $value ) {
    $constant_name = WISHPOND_WEBSITE_POPUPS_PREFIX . "_" . strtoupper($name);
    set_constant( $constant_name, $value );
  }

  function plugin_constant( $name ) {
    return constant( WISHPOND_WEBSITE_POPUPS_PREFIX . "_" . strtoupper($name) );
  }

  function set_wishpond_constant( $name, $value ) {
    $constant_name = WISHPOND_PREFIX . "_" . strtoupper($name);
    set_constant( $constant_name, $value );
  }

  function wishpond_constant( $name) {
    return constant( WISHPOND_PREFIX . "_" . strtoupper($name) ); 
  }
?>
