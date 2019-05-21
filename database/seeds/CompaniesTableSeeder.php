<?php

use Illuminate\Database\Seeder;

class CompaniesTableSeeder extends Seeder
{
    public function run()
    {
		static $regions;

		/** @var \Illuminate\Database\Eloquent\Collection $regions */
		$regions = $regions ?: app(\App\Repositories\Contracts\RegionRepository::class)->all();



        factory(App\Company::class, 5)->create()->each(function (App\Company $company) use ($regions) {
			$company->region()->associate($regions->random());

			$company->save();
        });
    }
}