#!/bin/bash

# Drop Dulu
vendor/doctrine/orm/bin/doctrine orm:schema-tool:drop --force
rm application/db.sqlite
touch application/db.sqlite

# Create
vendor/doctrine/orm/bin/doctrine orm:schema-tool:create

# Recreate data
rm -fRv data/foto/
rm -fRv data/receipt/
rm -fRv data/sertifikat/
mkdir -p data/foto/
mkdir -p data/receipt/
mkdir -p data/sertifikat/
cp application/tests/assets/foto.png data/foto/1.png
cp application/tests/assets/foto.png data/receipt/1.png

# Seeding data
php seeder.php

# Pindah Ke Direktori Test
cd application/tests/

# Call PHPUNIT
XDEBUG_MODE=off ../../vendor/phpunit/phpunit/phpunit --verbose

# Back to ppdb
cd ../..
# php vendor/bin/coveralls -v
