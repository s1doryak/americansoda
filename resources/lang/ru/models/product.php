<?php

return [
    'labels' => [
        'singular' => 'Товар',
        'plural' => 'Товары',
		'create' => 'Создать'
    ],
	'index' => [
		'title' => 'Список товаров',
	],
    'trashed' => [
        'title' => 'Удаленные товары',
    ],
	'create' => [
		'title' => 'Новый товар',
	],
    'store' => [
	    'success' => 'Товар успешно создан!',
	    'error' => 'Не удалось создать товар!'
    ],
    'show' => [
        'title' => 'Товар',
    ],
	'edit' => [
		'title' => 'Редактировать товар',
	],
	'update' => [
		'success' => 'Товар успешно обновлён!',
		'error' => 'Не удалось обновить товар!'
	],
	'trash' => [
        'title' => 'Переместить товар в корзину',
		'success' => 'Товар успешно перемещен в корзину!',
		'error' => 'Не удалось переместить товар в корзину!'
	],
    'restore' => [
        'title' => 'Восстановить товар',
        'success' => 'Товар успешно восстановлен!',
        'error' => 'Не удалось восстановить товар!'
    ],
    'destroy' => [
        'title' => 'Удалить товар',
        'success' => 'Товар успешно удалён!',
        'error' => 'Не удалось удалить товар!'
    ],
	'fields' => [
		'name' => 'Название',
		'product_barcode' => 'Штрихкод',
		'product_barcode_plaintext' => 'Штрихкод (текст)',
		'package_barcode' => 'Штрихкод упаковки',
		'package_barcode_plaintext' => 'Штрихкод упаковк (текст)',
		'product_image' => 'Фото',
		'package_image' => 'Фото упаковки',
		'description' => 'Описание',
		'contents' => 'Состав',
		'number_in_package' => 'Ед. в упаковке',
		'weight' => 'Вес',
		'volume' => 'Объем',
		'brutto_weight' => 'Вес (брутто)',
		'brutto_volume' => 'Объем (брутто)',
		'deposit_enabled' => 'Депозит',
		'deposit_price' => 'Цена депозита',
		'deposit_vat' => 'НДС депозита',
		'deposit_vat_price' => 'Цена с НДС депозита',
		'comment' => 'Комментарий',
		'brand' => [
			'name' => 'Бренд',
		],
		'packageType' => [
			'name' => 'Тип упаковки',
		],
		'productGroup' => [
			'name' => 'Товарная категория',
		],
		'productTags' => [
			'name' => 'Теги',
		],
	],
    'placeholders' => [
		'brand' => 'Выберите Бренд',
		'packageType' => 'Выберите Тип упаковки',
		'productGroup' => 'Выберите Товарную категорию',
		'productTags' => 'Выберите теги',
    ],
    'columns' => [
		'name' => 'Название',
		'product_barcode' => 'Штрихкод',
		'product_barcode_plaintext' => 'Штрихкод (текст)',
		'package_barcode' => 'Штрихкод упаковки',
		'package_barcode_plaintext' => 'Штрихкод упаковк (текст)',
		'product_image' => 'Фото',
		'package_image' => 'Фото упаковки',
		'description' => 'Описание',
		'contents' => 'Состав',
		'number_in_package' => 'Ед. в упаковке',
		'weight' => 'Вес',
		'volume' => 'Объем',
		'brutto_weight' => 'Вес (брутто)',
		'brutto_volume' => 'Объем (брутто)',
		'deposit_enabled' => 'Депозит',
		'deposit_price' => 'Цена депозита',
		'deposit_vat' => 'НДС депозита',
		'deposit_vat_price' => 'Цена с НДС депозита',
		'comment' => 'Комментарий',
		'brand' => [
			'name' => 'Бренд',
		],
		'packageType' => [
			'name' => 'Тип упаковки',
		],
		'productGroup' => [
			'name' => 'Товарная категория',
		],
		'productTags' => [
			'name' => 'Теги',
		],
        'created_at' => 'Создан',
        'updated_at' => 'Изменён',
        'deleted_at' => 'Удалён',
    ],
    'filters' => [
		'brand' => [
			'name' => 'Бренд',
		],
		'packageType' => [
			'name' => 'Тип упаковки',
		],
		'productGroup' => [
			'name' => 'Товарная категория',
		],
		'productTags' => [
			'name' => 'Теги',
		],
    ],
];