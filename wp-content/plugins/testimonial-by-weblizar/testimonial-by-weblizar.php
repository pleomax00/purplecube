<?php
/**
 * Plugin Name: Testimonial By WebLizar
 * Version: 0.5
 * Description: Display & accepts testimonial by your online clients and customers.
 * Author: WebLizar
 * Author URI: http://www.weblizar.com
 * Plugin URI: http://www.weblizar.com/plugins/
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 */

/**
 * Constant Values & Variables
 */
    define("PLUGIN_URL", plugin_dir_url(__FILE__));
    define("WEBLIZAR_TESTIMONIAL_TEXT_DOMAIN", "weblizar");

/**
 * Plugin Installation Script
 */
register_activation_hook( __FILE__, 'WeblizarDoInstallation' );
function WeblizarDoInstallation() {
    require_once('installation.php');
}

/**
 * Translate Plugin
 */
add_action('plugins_loaded', 'TranslateTestimonialPlugin');

function TranslateTestimonialPlugin() {
    load_plugin_textdomain(WEBLIZAR_TESTIMONIAL_TEXT_DOMAIN, FALSE, dirname( plugin_basename(__FILE__)).'/plugin-languages/' );
}

/**
 * Build Admin Menu
 */
add_action('admin_menu','WeblizarAdminMenu');

function WeblizarAdminMenu() {
    $AdminMenu = add_menu_page( __('Testimonial', WEBLIZAR_TESTIMONIAL_TEXT_DOMAIN), __('Testimonial', WEBLIZAR_TESTIMONIAL_TEXT_DOMAIN), 'administrator', 'weblizar-testimonial', 'weblizar_testimonial_admin_menu_page', 'dashicons-editor-quote');
    //$AdminSubMenu_1 = add_submenu_page( 'weblizar-testimonial', __('Other Pages', WEBLIZAR_TESTIMONIAL_TEXT_DOMAIN), __('Other Pages', WEBLIZAR_TESTIMONIAL_TEXT_DOMAIN), 'administrator', 'weblizar-testimonial', 'weblizar_testimonial_other_menu_page' );
    add_action( 'admin_print_styles-' . $AdminMenu, 'WeblizarAdminAssetsFiles' );
}

/**
 * Load Admin Pages Assets JS/CSS/Images
 */
function WeblizarAdminAssetsFiles() {
    /**
     * All Required JS Files
     */
    wp_enqueue_script('bootstrap.min',PLUGIN_URL.'/admin/assets/js/bootstrap.min.js');

    /**
     * All Required CSS Files
     */
    wp_enqueue_style('ace.min.css', PLUGIN_URL.'/admin/assets/css/ace.min.css');
    wp_enqueue_style('bootstrap.min.css', PLUGIN_URL.'/admin/assets/css/bootstrap.min.css');
    wp_enqueue_style('font-awesome.min.css', PLUGIN_URL.'/admin/assets/css/font-awesome.min.css');
}

/**
 * Weblizar ShortCode Detect Function to Load JS & CSS Files on ShortCode Specific Page/Post
 * Helper: wp_enqueue_script( $handle, $src, $deps, $ver, $in_footer );
 */
function WeblizarTestimonialShortCodeDetect() {
    global $wp_query;
    $Posts = $wp_query->posts;
    $Pattern = get_shortcode_regex();

    foreach ($Posts as $Post) {
        if (   preg_match_all( '/'. $Pattern .'/s', $Post->post_content, $Matches ) && array_key_exists( 2, $Matches ) && in_array( 'WLT', $Matches[2] ) ) {

            /**
             * js scripts
             */
            wp_enqueue_script('responsiveslides',PLUGIN_URL.'/admin/assets/responsive-slides-js-css/responsiveslides.js',array('jquery'));
            wp_enqueue_script('responsiveslides-min',PLUGIN_URL.'/admin/assets/responsive-slides-js-css/responsiveslides.min', array('jquery'));

            /**
             * css scripts
             */
            wp_enqueue_style('responsiveslides', PLUGIN_URL.'/admin/assets/responsive-slides-js-css/responsiveslides.css');
            wp_enqueue_style('bootstrap.min.css', PLUGIN_URL.'/admin/assets/css/bootstrap.min.css');
            wp_enqueue_style('font-awesome.min.css', PLUGIN_URL.'/admin/assets/css/font-awesome.min.css');
            break;
        } //end of if
    } //end of foreach
}
add_action( 'wp', 'WeblizarTestimonialShortCodeDetect' );


/**
 * Admin Menu Page Function
 */
function weblizar_testimonial_admin_menu_page(){
    require_once("admin/dashboard.php");
}

/**
 * Admin Sub Menu For Other Page
 */
function weblizar_testimonial_other_menu_page(){
    //will be used in future updates release
}

/**
 * Testimonial ShortCode
 */
    require_once("testimonial-short-code.php");

/**
 * Testimonial Widget
 */
    require_once("testimonial-widget.php");