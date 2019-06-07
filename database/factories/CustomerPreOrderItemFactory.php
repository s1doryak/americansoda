<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\CustomerPreOrderItem::class, function (Faker\Generator $faker) {
    return [
		'quantity' => null,
		'products_quantity' => null,
		'price' => null,
		'vat_price' => null,
		'total_price' => null,
		'total_vat_price' => null,
		'deposit_price' => null,
		'deposit_vat_price' => null,
		'total_deposit_price' => null,
		'total_deposit_vat_price' => null,
    ];
});
