<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 *
	 * @return void
	 */
	public function run()
	{
		if (is_local()) {
			$this->call([
				RegionsTableSeeder::class,
				CompaniesTableSeeder::class,
				RolesTableSeeder::class,
				UsersTableSeeder::class,
				AdministratorsTableSeeder::class,

				JobsTableSeeder::class,
				FailedJobsTableSeeder::class
			]);
		}
	}
}
