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
     * @return array
     */
    public static function toMaventaArray($customerInvoiceItem)
    {
        return [

        ];
    }

    /**
     * @param Collection $collection
     * @return Collection
     */
    public static function mapMaventa($collection)
    {
        return $collection->map(function ($item) {
            return self::toMaventaArray($item);
        });
    }
}
