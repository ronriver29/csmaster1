cp -r /srv/site/. /var/www/html
# create folder structure
[ -d /var/www/shared-volume/amendment ] || mkdir /var/www/shared-volume/amendment
[ -d /var/www/shared-volume/qrcodes ] || mkdir /var/www/shared-volume/qrcodes
# set permission
chown -R www-data:www-data /var/www/shared-volume/amendment
chown -R www-data:www-data /var/www/shared-volume/qrcodes