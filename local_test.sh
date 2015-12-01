#!/bin/bash

# Drop Dulu
vendor/doctrine/orm/bin/doctrine orm:schema-tool:drop --force

# Create
vendor/doctrine/orm/bin/doctrine orm:schema-tool:create

# Hapus Foto Upload-an
rm -fRv data/foto/*
rm -fRv data/receipt/*

# Seeding data
php seeder.php

# Pindah Ke Direktori Test
cd application/tests/

# Call PHPUNIT
../../vendor/phpunit/phpunit/phpunit --coverage-text --verbose

# Back to ppdb
cd ../..
