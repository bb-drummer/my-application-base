#!/bin/bash

# php info
apt-get update -yqq
apt-get install -yqq php5-mysql
php -v
php -m

# Install git (the php image doesn't have it) which is required by composer
# Install mysql driver
apt-get update -y
apt-get install -y git

# Install composer
curl -sS https://getcomposer.org/installer | php
php composer.phar --version

# Install phpunit, the tool that we will use for testing
apt-get install -y phpunit
curl -o ./phpunit.phar https://phar.phpunit.de/phpunit.phar
chmod +x ./phpunit.phar
