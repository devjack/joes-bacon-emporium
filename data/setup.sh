#!/bin/bash
apt-get install -y debconf-utils git

debconf-set-selections <<< 'mysql-server mysql-server/root_password password phunconf'
debconf-set-selections <<< 'mysql-server mysql-server/root_password_again password phunconf'
apt-get install -y  apache2 mysql-server libapache2-mod-php5 php5 php5-mysql

cd /var/www/html
rm -rf ./*
git clone https://github.com/sydnerdrage/joes-bacon-emporium.git .
chown www-data:www-data . -R
cat data/scaffold.sql | mysql -u root -pphunconf
sed -i 's/__HOST__/localhost/g' data/apache.conf
sed -i 's/__USER__/root/g' data/apache.conf
sed -i 's/__PASS__/phunconf/g' data/apache.conf
sed -i 's/__DB__/bacon/g' data/apache.conf
a2dissite 000-default
cp data/apache.conf /etc/apache2/sites-available/001-bacon.conf
a2ensite 001-bacon

service apache2 restart

