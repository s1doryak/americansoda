# Ресурсы

### Пространство имён:
```bash
docker-compose run artisan generate:namespace Dashboard
```

### Финский язык:
```bash
docker-compose run artisan generate:locale fi
```

### Восстановление таблицы `migrations`:
```sql
insert into migrations values
('2014_04_02_193005_create_translations_table', 1),
('2016_03_16_000000_create_regions_table', 1),
('2016_03_16_500000_create_companies_table', 1),
('2016_03_17_000000_create_roles_table', 1),
('2016_03_18_000000_create_users_table', 1),
('2016_03_18_100000_create_users_password_resets_table', 1),
('2016_03_18_200000_create_administrators_table', 1),
('2016_03_18_300000_create_administrators_password_resets_table', 1),
('2016_03_19_070808_create_brands_table', 1),
('2016_03_19_070810_create_package_types_table', 1),
('2016_03_19_070813_create_product_groups_table', 1),
('2016_03_19_070820_create_products_table', 1),
('2016_03_19_071456_create_stocks_table', 1),
('2016_03_19_072031_create_payment_types_table', 1),
('2016_03_19_072050_create_customer_types_table', 1),
('2016_03_19_072100_create_customers_table', 1),
('2016_03_19_072102_create_customer_revisions_table', 1),
('2016_03_19_072104_create_customer_orders_table', 1),
('2016_03_19_072105_create_customer_shipments_table', 1),
('2016_03_19_072118_create_customer_order_items_table', 1),
('2016_04_25_102600_create_customer_pricing_policies_table', 1),
('2016_04_25_102700_create_customer_pricing_policy_revisions_table', 1),
('2016_04_26_070809_create_assemblies_table', 1),
('2016_06_03_102021_create_stock_movements_table', 1),
('2016_06_03_102037_create_stock_movement_products_table', 1),
('2016_08_02_094119_create_stock_products_table', 1);
```
### Обновить CustomerInvoiceItem
```bash
docker-compose run artisan modify:resource CustomerInvoiceItem \
    --namespace=Dashboard \
    \
    --belongs-to=Product \
    \
    --translate=ru \
    \
    --translate-belongs-to=Product:ru:"Товар":"Товар" \
    \
    --force
```

### Обновить Customer
```bash
docker-compose run artisan modify:resource Customer \
    --namespace=Dashboard \
    \
    --field=y_tunnus \
    \
    --translate=ru \
    \
    --translate-field=y_tunnus:ru:"Y-tunnus" \
    \
    --force
```

### CustomerPreOrder
```bash
docker-compose run artisan generate:resource CustomerPreOrder \
    --namespace=Dashboard \
    \
    --field=number \
    --field=reference_number \
    --field=comment:textarea \
    \
    --belongs-to=CustomerUser \
    --belongs-to=CustomerOrder:customerOrder:number \
    --belongs-to=Customer \
    \
    --has-many=CustomerPreOrderItem:items \
    \
    --translate=ru:"Предзаказ клиента":"Предзаказы клиента":"Предзаказ клиента":"Предзаказов клиента" \
    --translate-modifier=ru:male \
    \
    --translate-field=number:ru:"Номер" \
    --translate-field=reference_number:ru:"Номер в системе клиента" \
    --translate-field=comment:ru:"Комментарий" \
    \
    --translate-belongs-to=CustomerUser:ru:"Сотрудник клиента":"Сотрудника клиента" \
    --translate-belongs-to=CustomerOrder:ru:"Заказ":"Заказ" \
    \
    --translate-has-many=items:ru:"Позиции предзаказа":"Позицию предзаказа" \
    \
    --force
```

