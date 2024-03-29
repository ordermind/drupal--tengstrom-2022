(function ($, Drupal) {

  'use strict';

  Drupal.behaviors.tengstrom2022_toolbar_workaround = {
    attach: function (context, settings) {

      // Workaround for bug with toolbar module that does not set header padding-top properly on page load which makes
      // the toolbar cover part of the header
      $(window).on('load', () => {
        if(Drupal.toolbar !== undefined && typeof Drupal.toolbar.models.toolbarModel === 'object' && Drupal.toolbar.models.toolbarModel !== null) {
          const currentOrientation = Drupal.toolbar.models.toolbarModel.get('orientation');
          Drupal.toolbar.models.toolbarModel.trigger('change:orientation', Drupal.toolbar.models.toolbarModel, currentOrientation);
        }
      });
    }
  };

}(jQuery, Drupal));
