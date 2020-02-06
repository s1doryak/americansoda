#!/usr/bin/env bash

set - f

echo "Deploy project on Production server"
sudo -i -u $REMOTE_PROJECT_USER bash << EOF
	echo "Working On ${USER}"
    cd $REMOTE_PROJECT_PATH &&
	git pull &&
	git pull --recurse-submodules &&
	composer install &&
	php artisan migrate &&
	npm install &&
	npm run production &&
EOF

echo "Yay, DONE!"