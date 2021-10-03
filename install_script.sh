#!/bin/bash

# Install composer
composer update --optimize-autoloader

# Create Database
touch application/db.sqlite
vendor/doctrine/orm/bin/doctrine orm:schema-tool:create

# Recreate data
mkdir -p data/foto/
mkdir -p data/receipt/
mkdir -p data/sertifikat/

# Install
php install_script.php

# Delete unnecessary files
rm install_script.php
rm local_test.sh
rm seeder.php