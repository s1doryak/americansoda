<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Api\V1\PricingPolicy\GetRequest;
use App\Services\Api\V1\CustomerPricingPolicyService;
use Crmplease\MaterialAdmin\Routing\Controller;
use Symfony\Component\HttpFoundation\Response;

class PricingPolicyController extends Controller
{
    protected $prefix = 'api';

    public function get(GetRequest $request, CustomerPricingPolicyService $service)
    {
        $data = $service->getByShopId($request->route('id'), $request->query('ids'));

        return response()->json($data, Response::HTTP_OK);
    }
}