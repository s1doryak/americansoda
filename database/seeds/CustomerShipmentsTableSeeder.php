<?php

use Illuminate\Database\Seeder;

class CustomerShipmentsTableSeeder extends Seeder
{
    public function run()
    {
		static $packageTypes, $customers, $users;

		/** @var \Illuminate\Database\Eloquent\Collection $packageTypes */
		$packageTypes = $packageTypes ?: app(\App\Repositories\Contracts\PackageTypeRepository::class)->all();

		/** @var \Illuminate\Database\Eloquent\Collection $customers */
		$customers = $customers ?: app(\App\Repositories\Contracts\CustomerRepository::class)->all();

		/** @var \Illuminate\Database\Eloquent\Collection $users */
		$users = $users ?: app(\App\Repositories\Contracts\UserRepository::class)->all();



        factory(App\CustomerShipment::class, 5)->create()->each(function (App\CustomerShipment $customerShipment) use ($packageTypes, $customers, $users) {
			$customerShipment->packageType()->associate($packageTypes->random());
			$customerShipment->customer()->associate($customers->random());
			$customerShipment->user()->associate($users->random());

			$customerShipment->save();
        });
    }
}