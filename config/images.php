<?php return [
	'path' => 'uploads/images/{model}/{attribute}',
	'library' => 'gd',
	'quality' => 90,
	'default_dimensions' => [
		'width' => 150,
		'height' => 150,
		'crop' => true,
		'quality' => 90,
	],
	'dimensions' => [
		\App\User::class => [
			'avatar' => [
				'width' => 150,
				'height' => 150,
				'crop' => true,
				'quality' => 90,
			],
		],
		\App\Administrator::class => [
			'avatar' => [
				'width' => 150,
				'height' => 150,
				'crop' => true,
				'quality' => 90,
			],
		],
		\App\Brand::class => [
			'logo' => [
				'width' => 150,
				'height' => 150,
				'crop' => true,
				'quality' => 90,
			],
		],
		\App\Product::class => [
			'product_image' => [
				'width' => 150,
				'height' => 150,
				'crop' => true,
				'quality' => 90,
			],
			'package_image' => [
				'width' => 150,
				'height' => 150,
				'crop' => true,
				'quality' => 90,
			],
		],
	]
];