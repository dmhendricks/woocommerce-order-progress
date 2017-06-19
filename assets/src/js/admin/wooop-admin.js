// Custom JS for WP admin

(function($) {

  var _wooop_status_types_field = $('#woocommerce-order-progressstatus_types');
  _wooop_status_types_field.attr('size', _wooop_status_types_field.find('option').length > 8 ? 8 : _wooop_status_types_field.find('option').length);
  console.log(_wooop_status_types_field.find('option').length);

  // Create Post Tyle selection


})(jQuery);
