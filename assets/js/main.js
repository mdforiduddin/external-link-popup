; (function ($) {
    $(document).ready(function () {

        let confirmButton = '.external-link-popup-container .external-link-popup-confirm';

        let cancelButton = '.external-link-popup-container .external-link-popup-cancel';

        $(confirmButton).css('background-color', External_Link_Popup.confirm_button_background);
        $(confirmButton).css('color', External_Link_Popup.confirm_button_color);

        $(cancelButton).css('background-color', External_Link_Popup.cancel_button_background);
        $(cancelButton).css('color', External_Link_Popup.cancel_button_color);

        let External_Links = External_Link_Popup.links.map(function (link) {
            return link.trim();
        });

        let all_Link_Check = External_Link_Popup.all_link;

        /* Link Check Function */
        function linkCheck(check_link) {
            return External_Links.some(function (link) {
                return check_link.includes(link);
            });
        }

        /* Popup Open Function */
        function runPopup(link) {

            let mainPopup = '.external-link-popup-overlay';

            $(confirmButton).attr('date-link', link);
            $(mainPopup).fadeIn();

            $(confirmButton).click(function () {
                let btnlink = $(confirmButton).attr('date-link');
                window.open(btnlink, '_blank');
                $(mainPopup).fadeOut();
            });
        }

        /* Popup Close Function */
        function closePopup() {
            $('.external-link-popup-container .external-link-popup-confirm').attr('date-link', '');
            $('.external-link-popup-overlay').fadeOut();
        }

        $('a').each(function () {

            let link = $(this).attr('href');

            /* Setting Checkbox Check Conditon */
            if (1 == all_Link_Check) {

                if (link && (link.startsWith('http') || link.startsWith('https')) && !link.startsWith(window.location.origin)) {

                    $(this).click(function (e) {

                        e.preventDefault();

                        runPopup(link);
                    });
                }

            } else {

                if (link && (link.startsWith('http') || link.startsWith('https')) && !link.startsWith(window.location.origin) && linkCheck(link)) {

                    $(this).click(function (e) {

                        e.preventDefault();

                        runPopup(link);
                    });
                }
            }
        });

        /* Popup Close Code */
        $(cancelButton).click(function () {
            closePopup();
        });

        $(document).keydown(function (e) {
            if (e.key === "Escape") {
                closePopup();
            }
        });
    });
})(jQuery);
