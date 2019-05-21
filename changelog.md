# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]
-[x] Dashboard namespace:
```bash
docker-compose run artisan generate:namespace Dashboard
```

-[x] Suomen locale:
```bash
docker-compose run artisan generate:locale fi
```

Resources:
-[x] Region
```bash
docker-compose run artisan generate:resource Region \
    --namespace=Dashboard \
    \
    --field=name \
    \
    --translate=ru:"Регион":"Регионы":"Регион":"Регионов" \
    --translate-modifier=ru:male \
    --translate-field=name:ru:"Название" \
    \
    --skip-migration \
    \
    --force
```

-[x] Company
```bash
docker-compose run artisan generate:resource Company \
    --namespace=Dashboard \
    \
    --field=name \
    --field=legal_name \
    --field=short_name \
    --field=postcode \
    --field=address \
    --field=bid \
    --field=email \
    --field=phone \
    --field=code \
    --field=smtp_host \
    --field=smtp_port \
    --field=smtp_encryption \
    --field=smtp_username \
    --field=smtp_password \
    --field=smtp_from \
    --field=smtp_from_name \
    \
    --belongs-to=Region \
    \
    --translate=ru:"Компания":"Компании":"Компанию":"Компаний" \
    --translate-modifier=ru:female \
    --translate-field=name:ru:"Наименование" \
    --translate-field=legal_name:ru:"Полное наименование" \
    --translate-field=short_name:ru:"Сокращенное наименование" \
    --translate-field=postcode:ru:"Индекс" \
    --translate-field=address:ru:"Адрес" \
    --translate-field=bid:ru:"ИНН" \
    --translate-field=email:ru:"Эл.почта" \
    --translate-field=phone:ru:"Телефон" \
    --translate-field=code:ru:"Код" \
    --translate-field=smtp_host:ru:"SMTP сервер" \
    --translate-field=smtp_port:ru:"SMTP порт" \
    --translate-field=smtp_encryption:ru:"SMTP шифрование" \
    --translate-field=smtp_username:ru:"SMTP логин" \
    --translate-field=smtp_password:ru:"SMTP пароль" \
    --translate-field=smtp_from:ru:"SMTP почта отправителя" \
    --translate-field=smtp_from_name:ru:"SMTP имя отправителя" \
    \
    --translate-belongs-to=Region:ru:"Регион":"Регион" \
    \
    --skip-migration \
    \
    --force
```

-[x] Role
```bash
docker-compose run artisan generate:resource Role \
    --namespace=Dashboard \
    \
    --field=name \
    --field=slug \
    \
    --translate=ru:"Роль":"Роли":"Роль":"Ролей" \
    --translate-modifier=ru:female \
    --translate-field=name:ru:"Название" \
    --translate-field=slug:ru:"URL" \
    \
    --skip-migration \
    \
    --force
```

-[x] User
```bash
docker-compose run artisan generate:resource User \
    --namespace=Dashboard \
    \
    --auth \
    \
    --field=email \
    --field=password \
    --field=name \
    --field=phone \
    --field=avatar:image \
    \
    --belongs-to=Role \
    --belongs-to=Company \
    \
    --translate=ru:"Пользователь":"Пользователи":"Пользователя":"Пользователей" \
    --translate-modifier=ru:male \
    \
    --translate-field=email:ru:"Эл.почта" \
    --translate-field=password:ru:"Пароль" \
    --translate-field=name:ru:"Имя" \
    --translate-field=phone:ru:"Телефон" \
    --translate-field=avatar:ru:"Фотография" \
    \
    --translate-belongs-to=Role:ru:"Роль":"Роль" \
    --translate-belongs-to=Company:ru:"Компания":"Компанию" \
    \
    --skip-migration \
    \
    --force
```

-[x] Administrator
```bash
docker-compose run artisan generate:resource Administrator \
    --namespace=Dashboard \
    \
    --auth \
    \
    --field=email \
    --field=password \
    --field=name \
    --field=phone \
    --field=avatar:image \
    \
    --belongs-to=Role \
    --belongs-to=Company \
    \
    --translate=ru:"Администратор":"Администраторы":"Администратора":"Администраторов" \
    --translate-modifier=ru:male \
    \
    --translate-field=email:ru:"Эл.почта" \
    --translate-field=password:ru:"Пароль" \
    --translate-field=name:ru:"Имя" \
    --translate-field=phone:ru:"Телефон" \
    --translate-field=avatar:ru:"Фотография" \
    \
    --translate-belongs-to=Role:ru:"Роль":"Роль" \
    --translate-belongs-to=Company:ru:"Компания":"Компанию" \
    \
    --skip-migration \
    \
    --force
```

-[ ] ❌ Car
-[x] Brand
```bash
docker-compose run artisan generate:resource Brand \
    --namespace=Dashboard \
    \
    --field=name \
    --field=logo:image \
    \
    --translate=ru:"Бренд":"Бренды":"Бренд":"Брендов" \
    --translate-modifier=ru:male \
    --translate-field=name:ru:"Название" \
    --translate-field=logo:ru:"Логотип" \
    \
    --skip-migration \
    \
    --force
```

-[x] PackageType
```bash
docker-compose run artisan generate:resource PackageType \
    --namespace=Dashboard \
    \
    --field=name \
    --field=description:textarea \
    \
    --translate=ru:"Тип упаковки":"Типы упаковки":"Тип упаковки":"Типов упаковки" \
    --translate-modifier=ru:male \
    --translate-field=name:ru:"Название" \
    --translate-field=description:ru:"Описание" \
    \
    --skip-migration \
    \
    --force
```

-[x] ProductGroup
```bash
docker-compose run artisan generate:resource ProductGroup \
    --namespace=Dashboard \
    \
    --field=name \
    --field=vat:integer \
    --field=sales_unit_volume:integer \
    \
    --translate=ru:"Товарная категория":"Товарные категории":"Товарную категорию":"Товарных категорий" \
    --translate-modifier=ru:female \
    --translate-field=name:ru:"Название" \
    --translate-field=vat:ru:"НДС" \
    --translate-field=sales_unit_volume:ru:"Размер лоты" \
    \
    --skip-migration \
    \
    --force
```
-[x] `ProductGroupRepositoryEloquent`

-[ ] Product
-[ ] ❌ Supplier
-[ ] ❌ SupplierOrder
-[ ] ❌ SupplierOrderItem
-[ ] Stock
-[ ] PaymentType
-[ ] CustomerType
-[ ] Customer
-[ ] CustomerRevision
`CustomerRevisionRepositoryEloquent`
-[ ] CustomerOrder
`CustomerOrderRepositoryEloquent`
-[ ] CustomerShipment
`CustomerShipmentRepositoryEloquent`
-[ ] CustomerOrderItem
`CustomerOrderItemRepositoryEloquent`
-[ ] CustomerPricingPolicy
`CustomerPricingPolicyRepositoryEloquent`
-[ ] CustomerPricingPolicyRevision
`CustomerPricingPolicyRevisionRepositoryEloquent`
-[ ] Assembly
-[ ] StockMovement
`StockMovementTypeRepositoryConfig`
-[ ] StockMovementProduct
`StockMovementProductRepositoryEloquent`
-[ ] StockProduct
`StockProductRepositoryEloquent`
-[ ] ❌ TransportSheet
-[ ] ❌ CalendarEvent
-[ ] ❌ OptionGroup
-[ ] ❌ Option

## [1.0.0] - 2019-05-20
Init project semantic versioning.
