## Проект

### Запуск
```bash
git submodule update --init --recursive

cp .env.example .env

docker-compose run composer install
docker-compose run artisan key:generate
docker-compose run artisan migrate
docker-compose up -d
```

Для разработки
```bash
docker-compose run artisan ide-helper:generate
docker-compose run artisan ide-helper:models
docker-compose run artisan ide-helper:meta
```

## Фронтенд
   
### Зависимости

```bash
npm install
```

### Сборка

```bash
npm run production
```
