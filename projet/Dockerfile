FROM php:apache

# Installation des dépendances OCI8
RUN apt-get update && apt-get install -y \
    libaio1 \
    && pecl install oci8-2.2.0 \
    && docker-php-ext-enable oci8

# Copie du contenu de public dans le conteneur
COPY ./public_html /var/www/html
