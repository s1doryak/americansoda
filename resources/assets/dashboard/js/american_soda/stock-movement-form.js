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