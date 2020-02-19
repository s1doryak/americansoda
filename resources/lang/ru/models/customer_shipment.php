<?php

return [
    'labels' => [
        'singular' => 'Отгрузка',
        'plural' => 'Отгрузки',
		'create' => 'Создать'
    ],
	'index' => [
		'title' => 'Список отгрузок',
	],
    'trashed' => [
        'title' => 'Удаленные отгрузки',
    ],
	'create' => [
		'title' => 'Новая отгрузка',
	],
    'store' => [
	    'success' => 'Отгрузка успешно создана!',
	    'error' => 'Не удалось создать отгрузку!'
    ],
    'show' => [
        'title' => 'Отгрузка',
    ],
	'edit' => [
		'title' => 'Редактировать отгрузку',
	],
	'update' => [
		'success' => 'Отгрузка успешно обновлена!',
		'error' => 'Не удалось обновить отгрузку!'
	],
	'trash' => [
        'title' => 'Переместить отгрузку в корзину',
		'success' => 'Отгрузка успешно перемещена в корзину!',
		'error' => 'Не удалось переместить отгрузку в корзину!'
	],
    'restore' => [
        'title' => 'Восстановить отгрузку',
        'success' => 'Отгрузка успешно восстановлена!',
        'error' => 'Не удалось восстановить отгрузку!'
    ],
    'destroy' => [
        'title' => 'Удалить отгрузку',
        'success' => 'Отгрузка успешно удалена!',
        'error' => 'Не удалось удалить отгрузку!'
    ],
    'package_list' => [
        'title' => 'Лист сборки',
    ],
    'waybill' => [
        'title' => 'Товарная накладная',
    ],
    'invoice' => [
        'title' => 'Счёт',
    ],
	'fields' => [
		'number' => 'Номер отгурзки',
		'assembly_number' => 'Номер сборки',
		'invoice_number' => 'Номер счёта',
		'status' => 'Статус',
		'delivery_type' => 'Тип доставки',
		'packages_quantity' => 'Количество упаковок',
		'comment' => 'Комментарий',
		'packageType' => [
			'name' => 'Тип упаковки',
		],
		'customer' => [
			'name' => 'Клиент',
		],
		'user' => [
			'name' => 'Менеджер',
		],
	],
    'placeholders' => [
		'packageType' => 'Выберите Тип упаковки',
		'customer' => 'Выберите Клиента',
		'user' => 'Выберите Менеджера',
    ],
    'columns' => [
		'number' => 'Номер отгурзки',
		'assembly_number' => 'Номер сборки',
		'invoice_number' => 'Номер счёта',
		'status' => 'Статус',
		'delivery_type' => 'Тип доставки',
		'packages_quantity' => 'Количество упаковок',
		'comment' => 'Комментарий',
		'packageType' => [
			'name' => 'Тип упаковки',
		],
		'customer' => [
			'name' => 'Клиент',
		],
        'customer_id' => [
            'name' => 'Клиент',
        ],
		'user' => [
			'name' => 'Менеджер',
		],
        'customerOrderItems' => [
            'customerOrder' => [
                'number' => 'Номера заказов',
                'batch_number' => 'Номера в систете клиентов',
            ]
        ],
        'delivery_date' => 'Дата доставки',
        'order_numbers' => 'Номера заказов',
        'order_batch_numbers' => 'Номера в систете клиентов',
        'created_at' => 'Создана',
        'updated_at' => 'Изменена',
        'deleted_at' => 'Удалена',
    ],
    'filters' => [
		'packageType' => [
			'name' => 'Тип упаковки',
		],
		'customer' => [
			'name' => 'Клиент',
		],
		'user' => [
			'name' => 'Менеджер',
		],
        'status' => 'Статус',
        'number' => 'Номер',
    ],
    'statuses' => [
        'open' => 'Новый',
        'assembly' => 'Сборка',
        'shipment' => 'Отгрузка',
        'invoice' => 'Счёт',
        'reject' => 'Отказ',
    ],
];
