#!/bin/bash

# Require decendencies
composer update

# Create dirs
mkdir -p ./cache

# Create .env file if not exists
cp -n .dist/.env .env

sudo mysql < /www/WebApp/.dist/sql/init.sql
sudo mysql < /www/WebApp/.dist/sql/test.users.sql