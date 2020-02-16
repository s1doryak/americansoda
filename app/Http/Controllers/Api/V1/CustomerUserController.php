<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Api\V1\Profile\GetProfileRequest;
use App\Services\Api\V1\CustomerUserService;
use Barryvdh\TranslationManager\Controller;
use Symfony\Component\HttpFoundation\Response;

class CustomerUserController extends Controller
{
    protected $prefix = 'api';
    protected $defaultMiddleware = 'api';

    /**
     * @param GetProfileRequest $request
     * @param CustomerUserService $service
     * @return \Illuminate\Http\JsonResponse
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function profile(GetProfileRequest $request, CustomerUserService $service)
    {
        return response()->json($service->getProfile(), Response::HTTP_OK);
    }
}