### CustomerPreOrderItem
```bash
docker-compose run artisan generate:resource CustomerPreOrderItem \
    --namespace=Dashboard \
    \
    --field=quantity \
    --field=products_quantity \
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
    --belongs-to=CustomerPreOrder:customerPreOrder:number \
    --belongs-to=CustomerUser \
    --belongs-to=Customer \
    --belongs-to=Product \
    \
    --translate=ru:"Позиция предзаказа":"Позиции предзаказов":"Позицию предзаказа":"Позиций предзаказов" \
    --translate-modifier=ru:female \
    \
    --translate-field=quantity:ru:"Кол-во лот" \
    --translate-field=products_quantity:ru:"Кол-во товаров" \
    \
    --translate-field=price:ru:"Цена" \
    --translate-field=vat_price:ru:"Цена с НДС" \
    --translate-field=total_price:ru:"Итого" \
    --translate-field=total_vat_price:ru:"Итого с НДС" \
    --translate-field=deposit_price:ru:"Депозит" \
    --translate-field=deposit_vat_price:ru:"Депозит с НДС" \
    --translate-field=total_deposit_price:ru:"Итого депозит" \
    --translate-field=total_deposit_vat_price:ru:"Итого депозит с НДС" \
    \
    --translate-belongs-to=CustomerPreOrder:ru:"Предзаказ клиента":"Предзаказ клиента" \
    --translate-belongs-to=CustomerUser:ru:"Сотрудник клиента":"Сотрудника клиента" \
    --translate-belongs-to=Customer:ru:"Клиент":"Клиента" \
    --translate-belongs-to=Product:ru:"Товар":"Товар" \
    \
    --force
```

### CustomerUser
```bash
docker-compose run artisan generate:resource CustomerUser \
    --namespace=Dashboard \
    \
    --auth \
    \
    --field=name \
    --field=phone \
    --field=comment:editor \
    \
    --belongs-to-many=Customer \
    \
    --has-many=CustomerUserToken \
    \
    --translate=ru:"Сотрудник клиента":"Сотрудники клиента":"Сотрудника клиента":"Сотрудников клиента" \
    --translate-modifier=ru:male \
    \
    --translate-field=name:ru:"Имя" \
    --translate-field=phone:ru:"Телефон" \
    --translate-field=comment:ru:"Комментарий" \
    \
    --translate-belongs-to-many=Customer:ru:"Клиенты":"Клиента" \
    \
    --translate-has-many=CustomerUserToken:ru:"Токены сотрудников":"Токен сотрудника" \
    \
    --force
```

### CustomerUserToken
```bash
docker-compose run artisan generate:resource CustomerUserToken \
    --namespace=Dashboard \
    \
    --field=token \
    --field=ip_address \
    --field=user_agent \
    \
    --belongs-to=CustomerUser \
    \
    --translate=ru:"Токен сотрудника":"Токены сотрудников":"Токен сотрудника":"Токенов сотрудников" \
    --translate-modifier=ru:male \
    \
    --translate-field=token:ru:"Токен" \
    --translate-field=ip_address:ru:"IP адрес" \
    --translate-field=user_agent:ru:"Браузер" \
    \
    --translate-belongs-to=CustomerUser:ru:"Сотрудник клиента":"Сотрудника клиента" \
    \
    --force
```

### Обновить Customer
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

### PriceGroup
```bash
docker-compose run artisan generate:resource PriceGroup \
    --namespace=Dashboard \
    \
    --field=name \
    --field=manual:boolean \
    \
    --has-many=Customer \
    --has-many=PriceGroupBreakpoint:priceGroupBreakpoints:breakpoint \
    \
    --translate=ru:"Ценовая категория":"Ценовые категории":"Ценовую категорию":"Ценовых категорий" \
    --translate-modifier=ru:female \
    \
    --translate-field=name:ru:"Название" \
    --translate-field=manual:ru:"Ручной ввод цен" \
    \
    --translate-has-many=Customer:ru:"Клиенты":"Клиента" \
    --translate-has-many=PriceGroupBreakpoint:ru:"Градации цен":"Градацию цен" \
    \
    --force
```

