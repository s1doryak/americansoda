<?php

use Illuminate\Database\Seeder;

class StockProductsTableSeeder extends Seeder
{
    public function run()
    {
		static $stocks, $products, $customerOrderItems;

		/** @var \Illuminate\Database\Eloquent\Collection $stocks */
		$stocks = $stocks ?: app(\App\Repositories\Contracts\StockRepository::class)->all();

		/** @var \Illuminate\Database\Eloquent\Collection $products */
		$products = $products ?: app(\App\Repositories\Contracts\ProductRepository::class)->all();

		/** @var \Illuminate\Database\Eloquent\Collection $customerOrderItems */
		$customerOrderItems = $customerOrderItems ?: app(\App\Repositories\Contracts\CustomerOrderItemRepository::class)->all();



        factory(App\StockProduct::class, 5)->create()->each(function (App\StockProduct $stockProduct) use ($stocks, $products, $customerOrderItems) {
			$stockProduct->stock()->associate($stocks->random());
			$stockProduct->product()->associate($products->random());
			$stockProduct->customerOrderItem()->associate($customerOrderItems->random());

			$stockProduct->save();
        });
    }
}