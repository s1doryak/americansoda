<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\CustomerOrderItem::class, function (Faker\Generator $faker) {
    return [
		'status' => null,
		'product_name' => null,
		'sales_unit_quantity' => null,
		'product_manual_price' => $faker->boolean,
		'product_price' => null,
		'vat' => null,
		'product_vat_price' => null,
		'products_quantity' => null,
		'packages_quantity' => null,
		'total_price' => null,
		'total_vat_price' => null,
		'deposit_enabled' => $faker->boolean,
		'deposit_price' => null,
		'deposit_vat' => null,
		'deposit_vat_price' => null,
		'deposit_total_price' => null,
		'deposit_total_vat' => null,
		'deposit_total_vat_price' => null,
		'bypass' => $faker->boolean,
		'back_order' => $faker->boolean,
		'cancelled' => $faker->boolean,
		'expected_date' => null,
    ];
});
