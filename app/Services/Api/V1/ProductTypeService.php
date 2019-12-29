<?php

namespace App\Services\Api\V1;

use App\Repositories\Eloquent\ProductTypeRepositoryEloquent;
use Crmplease\MaterialAdmin\Services\ResourceService;
use Illuminate\Database\Eloquent\Collection;

class ProductTypeService extends ResourceService
{
    public function __construct()
    {
        $this->setRepository(ProductTypeRepositoryEloquent::class);
    }

    public function getByShopId($shopId, $withCount = [])
    {
        $nomenclature = $this->repository->getByShopId($shopId, $withCount);

        return $this->getOnlyIdsFromNomenclature($nomenclature)->values();
    }

    protected function getOnlyIdsFromNomenclature(Collection $nomenclature)
    {
        return $nomenclature->map(function ($item) {
            $item->productGroups = $this->getOnlyIdsFromProductGroups($item->productGroups);

            return $item;
        });
    }

    protected function getOnlyIdsFromProductGroups(Collection $productGroups)
    {
        return $productGroups->map(function ($productGroup) {
            $productGroup->products = $productGroup->products->pluck('id');
            $productGroup->pricingPolicies = $productGroup->pricingPolicies->pluck('id');

            return $productGroup;
        });
    }
}