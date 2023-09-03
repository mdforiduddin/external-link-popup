; (function ($) {
    $(document).ready(function () {

        let preview_Value = External_Link_Popup_Preview.Value;

        let mainPopup = '.external-link-popup-overlay';


        if (true == preview_Value) {
            $(mainPopup).fadeIn();
        }

        wp.customize('external_link_popup_customize_preview', function (value) {
            value.bind(function (newvalue) {
                if (true == newvalue) {
                    $(mainPopup).fadeIn();
                } else {
                    $(mainPopup).fadeOut();
                }
            });
        });

        wp.customize('external_link_popup_customize_text', function (value) {

            value.bind(function (newvalue) {
                $(".external-link-popup-container .external-link-popup-text").html(newvalue.split('\n').join('<br>'));
            });
        });

        wp.customize('external_link_popup_customize_confirm_button_background', function (value) {
            value.bind(function (newvalue) {
                $(".external-link-popup-confirm").css("background-color", newvalue);
            });
        });

        wp.customize('external_link_popup_customize_confirm_button_color', function (value) {
            value.bind(function (newvalue) {
                $(".external-link-popup-confirm").css("color", newvalue);
            });
        });

        wp.customize('external_link_popup_customize_cancel_button_background', function (value) {
            value.bind(function (newvalue) {
                $(".external-link-popup-cancel").css("background-color", newvalue);
            });
        });
        wp.customize('external_link_popup_customize_cancel_button_color', function (value) {
            value.bind(function (newvalue) {
                $(".external-link-popup-cancel").css("color", newvalue);
            });
        });


    });
})(jQuery);