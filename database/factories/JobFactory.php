<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Job::class, function (Faker\Generator $faker) {
    return [
		'queue' => null,
		'payload' => null,
		'attempts' => null,
		'reserved_at' => null,
		'available_at' => null,
		'created_at' => null,
    ];
});
