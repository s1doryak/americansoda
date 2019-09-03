<?php

function is_app()
{
    return prefix_name() == '';
}

function is_dashboard()
{
    return prefix_name() == 'dashboard';
}

/**
 * Check whether current page is a resource page.
 *
 * @return bool
 */
function is_document_page($resource = null)
{
    $actions = [
        '.waybill',
        '.package_list',
        '.order_review',
    ];

    return is_page($actions) && ($resource ? in_array(resource_name(), (array)$resource) : true);
}

/**
 * Transform barcode to proper rendering.
 *
 * @param string $value
 *
 * @return string
 */
function transform_barcode($value)
{
    $matrix = config('barcode.transform');

    return str_replace(
        array_keys($matrix),
        array_values($matrix),
        $value
    );
}

/**
 * @param \Illuminate\Database\Eloquent\Collection $orderItems
 *
 * @return \Illuminate\Database\Eloquent\Collection
 */
function get_total_vats($orderItems)
{
    $groups = $orderItems->groupBy('vat');

    foreach ($groups as $vat => $group) {
        $groups[$vat] = $group->sum(
            function ($item) {
                return $item->total_vat_price - $item->total_price;
            }
        );
    }

    $depositGroups = $orderItems->filter(
        function ($orderItem) {
            return $orderItem->deposit_enabled;
        }
    )->groupBy('deposit_vat');

    foreach ($depositGroups as $vat => $group) {

        if (!isset($groups[$vat])) {
            $groups[$vat] = 0;
        }

        $groups[$vat] += $group->sum(
            function ($item) {
                return $item->deposit_total_vat_price - $item->deposit_total_price;
            }
        );
    }

    return $groups;
}

/**
 * @param \Illuminate\Database\Eloquent\Collection $orderItems
 *
 * @return \Illuminate\Database\Eloquent\Collection
 */
function get_total_deposits($orderItems)
{
    $groups = $orderItems->filter(
        function ($orderItem) {
            return $orderItem->deposit_enabled;
        }
    )->groupBy(function ($item) {
        return (string)$item->deposit_vat;
    });

    /** @var \Illuminate\Database\Eloquent\Collection $group */
    foreach ($groups as $vat => $group) {
        $groups[$vat] = $group->groupBy(function ($item) {
            return (string)$item->deposit_price;
        });
    }

    return $groups;
}

/**
 * @param mixed|\Illuminate\Database\Eloquent\Collection $orderItems
 *
 * @return mixed
 */
function get_delivery_numbers($orderItems = null)
{
    /** @var \App\Repositories\Eloquent\StockProductRepositoryEloquent $repository */
    $repository = app(\App\Repositories\Contracts\StockProductRepository::class);

    if ($orderItems instanceof \Illuminate\Support\Collection) {
        $ids = $orderItems->pluck('id')->toArray();
    } else {
        $ids = (array)$orderItems;
    }

    /** @var \Illuminate\Database\Eloquent\Collection $stockProducts */
    $stockProducts = $repository->findWhereIn('customer_order_item_id', $ids, [DB::raw('DISTINCT delivery_number')]);

    return $stockProducts->pluck('delivery_number')->unique()->implode(' / ');
}

/**
 * @param string $number
 * @return integer
 */
function viitenumero_check_digit($number)
{
    $number = strrev(preg_replace('/[^\d]/', '', $number));

    for ($sum = 0, $i = 0, $len = strlen($number); $i < $len; $i++) {
        switch ($i % 3) {
            case 0:
                $k = 7;
                break;
            case 1:
                $k = 3;
                break;
            case 2:
                $k = 1;
                break;
            default:
                $k = 0;
                break;
        }

        $sum += $k * $number[$i];
    }

    return $sum % 10;
}
