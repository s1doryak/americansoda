<?php

use Illuminate\Database\Seeder;

class CustomerTypesTableSeeder extends Seeder
{
    public function run()
    {
		static $customerTypes;

		/** @var \Illuminate\Database\Eloquent\Collection $customerTypes */
		$customerTypes = $customerTypes ?: app(\App\Repositories\Contracts\CustomerTypeRepository::class)->all();



        factory(App\CustomerType::class, 5)->create()->each(function (App\CustomerType $customerType) use ($customerTypes) {
			$customerType->customerType()->associate($customerTypes->random());

			$customerType->save();
        });
    }
}