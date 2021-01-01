#!/bin/bash

# Require decendencies
composer require stilmark/database
composer require nikic/fast-route

# Create .env file if not exists
cp -n .env-sample .env