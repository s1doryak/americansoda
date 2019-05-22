<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\StockMovement::class, function (Faker\Generator $faker) {
    return [
		'movement_type' => null,
    ];
});
