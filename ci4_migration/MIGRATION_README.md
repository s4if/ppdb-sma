# CodeIgniter 3 to CodeIgniter 4 Migration

This document outlines the migration process from CodeIgniter 3 to CodeIgniter 4 for the PPDB (Penerimaan Peserta Didik Baru) application.

## Overview

The migration includes:
1. Database configuration update
2. Creation of database migration files
3. Conversion of Doctrine entities to CI4 entities
4. Implementation of CI4 models
5. Testing of data operations

## Migration Steps

### 1. Database Configuration

The database configuration has been updated to use SQLite with CI4:

- File: `app/Config/Database.php`
- Changed from MySQLi to SQLite3
- Database path: `WRITEPATH . 'db/ppdb.sqlite'`

### 2. Database Migration Files

Migration files have been created for all database tables:

- `CreateRegistrantsTable.php` - Main registrants table
- `CreateParentsTable.php` - Parent/guardian information
- `CreateRegistrantDataTable.php` - Detailed registrant data
- `CreatePaymentDataTable.php` - Payment information
- `CreateRaporTable.php` - Report card values
- `CreateCertificatesTable.php` - Certificate information
- `CreateAdminsTable.php` - Administrator accounts
- `CreateCounterTable.php` - Registration counters

To run the migrations:
```bash
php spark migrate
```

### 3. Entity Conversion

Doctrine entities have been converted to CI4 entities:

- `RegistrantEntity.php` - Main registrant entity
- `ParentEntity.php` - Parent/guardian entity
- `RegistrantDataEntity.php` - Detailed registrant data entity
- `PaymentEntity.php` - Payment entity
- `AdminEntity.php` - Admin entity
- `RaporEntity.php` - Report card entity
- `CertificateEntity.php` - Certificate entity
- `CounterEntity.php` - Counter entity

### 4. Model Implementation

CI4 models have been implemented to replace the old CI3 models:

- `RegistrantModel.php` - Main registrant model
- `ParentModel.php` - Parent/guardian model
- `RegistrantDataModel.php` - Detailed registrant data model
- `PaymentModel.php` - Payment model
- `AdminModel.php` - Admin model
- `RaporModel.php` - Report card model
- `CertificateModel.php` - Certificate model
- `CounterModel.php` - Counter model

### 5. Testing

A test controller has been created to verify the migration:

- `TestMigration.php` - Test controller
- `test_migration.php` - Test results view

To run the tests:
1. Access the test controller at `http://your-domain/testmigration`
2. Review the test results

## Key Differences Between CI3 and CI4

### Database Configuration

- CI3: Configuration in `application/config/database.php`
- CI4: Configuration in `app/Config/Database.php`

### Entities

- CI3: Used Doctrine ORM with annotations
- CI4: Uses plain PHP classes with getters and setters

### Models

- CI3: Extended `CI_Model` with custom methods
- CI4: Extended `CodeIgniter\Model` with built-in CRUD operations

### File Structure

- CI3: `application/` directory
- CI4: `app/` directory with more organized structure

## Data Migration

Existing data from the SQLite database should be compatible with the new structure.

## Next Steps

1. Run the migrations to create the database tables
2. Test the data operations using the TestMigration controller
3. Update your controllers to use the new models
4. Update your views to work with the new entity structure
5. Test your application thoroughly

## Troubleshooting

### Database Issues

- Ensure the `writable/db` directory exists and is writable
- Check the database configuration in `app/Config/Database.php`

### Model Issues

- Verify that all entity properties match the database columns
- Check that model relationships are properly defined

### Testing Issues

- Make sure all models are properly loaded in the test controller
- Check that the test data is valid and complete

## Conclusion

This migration provides a solid foundation for upgrading your PPDB application from CodeIgniter 3 to CodeIgniter 4. The new structure follows CI4 best practices and should be more maintainable and scalable.