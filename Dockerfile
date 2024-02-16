FROM php:8.1-fpm

ADD . /var/www
WORKDIR /var/www

RUN apt-get update

RUN docker-php-ext-install mysqli pdo pdo_mysql
RUN docker-php-ext-enable mysqli pdo pdo_mysql

COPY --from=composer /usr/bin/composer /usr/bin/composer

RUN chown -R www-data:www-data /var/www/storage
RUN chown -R www-data:www-data /var/www/bootstrap/cache

USER www-data

EXPOSE 9000
CMD ["php-fpm"]
