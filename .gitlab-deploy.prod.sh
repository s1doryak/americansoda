#!/usr/bin/env bash

set - f

echo "Deploy project on server ${DEPLOY_SERVER}"
sudo -i -u $PROJECT_USER bash << EOF
	echo "Working On ${USER}"
    cd $PROJECT_PATH &&
	git pull &&
	composer install &&
	php artisan migrate &&
	npm install &&
	npm run production
EOF
echo "Yay, DONE!"