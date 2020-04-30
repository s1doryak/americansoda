<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Api\V1\Product\GetRequest;
use App\Services\Api\V1\ProductService;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ProductController
{
    protected $prefix = 'api';
    protected $defaultMiddleware = 'api';

    public function get(GetRequest $request, ProductService $service)
    {
        $data = $service->getByShopId($request->route('id'), Auth::id(), $request->query('ids'));

        return response()->json($data->values(), Response::HTTP_OK);
    }
}