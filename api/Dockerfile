FROM php:7.1-fpm

RUN apt-get update && \
    apt-get install -y --no-install-recommends \
        curl \
        git \
        libz-dev \
        libpq-dev \
        libjpeg-dev \
        libpng12-dev \
        libfreetype6-dev \
        libssl-dev \
        libmcrypt-dev

RUN docker-php-ext-install \
    mbstring \
    zip \
    opcache \
    pdo pdo_pgsql

RUN pecl install xdebug && \
    docker-php-ext-enable xdebug && \
    pecl install redis && \
    docker-php-ext-enable redis


COPY ./etc/php-fpm/app-php.ini /usr/local/etc/php/conf.d/app-php.ini

RUN usermod -u 1000 www-data

WORKDIR /app

CMD ["php-fpm"]

EXPOSE 9000