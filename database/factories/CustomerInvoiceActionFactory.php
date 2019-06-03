<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\CustomerInvoiceAction::class, function (Faker\Generator $faker) {
    return [
		'action' => null,
		'timestamp' => null,
    ];
});
