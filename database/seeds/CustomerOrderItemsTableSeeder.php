<?php

use Illuminate\Database\Seeder;

class CustomerOrderItemsTableSeeder extends Seeder
{
    public function run()
    {
		static $products, $customers, $customerOrders, $customerShipments;

		/** @var \Illuminate\Database\Eloquent\Collection $products */
		$products = $products ?: app(\App\Repositories\Contracts\ProductRepository::class)->all();

		/** @var \Illuminate\Database\Eloquent\Collection $customers */
		$customers = $customers ?: app(\App\Repositories\Contracts\CustomerRepository::class)->all();

		/** @var \Illuminate\Database\Eloquent\Collection $customerOrders */
		$customerOrders = $customerOrders ?: app(\App\Repositories\Contracts\CustomerOrderRepository::class)->all();

		/** @var \Illuminate\Database\Eloquent\Collection $customerShipments */
		$customerShipments = $customerShipments ?: app(\App\Repositories\Contracts\CustomerShipmentRepository::class)->all();



        factory(App\CustomerOrderItem::class, 5)->create()->each(function (App\CustomerOrderItem $customerOrderItem) use ($products, $customers, $customerOrders, $customerShipments) {
			$customerOrderItem->product()->associate($products->random());
			$customerOrderItem->customer()->associate($customers->random());
			$customerOrderItem->customerOrder()->associate($customerOrders->random());
			$customerOrderItem->customerShipment()->associate($customerShipments->random());

			$customerOrderItem->save();
        });
    }
}