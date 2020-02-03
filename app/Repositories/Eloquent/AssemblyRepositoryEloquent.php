<?php

namespace App\Repositories\Eloquent;

use App\Assembly;
use App\Repositories\Contracts\AssemblyRepository;

class AssemblyRepositoryEloquent extends \Crmplease\MaterialAdmin\Repositories\RepositoryEloquent implements AssemblyRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return Assembly::class;
    }
}
