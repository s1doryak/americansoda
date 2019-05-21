<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\PackageType::class, function (Faker\Generator $faker) {
    return [
		'name' => $faker->unique()->name,
		'description' => null,
    ];
});
