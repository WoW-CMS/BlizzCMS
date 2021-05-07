FROM romeoz/docker-apache-php:7.3

RUN a2enmod headers && a2enmod rewrite && a2enmod expires

RUN apt-get update \
    && apt-get install -y openssl php7.3-curl php7.3-gd php7.3-mbstring php7.3-mysql php7.3-soap php7.3-gmp \
    && rm -rf /var/lib/apt/lists/* 

WORKDIR /var/www/app/

EXPOSE 80 443

CMD ["/sbin/entrypoint.sh"]
