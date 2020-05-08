# История изменений
Все заметные изменения в этом проекте будут документированы в этом файле.

Формат основан на [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
и проект придерживается [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [ToDo]
- [ ] Абстрактный класс PackageServiceProvider для модулей
- [ ] Обеспечить поддержку форм для редактирования М2М сущностей с pivot полями на базе http://kristijanhusak.github.io/laravel-form-builder/field/collection.html
- [ ] Разработать инструменты импорта/экспорта данных на основе https://laravel-excel.maatwebsite.nl/3.1/ 
- [ ] Разделить формы и реквесты
- [ ] Интегрировать сервисы, вместо обсерверов
- [ ] Обеспечить поддержку BULK действий в датагридах
- [ ] Вынести Sidebar в отдельный модуль (с трейтом)
- [ ] Создать модуль Navbar для навигации в шапке (по аналогии с Sidebar)
- [ ] Разделить CRUD контроллер на функции `RenderSidebar`, `RenderDataTables`; `RenderForms`; `RenderViews`;
- [ ] Мультитенантность - возможность использования одной системы разными компаниями через поддомены (`tenant_id`)
- [ ] Настройки компании (тенанта) - модуль, который хранит настройки компании
- [ ] Каркас для REST API клиентов с настройками для компании (тенанта)
- [ ] FullCalendar - подключить библиотеку https://github.com/maddhatter/laravel-fullcalendar
- [ ] DocumentNotification - уведомление с настраиваемым генератором PDF (см. https://gitlab.crmplease.me/claudy/crm/blob/master/app/Jobs/Dashboard/SendReportToUser.php)

## [Невыпущенно]
- [x] вынести генераторы в отдельный пакет
- [x] `$hasOne`
- [x] `$hasMany`
- [x] `$morphTo`
- [x] `$morphOne`
- [x] `$morphMany`
- [x] `$appends`
- [x] стили по умолчанию для кнопкок датагридов
- [x] автоматическое обновление кода для генераторов
- [x] разделить методы `ResourceController` на `editingMethods` и `persistingMethods`
- [x] сделать модальные окна для создания и редактирования сущностей
- [x] Обеспечить простое добавление новых действий в CRUD контроллеры
- [x] Разработать AJAX формы для быстрого изменения объектов в датагридах
- [x] Обеспечить поддержку русского языка в генераторах трансляций
- [x] Обеспечить поддерку модулей, которые могут расширять функциональность пакета

## [1.1.7] - 2019-05-23
- Исправлена ошибка в команде `generate:locale`
- Исправлено дублирование полей `email` и `password` с параметром `--auth` в команде `generate:resource`
- Автоматическое обновление конфигурационных файлов при выполнении команды `generate:resource`
- Автоматический вызов `dump-autoload` при выполнении команды `generate:resource`
- Обновлено руководство по разработке пакета `contributing.md`
- Добавлены параметры `--has-one` и `--translate-has-one` для команды `generate:resource`

## [1.1.6] - 2019-05-20
### Добавлено
- Новые параметры для команд `generate:resource` и `modify:resource`:
- `skip-model` — пропустить создание/модификацию модели.
- `skip-repository`
- `skip-policy`
- `skip-migration`
- `skip-controller`
- `skip-form`
- `skip-transformer`
- `skip-datatable`
- `skip-factory`
- `skip-seeder`
- `skip-translation`
- `skip-creator`

## [1.1.5] - 2019-05-19
### Добавлено
- Поддержка [всех доступных переводов](https://datatables.net/plug-ins/i18n/) для DataTables
- Исправлено отображение логотипа и иконки
- Исправлены маршруты `{namespace}.home`
- Библиотека `jenssegers/date`
- Исправлена работа функции `renderBadgeView()`
- Исправлена загрузка переопределенных трансляций

## [1.1.4] - 2019-05-18
### Добавлено
- Поля `time`, `timestamp` и `timepicker`
- Руководство по генерации обработчиков событий

### Изменено
- Переименован параметр `--entity` команды `generate:listener`. 

#### Переименован параметр `--entity` команды `generate:listener`

Новое название параметра: `--listener-resource`.

Определяет, для каких ресурсов будет работать обработчик.

Значение передается в формате `--listener-resource=RESOURCE`. Поддерживает множественные значения.

Пример: `generate:listener SendPasswordMessage --listener-resource=Administrator --listener-resource=User`.

## [1.1.3] - 2019-05-18
### Добавлено
- Руководство по генерации политик
- Предопределенные трансляции
- Создание политики `generate:policy` при создании ресурса `generate:resource`
- Новый параметр `--policy=POLICY` команды `generate:resource` и `generate:policy`.

#### Новый параметр `--policy=POLICY` команды `generate:resource` и `generate:policy`

Определяет какое правило будет применяться при авторизации доступа к ресурсам. 

Значение передается в формате `POLICY`, где `POLICY` - строка с выражением или булевая константа (по умолчанию: `true`).

### Изменено
- Исправлены пути к логотипу и иконкам
- Переименован параметр `--entity` команды `generate:policy` и `generate:policy`. 

#### Переименован параметр `--entity` команды `generate:policy` и `generate:policy`

Новое название параметра: `--policy-auth`.

Позволяет определить особые правила авторизации для различных типов пользователей.

Значение передается в формате `AUTHENTICATABLE:POLICY`. 

Пример: `generate:policy Notification --policy-auth=Administrator:true --policy-auth=User:false`.

## [1.1.2] - 2019-05-14
### Добавлено
- Логотип и иконка
- Параметр количества создаваемых сущностей с помощью фабрик `--seed-count`
- Создание каталогов и шаблонов для ресурсов
- Вложенные пространства имён (версии для API - `/api/v1`)
- Нересурсные пространства имён (для хуков сторонних сервисов - `/external/mango`)
- Руководство по генерации локалей
- Руководство по генерации пространств имён
- Руководство по генерации ресурсов
- Руководство по типам полей ресурсов
- Руководство по генерации трансляций
- Руководство по использованию датагридов
- Руководство по иконкам и логотипам

#### Новый параметр `--seed-count=COUNT` команды `generate:resource`

Определяет какое количество сущностей будет создаст фабрика при запуске процедуры `db:seed`. 

Значение передается в формате `COUNT`, где `COUNT` - количество экземпляров (по умолчанию: 5).

### Изменено
- Рефактор событийной архитектуры

Изменены названия событий:
- `EntitySuccessfullyRequested` -> `ResourceRequested`
- `EntitySuccessfullyStored` -> `ResourceStored`
- `EntitySuccessfullyUpdated` -> `ResourceUpdated`
- `EntitySuccessfullyDestroyed` -> `ResourceDestroyed`
- `EntitySuccessfullyTrashed` -> `ResourceTrashed`
- `EntitySuccessfullyRestored` -> `ResourceRestored`

Внесите соотвествующие исправления в файл `app/Providers/EventServiceProvider.php`

#### Изменён формат параметра `--field=[FIELD ...]` команды `generate:resource`

Формат: `NAME[:TYPE][:FAKER_STRING]`, где 
- `NAME` - название поля
- `TYPE` - тип данных или поля ввода (например - `string`, `editor`, `interger`, `file`, `image`, `color`)
- `FAKER_STRING` - шаблон автозаполнения для фабрики ресурса (например - `$faker->unique()->phoneNumber`).

Примеры: 
- `--field=name`
- `--field=birth:date`
- `--field=color:color`
- `--field=photo:image`
- `--field=age:integer:$faker->numberBetween(18, 146)`

Поддерживаемые типы полей:

| Название | Тип в базе данных | Тип в форме ввода | Преобразование типа | Комменатрий |
| --- | :---: | :---: | :---: | --- |
| `text` | `text` | `string` | `string` | Тип поля по умолчанию. |
| `boolean` | `boolean` | `checkbox` | `boolean` |  |
| `checkbox` | `boolean` | `checkbox` | `boolean` |  |
| `int` | `integer` | `number` | `integer` |  |
| `integer` | `integer` | `number` | `integer` |  |
| `number` | `integer` | `number` | `integer` |  |
| `decimal` | `decimal` | `text` | `decimal:2` |  |
| `double` | `double` | `text` | `double` |  |
| `float` | `float` | `text` | `float` |  |
| `date` | `date` | `datepicker` | `datetime:Y-m-d` |  |
| `datepicker` | `date` | `datepicker` | `datetime:Y-m-d` |  |
| `datetime` | `dateTime` | `datepicker` | `datetime:Y-m-d H:i:s` |  |
| `text` | `text` | `textarea` | `string` |  |
| `textarea` | `text` | `textarea` | `string` |  |
| `editor` | `longText` | `editor` | `string` | WYSIWYG редактор [Trumbowyg](https://github.com/Alex-D/Trumbowyg). |
| `longtext` | `longText` | `editor` | `string` | WYSIWYG редактор Trumbowyg. |
| `long_text` | `longText` | `editor` | `string` | WYSIWYG редактор Trumbowyg. |
| `color` | `string` | `colorpicker` | `string` |  |
| `colorpicker` | `string` | `colorpicker` | `string` |  |
| `file` | `text` | `file` | Объект класса `FileField` |  |
| `image` | `text` | `image` | Объект класса `ImageField` |  |
| `blob` | `binary` | `textarea` | `string` |  |
| `binary` | `binary` | `textarea` | `string` |  |
| `json` | `json` | `textarea` | `object` |  |
| `array` | `json` | `textarea` | `array` |  |
| `password` | `string` | `password` | `string` |  |

## [1.1.1] - 2019-04-17
### Добавлено
- Руководство по генерации трансляций

### Изменено
- Улучшен генератор локалей `php artisan generate:locale ru`

## [1.1.0] - 2019-03-27
### Добавлено
- Поддержка Laravel 5.8

### Изменено
- Библиотека [Laravel DataTables](https://packagist.org/packages/yajra/laravel-datatables) обновлена до версии 1.5

### Удалено
- Поддержка Laravel 5.7

## [1.0.0] - 2019-03-26
- Начальный релиз
