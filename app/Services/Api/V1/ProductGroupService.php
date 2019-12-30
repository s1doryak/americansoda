<?php

namespace App\Services\Api\V1;

use App\Repositories\Contracts\ProductGroupRepository;
use App\Repositories\Eloquent\ProductGroupRepositoryEloquent;
use Crmplease\MaterialAdmin\Services\ResourceService;

class ProductGroupService extends ResourceService
{
    /**
     * @var ProductGroupRepositoryEloquent
     */
    protected $repository;

    public function __construct()
    {
        $this->setRepository(ProductGroupRepository::class);
    }
}
