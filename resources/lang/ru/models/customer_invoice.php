<?php

return [
    'labels' => [
        'singular' => 'Счет',
        'plural' => 'Счета',
		'create' => 'Создать'
    ],
	'index' => [
		'title' => 'Список счетов',
	],
    'trashed' => [
        'title' => 'Удаленные счета',
    ],
	'create' => [
		'title' => 'Новый счет',
	],
    'store' => [
	    'success' => 'Счет успешно создан!',
	    'error' => 'Не удалось создать счет!'
    ],
    'show' => [
        'title' => 'Счет',
    ],
	'edit' => [
		'title' => 'Редактировать счет',
	],
	'update' => [
		'success' => 'Счет успешно обновлён!',
		'error' => 'Не удалось обновить счет!'
	],
	'trash' => [
        'title' => 'Переместить счет в корзину',
		'success' => 'Счет успешно перемещен в корзину!',
		'error' => 'Не удалось переместить счет в корзину!'
	],
    'restore' => [
        'title' => 'Восстановить счет',
        'success' => 'Счет успешно восстановлен!',
        'error' => 'Не удалось восстановить счет!'
    ],
    'destroy' => [
        'title' => 'Удалить счет',
        'success' => 'Счет успешно удалён!',
        'error' => 'Не удалось удалить счет!'
    ],
	'fields' => [
		'maventa_id' => 'Номер Maventa',
		'maventa_tiff' => 'TIFF файл',
		'maventa_initiated' => 'Был создан в Mavento',
		'currency' => 'Валюта',
		'data' => 'Данные',
		'date' => 'Дата создания',
		'date_due' => 'Дата оплаты',
		'delivery_date' => 'Дата доставки',
		'delivery_type' => 'Тип доставки',
		'error_message' => 'Текст ошибки',
		'invoice_delivery_address' => 'Адрес доставки счёта',
		'invoice_nr' => 'Номер счета',
		'invoice_seller_information' => 'Информация о продавце',
		'lang' => 'Язык',
		'notes' => 'Комментарии',
		'order_nr' => 'Номер заказа',
		'payment_terms' => 'Условия оплаты',
		'reference_nr' => 'Референс',
		'state' => 'Состояние',
		'status' => 'Статус',
		'sum' => 'Сумма',
		'sum_tax' => 'Сумма с НДС',
		'work_order_nr' => 'Номер заказа на работу',
		'company_interest' => 'Процентная ставка компании',
		'company_paper_fee' => 'Плата за бумажный счет',
		'company_reminder' => 'Плата за напоминание',
		'company_comment' => 'Комментарий к электронной почте',
		'company_reference' => 'Номер в системе продавца',
		'customer_nr' => 'Номер клиента',
		'customer_email' => 'Эл.почта клиента',
		'customer_name' => 'Название клиента',
		'customer_country' => 'Страна клиента',
		'customer_state' => 'Штат, округ, облась клиента',
		'customer_post_code' => 'Почтовый индекс клиента',
		'customer_post_office' => 'Почтовый адрес клиента',
		'customer_address1' => 'Адрес клиента',
		'customer_address2' => 'Адрес клиента (доп.)',
		'customer_contact_p' => 'Контактное лицо',
		'customer_bid' => 'BID',
		'customer_ovt' => 'OVT',
		'customer' => [
			'name' => 'Клиент',
		],
		'customerShipment' => [
			'number' => 'Отгрузка',
		],
		'companyBankAccounts' => [
			'name' => 'Счет компании',
		],
		'customerInvoiceItems' => [
			'name' => 'Позиции счета',
		],
		'customerInvoiceActions' => [
			'name' => 'Действия со счётом',
		],
		'customerInvoiceAttachments' => [
			'name' => 'Вложенные файлы',
		],
		'customerOrderItems' => [
			'name' => 'Позиции заказа',
		],
	],
    'placeholders' => [
		'customer' => 'Выберите Клиента',
		'customerShipment' => 'Выберите Отгрузку',
		'companyBankAccounts' => 'Выберите Счет компании',
		'customerInvoiceItems' => 'Выберите Позицию счета',
		'customerInvoiceActions' => 'Выберите Действие с счётом',
		'customerInvoiceAttachments' => 'Выберите Вложенный файл',
		'customerOrderItems' => 'Выберите Позицию заказа',
    ],
    'columns' => [
		'maventa_id' => 'Номер Maventa',
		'maventa_tiff' => 'TIFF файл',
		'maventa_initiated' => 'Был создан в Mavento',
		'currency' => 'Валюта',
		'data' => 'Данные',
		'date' => 'Дата создания',
		'date_due' => 'Дата оплаты',
		'delivery_date' => 'Дата доставки',
		'delivery_type' => 'Тип доставки',
		'error_message' => 'Текст ошибки',
		'invoice_delivery_address' => 'Адрес доставки счёта',
		'invoice_nr' => 'Номер счета',
		'invoice_seller_information' => 'Информация о продавце',
		'lang' => 'Язык',
		'notes' => 'Комментарии',
		'order_nr' => 'Номер заказа',
		'payment_terms' => 'Условия оплаты',
		'reference_nr' => 'Референс',
		'state' => 'Состояние',
		'status' => 'Статус',
		'sum' => 'Сумма',
		'sum_tax' => 'Сумма с НДС',
		'work_order_nr' => 'Номер заказа на работу',
		'company_interest' => 'Процентная ставка компании',
		'company_paper_fee' => 'Плата за бумажный счет',
		'company_reminder' => 'Плата за напоминание',
		'company_comment' => 'Комментарий к электронной почте',
		'company_reference' => 'Номер в системе продавца',
		'customer_nr' => 'Номер клиента',
		'customer_email' => 'Эл.почта клиента',
		'customer_name' => 'Название клиента',
		'customer_country' => 'Страна клиента',
		'customer_state' => 'Штат, округ, облась клиента',
		'customer_post_code' => 'Почтовый индекс клиента',
		'customer_post_office' => 'Почтовый адрес клиента',
		'customer_address1' => 'Адрес клиента',
		'customer_address2' => 'Адрес клиента (доп.)',
		'customer_contact_p' => 'Контактное лицо',
		'customer_bid' => 'BID',
		'customer_ovt' => 'OVT',
		'customer' => [
			'name' => 'Клиент',
		],
		'customerShipment' => [
			'number' => 'Отгрузка',
		],
		'companyBankAccounts' => [
			'name' => 'Счет компании',
		],
		'customerInvoiceItems' => [
			'name' => 'Позиции счета',
		],
		'customerInvoiceActions' => [
			'name' => 'Действия со счётом',
		],
		'customerInvoiceAttachments' => [
			'name' => 'Вложенные файлы',
		],
		'customerOrderItems' => [
			'name' => 'Позиции заказа',
		],
        'created_at' => 'Создан',
        'updated_at' => 'Изменён',
        'deleted_at' => 'Удалён',
    ],
    'filters' => [
		'customer' => [
			'name' => 'Клиент',
		],
		'customerShipment' => [
			'number' => 'Отгрузка',
		],
		'companyBankAccounts' => [
			'name' => 'Счет компании',
		],
		'customerInvoiceItems' => [
			'name' => 'Позиции счета',
		],
		'customerInvoiceActions' => [
			'name' => 'Действия со счётом',
		],
		'customerInvoiceAttachments' => [
			'name' => 'Вложенные файлы',
		],
		'customerOrderItems' => [
			'name' => 'Позиции заказа',
		],
    ],
];
