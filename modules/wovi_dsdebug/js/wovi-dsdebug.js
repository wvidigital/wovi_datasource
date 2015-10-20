(function ($) {
    Drupal.behaviors.wovi_dsdebug = {
        attach: function (context, settings) {
            $('.wovi-dsdebug-log .info-row').bind('click', function () {
                var target = $(this).data('toggle');
                $(target).toggleClass('open');
                if ($(target).hasClass('open'))
                    $('html, body').animate({
                        scrollTop: $(target).offset().top
                    }, 2000);
            });
        }
    }
})(jQuery);