#!/bin/bash

ARTISAN=${ARTISAN:-php artisan}
EXTRA=${EXTRA:-}

${ARTISAN} resource:create:administrator \
  --name="Aleksey Sidoryak" \
  --email="a@sidoryak.ru" \
  --password="secret" \
  --phone="+7 (921) 443-07-48" \
  --locale="ru" \
  --role="Administrator" \
  --company="American Soda" \
  --avatar="resources/assets/dashboard/img/administrators/a@sidoryak.ru.jpg" \
  ${EXTRA}
