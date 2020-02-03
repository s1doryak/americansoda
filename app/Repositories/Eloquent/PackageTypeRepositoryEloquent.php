<?php

namespace App\Repositories\Eloquent;

use App\PackageType;
use App\Repositories\Contracts\PackageTypeRepository;

class PackageTypeRepositoryEloquent extends \Crmplease\MaterialAdmin\Repositories\RepositoryEloquent implements PackageTypeRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return PackageType::class;
    }
}
