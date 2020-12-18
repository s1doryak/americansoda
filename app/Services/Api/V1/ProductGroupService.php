<?php

namespace App\Services\Api\V1;

use App\ProductGroup;
use App\Repositories\Contracts\ProductGroupRepository;
use App\Repositories\Eloquent\ProductGroupRepositoryEloquent;
use Crmplease\MaterialAdmin\Services\ResourceService;

class ProductGroupService extends ResourceService
{
    /**
     * @var ProductGroupRepositoryEloquent
     */
    protected $repository;

    /**
     * ProductGroupService constructor.
     * @param ProductGroupRepository $repository
     */
    public function __construct(
        ProductGroupRepository $repository
    )
    {
        $this->repository = $repository;
    }

    public function productGroupInfo(int $productGroup)
    {
        /** @var ProductGroup $productGroup */
        $productGroup = $this->repository->firstWhere(['id' => $productGroup]);

        return [
            'image' => (string)$productGroup->image ? asset($productGroup->image->getByDimension('image')) : null,
            'info' => $productGroup->info,
            'banner' => (string)$productGroup->banner ? asset($productGroup->banner->getByDimension('banner')) : null,
        ];
    }
}
