# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]
- [x] Перенести стили
- [x] Библиотека для трансляций
- [ ] Счета
- [ ] Цены
- [ ] Иконки
- [ ] Вход по ссылке — https://tighten.co/blog/creating-a-password-less-medium-style-email-only-authentication-system-in-laravel
- [ ] Онлайн и Предзаказы
- [ ] Смена магазинов

-[ ] ProductTag
```bash
docker-compose run artisan generate:resource ProductTag \
    --namespace=Dashboard \
    \
    --field=name \
    --field=icon \
    --field=color:color \
    \
    --has-many=Product \
    \
    --translate=ru:"Тег":"Теги":"Тег":"Тегов" \
    --translate-modifier=ru:male \
    \
    --translate-field=name:ru:"Название" \
    --translate-field=icon:ru:"Значок" \
    --translate-field=color:ru:"Цвет" \
    \
    --translate-has-many=Product:ru:"Товары":"Товаров" \
    \
    --force
```

## [1.1.0] - 2019-05-23
- Dashboard namespace:
```bash
docker-compose run artisan generate:namespace Dashboard
```

- Suomen locale:
```bash
docker-compose run artisan generate:locale fi
```

Resources:
- Region
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

- Company
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

- Role
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

- User
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

- Administrator
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

- ❌ Car
- Brand
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

- PackageType
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

- ProductGroup
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
- `ProductGroupRepositoryEloquent`

- Product
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

- ❌ Supplier
- ❌ SupplierOrder
- ❌ SupplierOrderItem
- Stock
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

- PaymentType
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

- CustomerType
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

- Customer
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

- CustomerRevision
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

`CustomerRevisionRepositoryEloquent`
- CustomerOrder
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

`CustomerOrderRepositoryEloquent`
- CustomerShipment
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

`CustomerShipmentRepositoryEloquent`
- CustomerOrderItem
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

`CustomerOrderItemRepositoryEloquent`

- CustomerPricingPolicy
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

`CustomerPricingPolicyRepositoryEloquent`
- CustomerPricingPolicyRevision
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

`CustomerPricingPolicyRevisionRepositoryEloquent`

- Assembly
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

- StockMovement
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

`StockMovementTypeRepositoryConfig`

- StockMovementProduct
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

`StockMovementProductRepositoryEloquent`

- StockProduct
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

`StockProductRepositoryEloquent`

- ❌ TransportSheet
- ❌ CalendarEvent
- ❌ OptionGroup
- ❌ Option

## [1.0.0] - 2019-05-20
Init project semantic versioning.
