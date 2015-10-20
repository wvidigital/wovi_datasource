(function ($) {
    Drupal.behaviors.wovi_dsdebug_prism = {
        attach: function (context, settings) {
            Prism.highlightAll();
        }
    }
})(jQuery);