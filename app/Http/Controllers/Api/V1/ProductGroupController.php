<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Api\V1\ProductGroup\GetRequest;
use App\Http\Requests\Api\V1\ProductGroup\SearchRequest;
use App\Services\Api\V1\ProductGroupService;
use Crmplease\MaterialAdmin\Routing\Controller;
use Symfony\Component\HttpFoundation\Response;

class ProductGroupController extends Controller
{
    protected $prefix = 'api';
    protected $defaultMiddleware = 'api';

    public function search(SearchRequest $request, ProductGroupService $service)
    {
        $data = $service->getByShopId($request->route('id'), $request->query('ids'));

        return response()->json($data, Response::HTTP_OK);
    }

    public function get(GetRequest $request, ProductGroupService $service)
    {
        $data = $service->getProductGroupInfo($request->route('product_group'));

        return response()->json($data, Response::HTTP_OK);
    }
}
