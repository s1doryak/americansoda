<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Auth\AuthRequest;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Crmplease\MaterialAdmin\Routing\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ApiAuthController extends Controller
{
    protected $prefix = 'api';

    public function sendEmail(AuthRequest $request)
    {

    }

    public function auth(AuthRequest $request)
    {
        if (!$request->acceptsJson() || !$request->expectsJson()) {
            throw new NotFoundHttpException();
        }

        $credentials = $request->only('email', 'password');

        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        return response()->json(compact('token'));
    }

}