<?php

use Illuminate\Database\Seeder;

class CustomerOrdersTableSeeder extends Seeder
{
    public function run()
    {
		static $customers, $users;

		/** @var \Illuminate\Database\Eloquent\Collection $customers */
		$customers = $customers ?: app(\App\Repositories\Contracts\CustomerRepository::class)->all();

		/** @var \Illuminate\Database\Eloquent\Collection $users */
		$users = $users ?: app(\App\Repositories\Contracts\UserRepository::class)->all();



        factory(App\CustomerOrder::class, 5)->create()->each(function (App\CustomerOrder $customerOrder) use ($customers, $users) {
			$customerOrder->customer()->associate($customers->random());
			$customerOrder->user()->associate($users->random());

			$customerOrder->save();
        });
    }
}