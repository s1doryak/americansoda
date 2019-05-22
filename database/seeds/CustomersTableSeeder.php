<?php

use Illuminate\Database\Seeder;

class CustomersTableSeeder extends Seeder
{
    public function run()
    {
		static $stocks, $customerTypes, $paymentTypes, $users, $billingRegions, $shippingRegions;

		/** @var \Illuminate\Database\Eloquent\Collection $stocks */
		$stocks = $stocks ?: app(\App\Repositories\Contracts\StockRepository::class)->all();

		/** @var \Illuminate\Database\Eloquent\Collection $customerTypes */
		$customerTypes = $customerTypes ?: app(\App\Repositories\Contracts\CustomerTypeRepository::class)->all();

		/** @var \Illuminate\Database\Eloquent\Collection $paymentTypes */
		$paymentTypes = $paymentTypes ?: app(\App\Repositories\Contracts\PaymentTypeRepository::class)->all();

		/** @var \Illuminate\Database\Eloquent\Collection $users */
		$users = $users ?: app(\App\Repositories\Contracts\UserRepository::class)->all();

		/** @var \Illuminate\Database\Eloquent\Collection $billingRegions */
		$billingRegions = $billingRegions ?: app(\App\Repositories\Contracts\BillingRegionRepository::class)->all();

		/** @var \Illuminate\Database\Eloquent\Collection $shippingRegions */
		$shippingRegions = $shippingRegions ?: app(\App\Repositories\Contracts\ShippingRegionRepository::class)->all();



        factory(App\Customer::class, 5)->create()->each(function (App\Customer $customer) use ($stocks, $customerTypes, $paymentTypes, $users, $billingRegions, $shippingRegions) {
			$customer->stock()->associate($stocks->random());
			$customer->customerType()->associate($customerTypes->random());
			$customer->paymentType()->associate($paymentTypes->random());
			$customer->user()->associate($users->random());
			$customer->billingRegion()->associate($billingRegions->random());
			$customer->shippingRegion()->associate($shippingRegions->random());

			$customer->save();
        });
    }
}