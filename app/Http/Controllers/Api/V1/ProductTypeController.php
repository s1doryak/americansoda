<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Api\V1\Nomenclature\NomenclatureRequest;
use App\Http\Requests\Api\V1\Nomenclature\NomenclatureActionRequest;
use App\Http\Requests\Api\V1\ProductType\GetRequest;
use App\Services\Api\V1\ProductService;
use App\Services\Api\V1\ProductTypeService;
use Symfony\Component\HttpFoundation\Response;
use Crmplease\MaterialAdmin\Routing\Controller;

class ProductTypeController extends Controller
{
    protected $prefix = 'api';
    protected $defaultMiddleware = 'api';

    /**
     * @param NomenclatureRequest $request
     * @param ProductTypeService $service
     * @return \Illuminate\Http\JsonResponse
     */
    public function nomenclature(NomenclatureRequest $request, ProductTypeService $service)
    {
        $data = $service->getByShopId($request->route('id'), $request->input('with_count'));

        return response()->json($data, Response::HTTP_OK);
    }

    public function get(GetRequest $request, ProductTypeService $service)
    {
        $data = $service->getCleanByShopId($request->route('id'), $request->query('ids'));

        return response()->json($data->values(), Response::HTTP_OK);
    }

    public function nomenclatureAction(NomenclatureActionRequest $request, ProductService $service)
    {
        $data = $service->getActionProducts($request->route('id'));

        return response()->json($data, Response::HTTP_OK);
    }
}
