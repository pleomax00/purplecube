<?php
  namespace WebsitePopups;
  defined('ABSPATH') or die("Invalid access!");

  /**
   * Plugin Name: Website Popups
   * Plugin URI: http://corp.wishpond.com/website-popups/
   * Description: Create your amazing Website Popup from your wordpress site and host them anywhere. Run A/B tests, monitor analytics, improve conversion rates and much more.
   * Version: 1.0.0
   * Author: atajsekandar, catanasiu
   * Text Domain: website-popups
   * Author URI: http://corp.wishpond.com
   * License: GNU General Public License version 2.0 (GPL-2.0)
   */

  /*  Copyright 2014 Wishpond  ( email : support@wishpond.com )

      This program is free software; you can redistribute it and/or modify
      it under the terms of the GNU General Public License, version 2, as 
      published by the Free Software Foundation.

      This program is distributed in the hope that it will be useful,
      but WITHOUT ANY WARRANTY; without even the implied warranty of
      MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
      GNU General Public License for more details.

      You should have received a copy of the GNU General Public License
      along with this program; if not, write to the Free Software
      Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
  */

  if ( ! defined( 'WISHPOND_WEBSITE_POPUPS_PREFIX' ) ) {
    define( 'WISHPOND_WEBSITE_POPUPS_PREFIX' , 'WISHPOND_WEBSITE_POPUPS' );
  }
  if ( ! defined( 'WISHPOND_PREFIX' ) ) {
    define( 'WISHPOND_PREFIX' , 'WISHPOND' );
  }

  /*
  * List & Load plugin files
  */
  $PLUGIN_FILES = array(
    // load up core functions
    "wishpond/core/functions.php",

    // grab all the libraries
    "wishpond/lib/storage.php",
    "wishpond/lib/wishpond-iframe.php",
    "wishpond/lib/post-metadata.php",
    "wishpond/lib/wishpond-url.php",
    "wishpond/lib/wishpond-key.php",

    //  then get helpers
    "wishpond/helpers/strings-helper.php",
    "wishpond/helpers/posts-helper.php",
    "wishpond/helpers/authentication-helper.php",

    // then all config files (which happen to use some of the helpers)
    "wishpond/config/constants.php",
    "wishpond/config/activation-handler.php",
    "wishpond/config/shortcodes.php",

    "menu-builder.php"
  );

  foreach( $PLUGIN_FILES as $file )
  {
    load_wishpond_file( $file );
  }

  function load_wishpond_file( $file )
  {
    include_once plugin_dir_path( __FILE__ ) . $file;
  }

  $activationHandler = new ActivationHandler(__FILE__);
?>