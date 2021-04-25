<?php

return [
    'labels' => [
        'singular' => 'Сообщение LTP',
        'plural' => 'Сообщения LTP',
        'create' => 'Создать'
    ],
    'index' => [
        'title' => 'Список сообщений ltp',
    ],
    'trashed' => [
        'title' => 'Удаленные сообщения ltp',
    ],
    'create' => [
        'title' => 'Новый сообщение ltp',
    ],
    'store' => [
        'success' => 'Сообщение LTP успешно создан!',
        'error' => 'Не удалось создать сообщения ltp!'
    ],
    'show' => [
        'title' => 'Сообщение LTP',
    ],
    'edit' => [
        'title' => 'Редактировать сообщения ltp',
    ],
    'update' => [
        'success' => 'Сообщение LTP успешно обновлён!',
        'error' => 'Не удалось обновить сообщения ltp!'
    ],
    'trash' => [
        'title' => 'Переместить сообщения ltp в корзину',
        'success' => 'Сообщение LTP успешно перемещен в корзину!',
        'error' => 'Не удалось переместить сообщения ltp в корзину!'
    ],
    'restore' => [
        'title' => 'Восстановить сообщения ltp',
        'success' => 'Сообщение LTP успешно восстановлен!',
        'error' => 'Не удалось восстановить сообщения ltp!'
    ],
    'destroy' => [
        'title' => 'Удалить сообщения ltp',
        'success' => 'Сообщение LTP успешно удалён!',
        'error' => 'Не удалось удалить сообщения ltp!'
    ],
    //    'customAction' => [
    //        'title' => 'Сделать сообщения ltp',
    //        'success' => 'Сообщение LTP сделан успешно!',
    //        'redirect' => 'Сообщение LTP сделан успешно!',
    //        'error' => 'Не удалось сделать сообщения ltp!',
    //    ],
    'fields' => [
		'sender_identifier' => 'Идентификатор отправителя',
		'sender_description' => 'Sender Description',
		'filename_hint' => 'Название файла',
		'content' => 'Содержимое',

    ],
    'placeholders' => [

    ],
    'columns' => [
		'sender_identifier' => 'Идентификатор отправителя',
		'sender_description' => 'Sender Description',
		'filename_hint' => 'Название файла',
		'content' => 'Содержимое',

        'created_at' => 'Создан',
        'updated_at' => 'Изменён',
        'deleted_at' => 'Удалён',
    ],
    'filters' => [

    ],
];
