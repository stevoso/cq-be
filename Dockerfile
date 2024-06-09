FROM php:8.1-apache

RUN a2enmod rewrite

RUN apt-get update && apt-get install -y git unzip zip

WORKDIR /var/www/html

RUN apt-get install -y libzip-dev libcurl4-gnutls-dev zip libpng-dev libicu-dev libxml2-dev libonig-dev libsodium-dev pkg-config
RUN apt-get install -y libffi-dev
#RUN apt-get libssh2-1-dev libssh2-1
#RUN apt-get install -y libssl-dev openssl libssl1.1
#RUN pecl install ssh2-1.3.1 && docker-php-ext-enable ssh2

RUN docker-php-ext-install bcmath calendar curl dom gd exif ffi intl mbstring mysqli
RUN docker-php-ext-install opcache pdo pdo_mysql session simplexml soap sockets sodium xml zip

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
