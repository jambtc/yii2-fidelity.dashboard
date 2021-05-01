# Prepare environment
FROM php:7.2-apache
RUN a2enmod rewrite
RUN docker-php-ext-install pdo_mysql
RUN docker-php-ext-install bcmath
RUN apt-get update -y && apt-get install -y libpng-dev libgmp-dev
RUN docker-php-ext-install gd
RUN docker-php-ext-install gmp

# copy yii2 files
COPY assets /var/www/assets
COPY commands /var/www/commands
COPY components /var/www/components
COPY config /var/www/config
COPY controllers /var/www/controllers
COPY daemons /var/www/daemons
COPY mail /var/www/mail
COPY logs /var/www/logs
COPY messages /var/www/messages
COPY migrations /var/www/migrations
COPY models /var/www/models
COPY runtime /var/www/runtime
COPY views /var/www/views
COPY widgets /var/www/widgets
COPY vendor /var/www/vendor
COPY widgets /var/www/widgets


#this is the trick
COPY web /var/www/html
COPY requirements.php /var/www/html
COPY yii /var/www

RUN mv /var/www/config/db-docker.php /var/www/config/db.php
RUN chown -R www-data:www-data /var/www
