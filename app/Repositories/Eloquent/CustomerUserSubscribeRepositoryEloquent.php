<?php

namespace App\Repositories\Eloquent;

use App\CustomerUserSubscribe;
use App\Repositories\Contracts\CustomerUserSubscribeRepository;

/**
 * Class CustomerUserNotificationRepositoryEloquent
 * @package App\Repositories\Eloquent
 */
class CustomerUserSubscribeRepositoryEloquent extends \Crmplease\MaterialAdmin\Repositories\RepositoryEloquent implements CustomerUserSubscribeRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return CustomerUserSubscribe::class;
    }
}
