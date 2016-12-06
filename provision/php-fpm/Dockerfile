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
    docker-php-ext-enable xdebug

COPY ./app-php.ini /usr/local/etc/php/conf.d/app-php.ini

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php -r "if (hash_file('SHA384', 'composer-setup.php') === 'aa96f26c2b67226a324c27919f1eb05f21c248b987e6195cad9690d5c1ff713d53020a02ac8c217dbf90a7eacc9d141d') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
RUN php composer-setup.php; rm composer-setup.php;
RUN chmod +x composer.phar; mv composer.phar /usr/local/bin/composer

RUN usermod -u 1000 www-data

WORKDIR /app

CMD ["php-fpm"]

EXPOSE 9000