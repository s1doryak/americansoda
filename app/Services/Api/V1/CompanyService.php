<?php

namespace App\Services\Api\V1;

use App\Repositories\Contracts\CompanyRepository;
use App\Repositories\Eloquent\CompanyRepositoryEloquent;
use Crmplease\MaterialAdmin\Services\ResourceService;

class CompanyService extends ResourceService
{
    /**
     * @var CompanyRepositoryEloquent
     */
    protected $repository;

    /**
     * @param CompanyRepository $companyRepository
     */
    public function __construct(
        CompanyRepository $companyRepository
    )
    {
        $this->repository = $companyRepository;
    }
}
