timedatectl set-timezone Asia/Tokyo
cp -fr /var/www/html/docker/os/storage /var/www/html;
chown www-data:www-data -R /var/www/html
php /var/www/html/docker/composer.phar install
