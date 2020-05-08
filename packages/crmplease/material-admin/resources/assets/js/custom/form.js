jQuery(document).ready(function ($) {

    $(document).on('reanimate', function (e) {
        var $form = $(this);

        $form.find('.html-editor').each(function () {
            $(this).trumbowyg(
                $.trumbowygDefaultOptions
            );
        });

        $form.find('.selectpicker').each(function () {
            $(this).selectpicker();
        });

        $form.find('.datepicker').each(function () {
            var format = $(this).attr('data-format') || $(this).attr('format') || 'YYYY-MM-DD';

            $(this).datetimepicker({
                format: format
            });
        });

        e.preventDefault();
    });
});
