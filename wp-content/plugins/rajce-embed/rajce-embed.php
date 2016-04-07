<?php
/*
Plugin Name: Rajce embed
Plugin URI: http://wordpress.org/plugins/rajce-embed/
Description: Embeds photos and photo-albums stored on rajce.net as native WordPress galleries
Version: 1.5.1
Author: Honza Skypala
Author URI: http://www.honza.info/
License: WTFPL 2.0
*/

include_once(ABSPATH . 'wp-admin/includes/plugin.php');

class Rajce_embed {
  const version = "1.5.1";

  public function __construct() {
    register_activation_hook(__FILE__, array($this, 'activate'));
    if (is_admin())
      add_action('admin_init', array($this, 'admin_init'));
    add_action('wp_enqueue_scripts', array($this, 'enqueue_styles'));
    wp_embed_register_handler('rajce', '@http://(?!www\.).+\.rajce\.(idnes\.cz|net)/(?!\?)[\w\.\-_/~\[\]!$&()*+,]+(#([\w\.\-_/~\[\]!$&()*+,]*))?@i', array($this, 'handler'));
  }

  public function activate() {
    add_option('rajce_embed_image_captions', '');
    add_option('rajce_embed_gallery_captions', '');
    add_option('rajce_embed_thumbnail_size_w', 100);
    add_option('rajce_embed_thumbnail_size_h', 100);
    add_option('rajce_embed_thumbnail_crop', get_option("thumbnail_crop", 1));
    add_option('rajce_embed_omit_album_cover', '');
    add_option('rajce_embed_thumbnail_source', 'thumbnail');
    update_option('rajce_embed_version', self::version); // store plug-in version, if we later need to provide specific actions during upgrade
  }

  public function check_plugin_update() {
    $registered_version = get_option('rajce_embed_version', '0');
    if (version_compare($registered_version, self::version, '<')) {
      if (version_compare($registered_version, '1.5', '<')) {
        add_option('rajce_embed_thumbnail_source', 'thumbnail');
      }
      if (version_compare($registered_version, '1.3', '<')) {
        add_option('rajce_embed_thumbnail_size_w', 100);
        add_option('rajce_embed_thumbnail_size_h', 100);
        add_option('rajce_embed_thumbnail_crop', get_option("thumbnail_crop", 1));
      }
      update_option('rajce_embed_version', self::version);
    }
  }

  public function admin_init() {
    self::check_plugin_update();
    register_setting('media', 'rajce_embed_image_captions');
    register_setting('media', 'rajce_embed_gallery_captions');
    register_setting('media', 'rajce_embed_thumb_default');
    register_setting('media', 'rajce_embed_thumbnail_size_w');
    register_setting('media', 'rajce_embed_thumbnail_size_h');
    register_setting('media', 'rajce_embed_thumbnail_crop');
    register_setting('media', 'rajce_embed_thumbnail_source');
    register_setting('media', 'rajce_embed_omit_album_cover');
    add_settings_section('rajce_embed_section', __('Rajče.net embed', 'rajce_embed'), '', 'media');
    add_settings_field('rajce_embed_image_captions', __('Popisky obrázků', 'rajce_embed'), 'Rajce_embed::option', 'media', 'rajce_embed_section', array('option'=>"image_captions", 'description'=>"Zobrazovat popisky u obrázků vkládaných z rajce.net (rajce.idnes.cz)"));
    add_settings_field('rajce_embed_gallery_captions', __('Popisky galerií', 'rajce_embed'), 'Rajce_embed::option', 'media', 'rajce_embed_section', array('option'=>"gallery_captions", 'description'=>"Zobrazovat popisky u galerií vkládaných z rajce.net (rajce.idnes.cz)"));
    add_settings_field('rajce_embed_thumb_size', __('Thumbnail size'), 'Rajce_embed::option_thumb', 'media', 'rajce_embed_section');
    add_settings_field('rajce_embed_thumbnail_source', __('Zdroj náhledu', 'rajce_embed'), 'Rajce_embed::option_thumb_source', 'media', 'rajce_embed_section');
    add_settings_field('rajce_embed_omit_album_cover', __('Vynechat náhled alba', 'rajce_embed'), 'Rajce_embed::option', 'media', 'rajce_embed_section', array('option'=>"omit_album_cover", 'description'=>"Vynechávat ze zobrazovaných alb obrázek zvolený jako náhled alba"));
  }

