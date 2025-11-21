#!/usr/bin/env sh
set -e

cd /var/www/html

php artisan config:clear || true
php artisan cache:clear || true

exec php-fpm
