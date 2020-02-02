<?php

namespace App\Repositories\Eloquent;

use App\PriceGroupBreakpoint;
use App\Repositories\Contracts\PriceGroupBreakpointRepository;

class PriceGroupBreakpointRepositoryEloquent extends \Crmplease\MaterialAdmin\Repositories\RepositoryEloquent implements PriceGroupBreakpointRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return PriceGroupBreakpoint::class;
    }
}
