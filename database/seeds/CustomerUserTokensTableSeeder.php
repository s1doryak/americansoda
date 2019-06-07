<?php

use Illuminate\Database\Seeder;

class CustomerUserTokensTableSeeder extends Seeder
{
    public function run()
    {
		static $customerUsers;

		/** @var \Illuminate\Database\Eloquent\Collection $customerUsers */
		$customerUsers = $customerUsers ?: app(\App\Repositories\Contracts\CustomerUserRepository::class)->all();



        factory(App\CustomerUserToken::class, 5)->create()->each(function (App\CustomerUserToken $customerUserToken) use ($customerUsers) {
			$customerUserToken->customerUser()->associate($customerUsers->random());

			$customerUserToken->save();
        });
    }
}