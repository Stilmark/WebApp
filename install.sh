#!/bin/bash

# Require decendencies
composer update

# Create dirs
mkdir -p ./cache

# Create .env file if not exists
cp -n .dist/.env .env

sudo mysql < /www/WebApp/.dist/sql/init.sql
sudo mysql < /www/WebApp/.dist/sql/test.users.sql

sudo cp -n /www/WebApp/.dist/web.app.conf /etc/apache2/sites-available/
sudo ln -fs ../sites-available/web.app.conf web.app.conf

sudo ufw allow "Apache Full"
sudo ufw allow OpenSSH

sudo service apache2 reload
sudo service apache2 restart

