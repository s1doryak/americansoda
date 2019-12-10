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
        $productGroupIds = $products->pluck('product_group_id')->unique();

        return $this
            ->has('productGroups')
            ->has('productGroups.products')
            ->with([
                'productGroups.products' => function ($query) use ($productGroupIds) {
                    return $query->whereIn('product_group_id', $productGroupIds);
                },
                'productGroups.pricingPolicies' => function ($query) use ($shopId) {
                    return $query->where('customer_id', $shopId);
                },
                'productGroups' => function ($query) use ($withCount) {
                    return $query->withCount($withCount);
                }
            ])
            ->get();
    }
}
