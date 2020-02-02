<?php

namespace App\Repositories\Eloquent;

use App\CustomerType;
use App\Repositories\Contracts\CustomerTypeRepository;

class CustomerTypeRepositoryEloquent extends \Crmplease\MaterialAdmin\Repositories\RepositoryEloquent implements CustomerTypeRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return CustomerType::class;
    }
}
