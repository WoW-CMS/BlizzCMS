FROM php:8.1-apache

ARG USER_ID=1000
ARG GROUP_ID=1000

RUN apt-get update && apt-get upgrade -y && apt-get install -y \
    cron \
    git \
    nano \
    unzip \
    zip 

COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/

RUN install-php-extensions \
    bcmath \
    gd \
    mysqli \
    soap \
    zip \
    gmp

COPY  --from=composer:latest /usr/bin/composer /usr/bin/composer

# Delete all default files inside /var/www/html
RUN rm -rf /var/www/html

# Fix permissions for www-data user and change owner to www-data
RUN mkdir -p /home/www-data && chown www-data:www-data /home/www-data \
    && usermod -o -u $USER_ID www-data -d /home/www-data \
    && groupmod -o -g $GROUP_ID www-data \
    && chown -R www-data:www-data /var/www/html

# Enable apache modules
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

USER www-data

# Copy source files
COPY --chown=www-data:www-data . /var/www/html

USER root
