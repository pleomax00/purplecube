<?php
  namespace WebsitePopups;
  defined('ABSPATH') or die("Invalid access!");

  /*
    We use this to namespace wishpond metadata for each post
    since metadata is global on wordpress
  */
  class PostMetadata
  {
    public function __construct( $prefix, $meta_keys = array()) {
      $this->prefix = $prefix;
      $this->meta_keys  = $meta_keys;

      foreach( $this->meta_keys as $name ) {
        $this->$name = PostMetadata::apply_prefix( $this->prefix, $name );
      }
    }

    public function get( $name ) {
      return $this->$name;
    }

    public static function apply_prefix( $prefix, $name ) {
      return $prefix . "_" . $name;
    }
  }
?>
