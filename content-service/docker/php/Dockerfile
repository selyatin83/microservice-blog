FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
        git \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libmcrypt-dev \
        libicu-dev \
        libxml2-dev \
        libzip-dev \
        libonig-dev \
        unzip \
        libpq-dev \
        procps  \
        --no-install-recommends

RUN docker-php-ext-install pdo_pgsql sockets
RUN docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/ \
    && docker-php-ext-configure zip \
    && docker-php-ext-install intl mbstring exif gd pcntl bcmath zip

COPY ./php.ini /usr/local/etc/php/
COPY ./www.conf /usr/local/etc/php/

RUN apt-get purge -y g++ \
    && apt-get autoremove -y \
    && rm -r /var/lib/apt/lists/* \
    && rm -rf /tmp/*

RUN usermod -u 1000 www-data

RUN curl https://getcomposer.org/composer.phar > /usr/local/bin/composer && chmod a+x /usr/local/bin/composer

EXPOSE 9000
WORKDIR "/app"
CMD ["php-fpm"]
