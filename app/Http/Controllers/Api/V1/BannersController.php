<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Api\V1\Banner\GetRequest;
use App\Repositories\Eloquent\BannerRepositoryEloquent;
use App\Services\Api\V1\BannerService;
use Crmplease\MaterialAdmin\Routing\Controller;
use Symfony\Component\HttpFoundation\Response;

class BannersController extends Controller
{
    protected $prefix = 'api';

    /**
     * @param GetRequest $request
     * @param BannerService|BannerRepositoryEloquent $service
     * @return \Illuminate\Http\JsonResponse
     */
    public function get(GetRequest $request, BannerService $service)
    {
        $data = $service->getByShopId($request->route('id'));

        return response()->json($data, Response::HTTP_OK);
    }
}
