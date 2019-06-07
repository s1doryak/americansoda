<?php

return [
    'labels' => [
        'singular' => 'Позиция предзаказа',
        'plural' => 'Позиции предзаказов',
		'create' => 'Создать'
    ],
	'index' => [
		'title' => 'Список позиций предзаказов',
	],
    'trashed' => [
        'title' => 'Удаленные позиции предзаказов',
    ],
	'create' => [
		'title' => 'Новая позиция предзаказа',
	],
    'store' => [
	    'success' => 'Позиция предзаказа успешно создана!',
	    'error' => 'Не удалось создать позицию предзаказа!'
    ],
    'show' => [
        'title' => 'Позиция предзаказа',
    ],
	'edit' => [
		'title' => 'Редактировать позицию предзаказа',
	],
	'update' => [
		'success' => 'Позиция предзаказа успешно обновлена!',
		'error' => 'Не удалось обновить позицию предзаказа!'
	],
	'trash' => [
        'title' => 'Переместить позицию предзаказа в корзину',
		'success' => 'Позиция предзаказа успешно перемещена в корзину!',
		'error' => 'Не удалось переместить позицию предзаказа в корзину!'
	],
    'restore' => [
        'title' => 'Восстановить позицию предзаказа',
        'success' => 'Позиция предзаказа успешно восстановлена!',
        'error' => 'Не удалось восстановить позицию предзаказа!'
    ],
    'destroy' => [
        'title' => 'Удалить позицию предзаказа',
        'success' => 'Позиция предзаказа успешно удалена!',
        'error' => 'Не удалось удалить позицию предзаказа!'
    ],
	'fields' => [
		'quantity' => 'Кол-во лот',
		'products_quantity' => 'Кол-во товаров',
		'price' => 'Цена',
		'vat_price' => 'Цена с НДС',
		'total_price' => 'Итого',
		'total_vat_price' => 'Итого с НДС',
		'deposit_price' => 'Депозит',
		'deposit_vat_price' => 'Депозит с НДС',
		'total_deposit_price' => 'Итого депозит',
		'total_deposit_vat_price' => 'Итого депозит с НДС',
		'customerPreOrder' => [
			'number' => 'Предзаказ клиента',
		],
		'customerUser' => [
			'name' => 'Сотрудник клиента',
		],
		'customer' => [
			'name' => 'Клиент',
		],
		'product' => [
			'name' => 'Товар',
		],
	],
    'placeholders' => [
		'customerPreOrder' => 'Выберите Предзаказ клиента',
		'customerUser' => 'Выберите Сотрудника клиента',
		'customer' => 'Выберите Клиента',
		'product' => 'Выберите Товар',
    ],
    'columns' => [
		'quantity' => 'Кол-во лот',
		'products_quantity' => 'Кол-во товаров',
		'price' => 'Цена',
		'vat_price' => 'Цена с НДС',
		'total_price' => 'Итого',
		'total_vat_price' => 'Итого с НДС',
		'deposit_price' => 'Депозит',
		'deposit_vat_price' => 'Депозит с НДС',
		'total_deposit_price' => 'Итого депозит',
		'total_deposit_vat_price' => 'Итого депозит с НДС',
		'customerPreOrder' => [
			'number' => 'Предзаказ клиента',
		],
		'customerUser' => [
			'name' => 'Сотрудник клиента',
		],
		'customer' => [
			'name' => 'Клиент',
		],
		'product' => [
			'name' => 'Товар',
		],
        'created_at' => 'Создана',
        'updated_at' => 'Изменена',
        'deleted_at' => 'Удалена',
    ],
    'filters' => [
		'customerPreOrder' => [
			'number' => 'Предзаказ клиента',
		],
		'customerUser' => [
			'name' => 'Сотрудник клиента',
		],
		'customer' => [
			'name' => 'Клиент',
		],
		'product' => [
			'name' => 'Товар',
		],
    ],
];