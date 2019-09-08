#!/bin/bash

ARTISAN=${ARTISAN:-php artisan}
EXTRA=${EXTRA:-}

${ARTISAN} resource:create:company \
  --name="American Soda" \
  ${EXTRA}
