<?php
/*
Plugin Name: Zpětná kompatibilita Rajce embed s WP Rajče
Plugin URI: http://wordpress.org/plugins/rajce-embed/
Description: Zajistí pro plugin Embed rajce zpětnou kompatibilitu s pluginem WP Rajče, takže galerie vložené pomocí pseudo-shortcodu [rajce:...] budou zpracovány a zobrazeny.
Version: 1.5.1
Author: Honza Skypala
Author URI: http://www.honza.info/
License: WTFPL 2.0
*/

include_once(ABSPATH . 'wp-admin/includes/plugin.php');

class Rajce_embed_compatibility_with_wp_rajce {
  const version = "1.5.1";

  public function __construct() {
    register_activation_hook(__FILE__, array($this, 'activate'));
    if (is_admin()) {
      add_action('admin_init', array($this, 'admin_init'));
    } else {
      add_action('init', array($this, 'add_filter'));
    }
  }

  public function activate() {
    update_option('rajce_embed_compatib_wp_rajce_version', self::version); // store plug-in version, if we later need to provide specific actions during upgrade
  }

  public function add_filter() {
    if (is_plugin_inactive('rajce-embed/rajce-embed.php') || is_plugin_active('wp-rajce/wp-rajce.php') || is_plugin_active('wp-rajce.php') || !method_exists('Rajce_embed', 'handler'))
      return;
    
    add_filter('the_content', array($this, 'wp_rajce_gallery'));
  }
  
  public function wp_rajce_gallery($content) {
    // this is pretty dirty stuff, but copied from the original wp-rajce.php plugin; instead should use shortcodes API
    $rajce_regex = '/\[rajce:(.*?)]/i';
    if (preg_match($rajce_regex, $content, $match)) {
      $ex = explode(' ', $match[1]);
      $content = preg_replace($rajce_regex, Rajce_embed::handler(array(str_replace('album=','',trim($ex[0]))), str_replace('popisky=','',trim($ex[1])) == 'ano' ? array('captions' => 'on') : array()), $content);
    }
    return $content;
  }

  public function admin_init() {
    if (is_plugin_inactive('rajce-embed/rajce-embed.php'))
      add_action('admin_notices', array($this, 'rajce_embed_inactive'));
    if (is_plugin_active('wp-rajce/wp-rajce.php') || is_plugin_active('wp-rajce.php')) {
      add_action('admin_notices', array($this, 'wp_rajce_active'));
    }
  }
  
  public static function rajce_embed_inactive() {
    ?>
    <div class="error">
        <p><?php echo(sprintf(__('Plugin <em>Rajce embed</em> nen&iacute; aktivov&aacute;n, proto nem&#367;&#382;e plugin <em>Zpětná kompatibilita Rajce embed s WP Rajče</em> fungovat. <a href="%1$s">Aktivujte</a> pros&iacute;m plugin <em>Rajce embed</em>.', 'rajce_embed'), admin_url('plugins.php'))); ?></p>
    </div>
    <?php
  }

  public static function wp_rajce_active() {
    ?>
    <div class="error">
        <p><?php echo(sprintf(__('Plugin <em>Raj&#269;e WP</em> je aktivov&aacute;n, proto nem&#367;&#382;e plugin <em>Zpětná kompatibilita Rajce embed s WP Rajče</em> fungovat. <a href="%1$s">Deaktivujte</a> pros&iacutem plugin <em>Raj&#269;e WP</em>.', 'rajce_embed'), admin_url('plugins.php'))); ?></p>
    </div>
    <?php
  }
}

$wpRajce_embed_compatibility_with_wp_rajce = new Rajce_embed_compatibility_with_wp_rajce();
?>