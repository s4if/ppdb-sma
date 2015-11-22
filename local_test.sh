#!/bin/bash

# Drop Dulu
vendor/doctrine/orm/bin/doctrine orm:schema-tool:drop --force

# Create
vendor/doctrine/orm/bin/doctrine orm:schema-tool:create

# Hapus Foto Upload-an
rm -rv data/foto/*

# Seeding data
php seeder.php

# Pindah Ke Direktori Test
cd application/tests/

# Call PHPUNIT
../../vendor/phpunit/phpunit/phpunit

# Call Coverall
cd ../..
php vendor/bin/coveralls -v
