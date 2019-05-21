<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Company::class, function (Faker\Generator $faker) {
    return [
		'name' => $faker->unique()->name,
		'legal_name' => null,
		'short_name' => null,
		'postcode' => null,
		'address' => null,
		'bid' => null,
		'email' => $faker->unique()->safeEmail,
		'phone' => $faker->unique()->phoneNumber,
		'code' => null,
		'smtp_host' => null,
		'smtp_port' => null,
		'smtp_encryption' => null,
		'smtp_username' => null,
		'smtp_password' => null,
		'smtp_from' => null,
		'smtp_from_name' => null,
    ];
});
