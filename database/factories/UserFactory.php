<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
		'email' => $faker->unique()->safeEmail,
		'email_verified_at' => now(),
		'password' => bcrypt('secret'),
		'email' => $faker->unique()->safeEmail,
		'password' => bcrypt('secret'),
		'name' => $faker->unique()->name,
		'phone' => $faker->unique()->phoneNumber,
		'avatar' => null,
    ];
});
