<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Api\V1\ProductGroup\GetRequest;
use App\Services\Api\V1\ProductGroupService;
use Crmplease\MaterialAdmin\Routing\Controller;
use Symfony\Component\HttpFoundation\Response;

class ProductGroupController extends Controller
{
    protected $prefix = 'api';
    protected $defaultMiddleware = 'api';

    public function get(GetRequest $request, ProductGroupService $service)
    {
        $data = $service->getByShopId($request->route('id'), $request->query('ids'));

        return response()->json($data, Response::HTTP_OK);
    }
}