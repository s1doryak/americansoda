#!/usr/bin/env bash

set - f

echo "Deploy project Master on Dev Server"
sudo -i -u $PROJECT_USER bash << EOF
	echo "Working On ${USER}"
    cd $PROJECT_PATH
    git checkout master
	git pull
	git pull --recurse-submodules
	composer install
	php artisan migrate
	npm install
	npm run production
	sudo supervisorctl restart gtp.americansoda.demo.crmplease.me-queue:gtp.americansoda.demo.crmplease.me-queue_00
EOF
echo "Yay, DONE!"