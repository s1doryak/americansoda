<?php

use Illuminate\Database\Seeder;

class CustomerInvoiceActionsTableSeeder extends Seeder
{
    public function run()
    {
		static $customerInvoices;

		/** @var \Illuminate\Database\Eloquent\Collection $customerInvoices */
		$customerInvoices = $customerInvoices ?: app(\App\Repositories\Contracts\CustomerInvoiceRepository::class)->all();



        factory(App\CustomerInvoiceAction::class, 5)->create()->each(function (App\CustomerInvoiceAction $customerInvoiceAction) use ($customerInvoices) {
			$customerInvoiceAction->customerInvoice()->associate($customerInvoices->random());

			$customerInvoiceAction->save();
        });
    }
}