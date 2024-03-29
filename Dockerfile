FROM composer:1.9.3 AS composer
RUN apk add icu-dev
WORKDIR /composer
COPY /core /composer
COPY /mediawiki/extensions /composer/extensions
COPY /mediawiki/skins /composer/skins
COPY ./composer /composer
ENV COMPOSER_ALLOW_SUPERUSER 1 
RUN docker-php-ext-install pcntl
RUN docker-php-ext-install intl
RUN ["composer","install","--no-dev"]


FROM php:7.3-apache AS mediawiki-preq
# Follows https://github.com/wikimedia/mediawiki-docker/blob/dc240fc8771ce74bc2c420eb1283d718ebf1abe0/1.35/apache/Dockerfile
# System dependencies
RUN set -eux; \
	\
	apt-get update; \
	apt-get install -y --no-install-recommends \
		git \
		librsvg2-bin \
		imagemagick \
		# Required for SyntaxHighlighting
		python3 \
		# temporary woraround for T232866
		curl \
		gnupg \
		librsvg2-dev \
	; \
	rm -rf /var/lib/apt/lists/*

RUN curl -sL https://deb.nodesource.com/setup_12.x  | bash -
RUN apt-get -y install nodejs

# Install the PHP extensions we need
RUN set -eux; \
	\
	savedAptMark="$(apt-mark showmanual)"; \
	\
	apt-get update; \
	apt-get install -y --no-install-recommends \
		libicu-dev \
	; \
	\
	docker-php-ext-install -j "$(nproc)" \
		intl \
		mbstring \
		mysqli \
		opcache \
	; \
	\
	pecl install APCu-5.1.19; \
	docker-php-ext-enable \
		apcu \
	; \
	\
	# reset apt-mark's "manual" list so that "purge --auto-remove" will remove all build dependencies
	apt-mark auto '.*' > /dev/null; \
	apt-mark manual $savedAptMark; \
	ldd "$(php -r 'echo ini_get("extension_dir");')"/*.so \
		| awk '/=>/ { print $3 }' \
		| sort -u \
		| xargs -r dpkg-query -S \
		| cut -d: -f1 \
		| sort -u \
		| xargs -rt apt-mark manual; \
	\
	apt-get purge -y --auto-remove -o APT::AutoRemove::RecommendsImportant=false; \
	rm -rf /var/lib/apt/lists/*

# Enable Short URLs
RUN set -eux; \
	a2enmod rewrite; \
	{ \
		echo '<Directory /var/www/html>'; \
		echo '  RewriteEngine On'; \
		echo '  RewriteCond %{REQUEST_FILENAME} !-f'; \
		echo '  RewriteCond %{REQUEST_FILENAME} !-d'; \
		echo '  RewriteRule ^ %{DOCUMENT_ROOT}/index.php [L]'; \
		echo '</Directory>'; \
	} > "$APACHE_CONFDIR/conf-available/short-url.conf"; \
	a2enconf short-url

# Enable AllowEncodedSlashes for VisualEditor
RUN sed -i "s/<\/VirtualHost>/\tAllowEncodedSlashes NoDecode\n<\/VirtualHost>/" "$APACHE_CONFDIR/sites-available/000-default.conf"

# set recommended PHP.ini settings
# see https://secure.php.net/manual/en/opcache.installation.php
RUN { \
		echo 'opcache.memory_consumption=128'; \
		echo 'opcache.interned_strings_buffer=8'; \
		echo 'opcache.max_accelerated_files=4000'; \
		echo 'opcache.revalidate_freq=60'; \
		echo 'opcache.fast_shutdown=1'; \
	} > /usr/local/etc/php/conf.d/opcache-recommended.ini

# SQLite Directory Setup
RUN set -eux; \
	mkdir -p /var/www/data; \
	chown -R www-data:www-data /var/www/data


FROM mediawiki-preq AS mathoid
WORKDIR /srv/
RUN git clone "https://gerrit.wikimedia.org/r/mediawiki/services/mathoid"
WORKDIR /srv/mathoid
RUN rm package-lock.json
RUN npm i


FROM mediawiki-preq
 
COPY --from=mathoid /srv /srv
COPY /mediawiki /var/www/html
COPY --from=composer /composer /var/www/html
RUN chown -R www-data:www-data /var/www/html/images
# Fix for for T250504
RUN ln -s /var/www/html /var/www/html/w
COPY htaccess /var/www/html/.htaccess

ENTRYPOINT ["docker-php-entrypoint", "apache2-foreground"]
