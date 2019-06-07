<?php

use Illuminate\Database\Seeder;

class CustomerUsersTableSeeder extends Seeder
{
    public function run()
    {
		static $customers;


		/** @var \Illuminate\Database\Eloquent\Collection $customers */
		$customers = $customers ?: app(\App\Repositories\Contracts\CustomerRepository::class)->all();


        factory(App\CustomerUser::class, 5)->create()->each(function (App\CustomerUser $customerUser) use ($customers) {

			$customerUser->customers()->sync($customers->random(rand(1, 5)));
			$customerUser->save();
        });
    }
}