<?php

namespace App\Services\Api\V1;

use App\CustomerUser;
use App\Notifications\Api\V1\AuthAttempt;
use Crmplease\MaterialAdmin\Services\ResourceService;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthService extends ResourceService
{
    protected $customerUserService;

    public function __construct()
    {
        $this->customerUserService = app(CustomerUserService::class);
    }

    /**
     * @param string $email
     */
    public function sendAuthAttemptNotification($email)
    {
        /** @var CustomerUser $user */
        $user = CustomerUser::where(['email' => $email])->firstOrFail();

        $user->notify(
            new AuthAttempt($this->getOrCreateToken($user))
        );
    }

    /**
     * @param CustomerUser $user
     * @return string
     */
    protected function getOrCreateToken(CustomerUser $user)
    {
        $token = $user->token;

        if (is_null($token)) {
            $token = JWTAuth::fromUser($user);
            $this->customerUserService->update(['token' => $token], $user->id);
        }

        return $token;
    }
}
