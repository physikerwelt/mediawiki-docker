FROM mediawiki:1.33 AS base

FROM composer:1.5.1 AS composer
WORKDIR /composer
COPY --from=base /var/www/html /composer
COPY ./composer /composer
ENV COMPOSER_ALLOW_SUPERUSER 1 
RUN ["composer","install","--no-dev"]
RUN ["composer","install","--no-dev"]
RUN ["composer","update","--no-dev"]


FROM mediawiki:1.33
COPY --from=composer /composer /var/www/html
COPY /mediawiki /var/www/html
RUN chown -R www-data:www-data /var/www/html/images