### PriceGroupBreakpoint
```bash
docker-compose run artisan generate:resource PriceGroupBreakpoint \
    --namespace=Dashboard \
    \
    --field=breakpoint:float \
    \
    --belongs-to=PriceGroup \
    \
    --belongs-to-many=ProductGroup \
    --belongs-to-many-pivot=ProductGroup:price:float \
    \
    --translate=ru:"Градация цен":"Градации цен":"Градацию цен":"Градаций цен" \
    --translate-modifier=ru:female \
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

### Обновить CustomerOrderItem
```bash
docker-compose run artisan modify:resource CustomerOrderItem \
    --namespace=Dashboard \
    \
    --translate=ru \
    --translate-modifier=ru:male \
    \
    --belongs-to=CustomerInvoice \
    \
    --translate-belongs-to=CustomerInvoice:ru:"Счёт":"Счёт" \
    \
    --force
```

### CustomerInvoice
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
    --has-many=CustomerInvoiceItem:items \
    --has-many=CustomerInvoiceAction:actions \
    --has-many=CustomerInvoiceAttachment:attachments \
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

### CustomerInvoiceAction
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

### CustomerInvoiceAttachment
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

### CustomerInvoiceItem
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

### CompanyBankAccount
```bash
docker-compose run artisan generate:resource CompanyBankAccount \
    --namespace=Dashboard \
    \
    --field=bank \
    --field=swift \
    --field=account \
    --field=iban \
    --field=default:boolean \
    \
    --belongs-to=Company \
    \
    --translate=ru:"Счет компании":"Счета компании":"Счет компании":"Счетов компании" \
    --translate-modifier=ru:male \
    \
    --translate-field=bank:ru:"Название банка" \
    --translate-field=swift:ru:"SWIFT-код" \
    --translate-field=account:ru:"Банковский номер счета" \
    --translate-field=iban:ru:"Международный номер счета" \
    --translate-field=default:ru:"Основной счет" \
    \
    --translate-belongs-to=Company:ru:"Компания":"Компанию" \
    \
    --force
    
docker-compose run artisan resource:create:company_bank_account \
    --bank="Nordea" \
    --swift="NDEAFIHH" \
    --account="106430-240775" \
    --iban="FI72 1064 3000 240775" \
    --default="true" \
    --company="American Soda"
```

### ProductTag
```bash
docker-compose run artisan generate:resource ProductTag \
    --namespace=Dashboard \
    \
    --field=name \
    --field=icon \
    --field=color:color \
    \
    --belongs-to-many=Product \
    \
    --translate=ru:"Тег":"Теги":"Тег":"Тегов" \
    --translate-modifier=ru:male \
    \
    --translate-field=name:ru:"Название" \
    --translate-field=icon:ru:"Значок" \
    --translate-field=color:ru:"Цвет" \
    \
    --force
    
docker-compose run artisan db:seed --class=ProductTagsTableSeeder
```

### Region
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

### Company
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

### Role
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

### User
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

### Administrator
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

### Car ❌
### Brand
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

### PackageType
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

### ProductGroup
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

### Product
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
    --translate-belongs-to=brand:ru:"Бренд":"Бренд" \
    --translate-belongs-to=packageType:ru:"Тип упаковки":"Тип упаковки" \
    --translate-belongs-to=productGroup:ru:"Товарная категория":"Товарную категорию" \
    \
    --skip-migration \
    \
    --force
```

### Supplier ❌
### SupplierOrder ❌
### SupplierOrderItem ❌
### Stock
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
    --translate-belongs-to=region:ru:"Регион":"Регион" \
    \
    --skip-migration \
    \
    --force
```

### PaymentType
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

### CustomerType
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
    --translate-belongs-to=customerType:ru:"Тип клиента":"Тип клиента" \
    \
    --skip-migration \
    \
    --force
```

### Customer
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
    --translate-belongs-to=billingRegion:ru:"Юр. регион":"Юр. регион" \
    --translate-belongs-to=shippingRegion:ru:"Факт. регион":"Факт. регион" \
    \
    --skip-migration \
    \
    --force
