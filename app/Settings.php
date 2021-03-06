<?php
namespace TwoLab\WooOrderProgress;
use Carbon_Fields\Container;
use Carbon_Fields\Field;
use Twig;

class Settings extends Plugin {

  /**
    * Create a options/settings page in WP Admin
    */
  function __construct() {
    // Add custom order statuses: https://www.sellwithwp.com/woocommerce-custom-order-status-2/

    // Create WooCommerce > Settings > Progress Bar tab
    add_filter( 'woocommerce_settings_tabs_array', array($this, 'add_woocommerce_settings_tab'), 25 );

    // Add options
    add_action( 'plugins_loaded', function() {
      add_action( 'woocommerce_settings_tabs_order_progress',  function() {
        woocommerce_admin_fields( $this->woocommerce_order_progress_get_settings() );
      });
    });

    // Save settings event
    add_action( 'woocommerce_update_options_order_progress', array($this, 'woocommerce_order_progress_update_settings') );

    // Display progress bar
    add_action( 'woocommerce_purchase_note_order_statuses', array($this, 'nolo_custom_field_display_cust_order_meta'), 10, 1 );

    /*
    $loader = new Twig_Loader_Filesystem('/path/to/templates');
    $twig = new Twig_Environment($loader, array(
        'cache' => '/path/to/compilation_cache',
    ));
    */

    // Register Ajax callback to return WooCommerce order statuses
    add_action('wp_ajax_wooop_ajax_get_order_statuses', array(__CLASS__, 'wooop_ajax_get_order_statuses'));

  }

  public function nolo_custom_field_display_cust_order_meta($order){
      //echo '<p><strong>'.__('Pickup Location').':</strong> ' . get_post_meta( $order->id, 'Pickup Location', true ). '</p>';
      //echo '<p><strong>'.__('Pickup Date').':</strong> ' . get_post_meta( $order->id, 'Pickup Date', true ). '</p>';

      echo "<hr />";
  }

  public function woocommerce_order_progress_update_settings() {
    //$current_statuses = get_option( self::$settings['prefix'].'custom_status_types', 'none' );
    //var_dump($current_statuses);
    woocommerce_update_options( $this->woocommerce_order_progress_get_settings() );
    //var_dump(wc_get_order_statuses());
  }

  public function add_woocommerce_settings_tab( $tabs ) {
    $tabs['order_progress'] = __( 'Order Progress', self::$settings['textdomain'] );
    return $tabs;
  }

