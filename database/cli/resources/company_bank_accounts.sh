#!/bin/bash

ARTISAN=${ARTISAN:-php artisan}
EXTRA=${EXTRA:-}

${ARTISAN} resource:create:company_bank_account \
  --bank="Nordea" \
  --swift="NDEAFIHH" \
  --account="106430-240775" \
  --iban="FI72 1064 3000 240775" \
  --default="true" \
  --company="American Soda" \
  ${EXTRA}
