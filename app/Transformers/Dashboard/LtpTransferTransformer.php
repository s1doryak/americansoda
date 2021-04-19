<?php

namespace App\Transformers\Dashboard;

use App\LtpTransfer;
use App\LtpTransferItem;
use Crmplease\MaterialAdmin\Http\Requests\Request;
use Crmplease\MaterialAdmin\Transformers\Contracts\TransformerContract;
use Crmplease\MaterialAdmin\Transformers\Traits\Collector;

/**
 * LtpTransferTransformer transformer
 *
 * @package App\Transformers\Dashboard
 */
class LtpTransferTransformer implements TransformerContract
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
     * @param LtpTransfer $ltpTransfer
     * @return array
     */
    public static function toArray($ltpTransfer)
    {
        return [
            'id' => (int)$ltpTransfer->getKey(),
            'document_type' => $ltpTransfer->document_type,
            'document_number' => $ltpTransfer->document_number,
            'requested_delivery_date' => $ltpTransfer->requested_delivery_date,

            'items' => $ltpTransfer->items ? LtpTransferItemTransformer::map($ltpTransfer->items) : [],
            'created_at' => (string)$ltpTransfer->created_at,
            'updated_at' => (string)$ltpTransfer->updated_at,
            'deleted_at' => (string)$ltpTransfer->deleted_at,
        ];
    }

    /**
     * @param LtpTransfer $ltpTransfer
     * @return array
     */
    public static function toLtpXml(LtpTransfer $ltpTransfer)
    {
        $xmlData = [
            'Document' => [
                'DocumentType' => $ltpTransfer->document_type,
                'DocumentNumber' => $ltpTransfer->document_number,
                'RequestedDeliveryDate' => $ltpTransfer->requested_delivery_date,
                'DocumentDate' => $ltpTransfer->created_at,
                'DocumentParty' => [
                    'DocumentPartyType' => 'Delivery',
                    'Code' => $ltpTransfer->code,
                    'Name' => $ltpTransfer->name,
                    'Address' => $ltpTransfer->address,
                    'Zip' => $ltpTransfer->zip,
                    'City' => $ltpTransfer->city,
                ],
            ],
        ];

        /** @var LtpTransferItem $item */
        foreach ($ltpTransfer->items as $item) {
            $xmlData['Document']['DocumentLine'][] = [
                'ClientPurchaseOrder' => $item->client_purchase_order,
                'ClientPurchaseOrderLine' => $item->client_purchase_order_line,
                'ProductCode' => $item->product_code,
                'ProductEan' => $item->product_ean,
                'ProductPackageEan' => $item->product_package_ean,
                'ProductName' => $item->product_name,
                'OriginalQuantity' => $item->original_quantity,
                'ProductUnit' => $item->product_unit,
            ];
        }

        return $xmlData;
    }
}
