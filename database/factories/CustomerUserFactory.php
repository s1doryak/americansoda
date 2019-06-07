<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\CustomerUser::class, function (Faker\Generator $faker) {
    return [
		'email' => $faker->unique()->safeEmail,
		'email_verified_at' => now(),
		'password' => bcrypt('secret'),
		'name' => $faker->unique()->name,
		'phone' => $faker->unique()->phoneNumber,
		'comment' => null,
    ];
});
