<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Api\V1\Auth\SendTokenRequest;
use App\Services\Api\V1\AuthService;
use Crmplease\MaterialAdmin\Routing\Controller;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    protected $prefix = 'api';

    public function sendToken(SendTokenRequest $request, AuthService $authService)
    {
        $authService->sendAuthAttemptNotification(
            $request->input('email')
        );

        return response('', Response::HTTP_OK);
    }
}
