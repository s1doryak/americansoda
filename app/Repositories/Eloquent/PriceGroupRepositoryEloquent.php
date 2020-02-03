<?php

namespace App\Repositories\Eloquent;

use App\PriceGroup;
use App\Repositories\Contracts\PriceGroupRepository;

class PriceGroupRepositoryEloquent extends \Crmplease\MaterialAdmin\Repositories\RepositoryEloquent implements PriceGroupRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return PriceGroup::class;
    }
}
