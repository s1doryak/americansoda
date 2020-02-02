<?php

namespace App\Repositories\Eloquent;

use App\ProductTag;
use App\Repositories\Contracts\ProductTagRepository;

class ProductTagRepositoryEloquent extends \Crmplease\MaterialAdmin\Repositories\RepositoryEloquent implements ProductTagRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return ProductTag::class;
    }
}