```

### CustomerRevision
```bash
docker-compose run artisan generate:resource CustomerRevision \
    --namespace=Dashboard \
    \
    --field=revision_type \
    --belongs-to=CustomerRevision:revision \
    --belongs-to=User:editor \
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
    --translate=ru:"История клиента":"Истории клиентов":"Историю клиента":"Историй клиентов" \
    --translate-modifier=ru:female \
    \
    --translate-field=revision_type:ru:"Тип" \
    --translate-belongs-to=revision:"История клиента":"Историю клиента" \
    --translate-belongs-to=editor:"Редактор":"Редактора" \
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
    --translate-belongs-to=stock:"Склад":"Склад" \
    --translate-belongs-to=customerType:"Тип клиента":"Тип клиента" \
    --translate-belongs-to=paymentType:"Тип оплаты":"Тип оплаты" \
    --translate-belongs-to=user:"Ответственный":"Ответственного" \
    --translate-belongs-to=billingRegion:ru:"Юр. регион":"Юр. регион" \
    --translate-belongs-to=shippingRegion:ru:"Факт. регион":"Факт. регион" \
    \
    --skip-migration \
    \
    --force
```

### CustomerOrder
```bash
docker-compose run artisan generate:resource CustomerOrder \
    --namespace=Dashboard \
    \
    --field=number \
    --field=batch_number \
    --field=comment:editor \
    --field=fc_overdue:integer \
    --field=fc_comment:editor \
    --field=fc_future_comment:editor \
    --field=sent_at:timestamp \
    \
    --belongs-to=Customer \
    --belongs-to=User \
    \
    --translate=ru:"Заказ":"Заказы":"Заказ":"Заказов" \
    --translate-modifier=ru:male \
    \
    --translate-field=number:ru:"Номер" \
    --translate-field=batch_number:ru:"Номер в системе клиента" \
    --translate-field=comment:ru:"Комментарий" \
    --translate-field=fc_overdue:ru:"Просрочен" \
    --translate-field=fc_comment:ru:"Комментарий в календаре" \
    --translate-field=fc_future_comment:ru:"Комментарий к заказу в календаре" \
    --translate-field=sent_at:ru:"Отправлен клиенту" \
    \
    --translate-belongs-to=customer:ru:"Клиент":"Клиента" \
    --translate-belongs-to=user:ru:"Менеджер":"Менеджера" \
    \
    --skip-migration \
    \
    --force
```

### CustomerShipment
```bash
docker-compose run artisan generate:resource CustomerShipment \
    --namespace=Dashboard \
    \
    --field=number \
    --field=assembly_number \
    --field=invoice_number \
    --field=status \
    --field=delivery_type \
    --field=packages_quantity:integer \
    --field=comment:editor \
    \
    --belongs-to=PackageType \
    --belongs-to=Customer \
    --belongs-to=User \
    \
    --translate=ru:"Отгрузка":"Отгрузки":"Отгрузку":"Отгрузок" \
    --translate-modifier=ru:female \
    \
    --translate-field=number:ru:"Номер отгурзки" \
    --translate-field=assembly_number:ru:"Номер сборки" \
    --translate-field=invoice_number:ru:"Номер счёта" \
    --translate-field=status:ru:"Статус" \
    --translate-field=delivery_type:ru:"Тип доставки" \
    --translate-field=packages_quantity:ru:"Количество упаковок" \
    --translate-field=comment:ru:"Комментарий" \
    \
    --translate-belongs-to=packageType:ru:"Тип упаковки":"Тип упаковки" \
    --translate-belongs-to=customer:ru:"Клиент":"Клиента" \
    --translate-belongs-to=user:ru:"Менеджер":"Менеджера" \
    \
    --skip-migration \
    \
    --force
