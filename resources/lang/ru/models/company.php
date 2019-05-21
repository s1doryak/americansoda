<?php

return [
    'labels' => [
        'singular' => 'Компания',
        'plural' => 'Компании',
		'create' => 'Создать'
    ],
	'index' => [
		'title' => 'Список компаний',
	],
    'trashed' => [
        'title' => 'Удаленные компании',
    ],
	'create' => [
		'title' => 'Новая компания',
	],
    'store' => [
	    'success' => 'Компания успешно создана!',
	    'error' => 'Не удалось создать компанию!'
    ],
    'show' => [
        'title' => 'Компания',
    ],
	'edit' => [
		'title' => 'Редактировать компанию',
	],
	'update' => [
		'success' => 'Компания успешно обновлена!',
		'error' => 'Не удалось обновить компанию!'
	],
	'trash' => [
        'title' => 'Переместить компанию в корзину',
		'success' => 'Компания успешно перемещена в корзину!',
		'error' => 'Не удалось переместить компанию в корзину!'
	],
    'restore' => [
        'title' => 'Восстановить компанию',
        'success' => 'Компания успешно восстановлена!',
        'error' => 'Не удалось восстановить компанию!'
    ],
    'destroy' => [
        'title' => 'Удалить компанию',
        'success' => 'Компания успешно удалена!',
        'error' => 'Не удалось удалить компанию!'
    ],
	'fields' => [
		'name' => 'Наименование',
		'legal_name' => 'Полное наименование',
		'short_name' => 'Сокращенное наименование',
		'postcode' => 'Индекс',
		'address' => 'Адрес',
		'bid' => 'ИНН',
		'email' => 'Эл. почта',
		'phone' => 'Телефон',
		'code' => 'Код',
		'smtp_host' => 'SMTP сервер',
		'smtp_port' => 'SMTP порт',
		'smtp_encryption' => 'SMTP шифрование',
		'smtp_username' => 'SMTP логин',
		'smtp_password' => 'SMTP пароль',
		'smtp_from' => 'SMTP почта отправителя',
		'smtp_from_name' => 'SMTP имя отправителя',
		'region' => [
			'name' => 'Регион',
		],
	],
    'placeholders' => [
		'region' => 'Выберите Регион',
    ],
    'columns' => [
		'name' => 'Наименование',
		'legal_name' => 'Полное наименование',
		'short_name' => 'Сокращенное наименование',
		'postcode' => 'Индекс',
		'address' => 'Адрес',
		'bid' => 'ИНН',
		'email' => 'Эл. почта',
		'phone' => 'Телефон',
		'code' => 'Код',
		'smtp_host' => 'SMTP сервер',
		'smtp_port' => 'SMTP порт',
		'smtp_encryption' => 'SMTP шифрование',
		'smtp_username' => 'SMTP логин',
		'smtp_password' => 'SMTP пароль',
		'smtp_from' => 'SMTP почта отправителя',
		'smtp_from_name' => 'SMTP имя отправителя',
		'region' => [
			'name' => 'Регион',
		],
        'created_at' => 'Создана',
        'updated_at' => 'Изменена',
        'deleted_at' => 'Удалена',
    ],
    'filters' => [
		'region' => [
			'name' => 'Регион',
		],
    ],
];