sleep 10
touch .env
php artisan dusk > dusk.log
echo $? > dusk-status

kill `pidof mariadbd`
kill `pidof php-fpm`
kill `pidof nginx`
kill `pidof redis-server`
# Selenium
kill `pidof java`
# NcaLayer-mock
kill `pidof node`

sleep 120
