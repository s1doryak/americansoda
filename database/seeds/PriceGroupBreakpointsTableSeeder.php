<?php

use Illuminate\Database\Seeder;

class PriceGroupBreakpointsTableSeeder extends Seeder
{
    public function run()
    {
		static $priceGroups, $productGroups;

		/** @var \Illuminate\Database\Eloquent\Collection $priceGroups */
		$priceGroups = $priceGroups ?: app(\App\Repositories\Contracts\PriceGroupRepository::class)->all();

		/** @var \Illuminate\Database\Eloquent\Collection $productGroups */
		$productGroups = $productGroups ?: app(\App\Repositories\Contracts\ProductGroupRepository::class)->all();


        factory(App\PriceGroupBreakpoint::class, 5)->create()->each(function (App\PriceGroupBreakpoint $priceGroupBreakpoint) use ($priceGroups, $productGroups) {
			$priceGroupBreakpoint->priceGroup()->associate($priceGroups->random());
			$priceGroupBreakpoint->productGroups()->sync(
				$productGroups->random(rand(1, 5))->mapWithKeys(function ($entity) {
					$faker = Faker\Factory::create();
					return [
						$entity->getKey() => [
							'price' => null,
						]
					];
				})
			);
			$priceGroupBreakpoint->save();
        });
    }
}