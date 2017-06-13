<?php
namespace TwoLab\WooOrderProgress;

class Core extends Plugin {

  function __construct() {

    /*
    if(!is_admin() && !$this->is_ajax()) {
      add_filter( 'body_class', array(&$this, 'add_body_classes') );
    }
    */

    // Check for required plugins
    if(is_admin()) add_action( 'tgmpa_register', array($this, 'register_plugins') );


  }

  public static function register_plugins() {
    // Reference: http://tgmpluginactivation.com/configuration/

    // Required Plugins
    $plugins = array(
      array(
        'name'                => 'WooCommerce',
        'slug'                => 'woocommerce',
        'version'             => '2.6.0',
        'required'            => true,
        'force_activation'    => false,
        'force_deactivation'  => false
  		)
    );

    $config = array(
  		'id'           => 'tgmpa_required_plugins',
  		//'default_path' => self:$settings->path.'plugins/',
  		'menu'         => 'woop-install-plugins',
  		'parent_slug'  => 'themes.php',
  		'capability'   => 'edit_theme_options',
  		'has_notices'  => true,
  		'dismissable'  => false,
  		'dismiss_msg'  => 'WooCommerce Progress Bar requires some additional plugins need to be installed.', // If 'dismissable' is false, this message will be output at top of nag.
  		'is_automatic' => false,
  		'message'      => '', // Message to output right before the plugins table.
  		'strings'      => array(
  			'page_title' => __( 'Install Required Plugins', self::$settings['textdomain'] ),
  			'menu_title' => __( 'Install Dependencies', self::$settings['textdomain'] ),
  			'nag_type'   => 'error', // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
  		)
  	);

    tgmpa( $plugins, $config );

  }

  /**
    * Returns string of addition CSS classes based on post type
    *
    * Returns CSS classes such as page-{slug}, parent-{slug}, post-type-{type} and
    *   category-{slug} for easier selector targeting
    *
    * @param array $classes An array of *current* body_class classes
    * @return array Modified array of body classes including new ones
    */
  public function add_body_classes($classes) {
    $parent_slug = Helpers::get_parent_slug(true);
    $categories = is_single() ? Helpers::get_post_categories(true) : array();

    // Add page, parent and post-type classes, if available
    $classes[] = 'page-'.Helpers::get_page_slug();
    if($parent_slug) $classes[] = 'parent-'.$parent_slug;
    $classes[] = 'post-type-'.get_post_type();

    // Add category slugs
    foreach($categories as $cat) {
      $classes[] = 'category-'.$cat;
    }

    return $classes;
  }

}
