### Запуск
```bash
git clone git@gitlab.crmplease.me:gtp/wholesale-web-service.git && cd wholesale-web-service
git submodule update --init --recursive

cp .env.example .env

docker-compose run composer install
docker-compose run artisan key:generate
docker-compose run artisan migrate
docker-compose up -d
```

### Название проекта
В файл `composer.json` необходимо добавить следующие директивы:
```json
{
    "type": "project",
    "name": "gtp/wholesale-web-service",
    "description": "Wholesale Web Service for Global Trade Partners Oy",
    "license": "proprietary",
    "version": "1.0.0"
}
```

### Параметры приложения и переменные окружения

Измените значения по умолчанию переменных в файле `config/app.php`:
```php
'timezone' => env('APP_TIMEZONE', 'UTC'),
'locale' => env('APP_LOCALE', 'en'),
'faker_locale' => env('APP_FAKER_LOCALE', 'en_US'),
'fallback_locale' => env('APP_FALLBACK_LOCALE', 'en'),
```

Добавьте пользовательские параметры приложения в файл `config/app.php`:
```php
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
REDIS_DATABASE=0

MAIL_FROM_ADDRESS=
MAIL_FROM_NAME=
```

### Докер контейнеры
```bash
wget -c https://gitlab.crmplease.me/docker/laravel/raw/master/docker-compose.yml
```

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

Для разработки
```bash
docker-compose run composer require --dev barryvdh/laravel-ide-helper

docker-compose run artisan ide-helper:generate # phpDoc generation for Laravel Facades
docker-compose run artisan ide-helper:models # phpDocs for models
docker-compose run artisan ide-helper:meta # PhpStorm Meta file
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

И выполните команду:
```bash
docker-compose run composer dump-autoload
```

### Провайдеры

Добавьте необходимые провайдеры в файл `config/app.php`:
```php
'providers' => [
    /*
     * Package Service Providers...
     */
    \Crmplease\MaterialAdmin\Providers\MaterialAdminServiceProvider::class,
    \Crmplease\MaterialAdmin\Providers\CustomDataTablesServiceProvider::class,
],
```

### Ресурсы
```bash
docker-compose run artisan vendor:publish
```

### События

Зарегистрируйте новые события в провайдере `app/Providers/EventServiceProvider.php`:
```php
/**
 * @var array
 */
protected $listen = [

    \Crmplease\MaterialAdmin\Events\ResourceRequested::class => [

    ],

    \Crmplease\MaterialAdmin\Events\ResourceStored::class => [

    ],

    \Crmplease\MaterialAdmin\Events\ResourceUpdated::class => [

    ],

    \Crmplease\MaterialAdmin\Events\ResourceDestroyed::class => [

    ],

    \Crmplease\MaterialAdmin\Events\ResourceTrashed::class => [

    ],

    \Crmplease\MaterialAdmin\Events\ResourceRestored::class => [

    ],
    
];
```

### Формы
Добавьте параметры по умолчанию для полей форм в файл `config/laravel-form-builder.php`:
```php
'defaults'      => [
    
    ...
    
    'entity'                => [
        'wrapper_class'   => 'form-group',
        'label_class'     => 'control-label',
        'field_class'     => 'form-control selectpicker',
    ],
    
    'choice'                => [
        'wrapper_class'   => 'form-group',
        'label_class'     => 'control-label',
        'field_class'     => 'form-control selectpicker',
    ],
    
    'select'                => [
        'wrapper_class'   => 'form-group',
        'label_class'     => 'control-label',
        'field_class'     => 'form-control selectpicker',
    ],
],
```

Добавьте пользовательские шаблоны и типы полей для форм в файл `config/laravel-form-builder.php`:
```php
'colorpicker' => 'laravel-form-builder::custom.colorpicker',
'datepicker' => 'laravel-form-builder::custom.datepicker',
'editor' => 'laravel-form-builder::custom.editor',
'file' => 'laravel-form-builder::custom.file',
'image' => 'laravel-form-builder::custom.image',

'custom_fields' => [
    'colorpicker' => \Crmplease\MaterialAdmin\Forms\Fields\Colorpicker::class,
    'datepicker' => \Crmplease\MaterialAdmin\Forms\Fields\Datepicker::class,
    'editor' => \Crmplease\MaterialAdmin\Forms\Fields\Editor::class,
    'file' => \Crmplease\MaterialAdmin\Forms\Fields\File::class,
    'image' => \Crmplease\MaterialAdmin\Forms\Fields\Image::class,
]
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
rm -rf app/Http/Controllers/Auth
rm app/Http/Controllers/Controller.php

rm app/User.php

rm database/factories/UserFactory.php
rm database/migrations/2014_10_12_000000_create_users_table.php
rm database/migrations/2014_10_12_100000_create_password_resets_table.php

touch app/Http/Controllers/.gitkeep
touch database/factories/.gitkeep
touch database/migrations/.gitkeep
```

### Таблицы
```bash
docker-compose run artisan queue:table
docker-compose run artisan queue:failed-table

docker-compose run artisan migrate
```

### Генераторы
Добавьте комментарий-триггер `// ...$middlewareGroups` в файл `app/Http/Kernel.php`:
```php
/**
 * @var array
 */
protected $middlewareGroups = [
    'web' => [
        \App\Http\Middleware\EncryptCookies::class,
        \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
        \Illuminate\Session\Middleware\StartSession::class,
        // \Illuminate\Session\Middleware\AuthenticateSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        \App\Http\Middleware\VerifyCsrfToken::class,
        \Illuminate\Routing\Middleware\SubstituteBindings::class,
    ],

    'api' => [
        'throttle:60,1',
        'bindings',
    ],
    
    // ...$middlewareGroups

];
```

