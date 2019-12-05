<?php

namespace App\Services\Api\V1;

use App\CustomerUser;
use App\Notifications\Api\V1\AuthAttempt;
use App\Services\CustomerUserService;
use Crmplease\MaterialAdmin\Services\EntityService;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthService extends EntityService
{
    protected $customerUserService;

    public function __construct()
    {
        $this->customerUserService = app(CustomerUserService::class);
    }

    public function sendAuthAttemptNotification($email)
    {
        $user = CustomerUser::where(['email' => $email])->firstOrFail();
        $token = $this->getOrCreateToken($user);
        $user->notify((new AuthAttempt($token)));
    }

    protected function getOrCreateToken(CustomerUser $user)
    {
        if (is_null($user->token)) {
            $token = JWTAuth::fromUser($user);
            $this->customerUserService->update(['token' => $token], $user->id);
        } else {
            $token = $user->token;
        }

        return $token;
    }
}