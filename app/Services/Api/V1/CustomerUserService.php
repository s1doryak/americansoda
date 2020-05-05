<?php

namespace App\Services\Api\V1;

use App\CustomerUser;
use App\Notifications\Api\V1\AuthAttempt;
use App\Notifications\Api\V1\AuthAttemptFailed;
use App\Repositories\Eloquent\AdministratorRepositoryEloquent;
use App\Repositories\Eloquent\CustomerUserRepositoryEloquent;
use Crmplease\MaterialAdmin\Services\ResourceService;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Prettus\Repository\Exceptions\RepositoryException;
use Tymon\JWTAuth\Facades\JWTAuth;

class CustomerUserService extends ResourceService
{
    /**
     * @var CustomerUserRepositoryEloquent
     */
    protected $repository;

    /**
     * @var AdministratorRepositoryEloquent
     */
    protected $administratorRepository;

    public function __construct(
        CustomerUserRepositoryEloquent $repository,
        AdministratorRepositoryEloquent $administratorRepository
    )
    {
        $this->repository = $repository;
        $this->administratorRepository = $administratorRepository;
    }

    /**
     * @return Authenticatable
     * @throws RepositoryException
     */
    public function getProfile()
    {
        return $this->repository
            ->has('customers')
            ->has('customers.user')
            ->with(['customers' => function ($query) {
                /** @var QueryBuilder|EloquentBuilder $query */
                return $query->whereNull('deleted_at');
            }, 'customers.user'])
            ->firstWhere(['id' => Auth::id()]);
    }

    /**
     * @param string $email
     * @throws RepositoryException
     */
    public function sendAuthAttemptNotification($email)
    {
        /** @var CustomerUser $user */
        $user = $this->repository->firstWhere(['email' => $email]);

        if ($user) {
            $user->notify(
                new AuthAttempt($this->getOrCreateToken($user))
            );
        } else {
            $this->administratorRepository
                ->all()
                ->each(function ($administrator) use ($email) {
                    $administrator->notify(
                        new AuthAttemptFailed($email)
                    );
                });
            throw (new ModelNotFoundException)->setModel(CustomerUser::class);
        }

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
            $this->update(['token' => $token], $user->id);
        }

        return $token;
    }
}
