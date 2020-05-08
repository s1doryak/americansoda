jQuery(function ($) {

    /**
     * Sidebar
     */
    $('body').on('click', '.sub-menu > a', function (e) {
        e.preventDefault();
        $(this).next().slideToggle(200);
        $(this).parent().toggleClass('toggled');
    });


    /**
     * Tooltips
     */
    if ($('[data-toggle="tooltip"]')[0]) {
        $('[data-toggle="tooltip"]').tooltip();
    }

    /**
     * Login/Register animation
     */
    if ($('.lc-block')[0]) {
        setTimeout(function () {
            $('.lc-block').addClass('toggled');
        }, 500);
    }

    $('.html-editor').each(function () {
        $(this).trumbowyg(
            $.trumbowygDefaultOptions
        );
    });

    $('.selectpicker').each(function () {
        $(this).selectpicker();
    });

    $('.datepicker').each(function () {
        var format = $(this).attr('data-format') || $(this).attr('format') || 'YYYY-MM-DD';

        $(this).datetimepicker({
            format: format
        });
    });

});
