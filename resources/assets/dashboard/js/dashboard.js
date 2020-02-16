jQuery(function ($) {

    /**
     * Обработчик отправки форм из модальных окон.
     */
    $(document).on('modal.submitted.success', function (e, response, params) {
        if (response.redirect_url) {
            window.location = response.redirect_url;
        }
    });

});