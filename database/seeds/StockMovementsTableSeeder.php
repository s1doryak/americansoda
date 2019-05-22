<?php

use Illuminate\Database\Seeder;

class StockMovementsTableSeeder extends Seeder
{
    public function run()
    {
		static $stocks;

		/** @var \Illuminate\Database\Eloquent\Collection $stocks */
		$stocks = $stocks ?: app(\App\Repositories\Contracts\StockRepository::class)->all();



        factory(App\StockMovement::class, 5)->create()->each(function (App\StockMovement $stockMovement) use ($stocks) {
			$stockMovement->stock()->associate($stocks->random());

			$stockMovement->save();
        });
    }
}