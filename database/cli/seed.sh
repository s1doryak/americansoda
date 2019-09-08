#!/bin/bash

DIRECTORY=$(dirname "$0")

ARTISAN=${ARTISAN:-php artisan}
EXTRA=${EXTRA:-}

bash "${DIRECTORY}/resources/companies.sh"
bash "${DIRECTORY}/resources/company_bank_accounts.sh"
bash "${DIRECTORY}/resources/roles.sh"
bash "${DIRECTORY}/resources/administrators.sh"
