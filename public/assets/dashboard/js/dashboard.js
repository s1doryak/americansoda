jQuery(document).ready(function ($) {

    $(document).on('change', '[data-action="maventa_paid"]', function (e) {
        var $this = $(this),
            checked = $this.prop('checked'),
            $table = $this.closest('table'),
            dt = $table.DataTable();

        $.ajax({
            url: $this.data('url'),
            method: 'post',
            data: {
                _token: $this.data('token'),
                _method: $this.data('method')
            },
            cache: false,
            async: true
        }).complete(function (response) {

            if (response.status === 200) {
                $this.prop('checked', checked);
                $this.prop('disabled', true);
                dt.draw(false);
            } else {
                $this.prop('checked', !checked);
                $this.prop('disabled', false);
            }

        });

    });

    $(document).on('click', '[data-action="send"]', function (e) {

        var $this = $(this),
            $icon = $this.find('i.zmdi'),
            iconClass = $this.data('icon-class'),
            colorClass = $this.data('color-class'),
            progressIconClass = $this.data('progress-icon-class'),
            progressColorClass = $this.data('progress-color-class'),
            $row = $this.closest('tr'),
            $table = $this.closest('table'),
            dt = $table.DataTable();

        if ($table.hasClass('responsive') && $table.hasClass('collapsed')) {
            $row = $this.closest('tr').prev('[role="row"]');
        }

        $this.attr('disabled', true);
        $icon.removeClass(iconClass)
            .removeClass(colorClass)
            .addClass(progressIconClass)
            .addClass(progressColorClass);

        $.ajax({
            url: $this.data('url'),
            method: 'post',
            data: {
                _token: $this.data('token'),
                _method: $this.data('method')
            },
            cache: false,
            async: true
        }).complete(function (response) {

            $this.attr('disabled', false);
            $icon.addClass(iconClass)
                .addClass(colorClass)
                .removeClass(progressIconClass)
                .removeClass(progressColorClass);

            switch (response.status) {
                case 200:
                    $this.replaceWith(response.responseText);
                    break;
                case 404:
                case 500:
                    notify(response.responseJSON.message, 'danger');
                    break;
            }

        });

        e.preventDefault();
    });

    $(document).on('click', '[data-action="send_email"]', function (e) {

        var $this = $(this),
            $icon = $this.find('i.zmdi'),
            iconClass = $this.data('icon-class'),
            colorClass = $this.data('color-class'),
            progressIconClass = $this.data('progress-icon-class'),
            progressColorClass = $this.data('progress-color-class'),
            $row = $this.closest('tr'),
            $table = $this.closest('table'),
            dt = $table.DataTable();

        if ($table.hasClass('responsive') && $table.hasClass('collapsed')) {
            $row = $this.closest('tr').prev('[role="row"]');
        }

        $this.attr('disabled', true);
        $icon.removeClass(iconClass)
            .removeClass(colorClass)
            .addClass(progressIconClass)
            .addClass(progressColorClass);

        $.ajax({
            url: $this.data('url'),
            method: 'post',
            data: {
                _token: $this.data('token'),
                _method: $this.data('method')
            },
            cache: false,
            async: true
        }).complete(function (response) {

            $this.attr('disabled', false);
            $icon.addClass(iconClass)
                .addClass(colorClass)
                .removeClass(progressIconClass)
                .removeClass(progressColorClass);

            switch (response.status) {
                case 200:
                    $this.replaceWith(response.responseText);
                    break;
                case 404:
                case 500:
                    notify(response.responseJSON.message, 'danger');
                    break;
            }

        });

        e.preventDefault();
    });

    $(document).on('change', '[data-action="shipment_assign"]', function (e) {
        var $this = $(this),
            checked = $this.prop('checked');

        $this.prop('disabled', true);

        $.ajax({
            url: $this.data('url'),
            method: 'post',
            data: {
                _token: $this.data('token'),
                _method: $this.data('method'),
                need_shipping: checked
            },
            cache: false,
            async: true
        }).complete(function (response) {

            if (response.status === 200) {
                $this.prop('checked', checked);
            } else {
                $this.prop('checked', !checked);
            }

            $this.prop('disabled', false);
        });

    });
});


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
                    $input.attr('name', _id.replace(/[\d]+/, row_index));
                }

                if (_for) {
                    $input.attr('name', _for.replace(/[\d]+/, row_index));
                }

                if (_name) {
                    $input.attr('name', _name.replace(/[\d]+/, row_index));
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
                .replace(/\[(%%idx%%|idx|\d*)]/gm, '[' + $idx + ']')
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

jQuery(function($) {
    var $form = $('#supplier-order-form');

    if (!$form.length) {
        return;
    }

    $form.on('change', '[data-product_id]', function() {
        var $this = $(this),
            number = $this.find('option:selected').data('number_in_package');

        $this.data('number_in_package', number);
        $this.closest('.js-row').find('[data-pallets_quantity]').trigger('input');
    });

    $form.on('keydown input', '[data-pallets_quantity]', function() {
        var $this = $(this),
            palletsQuantity = $this.val(),
            $row = $this.closest('.js-row'),
            $product = $row.find('[data-product_id]'),
            number = $product.data('number_in_package') || $product.find('option:selected').data('number_in_package'),
            $packagesQuantity = $row.find('[data-packages_quantity]'),
            $productsQuantity = $row.find('[data-products_quantity]'),
            packagesQuantity = $packagesQuantity.attr('data-package-' + number),
            initialProductsQuantity = $productsQuantity.data('initial') || $productsQuantity.attr('data-initial');

        $packagesQuantity.val(palletsQuantity * packagesQuantity);
        $productsQuantity.val(palletsQuantity * initialProductsQuantity);
    });

    $form.on('click', '.js-add-row', function() {
        $form.find('[data-product_id]').trigger('change');
        $form.find('[data-pallets_quantity]').trigger('input');
    });

    $form.find('[data-product_id]').trigger('change');

    if ($form.data('create') == 1) {
        $form.find('[data-pallets_quantity]').trigger('input');
    }
});
jQuery(function($) {

    function triggerPriceField()
    {
        $('.customer-order-items-table .js-row').each(function(idx, row) {
            var $row = $(row),
                $manualPriceField = $row.find('.td-product_manual_price input'),
                $priceField = $row.find('.td-product_price input'),
                checked = $manualPriceField.prop('checked');

            $priceField.prop('disabled', !checked);

        });
    }

    $(document).on('relation-form-row-added', '.customer-order-items-table', function(e) {
        triggerPriceField();
    });

    $(document).on('change', '.customer-order-items-table .td-product_manual_price input', function(e) {
        var $this = $(this),
            $row = $this.closest('.js-row'),
            $priceField = $row.find('.td-product_price input'),
            checked = $this.prop('checked');

        $priceField.prop('disabled', !checked);
    });

    triggerPriceField();

    /**
     * Save original back_order states
     */
    $('.customer-order-items-table .js-row').each(function(idx, row) {
        var $row = $(row),
            $backOrderField = $row.find('.td-back_order input'),
            checked = $backOrderField.prop('checked');

        $backOrderField.data('original-state', checked);

    });

    $(document).on('change', '.customer-order-items-table .td-back_order input', function(e) {
        var $this = $(this),
            checked = $this.prop('checked');

        $this.data('original-state', checked);
    });

    $(document).on('change', '.customer-order-items-table .td-bypass input', function(e) {
        var $this = $(this),
            $row = $this.closest('.js-row'),
            $backOrderField = $row.find('.td-back_order input'),
            checked = $this.prop('checked');

        if(checked) {
            $backOrderField.prop('checked', false);
        } else {
            $backOrderField.prop('checked', $backOrderField.data('original-state'));
        }
    });


});
jQuery(document).ready(function($) {

    $(document).on('input', '#customer-order-item-form input[name="a_quantity"]', function(e) {
        var $aQuantity = $(this),
            $bQuantity = $('#customer-order-item-form input[name="b_quantity"]'),
            total = +$('#customer-order-item-form input[name="sales_unit_quantity"]').val(),
            value = +$aQuantity.val();

        if(!isNaN(value)) {
            if(value > total) {
                value = total;
            }

            $aQuantity.val(value);
            $bQuantity.val(total - value);
        }
    });

    $(document).on('input', '#customer-order-item-form input[name="b_quantity"]', function(e) {
        var $aQuantity = $('#customer-order-item-form input[name="a_quantity"]'),
            $bQuantity = $(this),
            total = +$('#customer-order-item-form input[name="sales_unit_quantity"]').val(),
            value = +$bQuantity.val();

        if(!isNaN(value)) {
            if(value > total) {
                value = total;
            }

            $bQuantity.val(value);
            $aQuantity.val(total - value);
        }
    });

});
jQuery(function ($) {

    var $form = $('#stock-movement-form');

    if (!$form.length) {
        return;
    }

    var $table = $('.js-relation-form'),
        $movementType = $form.find('[name="movement_type"]');

    function getMovementTypes($parent) {
        $parent = $parent ? $parent : $table;

        return $parent.find('[name$="[movement_type]"]');
    }

    function getExpirationDates() {
        var $dates = $table.find('.th-expiration_date');

        return $dates.add($table.find('.td-expiration_date'));
    }

    function getDeliveryNumbers() {
        var $dates = $table.find('.th-delivery_number');

        return $dates.add($table.find('.td-delivery_number'));
    }

    function toggleAvailableMovementTypes(parentMovementType, $parent) {
        var $movement = getMovementTypes($parent),
            $dropdown = $movement.siblings('.dropdown-menu'),
            $optgroup = $movement.find('optgroup[label="' + parentMovementType + '"]'),
            index = $optgroup.index() + 1,
            $li = $dropdown.find('.dropdown-menu li');

        $li.hide();
        $li.filter(function (idx, item) {
            return $(item).data('optgroup') === index;
        }).show();

        $movement.val($optgroup.find('option:first').attr('value')).trigger('change');
    }

    function toggleExpirationDates(movementType) {
        var $dates = getExpirationDates();

        if (movementType === 'cancellation') {
            $dates.hide();
        } else {
            $dates.show();
        }
    }

    function toggleDeliveryNumbers(isSupplierOrderConnected) {
        var $deliveryNumbers = getDeliveryNumbers();

        if (isSupplierOrderConnected) {
            $deliveryNumbers.hide();
        } else {
            $deliveryNumbers.show();
        }
    }

    function toggleSupplierOrderConnected() {
        var isCancellationMovementType = $movementType.val() === 'cancellation';
        var $_supplierOrderConnectedCheckbox = $form.find('[name="_supplierOrderConnected"]');
        var $_supplierOrderConnected = $_supplierOrderConnectedCheckbox.closest('.form-group');

        if (isCancellationMovementType) {
            $_supplierOrderConnectedCheckbox.prop('checked', false).trigger('change');
            $_supplierOrderConnected.hide();
        } else {
            $_supplierOrderConnectedCheckbox.trigger('change');
            $_supplierOrderConnected.show();
        }
    }

    function toggleSupplierOrder(isSupplierOrderConnected) {
        var $supplierOrder = $form.find('[name="supplierOrder"]').closest('.form-group');

        if (!isSupplierOrderConnected) {
            $supplierOrder.hide();
        } else {
            $supplierOrder.show();
        }
    }

    var isSupplierOrderConnected = $form.find('[name="_supplierOrderConnected"]').prop('checked');

    toggleSupplierOrderConnected();
    toggleSupplierOrder(isSupplierOrderConnected);
    toggleDeliveryNumbers(isSupplierOrderConnected);

    $form.find('[name="_supplierOrderConnected"]').on('change', function (e) {
        isSupplierOrderConnected = $(this).prop('checked');

        toggleSupplierOrder(isSupplierOrderConnected);
        toggleDeliveryNumbers(isSupplierOrderConnected);
    });

    var currentMovementType = $movementType.val();

    toggleExpirationDates(currentMovementType);

    getMovementTypes().on('loaded.bs.select', function () {
        toggleAvailableMovementTypes(currentMovementType);
    });

    $movementType.on('change', function () {
        currentMovementType = $(this).val();

        toggleSupplierOrderConnected();
        toggleAvailableMovementTypes(currentMovementType);
        toggleExpirationDates(currentMovementType);
        toggleDeliveryNumbers(isSupplierOrderConnected);
    });

    $(document).on('relation-form-row-added', '.stock_movement-products-table', function (e, $row) {
        toggleSupplierOrderConnected();
        toggleAvailableMovementTypes(currentMovementType, $row);
        toggleExpirationDates(currentMovementType);
        toggleDeliveryNumbers(isSupplierOrderConnected);
    });

});
