jQuery(function ($) {

    function updateRelationForm($table) {
        var row_index = 0;

        $table.find('.js-row').each(function (idx, row) {
            var $row = $(row);

            row_index++;

            $row.find('input,select,textarea,label').each(function (idx, input) {
                var $input = $(input),
                    _id = $input.attr('id'),
                    _for = $input.attr('for'),
                    _name = $input.attr('name');

                if (_id) {
                    $input.attr('name', _id.replace(/\[(%%idx%%|idx|0)]/gm, '[' + row_index + ']'));
                }

                if (_for) {
                    $input.attr('name', _for.replace(/\[(%%idx%%|idx|0)]/gm, '[' + row_index + ']'));
                }

                if (_name) {
                    $input.attr('name', _name.replace(/\[(%%idx%%|idx|0)]/gm, '[' + row_index + ']'));
                }
            });

            $row.trigger('reanimate');
        });
    }

    function toggleRelationForm($table) {
        if ($table.data('resource') === 'customer_pricing_policy') {
            return;
        }

        if ($table.find('.js-row').length === 0) {
            $table.hide();
        } else {
            $table.show();
        }
    }

    var $policies = $('.js-relation-form[data-resource^="customer_pricing_policy"]');

    if ($policies.length) {
        updateRelationForm($policies.closest('.js-relation-form'));
    }

    $(document).on('click', '.js-add-row', function () {
        var $this = $(this),
            $template, $table, $parentTable, resource, $lastRow, $row, template, lastRowIdx, idx;

        if ($this.closest('.js-relation-form').length) {
            $table = $this.closest('.js-relation-form');
            $parentTable = $table.closest('.form-group');
        } else {
            $table = $this.closest('.form-group').find('.js-relation-form');
            $parentTable = $table;
        }

        resource = $table.data('resource');
        $lastRow = $table.find('.js-row').last();
        lastRowIdx = $lastRow.index() + 1;
        idx = lastRowIdx + 1;
        $template = $('[data-role="template"][data-resource="' + resource + '"]');
        template = $template.html().replace(/\[(%%idx%%|idx|0)]/gm, '[' + idx + ']');
        $row = $(template);

        $row.addClass('new');

        if ($lastRow.length) {
            $row.insertAfter($lastRow);
        } else {
            $table.find('tbody').append($row);
        }

        updateRelationForm($parentTable);

        toggleRelationForm($table);

        $table.trigger('relation-form-row-added', [$row]);

        return false;
    });

    $(document).on('click', '.js-remove-row', function () {
        var $this = $(this),
            $row = $this.closest('.js-row'),
            $table = $row.closest('.js-relation-form'),
            colspan = $row.find('>td').length - 1;

        if ($row.hasClass('new')) {

            $row.remove();

            toggleRelationForm($table);

            return false;
        }

        // var oldText = $this.text();
        //
        // $this.text($this.data('text'));
        // $this.data('text', oldText);

        $row.data('removed', !$row.data('removed'));

        $row.find('[name$="[_remove]"]')
            .val($row.data('removed'));

        $row.find('td:not(.js-td-removed)')
            .toggleClass('hidden');

        $row.find('.js-td-removed')
            .toggleClass('hidden')
            .attr('colspan', colspan);

        toggleRelationForm($table);

        return false;
    });

    $(document).on('click', '.js-undo-link', function () {

        $(this).closest('.js-row')
            .find('.js-remove-row')
            .click();

        return false;
    });

    // $(document).on('input change', '.js-row .form-control', function () {
    //     var $this = $(this),
    //         $row = $this.closest('.js-row'),
    //         val = $this.val() || $this.text(),
    //         changed = (val !== $this.data('initial') ? 1 : 0);
    //
    //     $row.find('[data-changed]').val(changed);
    // });

});
