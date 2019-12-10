<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Api\V1\CustomerOrder\GetRequest;
use App\Services\Api\V1\CustomerOrderService;
use Crmplease\MaterialAdmin\Routing\Controller;
use Symfony\Component\HttpFoundation\Response;

class CustomerOrdersController extends Controller
{
    protected $prefix = 'api';

    public function get(GetRequest $request, CustomerOrderService $service)
    {
        $data = $service->getByShopId($request->route('id'));

        return response()->json($data, Response::HTTP_OK);
    }
}