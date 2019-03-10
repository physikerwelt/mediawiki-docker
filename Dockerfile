FROM mediawiki:1.32 AS base

FROM composer:1.5.1 AS composer
WORKDIR /composer
COPY --from=base /var/www/html /composer
COPY ./composer /composer
ENV COMPOSER_ALLOW_SUPERUSER 1 
RUN ["composer","install","--no-dev"]

FROM mediawiki:1.32
COPY --from=composer /composer /var/www/html
COPY /mediawiki /var/www/html
