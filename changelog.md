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
    \
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
    \
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
    \
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
    \
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
    \
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
    \
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
```bash
docker-compose run artisan generate:resource Product \
    --namespace=Dashboard \
    \
    --field=name \
    --field=product_barcode \
    --field=product_barcode_plaintext \
    --field=package_barcode \
    --field=package_barcode_plaintext \
    --field=product_image:image \
    --field=package_image:image \
    --field=description:textarea \
    --field=contents:textarea \
    --field=number_in_package:integer \
    --field=weight:float \
    --field=volume:float \
    --field=brutto_weight:float \
    --field=brutto_volume:float \
    --field=deposit_enabled:boolean \
    --field=deposit_price:float \
    --field=deposit_vat:integer \
    --field=deposit_vat_price:float \
    --field=comment:textarea \
    \
    --belongs-to=Brand \
    --belongs-to=PackageType \
    --belongs-to=ProductGroup \
    \
    --translate=ru:"Товар":"Товары":"Товар":"Товаров" \
    --translate-modifier=ru:male \
    \
    --translate-field=name:ru:"Название" \
    --translate-field=product_barcode:ru:"Штрихкод" \
    --translate-field=product_barcode_plaintext:ru:"Штрихкод (текст)" \
    --translate-field=package_barcode:ru:"Штрихкод упаковки" \
    --translate-field=package_barcode_plaintext:ru:"Штрихкод упаковк (текст)" \
    --translate-field=product_image:ru:"Фото" \
    --translate-field=package_image:ru:"Фото упаковки" \
    --translate-field=description:ru:"Описание" \
    --translate-field=contents:ru:"Состав" \
    --translate-field=number_in_package:ru:"Ед. в упаковке" \
    --translate-field=weight:ru:"Вес" \
    --translate-field=volume:ru:"Объем" \
    --translate-field=brutto_weight:ru:"Вес (брутто)" \
    --translate-field=brutto_volume:ru:"Объем (брутто)" \
    --translate-field=deposit_enabled:ru:"Депозит" \
    --translate-field=deposit_price:ru:"Цена депозита" \
    --translate-field=deposit_vat:ru:"НДС депозита" \
    --translate-field=deposit_vat_price:ru:"Цена с НДС депозита" \
    --translate-field=comment:ru:"Комментарий" \
    \
    --translate-belongs-to=Brand:ru:"Бренд":"Бренд" \
    --translate-belongs-to=PackageType:ru:"Тип упаковки":"Тип упаковки" \
    --translate-belongs-to=ProductGroup:ru:"Товарная категория":"Товарную категорию" \
    \
    --skip-migration \
    \
    --force
```

-[ ] ❌ Supplier
-[ ] ❌ SupplierOrder
-[ ] ❌ SupplierOrderItem
-[ ] Stock
```bash
docker-compose run artisan generate:resource Stock \
    --namespace=Dashboard \
    \
    --field=name \
    --field=postcode \
    --field=address \
    \
    --belongs-to=Region \
    \
    --translate=ru:"Склад":"Склады":"Склад":"Складов" \
    --translate-modifier=ru:male \
    \
    --translate-field=name:ru:"Наименование" \
    --translate-field=postcode:ru:"Индекс" \
    --translate-field=address:ru:"Адрес" \
    \
    --translate-belongs-to=Region:ru:"Регион":"Регион" \
    \
    --skip-migration \
    \
    --force
```

-[ ] PaymentType
```bash
docker-compose run artisan generate:resource PaymentType \
    --namespace=Dashboard \
    \
    --field=name \
    \
    --translate=ru:"Тип оплаты":"Типы оплаты":"Тип оплаты":"Типов оплаты" \
    --translate-modifier=ru:male \
    \
    --translate-field=name:ru:"Название" \
    \
    --skip-migration \
    \
    --force
```

-[ ] CustomerType
```bash
docker-compose run artisan generate:resource CustomerType \
    --namespace=Dashboard \
    \
    --field=name \
    \
    --belongs-to=CustomerType \
    \
    --translate=ru:"Тип клиента":"Типы клиентов":"Тип клиента":"Типов клиентов" \
    --translate-modifier=ru:male \
    \
    --translate-field=name:ru:"Название" \
    \
    --translate-belongs-to=CustomerType:ru:"Тип клиента":"Тип клиента" \
    \
    --skip-migration \
    \
    --force
```

-[ ] Customer
```bash
docker-compose run artisan generate:resource Customer \
    --namespace=Dashboard \
    \
    --field=name \
    --field=legal_name \
    --field=billing_postcode \
    --field=billing_address \
    --field=shipping_postcode \
    --field=shipping_address \
    --field=bid \
    --field=iban \
    --field=swift \
    --field=email \
    --field=phone \
    --field=order_interval:integer \
    --field=comment:editor \
    --field=calendar_comment:editor \
    --field=incomterms \
    --field=terms_of_cooperation:textarea \
    --field=terms_of_delivery:textarea \
    --field=terms_of_equipment:textarea \
    --field=delivery_payer \
    --field=payment_conditions \
    --field=pays_vat:boolean \
    \
    --belongs-to=Stock \
    --belongs-to=CustomerType \
    --belongs-to=PaymentType \
    --belongs-to=User \
    --belongs-to=Region:billingRegion \
    --belongs-to=Region:shippingRegion \
    \
    --translate=ru:"Клиент":"Клиенты":"Клиент":"Клиентов" \
    --translate-modifier=ru:male \
    \
    --translate-field=name:ru:"Наименование" \
    --translate-field=legal_name:ru:"Юридическое название" \
    --translate-field=billing_postcode:ru:"Юр. индекс" \
    --translate-field=billing_address:ru:"Юр. адрес" \
    --translate-field=shipping_postcode:ru:"Факт. индекс" \
    --translate-field=shipping_address:ru:"Факт. адрес" \
    --translate-field=bid:ru:"ИНН" \
    --translate-field=iban:ru:"IBAN" \
    --translate-field=swift:ru:"SWIFT" \
    --translate-field=email:ru:"Эл.почта" \
    --translate-field=phone:ru:"Телефон" \
    --translate-field=order_interval:ru:"Интервал заказов" \
    --translate-field=comment:ru:"Комментарий" \
    --translate-field=calendar_comment:ru:"Комментарий в календаре" \
    --translate-field=incomterms:ru:"Инкомтермс" \
    --translate-field=terms_of_cooperation:ru:"Условия сотрудничества" \
    --translate-field=terms_of_delivery:ru:"Условия доставки" \
    --translate-field=terms_of_equipment:ru:"Условия поставки оборудования" \
    --translate-field=delivery_payer:ru:"Доставку оплачивает" \
    --translate-field=payment_conditions:ru:"Условия оплаты" \
    --translate-field=pays_vat:ru:"Плательщик НДС" \
    \
    --translate-belongs-to=Stock:"Склад":"Склад" \
    --translate-belongs-to=CustomerType:"Тип клиента":"Тип клиента" \
    --translate-belongs-to=PaymentType:"Тип оплаты":"Тип оплаты" \
    --translate-belongs-to=User:"Ответственный":"Ответственного" \
    --translate-belongs-to=Region:ru:"Юр. регион":"Юр. регион" \
    --translate-belongs-to=Region:ru:"Факт. регион":"Факт. регион" \
    \
    --skip-migration \
    \
    --force
```

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
