<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\CustomerPricingPolicyRevision::class, function (Faker\Generator $faker) {
    return [
		'revision_type' => null,
		'revision_number' => null,
		'products_range' => null,
		'price' => null,
    ];
});
