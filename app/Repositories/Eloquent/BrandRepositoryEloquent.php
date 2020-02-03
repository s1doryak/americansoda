<?php

namespace App\Repositories\Eloquent;

use App\Brand;
use App\Repositories\Contracts\BrandRepository;

class BrandRepositoryEloquent extends \Crmplease\MaterialAdmin\Repositories\RepositoryEloquent implements BrandRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return Brand::class;
    }
}
