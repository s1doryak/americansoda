<?php

namespace App\Services\Api\V1;

use App\Repositories\Contracts\ProductRepository;
use App\Repositories\Eloquent\ProductRepositoryEloquent;
use Crmplease\MaterialAdmin\Services\ResourceService;

class ProductService extends ResourceService
{
    /**
     * @var ProductRepositoryEloquent
     */
    protected $repository;

    /**
     * ProductService constructor.
     * @param ProductRepository $repository
     */
    public function __construct(
        ProductRepository $repository
    )
    {
        $this->repository = $repository;
    }
}
