<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Api\V1\CustomerShipment\DownloadPdfRequest;
use App\Http\Requests\Api\V1\CustomerShipment\GetRequest;
use App\Services\Api\V1\CustomerShipmentService;
use Crmplease\MaterialAdmin\Routing\Controller;
use Symfony\Component\HttpFoundation\Response;

class CustomerShipmentsController extends Controller
{
    protected $prefix = 'api';
    protected $defaultMiddleware = 'api';

    public function get(GetRequest $request, CustomerShipmentService $service)
    {
        $data = $service->getByShopId($request->route('id'));

        return response()->json($data, Response::HTTP_OK);
    }

    public function downloadWaybill(DownloadPdfRequest $request, CustomerShipmentService $service)
    {
        return response()->download(
            $service->getPdfFile(
                $request->route('shipment_id')
            )
        );
    }
}
