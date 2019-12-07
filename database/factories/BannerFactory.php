<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Banner::class, function (Faker\Generator $faker) {
    return [
		'name' => $faker->unique()->name,
		'image' => null,
		'url' => null,
    ];
});
