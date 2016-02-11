#!/bin/bash

#PATH='$PATH:/usr/local/bin'

#echo 'current paths: $PATH'

# We need to install dependencies only for Docker
#[[ ! -e /.dockerinit ]] && exit 0

#set -xe
ls -la

# php info
apt-get update -yqq
apt-get install -yqq php5-mysql
php -v
php -m

# Install git (the php image doesn't have it) which is required by composer
# Install mysql driver
apt-get update -yqq
apt-get install -yqq git
# Install composer
curl -sS https://getcomposer.org/installer | php
php composer.phar --version
# Install all project dependencies
#php -d memory_limit=-1 composer.phar install
#php -d memory_limit=-1 composer.phar update

# Install phpunit, the tool that we will use for testing
apt-get install -yqq phpunit
curl -o ./phpunit.phar https://phar.phpunit.de/phpunit.phar
chmod +x ./phpunit.phar


