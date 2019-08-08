## Проект

### Модули
```bash
git submodule update --init --recursive
```

### Конфигурация
```bash
cp .env.example .env
```

### Окружение

Если вы используете Docker:
```bash
export ARTISAN="docker-compose run artisan"
export COMPOSER="docker-compose run composer"
```

### Запуск
```bash
${COMPOSER:-composer} install
${ARTISAN:-php artisan} key:generate --ansi
${ARTISAN:-php artisan} migrate
```

Для разработки
```bash
${ARTISAN:-php artisan} ide-helper:generate
${ARTISAN:-php artisan} ide-helper:models
${ARTISAN:-php artisan} ide-helper:meta
```

### Данные
```bash
export ARTISAN="docker-compose run artisan"
export EXTRA="--skip-event"

sh ./database/cli/seed.sh
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
WEBSOCKET_HTTPS_KEY=/home/demo/conf/web/ssl.gtp-wws.demo.crmplease.me.key
WEBSOCKET_HTTPS_CERT=/home/demo/conf/web/ssl.gtp-wws.demo.crmplease.me.pem
```

```bash
chown -R root:demo /home/demo/conf/web/ssl.gtp-wws.demo.crmplease.me.ca
chown -R root:demo /home/demo/conf/web/ssl.gtp-wws.demo.crmplease.me.crt
chown -R root:demo /home/demo/conf/web/ssl.gtp-wws.demo.crmplease.me.key
chown -R root:demo /home/demo/conf/web/ssl.gtp-wws.demo.crmplease.me.pem
```

### Supervisor
Настройки `/home/demo/conf/supervisor/gtp-wws.demo.crmplease.me.conf`:
```ini
[program:gtp-wws.demo.crmplease.me-queue]
process_name=%(program_name)s_%(process_num)02d
command=php /home/demo/web/gtp-wws.demo.crmplease.me/public_html/artisan queue:listen
autostart=true
autorestart=true
user=demo
redirect_stderr=true
stdout_logfile=/home/demo/web/gtp-wws.demo.crmplease.me/logs/gtp-wws.demo.crmplease.me.supervisor.log

[program:gtp-wws.demo.crmplease.me-websocket]
process_name=%(program_name)s_%(process_num)02d
command=node /home/demo/web/gtp-wws.demo.crmplease.me/public_html/websocket.js
autostart=true
autorestart=true
user=demo
redirect_stderr=true
stdout_logfile=/home/demo/web/gtp-wws.demo.crmplease.me/logs/gtp-wws.demo.crmplease.me.supervisor.log
```

```bash
service supervisor restart
```
