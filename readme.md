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
```

Для разработки
```bash
docker-compose run artisan ide-helper:generate
docker-compose run artisan ide-helper:models
docker-compose run artisan ide-helper:meta
```

### Данные
```bash
export EXTRA="--skip-event"

sh ./database/cli/seed.sh
```

### Счета
```bash
docker-compose run artisan maventa:import:invoices 20190401000000 --tiff --force
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

### WebSocket
```bash
WEBSOCKET_PORT=6003
WEBSOCKET_HTTPS_KEY=/home/demo/conf/web/ssl.gtp.americansoda.demo.crmplease.me.key
WEBSOCKET_HTTPS_CERT=/home/demo/conf/web/ssl.gtp.americansoda.demo.crmplease.me.pem
```

```bash
chown -R root:demo /home/demo/conf/web/ssl.gtp.americansoda.demo.crmplease.me.ca
chown -R root:demo /home/demo/conf/web/ssl.gtp.americansoda.demo.crmplease.me.crt
chown -R root:demo /home/demo/conf/web/ssl.gtp.americansoda.demo.crmplease.me.key
chown -R root:demo /home/demo/conf/web/ssl.gtp.americansoda.demo.crmplease.me.pem
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

[program:gtp.americansoda.demo.crmplease.me-websocket]
process_name=%(program_name)s_%(process_num)02d
command=node /home/demo/web/gtp.americansoda.demo.crmplease.me/public_html/websocket.js
autostart=true
autorestart=true
user=demo
redirect_stderr=true
stdout_logfile=/home/demo/web/gtp.americansoda.demo.crmplease.me/logs/gtp.americansoda.demo.crmplease.me.supervisor.log
```

```bash
service supervisor restart
```
