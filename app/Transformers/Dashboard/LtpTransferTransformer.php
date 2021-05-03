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
            'requested_delivery_timestamp' => $request->get('requested_delivery_timestamp'),

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
            'requested_delivery_timestamp' => $request->get('requested_delivery_timestamp'),

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
        $shipment = $ltpTransfer->customerShipment;
        $deliveryTimestamp = null;
        $documentNumber = in_array(config('app.env'), ['prod', 'production'])
            ? $ltpTransfer->document_number
            : "TEST-{$ltpTransfer->document_number}";

        if ($ltpTransfer->requested_delivery_timestamp && $time = explode(':', $ltpTransfer->requested_delivery_timestamp)) {
            $deliveryTimestamp = $ltpTransfer->requested_delivery_date
                ->copy()
                ->addMinutes($time[0] * 60 + $time[1])
                ->toDateTimeString();
        }

        $documentParty = [
            'DocumentPartyType' => $ltpTransfer->document_party_type,
            'Code' => $ltpTransfer->code,
            'Name' => $ltpTransfer->name,
            'Address' => $ltpTransfer->address,
            'Zip' => $ltpTransfer->zip,
            'City' => $ltpTransfer->city,
            'Region' => $ltpTransfer->region,
            'Country' => $ltpTransfer->country,
            'Information' => $ltpTransfer->information,
            'ILN' => $ltpTransfer->iln,
            'EdiIdentifier' => $ltpTransfer->edi_identifier,
            'Email' => $ltpTransfer->email,
            'Phone' => $ltpTransfer->phone,
        ];
        $document = [
            'DocumentType' => $ltpTransfer->document_type,
            'DocumentNumber' => $documentNumber,
            'RequestedDeliveryDate' => $ltpTransfer->requested_delivery_date->format('Y-m-d'),
            'RequestedDeliveryTimestamp' => $deliveryTimestamp,
            'DocumentDate' => $ltpTransfer->document_date,
            'Warehouse' => $ltpTransfer->warehouse,
            'Comment' => $ltpTransfer->comment,
            'OwnerReference' => $ltpTransfer->owner_reference,
            'InvoicingReference' => $ltpTransfer->invoicing_reference,
            'SellerInfo' => $ltpTransfer->seller_info,
            'DeliveryRoute' => $ltpTransfer->delivery_route,
            'DeliveryRouteLoad' => $ltpTransfer->delivery_route_load,
            'DeliveryDrop' => $ltpTransfer->delivery_drop,
            'DeliveryClass' => $ltpTransfer->delivery_class,
            'DeliveryTerminalInfo' => $ltpTransfer->delivery_terminal_info,
            'Weight' => $ltpTransfer->weight,
            'Volume' => $ltpTransfer->volume,
            'DocumentParty' => array_filter($documentParty),
        ];

        if ($packageType = $shipment->packageType) {
            $document['AdditionalHeaderReference'][] = [
                'KeyString' => 'PackageType',
                'ValueString' => $packageType->name,
            ];
        }

        $document['AdditionalHeaderReference'][] = [
            'KeyString' => 'PackagesQuantity',
            'ValueString' => $shipment->packages_quantity,
        ];
        $xmlData = [
            'Document' => array_filter($document)
        ];

        /** @var LtpTransferItem $item */
        foreach ($ltpTransfer->items as $item) {
            $documentLine = [
                'ProductCode' => $item->product_code,
                'ProductEan' => $item->product_ean,
                'ProductPackageEan' => $item->product_package_ean,
                'ProductName' => $item->product_name,
                'OriginalQuantity' => $item->original_quantity,
                'ProductUnit' => $item->product_unit,
                'PricePreUnit' => $item->price_per_unit,
                'PricePreUnitWithTax' => $item->price_per_unit_with_tax,
                'VatRate' => $item->vat_rate,
                'QuantityInSellingUnit' => $item->quantity_in_selling_unit,
                'SellingUnit' => $item->selling_unit,
                'Warehouse' => $item->warehouse,
                'NetWeightUnit' => $item->net_weight_unit,
            ];
            $xmlData['Document']['DocumentLine'][] = array_filter($documentLine);
        }

        return $xmlData;
    }
}
