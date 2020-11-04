<?php

namespace App\Services\Api\V1;

use App\Repositories\Contracts\ProductTypeRepository;
use App\Repositories\Eloquent\ProductTypeRepositoryEloquent;
use Crmplease\MaterialAdmin\Services\ResourceService;
use Illuminate\Database\Eloquent\Collection;

class ProductTypeService extends ResourceService
{
    /**
     * @var ProductTypeRepositoryEloquent
     */
    protected $repository;

    /**
     * ProductTypeService constructor.
     * @param ProductTypeRepository $repository
     */
    public function __construct(
        ProductTypeRepository $repository
    )
    {
        $this->repository = $repository;
    }

    /**
     * @param integer $shopId
     * @param array $withCount
     * @return Collection|\Illuminate\Support\Collection
     */
    public function getByShopId($shopId, $withCount = [])
    {
        $nomenclature = $this->repository->getByShopId($shopId, $withCount);

        return $this->getOnlyIdsFromNomenclature($nomenclature)->values();
    }

    /**
     * @param Collection $nomenclature
     * @return Collection|\Illuminate\Support\Collection
     */
    protected function getOnlyIdsFromNomenclature(Collection $nomenclature)
    {
        return $nomenclature->map(function ($item) {
            return [
                'id' => $item->id,
                'productGroups' => $this->getOnlyIdsFromProductGroups($item->productGroups->sortBy('name'))->values()
            ];
        });
    }

    /**
     * @param Collection $productGroups
     * @return Collection|\Illuminate\Support\Collection
     */
    protected function getOnlyIdsFromProductGroups(Collection $productGroups)
    {
        return $productGroups->map(function ($productGroup) {
            return [
                'id' => $productGroup->id,
                'products' => $productGroup->products->pluck('id')->values(),
                'pricingPolicies' => $productGroup->pricingPolicies->pluck('id')->values(),
            ];
        });
    }
}
