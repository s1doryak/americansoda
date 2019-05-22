<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\StockMovementProduct::class, function (Faker\Generator $faker) {
    return [
		'product_name' => null,
		'products_quantity' => null,
		'delivery_number' => null,
		'expiration_date' => null,
		'movement_type' => null,
		'comment' => null,
    ];
});
