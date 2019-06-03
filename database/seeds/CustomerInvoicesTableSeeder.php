<?php

use Illuminate\Database\Seeder;

class CustomerInvoicesTableSeeder extends Seeder
{
    public function run()
    {
		static $customers, $shipments, $accounts;

		/** @var \Illuminate\Database\Eloquent\Collection $customers */
		$customers = $customers ?: app(\App\Repositories\Contracts\CustomerRepository::class)->all();

		/** @var \Illuminate\Database\Eloquent\Collection $shipments */
		$shipments = $shipments ?: app(\App\Repositories\Contracts\ShipmentRepository::class)->all();

		/** @var \Illuminate\Database\Eloquent\Collection $accounts */
		$accounts = $accounts ?: app(\App\Repositories\Contracts\AccountRepository::class)->all();


        factory(App\CustomerInvoice::class, 5)->create()->each(function (App\CustomerInvoice $customerInvoice) use ($customers, $shipments, $accounts) {
			$customerInvoice->customer()->associate($customers->random());
			$customerInvoice->shipment()->associate($shipments->random());
			$customerInvoice->accounts()->sync($accounts->random(rand(1, 5)));
			$customerInvoice->save();
        });
    }
}