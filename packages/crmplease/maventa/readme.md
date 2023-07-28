# Laravel API service provider for Maventa e-invoicing

[Maventa](https://maventa.com/e-invoicing/) is a user friendly e-invoicing service suitable for SME’s to multinational corporations. 

Maventa can be connected into existing ERP-system or used as a separate internet based software. 

Start using in 15 minutes with no opening or monthly fees.

## Репозиторий

Добавьте репозиторий в `composer.json`:
```bash
# SSH
composer config repositories.maventa vcs git@gitlab.crmplease.me:crmplease/maventa.git

# HTTP (если не доступно клонирование по SSH)
composer config repositories.maventa vcs https://gitlab.crmplease.me/crmplease/maventa
```

## Установка
```bash
composer require crmplease/maventa
```

Для обновления пакета выполните команду:
```bash
composer update crmplease/maventa
```

## Параметры приложения и переменные окружения

Добавьте пользовательские параметры приложения в файл `config/maventa.php`:
```php
'mango_office' => [
    'url' => env('MANGO_OFFICE_BASE_URL', null),
    'key' => env('MANGO_OFFICE_API_KEY', null),
    'salt' => env('MANGO_OFFICE_API_SALT', null),
]
```

Добавьте переменные окружения в `.env` файл:
```bash
MAVENTA_CONNECTION=testing

MAVENTA_TESTING_BASE_URL=https://testing.maventa.com/apis/v1.1/wsdl
MAVENTA_TESTING_USER_API_KEY=
MAVENTA_TESTING_COMPANY_UUID=
MAVENTA_TESTING_VENDOR_API_KEY=

MAVENTA_SECURE_BASE_URL=https://secure.maventa.com/apis/v1.1/wsdl
MAVENTA_SECURE_USER_API_KEY=
MAVENTA_SECURE_COMPANY_UUID=
MAVENTA_SECURE_VENDOR_API_KEY=
```

**Готово** 🎉

Пакет настроен и готов к использованию.