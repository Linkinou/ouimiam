FROM php:7.2-fpm

RUN apt-get update \
    && apt-get install -y --no-install-recommends git zip unzip zlib1g-dev yarn gnupg \
    apt-transport-https apt-utils

RUN docker-php-ext-install pdo_mysql zip

RUN pecl install apcu-5.1.8
RUN docker-php-ext-enable apcu

RUN useradd -r -u 1001 -g sudo ouimiam
USER ouimiam

WORKDIR /usr/src/app

COPY apps/ouimiam /usr/src/app

RUN PATH=$PATH:/usr/src/apps/vendor/bin:bin