FROM php:7-fpm

RUN docker-php-ext-install mysqli
RUN apt-get -y update \
&& apt-get install -y libicu-dev \
&& docker-php-ext-configure intl \
&& docker-php-ext-install intl  \
&& docker-php-ext-install sockets



RUN apt-get install -y libwebp-dev libjpeg62-turbo-dev libpng-dev libxpm-dev \
    libfreetype6-dev

RUN docker-php-ext-configure gd \
            --prefix=/usr \
            --with-jpeg \
            --with-freetype; \
    docker-php-ext-install gd;


COPY ./.docker/date.ini /usr/local/etc/php/conf.d/date.ini
COPY ./.docker/php.ini /usr/local/etc/php/php.ini

COPY . /srv/site

WORKDIR /srv/site


