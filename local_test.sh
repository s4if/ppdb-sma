#!/bin/bash

# Drop Dulu
vendor/doctrine/orm/bin/doctrine orm:schema-tool:drop --force

# Create
vendor/doctrine/orm/bin/doctrine orm:schema-tool:create

# Pindah Ke Direktori Test
cd application/tests/

# Call PHPUNIT
../../vendor/phpunit/phpunit/phpunit
