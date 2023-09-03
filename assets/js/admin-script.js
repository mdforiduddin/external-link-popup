; (function ($) {
    $(document).ready(function () {
        var external_link_popup_chekbox = $('.external-link-popup input[type="checkbox"]');
        var external_link_popup_textarea = $('.external-link-popup textarea');

        /* Initial state */
        external_link_popup_textarea.prop('disabled', external_link_popup_chekbox.prop('checked'));

        /* Toggle textarea based on checkbox status */
        external_link_popup_chekbox.on('change', function () {
            external_link_popup_textarea.prop('disabled', $(this).prop('checked'));
        });

        /* Trigger auto-resize when the content changes */
        $(external_link_popup_textarea).on('input', function () {
            var scrollHeight = $(this).prop('scrollHeight');
            $(this).height(scrollHeight);
        });


    });
})(jQuery);