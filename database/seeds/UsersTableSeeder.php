<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
		static $roles, $companies;

		/** @var \Illuminate\Database\Eloquent\Collection $roles */
		$roles = $roles ?: app(\App\Repositories\Contracts\RoleRepository::class)->all();

		/** @var \Illuminate\Database\Eloquent\Collection $companies */
		$companies = $companies ?: app(\App\Repositories\Contracts\CompanyRepository::class)->all();



        factory(App\User::class, 5)->create()->each(function (App\User $user) use ($roles, $companies) {
			$user->role()->associate($roles->random());
			$user->company()->associate($companies->random());

			$user->save();
        });
    }
}