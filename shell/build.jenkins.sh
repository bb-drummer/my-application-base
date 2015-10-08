export COMPOSER_CACHE_DIR=/tmp/
php /usr/bin/composer.phar self-update
php /usr/bin/composer.phar install
chmod -R ugoa+rx ./files
./shell/files.components.sh
./shell/files.themes.sh