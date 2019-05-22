<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Assembly::class, function (Faker\Generator $faker) {
    return [
		'number' => null,
		'comment' => null,
    ];
});
