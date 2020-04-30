# Установка и настройка

## Репозиторий

Добавьте репозиторий в `composer.json`:
```bash
# SSH
composer config repositories.generators vcs git@gitlab.crmplease.me:crmplease/generators.git

# HTTP (если не доступно клонирование по SSH)
composer config repositories.generators vcs https://gitlab.crmplease.me/crmplease/generators
```

## Установка
```bash
composer require crmplease/generators
```

Далее необходимо опубликовать компоненты установленных пакетов:
```bash
php artisan vendor:publish # в предложенном списке выберите [0] - опубликовать для всех
```

**Готово** 🎉

Пакет настроен и готов к использованию.

# Пример использования

Воспользуйтесь генераторами пространств имёи и ресурсов.

**Внимательно следите за подсказками в консоли**

## Локализация

Создание локали осуществляется командой `generate:locale`:

```bash
php artisan generate:locale LOCALE
```

Аргументы:

| Аргумент | Обязательный | Описание |
| --- | :---: | --- |
| `LOCALE` | Да | Название локали. Принимает значения как в виде `xx` (например - `ru`), так и в виде `xx_YY` (например - `ru_RU` или `ru_UA`). |

## Пространства имён

Создание пространств имён осуществляется командой `generate:namespace`:

```bash
php artisan generate:namespace NAMESPACE \
    [--suffix=SUFFIX] \
    [--plain]
```

Аргументы:

| Аргумент | Обязательный | Описание |
| --- | :---: | --- |
| `NAMESPACE` | Да | Название пространства имён. Пример: `generate:namespace App` - создаст пространство имён с маршрутным листом вида `http://example.com/app`. |

Параметры:

| Параметр | Обязательный | Множественный | Описание |
| --- | :---: | :---: | --- |
| `--suffix=` | Нет | Нет | Суффикс пространства имён, например `--suffix=v1`. Удобно использовать для указания версии Api. Пример: `generate:namespace Api --suffix=v1` — создаст пространство имён, доступное по адерсу `http://example.com/api/v1`. |
| `--plain` | Нет | Нет | При указании данного параметра будут созданы только каталог для контроллеров и пустой лист маршрутов. Каталоги для датагридов, форм, обработчиков событий и трансформеров будут пропущены. Удобно использовать в паре с параметром `suffix` для обработки вебхуков сторонних сервисов. Пример: `generate:namespace External --plain --suffix=mango` - создаст пространство имён доступное по адресу `http://example.com/external/mango`. |

## Ресурсы

