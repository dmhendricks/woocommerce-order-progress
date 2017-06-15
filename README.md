# Order Details Progress Bar for WooCommerce

**NB!** This plugin is currently under development and is *non-functional*.

## Description

A plugin for WooCommerce that displays an order progress bar on the customer's order details page.

## Requirements

Although this plugin may function with lesser versions, only recent versions of the following are actively tested and supported:

* PHP: 5.6-7.1
* WordPress: 3.8 or higher
* WooCommerce: 3.0 or higher

## Known Compatibility Issues

* **Carbon Fields**: This plugin will fail if you have a version of [Carbon Fields](https://wordpress.org/plugins/carbon-fields/) installed that is lower than version 1.6 (including any plugins that use Carbon Fields as a loaded dependency). If you have Carbon Fields installed, it is recommended that you upgrade to at least version 1.6.

## Installation

### Standard Installation

1. Download the latest ZIP archive from [Releases](https://github.com/dmhendricks/woocommerce-order-progress/releases).
2. In WP Admin, click **Plugins** > **Add New**.
3. Once installation is finished, **Activate** the plugin.

### Composer

1. At command prompt, change to your `wp-content/plugins` directory.
2. Clone the repository: `git clone https://github.com/dmhendricks/woocommerce-order-progress.git`.
3. Run `composer install` to install dependencies and autoload namespaces.

## Change Log

#### 0.1.0 - June 13, 2017

* Initial commit
