<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Api\V1\Nomenclature\GetRequest;
use App\Services\Api\V1\ProductTypeService;
use Symfony\Component\HttpFoundation\Response;
use Crmplease\MaterialAdmin\Routing\Controller;

class ProductTypeController extends Controller
{
    protected $prefix = 'api';

    /**
     * @param GetRequest $request
     * @param ProductTypeService $service
     * @return \Illuminate\Http\JsonResponse
     */
    public function get(GetRequest $request, ProductTypeService $service)
    {
        $data = $service->getByShopId($request->route('id'));

        return response()->json($data, Response::HTTP_OK);
    }
}