<?php

use Illuminate\Database\Seeder;

class CompanyBankAccountsTableSeeder extends Seeder
{
    public function run()
    {
		static $companies;

		/** @var \Illuminate\Database\Eloquent\Collection $companies */
		$companies = $companies ?: app(\App\Repositories\Contracts\CompanyRepository::class)->all();



        factory(App\CompanyBankAccount::class, 5)->create()->each(function (App\CompanyBankAccount $companyBankAccount) use ($companies) {
			$companyBankAccount->company()->associate($companies->random());

			$companyBankAccount->save();
        });
    }
}