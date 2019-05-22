<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\CustomerOrder::class, function (Faker\Generator $faker) {
    return [
		'number' => null,
		'batch_number' => null,
		'comment' => null,
		'fc_overdue' => null,
		'fc_comment' => null,
		'fc_future_comment' => null,
		'sent_at' => null,
    ];
});
