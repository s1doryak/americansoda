<?php

return [
    'labels' => [
        'singular' => 'Сообщение LTP',
        'plural' => 'Сообщения LTP',
        'create' => 'Создать'
    ],
    'index' => [
        'title' => 'Список сообщений LTP',
    ],
    'trashed' => [
        'title' => 'Удаленные сообщения LTP',
    ],
    'create' => [
        'title' => 'Новый сообщение LTP',
    ],
    'store' => [
        'success' => 'Сообщение LTP успешно создан!',
        'error' => 'Не удалось создать сообщения LTP!'
    ],
    'show' => [
        'title' => 'Сообщение LTP',
    ],
    'edit' => [
        'title' => 'Редактировать сообщения LTP',
    ],
    'update' => [
        'success' => 'Сообщение LTP успешно обновлён!',
        'error' => 'Не удалось обновить сообщения LTP!'
    ],
    'trash' => [
        'title' => 'Переместить сообщения LTP в корзину',
        'success' => 'Сообщение LTP успешно перемещен в корзину!',
        'error' => 'Не удалось переместить сообщения LTP в корзину!'
    ],
    'restore' => [
        'title' => 'Восстановить сообщения LTP',
        'success' => 'Сообщение LTP успешно восстановлен!',
        'error' => 'Не удалось восстановить сообщения LTP!'
    ],
    'destroy' => [
        'title' => 'Удалить сообщения LTP',
        'success' => 'Сообщение LTP успешно удалён!',
        'error' => 'Не удалось удалить сообщения LTP!'
    ],
    //    'customAction' => [
    //        'title' => 'Сделать сообщения LTP',
    //        'success' => 'Сообщение LTP сделан успешно!',
    //        'redirect' => 'Сообщение LTP сделан успешно!',
    //        'error' => 'Не удалось сделать сообщения LTP!',
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
		'sender_description' => 'Описание отправителя',
		'filename_hint' => 'Название файла',
		'content' => 'Содержимое',

        'created_at' => 'Создан',
        'updated_at' => 'Изменён',
        'deleted_at' => 'Удалён',
    ],
    'filters' => [

    ],
];
