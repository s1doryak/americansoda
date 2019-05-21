<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Role::class, function (Faker\Generator $faker) {
    return [
		'name' => $faker->unique()->name,
		'slug' => null,
    ];
});
