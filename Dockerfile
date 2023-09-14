FROM php:8.1-fpm-alpine as base

RUN apk --update add mysql-client curl git libxml2-dev libzip-dev zip \
    && docker-php-ext-install pdo_mysql zip xml opcache bcmath
RUN apk add --no-cache pcre-dev $PHPIZE_DEPS && pecl install redis && docker-php-ext-enable redis

ENV COMPOSER_HOME ./.composer
COPY --from=composer:2.1 /usr/bin/composer /usr/bin/composer

FROM base AS deps

COPY composer.json /var/www/html/composer.json
COPY composer.lock /var/www/html/composer.lock

RUN composer install --no-dev --no-scripts

FROM node:18 as frontend

WORKDIR /usr/app
COPY ./ /usr/app

RUN npm install && \
    npm run build:all

FROM base AS prod

COPY --chown=www-data:www-data . /var/www/html
COPY --chown=www-data:www-data --from=deps /var/www/html/vendor /var/www/html/vendor
COPY --from=frontend /usr/app/public /var/www/html/public


ADD opcache.ini "$PHP_INI_DIR/conf.d/opcache.ini"

RUN sed -i "s|;*memory_limit =.*|memory_limit = 2048M|i" /usr/local/etc/php/php.ini-development && \
    sed -i "s|;*cgi.fix_pathinfo=.*|cgi.fix_pathinfo= 0|i" /usr/local/etc/php/php.ini-development
RUN sed -i "s|;*memory_limit =.*|memory_limit = 2048M|i" /usr/local/etc/php/php.ini-production && \
    sed -i "s|;*cgi.fix_pathinfo=.*|cgi.fix_pathinfo= 0|i" /usr/local/etc/php/php.ini-production

COPY docker/www.conf /usr/local/etc/php-fpm.d/www.conf

RUN composer dump-autoload --optimize


FROM nginx as nginx

WORKDIR /var/www/html

COPY docker/nginx.conf /etc/nginx/nginx.conf

COPY --from=frontend /usr/app/public /var/www/html/public
