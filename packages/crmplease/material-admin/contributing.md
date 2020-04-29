## Компоненты

Material Admin - Responsive Admin Theme - https://wrapbootstrap.com/theme/material-admin-responsive-admin-theme-WB011H985

Countrys Flags - https://www.flaticon.com/packs/countrys-flags

## Подключение пакета

### Зависимости пакета
```bash
docker-compose run composer require \
   barryvdh/laravel-snappy \
   doctrine/dbal \
   h4cc/wkhtmltoimage-amd64 \
   h4cc/wkhtmltopdf-amd64 \
   imagine/imagine \
   kris/laravel-form-builder \
   laravelcollective/html \
   prettus/l5-repository \
   ramsey/uuid \
   yajra/laravel-datatables \
   jenssegers/date
```

### Каталог с пакетом

```bash
mkdir -p packages/crmplease/material-admin
git clone git@gitlab.crmplease.me:crmplease/material-admin.git packages/crmplease/material-admin
```

### Автозагрузка классов

В файл `composer.json` необходимо добавить следующие директивы:
```json
{
    "autoload": {
        "psr-4": {
            "Crmplease\\MaterialAdmin\\": "packages/crmplease/material-admin/src/"
        },
        "files": [
            "packages/crmplease/material-admin/src/helpers.php"
        ]
    }
}
```

### Параметры приложения и переменные окружения

Измените значения по-умолчанию для параметров локализации в файле `config/app.php`:
```php
return [

    // ...

	/*
	|--------------------------------------------------------------------------
	| Application Timezone
	|--------------------------------------------------------------------------
	*/
    'timezone' => env('APP_TIMEZONE', 'UTC'),

	/*
	|--------------------------------------------------------------------------
	| Application Locale Configuration
	|--------------------------------------------------------------------------
	*/
    'locale' => env('APP_LOCALE', 'en'),

	/*
	|--------------------------------------------------------------------------
	| Application Fallback Locale
	|--------------------------------------------------------------------------
	*/
    'fallback_locale' => env('APP_FALLBACK_LOCALE', 'en'),

	/*
	|--------------------------------------------------------------------------
	| Faker Locale
	|--------------------------------------------------------------------------
	*/
    'faker_locale' => env('APP_FAKER_LOCALE', 'en_US'),

    // ...

];
```

Добавьте пользовательские параметры приложения в файл `config/app.php`:
```php
return [
    
    // ...

    /*
    |--------------------------------------------------------------------------
    | Application Logo URL
    |--------------------------------------------------------------------------
    */
    
    'logo' => env('APP_LOGO', ''),
    
    /*
    |--------------------------------------------------------------------------
    | Application Icon URL
    |--------------------------------------------------------------------------
    */
    
    'icon' => env('APP_ICON', ''),
    
    /*
    |--------------------------------------------------------------------------
    | Application Theme
    |--------------------------------------------------------------------------
    */
    
    'theme' => env('APP_THEME', 'blue'),
    
    /*
    |--------------------------------------------------------------------------
    | Application Scheme
    |--------------------------------------------------------------------------
    */
    
    'scheme' => env('APP_SCHEME', 'http'),
    
    /*
    |--------------------------------------------------------------------------
    | Application Deep Link URL
    |--------------------------------------------------------------------------
    */
    
    'deeplink' => env('APP_DEEPLINK', ''),
    
    /*
    |--------------------------------------------------------------------------
    | Application Version
    |--------------------------------------------------------------------------
    */
    
    'version' => env('APP_VERSION', '1.0.0'),

    // ...

];
```

В файл `.env.example` необходимо добавить следующие директивы:
```bash
APP_NAME=Laravel
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost
APP_THEME=blue
APP_SCHEME=http
APP_DEEPLINK=laravel
APP_VERSION=1.0.0
APP_TIMEZONE=UTC
APP_LOCALE=ru
APP_FAKER_LOCALE=ru_RU
APP_FALLBACK_LOCALE=en
APP_LOGO=http://localhost/vendor/material-admin/logo.svg
APP_ICON=http://localhost/vendor/material-admin/icon.svg

DB_CONNECTION=mysql
DB_HOST=database
DB_PORT=3306
DB_DATABASE=forge
DB_USERNAME=forge
DB_PASSWORD=forge

BROADCAST_DRIVER=redis
CACHE_DRIVER=file
QUEUE_CONNECTION=database
SESSION_DRIVER=file
SESSION_LIFETIME=43200

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=
REDIS_PORT=6379
REDIS_DB=0

MAIL_FROM_ADDRESS=
MAIL_FROM_NAME=
```

### Провайдеры

Добавьте необходимые провайдеры в файл `config/app.php`:
```php
return [

    // ...

    'providers' => [

        /*
         * Package Service Providers...
         */
        \Crmplease\MaterialAdmin\Providers\MaterialAdminServiceProvider::class,
    ],
    
    // ...

];
```

### Ресурсы
```bash
docker-compose run artisan vendor:publish
```

### События

