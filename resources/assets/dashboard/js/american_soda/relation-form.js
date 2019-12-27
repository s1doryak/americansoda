jQuery(function ($) {
    var $forms = $('.js-relation-form'),
        templates = {};

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

            $row.find('.selectpicker').selectpicker();
            $row.find('.date-picker').datetimepicker({
                format: 'DD/MM/YYYY'
            });
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

    $('.js-relation-form-row').each(function (idx, el) {
        var $template = $(el),
            resource = $template.data('resource');

        templates[resource] = Handlebars.compile($template.html());
    });

    $(document).on('click', '.js-add-row', function () {
        var $this = $(this),
            $table, $parentTable, resource, $lastRow, $row;

        if ($this.closest('.js-relation-form').length) {
            $table = $this.closest('.js-relation-form');
            $parentTable = $table.closest('.form-group');
        } else {
            $table = $this.closest('.form-group').find('.js-relation-form');
            $parentTable = $table;
        }

        resource = $table.data('resource');
        $lastRow = $table.find('.js-row').last();
        $idx = $lastRow.index() + 1;
        $row = $(
            templates[resource]()
                .replace(/\[(%%idx%%|idx|0)]/gm, '[' + $idx + ']')
        );

        $row.addClass('new');

        if ($lastRow.length) {
            $row.insertAfter($lastRow);
        } else {
            $table.find('tbody').append($row);
        }

        updateRelationForm($parentTable);

        toggleRelationForm($table);

        $table.trigger('relation-form-row-added', [$row]).trigger('relation-form-row-added/' + resource, [$row]);

        return false;
    });

    $forms.each(function (i, form) {
        var $form = $(form);

        $form.on('click', '.js-remove-row', function () {
            var $this = $(this),
                $row = $this.closest('.js-row'),
                $mainForm = $row.closest('form');

            if ($mainForm.data('create') === 1 || $row.hasClass('new')) {
                $row.remove();

                toggleRelationForm($form);

                return false;
            }

            var oldText = $this.text();

            $this.text($this.data('text'));
            $this.data('text', oldText);

            $row.data('removed', $row.data('removed') !== 1 ? 1 : 0);

            $row.find('[data-remove]').val($row.data('removed'));

            $row.find('td:not(.js-td-removed)').toggleClass('hidden');
            $row.find('.js-td-removed').toggleClass('hidden').attr('colspan', $row.find('td:not(.js-td-removed)').length);

            toggleRelationForm($form);

            return false;
        });

        $form.on('click', '.js-undo-link', function () {
            $(this).closest('.js-row').find('.js-remove-row').click();

            return false;
        });

        $form.on('input change', '.form-control', function () {
            var $this = $(this),
                $row = $this.closest('.js-row'),
                val = $this.val() || $this.text(),
                changed = (val !== $this.data('initial') ? 1 : 0);

            $row.find('[data-changed]').val(changed);
        });

        toggleRelationForm($form);

    });

    (function () {

        $policies = $('.js-relation-form[data-resource^="customer_pricing_policy"]');

        if ($policies.length) {
            updateRelationForm($policies.closest('.js-relation-form'));
        }

    }());

});
