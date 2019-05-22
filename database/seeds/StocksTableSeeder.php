<?php

use Illuminate\Database\Seeder;

class StocksTableSeeder extends Seeder
{
    public function run()
    {
		static $regions;

		/** @var \Illuminate\Database\Eloquent\Collection $regions */
		$regions = $regions ?: app(\App\Repositories\Contracts\RegionRepository::class)->all();



        factory(App\Stock::class, 5)->create()->each(function (App\Stock $stock) use ($regions) {
			$stock->region()->associate($regions->random());

			$stock->save();
        });
    }
}