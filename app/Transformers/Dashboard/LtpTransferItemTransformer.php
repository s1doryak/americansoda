<?php

namespace App\Transformers\Dashboard;

use App\LtpTransferItem;
use Crmplease\MaterialAdmin\Http\Requests\Request;
use Crmplease\MaterialAdmin\Transformers\Contracts\TransformerContract;
use Crmplease\MaterialAdmin\Transformers\Traits\Collector;

/**
 * LtpTransferIteTransformer transformer
 *
 * @package App\Transformers\Dashboard
 */
class LtpTransferItemTransformer implements TransformerContract
{
    use Collector;

    /**
     * @param Request $request
     * @return array
     */
    public static function transformStoreRequest(Request $request)
    {
        return [
            'document_type' => $request->get('document_type'),
            'document_number' => $request->get('document_number'),
            'requested_delivery_date' => $request->get('requested_delivery_date'),

            'items' => (array)$request->get('items'),
        ];
    }

    /**
     * @param Request $request
     * @return array
     */
    public static function transformUpdateRequest(Request $request)
    {
        return [
            'document_type' => $request->get('document_type'),
            'document_number' => $request->get('document_number'),
            'requested_delivery_date' => $request->get('requested_delivery_date'),

            'items' => (array)$request->get('items'),
        ];
    }

    /**
     * @param LtpTransferItem $ltpTransferItem
     * @return array
     */
    public static function toArray($ltpTransferItem)
    {
        return [
            'id' => (int)$ltpTransferItem->getKey(),
            'client_purchase_order' => $ltpTransferItem->client_purchase_order,
            'client_purchase_order_line' => $ltpTransferItem->client_purchase_order_line,
            'product_code' => $ltpTransferItem->product_code,
            'product_ean' => $ltpTransferItem->product_ean,
            'product_package_ean' => $ltpTransferItem->product_package_ean,
            'product_name' => $ltpTransferItem->product_name,
            'original_quantity' => $ltpTransferItem->original_quantity,
            'product_unit' => $ltpTransferItem->product_unit,

            'created_at' => (string)$ltpTransferItem->created_at,
            'updated_at' => (string)$ltpTransferItem->updated_at,
            'deleted_at' => (string)$ltpTransferItem->deleted_at,
        ];
    }
}
