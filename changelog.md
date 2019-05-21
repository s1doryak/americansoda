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

-[ ] Company
-[ ] Role
-[ ] User
-[ ] Administrator
-[ ] ❌ Car
-[ ] Brand
-[ ] PackageType
-[ ] ProductGroup
`ProductGroupRepositoryEloquent`
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
