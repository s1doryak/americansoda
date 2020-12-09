<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\AuthLog::class, function (Faker\Generator $faker) {
    return [
		'date' => null,
		'user_agent' => null,
		'zendesk' => null,
		'version' => null,
		'sentry' => null,
    ];
});
