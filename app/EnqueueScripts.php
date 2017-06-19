<?php
namespace TwoLab\WooOrderProgress;

class EnqueueScripts extends Plugin {

  function __construct() {

    add_action( 'plugins_loaded', function() {
      $this->enqueue_frontend_scripts();
      //$this->enqueue_admin_scripts();
      add_action( 'admin_enqueue_scripts', function($hook) {
        if ($hook == 'woocommerce_page_wc-settings') $this->enqueue_woocommerce_admin_scripts();
      });
    });

  }

  /**
    * Enqueue scripts used on frontend of site
    */
  private function enqueue_frontend_scripts() {

    // Example enqueuing remote scripts (http://select2.github.io/)
    //wp_enqueue_style( 'select2', '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css', null, '4.0.3' );
    //wp_enqueue_script( 'select2', '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js', array('jquery'), '4.0.3' );

    // Example enqueuing a script added from ZIP file via composer (http://underscorejs.org/)
    //wp_enqueue_script( 'underscore', $this->get_script_url('vendor/jashkenas/underscore/underscore-min.js'), null, '1.8.3' );

    // Enqueuing custom CSS for child theme (Twentysixteen was used for testing)
    wp_enqueue_style( 'wooop', $this->get_script_url('assets/css/wooop.css'), null, $this->get_script_version('assets/css/wooop.css') );

  }

  /**
    * Enqueue scripts used in WP admin interface
    */
  private function enqueue_woocommerce_admin_scripts() {

    // Load custom scripts in admin
    wp_enqueue_script( 'wooop-vendor', plugins_url('/assets/js/wooop-vendor.min.js', dirname(__FILE__)), array('jquery'), $this->get_script_version('assets/js/wooop-vendor.min.js') );
    wp_enqueue_script( 'wooop-admin', plugins_url('/assets/js/wooop-admin.js', dirname(__FILE__)), array('wooop-vendor'), $this->get_script_version('assets/js/wooop-admin.js'), true );

  }

}
