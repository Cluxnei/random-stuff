#!/bin/sh

cd /var/www || exit

cat .env

php artisan cache:clear
php artisan route:cache
php artisan optimize:clear

/usr/bin/supervisord -c /etc/supervisord.conf