Создание ресурсов осуществляется командой `generate:resource`:
```bash
php artisan generate:resource RESOURCE \
    [--namespace=NAMESPACE] \
    [--package=PACKAGE] \
    \
    [--auth] \
    [--uuid] \
    \
    [--field=NAME[:TYPE][:FAKER_STRING] ...] \
    \
    [--belongs-to=RESOURCE[:RELATION_NAME][:FIELD] ...] \
    [--belongs-to-many=RESOURCE[:RELATION_NAME][:FIELD] ...] \
    [--belongs-to-many-pivot=RESOURCE[:FIELD][:TYPE][:FAKER_STRING] ...] \
    [--belongs-to-many-pivot-timestamps=RESOURCE ...] \
    \
    [--has-one=RESOURCE[:RELATION_NAME][:FIELD] ...] \
    [--has-many=RESOURCE[:RELATION_NAME][:FIELD] ...] \
    [--has-many-through=[:TODO] ...] \
    \
    [--morph-to[=RELATION_NAME[:FIELD][:RESOURCE ...] ...] \
    [--morph-one=RESOURCE[:RELATION_NAME][:MORPH_TO][:FIELD] ...] \
    [--morph-many=RESOURCE[:RELATION_NAME][:MORPH_TO][:FIELD] ...] \
    [--morph-to-many=[:TODO] ...] \
    [--morphed-by-many=[:TODO] ...] \
    \
    [--translate=LANG[:SINGULAR][:PLURAL][:ACCUSATIVE_SINGULAR][:GENETIVE_PLURAL] ...] \
    [--translate-modifier=LANG:MODIFIER ...] \
    \
    [--translate-field=FIELD:LANG:TRANSLATION ...] \
    \
    [--translate-belongs-to=RESOURCE:LANG:TRANSLATION[:ACCUSATIVE_SINGULAR] ...] \
    [--translate-belongs-to-many=RESOURCE:LANG:TRANSLATION[:ACCUSATIVE_PLURAL][:GENETIVE_PLURAL] ...] \
    [--translate-belongs-to-many-pivot=RESOURCE:LANG:FIELD:TRANSLATION ...] \
    \
    [--translate-has-one=RESOURCE:LANG:TRANSLATION[:ACCUSATIVE_SINGULAR] ...] \
    [--translate-has-many=RESOURCE:LANG:TRANSLATION[:ACCUSATIVE_PLURAL][:GENETIVE_PLURAL] ...] \
    [--translate-has-many-through=[:TODO] ...] \
    \
    [--translate-morph-to=RESOURCE:LANG:TRANSLATION[:ACCUSATIVE_SINGULAR] ...] \
    [--translate-morph-one=RESOURCE:LANG:TRANSLATION[:ACCUSATIVE_SINGULAR] ...] \
    [--translate-morph-many=RESOURCE:LANG:TRANSLATION[:ACCUSATIVE_PLURAL][:GENETIVE_PLURAL] ...] \
    [--translate-morph-to-many=[:TODO] ...] \
    [--translate-morphed-by-many=[:TODO] ...] \
    \
    [--seed-count=COUNT] \
    \
    [--policy=POLICY] \
    [--policy-auth=AUTHENTICATABLE[:POLICY] ...] \
    \
    [--skip-model] \
    [--skip-repository] \
    [--skip-policy] \
    [--skip-migration] \
    [--skip-controller] \
    [--skip-form] \
    [--skip-transformer] \
    [--skip-datatable] \
    [--skip-factory] \
    [--skip-seeder] \
    [--skip-translation] \
    [--skip-creator] \
    [--skip-dump-composer] \
    \
    [--force]
```

Аргументы:

| Аргумент | Обязательный | Описание |
| --- | :---: | --- |
| `RESOURCE` | Да | Название ресурса. Пример: `generate:resource City --namespace=App` - создаст ресурс, доступный по адерсу `http://example.com/app/city`. |

