<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\ProductType::class, function (Faker\Generator $faker) {
    return [
		'name' => $faker->unique()->name,
    ];
});
