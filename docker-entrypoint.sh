#!/bin/bash

set -e

# parts form https://github.com/wikimedia/mediawiki-docker/blob/2dea40647eb85d6e0fc607904e0779644cf869c9/dev/docker-entrypoint.sh
if [ -e "/var/www/html/composer.lock" -a -e "/var/www/html/composer.json" ]; then
	curl -sS https://getcomposer.org/installer | php
	php composer.phar install --no-dev
fi