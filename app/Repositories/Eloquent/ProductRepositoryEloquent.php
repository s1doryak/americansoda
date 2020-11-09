<?php

namespace App\Repositories\Eloquent;

use App\CustomerUserSubscribe;
use App\Product;
use App\Repositories\Contracts\ProductRepository;
use App\Transformers\Api\V1\ProductTransformer;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class ProductRepositoryEloquent extends \Crmplease\MaterialAdmin\Repositories\RepositoryEloquent implements ProductRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return Product::class;
    }

    public function getByShopId($shopId, $customerUserId = null, $productIds = [])
    {
        $customerUserId = (is_null($customerUserId)) ? Auth::id() : $customerUserId;
        $this->scopeQuery($this->scopeQueryForProducts($shopId, $customerUserId));
        $result = ($productIds) ? $this->findWhereIn('products.id', $productIds) : $this->get();

        return $result
            ->map(function ($product) {
                return ProductTransformer::toArray($product);
            })
            ->sortBy('name');
    }

    public function getActionProducts($shopId)
    {
        $this->scopeQuery($this->scopeQueryForProducts($shopId, Auth::id()));
        $this->scopeQuery(function ($query) {
            /** @var \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder $query */
            return $query
                ->where('action', true)
                ->orderBy('name');
        });

        return $this
            ->all()
            ->pluck('id');

    }

    protected function scopeQueryForProducts($shopId, $customerUserId)
    {
        return function ($query) use ($shopId, $customerUserId) {
            /** @var \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder $query */
            return $query
                ->distinct()
                ->select('products.*')
                ->join(
                    'customer_pricing_policies',
                    'customer_pricing_policies.product_group_id',
                    '=',
                    'products.product_group_id'
                )
                ->join(
                    'customer_user_customer',
                    'customer_user_customer.customer_id',
                    '=',
                    'customer_pricing_policies.customer_id'
                )
                ->where('customer_user_customer.customer_user_id', '=', $customerUserId)
                ->whereIn('customer_pricing_policies.customer_id', Arr::wrap($shopId))
                ->where('customer_pricing_policies.price', '>', '0.00')
                ->where('customer_pricing_policies.products_range', '>', 0)
                ->whereNull('customer_pricing_policies.deleted_at');
        };
    }
}
