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
    --belongs-to=CustomerPriceGroup \
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
    --translate-belongs-to=CustomerPriceGroup:ru:"Ценовая категория клиента":"Ценовую категорию клиента" \
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
    --field=screen_resolution \
    \
    --belongs-to-many=Customer \
    \
    --translate=ru:"Токен сотрудника":"Токены сотрудников":"Токен сотрудника":"Токенов сотрудников" \
    --translate-modifier=ru:male \
    \
    --translate-field=token:ru:"Токен" \
    --translate-field=user_agent:ru:"Браузер" \
    --translate-field=screen_resolution:ru:"Разрешение экрана" \
    \
    --translate-belongs=Customer:ru:"Клиент":"Клиента" \
    \
    --force
```

### Цены
-[ ] CustomerPriceGroup
```bash
docker-compose run artisan generate:resource CustomerPriceGroup \
    --namespace=Dashboard \
    \
    --field=name \
    --field=manual:boolean \
    \
    --has-many=Customer \
    --has-many=CustomerPriceGroupBreakpoint \
    \
    --translate=ru:"Ценовая категория клиента":"Ценовые категории клиента":"Ценовую категорию клиента":"Ценовых категорий клиента" \
    --translate-modifier=ru:male \
    \
    --translate-field=name:ru:"Название" \
    --translate-field=manual:ru:"Ручной ввод цен" \
    \
    --translate-has-many=Customer:ru:"Клиенты":"Клиента" \
    --translate-has-many=CustomerPriceGroupBreakpoint:ru:"Градации цен":"Градацию цен" \
    \
    --force
```

-[ ] CustomerPriceGroupBreakpoint
```bash
docker-compose run artisan generate:resource CustomerPriceGroupBreakpoint \
    --namespace=Dashboard \
    \
    --field=breakpoint:float \
    --field=price:float \
    \
    --belongs-to=CustomerPriceGroup \
    \
    --translate=ru:"Градация цен":"Градации цен":"Градацию цен":"Градаций цен" \
    --translate-modifier=ru:male \
    \
    --translate-field=breakpoint:ru:"Лоты" \
    --translate-field=price:ru:"Цена" \
    \
    --belongs-to=CustomerPriceGroup:ru:"Ценовая категория клиента":"Ценовую категорию клиента" \
    \
    --force
```

### Счета
-[x] CompanyBankAccount

-[ ] CustomerInvoice
```bash
docker-compose run artisan generate:resource CustomerInvoice \
    --namespace=Dashboard \
    \
    --field=maventa_id \
    --field=maventa_tiff:file \
    --field=maventa_initiated:boolean \
    \
    --field=currency \
    --field=data \
    --field=date \
    --field=date_due \
    --field=delivery_date \
    --field=delivery_type \
    --field=error_message \
    --field=invoice_delivery_address \
    --field=invoice_nr \
    --field=invoice_seller_information \
    --field=lang \
    --field=notes \
    --field=order_nr \
    --field=payment_terms \
    --field=reference_nr \
    --field=state:integer \
    --field=status \
    --field=sum \
    --field=sum_tax \
    --field=work_order_nr \
    \
    --field=company_interest \
    --field=company_paper_fee \
    --field=company_reminder \
    --field=company_comment \
    --field=company_reference \
    \
    --field=customer_nr:ru:"Номер клиента" \
    --field=customer_email:ru:"Эл.почта клиента" \
    --field=customer_name:ru:"Название клиента" \
    --field=customer_country:ru:"Страна клиента" \
    --field=customer_state:ru:"Штат, округ, облась клиента" \
    --field=customer_post_code:ru:"Почтовый индекс клиента" \
    --field=customer_post_office:ru:"Почтовый адрес клиента" \
    --field=customer_address1:ru:"Адрес клиента" \
    --field=customer_address2:ru:"Адрес клиента (доп.)" \
    --field=customer_contact_p:ru:"Контактное лицо" \
    --field=customer_bid:ru:"BID" \
    --field=customer_ovt:ru:"OVT" \
    \
    --belongs-to=Customer:customer \
    --belongs-to=CustomerShipment:shipment \
    --belongs-to-many=CompanyBankAccount:accounts \
    \
    --has-many:CustomerInvoiceItem:items \
    --has-many:CustomerInvoiceAction:actions \
    --has-many:CustomerInvoiceAttachment:attachments \
    --has-many=CustomerOrderItem:orderItems \
    \
    --translate=ru:"Счет":"Счета":"Счет":"Счетов" \
    --translate-modifier=ru:male \
    \
    --translate-field=maventa_id:ru:"Номер Maventa" \
    --translate-field=maventa_tiff:ru:"TIFF файл" \
    --translate-field=maventa_initiated:ru:"Был создан в Mavento" \
    \
    --translate-field=currency:ru:"Валюта" \
    --translate-field=data:ru:"Данные" \
    --translate-field=date:ru:"Дата создания" \
    --translate-field=date_due:ru:"Дата оплаты" \
    --translate-field=delivery_date:ru:"Дата доставки" \
    --translate-field=delivery_type:ru:"Тип доставки" \
    --translate-field=error_message:ru:"Текст ошибки" \
    --translate-field=invoice_delivery_address:ru:"Адрес доставки счёта" \
    --translate-field=invoice_nr:ru:"Номер счета" \
    --translate-field=invoice_seller_information:ru:"Информация о продавце" \
    --translate-field=lang:ru:"Язык" \
    --translate-field=notes:ru:"Комментарии" \
    --translate-field=order_nr:ru:"Номер заказа" \
    --translate-field=payment_terms:ru:"Условия оплаты" \
    --translate-field=reference_nr:ru:"Референс" \
    --translate-field=state:ru:"Состояние" \
    --translate-field=status:ru:"Статус" \
    --translate-field=sum:ru:"Сумма" \
    --translate-field=sum_tax:ru:"Сумма с НДС" \
    --translate-field=work_order_nr:ru:"Номер заказа на работу" \
    \
    --translate-field=company_interest:ru:"Процентная ставка компании" \
    --translate-field=company_paper_fee:ru:"Плата за бумажный счет" \
    --translate-field=company_reminder:ru:"Плата за напоминание" \
    --translate-field=company_comment:ru:"Комментарий к электронной почте" \
    --translate-field=company_reference:ru:"Номер в системе продавца (TRS)" \
    \
    --translate-field=customer_nr:ru:"Номер клиента" \
    --translate-field=customer_email:ru:"Эл.почта клиента" \
    --translate-field=customer_name:ru:"Название клиента" \
    --translate-field=customer_country:ru:"Страна клиента" \
    --translate-field=customer_state:ru:"Штат, округ, облась клиента" \
    --translate-field=customer_post_code:ru:"Почтовый индекс клиента" \
    --translate-field=customer_post_office:ru:"Почтовый адрес клиента" \
    --translate-field=customer_address1:ru:"Адрес клиента" \
    --translate-field=customer_address2:ru:"Адрес клиента (доп.)" \
    --translate-field=customer_contact_p:ru:"Контактное лицо" \
    --translate-field=customer_bid:ru:"BID" \
    --translate-field=customer_ovt:ru:"OVT" \
    \
    --translate-field=customer_comment:ru:"Комментарий клиента (от отклоненного счета)" \
    --translate-field=customer_reference:ru:"Номер в системе клиента" \   
    \
    --translate-belongs-to=customer:ru:"Клиент":"Клиента" \
    --translate-belongs-to=shipment:ru:"Отгрузка":"Отгрузку" \
    --translate-belongs-to-many=accounts:ru:"Счет компании":"Счет компании" \
    \
    --translate-has-many=items:ru:"Позиции счета":"Позицию счета" \
    --translate-has-many=actions:ru:"Действия со счётом":"Действие с счётом" \
    --translate-has-many=attachments:ru:"Вложенные файлы":"Вложенный файл" \
    --translate-has-many=orderItems:ru:"Позиции заказа":"Позицию заказа" \
    \
    --force
