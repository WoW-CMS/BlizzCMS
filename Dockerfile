FROM romeoz/docker-apache-php:7.3

RUN a2enmod headers && a2enmod rewrite && a2enmod expires

RUN apt-get update \
    && apt-get install -y openssl php-curl php-gd php-mbstring php-mysql php-soap php-gmp \
    && rm -rf /var/lib/apt/lists/* 

WORKDIR /var/www/app/

EXPOSE 80 443

CMD ["/sbin/entrypoint.sh"]