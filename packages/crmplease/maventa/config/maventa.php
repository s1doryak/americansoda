<?php return [

	'default' => env('MAVENTA_CONNECTION', 'testing'),

	'connections' => [

		'testing' => [
			'base_url' => env('MAVENTA_TESTING_BASE_URL', null),
			'user_api_key' => env('MAVENTA_TESTING_USER_API_KEY', null),
			'company_uuid' => env('MAVENTA_TESTING_COMPANY_UUID', null),
			'vendor_api_key' => env('MAVENTA_TESTING_VENDOR_API_KEY', null),
			'options' => [
				'trace' => true
			]
		],

		'secure' => [
			'base_url' => env('MAVENTA_SECURE_BASE_URL', null),
			'user_api_key' => env('MAVENTA_SECURE_USER_API_KEY', null),
			'company_uuid' => env('MAVENTA_SECURE_COMPANY_UUID', null),
			'vendor_api_key' => env('MAVENTA_SECURE_VENDOR_API_KEY', null),
			'options' => [

			]
		],

	],

];
