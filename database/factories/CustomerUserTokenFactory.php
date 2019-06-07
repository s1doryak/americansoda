<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\CustomerUserToken::class, function (Faker\Generator $faker) {
    return [
		'token' => null,
		'ip_address' => null,
		'user_agent' => null,
    ];
});
