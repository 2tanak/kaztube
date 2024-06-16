FROM registry.gitlab.com/kazinsys-dev/docker/laravel/fpm-8.2

USER root

RUN apt-get update && \
    apt-get install -y ffmpeg

COPY ./docker/production/fpm/conf/php.ini /usr/local/etc/php/php.ini

RUN chown -R www-data:www-data /code

USER www-data

COPY --chown=www-data:www-data . /code