  public function woocommerce_order_progress_get_settings(  ) {

    $settings = array(
        'section_title' => array(
            'name'     => __( 'Progress Bar', self::$settings['textdomain'] ),
            'type'     => 'title',
            'id'       => self::$settings['prefix'].'section_title'
        ),
        'enabled' => array(
            'name' => __( 'Enable Progress Bar', self::$settings['textdomain'] ),
            'type' => 'checkbox',
            'default' => 'yes',
            'desc' => __( 'Display on order details page?', self::$settings['textdomain'] ),
            'id'   => self::$settings['prefix'].'enabled'
        ),
        'disable_text_status' => array(
            'name' => __( 'Hide Text Status', self::$settings['textdomain'] ),
            'type' => 'checkbox',
            'desc' => __( 'Hide default WooCommerce order status text description?', self::$settings['textdomain'] ),
            'id'   => self::$settings['prefix'].'disable_text_status'
        ),
        'primary_color' => array(
            'name' => __( 'Primary Color', self::$settings['textdomain'] ),
            'type' => 'color',
            'default' => '#66cc66',
            'desc_tip' => true,
            'desc' => __( 'Foreground color<br />(completed potion)', self::$settings['textdomain'] ),
            'id'   => self::$settings['prefix'].'primary_color'
        ),
        'secondary_color' => array(
            'name' => __( 'Secondary Color', self::$settings['textdomain'] ),
            'type' => 'color',
            'default' => '#cccccc',
            'desc_tip' => true,
            'desc' => __( 'Background color<br />(pending potion)', self::$settings['textdomain'] ),
            'id'   => self::$settings['prefix'].'secondary_color'
        ),
        'datetime_color' => array(
            'name' => __( 'Date/Time Color', self::$settings['textdomain'] ),
            'type' => 'color',
            'default' => '#999999',
            'id'   => self::$settings['prefix'].'datetime_color'
        ),
        'label_color' => array(
            'name' => __( 'Status Label Color', self::$settings['textdomain'] ),
            'type' => 'color',
            'default' => '#666666',
            'id'   => self::$settings['prefix'].'label_color'
        ),
        'label_position' => array(
            'name' => __( 'Date/Label Positions', self::$settings['textdomain'] ),
            'type' => 'radio',
            'default' => 'above',
            'options' => array('above' => 'Above', 'Below'),
            'id'   => self::$settings['prefix'].'label_position'
        ),
        'disable_datetime' => array(
            'name' => __( 'Hide Date/Time', self::$settings['textdomain'] ),
            'type' => 'checkbox',
            'desc' => __( 'Remove the date/time of each status change.', self::$settings['textdomain'] ),
            'id'   => self::$settings['prefix'].'disable_datetime'
        ),
        'status_types' => array(
            'name' => __( 'Displayed Statuses', self::$settings['textdomain'] ),
            //'type' => 'multiselect',
            //'options' => wc_get_order_statuses(),
            'css' => 'width: 100%; max-width: 600px; height: 125px;',
            'type' => 'textarea',
            'desc' => 'Choose the order statuses that will display on the order details page.<br />Use Control+Click (Windows) or Command+Click (OS X) to select multiple.',
            'id'   => self::$settings['prefix'].'status_types'
        ),
        'custom_status_types' => array(
            'name' => __( 'Custom Order Status', self::$settings['textdomain'] ),
            'type' => 'textarea',
            'css' => 'width: 100%; max-width: 600px; height: 85px;',
            'desc' => __( 'Specify additional order statuses, each on a new line. Examples: <em>Awaiting shipment, Shipped, etc</em> (Optional)', self::$settings['textdomain'] ),
            'id'   => self::$settings['prefix'].'custom_status_types'
        ),
        'title' => array(
            'name' => __( 'Title', self::$settings['textdomain'] ),
            'type' => 'text',
            'css' => 'width: 100%; max-width: 600px;',
            'desc' => __( '<br />Displayed above order progress bar. (Optional)', self::$settings['textdomain'] ),
            'id'   => self::$settings['prefix'].'title'
        ),
        'subtitle' => array(
            'name' => __( 'Text Below Title', self::$settings['textdomain'] ),
            'type' => 'textarea',
            'css' => 'width: 100%; max-width: 600px; height: 125px;',
            'id'   => self::$settings['prefix'].'subtitle'
        ),
        'section_end' => array(
             'type' => 'sectionend',
             'id' => self::$settings['prefix']
        )
    );
    return apply_filters( 'wc_order_progress_settings', $settings );

  }

  public function wooop_ajax_get_order_statuses() {
    echo json_encode(wc_get_order_statuses());
    wp_die();
  }

  private function add_admin_settings_panel() {
    // Carbon Fields Docs: https://carbonfields.net/docs/containers-theme-options/

    Container::make('theme_options', self::$settings['data']['Name'])
      ->set_page_parent('options-general.php')
      ->add_tab(__('General'), array(
        Field::make('text', self::$prefix.'email', 'Your E-mail Address')->help_text('Example help text.'),
        Field::make('text', self::$prefix.'phone', 'Phone Number'),
        Field::make('date_time', self::$prefix.'date_time', 'Date & Time'),
        Field::make('checkbox', self::$prefix.'checkbox', 'Disable New Registrations')->set_option_value(1)->set_default_value(1),
        Field::make('radio', self::$prefix.'radio', 'Subtitle text style')
          ->add_options(array(
            'em' => 'Italic',
            'strong' => 'Bold',
            'del' => 'Strike',
          )
        ),
        Field::make('complex', self::$prefix.'slides')->add_fields(array(
          Field::make('text', 'title'),
          Field::make('image', 'photo'),
        )),
        Field::make("select", self::$prefix."select", "Best Music")
          ->add_options(array(
            'winning' => 'Matchbox Twenty',
            'losing' => 'Nickelback',
            'superstar' => 'Anything Armin van Buuren spins'
          ))
        )
      )
      ->add_tab(__('Miscellaneous'), array(
        Field::make('color', self::$prefix.'font_color', 'Foreground Color'),
        Field::make('image', self::$prefix.'default_image', 'Default Image'),
        Field::make('file', self::$prefix.'file', 'File Upload')
      )

      /*
      // One page, no tabs (Example)
      ->add_fields(array(
        Field::make('color', self::$prefix.'background_color', 'Background Color'),
        Field::make('image', self::$prefix.'background_image', 'Background Image')
      )
      */

      // Add side metabox (Example)
      /*
      Container::make('post_meta', 'Custom Data')
        ->show_on_post_type('post')
        ->set_priority('default')
        ->set_context('side')
        ->add_fields(array(
          Field::make('text', self::$prefix.'meta_test')
        )
      );
      */
    );

  }

}
