<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\PriceGroup::class, function (Faker\Generator $faker) {
    return [
		'name' => $faker->unique()->name,
		'manual' => $faker->boolean,
    ];
});
