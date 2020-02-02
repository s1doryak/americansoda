<?php

namespace App\Repositories\Eloquent;

use App\Region;
use App\Repositories\Contracts\RegionRepository;

class RegionRepositoryEloquent extends \Crmplease\MaterialAdmin\Repositories\RepositoryEloquent implements RegionRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return Region::class;
    }
}
