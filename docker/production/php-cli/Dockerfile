FROM registry.gitlab.com/kazinsys-dev/docker/laravel/php-cli-8.2

USER root

RUN apt-get update && \
    apt-get install -y ffmpeg

COPY ./docker/production/php-cli/conf/php.ini /usr/local/etc/php/php.ini

USER www-data

COPY --chown=www-data:www-data . /code

USER root
RUN chown -R www-data:www-data /code
USER www-data
