<?php

return [
    'labels' => [
        'singular' => 'История клиента',
        'plural' => 'Истории клиентов',
		'create' => 'Создать'
    ],
	'index' => [
		'title' => 'Список историй клиентов',
	],
    'trashed' => [
        'title' => 'Удаленные истории клиентов',
    ],
	'create' => [
		'title' => 'Новая история клиента',
	],
    'store' => [
	    'success' => 'История клиента успешно создана!',
	    'error' => 'Не удалось создать историю клиента!'
    ],
    'show' => [
        'title' => 'История клиента',
    ],
	'edit' => [
		'title' => 'Редактировать историю клиента',
	],
	'update' => [
		'success' => 'История клиента успешно обновлена!',
		'error' => 'Не удалось обновить историю клиента!'
	],
	'trash' => [
        'title' => 'Переместить историю клиента в корзину',
		'success' => 'История клиента успешно перемещена в корзину!',
		'error' => 'Не удалось переместить историю клиента в корзину!'
	],
    'restore' => [
        'title' => 'Восстановить историю клиента',
        'success' => 'История клиента успешно восстановлена!',
        'error' => 'Не удалось восстановить историю клиента!'
    ],
    'destroy' => [
        'title' => 'Удалить историю клиента',
        'success' => 'История клиента успешно удалена!',
        'error' => 'Не удалось удалить историю клиента!'
    ],
	'fields' => [
		'revision_type' => 'Тип',
		'name' => 'Наименование',
		'legal_name' => 'Юридическое название',
		'billing_postcode' => 'Юр. индекс',
		'billing_address' => 'Юр. адрес',
		'shipping_postcode' => 'Факт. индекс',
		'shipping_address' => 'Факт. адрес',
		'bid' => 'ИНН',
		'iban' => 'IBAN',
		'swift' => 'SWIFT',
		'email' => 'Эл. почта',
		'phone' => 'Телефон',
		'order_interval' => 'Интервал заказов',
		'comment' => 'Комментарий',
		'calendar_comment' => 'Комментарий в календаре',
		'incomterms' => 'Инкомтермс',
		'terms_of_cooperation' => 'Условия сотрудничества',
		'terms_of_delivery' => 'Условия доставки',
		'terms_of_equipment' => 'Условия поставки оборудования',
		'delivery_payer' => 'Доставку оплачивает',
		'payment_conditions' => 'Условия оплаты',
		'pays_vat' => 'Плательщик НДС',
		'revision' => [
			'name' => 'Revision',
		],
		'editor' => [
			'name' => 'Editor',
		],
		'stock' => [
			'name' => 'Stock',
		],
		'customerType' => [
			'name' => 'Customer Type',
		],
		'paymentType' => [
			'name' => 'Payment Type',
		],
		'user' => [
			'name' => 'User',
		],
		'billingRegion' => [
			'name' => 'Юр. регион',
		],
		'shippingRegion' => [
			'name' => 'Факт. регион',
		],
	],
    'placeholders' => [
		'revision' => 'Выберите Revision',
		'editor' => 'Выберите Editor',
		'stock' => 'Выберите Stock',
		'customerType' => 'Выберите Customer Type',
		'paymentType' => 'Выберите Payment Type',
		'user' => 'Выберите User',
		'billingRegion' => 'Выберите Юр. регион',
		'shippingRegion' => 'Выберите Факт. регион',
    ],
    'columns' => [
		'revision_type' => 'Тип',
		'name' => 'Наименование',
		'legal_name' => 'Юридическое название',
		'billing_postcode' => 'Юр. индекс',
		'billing_address' => 'Юр. адрес',
		'shipping_postcode' => 'Факт. индекс',
		'shipping_address' => 'Факт. адрес',
		'bid' => 'ИНН',
		'iban' => 'IBAN',
		'swift' => 'SWIFT',
		'email' => 'Эл. почта',
		'phone' => 'Телефон',
		'order_interval' => 'Интервал заказов',
		'comment' => 'Комментарий',
		'calendar_comment' => 'Комментарий в календаре',
		'incomterms' => 'Инкомтермс',
		'terms_of_cooperation' => 'Условия сотрудничества',
		'terms_of_delivery' => 'Условия доставки',
		'terms_of_equipment' => 'Условия поставки оборудования',
		'delivery_payer' => 'Доставку оплачивает',
		'payment_conditions' => 'Условия оплаты',
		'pays_vat' => 'Плательщик НДС',
		'revision' => [
			'name' => 'Revision',
		],
		'editor' => [
			'name' => 'Editor',
		],
		'stock' => [
			'name' => 'Stock',
		],
		'customerType' => [
			'name' => 'Customer Type',
		],
		'paymentType' => [
			'name' => 'Payment Type',
		],
		'user' => [
			'name' => 'User',
		],
		'billingRegion' => [
			'name' => 'Юр. регион',
		],
		'shippingRegion' => [
			'name' => 'Факт. регион',
		],
        'created_at' => 'Создана',
        'updated_at' => 'Изменена',
        'deleted_at' => 'Удалена',
    ],
    'filters' => [
		'revision' => [
			'name' => 'Revision',
		],
		'editor' => [
			'name' => 'Editor',
		],
		'stock' => [
			'name' => 'Stock',
		],
		'customerType' => [
			'name' => 'Customer Type',
		],
		'paymentType' => [
			'name' => 'Payment Type',
		],
		'user' => [
			'name' => 'User',
		],
		'billingRegion' => [
			'name' => 'Юр. регион',
		],
		'shippingRegion' => [
			'name' => 'Факт. регион',
		],
    ],
];