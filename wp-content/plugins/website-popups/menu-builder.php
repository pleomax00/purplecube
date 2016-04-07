<?php
namespace WebsitePopups;
defined('ABSPATH') or die("Invalid access!");

class MenuBuilder
{
  public function __construct()
  {
    add_action( 'admin_menu', array( $this, 'create_menu_pages' ) );
  }

  /**
   * Returns an instance of this class. 
   */
  public static function get_instance() {
    if( null == self::$instance ) {
      self::$instance = new PageTemplater();
    }
    return self::$instance;
  }

  public function create_menu_pages()
  {
    add_menu_page(  
      __( 'Popups', plugin_constant("SLUG") ),          // The title to be displayed on the corresponding page for this menu  
      __( 'Popups', plugin_constant("SLUG") ),                  // The text to be displayed for this actual menu item  
      'administrator',            // Which type of users can see this menu  
      plugin_constant("SLUG") . '-website-popups',                  // The unique ID - that is, the slug - for this menu item  
      array( $this, 'display_dashboard' ),// The name of the function to call when rendering the menu for this page  
      plugins_url("assets/images/popups-icon.png", __FILE__),
      plugin_constant('MENU_INDEX')
    );
    add_submenu_page(
      plugin_constant("SLUG") . "-website-popups",
      __( "Dashboard", plugin_constant("SLUG") ),
      __( "Dashboard", plugin_constant("SLUG") ),
      "administrator",
      plugin_constant("SLUG") . "-website-popups",
      array( $this, 'display_dashboard' )
    );
    add_submenu_page(
      plugin_constant("SLUG") . "-website-popups",
      __( "Add New", plugin_constant("SLUG") ),
      __( "Add New", plugin_constant("SLUG") ),
      "administrator",
      plugin_constant("SLUG") . "-website-popups-create",
      array( $this, 'display_create_website_popup' )
    );
    add_submenu_page(
      plugin_constant("SLUG") . "-website-popups",
      __( "Settings", plugin_constant("SLUG") ),
      __( "Settings", plugin_constant("SLUG") ),
      "administrator",
      plugin_constant("SLUG") . "-website-popups-settings",
      array( $this, 'display_settings_page' )
    );
  }

  public function display_dashboard()
  {
    $wishpond_action  = preg_replace('/[^a-zA-Z]+/i', "", $_GET["wishpond-action"]);
    $wishpond_id      = preg_replace('/[^0-9]+/i', "", $_GET["wishpond-id"]);
    $wishpond_marketing_id  = preg_replace('/[^0-9]+/i', "", $_GET["wishpond-marketing-id"]);

    switch($wishpond_action)
    {
      case "edit": {
        $redirect_url = "/wizard/start?participation_type=landing_page&landing_page_type=popups&wizard=wizards%2Flanding_page&social_campaign_id=".$wishpond_id;
        break;
      }
      case "manage": {
        $redirect_url = "/central/marketing_campaigns/".$wishpond_marketing_id;
        break;
      }
      case "report": {
        $redirect_url = "/central/landing_pages/".$wishpond_id;
        break;
      }
      default: {
        $redirect_url = "/central/landing_pages";
        break;
      }
    }

    self::enqueue_scripts();
    $dashboard_page = new WishpondIframe($redirect_url);
    $dashboard_page->display_iframe(); 
  }

  public function display_create_website_popup()
  {
    self::enqueue_scripts();
    $dashboard_page = new WishpondIframe( "/wizard/start?landing_page_type=popups&participation_type=landing_page&wizard=wizards%2Flanding_page", self::query_info_from_post_id() );
    $dashboard_page->display_iframe();
  }

  function display_settings_page()
  {
    self::enqueue_scripts();

    $post_error = "";
    if( $_POST["submit"] )
    {
      if( !$_POST["enable_automatic_authentication"] )
      {
        Storage::delete(plugin_constant("MASTER_TOKEN"));
        Storage::delete(plugin_constant("AUTH_TOKEN"));
      }
      else if($_POST["enable_guest_signup"])
      {
        $post_error = "Please disable Automatic Authentication to use Guest Signups";
      }
      else
      {
        $post_error = "Automatic authentication is a deprecated feature and can't be re-enabled"; 
      }

      if( !$_POST["enable_automatic_authentication"] )
      {
        if( $_POST["enable_guest_signup"] )
        {
          Storage::enable_guest_signup();
          $notice = "Guest signup enabled!";
        }
        else
        {
          Storage::disable_guest_signup();
          $notice = "Guest signup disabled!";
        }
      }
    }
    include_once 'views/settings.php';
  }

  public function query_info_from_post_id()
  {
    $post_id = intval( $_GET["post_id"] );
    $excerpt = get_excerpt_by_id( $post_id );

    $query_info = array();

    if( is_int( $post_id ) && $post_id > 0 )
    {
      $query_info = array(
        "ad_campaign[ad_creative][title]"             => substr( get_the_title( $post_id ), 0, 25 ),
        "ad_campaign[ad_creative][body]"              => $excerpt,
        "ad_campaign[ad_creative][link_url]"          => esc_url( get_permalink( $post_id ) ),
        "ad_campaign[ad_creative][destination_type]"  => "external_destination"
      );
    }
    return $query_info;
  }

  public function enqueue_scripts()
  {
    wp_register_style(
      "website_popups_main_css",
      plugins_url("wishpond/assets/css/iframe.css", __FILE__)
    );

    wp_enqueue_style( "website_popups_main_css" );
    wp_enqueue_script( 'json2' );

    $plugin_scripts = array();
  }
  //------------------------------------------------
}

$menu_builder = new MenuBuilder();
?>