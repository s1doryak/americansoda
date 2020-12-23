<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Api\V1\CustomerOrder\DownloadPdfRequest;
use App\Http\Requests\Api\V1\CustomerOrder\GetRequest;
use App\Services\Api\V1\CustomerOrderService;
use App\Services\Api\V1\CustomerPreOrderService;
use App\Transformers\Api\V1\CustomerPreOrderTransformer;
use Crmplease\MaterialAdmin\Routing\Controller;
use Symfony\Component\HttpFoundation\Response;

class CustomerOrdersController extends Controller
{
    protected $prefix = 'api';
    protected $defaultMiddleware = 'api';

    public function get(
        GetRequest $request,
        CustomerOrderService $service,
        CustomerPreOrderService $customerPreOrderService
    )
    {
        $shopId = $request->route('id');
        $customerOrders = $service->getByShopId($shopId);
        $customerPreOrders = $customerPreOrderService->getByShopId($shopId, true);
        $data = collect()
            ->concat($customerPreOrders)
            ->concat($customerOrders);

        return response()->json($data, Response::HTTP_OK);
    }

    public function downloadPdf(DownloadPdfRequest $request, CustomerOrderService $service)
    {
        return response()->download(
            $service->getPdfFile(
                $request->route('order_id')
            )
        );
    }
}
