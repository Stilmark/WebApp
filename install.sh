#!/bin/bash

# Require decendencies
composer update

# Create .env file if not exists
cp -n .dist/.env .env