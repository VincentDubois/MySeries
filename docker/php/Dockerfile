FROM php:8.1-apache
EXPOSE 80

ENV TZ="Europe/Paris"

RUN apt-get update && apt-get install -y mariadb-client wget sudo libzip-dev zip coreutils tar
RUN docker-php-ext-install pdo pdo_mysql mysqli zip && docker-php-ext-enable pdo_mysql mysqli

COPY conf/php.ini /usr/local/etc/php/conf.d/app.ini

COPY --from=composer /usr/bin/composer /usr/bin/composer
RUN composer self-update

CMD ["apache2-foreground"]