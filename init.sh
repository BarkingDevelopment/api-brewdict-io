#!/bin/sh
set -e
# Install composer dependencies
composer install

# Wait for DB to be up
php artisan passport:install

# Run upstream entrypoint
php-fpm -F -R
