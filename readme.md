## Проект

### Модули
```bash
git submodule update --init --recursive
```

### Конфигурация
```bash
cp .env.example .env
```

### Запуск
```bash
docker-compose run composer install
docker-compose run artisan key:generate --ansi
docker-compose run artisan jwt:secret
docker-compose run artisan migrate
docker-compose run npm install
docker-compose run npm run production
```

### Миграция БД (не требуется)
```bash
source .env

# Удаление существующих таблиц
docker-compose run database mysql --protocol=TCP --host=${DB_HOST} --user=${DB_USERNAME} --password=${DB_PASSWORD} ${DB_DATABASE} < database/dump/drop.sql

# Импорт старой БД
docker-compose run database mysql --protocol=TCP --host=${DB_HOST} --user=${DB_USERNAME} --password=${DB_PASSWORD} ${DB_DATABASE} < legacy.sql

# Применение миграций
docker-compose run database mysql --protocol=TCP --host=${DB_HOST} --user=${DB_USERNAME} --password=${DB_PASSWORD} ${DB_DATABASE} < database/dump/diff.sql

# Восстановление таблицы миграций
docker-compose run database mysql --protocol=TCP --host=${DB_HOST} --user=${DB_USERNAME} --password=${DB_PASSWORD} ${DB_DATABASE} < database/dump/migrations.sql

# Добавление необходимых связей
docker-compose run database mysql --protocol=TCP --host=${DB_HOST} --user=${DB_USERNAME} --password=${DB_PASSWORD} ${DB_DATABASE} < database/dump/data.sql
```

### Счета
```bash
docker-compose run artisan maventa:import:invoices 20200101000000 --tiff --force
```

### Supervisor
Настройки `/home/demo/conf/supervisor/gtp.americansoda.demo.crmplease.me.conf`:
```ini
[program:gtp.americansoda.demo.crmplease.me-queue]
process_name=%(program_name)s_%(process_num)02d
command=php /home/demo/web/gtp.americansoda.demo.crmplease.me/public_html/artisan queue:listen
autostart=true
autorestart=true
user=demo
redirect_stderr=true
stdout_logfile=/home/demo/web/gtp.americansoda.demo.crmplease.me/logs/gtp.americansoda.demo.crmplease.me.supervisor.log
```

```bash
service supervisor restart
```
