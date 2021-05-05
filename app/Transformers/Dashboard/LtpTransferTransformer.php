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
            'sent_at' => $request->get('sent_at'),
            'warehouse' => $request->get('warehouse'),
            'comment' => $request->get('comment'),
            'owner_reference' => $request->get('owner_reference'),
            'invoicing_reference' => $request->get('invoicing_reference'),
            'seller_info' => $request->get('seller_info'),
            'delivery_route' => $request->get('delivery_route'),
            'delivery_route_load' => $request->get('delivery_route_load'),
            'delivery_drop' => $request->get('delivery_drop'),
            'delivery_terminal_info' => $request->get('delivery_terminal_info'),
            'weight' => $request->get('weight'),
            'volume' => $request->get('volume'),
            'document_party_type' => $request->get('document_party_type'),
            'code' => $request->get('code'),
            'name' => $request->get('name'),
            'address' => $request->get('address'),
            'zip' => $request->get('zip'),
            'city' => $request->get('city'),
            'region' => $request->get('region'),
            'country' => $request->get('country'),
            'information' => $request->get('information'),
            'iln' => $request->get('iln'),
            'edi_identifier' => $request->get('edi_identifier'),
            'email' => $request->get('email'),
            'phone' => $request->get('phone'),

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
            'sent_at' => $request->get('sent_at'),
            'warehouse' => $request->get('warehouse'),
            'comment' => $request->get('comment'),
            'owner_reference' => $request->get('owner_reference'),
            'invoicing_reference' => $request->get('invoicing_reference'),
            'seller_info' => $request->get('seller_info'),
            'delivery_route' => $request->get('delivery_route'),
            'delivery_route_load' => $request->get('delivery_route_load'),
            'delivery_drop' => $request->get('delivery_drop'),
            'delivery_terminal_info' => $request->get('delivery_terminal_info'),
            'weight' => $request->get('weight'),
            'volume' => $request->get('volume'),
            'document_party_type' => $request->get('document_party_type'),
            'code' => $request->get('code'),
            'name' => $request->get('name'),
            'address' => $request->get('address'),
            'zip' => $request->get('zip'),
            'city' => $request->get('city'),
            'region' => $request->get('region'),
            'country' => $request->get('country'),
            'information' => $request->get('information'),
            'iln' => $request->get('iln'),
            'edi_identifier' => $request->get('edi_identifier'),
            'email' => $request->get('email'),
            'phone' => $request->get('phone'),

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
            'requested_delivery_timestamp' => $ltpTransfer->requested_delivery_timestamp,
            'document_date' => $ltpTransfer->document_date,
            'warehouse' => $ltpTransfer->warehouse,
            'comment' => $ltpTransfer->comment,
            'owner_reference' => $ltpTransfer->owner_reference,
            'invoicing_reference' => $ltpTransfer->invoicing_reference,
            'seller_info' => $ltpTransfer->seller_info,
            'delivery_route' => $ltpTransfer->delivery_route,
            'delivery_route_load' => $ltpTransfer->delivery_route_load,
            'delivery_drop' => $ltpTransfer->delivery_drop,
            'delivery_class' => $ltpTransfer->delivery_class,
            'delivery_terminal_info' => $ltpTransfer->delivery_terminal_info,
            'weight' => $ltpTransfer->weight,
            'volume' => $ltpTransfer->volume,

            'document_party_type' => $ltpTransfer->document_party_type,
            'code' => $ltpTransfer->code,
            'name' => $ltpTransfer->name,
            'address' => $ltpTransfer->address,
            'zip' => $ltpTransfer->zip,
            'city' => $ltpTransfer->city,
            'region' => $ltpTransfer->region,
            'country' => $ltpTransfer->country,
            'information' => $ltpTransfer->information,
            'iln' => $ltpTransfer->iln,
            'edi_identifier' => $ltpTransfer->edi_identifier,
            'email' => $ltpTransfer->email,
            'phone' => $ltpTransfer->phone,

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