  public static function option(array $args) {
    echo(
      '<input type="checkbox" name="rajce_embed_' . $args['option'] . '" id="rajce_embed_' . $args['option'] . '" ' . checked('on', get_option("rajce_embed_" . $args['option'], ''), false) . '" value="on" /> '
      . __($args['description'], 'rajce_embed')
     );
  }

  public static function option_thumb_source(array $args) {
    $thumb_source = get_option("rajce_embed_thumbnail_source", 'thumbnail');
    echo(
      '<input type="radio" name="rajce_embed_thumbnail_source" id="rajce_embed_thumbnail_source_thumb" value="thumbnail"' . ($thumb_source != 'image' ? ' checked' : '') . '>'
      . __('Náhled generovaný serverem rajce.net (nižší kvalita)', 'rajce_embed')
      . '<br />'
      . '<input type="radio" name="rajce_embed_thumbnail_source" id="rajce_embed_thumbnail_source_image" value="image"' . ($thumb_source == 'image' ? ' checked' : '') . '>'
      . __('Původní obrázek (stránka se návštěvníkovi déle načítá)', 'rajce_embed')
    );
  }
  
  public static function option_thumb(array $args) {
    $thumb_default = get_option("rajce_embed_thumb_default", 'yes');
    $thumb_size_w  = get_option("rajce_embed_thumbnail_size_w", '');
    $thumb_size_h  = get_option("rajce_embed_thumbnail_size_h", '');
    $thumb_crop    = get_option("rajce_embed_thumbnail_crop", 1);
    echo(
      '<input type="radio" name="rajce_embed_thumb_default" id="rajce_embed_thumb_default_yes" value="yes"' . ($thumb_default == 'yes' ? ' checked' : '') . '>'
      . __('Výchozí velikost, stejná jako pro nativní WordPress galerie; definováno nahoře na této stránce', 'rajce_embed')
      . '<br />'
      . '<input type="radio" name="rajce_embed_thumb_default" id="rajce_embed_thumb_default_no" value="no"' . ($thumb_default != 'yes' ? ' checked' : '') . '>'
      . __('Vlastní velikost', 'rajce_embed')
      . '<div id="rajce_embed_thumbnail_size"' . ($thumb_default == 'yes' ? ' style="display:none"' : '') . '>
          <label for="rajce_embed_thumbnail_size_w">' . __('Width') . '</label>
          <input name="rajce_embed_thumbnail_size_w" type="number" step="1" min="0" id="rajce_embed_thumbnail_size_w" value="' . $thumb_size_w . '" class="small-text">
          <label for="rajce_embed_thumbnail_size_h">' . __('Height') . '</label>
          <input name="rajce_embed_thumbnail_size_h" type="number" step="1" min="0" id="rajce_embed_thumbnail_size_h" value="' . $thumb_size_h . '" class="small-text"><br>
          <input name="rajce_embed_thumbnail_crop" type="checkbox" id="rajce_embed_thumbnail_crop" value="1"' . ($thumb_crop == "1" ? 'checked="checked"' : '') . '>
          <label for="rajce_embed_thumbnail_crop">' . __('Crop thumbnail to exact dimensions (normally thumbnails are proportional)') . '</label>
        </div>'
      . '<script>jQuery(document).ready(function($){$("#rajce_embed_thumb_default_yes").click(function(){$("#rajce_embed_thumbnail_size").slideUp()});$("#rajce_embed_thumb_default_no").click(function(){$("#rajce_embed_thumbnail_size").slideDown()});});</script>'
    );
  }

  private static function crop_thumbs() {
    $crop = get_option("thumbnail_crop", 1);
    $thumb_default = get_option("rajce_embed_thumb_default", 'yes');
    if ($thumb_default == 'no') {
      $crop = get_option("rajce_embed_thumbnail_crop", $crop);
    }
    return ($crop == 1);
  }

