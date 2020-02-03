<?php

use Illuminate\Database\Seeder;

class BannersTableSeeder extends Seeder
{
    public function run()
    {
		static $customerTypes;


		/** @var \Illuminate\Database\Eloquent\Collection $customerTypes */
		$customerTypes = $customerTypes ?: app(\App\Repositories\Contracts\CustomerTypeRepository::class)->all();


        factory(App\Banner::class, 5)->create()->each(function (App\Banner $banner) use ($customerTypes) {

			$banner->customerTypes()->sync($customerTypes->random(rand(1, 5)));
			$banner->save();
        });
    }
}