️**Запрещенные названия ресурсов**
* Зарезервированные слова Laravel: `Repository`, `Translation`, `Model`.
* Зарезервированные слова PHP: `Object`, `String`, `Resource`, `Print`.
* [Слова исключения](http://english99.ru/plurals-exceptions/) множественного числа английских существительных: `Man`, `Child `, `Person` и прочие.

Параметры:

| Параметр | Обязательный | Множественный | Описание |
| --- | :---: | :---: | --- |
| `--package=` | Нет | Нет | Позволяет создавать ресурсы для пакетов в корневых директориях, отличных от директории проекта, например при указании параметра `--package=Victorinox` в качестве корневой директории будет установлена `packages/crmplease/victorinox` |
| `--namespace=` | Нет | Нет | Созданное ранее пространство имён, например `--namespace=App` |
| `--auth` | Нет | Нет | Включение авторизации в системе по эл.почте и паролю. Добавление этого параметра автоматически создаст поля `email`, `email_verified_at`, `password`, `remember_token` и таблицу `*_password_resets`. |
| `--uuid` | Нет | Нет | В качестве идентификатора модели будет использован строковой `UUID` вместо целочисленного значения `autoincrement`. |
| `--field=` | Нет | Да | Атрибуты ресура и поля в таблице. Значение передается в формате `NAME[:TYPE][:FAKER_STRING]`, где `NAME` - название поля, `TYPE` - тип данных или поля ввода (например - `string`, `editor`, `interger`, `file`, `image`, `color`), a `FAKER_STRING` - шаблон автозаполнения для фабрики ресурса (например - `$faker->unique()->phoneNumber`). Примеры: `--field=name`, `--field=birth:date`, `--field=color:color`, `--field=photo:image`, `--field=age:integer:$faker->numberBetween(18, 146)`. Полный перечень типов полей приведен в таблице ниже. |
| `--belongs-to=` | Нет | Да | Отношение O-to-М. Значение передается в формате `RESOURCE[:RELATION_NAME][:FIELD]`, где `RESOURCE` - название внешнего ресурса, `RELATION_NAME` - название отношения, a `FIELD` - название главного поля внешнего ресурса (по умолчанию: `name`). Примеры: `--belongs-to=Role`, `--belongs-to=User:owner`, `--belongs-to=BankAccount:account:iban`. |
| `--belongs-to-many=` | Нет | Да | Отношение M-to-М. Значение передается в формате `RESOURCE[:RELATION_NAME][:FIELD]`, где `RESOURCE` - название внешнего ресурса, `RELATION_NAME` - название отношения, a `FIELD` - название главного поля внешнего ресурса (по умолчанию: `name`). Добавление этого параметра автоматически создаст pivot-таблицу. Примеры: `--belongs-to-many=Phones`, `--belongs-to-many=User:friends`, `--belongs-to-many=Phone:phones:number`. |
| `--belongs-to-many-pivot=` | Нет | Да | Создает дополнительный столбец в pivot-таблице. Значение передается в формате `RESOURCE[:FIELD][:TYPE][:FAKER_STRING]`. Пример: `--belongs-to-many-pivot=Phones:default:boolean`. |
| `--belongs-to-many-pivot-timestamps=` | Нет | Да | Создает столбцы `created_at` и `updated_at` в pivot-таблице. В качестве значения передается название внешнего ресурса. Пример: `--belongs-to-many-pivot-timestamps=Phones`. |
| `--has-one=` | Нет | Да | Инверсия отношения O-to-М. Значение передается в формате `RESOURCE[:RELATION_NAME][:FIELD]`, где `RESOURCE` - название внешнего ресурса, `RELATION_NAME` - название отношения, a `FIELD` - название главного поля внешнего ресурса (по умолчанию: `name`). Примеры: `--has-one=Phone`, `--has-one=User:friend`, `--has-one=Phone:phone:number`. |
| `--has-many=` | Нет | Да | Инверсия отношения M-to-М. Значение передается в формате `RESOURCE[:RELATION_NAME][:FIELD]`, где `RESOURCE` - название внешнего ресурса, `RELATION_NAME` - название отношения, a `FIELD` - название главного поля внешнего ресурса (по умолчанию: `name`). Примеры: `--has-many=Phones`, `--has-many=User:friends`, `--has-many=Phone:phones:number`. |
| `--has-many-through=` | Нет | Да | ... |
| `--morph-to` или `--morph-to=`| Нет | Да | Создание [полиморфного отношения](https://laravel.com/docs/5.8/eloquent-relationships#polymorphic-relationships). Значение передается в формате `[:RELATION_NAME][:FIELD][:RESOURCE ...]`, где `RELATION_NAME` - название отношения, `FIELD` - название главного поля внешнего ресурса (по умолчанию: `name`), а `RESOURCE` - название внешных ресурсов, разделенных символом `:`. Если значение параметра `RELATION_NAME` не указано, то оно будет сгенерировано автоматически, например для ресурса `Like` название отношение будет `likeable`. Пример: `--morph-to=commentable:title`, `--morph-to=commentable:title:Post:Video`.  |
| `--morph-one=` | Нет | Да | Инверсия полиморфного отношения O-to-М. Значение передается в формате `RESOURCE[:RELATION_NAME][:MORPH_TO][:FIELD]`, где `RESOURCE` - название внешнего ресурса, `RELATION_NAME` - название отношения, `MORPH_TO` - название полиморфного отношения внешнего ресурса, a `FIELD` - название главного поля полиморфного отношения внешнего ресурса (по умолчанию: `name`). Примеры: `--morph-one=Phone`, `--morph-one=User:friend`, `--morph-one=Phone:phone:phoneable:number`. |
| `--morph-many=` | Нет | Да | Инверсия полиморфного отношения M-to-М. Значение передается в формате `RESOURCE[:RELATION_NAME][:MORPH_TO][:FIELD]`, где `RESOURCE` - название внешнего ресурса, `RELATION_NAME` - название отношения, `MORPH_TO` - название полиморфного отношения внешнего ресурса, a `FIELD` - название главного поля полиморфного отношения внешнего ресурса (по умолчанию: `name`). Примеры: `--morph-many=Phone`, `--morph-many=User:friends`, `--morph-many=Phone:phones:phoneable:number`. |
| `--morph-to-many=` | Нет | Да | ... |
| `--morphed-by-many=` | Нет | Да | ... |
| `--translate=` | Нет | Да | Создает файл трансляции для ресурса. Значение передается в формате `LANG[:SINGULAR][:PLURAL][:ACCUSATIVE_SINGULAR][:GENETIVE_PLURAL]`, где `LANG` - код языка (например `ru`), `SINGULAR` - название ресурса в единственном числе (например `Страна`), `PLURAL` - название ресурса во множественном числе (например `Страны`), `ACCUSATIVE_SINGULAR` - название ресурса в винительном падеже (например `Страну`) для фразы "Выбрать страну", `GENETIVE_PLURAL` - название ресурса в родительном падеже во множественном числе (например `Стран`) для фразы "Список стран". Пример: `--translate=ru:"Страна":"Страны":"Страну":"Стран"`. |
| `--translate-modifier=` | Нет | Да | Модификатор или тип шаблона трансляции. В русском языке означает род. Значение передается в формате `LANG:MODIFIER`. где `LANG` - код языка, а `MODIFIER` - название модификатора. Возможные значения для `MODIFIER`: `male` - мужской род (по умолчанию), `female` - женский род, `middle` - средний род. Пример: `--translate-modifier=ru:female`. |
| `--translate-field=` | Нет | Да | Трансляция атрибута или поля ресурса. Значение передается в формате `FIELD:LANG:TRANSLATION`, где `FIELD` - название поля, `LANG` - код языка, а `TRANSLATION` - строка перевода. Пример: `--translate-field=code:ru:"Код страны"`. |
| `--translate-belongs-to=` | Нет | Да | Трансляция отношения O-to-М ресурса. Значение передается в формате `RESOURCE:LANG:TRANSLATION[:ACCUSATIVE_SINGULAR]`, где `RESOURCE` - название внешнего ресурса, `LANG` - код языка, `TRANSLATION` - строка перевода (например `Страна`), а `ACCUSATIVE_SINGULAR` - название ресурса в винительном падеже (например `Страну`) для фразы "Выбрать страну". Пример: `--translate-belongs-to=Country:ru:"Страна":"Страну"`. |
| `--translate-belongs-to-many=` | Нет | Да | Трансляция отношения M-to-М ресурса. Значение передается в формате `RESOURCE:LANG:TRANSLATION[:ACCUSATIVE_PLURAL][:GENETIVE_PLURAL]`, где `RESOURCE` - название внешнего ресурса, `LANG` - код языка, `TRANSLATION` - строка перевода во множественном числе (например `Страны`), `ACCUSATIVE_PLURAL` - название ресурса во множественном числе в винительном падеже (например `Страны`) для фразы "Выбрать страны", a `GENETIVE_PLURAL` - название ресурса в родительном падеже во множественном числе (например `Стран`) для фразы "Список стран". Пример: `--translate-belongs-to-many=Country:ru:"Страны":"Страны":"Стран"`. |
| `--translate-belongs-to-many-pivot=` | Нет | Да | Трансляция конкретного поля отношения M-to-М ресурса. Значение передается в формате `RESOURCE:LANG:FIELD:TRANSLATION`, где `RESOURCE` - название внешнего ресурса, `LANG` - код языка, `FIELD` - название поля внешнего ресурса, а `TRANSLATION` - строка перевода (например `Номер`). Пример: `--translate-belongs-to-many-pivot=Phone:ru:number:"Номер"`. |
| `--translate-has-one=` | Нет | Да | Трансляция инверсии отношения O-to-М ресурса. Значение передается в формате `RESOURCE:LANG:TRANSLATION[:ACCUSATIVE_SINGULAR]`, где `RESOURCE` - название внешнего ресурса, `LANG` - код языка, `TRANSLATION` - строка перевода (например `Город`), а `ACCUSATIVE_SINGULAR` - название ресурса в винительном падеже (например `Город`) для фразы "Выбрать город". Пример: `--translate-has-one=City:ru:"Город":"Город"`. |
| `--translate-has-many=` | Нет | Да | Трансляция инверсии отношения М-to-М ресурса. Значение передается в формате `RESOURCE:LANG:TRANSLATION[:ACCUSATIVE_PLURAL][:GENETIVE_PLURAL]`, где `RESOURCE` - название внешнего ресурса, `LANG` - код языка, `TRANSLATION` - строка перевода во множественном числе (например `Друзья`), `ACCUSATIVE_SINGULAR` - название ресурса в винительном падеже во множественном числе (например `Друзей`) для фразы "Выбрать друзей", a `GENETIVE_PLURAL` - название ресурса в родительном падеже во множественном числе (например `Друзей`) для фразы "Список друзей". Пример: `--translate-has-many=Friend:ru:"Друзья":"Друзей":"Друзей"`. |
| `--translate-has-many-through=` | Нет | Да | ... |
| `--translate-morph-to=` | Нет | Да | Трансляция полиморфного отношения ресурса. Значение передается в формате `RELATION_NAME:LANG:TRANSLATION[:ACCUSATIVE_SINGULAR]`, где `RELATION_NAME` - название отношения, `LANG` - код языка, `TRANSLATION` - строка перевода (например `Сотрудник`), а `ACCUSATIVE_SINGULAR` - название ресурса в винительном падеже (например `Сотрудника`) для фразы "Выбрать сотрудника". Пример: `--translate-morph-to=accountable:ru:"Сотрудник":"Сотрудника"`. |
| `--translate-morph-one=` | Нет | Да | Трансляция инверсии полиморфного отношения O-to-М ресурса. Значение передается в формате `RESOURCE:LANG:TRANSLATION[:ACCUSATIVE_SINGULAR]`, где `RESOURCE` - название внешнего ресурса, `LANG` - код языка, `TRANSLATION` - строка перевода (например `Расчёт`), а `ACCUSATIVE_SINGULAR` - название ресурса в винительном падеже (например `Расчёт`) для фразы "Выбрать расчёт". Пример: `--translate-morph-one=AccountingReport:ru:"Расчёт":"Расчёт"`. |
| `--translate-morph-many=` | Нет | Да | Трансляция инверсии полиморфного отношения M-to-М ресурса. Значение передается в формате `RESOURCE:LANG:TRANSLATION[:ACCUSATIVE_PLURAL][:GENETIVE_PLURAL]`, где `RESOURCE` - название внешнего ресурса, `LANG` - код языка, `TRANSLATION` - строка перевода во множественном числе (например `Расчёты`), `ACCUSATIVE_PLURAL` - название ресурса в винительном падеже во множественном числе (например `Расчёты`) для фразы "Выбрать расчёты", a `GENETIVE_PLURAL` - название ресурса в родительном падеже во множественном числе (например `Расчётов`) для фразы "Список расчётов". Пример: `--translate-morph-many=AccountingReport:ru:"Расчёты":"Расчёты":"Расчётов"`. |
| `--translate-morph-to-many=` | Нет | Да | ... |
| `--translate-morphed-by-many=` | Нет | Да | ... |
| `--seed-count=` | Нет | Нет | Определяет какое количество сущностей будет создаст фабрика при запуске процедуры `db:seed`. Значение передается в формате `COUNT`, где `COUNT` - количество экземпляров (по умолчанию: 5). |
| `--policy=` | Нет | Нет | Определяет какое правило будет применяться при авторизации доступа к ресурсам. Значение передается в формате `POLICY`, где `POLICY` - строка с выражением или булевая константа (по умолчанию: `true`). |
| `--policy-auth=` | Нет | Да | Позволяет определить особые правила авторизации для различных типов пользователей. Значение передается в формате `AUTHENTICATABLE[:POLICY]`, где `AUTHENTICATABLE` — авторизованная сущность, а `POLICY` — строка с выражением или булевая константа (по умолчанию: `true`). Пример: `generate:policy Notification --policy-auth=Administrator --policy-auth=User:false`. |
| `--skip-model` | Нет | Нет | Пропустить создание модели. |
| `--skip-repository` | Нет | Нет | Пропустить создание репозитория. |
| `--skip-policy` | Нет | Нет | Пропустить создание политики. |
| `--skip-migration` | Нет | Нет | Пропустить создание миграций. |
| `--skip-controller` | Нет | Нет | Пропустить создание контроллера. |
| `--skip-form` | Нет | Нет | Пропустить создание форм. |
| `--skip-transformer` | Нет | Нет | Пропустить создание трансформеров. |
| `--skip-datatable` | Нет | Нет | Пропустить создание датагридов. |
| `--skip-factory` | Нет | Нет | Пропустить создание фабрик. |
| `--skip-seeder` | Нет | Нет | Пропустить создание заполнителя базы данных. |
| `--skip-translation` | Нет | Нет | Пропустить создание трансляций. |
| `--skip-creator` | Нет | Нет | Пропустить создание команды для создания сущностей. |
| `--skip-dump-composer` | Нет | Нет | Пропустить выполение процедуры `composer dump-autoload` после создания ресурса. |
| `--force` или `-f` | Нет | Нет | Принудительное создание всех компонентов ресурса: model, repository, migrations, controller, form, transformer, datatable, factory, seeder, translation, creator, если не указан запрет с помощью параметра `--skip-*`. |

Типы полей:

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
| `time` | `time` | `timepicker` | `datetime:H:i:s` | *Не реализовано.* |
| `timestamp` | `time` | `timepicker` | `datetime:H:i:s` | *Не реализовано.*  |
| `timepicker` | `time` | `timepicker` | `datetime:H:i:s` | *Не реализовано.*  |
| `color` | `string` | `colorpicker` | `string` |  |
| `colorpicker` | `string` | `colorpicker` | `string` |  |
| `file` | `text` | `file` | Объект класса `FileField` |  |
| `image` | `text` | `image` | Объект класса `ImageField` |  |
| `blob` | `binary` | `textarea` | `string` |  |
| `binary` | `binary` | `textarea` | `string` |  |
| `json` | `json` | `textarea` | `object` |  |
| `array` | `json` | `textarea` | `array` |  |
| `password` | `string` | `password` | `string` |  |

## Формы

Формы для создания или редактирования (методы `create` и ` edit`) ресурсов находятся в файлах `app/Forms/{Namespace}/{Resource}Form.php`, например: `app/Forms/App/UserForm.php`.

Класс формы содержит методы:
- `getCreateFormFields` — возвращает список полей формы создания ресурса (метод `create`).
- `getEditFormFields($model)` — возвращает список полей формы редактирования существующего ресурса (метод `edit`). Принимает на вход экземпляр редактируемого ресурса `$model`. 
- `getStoreValidationRules()` — возвращает список правил валидации при создании ресурса (метод `store`).
- `getUpdateValidationRules($model)` — возвращает список правил валидации при сохранении существующего ресурса (метод `update`). Принимает на вход экземпляр редактируемого ресурса `$model`.

Поля в форме описываются параметрами в соответствии с параметрами полей библиотеки [Laravel Form Builder](http://kristijanhusak.github.io/laravel-form-builder/field/basic-input-types.html).

## Политики

Создание политик осуществляется командой `generate:policy`:
```bash
php artisan generate:policy RESOURCE \
    [--package=PACKAGE] \
    [--policy-auth=AUTHENTICATABLE[:POLICY] ...] \
    [--policy=POLICY] \
    [--force]
```

Параметры:

| Параметр | Обязательный | Множественный | Описание |
| --- | :---: | :---: | --- |
| `--package=` | Нет | Нет | Позволяет создавать ресурсы для пакетов в корневых директориях, отличных от директории проекта, например при указании параметра `--package=Victorinox` в качестве корневой директории будет установлена `packages/crmplease/victorinox` |
| `--policy=` | Нет | Нет | Определяет какое правило будет применяться при авторизации доступа к ресурсам. Значение передается в формате `POLICY`, где `POLICY` - строка с выражением или булевая константа (по умолчанию: `true`). |
| `--policy-auth=` | Нет | Да | Позволяет определить особые правила авторизации для различных типов пользователей. Значение передается в формате `AUTHENTICATABLE[:POLICY]`, где `AUTHENTICATABLE` — авторизованная сущность, а `POLICY` — строка с выражением или булевая константа (по умолчанию: `true`). Пример: `generate:policy Notification --policy-auth=Administrator --policy-auth=User:false`. |

## Обработчики событий

Создание обработчиков событий осуществляется командой `generate:listener`:
```bash
php artisan generate:listener LISTENER \
    [--package=PACKAGE] \
    [--namespace=NAMESPACE ...] \
    [--listener-resource=RESOURCE ...] \
    [--force]
```

Параметры:

| Параметр | Обязательный | Множественный | Описание |
| --- | :---: | :---: | --- |
| `--package=` | Нет | Нет | Позволяет создавать ресурсы для пакетов в корневых директориях, отличных от директории проекта, например при указании параметра `--package=Victorinox` в качестве корневой директории будет установлена `packages/crmplease/victorinox` |
| `--namespace=` | Нет | Да | Созданное ранее пространство имён. Определяет, в каких пространстах имён будет работать обработчик например `generate:listener SendPasswordMessage --namespace=App --namespace=Cli`. |
| `--listener-resource=` | Нет | Да | Созданный ранее ресурс. Определяет, для каких ресурсов будет работать обработчик, например: `generate:listener SendPasswordMessage --listener-resource=Administrator --listener-resource=User`. |
| `--force` или `-f` | Нет | Нет | Принудительное создание всех компонентов обработчика. |

## Уведомления

Создание уведомлений осуществляется командой `generate:notification`:
```bash
php artisan generate:notification NOTIFICATION \
    [--namespace=NAMESPACE] \
    [--package=PACKAGE] \
    [--channel=CHANNEL ...] \
    [--subject=SUBJECT] \
    [--message=MESSAGE] \
    [--translate-subject-*=SUBJECT] \
    [--translate-message-*=MESSAGE] \
    [--force]
```

Генератор поддерживает динамические параметры `--translate-subject-*`, которые соответствуют количеству локалей системы. Например: `--translate-subject-en="Hello!"` и `--translate-subject-ru="Здравствуйте"`.

Параметры:

| Параметр | Обязательный | Множественный | Описание |
| --- | :---: | :---: | --- |
| `--package=` | Нет | Нет | Позволяет создавать ресурсы для пакетов в корневых директориях, отличных от директории проекта, например при указании параметра `--package=Victorinox` в качестве корневой директории будет установлена `packages/crmplease/victorinox` |
| `--namespace=` | Нет | Нет | Созданное ранее пространство имён, например `generate:notification ResetPassword --namespace=App`. |
| `--channel=` или `-c=` | Нет | Да | Каналы, по которым будет отправлено сообщение, например: `generate:listener ResetPassword --channel=mail --channel=broadcast`. Значение по умолчанию: `mail`. |
| `--subject=` или `-s=` | Нет | Нет | Тема сообщения, которое будет отправлено, например: `generate:listener ResetPassword --subject="Password Reset Link"`. |
| `--message=` или `-m=` | Нет | Нет | Текст сообщения, которое будет отправлено, например: `generate:listener ResetPassword --message="You are receiving this email because we received a password reset request for your account."`. |
| `--translate-subject-ru=` | Нет | Нет | Перевод темы сообщения, которое будет отправлено, например: `generate:listener ResetPassword --translate-subject-ru="Восстановление пароля"`. |
| `--translate-message-ru=` | Нет | Нет | Перевод текста сообщения, которое будет отправлено, например: `generate:listener ResetPassword --translate-message-ru="Вы получили это сообщенте, потому что кто-то отправил запрос на восстановление пароля."`. |
| `--force` или `-f` | Нет | Нет | Принудительное создание всех компонентов уведомления. |

## Изменение существующих ресурсов

Для добавления новых полей и связей ресурсам существует команда `modify:resource`. 

Синтаксис команды совпадает с синтаксисом [команды генерации ресурсов](#ресурсы).

# Пример использования пакета

Добавьте поддержку русского языка:
```bash
php artisan generate:locale ru
```

Создайте новое пространство имён:
```bash
php artisan generate:namespace App
```

Создайте ресурс Страна с полями название, код и изображение флага:
```bash
php artisan generate:resource Country \
    --namespace App \
    \
    --field=name:string \
    --field=code:string \
    --field=icon:image \
    \
    --translate=ru:"Страна":"Страны":"Страну":"Стран" \
    --translate-modifier=ru:female \
    \
    --translate-field=name:ru:"Название" \
    --translate-field=code:ru:"Код страны" \
    --translate-field=icon:ru:"Флаг" \
    \
    --force
```

Создайте ресурс Город с названием и отношением к стране:
```bash
php artisan generate:resource City \
    --namespace App \
    \
    --field=name:string \
    \
    --belongs-to=Country \
    \
    --translate=ru:"Город":"Города":"Город":"Городов" \
    --translate-modifier=ru:male \
    \
    --translate-field=name:ru:"Название" \
    \
    --translate-belongs-to=Country:ru:"Страна":"Страну" \
    \
    --force
```

Создайте ресурс Пользователь с именем, телефоном, возрастом, полом, аватаром и отношением к городу:
```bash
php artisan generate:resource Customer \
    --namespace App \
    \
    --field=name:string \
    --field=phone:string \
    --field=age:number \
    --field=sex:string \
    --field=photo:image \
    \
    --belongs-to=City \
    \
    --translate=ru:"Пользователь":"Пользователи":"Пользователя":"Пользователей" \
    --translate-modifier=ru:male \
    \
    --translate-field=name:ru:"Название" \
    --translate-field=phone:ru:"Телефон" \
    --translate-field=age:ru:"Возраст" \
    --translate-field=sex:ru:"Пол" \
    --translate-field=photo:ru:"Фотография" \
    \
    --translate-belongs-to=City:ru:"Город":"Город" \
    \
    --force
```

### Запуск
```bash
composer dump-autoload
php artisan migrate
php artisan serve
```

### Данные

#### Добавьте страны
```bash
php artisan resource:create:country \
    --name="Россия" \
    --code=ru \
    --icon=public/vendor/material-admin/img/flags/russia.svg
    
php artisan resource:create:country \
    --name="Казахстан" \
    --code=kz \
    --icon=public/vendor/material-admin/img/flags/kazakhstan.svg
    
php artisan resource:create:country \
    --name="Эстония" \
    --code=et \
    --icon=public/vendor/material-admin/img/flags/estonia.svg
    
php artisan resource:create:country \
    --name="Финляндия" \
    --code=fi \
    --icon=public/vendor/material-admin/img/flags/finland.svg
```

#### Добавьте города
   
```bash
php artisan resource:create:city \
    --name="Москва" \
    --country="Россия"
    
php artisan resource:create:city \
    --name="Санкт-Петербург" \
    --country="Россия"
    
php artisan resource:create:city \
    --name="Астана" \
    --country="Казахстан"
    
php artisan resource:create:city \
    --name="Таллин" \
    --country="Эстония"
    
php artisan resource:create:city \
    --name="Хельсинки" \
    --country="Финляндия"
```

#### Добавьте пользователей
   
```bash
php artisan resource:create:customer \
    --name="Николай Юминов" \
    --phone="+7 (916) 985-27-57" \
    --age=34 \
    --sex=male \
    --city="Москва" \
    --photo=public/vendor/material-admin/img/demo/contacts/1.jpg
    
php artisan resource:create:customer \
    --name="Алексей Сидоряк" \
    --phone="+7 (921) 443-07-48" \
    --age=29 \
    --sex=male \
    --city="Санкт-Петербург" \
    --photo=public/vendor/material-admin/img/demo/contacts/2.jpg
```

## Изменение ресурсов

Например, необходимо различать пользователей по типу, а также добавить им поле "Рост" и поддержку авторизации по эл.почте и паролю.

Для этого необходимо сначала добавить новый ресурс Тип пользователя
```bash
php artisan generate:resource CustomerType \
    --namespace App \
    \
    --field=name:string \
    --field=color:color \
    \
    --translate=ru:"Тип пользователя":"Типы пользователей":"Тип пользователя":"Типы пользователей" \
    \
    --translate-field=name:ru:"Название" \
    --translate-field=color:ru:"Цвет" \
    \
    --force
```

А затем, используя команду `modify:resource` решить поставленную задачу:

```bash
php artisan modify:resource Customer \
    --namespace=App \
    \
    --auth \
    \
    --field=height:number \
    --belongs-to=CustomerType \
    \
    --translate=ru \
    \
    --translate-field=height:ru:"Рост" \
    \
    --translate-belongs-to=CustomerType:ru:"Тип пользователя":"Тип пользователя" \
    \
    --force
```

Следите за подсказками в консоли и произведите соответствующие модификации модели, форм, датагридов и выполните миграции базы данных.

P.S. Имейте ввиду, что у ранее созданных Пользователей отсутствовало поле эл.почта и если таблица `customers` не пустая, то миграции могут не выполниться по причине нарушения уникальности поля `email`. Рекомендуется очистить таблицу `customers` перед выполнением миграций.

## Результат

Откройте в браузере страницу со списком пользователей:

[http://localhost/app/customer/](http://localhost/app/customer/)

<img src="http://i.imgur.com/1fNcWVV.png" />

**Удачи** ✊
