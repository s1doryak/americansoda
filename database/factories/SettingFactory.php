<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Setting::class, function (Faker\Generator $faker) {
    return [
		'name' => $faker->unique()->name,
		'value' => null,
    ];
});