  static function enqueue_styles() {
    if (current_theme_supports('html5', 'gallery') && self::crop_thumbs()) {
      wp_enqueue_style('rajce-html5-gallery', plugins_url('css/html5-gallery.css', __FILE__));
    } else {
      wp_enqueue_style('rajce-dl-dt-gallery', plugins_url('css/dl-dt-gallery.css', __FILE__));
    }
    wp_register_style('rajce-mini-preview-css', plugins_url('css/mini-preview.css', __FILE__));
    wp_register_script('rajce-mini-preview-js', plugins_url('mini-preview.js', __FILE__));
    wp_enqueue_style('rajce-mini-preview-css');
    wp_enqueue_script('rajce-mini-preview-js');

    $theme = wp_get_theme();
    if (file_exists(__DIR__ . "/css/" . $theme->get_template() . ".css")) {
      wp_register_style('rajce_embed_theme', plugins_url("css/" . $theme->get_template() . ".css", __FILE__));
      wp_enqueue_style('rajce_embed_theme');
    }
    if ($theme->get_template() != $theme->get_stylesheet() && file_exists(__DIR__ . "/css/" . $theme->get_stylesheet() . ".css")) {
      wp_register_style('rajce_embed_child_theme', plugins_url("css/" . $theme->get_stylesheet() . ".css", __FILE__));
      wp_enqueue_style('rajce_embed_child_theme');
    }
  }

  private static $http_cache = array();
  private static function get_http($URL) {
    if (!isset($http_cache[$URL]))
      $http_cache[$URL] = wp_remote_fopen($URL);
    return $http_cache[$URL];
  }

  static function handler($matches, $attr, $url, $rawattr) {
    $embed = $matches[0]; // fall back to the matched URL, if something fails

    $html = Rajce_embed::get_http($matches[0]);
    if($html !== false) {
      $dom = new DOMDocument();
      libxml_use_internal_errors(true);
      if ($dom->loadHTML($html) !== false) {

        if (isset($matches[3]) && $matches[3] != "") {
          // we are embedding just one image
          $as = $dom->getElementsByTagName('a');
          foreach ($as as $a) {
            if (preg_match('/(^|\s)photoThumb($|\s)/', $a->getAttribute('class')) && substr($a->getAttribute('href'), -strlen($matches[3])) == $matches[3]) {
              list($width, $height) = Rajce_embed::image_size($dom, $matches[3]);
              $iwidth = $width;
              $iheight = $height;
              if ($iwidth > $attr["width"]) {
                $iwidth = $attr["width"];
                $iheight = floor($height / $width * $attr["width"]);
              }
              if ($iheight > $attr["height"]) {
                $iheight = $attr["height"];
                $iwidth = floor($width / $height * $attr["height"]);
              }

              $description = Rajce_embed::image_title($dom, $matches[3]);
              $caption = get_option('rajce_embed_image_captions', '') == 'on';
              if (in_array("caption", $attr)) {
                $caption = true;
              } else if (isset($attr["caption"])) {
                switch ($attr["caption"]) {
                case "on":
                  $caption = true;
                  break;
                case "off":
                  $caption = false;
                  break;
                case "name":
                  $caption = true;
                  $description = Rajce_embed::get_image_att($dom, $matches[3], "name");
                  break;
                case "desc":
                  $caption = true;
                  $description = Rajce_embed::get_image_att($dom, $matches[3], "desc");
                  break;
                default:
                  $caption = true;
                  $description = $attr["caption"];
                  break;
                }
              }
              $embed = "";
              if ($caption && $description) {
                $embed .= '<figure class="wp-caption">';
              }
              $embed .= sprintf('<a href="%1$s"><img src="%1$s" width="%2$d" height="%3$d" alt="%4$s" %5$s /></a>', $a->getAttribute('href'), $iwidth, $iheight, $description, $caption ? "" : 'title="' . $description . '"');
              if ($caption && $description) {
                $embed .= '<figcaption class="wp-caption-text">' . wptexturize($description) . '</figcaption></figure>';
              }
              break;
            }
          }

        } else {
          // we are embedding whole album
          $omit_album_cover = (get_option('rajce_embed_omit_album_cover', '') != '') || in_array('omitalbumcover', array_map('strtolower', $attr));
          $images = array();
          $as = $dom->getElementsByTagName('a');
          foreach ($as as $a) {
            if ($omit_album_cover && (strpos($a->getAttribute('class'), 'albumCoverThumb') !== false)) {
              // we do not include the album cover into the gallery, if the user has specified so
            } else if (strpos($a->getAttribute('class'), 'photoThumb') !== false) {
              $img_url = $a->getAttribute('href');
              $filename = substr($img_url, strrpos($img_url, '/') + 1);
              $images[$filename] = $img_url;
            }
          }
          if (count($images) > 0) {
            static $instance = 0;
            $instance++;

            list($images, $appendix) = apply_filters('rajce-gallery-images', array($images, ""), $matches[0], $attr);

            $embed = Rajce_embed::mini_preview($matches[0], $images, $attr, $instance);
            $embed .= Rajce_embed::full_gallery($matches[0], $images, $attr, $instance);
            $embed .= $appendix;
          }
        }
      }
      libxml_clear_errors();
    }

    return apply_filters('oembed_result', $embed, $url, '');
  }

