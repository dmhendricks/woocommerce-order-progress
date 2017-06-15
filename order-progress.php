<?php
/**
 * @wordpress-plugin
 * Plugin Name:       Order Details Progress Bar for WooCommerce
 * Plugin URI:        https://github.com/dmhendricks/woocommerce-order-progress
 * Description:       Displays an order status progress bar on WooCommerce order details pages.
 * Version:           0.1.0
 * Author:            Daniel M. Hendricks
 * Author URI:        https://danhendricks.com
 * License:           GPL-2.0
 * License URI:       https://opensource.org/licenses/GPL-2.0
 * GitHub Plugin URI: dmhendricks/woocommerce-order-progress
 */

/*	Copyright 2017	  Daniel M. Hendricks (https://danhendricks.com/)

		This program is free software; you can redistribute it and/or
    modify it under the terms of the GNU General Public License
    as published by the Free Software Foundation; either version 2
    of the License, or (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

if(!defined('ABSPATH')) die();

require( __DIR__ . '/vendor/autoload.php' );
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

// Initialize plugin - Change to use your own namespace
new \TwoLab\WooOrderProgress\Plugin(array(
	'data' => get_plugin_data(__FILE__),
	'path' => realpath(plugin_dir_path(__FILE__)).DIRECTORY_SEPARATOR,
	'url' => plugin_dir_url(__FILE__),
	'textdomain' => 'woocommerce-order-progress',
	'object_cache_group' => 'woop_cache',
	'object_cache_expire' => 72, // In hours
	'prefix' => 'woo_progress_'
));
?>