```

### CustomerOrderItem
```bash
docker-compose run artisan generate:resource CustomerOrderItem \
    --namespace=Dashboard \
    \
    --field=status \
    --field=product_name \
    --field=sales_unit_quantity:float \
    --field=product_manual_price:boolean \
    --field=product_price:float \
    --field=vat:integer \
    --field=product_vat_price:float \
    --field=products_quantity:integer \
    --field=packages_quantity:integer \
    --field=total_price:float \
    --field=total_vat_price:float \
    --field=deposit_enabled:boolean \
    --field=deposit_price:float \
    --field=deposit_vat:integer \
    --field=deposit_vat_price:float \
    --field=deposit_total_price:float \
    --field=deposit_total_vat:float \
    --field=deposit_total_vat_price:float \
    --field=bypass:boolean \
    --field=back_order:boolean \
    --field=cancelled:boolean \
    --field=expected_date:timestamp \
    \
    --belongs-to=Product \
    --belongs-to=Customer \
    --belongs-to=CustomerOrder \
    --belongs-to=CustomerShipment \
    \
    --translate=ru:"Строка заказа":"Строки заказа":"Строку заказа":"Строк заказов" \
    --translate-modifier=ru:female \
    \
    --translate-field=status:ru:"Статус" \
    --translate-field=product_name:ru:"Товар" \
    --translate-field=sales_unit_quantity:ru:"Лот" \
    --translate-field=product_manual_price:ru:"Произвольная цена" \
    --translate-field=product_price:ru:"Цена" \
    --translate-field=vat:ru:"НДС" \
    --translate-field=product_vat_price:ru:"Цена с НДС" \
    --translate-field=products_quantity:ru:"Кол-во товаров" \
    --translate-field=packages_quantity:ru:"Кол-во упакеовок" \
    --translate-field=total_price:ru:"Сумма" \
    --translate-field=total_vat_price:ru:"Сумма с НДС" \
    --translate-field=deposit_enabled:ru:"Депозит" \
    --translate-field=deposit_price:ru:"Цена депозита" \
    --translate-field=deposit_vat:ru:"НДС депозита" \
    --translate-field=deposit_vat_price:ru:"Цена депозита с НДС" \
    --translate-field=deposit_total_price:ru:"Сумма с депозитом" \
    --translate-field=deposit_total_vat:ru:"Сумма НДС депозита" \
    --translate-field=deposit_total_vat_price:ru:"Сумма с НДС депозита" \
    --translate-field=bypass:ru:"Не списывать со склада" \
    --translate-field=back_order:ru:"Отложенный заказ" \
    --translate-field=cancelled:ru:"Отмененный заказ" \
    --translate-field=expected_date:ru:"Будет поставлен" \
    \
    --translate-belongs-to=product:ru:"Товар":"Товар" \
    --translate-belongs-to=customer:ru:"Клиент":"Клиента" \
    --translate-belongs-to=customerOrder:ru:"Заказ":"Заказ" \
    --translate-belongs-to=customerShipment:ru:"Отгрузка":"Отгрузку" \
    \
    --skip-migration \
    \
    --force
```

### CustomerPricingPolicy
```bash
docker-compose run artisan generate:resource CustomerPricingPolicy \
    --namespace=Dashboard \
    \
    --field=products_range:integer \
    --field=price:float \
    \
    --belongs-to=ProductGroup \
    --belongs-to=Customer \
    \
    --translate=ru:"Ценовая политика":"Ценовые политики":"Ценовую политику":"Ценовых политик" \
    --translate-modifier=ru:female \
    \
    --translate-field=products_range:ru:"Кол-во лот" \
    --translate-field=price:ru:"Цена" \
    \
    --translate-belongs-to=productGroup:ru:"Товарная группа":"Товарную группу" \
    --translate-belongs-to=customer:ru:"Клиент":"Клиента" \
    \
    --skip-migration \
    \
    --force
