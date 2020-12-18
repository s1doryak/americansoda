<?php

namespace App\Repositories\Eloquent;

use App\ProductGroup;
use App\Repositories\Contracts\ProductGroupRepository;
use App\Transformers\Api\V1\ProductGroupTransformer;

class ProductGroupRepositoryEloquent extends \Crmplease\MaterialAdmin\Repositories\RepositoryEloquent implements ProductGroupRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return ProductGroup::class;
    }

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

        $result = $query
            ->orderBy('name')
            ->findWhere($where);

        return $result
            ->map(function (ProductGroup  $productGroup) {
                return[
                    'id' => (int)$productGroup->getKey(),
                    'name' => $productGroup->name,
                    'vat' => (integer)$productGroup->vat,
                    'sales_unit_volume' => (integer)$productGroup->sales_unit_volume,
                    'product_type_id' => $productGroup->productType ? $productGroup->productType->id : null,
                    'created_at' => (string)$productGroup->created_at,
                    'updated_at' => (string)$productGroup->updated_at,
                    'deleted_at' => (string)$productGroup->deleted_at,
                ];
            });
    }
}
