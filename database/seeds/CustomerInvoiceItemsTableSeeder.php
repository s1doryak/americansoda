<?php

use Illuminate\Database\Seeder;

class CustomerInvoiceItemsTableSeeder extends Seeder
{
    public function run()
    {
		static $invoices, $orderItems;

		/** @var \Illuminate\Database\Eloquent\Collection $invoices */
		$invoices = $invoices ?: app(\App\Repositories\Contracts\InvoiceRepository::class)->all();

		/** @var \Illuminate\Database\Eloquent\Collection $orderItems */
		$orderItems = $orderItems ?: app(\App\Repositories\Contracts\OrderItemRepository::class)->all();



        factory(App\CustomerInvoiceItem::class, 5)->create()->each(function (App\CustomerInvoiceItem $customerInvoiceItem) use ($invoices, $orderItems) {
			$customerInvoiceItem->invoice()->associate($invoices->random());
			$customerInvoiceItem->orderItem()->associate($orderItems->random());

			$customerInvoiceItem->save();
        });
    }
}