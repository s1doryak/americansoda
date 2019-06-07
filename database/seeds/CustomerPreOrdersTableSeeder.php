<?php

use Illuminate\Database\Seeder;

class CustomerPreOrdersTableSeeder extends Seeder
{
    public function run()
    {
		static $customerUsers, $customerOrders, $customers;

		/** @var \Illuminate\Database\Eloquent\Collection $customerUsers */
		$customerUsers = $customerUsers ?: app(\App\Repositories\Contracts\CustomerUserRepository::class)->all();

		/** @var \Illuminate\Database\Eloquent\Collection $customerOrders */
		$customerOrders = $customerOrders ?: app(\App\Repositories\Contracts\CustomerOrderRepository::class)->all();

		/** @var \Illuminate\Database\Eloquent\Collection $customers */
		$customers = $customers ?: app(\App\Repositories\Contracts\CustomerRepository::class)->all();



        factory(App\CustomerPreOrder::class, 5)->create()->each(function (App\CustomerPreOrder $customerPreOrder) use ($customerUsers, $customerOrders, $customers) {
			$customerPreOrder->customerUser()->associate($customerUsers->random());
			$customerPreOrder->customerOrder()->associate($customerOrders->random());
			$customerPreOrder->customer()->associate($customers->random());

			$customerPreOrder->save();
        });
    }
}