Добавьте комментарий-триггер `// ...$commands` в файл `app/Console/Kernel.php`:
```php
/**
 * @var array
 */
protected $commands = [
    // ...$commands
];
```

Добавьте комментарий-триггер `// ...$this->mapRoutes();` в файл `app/Providers/RouteServiceProvider.php`:
```php
/**
 * @return void
 */
public function map()
{
    $this->mapApiRoutes();
    $this->mapWebRoutes();
    // ...$this->mapRoutes()
}
```

Добавьте комментарий-триггер `// ...mapRoutes()` в файл `app/Providers/RouteServiceProvider.php`:
```php
class RouteServiceProvider extends ServiceProvider
{
    ...
    
    // ...mapRoutes()
}
```

Добавьте комментарий-триггер `// ...views` в файл `app/Providers/AppServiceProvider.php`:
```php
/**
 * @return void
 */
public function boot()
{
    // ...views
}
```

### Локализация
```bash
docker-compose run artisan generate:locale ru_RU
```

### Пространства имён
```bash
docker-compose run artisan generate:namespace App
```

### Ресурсы
#### Очередь задач
```bash
docker-compose run artisan generate:resource Job \
    --namespace App \
    \
    --field=queue:string \
    --field=payload:json \
    --field=attempts:integer \
    --field=reserved_at:timestamp \
    --field=available_at:timestamp \
    --field=created_at:timestamp \
    \
    --policy=false \
    \
    --translate=ru:"Фоновая задача":"Фоновые задачи":"Фоновую задачу":"Фоновых задач" \
    --translate-modifier=ru:female \
    \
    --translate-field=queue:ru:"Очередь" \
    --translate-field=payload:ru:"Параметры" \
    --translate-field=attempts:ru:"Попыток" \
    --translate-field=reserved_at:ru:"Запущена" \
    --translate-field=available_at:ru:"Назначена" \
    --translate-field=created_at:ru:"Создана" \
    \
    --force
```

Пример поля `payload`:
```json
{"displayName":"App\\Jobs\\ProcessPodcast","job":"Illuminate\\Queue\\CallQueuedHandler@call","maxTries":null,"delay":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\Jobs\\ProcessPodcast","command":"O:23:\"App\\Jobs\\ProcessPodcast\":8:{s:9:\"\u0000*\u0000carbon\";O:25:\"Illuminate\\Support\\Carbon\":3:{s:4:\"date\";s:26:\"2019-05-22 22:08:49.961084\";s:13:\"timezone_type\";i:3;s:8:\"timezone\";s:3:\"UTC\";}s:6:\"\u0000*\u0000job\";N;s:10:\"connection\";N;s:5:\"queue\";N;s:15:\"chainConnection\";N;s:10:\"chainQueue\";N;s:5:\"delay\";O:25:\"Illuminate\\Support\\Carbon\":3:{s:4:\"date\";s:26:\"2019-05-18 22:18:49.974782\";s:13:\"timezone_type\";i:3;s:8:\"timezone\";s:3:\"UTC\";}s:7:\"chained\";a:0:{}}"}}
```

```json
{  
   "displayName":"App\\Jobs\\ProcessPodcast",
   "job":"Illuminate\\Queue\\CallQueuedHandler@call",
   "maxTries":null,
   "delay":null,
   "timeout":null,
   "timeoutAt":null,
   "data":{  
      "commandName":"App\\Jobs\\ProcessPodcast",
      "command":"O:23:\"App\\Jobs\\ProcessPodcast\":8:{s:9:\"\u0000*\u0000carbon\";O:25:\"Illuminate\\Support\\Carbon\":3:{s:4:\"date\";s:26:\"2019-05-22 22:08:49.961084\";s:13:\"timezone_type\";i:3;s:8:\"timezone\";s:3:\"UTC\";}s:6:\"\u0000*\u0000job\";N;s:10:\"connection\";N;s:5:\"queue\";N;s:15:\"chainConnection\";N;s:10:\"chainQueue\";N;s:5:\"delay\";O:25:\"Illuminate\\Support\\Carbon\":3:{s:4:\"date\";s:26:\"2019-05-18 22:18:49.974782\";s:13:\"timezone_type\";i:3;s:8:\"timezone\";s:3:\"UTC\";}s:7:\"chained\";a:0:{}}"
   }
}
```

#### Очередь незавершенных задач
```bash
docker-compose run artisan generate:resource FailedJob \
    --namespace App \
    \
    --field=connection:string \
    --field=queue:string \
    --field=payload:json \
    --field=exception:textarea \
    --field=failed_at:timestamp \
    \
    --policy=false \
    \
    --translate=ru:"Невыполненная задача":"Невыполненные задачи":"Невыполненную задачу":"Невыполненных задач" \
    --translate-modifier=ru:female \
    \
    --translate-field=connection:ru:"Драйвер" \
    --translate-field=queue:ru:"Очередь" \
    --translate-field=payload:ru:"Параметры" \
    --translate-field=exception:ru:"Исключение" \
    --translate-field=failed_at:ru:"Провалена" \
    \
    --force
```
