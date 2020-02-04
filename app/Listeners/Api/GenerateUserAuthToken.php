<?php

namespace App\Listeners\Api;

use App\CustomerUser;
use Crmplease\MaterialAdmin\Events\ResourceStored;
use Crmplease\MaterialAdmin\Events\Traits\ValidatesNamespace;
use Crmplease\MaterialAdmin\Events\Traits\ValidatesResource;
use Tymon\JWTAuth\Facades\JWTAuth;

class GenerateUserAuthToken
{
    use ValidatesResource, ValidatesNamespace;

    public function handle(ResourceStored $event)
    {
        if (!$this->isValidNamespace($event->getNamespace())) {
            return;
        }

        if (!$this->isValidResource($event->getResource())) {
            return;
        }

        $attributes = $event->getAttributes();
        $user = CustomerUser::find($attributes['id']);
        $user->token = JWTAuth::fromUser($user);
        $user->save();

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