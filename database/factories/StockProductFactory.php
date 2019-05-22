<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\StockProduct::class, function (Faker\Generator $faker) {
    return [
		'delivery_number' => null,
		'expiration_date' => null,
    ];
});
