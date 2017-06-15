=== Order Details Progress Bar for WooCommerce ===
Contributors: hendridm
Tags: woocommerce,order,details,status,progress
Donate link: https://paypal.me/danielhendricks
Requires at least: 3.8
Tested up to: 4.8
License: GPL-2.0
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Add an order progress bar to customer's order detail page.

== Description ==
A plugin for WooCommerce that displays an order progress bar on the customer's order details page.

= Requirements =
Although this plugin may function with lesser versions, only recent versions of the following are actively tested and supported:

* PHP: 5.6-7.1
* WordPress: 3.8 or higher
* WooCommerce: 3.0 or higher

= Known Compatibility Issues =

* Carbon Fields: This plugin will fail if you have a version of [Carbon Fields](https://wordpress.org/plugins/carbon-fields/) installed that is lower than version 1.6 (including any plugins that use Carbon Fields as a loaded dependency). If you have Carbon Fields installed, it is recommended that you upgrade to at least version 1.6.

== Installation ==
= Standard Installation =
1. Download the latest ZIP archive from [GitHub](https://github.com/dmhendricks/woocommerce-order-progress/releases).
2. In WP Admin, click **Plugins** > **Add New**.
3. Once installation is finished, **Activate** the plugin.

= Composer =
1. At command prompt, change to your `wp-content/plugins` directory.
2. Clone the repository: `git clone https://github.com/dmhendricks/woocommerce-order-progress.git`.
3. Run `composer install` to install dependencies and autoload namespaces.

== Frequently Asked Questions ==
= Q. What is Composer? =
A. Composer is an application-level package manager for the PHP programming language that provides a standard format for managing dependencies of PHP software and required libraries.

== Screenshots ==
1. Settings Page

== Changelog ==
= 0.1.0 =
* Initial release
