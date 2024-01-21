FROM php:8.1-apache
EXPOSE 80

ENV TZ="Europe/Paris"

RUN docker-php-ext-install pdo pdo_mysql mysqli && docker-php-ext-enable pdo_mysql mysqli
RUN apt-get update && apt-get install -y mariadb-client sudo

COPY conf/php.ini /usr/local/etc/php/conf.d/app.ini

RUN service apache2 restart