Зарегистрируйте новые события в провайдере `app/Providers/EventServiceProvider.php`:
```php
class EventServiceProvider
{
    // ...

    /**
     * @var array
     */
    protected $listen = [
    
         // ...
    
        /**
         * События, выполняемые при просмотре сущности.
         */
        \Crmplease\MaterialAdmin\Events\ResourceRequested::class => [
    
        ],
    
        /**
         * События, выполняемые при создании сущности.
         */
        \Crmplease\MaterialAdmin\Events\ResourceStored::class => [
    
        ],
    
        /**
         * События, выполняемые при изменении сущности.
         */
        \Crmplease\MaterialAdmin\Events\ResourceUpdated::class => [
    
        ],
    
        /**
         * События, выполняемые при удалении сущности "в корзину" (soft_delete).
         */
        \Crmplease\MaterialAdmin\Events\ResourceTrashed::class => [
    
        ],
    
        /**
         * События, выполняемые при восстановлении сущности.
         */
        \Crmplease\MaterialAdmin\Events\ResourceRestored::class => [
    
        ],
    
        /**
         * События, выполняемые при окончательном удалении сущности.
         */
        \Crmplease\MaterialAdmin\Events\ResourceDestroyed::class => [
    
        ],
        
    ];

    // ...

}
```

### Формы
Добавьте параметры по умолчанию для полей форм в файл `config/laravel-form-builder.php`:
```php
return [

    // ...

    'defaults'      => [
        
        // ...
    
        'file' => [
            'wrapper_class' => 'form-group',
            'label_class' => 'control-label',
            'field_class' => 'form-control upload',
        ],
    
        'image' => [
            'wrapper_class' => 'form-group',
            'label_class' => 'control-label',
            'field_class' => 'form-control upload',
        ],
    
        'datepicker' => [
            'wrapper_class' => 'form-group',
            'label_class' => 'control-label',
            'field_class' => 'form-control datepicker',
        ],
    
        'entity' => [
            'wrapper_class' => 'form-group',
            'label_class' => 'control-label',
            'field_class' => 'form-control selectpicker',
        ],
    
        'choice' => [
            'wrapper_class' => 'form-group',
            'label_class' => 'control-label',
            'field_class' => 'form-control selectpicker',
        ],
    
        'select' => [
            'wrapper_class' => 'form-group',
            'label_class' => 'control-label',
            'field_class' => 'form-control selectpicker',
        ],

        // ...

    ],

    // ...

];
```

Добавьте пользовательские шаблоны и типы полей для форм в файл `config/laravel-form-builder.php`:
```php
return [

    // ...

    'checkbox' => 'laravel-form-builder::custom.checkbox',
    'select' => 'laravel-form-builder::custom.select',
    'choice' => 'laravel-form-builder::custom.choice',
    
    // ...
    
    'colorpicker' => 'laravel-form-builder::custom.colorpicker',
    'datepicker' => 'laravel-form-builder::custom.datepicker',
    'editor' => 'laravel-form-builder::custom.editor',
    'file' => 'laravel-form-builder::custom.file',
    'image' => 'laravel-form-builder::custom.image',
    
    // ...
    
    'custom_fields' => [
        'colorpicker' => \Crmplease\MaterialAdmin\Forms\Fields\Colorpicker::class,
        'datepicker' => \Crmplease\MaterialAdmin\Forms\Fields\Datepicker::class,
        'editor' => \Crmplease\MaterialAdmin\Forms\Fields\Editor::class,
        'file' => \Crmplease\MaterialAdmin\Forms\Fields\File::class,
        'image' => \Crmplease\MaterialAdmin\Forms\Fields\Image::class,
    ],
    
    // ...

];
```

### .gitignore
Создайте файл `.gitignore`:
```git
/node_modules
/public/hot
/public/storage
/storage/*.key
/vendor
/.idea

.env
.phpunit.result.cache
.phpstorm.meta.php
_ide_helper.php
_ide_helper_models.php
Homestead.json
Homestead.yaml
npm-debug.log
yarn-error.log
access.log
error.log
```

### Структура
Удалите лишнее:
```bash
rm -rf app/Http/Controllers/{Auth,Controller.php}
rm app/User.php

rm database/factories/UserFactory.php
rm database/migrations/2014_10_12_000000_create_users_table.php
rm database/migrations/2014_10_12_100000_create_password_resets_table.php
```

Создайте структуру каталогов:
```bash
mkdir -p app/{DataTables,Events,Forms,Http/Controllers,Jobs,Listeners,Listeners,Notifications,Policies,Repositories,Transformers}
touch app/{DataTables,Events,Forms,Http/Controllers,Jobs,Listeners,Listeners,Notifications,Policies,Repositories,Transformers}/.gitkeep
```

## Фронтенд

### Сборка

```bash
cd packages/crmplease/material-admin/
npm install
npm run production
```

### Относительные пути к шрифтам и изображениям
```bash
# This works with GNU sed, but not on OS X:
sed -i 's~/vendor/material-admin/~../~g' public/css/*.css

# This works on OS X, but not with GNU sed:
sed -i '' -e 's~/vendor/material-admin/~../~g' public/css/*.css
```

### Публикация

```bash
docker-compose run artisan vendor:publish --tag=public --force
docker-compose run artisan vendor:publish --tag=views --force
docker-compose run artisan vendor:publish --tag=lang --force
docker-compose run artisan vendor:publish --tag=config --force
```
