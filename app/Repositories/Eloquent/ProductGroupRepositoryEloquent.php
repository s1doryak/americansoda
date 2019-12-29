<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\ProductGroupRepository;
use App\Transformers\Api\V1\ProductGroupTransformer;

class ProductGroupRepositoryEloquent extends \Crmplease\MaterialAdmin\Repositories\RepositoryEloquent implements ProductGroupRepository
{
    /**
     * @param $id
     * @return mixed
     */
    public function getGroupsByCustomerId($id)
    {
        $criteria = function ($query) use ($id) {
            /** @var \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder $query */
            $query->where('customer_pricing_policies.customer_id', $id)->orderBy('products_range');
        };

        return $this->with(['pricingPolicies' => $criteria])->all();
    }

    public function getByShopId($shopId, $ids = [])
    {
        $query = $this->whereHas('pricingPolicies', function ($query) use ($shopId) {
            return $query->where('customer_pricing_policies.customer_id', $shopId);
        });

        $where = ['deleted_at' => null];

        if ($ids) {
            $where['ids'] = $ids;
        }

        $result = $query->findWhere($where);

        return $result->map(function ($productGroup) {
            return ProductGroupTransformer::toArray($productGroup);
        });
    }
}
