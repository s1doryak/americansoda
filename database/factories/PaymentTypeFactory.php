<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\PaymentType::class, function (Faker\Generator $faker) {
    return [
		'name' => $faker->unique()->name,
    ];
});
