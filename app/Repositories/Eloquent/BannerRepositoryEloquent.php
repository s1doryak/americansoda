<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\BannerRepository;
use App\Transformers\Api\V1\BannerTransformer;
use Illuminate\Support\Facades\Auth;

class BannerRepositoryEloquent extends \Crmplease\MaterialAdmin\Repositories\RepositoryEloquent implements BannerRepository
{
    /**
     * @param $shopId
     * @return mixed
     */
    public function getByShopId($shopId)
    {
        $result = collect();
        $customer = Auth::user()
            ->customers()
            ->with([
                'customerType.banners' => function ($query) {
                    return $query->whereNull('deleted_at');
                }
            ])
            ->where('customer_id', $shopId)
            ->first();

        if (isset($customer->customerType) && isset($customer->customerType->banners)) {
            $result = $customer->customerType->banners;
        }

        return $result->map(function ($banner) {
            return BannerTransformer::toArray($banner);
        });
    }
}
