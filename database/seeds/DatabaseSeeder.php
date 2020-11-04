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
                StockMovementsTableSeeder::class,
                StockMovementProductsTableSeeder::class,
                StockProductsTableSeeder::class,
                JobsTableSeeder::class,
                FailedJobsTableSeeder::class
            ]);
            $this->call(ProductTagsTableSeeder::class);
			$this->call(CompanyBankAccountsTableSeeder::class);
			$this->call(CustomerInvoicesTableSeeder::class);
			$this->call(CustomerInvoiceActionsTableSeeder::class);
			$this->call(CustomerInvoiceAttachmentsTableSeeder::class);
			$this->call(CustomerInvoiceItemsTableSeeder::class);
			$this->call(PriceGroupsTableSeeder::class);
			$this->call(PriceGroupBreakpointsTableSeeder::class);
			$this->call(CustomerUsersTableSeeder::class);
			$this->call(CustomerUserTokensTableSeeder::class);
			$this->call(CustomerPreOrdersTableSeeder::class);
			$this->call(CustomerPreOrderItemsTableSeeder::class);
			$this->call(BannersTableSeeder::class);
			$this->call(ProductTypesTableSeeder::class);
			$this->call(SettingsTableSeeder::class);
			$this->call(AuthLogsTableSeeder::class);
			$this->call(CustomerUserSubscribesTableSeeder::class);
			// ...seeder
        }
    }
}
