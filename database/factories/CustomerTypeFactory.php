<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\CustomerType::class, function (Faker\Generator $faker) {
    return [
		'name' => $faker->unique()->name,
    ];
});
