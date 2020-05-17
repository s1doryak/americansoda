<?php

namespace App\Listeners\Api;

use App\CustomerUser;
use App\Repositories\Contracts\CustomerUserRepository;
use App\Repositories\Eloquent\CustomerUserRepositoryEloquent;
use Crmplease\MaterialAdmin\Events\Interfaces\ResourceEventInterface;
use Crmplease\MaterialAdmin\Events\ResourceTrashed;
use Crmplease\MaterialAdmin\Events\Traits\ValidatesNamespace;
use Crmplease\MaterialAdmin\Events\Traits\ValidatesResource;
use Tymon\JWTAuth\Facades\JWTAuth;

class GenerateUserAuthToken
{
    use ValidatesResource, ValidatesNamespace;

    /**
     * @var CustomerUserRepositoryEloquent
     */
    protected $customerUsers;

    /**
     * GenerateUserAuthToken constructor.
     * @param CustomerUserRepository $customerUsers
     */
    public function __construct(CustomerUserRepository $customerUsers)
    {
        $this->customerUsers = $customerUsers;
    }

    public function handle(ResourceEventInterface $event)
    {
        if (!$this->isValidNamespace($event->getNamespace())) {
            return;
        }

        if (!$this->isValidResource($event->getResource())) {
            return;
        }

        $attributes = $event->getAttributes();

        /** @var CustomerUser|null $customerUser */
        $customerUser = $this->customerUsers->scopeQuery(function ($query) {
            return $query->withTrashed();
        })->find($attributes['id']);

        if ($customerUser) {
            if ($event instanceof ResourceTrashed) {
                $customerUser->token = null;
            } else {
                $customerUser->token = null;
                $customerUser->token = JWTAuth::fromUser($customerUser);
            }

            $customerUser->save();
        }

        return;
    }

    /**
     * @return array
     */
    protected function getValidNamespaces()
    {
        return [
            'api',
            'dashboard'
        ];
    }

    /**
     * @return array
     */
    protected function getValidResources()
    {
        return [
            'customer_user',
        ];
    }
}
