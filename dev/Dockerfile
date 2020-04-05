FROM physikerwelt/mediawiki
RUN apt-get update && \
    apt-get install -y --no-install-recommends git zip
RUN docker-php-ext-install zip
COPY --from=composer:1.9.1 /usr/bin/composer /usr/local/bin/composer
RUN ["composer","install"]
RUN pecl install xdebug-2.6.0
RUN docker-php-ext-enable xdebug
RUN echo "xdebug.remote_enable=1" >> /usr/local/etc/php/php.ini
ENTRYPOINT ["docker-php-entrypoint", "apache2-foreground"]
