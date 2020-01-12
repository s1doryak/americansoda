<?php

return [
	'labels' => [
		'singular' => 'Клиент',
		'plural' => 'Клиенты',
		'create' => 'Создать'
	],
	'index' => [
		'title' => 'Список клиентов',
	],
	'trashed' => [
		'title' => 'Удаленные клиенты',
	],
	'create' => [
		'title' => 'Новый клиент',
	],
	'store' => [
		'success' => 'Клиент успешно создан!',
		'error' => 'Не удалось создать клиента!'
	],
	'show' => [
		'title' => 'Клиент',
	],
	'edit' => [
		'title' => 'Редактировать клиента',
	],
	'update' => [
		'success' => 'Клиент успешно обновлён!',
		'error' => 'Не удалось обновить клиента!'
	],
	'trash' => [
		'title' => 'Переместить клиента в корзину',
		'success' => 'Клиент успешно перемещен в корзину!',
		'error' => 'Не удалось переместить клиента в корзину!'
	],
	'restore' => [
		'title' => 'Восстановить клиента',
		'success' => 'Клиент успешно восстановлен!',
		'error' => 'Не удалось восстановить клиента!'
	],
	'destroy' => [
		'title' => 'Удалить клиента',
		'success' => 'Клиент успешно удалён!',
		'error' => 'Не удалось удалить клиента!'
	],
	'fields' => [
		'name' => 'Наименование',
		'legal_name' => 'Юридическое название',
		'billing_postcode' => 'Юр. индекс',
		'billing_address' => 'Юр. адрес',
		'shipping_postcode' => 'Факт. индекс',
		'shipping_address' => 'Факт. адрес',
		'iban' => 'IBAN',
		'swift' => 'SWIFT',
		'email' => 'Эл. почта',
		'phone' => 'Телефон',
		'order_interval' => 'Интервал заказов',
		'comment' => 'Комментарий',
		'calendar_comment' => 'Комментарий в календаре',
		'incomterms' => [
			'name' => 'Инкомтермс',
		],
		'terms_of_cooperation' => 'Условия сотрудничества',
		'terms_of_delivery' => 'Условия доставки',
		'terms_of_equipment' => 'Условия поставки оборудования',
		'delivery_payer' => [
			'name' => 'Доставку оплачивает',
		],
		'payment_conditions' => 'Условия оплаты',
		'pays_vat' => 'Плательщик НДС',
		'archived' => 'Неактивный',
		'nr' => 'Номер клиента',
		'country' => 'Страна клиента',
		'state' => 'Штат, округ, облась клиента',
		'post_code' => 'Почтовый индекс клиента',
		'post_office' => 'Почтовый адрес клиента',
		'address1' => 'Адрес клиента',
		'address2' => 'Адрес клиента (доп.)',
		'contact_p' => 'Контактное лицо',
        'y_tunnus' => 'Y-Tunnus',
        'bid' => 'BID',
		'ovt' => 'OVT',
		'priceGroup' => [
			'name' => 'Ценовая категория клиента',
		],
		'stock' => [
			'name' => 'Склад',
		],
		'customerType' => [
			'name' => 'Тип клиента',
		],
		'paymentType' => [
			'name' => 'Тип оплаты',
		],
		'user' => [
			'name' => 'Ответственный',
		],
		'billingRegion' => [
			'name' => 'Юр. регион',
		],
		'shippingRegion' => [
			'name' => 'Факт. регион',
		],
	],
	'placeholders' => [
		'stock' => 'Выберите Склад',
		'customerType' => 'Выберите Тип клиента',
		'paymentType' => 'Выберите Тип оплаты',
		'user' => 'Выберите Ответственного',
		'billingRegion' => 'Выберите Юр. регион',
		'shippingRegion' => 'Выберите Факт. регион',
		'priceGroup' => 'Выберите Ценовая категория клиента',
		'customerInvoices' => 'Выберите Счета пользователя',
	],
	'columns' => [
		'name' => 'Наименование',
		'legal_name' => 'Юридическое название',
		'billing_postcode' => 'Юр. индекс',
		'billing_address' => 'Юр. адрес',
		'shipping_postcode' => 'Факт. индекс',
		'shipping_address' => 'Факт. адрес',
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
		'archived' => 'Неактивный',
		'nr' => 'Номер клиента',
		'country' => 'Страна клиента',
		'state' => 'Штат, округ, облась клиента',
		'post_code' => 'Почтовый индекс клиента',
		'post_office' => 'Почтовый адрес клиента',
		'address1' => 'Адрес клиента',
		'address2' => 'Адрес клиента (доп.)',
		'contact_p' => 'Контактное лицо',
        'y_tunnus' => 'Y-Tunnus',
        'bid' => 'BID',
		'ovt' => 'OVT',
		'priceGroup' => [
			'name' => 'Ценовая категория клиента',
		],
		'stock' => [
			'name' => 'Склад',
		],
		'customerType' => [
			'name' => 'Тип клиента',
		],
		'paymentType' => [
			'name' => 'Тип оплаты',
		],
		'user' => [
			'name' => 'Ответственный',
		],
		'billingRegion' => [
			'name' => 'Юр. регион',
		],
		'shippingRegion' => [
			'name' => 'Факт. регион',
		],
		'created_at' => 'Создан',
		'updated_at' => 'Изменён',
		'deleted_at' => 'Удалён',
	],
	'filters' => [
		'priceGroup' => [
			'name' => 'Ценовая категория клиента',
		],
		'stock' => [
			'name' => 'Склад',
		],
		'customerType' => [
			'name' => 'Тип клиента',
		],
		'paymentType' => [
			'name' => 'Тип оплаты',
		],
		'user' => [
			'name' => 'Ответственный',
		],
		'billingRegion' => [
			'name' => 'Юр. регион',
		],
		'shippingRegion' => [
			'name' => 'Факт. регион',
		],
	],
    'requirements' => [
        'nr' => 'Необходимо сначала установить номер клиента.'
    ]
];
