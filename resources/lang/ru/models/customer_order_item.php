<?php

return [
    'labels' => [
        'singular' => 'Строка заказа',
        'plural' => 'Строки заказа',
		'create' => 'Создать'
    ],
	'index' => [
		'title' => 'Список строк заказов',
	],
    'trashed' => [
        'title' => 'Удаленные строки заказа',
    ],
	'create' => [
		'title' => 'Новая строка заказа',
	],
    'store' => [
	    'success' => 'Строка заказа успешно создана!',
	    'error' => 'Не удалось создать строку заказа!'
    ],
    'show' => [
        'title' => 'Строка заказа',
    ],
	'edit' => [
		'title' => 'Редактировать строку заказа',
	],
	'update' => [
		'success' => 'Строка заказа успешно обновлена!',
		'error' => 'Не удалось обновить строку заказа!'
	],
	'trash' => [
        'title' => 'Переместить строку заказа в корзину',
		'success' => 'Строка заказа успешно перемещена в корзину!',
		'error' => 'Не удалось переместить строку заказа в корзину!'
	],
    'restore' => [
        'title' => 'Восстановить строку заказа',
        'success' => 'Строка заказа успешно восстановлена!',
        'error' => 'Не удалось восстановить строку заказа!'
    ],
    'destroy' => [
        'title' => 'Удалить строку заказа',
        'success' => 'Строка заказа успешно удалена!',
        'error' => 'Не удалось удалить строку заказа!'
    ],
	'fields' => [
		'status' => 'Статус',
		'product_name' => 'Товар',
		'sales_unit_quantity' => 'Лот',
		'product_manual_price' => 'Произвольная цена',
		'product_price' => 'Цена',
		'vat' => 'НДС',
		'product_vat_price' => 'Цена с НДС',
		'products_quantity' => 'Кол-во товаров',
		'packages_quantity' => 'Кол-во упакеовок',
		'total_price' => 'Сумма',
		'total_vat_price' => 'Сумма с НДС',
		'deposit_enabled' => 'Депозит',
		'deposit_price' => 'Цена депозита',
		'deposit_vat' => 'НДС депозита',
		'deposit_vat_price' => 'Цена депозита с НДС',
		'deposit_total_price' => 'Сумма с депозитом',
		'deposit_total_vat' => 'Сумма НДС депозита',
		'deposit_total_vat_price' => 'Сумма с НДС депозита',
		'bypass' => 'Не списывать со склада',
		'back_order' => 'Отложенный заказ',
		'cancelled' => 'Отмененный заказ',
		'expected_date' => 'Будет поставлен',
		'product' => [
			'name' => 'Товар',
		],
		'customer' => [
			'name' => 'Клиент',
		],
		'customerOrder' => [
			'name' => 'Заказ',
		],
		'customerShipment' => [
			'name' => 'Отгрузка',
		],
	],
    'placeholders' => [
		'product' => 'Выберите Товар',
		'customer' => 'Выберите Клиента',
		'customerOrder' => 'Выберите Заказ',
		'customerShipment' => 'Выберите Отгрузку',
    ],
    'columns' => [
		'status' => 'Статус',
		'product_name' => 'Товар',
		'sales_unit_quantity' => 'Лот',
		'product_manual_price' => 'Произвольная цена',
		'product_price' => 'Цена',
		'vat' => 'НДС',
		'product_vat_price' => 'Цена с НДС',
		'products_quantity' => 'Кол-во товаров',
		'packages_quantity' => 'Кол-во упакеовок',
		'total_price' => 'Сумма',
		'total_vat_price' => 'Сумма с НДС',
		'deposit_enabled' => 'Депозит',
		'deposit_price' => 'Цена депозита',
		'deposit_vat' => 'НДС депозита',
		'deposit_vat_price' => 'Цена депозита с НДС',
		'deposit_total_price' => 'Сумма с депозитом',
		'deposit_total_vat' => 'Сумма НДС депозита',
		'deposit_total_vat_price' => 'Сумма с НДС депозита',
		'bypass' => 'Не списывать со склада',
		'back_order' => 'Отложенный заказ',
		'cancelled' => 'Отмененный заказ',
		'expected_date' => 'Будет поставлен',
		'product' => [
			'name' => 'Товар',
		],
		'customer' => [
			'name' => 'Клиент',
		],
		'customerOrder' => [
			'name' => 'Заказ',
		],
		'customerShipment' => [
			'name' => 'Отгрузка',
		],
        'created_at' => 'Создана',
        'updated_at' => 'Изменена',
        'deleted_at' => 'Удалена',
    ],
    'filters' => [
		'product' => [
			'name' => 'Товар',
		],
		'customer' => [
			'name' => 'Клиент',
		],
		'customerOrder' => [
			'name' => 'Заказ',
		],
		'customerShipment' => [
			'name' => 'Отгрузка',
		],
    ],
];