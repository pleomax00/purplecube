<?php
/**
 * File: Uninstall
 * Description: Remove all plugin's database tables and default settings & values.
 */

global $wpdb;

/*** Drop - webliz_testimonials - Table **/
$TestimonialTable = $wpdb->prefix . "webliz_testimonials";
$wpdb->query("DROP TABLE `$TestimonialTable`");