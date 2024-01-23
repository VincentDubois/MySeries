FROM php:8.1-apache
EXPOSE 80

ENV TZ="Europe/Paris"

RUN docker-php-ext-install pdo pdo_mysql mysqli && docker-php-ext-enable pdo_mysql mysqli
RUN apt-get update && apt-get install -y mariadb-client wget sudo

COPY conf/php.ini /usr/local/etc/php/conf.d/app.ini


COPY --from=composer /usr/bin/composer /usr/bin/composer
RUN composer self-update

#RUN cp -n application/config/database.php.example application/config/database.php

#RUN service apache2 restart

CMD ["apache2-foreground"]