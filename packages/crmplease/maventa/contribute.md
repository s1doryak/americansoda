# Зависимости

# Каталог с пакетом

```bash
mkdir -p packages/crmplease/maventa
git clone git@gitlab.crmplease.me:crmplease/maventa.git packages/crmplease/maventa
```

# Автозагрузка классов

В файл `composer.json` необходимо добавить следующие директивы:
```json
{
    "autoload": {
        "psr-4": {
            "Crmplease\\Maventa\\": "packages/crmplease/maventa/src/"
        },
        "files": [
            "packages/crmplease/maventa/src/helpers.php"
        ]
    }
}
```

И выполните команду:
```bash
composer dump-autoload
```

Добавьте необходимые провайдеры в файл `config/app.php`:
```php
'providers' => [
    /*
     * Package Service Providers...
     */
    \Crmplease\Maventa\Providers\MaventaServiceProvider::class,
],
```
