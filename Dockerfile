FROM php:8.2-apache

RUN apt-get update \
    && apt-get install -y --no-install-recommends default-jre-headless graphviz \
    && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pdo pdo_mysql mysqli \
    && a2enmod rewrite

WORKDIR /var/www/html
