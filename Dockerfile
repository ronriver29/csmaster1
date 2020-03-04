FROM php:7-fpm

#RUN apt-get update && \
#            apt-get install -y libfreetype6-dev libjpeg62-turbo-dev libpng-dev libmcrypt-dev && \
#            docker-php-ext-install mbstring && \
#            docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/  &&  \
#            docker-php-ext-install gd mysql mysqli pdo pdo_mysql zip mcrypt

COPY ./.docker/date.ini /usr/local/etc/php/conf.d/date.ini
COPY ./.docker/php.ini /usr/local/etc/php/php.ini

COPY . /srv/site

WORKDIR /srv/site