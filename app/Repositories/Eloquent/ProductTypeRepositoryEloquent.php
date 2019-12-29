<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\ProductTypeRepository;
use Illuminate\Foundation\Application;

class ProductTypeRepositoryEloquent extends \Crmplease\MaterialAdmin\Repositories\RepositoryEloquent implements ProductTypeRepository
{
    protected $productRepository;

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
            ->has('productGroups')
            ->has('productGroups.pricingPolicies')
            ->has('productGroups.products')
            ->with([
                'productGroups.products' => function ($query) use ($productGroupIds) {
                    return $query->select('id', 'product_group_id')->whereIn('product_group_id', $productGroupIds);
                },
                'productGroups.pricingPolicies' => function ($query) use ($shopId) {
                    return $query->select('id', 'product_group_id')
                        ->where('customer_id', $shopId)
                        ->where('price', '>', '0.00')
                        ->where('products_range', '>', 0)
                        ->whereNull('deleted_at');
                },
                'productGroups' => function ($query) use ($withCount) {
                    return $query->select('id', 'product_type_id')->withCount($withCount);
                }
            ])
            ->get(['id'])
            ->map(function ($productType) {
                $productGroups = $productType->productGroups->filter(function ($productGroup) {
                    return $productGroup->products->isNotEmpty()
                        && $productGroup->pricingPolicies->isNotEmpty();
                });
                $productType->productGroups = $productGroups;

                return $productType;
            })
            ->filter(function ($productType) {
                return $productType->productGroups->isNotEmpty() ?? false;
            });

    }

    public function getCleanByShopId($shopId, $ids = [])
    {
        $query = $this
            ->whereHas('productGroups.pricingPolicies', function ($query) use ($shopId) {
                return $query->select('id', 'product_group_id')->where('customer_id', $shopId);
            });

        $result = ($ids) ? $query->findWhereIn('id', $ids) : $query->get();

        return $result->map(function ($productType) {
            $productType['image'] = (string)$productType['image'] ? asset((string)$productType['image']) : null;

            return $productType;
        });
    }
}
