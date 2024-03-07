/**
 * @file
 * Tengström 2022 behaviors.
 */
(function ($, Drupal) {

  'use strict';

  Drupal.behaviors.tengstrom2022 = {
    attach: function (context, settings) {

      // Workaround for bug with toolbar module that does not set header padding-top properly on page load which makes
      // the toolbar cover part of the header
      $(window).on('load', () => {
        if ($('#toolbar-item-administration').length) {
          $('#toolbar-item-administration').click();
        }
      })

    }
  };

}(jQuery, Drupal));
