$(document).ready(function () {

    $('body').on('click', '[data-ma-action]', function (e) {
        e.preventDefault();

        var $this = $(this);
        var action = $(this).data('ma-action');

        switch (action) {

            /*-------------------------------------------
             Change Header Skin
             ---------------------------------------------*/
            case 'change-skin':

                var skin = $this.data('ma-skin');

                $('[data-ma-theme]').attr('data-ma-theme', skin);

                break;
        }
    });
});