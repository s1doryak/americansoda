<?php

namespace App\Listeners\Api;

use App\CustomerUser;
use Crmplease\MaterialAdmin\Events\ResourceStored;
use Tymon\JWTAuth\Facades\JWTAuth;

class GenerateUserAuthToken
{
    public function handle(ResourceStored $event)
    {
        $attributes = $event->getAttributes();
        $user = CustomerUser::find($attributes['id']);
        $user->token = JWTAuth::fromUser($user);
        $user->save();

        return;
    }

}