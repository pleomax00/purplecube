<?php
/**
 * File: Installation
 * Description: add all plugin's required database tables and default settings & values.
 */

$Settings = serialize(array(
   'short_code_title' => 'What Our Customer Says'
));
add_option("weblizar_testimonial_settings", $Settings);

global $wpdb;

/** Table 1 - testimonial  **/
$TestimonialTable = $wpdb->prefix . "weblizar_testimonials";
$TestimonialTableSQL = "
CREATE TABLE IF NOT EXISTS `$TestimonialTable` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `age` text NOT NULL,
  `sex` text NOT NULL,
  `phone` text NOT NULL,
  `address` text NOT NULL,
  `country` text NOT NULL,
  `testimonial` text NOT NULL,
  `ratings` text NOT NULL,
  `website` text NOT NULL,
  `designation` TEXT NOT NULL,
  `image` TEXT NOT NULL,
  `blog` text NOT NULL,
  `video_url` text NOT NULL,
  `social_media_url` TEXT NOT NULL,
  `status` TEXT NOT NULL,
  `date_time` TIMESTAMP NOT NULL,
  `extra_field_1` text NOT NULL,
  `extra_field_2` text NOT NULL,
  PRIMARY KEY (`id`)
)DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
";
$wpdb->query($TestimonialTableSQL);