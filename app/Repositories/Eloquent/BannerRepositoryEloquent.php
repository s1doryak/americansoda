<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\BannerRepository;
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
            ->with('customerType.banners')
            ->where('customer_id', $shopId)
            ->first();

        if (isset($customer->customerType) && isset($customer->customerType->banners)) {
            $result = $customer->customerType->banners;
        }

        return $result;
    }
}
