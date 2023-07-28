<?php

use Illuminate\Database\Seeder;

class CustomerUserSubscribesTableSeeder extends Seeder
{
    public function run()
    {
		static $products, $customerUsers;

		/** @var \Illuminate\Database\Eloquent\Collection $products */
		$products = $products ?: app(\App\Repositories\Contracts\ProductRepository::class)->all();

		/** @var \Illuminate\Database\Eloquent\Collection $customerUsers */
		$customerUsers = $customerUsers ?: app(\App\Repositories\Contracts\CustomerUserRepository::class)->all();



        factory(App\CustomerUserSubscribe::class, 5)->create()->each(function (App\CustomerUserSubscribe $CustomerUserSubscribe) use ($products, $customerUsers) {
			$CustomerUserSubscribe->product()->associate($products->random());
			$CustomerUserSubscribe->customerUser()->associate($customerUsers->random());

			$CustomerUserSubscribe->save();
        });
    }
}
