<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\CustomerPreOrder::class, function (Faker\Generator $faker) {
    return [
		'number' => null,
		'reference_number' => null,
		'comment' => null,
    ];
});
