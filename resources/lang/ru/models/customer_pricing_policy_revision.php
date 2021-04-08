<?php

return [
    'labels' => [
        'singular' => 'История ценовой политики',
        'plural' => 'Истории ценовых политики',
		'create' => 'Создать'
    ],
	'index' => [
		'title' => 'Истории ценовых политик',
	],
    'trashed' => [
        'title' => 'Удаленные истории ценовых политик',
    ],
	'create' => [
		'title' => 'Новая история ценовой политики',
	],
    'store' => [
	    'success' => 'История ценовой политики успешно создана!',
	    'error' => 'Не удалось создать историю ценовой политики!'
    ],
    'show' => [
        'title' => 'История ценовой политики',
    ],
	'edit' => [
		'title' => 'Редактировать историю ценовой политики',
	],
	'update' => [
		'success' => 'История ценовой политики успешно обновлена!',
		'error' => 'Не удалось обновить историю ценовой политики!'
	],
	'trash' => [
        'title' => 'Переместить историю ценовой политики в корзину',
		'success' => 'История ценовой политики успешно перемещена в корзину!',
		'error' => 'Не удалось переместить историю ценовой политики в корзину!'
	],
    'restore' => [
        'title' => 'Восстановить историю ценовой политики',
        'success' => 'История ценовой политики успешно восстановлена!',
        'error' => 'Не удалось восстановить историю ценовой политики!'
    ],
    'destroy' => [
        'title' => 'Удалить историю ценовой политики',
        'success' => 'История ценовой политики успешно удалена!',
        'error' => 'Не удалось удалить историю ценовой политики!'
    ],
	'fields' => [
		'revision_type' => 'Тип',
		'revision_number' => 'Номер ревизии',
		'products_range' => 'Кол-во лот',
		'price' => 'Цена',
		'revision' => [
			'name' => 'Revision',
		],
		'customerPricingPolicy' => [
			'name' => 'Customer Pricing Policy',
		],
		'editor' => [
			'name' => 'Editor',
		],
		'productGroup' => [
			'name' => 'Товарная группа',
		],
		'customer' => [
			'name' => 'Клиент',
		],
	],
    'placeholders' => [
		'revision' => 'Выберите Revision',
		'customerPricingPolicy' => 'Выберите Customer Pricing Policy',
		'editor' => 'Выберите Editor',
		'productGroup' => 'Выберите Товарную группу',
		'customer' => 'Выберите Клиента',
    ],
    'columns' => [
		'revision_type' => 'Тип',
		'revision_number' => 'Номер ревизии',
		'products_range' => 'Кол-во лот',
		'price' => 'Цена',
		'revision' => [
			'name' => 'Revision',
		],
		'customerPricingPolicy' => [
			'name' => 'Customer Pricing Policy',
		],
		'editor' => [
			'name' => 'Editor',
		],
		'productGroup' => [
			'name' => 'Товарная группа',
		],
		'customer' => [
			'name' => 'Клиент',
		],
        'created_at' => 'Создана',
        'updated_at' => 'Изменена',
        'deleted_at' => 'Удалена',
    ],
    'filters' => [
		'revision' => [
			'name' => 'Revision',
		],
		'customerPricingPolicy' => [
			'name' => 'Customer Pricing Policy',
		],
		'editor' => [
			'name' => 'Editor',
		],
		'productGroup' => [
			'name' => 'Товарная группа',
		],
		'customer' => [
			'name' => 'Клиент',
		],
    ],
];
