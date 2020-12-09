<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Api\V1\Profile\GetProfileRequest;
use App\Services\Api\V1\CustomerUserService;
use Crmplease\MaterialAdmin\Routing\Controller;
use Symfony\Component\HttpFoundation\Response;

class CustomerUserController extends Controller
{
    protected $prefix = 'api';
    protected $defaultMiddleware = 'api';

    public function __construct()
    {
        parent::__construct();

        $this->middleware('auth.log', ['only' => 'profile']);
    }

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
