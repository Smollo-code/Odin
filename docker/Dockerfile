FROM nginx:alpine as nginx

CMD ["nginx", "-g", "daemon off;"]

FROM php:8.2-fpm-alpine3.18 AS php-base

COPY ./docker/php/php-ini-overrides.ini  /usr/local/etc/php/conf.d/

ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

RUN chmod +x /usr/local/bin/install-php-extensions && \
        install-php-extensions gd xdebug gd intl redis pdo_mysql opcache pcntl bz2 bcmath zip yaml

CMD ["php-fpm"]