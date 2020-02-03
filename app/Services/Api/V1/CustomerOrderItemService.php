<?php

namespace App\Services\Api\V1;

use App\Repositories\Contracts\CustomerOrderItemRepository;
use App\Repositories\Eloquent\CustomerOrderItemRepositoryEloquent;
use Crmplease\MaterialAdmin\Services\ResourceService;

class CustomerOrderItemService extends ResourceService
{
    /**
     * @var CustomerOrderItemRepositoryEloquent
     */
    protected $repository;

    /**
     * @param CustomerOrderItemRepository $customerOrderItemRepository
     */
    public function __construct(
        CustomerOrderItemRepository $customerOrderItemRepository
    )
    {
        $this->repository = $customerOrderItemRepository;
    }
}
