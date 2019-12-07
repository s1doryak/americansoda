<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Api\V1\Banner\GetRequest;
use App\Services\Api\V1\BannerService;
use Crmplease\MaterialAdmin\Routing\Controller;
use Symfony\Component\HttpFoundation\Response;

class BannersController extends Controller
{
    protected $prefix = 'api';

    public function get(GetRequest $request, BannerService $service)
    {
        $data = $service->getByShopId($request->route('shop_id'));

        return response()->json($data, Response::HTTP_OK);
    }
}