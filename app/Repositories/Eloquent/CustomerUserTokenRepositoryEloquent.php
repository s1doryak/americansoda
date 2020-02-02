<?php

namespace App\Repositories\Eloquent;

use App\CustomerUserToken;
use App\Repositories\Contracts\CustomerUserTokenRepository;

class CustomerUserTokenRepositoryEloquent extends \Crmplease\MaterialAdmin\Repositories\RepositoryEloquent implements CustomerUserTokenRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return CustomerUserToken::class;
    }
}
