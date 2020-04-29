## Подключение пакета

### Зависимости пакета
```bash
docker-compose run composer require \
   crmplease/material-admin
```

### Каталог с пакетом

```bash
mkdir -p packages/crmplease/generators
git clone git@gitlab.crmplease.me:crmplease/generators.git packages/crmplease/generators
```

### Автозагрузка классов

В файл `composer.json` необходимо добавить следующие директивы:
```json
{
    "autoload": {
        "psr-4": {
            "Crmplease\\Generators\\": "packages/crmplease/generators/src/"
        },
        "files": [
            "packages/crmplease/generators/src/helpers.php"
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
return [

    // ...

    'providers' => [
        /*
         * Package Service Providers...
         */
        \Crmplease\Generators\Providers\GeneratorsServiceProvider::class,
    ],

    // ...

];
```

### Генераторы
Для того, чтобы генераторы могли автоматически обновлять конфигурационные файлы, необходимо выполнить разметку секций специальными комментариями.

Добавьте комментарии в файл `config/auth.php`:
```php
'guards' => [
    
    // ...guards
],

'providers' => [

    // ...providers
],

'passwords' => [

    // ...passwords
],
```

Добавьте комментарий `// ...$middlewareGroups` в файл `app/Http/Kernel.php`:
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

Добавьте комментарий `// ...$commands` в файл `app/Console/Kernel.php`:
```php
/**
 * @var array
 */
protected $commands = [
    // ...$commands
];
```

Добавьте комментарий `// ...$policies` в файл `app/Providers/AuthServiceProvider.php`:
```php
/**
 * @var array
 */
protected $policies = [
    // ...$policies
];
```

Добавьте комментарий `// ...$this->mapRoutes();` в файл `app/Providers/RouteServiceProvider.php`:
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

Добавьте комментарий `// ...mapRoutes()` в файл `app/Providers/RouteServiceProvider.php`:
```php
class RouteServiceProvider extends ServiceProvider
{
    ...
    
    // ...mapRoutes()
}
```

Добавьте комментарий `// ...views` в файл `app/Providers/AppServiceProvider.php`:
```php
/**
 * @return void
 */
public function boot()
{
    // ...views
}
```

Добавьте комментарий `// ...seeder` в файл `database/seeds/DatabaseSeeder.php`:
```php
/**
 * @return void
 */
public function run()
{
    // ...seeder
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
    --skip-migration \
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
    --skip-migration \
    \
    --force
```

### Таблицы
```bash
docker-compose run artisan queue:table
docker-compose run artisan queue:failed-table

docker-compose run artisan migrate
```