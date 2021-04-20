<?php

namespace App\Transformers\Dashboard;

use App\CustomerOrderItem;
use Crmplease\MaterialAdmin\Http\Requests\Request;
use Crmplease\MaterialAdmin\Transformers\Contracts\TransformerContract;
use Crmplease\MaterialAdmin\Transformers\Traits\Collector;
use Illuminate\Support\Collection;

/**
 * CustomerOrderItem transformer.
 *
 * @package App\Transformers\Dashboard
 */
class CustomerOrderItemTransformer implements TransformerContract
{
    use Collector;

    /**
     * @param Request $request
     * @return array
     */
    public static function transformStoreRequest(Request $request)
    {
        return [
            'status' => $request->get('status'),
            'product_name' => $request->get('product_name'),
            'sales_unit_quantity' => $request->get('sales_unit_quantity'),
            'product_manual_price' => (boolean)$request->get('product_manual_price'),
            'product_price' => $request->get('product_price'),
            'vat' => (integer)$request->get('vat'),
            'product_vat_price' => $request->get('product_vat_price'),
            'products_quantity' => (integer)$request->get('products_quantity'),
            'packages_quantity' => (integer)$request->get('packages_quantity'),
            'total_price' => $request->get('total_price'),
            'total_vat_price' => $request->get('total_vat_price'),
            'deposit_enabled' => (boolean)$request->get('deposit_enabled'),
            'deposit_price' => $request->get('deposit_price'),
            'deposit_vat' => (integer)$request->get('deposit_vat'),
            'deposit_vat_price' => $request->get('deposit_vat_price'),
            'deposit_total_price' => $request->get('deposit_total_price'),
            'deposit_total_vat' => $request->get('deposit_total_vat'),
            'deposit_total_vat_price' => $request->get('deposit_total_vat_price'),
            'bypass' => (boolean)$request->get('bypass'),
            'back_order' => (boolean)$request->get('back_order'),
            'cancelled' => (boolean)$request->get('cancelled'),
            'expected_date' => $request->get('expected_date'),
            'product' => (integer)$request->get('product'),
            'customer' => (integer)$request->get('customer'),
            'customerOrder' => (integer)$request->get('customerOrder'),
            'customerShipment' => (integer)$request->get('customerShipment'),

        ];
    }

    /**
     * @param Request $request
     * @return array
     */
    public static function transformUpdateRequest(Request $request)
    {
        return [
            'status' => $request->get('status'),
            'product_name' => $request->get('product_name'),
            'sales_unit_quantity' => $request->get('sales_unit_quantity'),
            'product_manual_price' => (boolean)$request->get('product_manual_price'),
            'product_price' => $request->get('product_price'),
            'vat' => (integer)$request->get('vat'),
            'product_vat_price' => $request->get('product_vat_price'),
            'products_quantity' => (integer)$request->get('products_quantity'),
            'packages_quantity' => (integer)$request->get('packages_quantity'),
            'total_price' => $request->get('total_price'),
            'total_vat_price' => $request->get('total_vat_price'),
            'deposit_enabled' => (boolean)$request->get('deposit_enabled'),
            'deposit_price' => $request->get('deposit_price'),
            'deposit_vat' => (integer)$request->get('deposit_vat'),
            'deposit_vat_price' => $request->get('deposit_vat_price'),
            'deposit_total_price' => $request->get('deposit_total_price'),
            'deposit_total_vat' => $request->get('deposit_total_vat'),
            'deposit_total_vat_price' => $request->get('deposit_total_vat_price'),
            'bypass' => (boolean)$request->get('bypass'),
            'back_order' => (boolean)$request->get('back_order'),
            'cancelled' => (boolean)$request->get('cancelled'),
            'expected_date' => $request->get('expected_date'),
            'product' => (integer)$request->get('product'),
            'customer' => (integer)$request->get('customer'),
            'customerOrder' => (integer)$request->get('customerOrder'),
            'customerShipment' => (integer)$request->get('customerShipment'),

        ];
    }

