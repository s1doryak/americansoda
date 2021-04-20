<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Product::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->unique()->name,
		'product_barcode' => null,
		'product_barcode_plaintext' => null,
		'package_barcode' => null,
		'package_barcode_plaintext' => null,
		'product_image' => null,
		'package_image' => null,
		'description' => null,
		'contents' => null,
		'number_in_package' => null,
        'unit_type' => null,
		'weight' => null,
		'volume' => null,
		'brutto_weight' => null,
		'brutto_volume' => null,
		'deposit_enabled' => $faker->boolean,
		'deposit_price' => null,
		'deposit_vat' => null,
		'deposit_vat_price' => null,
		'comment' => null,
		'discount_price' => null,
		'new' => $faker->boolean,
		'action' => $faker->boolean,
		'future_stock_movement' => null,
		'displayed_text' => null,
];
});
