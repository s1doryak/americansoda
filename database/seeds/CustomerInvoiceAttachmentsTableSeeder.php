<?php

use Illuminate\Database\Seeder;

class CustomerInvoiceAttachmentsTableSeeder extends Seeder
{
    public function run()
    {
		static $customerInvoices;

		/** @var \Illuminate\Database\Eloquent\Collection $customerInvoices */
		$customerInvoices = $customerInvoices ?: app(\App\Repositories\Contracts\CustomerInvoiceRepository::class)->all();



        factory(App\CustomerInvoiceAttachment::class, 5)->create()->each(function (App\CustomerInvoiceAttachment $customerInvoiceAttachment) use ($customerInvoices) {
			$customerInvoiceAttachment->customerInvoice()->associate($customerInvoices->random());

			$customerInvoiceAttachment->save();
        });
    }
}