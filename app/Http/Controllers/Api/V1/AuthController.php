<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Api\V1\Auth\SendTokenRequest;
use App\Services\Api\V1\CustomerUserService;
use Crmplease\MaterialAdmin\Routing\Controller;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    /**
     * @var string
     */
    protected $defaultMiddleware = 'api';

    /**
     * @var string
     */
    protected $prefix = 'api';

    public function sendToken(SendTokenRequest $request, CustomerUserService $customerUserService)
    {
        $customerUserService->sendAuthAttemptNotification(
            $request->input('email')
        );

        return response('', Response::HTTP_OK);
    }
}
