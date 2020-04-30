<?php

use App\CustomerInvoiceItem;
use App\CustomerOrderItem;
use Carbon\Carbon;
use Illuminate\Support\Collection;

/**
 * @return boolean
 */
function is_app()
{
    return prefix_name() === '';
}

/**
 * @return boolean
 */
function is_dashboard()
{
    return prefix_name() === 'dashboard';
}

/**
 * @return boolean
 */
function is_api()
{
    return strpos(prefix_name(), 'api') !== false;
}

/**
 * @return boolean
 */
function is_local()
{
    return env('APP_ENV', 'production') === 'local';
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
 * @param \Illuminate\Support\Collection $items
 *
 * @return \Illuminate\Support\Collection
 */
function get_total_vats($items)
{
    $depositItems = $items->filter(function ($item) {

        if ($item instanceof CustomerInvoiceItem) {
            return false;
        }

        if ($item instanceof CustomerOrderItem) {
            return (boolean)$item->deposit_enabled;
        }

        throw new \Exception('Unexpected item', $item);
    });

    $depositGroups = $depositItems->groupBy(function ($item) {

        if ($item instanceof CustomerOrderItem) {
            return (string)$item->deposit_vat;
        }

        throw new \Exception('Unexpected item', $item);

    })->map(function (Collection $items, $vat) {

        return $items->sum(function ($item) {

            if ($item instanceof CustomerOrderItem) {
                return $item->deposit_total_vat_price - $item->deposit_total_price;
            }

            throw new \Exception('Unexpected item', $item);
        });

    });

    $groups = $items->groupBy(function ($item) {

        if ($item instanceof CustomerInvoiceItem) {
            return (string)$item->tax;
        }

        if ($item instanceof CustomerOrderItem) {
            return (string)$item->vat;
        }

        throw new \Exception('Unexpected item', $item);

    })->map(function (Collection $items, $vat) {

        return $items->sum(function ($item) {

            if ($item instanceof CustomerInvoiceItem) {
                return $item->sum_tax - $item->sum;
            }

            if ($item instanceof CustomerOrderItem) {
                return $item->total_vat_price - $item->total_price;
            }

            throw new \Exception('Unexpected item', $item);
        });

    });

    return collect()
        ->merge($groups->keys())
        ->merge($depositGroups->keys())
        ->mapWithKeys(function ($vat) use ($groups, $depositGroups) {

            $sum = 0.00;

            if ($groups->has($vat)) {
                $sum += (float)$groups->get($vat);
            }

            if ($depositGroups->has($vat)) {
                $sum += (float)$depositGroups->get($vat);
            }

            return [
                $vat => $sum
            ];
        });
}

/**
 * @param \Illuminate\Support\Collection $items
 *
 * @return \Illuminate\Support\Collection
 */
function get_total_deposits($items)
{
    $groups = $items->filter(function ($item) {

        if ($item instanceof CustomerInvoiceItem) {
            return $item->customerOrderItem ? $item->customerOrderItem->deposit_enabled : false;
        }

        if ($item instanceof CustomerOrderItem) {
            return $item->deposit_enabled;
        }

        throw new \Exception('Unexpected item', $item);
    }
    )->groupBy(function ($item) {

        if ($item instanceof CustomerInvoiceItem) {
            return $item->customerOrderItem ? (string)$item->customerOrderItem->deposit_vat : '0';
        }

        if ($item instanceof CustomerOrderItem) {
            return (string)$item->deposit_vat;
        }

        throw new \Exception('Unexpected item', $item);

    })->map(function (Collection $items, $vat) {

        return $items->groupBy(function ($item) {

            if ($item instanceof CustomerInvoiceItem) {
                return $item->customerOrderItem ? (string)$item->customerOrderItem->deposit_price : '0';
            }

            if ($item instanceof CustomerOrderItem) {
                return (string)$item->deposit_price;
            }

            throw new \Exception('Unexpected item', $item);

        });
    });

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

/**
 * @param string $token
 * @return string
 */
function generateApiAuthLink($token)
{
    return config('app.shop_url') . '?token=' . $token;
}

/**
 * @param integer $id
 * @param string $resource
 * @param string $action
 * @return string
 */
function generateResourceLink($id, $resource, $action = 'edit')
{
    return config('app.url') . "dashboard/{$resource}/{$id}/$action";
}

/**
 * @param bool $reset
 * @return int
 */
function static_idx($reset = false)
{
    static $idx = 0;

    $idx = $reset ? 1 : $idx + 1;

    return $idx;
}

/**
 * @param $attributes
 * @param string $key
 *
 * @return string
 */
function formatDateForForm($attributes, $key)
{
    if (empty($attributes[$key])) {
        return null;
    }

    return Carbon::parse($attributes[$key])->format('d/m/Y');
}
