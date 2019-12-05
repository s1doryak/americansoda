<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Api\V1\Auth\SendTokenRequest;
use App\Mail\Api\V1\AuthToken;
use App\Services\Api\V1\AuthService;
use Crmplease\MaterialAdmin\Routing\Controller;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    protected $prefix = 'api';

    public function sendToken(SendTokenRequest $request, AuthService $authService)
    {
        $email = $request->input('email');
        $token = $authService->getOrCreateToken($email);

        return Mail::to($email)->send(new AuthToken($token));
    }
}