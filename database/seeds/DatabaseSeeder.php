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
				BrandsTableSeeder::class,
				PackageTypesTableSeeder::class,
				ProductGroupsTableSeeder::class,
				ProductsTableSeeder::class,
				StocksTableSeeder::class,
				PaymentTypesTableSeeder::class,
				CustomerTypesTableSeeder::class,
				CustomersTableSeeder::class,
				CustomerRevisionsTableSeeder::class,
				CustomerOrdersTableSeeder::class,
				CustomerShipmentsTableSeeder::class,
				CustomerOrderItemsTableSeeder::class,
				CustomerPricingPoliciesTableSeeder::class,
				CustomerPricingPolicyRevisionsTableSeeder::class,
				AssembliesTableSeeder::class,

				JobsTableSeeder::class,
				FailedJobsTableSeeder::class
			]);
		}
	}
}
