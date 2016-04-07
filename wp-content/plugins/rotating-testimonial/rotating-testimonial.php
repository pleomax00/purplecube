<?php 
	/**
 * Plugin Name: Rotating Testimonial
 * Plugin URI: http://www.ifuturz.com/
 * Description: Plugin for displaying testimonials in rotating mode with multiple jQuery Effects.
 * Version: 1.1
 * Author: i-Verve
 * Author URI: http://www.ifuturz.com/
 * License: GPLv3
 ===================================================================================================
                       LICENSE
===================================================================================================

License: GNU General Public License V3
License URI: see the license.txt file for license details.

	testimonial-basics is a plugin for WordPress
    Copyright (C) 2012 Kevin Archibald

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */
 
register_activation_hook( __FILE__,array('Testimonials','install_tables')); 
register_uninstall_hook(__FILE__, array('Testimonials', 'delete_tables' ) );	
global $frmPluginName;
$frmPluginName = "Rotating Testimonial";
include_once 'controller.php';





