<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Stock::class, function (Faker\Generator $faker) {
    return [
		'name' => $faker->unique()->name,
		'postcode' => null,
		'address' => null,
    ];
});
