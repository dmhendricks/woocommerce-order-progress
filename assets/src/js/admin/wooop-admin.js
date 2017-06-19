/*
 * @preserve: WooCommerce Order Progress - Admin
 */

var WOOOP_NS = WOOOP_NS || {};

(function($) {

  WOOOP_NS.Admin = {

    formatSettingsFields: function() {

      var _wooop_status_types_field = $('#wooop_status_types');
      _wooop_status_types_field.attr('size', _wooop_status_types_field.find('option').length > 8 ? 8 : _wooop_status_types_field.find('option').length);

    }

  }

  WOOOP_NS.Ajax = {

    getWoocommerceOrderStatues: function() {

      $.ajax({
          type: 'GET',
          url: ajax_filter_params.ajax_url,
          dataType: 'json',
          data: {
            action: 'wooop_ajax_get_order_statuses'
          },
          success: function(result)
          {
            console.log(result);
          }
      });

      return false;
    }

  }

  WOOOP_NS.Admin.formatSettingsFields();
  WOOOP_NS.Ajax.getWoocommerceOrderStatues();


})(window.jQuery);