  public static function full_gallery($album_URL, $images, $attr, $instance) {
    $embed = "";

    $html = Rajce_embed::get_http($album_URL);
    if($html !== false) {
      $dom = new DOMDocument();
      libxml_use_internal_errors(true);
      if ($dom->loadHTML($html) !== false) {
        $html5 = current_theme_supports('html5', 'gallery');
        $float = is_rtl() ? 'right' : 'left';

        extract(Rajce_embed::shortcode_atts($attr));

        $columns = intval($columns);
        $itemwidth = $columns > 0 ? floor(100/$columns) : 100;
        $size_class = sanitize_html_class($size);
        $selector = "gallery-rajce-{$instance}";

        list($itemtag, $captiontag, $icontag) = Rajce_embed::validate_gallery_tags($itemtag, $captiontag, $icontag);
        $embed .= Rajce_embed::prepend_html5_style();

        $gallery_style = $gallery_div = '';
        if ( apply_filters( 'use_default_gallery_style', ! $html5 ) ) {
          $gallery_style = "
            <style type='text/css'>
              #{$selector} {
                margin: auto;
              }
              #{$selector} .gallery-item {
                float: {$float};
                margin-top: 10px;
                text-align: center;
                width: {$itemwidth}%;
              }
              #{$selector} img {
                border: 2px solid #cfcfcf;
              }
              #{$selector} .gallery-caption {
                margin-left: 0;
              }
              /* see gallery_shortcode() in wp-includes/media.php */

