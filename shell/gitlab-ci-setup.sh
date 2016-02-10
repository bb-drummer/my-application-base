#!/bin/bash

# We need to install dependencies only for Docker
[[ ! -e /.dockerinit ]] && exit 0

set -xe

docker info

# Install git (the php image doesn't have it) which is required by composer
apt-get update -yqq
apt-get install git -yqq

# Install phpunit, the tool that we will use for testing
curl -o /usr/local/bin/phpunit https://phar.phpunit.de/phpunit.phar
chmod +x /usr/local/bin/phpunit

# Install mysql driver
# Here you can install any other extension that you need
apt-get update -y
apt-get install -y php5-mysql


# Install composer
- curl -sS https://getcomposer.org/installer | php
# Install all project dependencies
- php composer.phar install