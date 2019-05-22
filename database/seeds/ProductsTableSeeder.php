<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    public function run()
    {
		static $brands, $packageTypes, $productGroups;

		/** @var \Illuminate\Database\Eloquent\Collection $brands */
		$brands = $brands ?: app(\App\Repositories\Contracts\BrandRepository::class)->all();

		/** @var \Illuminate\Database\Eloquent\Collection $packageTypes */
		$packageTypes = $packageTypes ?: app(\App\Repositories\Contracts\PackageTypeRepository::class)->all();

		/** @var \Illuminate\Database\Eloquent\Collection $productGroups */
		$productGroups = $productGroups ?: app(\App\Repositories\Contracts\ProductGroupRepository::class)->all();



        factory(App\Product::class, 5)->create()->each(function (App\Product $product) use ($brands, $packageTypes, $productGroups) {
			$product->brand()->associate($brands->random());
			$product->packageType()->associate($packageTypes->random());
			$product->productGroup()->associate($productGroups->random());

			$product->save();
        });
    }
}