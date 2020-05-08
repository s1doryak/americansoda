<?php

namespace App\Transformers\Dashboard;

use App\CustomerInvoiceItem;
use Crmplease\MaterialAdmin\Http\Requests\Request;
use Crmplease\MaterialAdmin\Transformers\Contracts\TransformerContract;
use Crmplease\MaterialAdmin\Transformers\Traits\Collector;
use Illuminate\Support\Collection;

/**
 * CustomerInvoiceItem transformer.
 *
 * @package App\Transformers\Dashboard
 */
class CustomerInvoiceItemTransformer implements TransformerContract
{
    use Collector;

    /**
     * @param Request $request
     * @return array
     */
    public static function transformStoreRequest(Request $request)
    {
        return [
            'position' => (integer)$request->get('position'),
            'item_code' => $request->get('item_code'),
            'subject' => $request->get('subject'),
            'definition' => $request->get('definition'),
            'price' => $request->get('price'),
            'unit_type' => $request->get('unit_type'),
            'amount' => $request->get('amount'),
            'sum' => $request->get('sum'),
            'tax' => $request->get('tax'),
            'sum_tax' => $request->get('sum_tax'),
            'discount' => $request->get('discount'),
            'invoice' => (integer)$request->get('invoice'),
            'orderItem' => (integer)$request->get('orderItem'),
            'product' => (integer)$request->get('product'),
        ];
    }

    /**
     * @param Request $request
     * @return array
     */
    public static function transformUpdateRequest(Request $request)
    {
        return [
            'position' => (integer)$request->get('position'),
            'item_code' => $request->get('item_code'),
            'subject' => $request->get('subject'),
            'definition' => $request->get('definition'),
            'price' => $request->get('price'),
            'unit_type' => $request->get('unit_type'),
            'amount' => $request->get('amount'),
            'sum' => $request->get('sum'),
            'tax' => $request->get('tax'),
            'sum_tax' => $request->get('sum_tax'),
            'discount' => $request->get('discount'),
            'invoice' => (integer)$request->get('invoice'),
            'orderItem' => (integer)$request->get('orderItem'),
            'product' => (integer)$request->get('product'),
        ];
    }

    /**
     * @param CustomerInvoiceItem $customerInvoiceItem
     * @return array
     */
    public static function toArray($customerInvoiceItem)
    {
        return [
            'id' => (int)$customerInvoiceItem->getKey(),
            'position' => (integer)$customerInvoiceItem->position,
            'item_code' => $customerInvoiceItem->item_code,
            'subject' => $customerInvoiceItem->subject,
            'definition' => $customerInvoiceItem->definition,
            'price' => $customerInvoiceItem->price,
            'unit_type' => $customerInvoiceItem->unit_type,
            'amount' => $customerInvoiceItem->amount,
            'sum' => $customerInvoiceItem->sum,
            'tax' => $customerInvoiceItem->tax,
            'sum_tax' => $customerInvoiceItem->sum_tax,
            'discount' => $customerInvoiceItem->discount,
            'invoice' => $customerInvoiceItem->invoice ? CustomerInvoiceTransformer::toArray($customerInvoiceItem->invoice) : null,
            'orderItem' => $customerInvoiceItem->orderItem ? CustomerOrderItemTransformer::toArray($customerInvoiceItem->orderItem) : null,
            'product' => $customerInvoiceItem->product ? ProductTransformer::toArray($customerInvoiceItem->product) : null,

            'created_at' => (string)$customerInvoiceItem->created_at,
            'updated_at' => (string)$customerInvoiceItem->updated_at,
            'deleted_at' => (string)$customerInvoiceItem->deleted_at,
        ];
    }

    /**
     * @param CustomerInvoiceItem $customerInvoiceItem
     * @return object
     */
    public static function toMaventa($customerInvoiceItem)
    {
        /**
         * # Gather invoice items into array
         * # NOTE! Items are an array of arrays
         * $items = array();
         *
         * $inv_items = array();
         * $inv_items['position'] = 1;
         * $inv_items['item_code'] = 'itm0001';
         * $inv_items['subject'] = 'Test item';
         * $inv_items['unit_type'] = 'pcs';
         * $inv_items['amount'] = 10;
         * $inv_items['price'] = '10';
         * $inv_items['discount'] = 0;
         * $inv_items['definition'] = 'red';
         * $inv_items['tax'] = 22;
         * $inv_items['sum'] = '100';
         * $inv_items['sum_tax'] = '122';
         * $inv_items['data'] = 'null';
         *
         * array_push($items, $inv_items);
         */

        return (object)[
            'position' => $customerInvoiceItem->position,
            'item_code' => $customerInvoiceItem->item_code,
            'subject' => $customerInvoiceItem->subject,
            'definition' => $customerInvoiceItem->discount,
            'unit_type' => $customerInvoiceItem->unit_type,
            'price' => $customerInvoiceItem->price,
            'discount' => $customerInvoiceItem->discount,
            'amount' => $customerInvoiceItem->amount,
            'sum' => $customerInvoiceItem->sum,
            'tax' => $customerInvoiceItem->tax,
            'sum_tax' => $customerInvoiceItem->sum_tax,
            'data' => null,
        ];
    }

    /**
     * @param Collection $collection
     * @return Collection
     */
    public static function mapMaventa($collection)
    {
        return $collection->map(function ($item) {
            return self::toMaventa($item);
        });
    }
}
