<?php

use Illuminate\Database\Seeder;

class StockMovementProductsTableSeeder extends Seeder
{
    public function run()
    {
		static $stockMovements, $products;

		/** @var \Illuminate\Database\Eloquent\Collection $stockMovements */
		$stockMovements = $stockMovements ?: app(\App\Repositories\Contracts\StockMovementRepository::class)->all();

		/** @var \Illuminate\Database\Eloquent\Collection $products */
		$products = $products ?: app(\App\Repositories\Contracts\ProductRepository::class)->all();



        factory(App\StockMovementProduct::class, 5)->create()->each(function (App\StockMovementProduct $stockMovementProduct) use ($stockMovements, $products) {
			$stockMovementProduct->stockMovement()->associate($stockMovements->random());
			$stockMovementProduct->product()->associate($products->random());

			$stockMovementProduct->save();
        });
    }
}