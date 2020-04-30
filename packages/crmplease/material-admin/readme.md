# Установка и настройка

## Репозиторий

Добавьте репозиторий в `composer.json`:
```bash
# SSH
composer config repositories.material-admin vcs git@gitlab.crmplease.me:crmplease/material-admin.git

# HTTP (если не доступно клонирование по SSH)
composer config repositories.material-admin vcs https://gitlab.crmplease.me/crmplease/material-admin
```

## Установка
```bash
composer require crmplease/material-admin
```

Далее необходимо опубликовать компоненты установленных пакетов:
```bash
php artisan vendor:publish # выберите [0] - опубликовать для всех
```

**Готово** 🎉

# Описание

Основные принципы, на которых построен пакет:

* **Пространства имен** – структура каталогов и соответствующие им префиксы маршрутов и контроллеров для реализации различных пользовательских интерфейсов на одной структуре данных
* **Ресурсы** – сущности для которых доступны операции CRUD

Реализация ресурсов (индивидуальная в каждом пространстве имен):

* **Контроллеры** – контроллеры операций CRUD основанные на общем `ResourceController`
* **Датагриды** – табличные интерфейсы для ресурсов, основанные на библиотеке [Laravel DataTables](https://github.com/yajra/datatables) и поддерживающие фильтрацию и сортировку
* **Формы** – формы, основанные на библиотеке [Laravel Form Builder](https://github.com/kristijanhusak/laravel-form-builder) и предназначенные для создания и редактирования ресурсов
* **Трансформеры** – трансформеры запросов и ответов

Общие компоненты:

* **Политики** – механизм авторизации CRUD действий пользователей над ресурсами
* **События** – реализация паттерна observer во время выполнения CRUD действий над ресурсов
* **Обработчики событий** – действия выполняемые при вызове событий ресурсов
* **Уведомления** – механизм отправки уведомлений пользователям по различным каналам

## Локализация

Для локализации используется набор файлов, список которых представленн на схеме:
```
Проект/
└── resources/lang/{locale}/
    ├── models/
    │   └── .gitkeep
    ├── notifications/
    │   └── .gitkeep
    ├── pages/
    │   └── .gitkeep
    ├── auth.php
    ├── colors.php
    ├── datatables.php
    ├── daterangepicker.php
    ├── email.php
    ├── footer.php
    ├── forms.php
    ├── fullcalendar.php
    ├── generator.php
    ├── header.php
    ├── locales.php
    ├── modals.php
    ├── page-loader.php
    ├── pagination.php
    ├── passwords.php
    ├── sidebar.php
    ├── validation.php
    └── .gitkeep
```

Добавление локали в проект связано с внесением изменений в файлы:
```
Проект/
└── config/
    └── locales.php
```

## Пространства имён

Пространством имён называется маршрутный лист и структура каталогов, которая представленна на схеме:
```
Проект/
│   app/
│   ├── DataTables/{Namespace}/
│   │   └── .gitkeep
│   ├── Events/{Namespace}/
│   │   └── .gitkeep
│   ├── Forms/{Namespace}/
│   │   └── .gitkeep
│   ├── Http/Controllers/{Namespace}/
│   │   ├── Auth/
│   │   │   ├── ForgotPasswordController.php
│   │   │   ├── LoginController.php
│   │   │   ├── RegisterController.php
│   │   │   ├── ResetPasswordController.php
│   │   │   └── VerificationController.php
│   │   ├── Middleware/
│   │   │   ├── Authenticate.php
│   │   │   └── .gitkeep
│   │   └── .gitkeep
│   ├── Listeners/{Namespace}/
│   │   └── .gitkeep
│   ├── Notifications/{Namespace}/
│   │   └── .gitkeep
│   └── Transformers/{Namespace}/
│      └── .gitkeep
├── resources/
│   └── views/{namespace}/
│      ├── actions/
│      │   ├── create.blade.php
│      │   ├── index.blade.php
│      │   └── show.blade.php
│      ├── auth/
│      │   ├── passwords/
│      │   │   ├── email.blade.php
│      │   │   └── reset.blade.php
│      │   ├── login.blade.php
│      │   └── register.blade.php
│      ├── resources/
│      │   └── .gitkeep
│      ├── home.blade.php
│      ├── master.blade.php
│      ├── modal.blade.php
│      └── .gitkeep
└── routes/
   └── {namespace}.php
```

### Параметр `--plain`

Пространству имён, созданному с параметром `--plain` соответствует следующая структура каталогов:
```
Проект/
│   app/
│   ├── Events/{Namespace}/
│   │   └── .gitkeep
│   ├── Http/Controllers/{Namespace}/
│   │   ├── Middleware/
│   │   │   ├── Authenticate.php
│   │   │   └── .gitkeep
│   │   └── .gitkeep
│   └── Listeners/{Namespace}/
│       └── .gitkeep
└── routes/
   └── {namespace}.php
```

### Параметр `--suffix`

Пространству имён, созданному с параметром `--suffix=v1` соответствует следующая структура каталогов:
```
Проект/
│   app/
│   ├── Events/{Namespace}/{Suffix}/
│   │   └── .gitkeep
│   ├── Http/Controllers/{Namespace}/{Suffix}/
│   │   ├── Middleware/
│   │   │   ├── Authenticate.php
│   │   │   └── .gitkeep
│   │   └── .gitkeep
│   └── Listeners/{Namespace}/{Suffix}/
│       └── .gitkeep
└── routes/{namespace}/
   └── {suffix}.php
```

Добавление пространства имён в проект связано с внесением изменений в файлы:
```
Проект/
│   app/
│   ├── Http/
│   │   └── Kernel.php
│   ├── Providers/
│   │   ├── AppServiceProvider.php <- если не указан параметр --plain
│   │   └── RouteServiceProvider.php
└── config/
    └── namespaces.php
```

## Ресурсы

Ресурсом называется модель и компонентны, структура которых представленна на схеме:
```
Проект/
│   app/
│   ├── Console/
│   │   └── Commands/Resources/
│   │       └── {Resource}Creator.php
│   ├── DataTables/
│   │   └── {Namespace}/
│   │      └── {Resource}DataTable.php
│   ├── Forms/
│   │   └── {Namespace}/
│   │       └── {Resource}Form.php
│   ├── Http/Controllers/
│   │   └── {Namespace}/
│   │       └── {ResourcePlural}Controller.php
│   ├── Policies/
│   │   └── {Resource}Policy.php
│   ├── Repositories/
│   │   ├── Contracts/
│   │   │   └── {Resource}Repository.php
│   │   └── Eloquent/
│   │       └── {Resource}RepositoryEloquent.php
│   ├── Transformers/
│   │   └── {Namespace}/
│   │       └── {Resource}Transformer.php
│   └── {Resource}.php
├── database/
│   ├── factories/
│   │   └── {Resource}Factory.php
│   ├── migrations/
│   │   └── YYYY_MM_DD_HHMMSS_{resource_migrations}.php
│   └── seeds/
│       └── {ResourcePlural}TableSeeder.php
└── resources/
    ├── lang/
    │   └── {locale}/
    │       └── models/
    │           └── {resource}.php
    └── views/
        └── {namespace}/
            └── resources/
                └── {resource}/
                    ├── columns/
                    │   └── .gitkeep
                    ├── fields/
                    │   └── .gitkeep
                    ├── filters/
                    │   └── .gitkeep
                    ├── create.blade.php
                    ├── index.blade.php
                    └── show.blade.php
```

Добавление ресурса в проект связано с внесением изменений в файлы:
```
Проект/
│   app/
│   ├── Console/
│   │   └── Kernel.php
│   ├── Providers/
│   │   └── AuthServiceProvider.php
├── config/
│   ├── repositories.php
│   └── resources.php
└── database/
    └── seeds/
        └── DatabaseSeeder.php
```

**Запрещенные названия ресурсов:**
* Зарезервированные слова Laravel: `Repository`, `Translation`, `Model`, `Notification`.
* Зарезервированные слова PHP: `Object`, `String`, `Resource`, `Print`.
* [Слова исключения](http://english99.ru/plurals-exceptions/) множественного числа английских существительных: `Man`, `Child `, `Person` и прочие.

## Формы

Формы для создания или редактирования (методы `create` и ` edit`) ресурсов находятся в файлах `app/Forms/{Namespace}/{Resource}Form.php`, например: `app/Forms/App/UserForm.php`.

Класс формы содержит методы:
- `getCreateFormFields()` — возвращает список полей формы создания ресурса (метод `create`).
- `getEditFormFields($model)` — возвращает список полей формы редактирования существующего ресурса (метод `edit`). Принимает на вход экземпляр редактируемого ресурса `$model`. 
- `getStoreValidationRules()` — возвращает список правил валидации при создании ресурса (метод `store`).
- `getUpdateValidationRules($model)` — возвращает список правил валидации при сохранении существующего ресурса (метод `update`). Принимает на вход экземпляр редактируемого ресурса `$model`.

Поля в форме описываются параметрами в соответствии с параметрами полей библиотеки [Laravel Form Builder](http://kristijanhusak.github.io/laravel-form-builder/field/basic-input-types.html).

## Датагриды

Датагриды или табличные интерфейсы для отображения списка экземпляров (методы `index` и ` trashed`) ресурсов находятся в файлах `app/DataTables/{Namespace}/{Resource}DataTable.php`, например: `app/DataTables/App/UserDataTable.php`.

Разработаны на базе библиотеки [Laravel DataTables](https://packagist.org/packages/yajra/laravel-datatables) и полностью совместимы с ней.

Класс датагрида содержит методы:
- `getColumns()` — возвращает список столбцов таблицы с экземплярами ресурса (методы `index` и ` trashed`).
- `getRawColumns()` — возвращает список с названиями столбцов, для которых разрешен вывод HTML-контента.
- `getAggregateColumns()` — возвращаем список столбцов, для которых доступна агрегация данных (выводятся в нижней части таблицы).
- `getFilterableColumns()` — возвращаем список столбцов, по которым доступна фильтрация данных.
- `getActions($model)` — возвращает список действий, которые возможно выполнять над ресурсами (по умолчанию: `edit`, `trash`, `restore` и ` destroy`), которые отображаются в дополнительной колонке `action` в каждой строке таблицы.
- `getButtons()` — возвращаем список действий, которые доступны для таблицы в целом (по умолчанию: `reload`, `export`, `colvis` и ` filter`), отображается в виде кнопок в верхней части таблицы.

При построении таблицы, в столбцах отображаются соответствующие параметры ресурса, преобразованные к строковому виду, т.е. столбец `name` будет отображать значение `$model->name`.

Для того, чтобы изменить это поведение, необходимо определить пользовательские функции отображения стоблцов с названием `render{ColumnName}Column($model)`, которые на вход принимают экземпляр ресурса.

Если название столбца содержит точку `.`, то в названии функции она будет заменена на `__`.

Примеры столбов и соответствующих им функций отображения:

| Столбец | Функция отображения |
| --- | --- |
| `name` | `renderNameColumn($model)` |
| `is_active` | `renderIsActiveColumn($model)` |
| `customer_type.name` | `renderCustomerType__NameColumn($model)` |

Следует иметь в виду, что функции отображения вызываются как во время отображения таблицы, так и во время печати или экспорта данных в Excel. Для определения контекста отображения следует пользоваться функцией `isDataTableRequest()`.

Например, необходимо в столбце `name` в табличном виде выводить не только имя, но и аватар пользователя, в то время как при печати отображать только имя в текстовом виде. 

Сделать это можно следующим образом:
```php
class UserDataTable extends DataTable
{
    /**
     * @param User $user
     * @return string
     */
    public function renderNameColumn($user)
    {
        if ($this->isDataTableRequest()) {
            return $this->renderMediaView($user->name, $user->email, $user->photo);
        }
    
        return $user->name;
    }
}
```

Обратите внимание на функцию `renderMediaView()`.

В датагридах можно использовать следующие функции, для отображения столбцов:
- `renderView($template, $data, $fallback)` — компилирует пользовательский `blade` шаблон с указанными параметрами.
- `renderBadgeView($title, $color, $classes)` — показывает текст в цветном бейдже.
- `renderIconView($title, $icon, $color, $classes)` — показывает иконку из набора `zmdi` с текстом справа.
- `renderMediaView($title, $subtitle, $image)` — показывает комбинацию картинки, заголовка и подзаголовка.
- `renderActionView($actions, $model)` — компилирует колонку с кнопками действий, которые возможно выполнять над ресурсами.
- `renderDefaultView()` — компилирует колонку с содержимым по умолчанию. Эквивалентно вызову `renderView('datatables::columns.default')`. См. также параметр [defaultContent](https://datatables.net/reference/option/columns.defaultContent)

Для более подробного знакомства с функциями отображения смотрите трейт `Crmplease\MaterialAdmin\DataTables\Traits\RenderHelpers`.

## Политики

## Обработчики событий

**Удачи** ✊
