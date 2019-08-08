#!/bin/sh

## GitLab push hook update script

# The output of this script is logged by PHP, so any unnecessary output should
# be discarded. To enable logging of any output the cd command produces, make
# the command look like this:
#
#     cd ..
#

backend() {

    composer install

    php artisan migrate --force

    # supervisorctl restart gtp-wws.demo.crmplease.me-websocket:gtp-wws.demo.crmplease.me-websocket_00

    # supervisorctl restart gtp-wws.demo.crmplease.me-queue:gtp-wws.demo.crmplease.me-queue_00

}

frontend() {

    npm install

    npm run production

}

cd ..

git pull origin master

backend &

frontend &

exit 0
