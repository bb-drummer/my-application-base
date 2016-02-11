#!/bin/bash

#PATH='$PATH:/usr/local/bin'

#echo 'current paths: $PATH'

# We need to install dependencies only for Docker
#[[ ! -e /.dockerinit ]] && exit 0

#set -xe

#docker info

# Install git (the php image doesn't have it) which is required by composer
apt-get update -yqq
apt-get install git -yqq

# Install phpunit, the tool that we will use for testing
curl -o phpunit.phar https://phar.phpunit.de/phpunit.phar
chmod +x phpunit.phar

# Install mysql driver
# Here you can install any other extension that you need
apt-get update -yqq
apt-get install -yqq phpunit php5-mysql

php -v
php composer.phar --version
php phpunit.phar --version

# Install composer
curl -sS https://getcomposer.org/installer | php
# Install all project dependencies
php -d memory_limit=-1 composer.phar install
#php -d memory_limit=-1 composer.phar update