```

### CustomerPricingPolicyRevision
```bash
docker-compose run artisan generate:resource CustomerPricingPolicyRevision \
    --namespace=Dashboard \
    \
    --field=revision_type \
    --field=revision_number:integer \
    --belongs-to=CustomerPricingPolicyRevision:revision \
    --belongs-to=CustomerPricingPolicy:customerPricingPolicy \
    --belongs-to=User:editor \
    \
    --field=products_range:integer \
    --field=price:float \
    \
    --belongs-to=ProductGroup \
    --belongs-to=Customer \
    \
    --translate=ru:"История ценовой политики":"Истории ценовых политики":"Историю ценовой политики":"Историй ценовых политик" \
    --translate-modifier=ru:female \
    \
    --translate-field=revision_type:ru:"Тип" \
    --translate-field=revision_number:ru:"Номер ревизии" \
    --translate-belongs-to=revision:"История цен":"Историю цен" \
    --translate-belongs-to=customerPricingPolicy:"Ценовая политика":"Ценовую политику" \
    --translate-belongs-to=editor:"Редактор":"Редактора" \
    \
    --translate-field=products_range:ru:"Кол-во лот" \
    --translate-field=price:ru:"Цена" \
    \
    --translate-belongs-to=productGroup:ru:"Товарная группа":"Товарную группу" \
    --translate-belongs-to=customer:ru:"Клиент":"Клиента" \
    \
    --skip-migration \
    \
    --force
```

### Assembly
```bash
docker-compose run artisan generate:resource Assembly \
    --namespace=Dashboard \
    \
    --field=number \
    --field=comment:editor \
    \
    --translate=ru:"Сборка":"Сборки":"Сборку":"Сборок" \
    --translate-modifier=ru:female \
    \
    --translate-field=number:ru:"Номер сборки" \
    --translate-field=comment:ru:"Комментарий" \
    \
    --skip-migration \
    \
    --force
```

### StockMovement
```bash
docker-compose run artisan generate:resource StockMovement \
    --namespace=Dashboard \
    \
    --field=movement_type \
    \
    --belongs-to=Stock \
    \
    --translate=ru:"Движение по складу":"Движения по складу":"Движение по складу":"Движений по складу" \
    --translate-modifier=ru:middle \
    \
    --translate-field=movement_type:ru:"Тип" \
    \
    --translate-belongs-to=Stock:ru:"Склад":"Склад" \
    \
    --skip-migration \
    \
    --force
```

### StockMovementProduct
```bash
docker-compose run artisan generate:resource StockMovementProduct \
    --namespace=Dashboard \
    \
    --field=product_name \
    --field=products_quantity:integer \
    --field=delivery_number \
    --field=expiration_date:timestamp \
    --field=movement_type \
    --field=comment:textarea \
    \
    --belongs-to=StockMovement \
    --belongs-to=Product \
    \
    --translate=ru:"Движение товаров":"Движения товаров":"Движение товаров":"Движений товаров" \
    --translate-modifier=ru:middle \
    \
    --translate-field=product_name:ru:"Товар" \
    --translate-field=products_quantity:ru:"Количество" \
    --translate-field=delivery_number:ru:"L-номер" \
    --translate-field=expiration_date:ru:"Срок годности" \
    --translate-field=movement_type:ru:"Тип движения" \
    --translate-field=comment:ru:"Комментарий" \
    \
    --translate-belongs-to=StockMovement:ru:"Движение товаров":"Движение товаров" \
    --translate-belongs-to=Product:ru:"Товар":"Товар" \
    \
    --skip-migration \
    \
    --force
```

### StockProduct
```bash
docker-compose run artisan generate:resource StockProduct \
    --namespace=Dashboard \
    \
    --field=delivery_number \
    --field=expiration_date:timestamp \
    \
    --belongs-to=Stock \
    --belongs-to=Product \
    --belongs-to=CustomerOrderItem \
    \
    --translate=ru:"Товар на складе":"Товары на складе":"Товар на складе":"Товаров на складе" \
    --translate-modifier=ru:middle \
    \
    --translate-field=delivery_number:ru:"L-номер" \
    --translate-field=expiration_date:ru:"Срок годности" \
    \
    --translate-belongs-to=Stock:ru:"Склад":"Склад" \
    --translate-belongs-to=Product:ru:"Товар":"Товар" \
    --translate-belongs-to=CustomerOrderItem:ru:"Позиция заказа":"Позицию заказа" \
    \
    --skip-migration \
    \
    --force
```

### TransportSheet ❌
### CalendarEvent ❌
### OptionGroup ❌
### Option ❌

