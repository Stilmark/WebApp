#!/bin/bash

# Require decendencies
composer update

# Create dirs
mkdir -p ./cache

# Create .env file if not exists
cp -n .dist/.env .env