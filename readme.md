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
docker-compose run artisan migrate
docker-compose run npm install
docker-compose run npm run production
```

### Счета
```bash
docker-compose run artisan maventa:import:invoices 20190401000000 --tiff --force
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
