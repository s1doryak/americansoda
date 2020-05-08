jQuery(function ($) {

    /**
     * Table "drawCallback" handlers.
     */
    $(document).on('draw', '.dataTable', function (e) {
        var $table = $(this);

        $table.find('[data-toggle=tooltip]').tooltip();
        $table.find('.lightbox').lightGallery({enableTouch: true});
    });

    $(document).on('error', '.dataTable', function (e, error) {
        notify(error, 'danger');
        console.error(error);
    });

    $(document).on('aggregate', '.dataTable', function (e, aggregate) {
        var $table = $(this),
            dt = $table.DataTable();

        $.each(aggregate, function (id, column) {
            $(dt.columns(column.name + ':name').footer()).html(column.html);

            if (column.exception) {
                console.error(column.exception.message);
            }
        });
    });

    $(document).on('filterable', '.dataTable', function (e, filterable) {

        $.each(filterable, function (idx, filter) {
            var $filter = $('[data-filter-name="' + filter.name + '"]'),
                value = typeof filter.value !== undefined ? filter.value : null;

            switch (filter.type) {
                case 'choice':
                case 'select':
                    $filter.empty();

                    $.each(filter.items, function (idx, item) {

                        var selected = $.inArray(item.key, $.makeArray(value)) !== -1;

                        $('<option/>')
                            .val(item.key)
                            .text(item.value)
                            .prop('selected', selected)
                            .appendTo($filter);
                    });

                    $filter.selectpicker('refresh');
                    break;
                case 'checkbox':
                    var checked = $filter.val() === value;

                    $filter.prop('checked', checked);
                    break;
                default:
                    $filter.val(value);
                    break;
            }

            if (filter.exception) {
                console.error(filter.exception.message);
            }
        });
    });


    /**
     * Filter form Handlers.
     */
    $(document).on('submit', '.dataTableFilter', function (e) {
        var $filter = $(this),
            filterId = $filter.attr('id'),
            tableId = filterId.replace('Filter', ''),
            $table = $('#' + tableId),
            dt = $table.DataTable();

        $filter.slideUp();
        dt.draw();

        e.preventDefault();
    });

    $(document).on('click', '.dataTableFilter [type="reset"]', function (e) {
        var $filter = $(this).closest('form'),
            filterId = $filter.attr('id'),
            tableId = filterId.replace('Filter', ''),
            $table = $('#' + tableId),
            dt = $table.DataTable();

        $filter.get(0).reset();
        $filter.find('.selectpicker').selectpicker('refresh');
        $filter.slideUp();
        dt.draw();

        e.preventDefault();
    });
});
