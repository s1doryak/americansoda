<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\CustomerInvoiceItem::class, function (Faker\Generator $faker) {
    return [
		'position' => null,
		'item_code' => null,
		'subject' => null,
		'definition' => null,
		'price' => null,
		'unit_type' => null,
		'amount' => null,
		'sum' => null,
		'tax' => null,
		'sum_tax' => null,
		'discount' => null,
    ];
});
