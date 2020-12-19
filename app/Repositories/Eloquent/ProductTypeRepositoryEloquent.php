<?php

namespace App\Repositories\Eloquent;

use App\ProductType;
use App\Repositories\Contracts\ProductTypeRepository;
use App\Transformers\Api\V1\ProductTypeTransformer;
use Illuminate\Foundation\Application;

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
        $products = $this->productRepository->getByShopId($shopId);
        $productGroupIds = $products->pluck('productGroup')->unique();

        return $this
            ->whereHas('productGroups', function ($query) use ($shopId, $productGroupIds) {
                return $query
                    ->whereHas('pricingPolicies', function ($query) use ($shopId) {
                        return $query
                            ->where('customer_id', $shopId)
                            ->where('price', '>', '0.00')
                            ->where('products_range', '>', 0)
                            ->whereNull('deleted_at');
                    })
                    ->whereHas('products', function ($query) use ($productGroupIds) {
                        return $query
                            ->whereIn('product_group_id', $productGroupIds)
                            ->whereNull('deleted_at');
                    });
            })
            ->with([
                'productGroups' => function ($query) use ($withCount) {
                    return $query
                        ->select('id', 'product_type_id')
                        ->whereHas('pricingPolicies', function ($query) {
                            return $query->whereNull('deleted_at');
                        })
                        ->whereHas('products', function ($query) {
                            return $query->whereNull('deleted_at');
                        })
                        ->orderBy('name')
                        ->withCount($withCount);
                },
                'productGroups.products' => $this->getWithForProducts($productGroupIds),
                'productGroups.pricingPolicies' => $this->getWithForPricingPolicies($shopId),
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
    protected function getWithForProducts($productGroupIds)
    {
        return function ($query) use ($productGroupIds) {
            return $query->select(['id', 'product_group_id'])
                ->whereIn('product_group_id', $productGroupIds)
                ->whereNull('deleted_at')
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
            return $query->select(['id', 'product_group_id'])
                ->without(['productGroup', 'customer'])
                ->where('customer_id', $shopId)
                ->where('price', '>', '0.00')
                ->where('products_range', '>', 0)
                ->whereNull('deleted_at');
        };
    }
}
