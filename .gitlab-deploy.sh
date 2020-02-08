#!/usr/bin/env bash

ACTION_NAME=$1

case "$ACTION_NAME" in
	-m|--master)
		shift
		echo "Deploy project Master branch on Production server"
		sudo -i -u $REMOTE_PROJECT_USER bash <<- EOF
			echo "Working On ${USER}"
		    cd $REMOTE_PROJECT_PATH
			git pull
			git pull --recurse-submodules
			composer install
			php artisan migrate
			npm install
			npm run production
		EOF
		shift
		;;
	-d|--dev)
		shift
		echo "Deploy project Dev branch on Dev server"
		sudo -i -u $PROJECT_USER bash <<- EOF
			echo "Working On ${USER}"
		    cd $PROJECT_PATH
		    git checkout dev
			git pull
			git pull --recurse-submodules
			composer install
			php artisan migrate
			npm install
			npm run production
			sudo supervisorctl restart gtp.americansoda.demo.crmplease.me-queue:gtp.americansoda.demo.crmplease.me-queue_00
		EOF
		shift
		;;
	-dm|--devmaster)
		shift
		echo "Deploy project Master branch on Dev Server"
		sudo -i -u $PROJECT_USER bash <<- EOF
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
		shift
		;;
    *)
		echo "Select current action"
		;;
esac