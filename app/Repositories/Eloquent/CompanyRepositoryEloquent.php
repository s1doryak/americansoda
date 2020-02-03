<?php

namespace App\Repositories\Eloquent;

use App\Company;
use App\Repositories\Contracts\CompanyRepository;

class CompanyRepositoryEloquent extends \Crmplease\MaterialAdmin\Repositories\RepositoryEloquent implements CompanyRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return Company::class;
    }
}