    /**
     * @param CustomerOrderItem $customerOrderItem
     * @return array
     */
    public static function toArray($customerOrderItem)
    {
        return [
            'id' => (int)$customerOrderItem->getKey(),
            'status' => $customerOrderItem->status,
            'product_name' => $customerOrderItem->product_name,
            'sales_unit_quantity' => $customerOrderItem->sales_unit_quantity,
            'product_manual_price' => (boolean)$customerOrderItem->product_manual_price,
            'product_price' => $customerOrderItem->product_price,
            'vat' => (integer)$customerOrderItem->vat,
            'product_vat_price' => $customerOrderItem->product_vat_price,
            'products_quantity' => (integer)$customerOrderItem->products_quantity,
            'packages_quantity' => (integer)$customerOrderItem->packages_quantity,
            'total_price' => $customerOrderItem->total_price,
            'total_vat_price' => $customerOrderItem->total_vat_price,
            'deposit_enabled' => (boolean)$customerOrderItem->deposit_enabled,
            'deposit_price' => $customerOrderItem->deposit_price,
            'deposit_vat' => (integer)$customerOrderItem->deposit_vat,
            'deposit_vat_price' => $customerOrderItem->deposit_vat_price,
            'deposit_total_price' => $customerOrderItem->deposit_total_price,
            'deposit_total_vat' => $customerOrderItem->deposit_total_vat,
            'deposit_total_vat_price' => $customerOrderItem->deposit_total_vat_price,
            'bypass' => (boolean)$customerOrderItem->bypass,
            'back_order' => (boolean)$customerOrderItem->back_order,
            'cancelled' => (boolean)$customerOrderItem->cancelled,
            'expected_date' => $customerOrderItem->expected_date,
            'product' => $customerOrderItem->product ? ProductTransformer::toArray($customerOrderItem->product) : null,
            'customer' => $customerOrderItem->customer ? CustomerTransformer::toArray($customerOrderItem->customer) : null,
            'customerOrder' => $customerOrderItem->customerOrder ? CustomerOrderTransformer::toArray($customerOrderItem->customerOrder) : null,
            'customerShipment' => $customerOrderItem->customerShipment ? CustomerShipmentTransformer::toArray($customerOrderItem->customerShipment) : null,

            'created_at' => (string)$customerOrderItem->created_at,
            'updated_at' => (string)$customerOrderItem->updated_at,
            'deleted_at' => (string)$customerOrderItem->deleted_at,
        ];
    }

    /**
     * @param CustomerOrderItem $customerOrderItem
     * @return array
     */
    public static function toCustomerInvoiceItemsArray($customerOrderItem)
    {
        return [
            'customerOrderItem' => (int)$customerOrderItem->getKey(),
            'product' => (int)$customerOrderItem->product->getKey()
        ];
    }

    /**
     * @param Collection $collection
     * @return Collection
     */
    public static function mapCustomerInvoiceItemsArray($collection)
    {
        return $collection->map(function ($customerOrderItem) {
            return self::toCustomerInvoiceItemsArray($customerOrderItem);
        });
    }

    /**
     * @param Collection $collection
     * @return Collection
     */
    public static function mapCustomerInvoicePalpaItemsArray($collection)
    {
        return $collection
            ->filter(
                function (CustomerOrderItem $customerOrderItem) {
                    return $customerOrderItem->deposit_enabled;
                }
            )->groupBy(
                function (CustomerOrderItem $customerOrderItem) {
                    return (string)$customerOrderItem->deposit_vat;
                }
            )->map(
                function (Collection $group, $vat) {
                    return $group
                        ->groupBy(
                            function (CustomerOrderItem $customerOrderItem) {
                                return (string)$customerOrderItem->deposit_price;
                            }
                        )->map(
                            function (Collection $group, $price) use ($vat) {

                                $k = 1 + ($vat / 100);

                                return [
                                    'subject' => sprintf("PANTTIMAKSU (PALPA %.2f EUR)", round($price * $k, 2)),
                                    'definition' => sprintf("Pantillinen (%.8f EUR, ALV 0%%)", $price),
                                    'price' => $price,
                                    'unit_type' => 'kpl',
                                    'amount' => $group->sum('products_quantity'),
                                    'tax' => $vat
                                ];
                            }
                        );
                }
            )
            ->flatten(1);
    }
}
