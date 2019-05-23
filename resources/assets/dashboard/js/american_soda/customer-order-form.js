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