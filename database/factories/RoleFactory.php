<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Role::class, function (Faker\Generator $faker) {

    $name = $faker->unique()->word;

    return [
        'name' => $name,
        'slug' => str_slug($name),
    ];
});
