@extends('dashboard::actions.create')

@section('scripts')
    @parent
    <script type="text/javascript">
        jQuery(document).ready(function ($) {
            $(document).on('input change', '[name$="[price]"], [name$="[amount]"], [name$="[tax]"]', function () {
                var $input = $(this),
                    $row = $input.closest('.js-row'),
                    $price = $row.find('[name$="[price]"]'),
                    $amount = $row.find('[name$="[amount]"]'),
                    $sum = $row.find('[name$="[sum]"]'),
                    $tax = $row.find('[name$="[tax]"]'),
                    $sum_tax = $row.find('[name$="[sum_tax]"]');

                var price = parseFloat($price.val()) || 0.00,
                    amount = parseFloat($amount.val()) || 0.00,
                    tax = parseFloat($tax.val()) || 0.00,
                    sum = price * amount,
                    tax_k = tax / 100,
                    sum_tax = sum * (1 + tax_k);

                $sum.val(sum.toFixed(2));
                $sum_tax.val(sum_tax.toFixed(2));
            });

            $(document).on('relation-form-row-added', function (e, $row) {
                $row.find('[name$="[price]"], [name$="[amount]"], [name$="[tax]"]').trigger('change');
            });
        });
    </script>
@stop
