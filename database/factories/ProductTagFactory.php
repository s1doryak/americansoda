<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\ProductTag::class, function (Faker\Generator $faker) {
    return [
		'name' => $faker->unique()->name,
		'icon' => null,
		'color' => $faker->safeHexColor,
    ];
});
