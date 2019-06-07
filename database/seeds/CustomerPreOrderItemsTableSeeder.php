<?php

use Illuminate\Database\Seeder;

class CustomerPreOrderItemsTableSeeder extends Seeder
{
    public function run()
    {
		static $customerPreOrders, $customerUsers, $customers, $products;

		/** @var \Illuminate\Database\Eloquent\Collection $customerPreOrders */
		$customerPreOrders = $customerPreOrders ?: app(\App\Repositories\Contracts\CustomerPreOrderRepository::class)->all();

		/** @var \Illuminate\Database\Eloquent\Collection $customerUsers */
		$customerUsers = $customerUsers ?: app(\App\Repositories\Contracts\CustomerUserRepository::class)->all();

		/** @var \Illuminate\Database\Eloquent\Collection $customers */
		$customers = $customers ?: app(\App\Repositories\Contracts\CustomerRepository::class)->all();

		/** @var \Illuminate\Database\Eloquent\Collection $products */
		$products = $products ?: app(\App\Repositories\Contracts\ProductRepository::class)->all();



        factory(App\CustomerPreOrderItem::class, 5)->create()->each(function (App\CustomerPreOrderItem $customerPreOrderItem) use ($customerPreOrders, $customerUsers, $customers, $products) {
			$customerPreOrderItem->customerPreOrder()->associate($customerPreOrders->random());
			$customerPreOrderItem->customerUser()->associate($customerUsers->random());
			$customerPreOrderItem->customer()->associate($customers->random());
			$customerPreOrderItem->product()->associate($products->random());

			$customerPreOrderItem->save();
        });
    }
}