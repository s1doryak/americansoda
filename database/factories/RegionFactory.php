<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Region::class, function (Faker\Generator $faker) {
    return [
		'name' => $faker->unique()->name,
    ];
});
