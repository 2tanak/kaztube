FROM registry.gitlab.com/kazinsys-dev/docker/laravel/nginx

COPY ./docker/production/nginx/conf/nginx.conf /etc/nginx/nginx.conf

COPY --chown=www-data:www-data ./public /code/public
