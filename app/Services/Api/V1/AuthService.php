<?php

namespace App\Services\Api\V1;

use App\CustomerUser;
use App\Notifications\Api\V1\AuthAttempt;
use App\Repositories\Contracts\CustomerUserRepository;
use Crmplease\MaterialAdmin\Services\ResourceService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthService extends ResourceService
{
    /**
     * @var CustomerUserRepository
     */
    protected $repository;
    /**
     * @var CustomerUserService
     */
    protected $customerUserService;

    public function __construct(
        CustomerUserRepository $customerUserRepository,
        CustomerUserService $customerUserService
    )
    {
        $this->repository = $customerUserRepository;
        $this->customerUserService = $customerUserService;
    }

    /**
     * @param string $email
     */
    public function sendAuthAttemptNotification($email)
    {
        /** @var CustomerUser $user */
        $user = $this->repository->firstWhere(['email' => $email]);

        if ($user) {
            $user->notify(
                new AuthAttempt($this->getOrCreateToken($user))
            );
        }

        throw (new ModelNotFoundException)->setModel(CustomerUser::class);
    }

    /**
     * @param CustomerUser $user
     * @return string
     */
    protected function getOrCreateToken(CustomerUser $user)
    {
        $token = $user->token;

        if (empty($token)) {
            $token = JWTAuth::fromUser($user);
            $this->customerUserService->update(['token' => $token], $user->id);
        }

        return $token;
    }
}
