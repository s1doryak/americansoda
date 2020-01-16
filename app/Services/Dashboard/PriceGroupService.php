<?php

namespace App\Services\Dashboard;

use App\Repositories\Contracts\PriceGroupRepository;
use App\Repositories\Eloquent\PriceGroupRepositoryEloquent;
use Crmplease\MaterialAdmin\Services\ResourceService;

class PriceGroupService extends ResourceService
{
    /**
     * @var PriceGroupRepositoryEloquent
     */
    protected $repository;

    /**
     * @param PriceGroupRepository $priceGroupRepository
     */
    public function __construct(
        PriceGroupRepository $priceGroupRepository
    )
    {
        $this->repository = $priceGroupRepository;
    }
}
