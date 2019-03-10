FROM composer:1.5.1 AS composer

FROM mediawiki:1.32
# System Dependencies.
RUN apt-get update && apt-get install -y \
		libzip-dev \
		zip \
		--no-install-recommends && rm -r /var/lib/apt/lists/* && \
		docker-php-ext-configure zip --with-libzip  && \
		docker-php-ext-install zip
COPY mediawiki /var/www/html
COPY --from=composer /usr/bin/composer /usr/bin/composer
ENV COMPOSER_ALLOW_SUPERUSER 1 
RUN ["composer","install","--no-dev"]