<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\ProductRepository;
use Illuminate\Support\Facades\Auth;

class ProductRepositoryEloquent extends \Crmplease\MaterialAdmin\Repositories\RepositoryEloquent implements ProductRepository
{
    public function getByShopId($shopId, $customerUserId = null, $productIds = [])
    {
        $customerUserId = (is_null($customerUserId)) ? Auth::id() : $customerUserId;

        $query = $this
            ->model
            ->getQuery()
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
            ->where(['customer_pricing_policies.customer_id' => $shopId])
            ->where('customer_user_customer.customer_user_id', '=', $customerUserId)
            ->whereNull('customer_pricing_policies.deleted_at');

        if ($productIds) {
            $query->whereIn('products.id', $productIds);
        }

        return $query->get();
    }
}
