<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\ProductGroup::class, function (Faker\Generator $faker) {
    return [
		'name' => $faker->unique()->name,
		'vat' => null,
		'sales_unit_volume' => null,
    ];
});
