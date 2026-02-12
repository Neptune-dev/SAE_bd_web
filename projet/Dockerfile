FROM php:8.1-apache

RUN apt-get update && \
    apt-get install -y libaio1 unzip && \
    pecl install oci8 && \
    docker-php-ext-enable oci8

# Copie du contenu de public dans le conteneur
COPY ./public_html /var/www/html
