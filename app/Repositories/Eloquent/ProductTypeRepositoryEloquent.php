<?php

namespace App\Repositories\Eloquent;

use App\ProductType;
use App\Repositories\Contracts\ProductTypeRepository;
use App\Transformers\Api\V1\ProductTypeTransformer;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;

class ProductTypeRepositoryEloquent extends \Crmplease\MaterialAdmin\Repositories\RepositoryEloquent implements ProductTypeRepository
{
    protected $productRepository;

    /**
     * @return string
     */
    public function model()
    {
        return ProductType::class;
    }

    public function __construct(Application $app)
    {
        parent::__construct($app);

        $this->productRepository = app(ProductRepositoryEloquent::class);
    }

    /**
     * @param $shopId
     * @param array $withCount
     * @return mixed
     */
    public function getByShopId($shopId, $withCount = [])
    {
        return $this
            ->whereHas('productGroups', function ($query) use ($shopId) {
                return $query
                    ->has('products')
                    ->whereHas('pricingPolicies', function ($q) use ($shopId) {
                        return $q
                            ->where('customer_id', $shopId);
                    });
            })
            ->with([
                'productGroups' => function ($query) use ($withCount, $shopId) {
                    return $query
                        ->select('id', 'product_type_id')
                        ->whereHas('products', function ($q) use ($shopId) {
                            return $q->whereNull('deleted_at');
                        })
                        ->with([
                            'products' => $this->getWithForProducts($shopId),
                            'pricingPolicies' => $this->getWithForPricingPolicies($shopId),
                        ])
                        ->whereNull('deleted_at')
                        ->orderBy('name')
                        ->withCount($withCount);
                },
            ])
            ->orderBy('name')
            ->get('id');
    }

    public function getCleanByShopId($shopId, $ids = [])
    {
        $query = $this
            ->orderBy('name')
            ->whereHas('productGroups.pricingPolicies', function ($query) use ($shopId) {
                return $query->select('id', 'product_group_id')->where('customer_id', $shopId);
            });

        $result = ($ids) ? $query->findWhereIn('id', $ids) : $query->get();

        return $result
            ->map(function ($productType) {
                return ProductTypeTransformer::toArray($productType);
            });
    }

    /**
     * @param array $productGroupIds
     * @return \Closure
     */
    protected function getWithForProducts($shopId)
    {
        return function ($query) use ($shopId) {
            return $query
                ->distinct()
                ->select('products.id', 'products.product_group_id')
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
                ->where('customer_user_customer.customer_user_id', '=', Auth::id())
                ->where('customer_pricing_policies.customer_id', $shopId)
                ->where('customer_pricing_policies.price', '>', '0.00')
                ->where('customer_pricing_policies.products_range', '>', 0)
                ->whereNull('customer_pricing_policies.deleted_at')
                ->whereNull('products.deleted_at')
                ->orderBy('name');
        };
    }

    /**
     * @param int $shopId
     * @return \Closure
     */
    protected function getWithForPricingPolicies($shopId)
    {
        return function ($query) use ($shopId) {
            return $query
                ->select('id', 'product_group_id')
                ->without(['productGroup', 'customer'])
                ->where('customer_id', $shopId)
                ->where('price', '>', '0.00')
                ->where('products_range', '>', 0)
                ->whereNull('deleted_at');
        };
    }
}
