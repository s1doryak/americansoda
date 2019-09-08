#!/bin/bash

ARTISAN=${ARTISAN:-php artisan}
EXTRA=${EXTRA:-}

${ARTISAN} resource:create:role \
  --name="Administrator" \
  --slug="admin" \
  ${EXTRA}
