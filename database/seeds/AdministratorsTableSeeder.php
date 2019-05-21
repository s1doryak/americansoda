<?php

use Illuminate\Database\Seeder;

class AdministratorsTableSeeder extends Seeder
{
    public function run()
    {
		static $roles, $companies;

		/** @var \Illuminate\Database\Eloquent\Collection $roles */
		$roles = $roles ?: app(\App\Repositories\Contracts\RoleRepository::class)->all();

		/** @var \Illuminate\Database\Eloquent\Collection $companies */
		$companies = $companies ?: app(\App\Repositories\Contracts\CompanyRepository::class)->all();



        factory(App\Administrator::class, 5)->create()->each(function (App\Administrator $administrator) use ($roles, $companies) {
			$administrator->role()->associate($roles->random());
			$administrator->company()->associate($companies->random());

			$administrator->save();
        });
    }
}