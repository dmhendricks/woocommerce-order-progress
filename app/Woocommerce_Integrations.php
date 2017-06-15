<?php
//namespace TwoLab\WooOrderProgress;

class Woocommerce_Integrations extends WC_Integration {

  function __construct() {

    if ( class_exists( 'WC_Integration' ) ) {
      //include_once 'class-wc-integration.php';
      add_filter( 'woocommerce_integrations', array( &$this, 'add_integration' ) );
    }

  }

  /**
    * A short code the returns "Hello {$name}!", if provided
    */
  private function add_integration( $integrations ) {
    // Reference: https://tommcfarlin.com/woocommerce-integrations/

    $integrations[] = Woocommerce_Integrations::class;
    return $integrations;

  }

}
