<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\CompanyBankAccount::class, function (Faker\Generator $faker) {
    return [
		'bank' => null,
		'swift' => null,
		'account' => null,
		'iban' => null,
		'default' => $faker->boolean,
    ];
});
