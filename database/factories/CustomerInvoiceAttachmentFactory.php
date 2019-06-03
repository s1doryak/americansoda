<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\CustomerInvoiceAttachment::class, function (Faker\Generator $faker) {
    return [
		'attachment_type' => null,
		'filename' => null,
		'file' => null,
    ];
});
