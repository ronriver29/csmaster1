FROM php:7-fpm

RUN docker-php-ext-install mysqli
RUN apt-get -y update \
&& apt-get install -y libicu-dev \
&& docker-php-ext-configure intl \
&& docker-php-ext-install intl



COPY ./.docker/date.ini /usr/local/etc/php/conf.d/date.ini
COPY ./.docker/php.ini /usr/local/etc/php/php.ini

COPY . /srv/site

WORKDIR /srv/site

RUN chmod a+rwx -R /srv/site/smarty.cache.dir