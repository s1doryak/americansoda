<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Administrator::class, function (Faker\Generator $faker) {
    return [
		'email' => $faker->unique()->safeEmail,
		'email_verified_at' => now(),
		'password' => bcrypt('secret'),
		'name' => $faker->unique()->name,
		'phone' => $faker->unique()->phoneNumber,
        'locale' => $faker->randomElement(['en', 'ru', 'fi']),
		'avatar' => null,
    ];
});
