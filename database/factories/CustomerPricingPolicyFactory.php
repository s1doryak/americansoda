<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\CustomerPricingPolicy::class, function (Faker\Generator $faker) {
    return [
		'products_range' => null,
		'price' => null,
    ];
});
