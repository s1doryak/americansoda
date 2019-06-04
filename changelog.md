# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]
- [x] Перенести стили
- [x] Библиотека для трансляций
- [x] Счета
- [x] Цены+ЦеновойТипКлиента
- [x] Иконки
- [x] Вход по ссылке — https://tighten.co/blog/creating-a-password-less-medium-style-email-only-authentication-system-in-laravel
- [x] Онлайн и Предзаказы
- [ ] Календарь

### Онлайн и Предзаказы
-[ ] CustomerPreOrder
```bash
docker-compose run artisan modify:resource CustomerPreOrder \
    --namespace=Dashboard \
    \
    --field=comment:textarea \
    \
    --belongs-to=CustomerPerson \
    --belongs-to=CustomerOrder \
    --belongs-to=Customer \
    \
    --has-many=CustomerPreOrderItem:items \
    \
    --translate=ru:"Предзаказ клиента":"Предзаказы клиента":"Предзаказ клиента":"Предзаказов клиента" \
    --translate-modifier=ru:male \
    \
    --translate-field=comment:ru:"Комментарий" \
    \
    --translate-belongs-to=CustomerPerson:ru:"Сотрудник клиента":"Сотрудника клиента" \
    --translate-belongs-to=CustomerOrder:ru:"Заказ":"Заказ" \
    \
    --translate-has-many=items:ru:"Позиции предзаказа":"Позицию предзаказа" \
    \
    --force
```

-[ ] CustomerPreOrderItem
```bash
docker-compose run artisan modify:resource CustomerPreOrderItem \
    --namespace=Dashboard \
    \
    --filed=quantity \
    --filed=products_quantity \
    \
    --field=price \
    --field=vat_price \
    --field=total_price \
    --field=total_vat_price \
    --field=deposit_price \
    --field=deposit_vat_price \
    --field=total_deposit_price \
    --field=total_deposit_vat_price \
    \
    --belongs-to=CustomerPreOrder \
    --belongs-to=CustomerPerson \
    --belongs-to=Customer \
    --belongs-to=Product \
    \
    --translate=ru:"Позиция предзаказа":"Позиции предзаказов":"Позицию предзаказа":"Позиций предзаказов" \
    --translate-modifier=ru:female \
    \
    --force
```

### Вход по ссылке
-[ ] Обновить Customer
```bash
docker-compose run artisan modify:resource Customer \
    --namespace=Dashboard \
    \
    --field=archived:boolean \
    \
    --field=nr \
    --field=country \
    --field=state \
    --field=post_code \
    --field=post_office \
    --field=address1 \
    --field=address2 \
    --field=contact_p \
    --field=ovt \
    \
    --belongs-to=PriceGroup \
    \
    --has-many=CustomerInvoice \
    \
    --translate=ru \
    --translate-modifier=ru:male \
    \
    --translate-field=archived:ru:"Неактивный" \
    \
    --translate-field=nr:ru:"Номер клиента" \
    --translate-field=country:ru:"Страна клиента" \
    --translate-field=state:ru:"Штат, округ, облась клиента" \
    --translate-field=post_code:ru:"Почтовый индекс клиента" \
    --translate-field=post_office:ru:"Почтовый адрес клиента" \
    --translate-field=address1:ru:"Адрес клиента" \
    --translate-field=address2:ru:"Адрес клиента (доп.)" \
    --translate-field=contact_p:ru:"Контактное лицо" \
    --translate-field=ovt:ru:"OVT" \
    \
    --translate-belongs-to=PriceGroup:ru:"Ценовая категория клиента":"Ценовую категорию клиента" \
    \
    --translate-has-many=CustomerInvoice:ru:"Счёта":"Счёт" \
    \
    --force
```

