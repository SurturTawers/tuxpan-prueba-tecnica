FROM php:8.1-fpm

ADD . /var/www
WORKDIR /var/www

RUN apt-get update
# \
#   && apt-get install -y \
#    php8.1 \
#    php8.1-fpm \
#    php8.1-common \
#    php8.1-pdo \
#    php8.1-pdo_mysql \
#    php8.1-mysql \
#    php8.1-msqli \
#    php8.1-mcrypt \
#    php8.1-mbstring \
#    php8.1-xml \
#    php8.1-openssl \
#    php8.1-json \
#    php8.1-phar \
#    php8.1-zip \
#    php8.1-gd \
#    php8.1-dom \
#    php8.1-session \
#    php8.1-zlib \

RUN docker-php-ext-install mysqli pdo pdo_mysql
RUN docker-php-ext-enable mysqli pdo pdo_mysql

#ADD . /var/www
#RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
COPY --from=composer /usr/bin/composer /usr/bin/composer

RUN chown -R www-data:www-data /var/www/storage
RUN chown -R www-data:www-data /var/www/bootstrap/cache

USER www-data

EXPOSE 9000
CMD ["php-fpm"]
