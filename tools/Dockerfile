FROM php:8.4-fpm

ARG COMPOSER_TOKEN

RUN apt-get update -y
RUN apt-get install nano vim git zip libicu-dev -y
RUN apt-get upgrade -y

#RUN docker-php-ext-configure intl
#RUN docker-php-ext-install intl

RUN mkdir -p src temp log

RUN chown -R www-data:www-data /var/www
RUN chmod -R 0777 .

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

WORKDIR /var/www/html

ADD . /var/www/html

USER www-data

RUN composer install

CMD ["php-fpm"]