<?php

return [
    'labels' => [
        'singular' => 'Customer User Subscribe',
        'plural' => 'Customer User Subscribes',
        'create' => 'Создать'
    ],
    'index' => [
        'title' => 'Список Customer User Subscribe',
    ],
    'trashed' => [
        'title' => 'Удаленные Customer User Subscribes',
    ],
    'create' => [
        'title' => 'Новый Customer User Subscribe',
    ],
    'store' => [
        'success' => 'Customer User Subscribe успешно создан!',
        'error' => 'Не удалось создать Customer User Subscribe!'
    ],
    'show' => [
        'title' => 'Customer User Subscribe',
    ],
    'edit' => [
        'title' => 'Редактировать Customer User Subscribe',
    ],
    'update' => [
        'success' => 'Customer User Subscribe успешно обновлён!',
        'error' => 'Не удалось обновить Customer User Subscribe!'
    ],
    'trash' => [
        'title' => 'Переместить Customer User Subscribe в корзину',
        'success' => 'Customer User Subscribe успешно перемещен в корзину!',
        'error' => 'Не удалось переместить Customer User Subscribe в корзину!'
    ],
    'restore' => [
        'title' => 'Восстановить Customer User Subscribe',
        'success' => 'Customer User Subscribe успешно восстановлен!',
        'error' => 'Не удалось восстановить Customer User Subscribe!'
    ],
    'destroy' => [
        'title' => 'Удалить Customer User Subscribe',
        'success' => 'Customer User Subscribe успешно удалён!',
        'error' => 'Не удалось удалить Customer User Subscribe!'
    ],
    //    'customAction' => [
    //        'title' => 'Сделать Customer User Subscribe',
    //        'success' => 'Customer User Subscribe сделан успешно!',
    //        'redirect' => 'Customer User Subscribe сделан успешно!',
    //        'error' => 'Не удалось сделать Customer User Subscribe!',
    //    ],
    'fields' => [

		'product' => [
			'name' => 'Товар',
		],
		'customerUser' => [
			'name' => 'Сотрудник Клиента',
		],
    ],
    'placeholders' => [
		'product' => 'Выберите %s',
		'customerUser' => 'Выберите %s',
        'customer' => 'Выберите ',
    ],
    'columns' => [

		'product' => [
			'name' => 'Товар',
		],
		'customerUser' => [
			'name' => 'Сотрудник Клиента',
		],
        'created_at' => 'Создан',
        'updated_at' => 'Изменён',
        'deleted_at' => 'Удалён',
    ],
    'filters' => [
		'product' => [
			'name' => 'Товар',
		],
		'customerUser' => [
			'name' => 'Сотрудник Клиента',
		],
    ],
];