            </style>\n\t\t";
        }

        $gallery_div = "<div id='$selector' class='gallery gallery-embed-rajce galleryid-{$id} gallery-columns-{$columns} gallery-size-{$size_class}'>";
        $embed .= apply_filters('gallery_style', $gallery_style . $gallery_div);

        $captions = get_option('rajce_embed_gallery_captions', '') == 'on';
        if (in_array("captions", $attr)) {
          $captions = true;
        } else if (isset($attr["captions"])) {
          switch ($attr["captions"]) {
          case "on":
          case "name":
          case "desc":
            $captions = true;
            break;
          case "off":
            $captions = false;
            break;
          }
        }

        $thumb_source = get_option("rajce_embed_thumbnail_source", 'thumbnail');
        $i = 0;
        foreach ($images as $filename => $img_url) {
          $thumb_url = $thumb_source == 'image' ? $img_url : str_replace('/images/', '/thumb/', $img_url);
          list($target_width, $target_height, $orientation) = Rajce_embed::get_thumb_size($dom, $filename);

          $description = Rajce_embed::image_title($dom, $filename);
          if ($captions) {
            if (isset($attr["captions"])) {
              switch ($attr["captions"]) {
              case "name":
                $description = Rajce_embed::get_image_att($dom, $filename, "name");
                break;
              case "desc":
                $description = Rajce_embed::get_image_att($dom, $filename, "desc");
                break;
              }
            }
          }

          $image_output = sprintf('<a href="%1$s"><img src="%2$s" alt="%3$s" %6$s width="%4$d" height="%5$d"/></a>', $img_url, $thumb_url, $description, $target_width, $target_height, $captions ? "" : 'title="' . $description . '"');

          $embed .= "<{$itemtag} class='gallery-item'>";
          $embed .= "<{$icontag} class='gallery-icon {$orientation}'>$image_output</{$icontag}>";
          if ($captions && $captiontag && $description) {
            $embed .= "<{$captiontag} class='wp-caption-text gallery-caption'>" . wptexturize($description) . "</{$captiontag}>";
          }
          $embed .= "</{$itemtag}>";
          if (!$html5 && $columns > 0 && ++$i % $columns == 0) {
            $embed .= '<br style="clear: both" />';
          }
        }

        if ( ! $html5 && $columns > 0 && $i % $columns !== 0 ) {
          $embed .= "<br style='clear: both' />";
        }
        $embed .= "</div>\n";
      }
      libxml_clear_errors();
    }
    return $embed;
  }

  private static function mini_preview($album_URL, $images, $attr, $instance) {
    $output = "";

    $html = Rajce_embed::get_http($album_URL);
    if($html !== false) {
      $dom = new DOMDocument();
      libxml_use_internal_errors(true);
      if ($dom->loadHTML($html) !== false) {
        extract(Rajce_embed::shortcode_atts($attr));
        $size_class = sanitize_html_class($size);
        $selector = "gallery-rajce-{$instance}-mini-preview";
        list($itemtag, $captiontag, $icontag) = Rajce_embed::validate_gallery_tags($itemtag, $captiontag, $icontag);

        $output .= Rajce_embed::prepend_html5_style();

        $gallery_div = "<div id='$selector' class='gallery-embed-rajce-mini-preview galleryid-{$id} gallery-size-{$size_class}'>";
        reset($images);

        $as = $dom->getElementsByTagName('a');
        foreach ($as as $a) {
          if (strpos($a->getAttribute('class'), 'albumCoverThumb') !== false) {
            $image_URL = $a->getAttribute('href');
            $image_filename = substr($image_URL, strrpos($image_URL, '/') + 1);
            break;
          }
        }
        if ($image_URL == '') {
          $image_filename = key($images);
          $image_URL = $images[$image_filename];
        }
        list($target_width, $target_height, $orientation) = Rajce_embed::get_thumb_size($dom, $image_filename);

        $thumb_source = get_option("rajce_embed_thumbnail_source", 'thumbnail');
        $thumb_url = $thumb_source == 'image' ? $image_URL : str_replace('/images/', '/thumb/', $image_URL);

        $link = in_the_loop() ? get_permalink() : $album_URL;

        $output .= $gallery_div;
        $image_output = sprintf('<a href="%1$s"><img src="%2$s" alt="%3$s" width="%4$d" height="%5$d"/></a>', $link, $thumb_url, $image_filename, $target_width, $target_height);

        $output .= "<{$itemtag} class='gallery-item'>";
        $output .= "
          <{$icontag} class='gallery-icon {$orientation}'>
            $image_output
          </{$icontag}>";
        $output .= "</{$itemtag}>";

        $output .= '<span class="gallery-meta">';
        $output .= '<span class="gallery-name">';
        $output .= sprintf('<a href="%1$s">%2$s</a>', $link, $dom->getElementById("albumName")->nodeValue);
        $output .= '</span>';

        $spans = $dom->getElementsByTagName('span');
        foreach ($spans as $span) {
          if ($span->getAttribute('style') == 'mediaCount') {
            $output .= '<span class="media-count">' . $span->nodeValue . '</span>';
            break;
          }
        }

        $albumCategories = $dom->getElementById("albumCategories");
        if ($albumCategories != NULL) {
          $tags = $albumCategories->nodeValue;
          if ($tags != "")
            $output .= '<span class="gallery-tags">' . $tags . '</span>'; // tags
        }
        $desc = $dom->getElementById("albumDescription")->nodeValue;
        if ($desc != "")
          $output .= '<span class="gallery-description">' . $desc . '</span>'; // tags

        $output .= '</span>';

        $output .= "</div>";

      }
      libxml_clear_errors();
    }

    return $output;
  }

  private static function options_thumb_size() {
    $w = get_option("thumbnail_size_w", 150);
    $h = get_option("thumbnail_size_h", 150);
    $thumb_default = get_option("rajce_embed_thumb_default", 'yes');
    if ($thumb_default == 'no') {
      $thumb_size_w  = get_option("rajce_embed_thumbnail_size_w", $w);
      $thumb_size_h  = get_option("rajce_embed_thumbnail_size_h", $h);
      if (is_numeric($thumb_size_w))
        $w = $thumb_size_w;
      if (is_numeric($thumb_size_h))
        $h = $thumb_size_h;
    }

    return array($w, $h);
  }

  private static function prepend_html5_style() {
    static $done = false;
    if (!$done) {
      $done = true;
      $html5 = current_theme_supports('html5', 'gallery');
      list($wp_thumb_size_w, $wp_thumb_size_h) = Rajce_embed::options_thumb_size();
      if ($html5 && self::crop_thumbs()) {
        return "<style type='text/css'>
          div[class*=\"gallery-embed-rajce\"] .gallery-icon {
            width: {$wp_thumb_size_w}px;
            height: {$wp_thumb_size_h}px;
          }
        </style>";
      }
    }
    return "";
  }

  private static function get_thumb_size($dom, $image_filename) {
    list($wp_thumb_size_w, $wp_thumb_size_h) = Rajce_embed::options_thumb_size();
    list($thumb_width, $thumb_height) = Rajce_embed::image_size($dom, $image_filename);
    $target_width = $thumb_width;
    $target_height = $thumb_height;
    if ($target_width != $wp_thumb_size_w) {
      $target_width = $wp_thumb_size_w;
      $target_height = floor($thumb_height / $thumb_width * $wp_thumb_size_w);
      if ($target_height > $wp_thumb_size_h) {
        $target_height = $wp_thumb_size_h;
        $target_width = floor($thumb_width / $thumb_height * $wp_thumb_size_h);
      }
    }
    $orientation = ($target_height > $target_width) ? 'portrait' : 'landscape';
    return array($target_width, $target_height, $orientation);
  }

  private static function shortcode_atts($atts) {
    $html5 = current_theme_supports('html5', 'gallery');
    $post = get_post();
    return shortcode_atts(array(
          'columns'    => 3,
          'id'         => $post ? $post->ID : 0,
          'size'       => 'thumbnail',
          'itemtag'    => $html5 ? 'figure'     : 'dl',
          'icontag'    => $html5 ? 'div'        : 'dt',
          'captiontag' => $html5 ? 'figcaption' : 'dd'
        ), $atts, 'gallery');
  }

  private static function validate_gallery_tags($itemtag, $captiontag, $icontag) {
    $itemtag = tag_escape($itemtag);
    $captiontag = tag_escape($captiontag);
    $icontag = tag_escape($icontag);
    $valid_tags = wp_kses_allowed_html( 'post' );
    if ( ! isset( $valid_tags[ $itemtag ] ) )
      $itemtag = 'dl';
    if ( ! isset( $valid_tags[ $captiontag ] ) )
      $captiontag = 'dd';
    if ( ! isset( $valid_tags[ $icontag ] ) )
      $icontag = 'dt';
    return array($itemtag, $captiontag, $icontag);
  }

  private static function get_image_att($dom, $image_filename, $att) {
    $scripts = $dom->getElementsByTagName('script');
    foreach ($scripts as $script) {
      if (strpos($script->nodeValue, "var photos = [") !== false) {
        $photos = substr($script->nodeValue, strpos($script->nodeValue, "var photos = ["));
        break;
      }
    }

    $pos = strpos($photos, 'fileName: "' . $image_filename . '"');  // find the entry with the filename in the list
    $pos = strrpos(substr($photos, 0, $pos), '{');                  // move back to opening { for this entry
    $dpos = strpos($photos, $att . ': ', $pos);
    $qchar = substr($photos, $dpos + strlen($att) + 2, 1);
    if ($qchar == '"' || $qchar == "'") {
      $result = substr($photos, $dpos + strlen($att) + 3, strpos($photos, $qchar, $dpos + strlen($att) + 3) - $dpos - strlen($att) - 3);
    } else {
      $tpos = $dpos + strlen($att) + 2;
      while (substr($photos, $tpos, 1) != ',' && substr($photos, $tpos, 1) != '}')
        $tpos++;
      $result = trim(substr($photos, $dpos + strlen($att) + 2, $tpos - $dpos - strlen($att) - 2));
    }
    return $result;
  }

  private static function image_size($dom, $image_filename) {
    return array(Rajce_embed::get_image_att($dom, $image_filename, "width"), Rajce_embed::get_image_att($dom, $image_filename, "height"));
  }

  private static function image_title($dom, $image_filename) {
    $description = Rajce_embed::get_image_att($dom, $image_filename, "desc");
    if ($description == "") $description = Rajce_embed::get_image_att($dom, $image_filename, "name");
    if ($description == "") $description = $image_filename;
    return $description;
  }
}

$wp_Rajce_embed = new Rajce_Embed();
?>