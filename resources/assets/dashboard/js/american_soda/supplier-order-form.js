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