```

-[ ] CustomerInvoiceAction
```bash
docker-compose run artisan generate:resource CustomerInvoiceAction \
    --namespace=Dashboard \
    \
    --field=action \
    --field=timestamp:timestamp \
    \
    --belongs-to=CustomerInvoice \
    \
    --translate=ru:"Действие с счётом":"Действия с счётом":"Действие с счётом":"Действий с счётом" \
    --translate-modifier=ru:middle \
    \
    --translate-field=action:ru:"Действие" \
    --translate-field=timestamp:ru:"Время" \
    \
    --translate-belongs-to=CustomerInvoice:ru:"Счёт":"Счёт" \
    \
    --force
```

-[ ] CustomerInvoiceAttachment
```bash
docker-compose run artisan generate:resource CustomerInvoiceAttachment \
    --namespace=Dashboard \
    \
    --field=attachment_type \
    --field=filename \
    --field=file \
    \
    --belongs-to=CustomerInvoice \
    \
    --translate=ru:"Вложенный файл":"Вложенные файлы":"Вложенный файл":"Вложенных файлов" \
    --translate-modifier=ru:male \
    \
    --translate-field=attachment_type:ru:"Тип вложения" \
    --translate-field=filename:ru:"Название файла" \
    --translate-field=file:ru:"Содержимое" \
    \
    --translate-belongs-to=CustomerInvoice:ru:"Счёт":"Счёт" \
    \
    --force
```

-[ ] CustomerInvoiceItem
```bash
docker-compose run artisan generate:resource CustomerInvoiceItem \
    --namespace=Dashboard \
    \
    --field=position:integer \
    --field=item_code \
    --field=subject \
    --field=definition \
    --field=price \
    --field=unit_type \
    --field=amount:float \
    --field=sum \
    --field=tax:float \
    --field=sum_tax \
    --field=discount:float \
    \
    --belongs-to=CustomerInvoice:invoice \
    --belongs-to=CustomerOrderItem:orderItem \
    \
    --translate=ru:"Позиция счета":"Позиции счета":"Позицию счета":"Позиций счета" \
    --translate-modifier=ru:female \
    \
    --translate-field=position:ru:"Позиция" \
    --translate-field=item_code:ru:"Код товара" \
    --translate-field=subject:ru:"Название товара" \
    --translate-field=definition:ru:"Описание товара" \
    --translate-field=price:ru:"Цена" \
    --translate-field=unit_type:ru:"Ед. изм." \
    --translate-field=amount:ru:"Количество" \
    --translate-field=sum:ru:"Сумма" \
    --translate-field=tax:ru:"НДС" \
    --translate-field=sum_tax:ru:"Сумма с НДС" \
    --translate-field=discount:ru:"Скидка" \
    \
    --translate-belongs-to=invoice:ru:"Счёт":"Счёт" \
    --translate-belongs-to=orderItem:ru:"Позиция заказа":"Позицию заказа" \
    \
    --force
```

-[ ] Обновить CustomerOrderItem
```bash
docker-compose run artisan modify:resource CustomerOrderItem \
    --namespace=Dashboard \
    \
    --translate=ru \
    --translate-modifier=ru:male \
    \
    --belongs-to:CustomerInvoice \
    \
    --translate-belongs-to=CustomerInvoice:ru:"Счёт":"Счёт" \
    \
    --force
```

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
