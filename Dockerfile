FROM php:7-fpm

RUN docker-php-ext-install mysqli
RUN pecl install memcached \
    && docker-php-ext-enable memcached

RUN docker-php-ext-install  mbstring \
	&& docker-php-ext-enable mbstring


COPY ./.docker/date.ini /usr/local/etc/php/conf.d/date.ini
COPY ./.docker/php.ini /usr/local/etc/php/php.ini

COPY . /srv/site

WORKDIR /srv/site