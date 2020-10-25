<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Api\V1\Setting\GetRequest;
use App\Services\Api\V1\SettingService;
use Crmplease\MaterialAdmin\Routing\Controller;
use Symfony\Component\HttpFoundation\Response;

class SettingsController  extends Controller
{
    protected $prefix = 'api';
    protected $defaultMiddleware = 'api';

    /**
     * @param GetRequest $request
     * @param SettingService $service
     * @return \Illuminate\Http\JsonResponse
     */
    public function get(GetRequest $request, SettingService $service)
    {
        $name = $request->query('name');
        $data = $name
            ? $service->firstWhere(compact('name'))
            : $service->all();

        return response()->json($data, Response::HTTP_OK);
    }
}
