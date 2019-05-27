<?php return [
	'pdf' => [
		'enabled' => true,
		'binary' => __DIR__ . '/../vendor/h4cc/wkhtmltopdf-amd64/bin/wkhtmltopdf-amd64',
		'timeout' => false,
		'options' => [],
		'env' => [],
	],
	'image' => [
		'enabled' => true,
		'binary' => __DIR__ . '/../vendor/h4cc/wkhtmltoimage-amd64/bin/wkhtmltoimage-amd64',
		'timeout' => false,
		'options' => [],
		'env' => [],
	],
];
