#!/bin/bash

# Require decendencies
composer update

# Create .env file if not exists
cp -n .env-sample .env