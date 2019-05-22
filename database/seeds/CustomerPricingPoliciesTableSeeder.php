<?php

use Illuminate\Database\Seeder;

class CustomerPricingPoliciesTableSeeder extends Seeder
{
    public function run()
    {
		static $productGroups, $customers;

		/** @var \Illuminate\Database\Eloquent\Collection $productGroups */
		$productGroups = $productGroups ?: app(\App\Repositories\Contracts\ProductGroupRepository::class)->all();

		/** @var \Illuminate\Database\Eloquent\Collection $customers */
		$customers = $customers ?: app(\App\Repositories\Contracts\CustomerRepository::class)->all();



        factory(App\CustomerPricingPolicy::class, 5)->create()->each(function (App\CustomerPricingPolicy $customerPricingPolicy) use ($productGroups, $customers) {
			$customerPricingPolicy->productGroup()->associate($productGroups->random());
			$customerPricingPolicy->customer()->associate($customers->random());

			$customerPricingPolicy->save();
        });
    }
}