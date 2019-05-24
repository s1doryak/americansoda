<?php

use Illuminate\Database\Seeder;

class ProductTagsTableSeeder extends Seeder
{
	public function run()
	{
		/** @var \App\Repositories\Eloquent\ProductTagRepositoryEloquent $repository */
		$repository = app(\App\Repositories\Contracts\ProductTagRepository::class);

		$repository->firstOrCreate([
			'name' => 'New product!',
			'icon' => 'fire',
			'color' => '#f13c5b',
		]);

		$repository->firstOrCreate([
			'name' => 'HIT',
			'icon' => 'alert-polygon',
			'color' => '#f8c400',
		]);

		$repository->firstOrCreate([
			'name' => 'Free shipping',
			'icon' => 'truck',
			'color' => '#4654ef',
		]);
	}
}