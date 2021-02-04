#!/bin/bash

#On error no such file entrypoint.sh, execute in terminal - dos2unix .docker\entrypoint.sh
composer install
php artisan cache:clear
chmod -R 775 storage
chmod -R 775 bootstrap
chmod -R 777 vendor
php artisan migrate
php artisan key:generate --force
php artisan passport:install
php artisan migrate:fresh --seed
php artisan storage:link
php-fpm
