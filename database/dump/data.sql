# Банковский счёт
INSERT INTO `company_bank_accounts` (`company_id`, `bank`, `swift`, `account`, `iban`, `default`, `created_at`, `updated_at`, `deleted_at`) VALUES (1, 'Nordea', 'NDEAFIHH', '106430-240775', 'FI72 1064 3000 240775', 1, '2020-02-03 16:56:36', '2020-02-03 16:56:36', null);

# Типы товаров
INSERT INTO `product_types` (`name`, `created_at`, `updated_at`, `deleted_at`, `image`) VALUES ('Tuotteet', '2020-05-02 16:09:08', '2020-05-02 16:09:08', null, null);
UPDATE `product_groups` SET `product_type_id` = 1;

# Типы цен
INSERT INTO `price_groups` (`name`, `manual`, `created_at`, `updated_at`, `deleted_at`) VALUES ('Manuaali', 1, '2020-02-08 17:52:13', '2020-04-29 08:31:11', null);
UPDATE `customers` SET `price_group_id` = 1;