-[ ] CustomerPerson
```bash
docker-compose run artisan generate:resource CustomerPerson \
    --namespace=Dashboard \
    \
    --auth \
    \
    --belongs-to-many=Customer \
    \
    --has-many=CustomerPersonToken \
    \
    --translate=ru:"Сотрудник клиента":"Сотрудники клиента":"Сотрудника клиента":"Сотрудников клиента" \
    --translate-modifier=ru:male \
    \
    --translate-belongs-to-many=Customer:ru:"Клиенты":"Клиента" \
    \
    --translate-has-many=CustomerPersonToken:ru:"Токены сотрудников":"Токен сотрудника" \
    \
    --force
```

-[ ] CustomerPersonToken
```bash
docker-compose run artisan generate:resource CustomerPersonToken \
    --namespace=Dashboard \
    \
    --field=token \
    --field=user_agent \
    \
    --belongs-to-many=Customer \
    \
    --translate=ru:"Токен сотрудника":"Токены сотрудников":"Токен сотрудника":"Токенов сотрудников" \
    --translate-modifier=ru:male \
    \
    --translate-field=token:ru:"Токен" \
    --translate-field=user_agent:ru:"Браузер" \
    \
    --translate-belongs=Customer:ru:"Клиент":"Клиента" \
    \
    --force
```

### Цены
-[ ] PriceGroup
```bash
docker-compose run artisan generate:resource PriceGroup \
    --namespace=Dashboard \
    \
    --field=name \
    --field=manual:boolean \
    \
    --has-many=Customer \
    --has-many=PriceGroupBreakpoint \
    \
    --translate=ru:"Ценовая категория":"Ценовые категории":"Ценовую категорию":"Ценовых категорий" \
    --translate-modifier=ru:male \
    \
    --translate-field=name:ru:"Название" \
    --translate-field=manual:ru:"Ручной ввод цен" \
    \
    --translate-has-many=Customer:ru:"Клиенты":"Клиента" \
    --translate-has-many=PriceGroupBreakpoint:ru:"Градации цен":"Градацию цен" \
    \
    --force
```

-[ ] PriceGroupBreakpoint
```bash
docker-compose run artisan generate:resource PriceGroupBreakpoint \
    --namespace=Dashboard \
    \
    --field=breakpoint:float \
    --field=price:float \
    \
    --belongs-to=PriceGroup \
    \
    --belongs-to-many=ProductGroup \
    --belongs-to-many-pivot=ProductGroup:price:float \
    \
    --translate=ru:"Градация цен":"Градации цен":"Градацию цен":"Градаций цен" \
    --translate-modifier=ru:male \
    \
    --translate-field=breakpoint:ru:"Лоты" \
    \
    --translate-belongs-to=PriceGroup:ru:"Ценовая категория":"Ценовую категорию" \
    \
    --translate-belongs-to-many=ProductGroup:ru:"Товарная категория":"Товарную категорию" \
    --translate-belongs-to-many-pivot=ProductGroup:ru:price:"Цена" \
    \
    --force
```

### Счета
-[x] CompanyBankAccount
-[x] CustomerInvoice
-[x] CustomerInvoiceAction
-[x] CustomerInvoiceAttachment
-[x] CustomerInvoiceItem
-[x] Обновить CustomerOrderItem

## [1.1.1] - 2019-06-03
- Восстановление таблицы `migrations`:
- ProductTag

## [1.1.0] - 2019-05-23
- Dashboard namespace
- Suomen locale
- Region
- Company
- Role
- User
- Administrator
- Car ❌
- Brand
- PackageType
- ProductGroup
- Product
- Supplier ❌
- SupplierOrder ❌
- SupplierOrderItem ❌
- Stock
- PaymentType
- CustomerType
- Customer
- CustomerRevision
- CustomerOrder
- CustomerShipment
- CustomerOrderItem
- CustomerPricingPolicy
- CustomerPricingPolicyRevision
- Assembly
- StockMovement
- StockMovementProduct
- StockProduct
- TransportSheet ❌
- CalendarEvent ❌
- OptionGroup ❌
- Option ❌

## [1.0.0] - 2019-05-20
Init project semantic versioning.
