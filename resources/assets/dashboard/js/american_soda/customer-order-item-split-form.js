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