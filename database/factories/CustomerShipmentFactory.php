<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\CustomerShipment::class, function (Faker\Generator $faker) {
    return [
		'number' => null,
		'assembly_number' => null,
		'invoice_number' => null,
		'status' => null,
		'delivery_type' => null,
		'packages_quantity' => null,
		'comment' => null,
    ];
});
