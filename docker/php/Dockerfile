FROM php:7.2-fpm

RUN apt-get update \
    && apt-get install -y --no-install-recommends git zip unzip zlib1g-dev yarn gnupg \
    apt-transport-https apt-utils

RUN docker-php-ext-install pdo_mysql zip

RUN pecl install apcu-5.1.8
RUN docker-php-ext-enable apcu

RUN useradd -mr -u 1001 -g sudo ouimiam

# Install Composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php -r "if (hash_file('sha384', 'composer-setup.php') === '48e3236262b34d30969dca3c37281b3b4bbe3221bda826ac6a9a62d6444cdb0dcd0615698a5cbe587c3f0fe57a54d8f5') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
RUN php composer-setup.php
RUN php -r "unlink('composer-setup.php');"
RUN mv composer.phar /usr/local/bin/composer

USER ouimiam

WORKDIR /usr/src/app

COPY apps/ouimiam /usr/src/app

RUN PATH=$PATH:/usr/src/apps/vendor/bin:bin