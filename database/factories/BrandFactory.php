<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Brand::class, function (Faker\Generator $faker) {
    return [
		'name' => $faker->unique()->name,
		'logo' => null,
    ];
});
