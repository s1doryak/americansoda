<?php

namespace App\Services\Api\V1;

use App\Repositories\Contracts\ProductRepository;
use App\Repositories\Eloquent\ProductRepositoryEloquent;
use App\Transformers\Api\V1\ProductTransformer;
use Crmplease\MaterialAdmin\Services\ResourceService;
use Illuminate\Support\Facades\Auth;

class ProductService extends ResourceService
{
    /**
     * @var ProductRepositoryEloquent
     */
    protected $repository;

    /**
     * ProductService constructor.
     * @param ProductRepository $repository
     */
    public function __construct(
        ProductRepository $repository
    )
    {
        $this->repository = $repository;
    }

    public function getByShopId($shopId, $productIds = [])
    {
        $query = $this
            ->repository
            ->with(['productGroup', 'productTags'])
            ->orderBy('name')
            ->scopeQuery(function ($query) use ($shopId) {
                $customerUserId = $customerUserId ?? Auth::id();

                return $this->repository->scopeQueryForProducts($query, $shopId, $customerUserId);
            });
        $result = $productIds ? $query->findWhereIn('products.id', $productIds) : $query->get();

        return $result->map(function ($product) {
            return ProductTransformer::toArray($product);
        });
    }
}
