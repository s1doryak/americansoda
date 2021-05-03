<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\LtpMessage::class, function (Faker\Generator $faker) {
    return [
		'sender_identifier' => null,
		'sender_description' => null,
		'filename_hint' => null,
		'content' => null,
    ];
});
