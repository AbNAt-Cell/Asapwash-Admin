# Production Migration Guide

## Problem
The production database is missing the `lat` and `lng` columns in the `owner_shops` table, causing shop creation to fail with error:
```
SQLSTATE[42S22]: Column not found: 1054 Unknown column 'lat' in 'INSERT INTO'
```

## Solution Options

### Option 1: Run Migration via SSH (Recommended)

If you have SSH access to the Hostinger server:

1. **Connect to server via SSH**
2. **Navigate to project directory**:
   ```bash
   cd /home/u890683004/domains/asapwash.cloud/public_html
   ```
3. **Run the migration**:
   ```bash
   php artisan migrate
   ```
   This will run all pending migrations including `2023_10_27_000001_add_location_to_owner_shops.php`

### Option 2: Use Standalone Migration Script (If no SSH access)

If you don't have SSH access, use the standalone script:

1. **Upload the file**:
   - Upload `add_location_columns.php` to: `/home/u890683004/domains/asapwash.cloud/public_html/`
   - You can use Hostinger's File Manager or FTP

2. **Run the script**:
   - Open your browser and visit: `https://asapwash.cloud/add_location_columns.php`
   - The script will add the `lat` and `lng` columns to the database

3. **Verify success**:
   - You should see a success message with column details
   - The script will show: ✓ lat: decimal(10,8) nullable
   - The script will show: ✓ lng: decimal(11,8) nullable

4. **Delete the script** (IMPORTANT for security):
   - After successful migration, delete `add_location_columns.php` from the server
   - This prevents unauthorized access to your database

### Option 3: Use Hostinger phpMyAdmin

If you prefer using phpMyAdmin:

1. **Login to Hostinger control panel**
2. **Open phpMyAdmin**
3. **Select your database**
4. **Run this SQL**:
   ```sql
   ALTER TABLE `owner_shops` 
   ADD COLUMN `lat` DECIMAL(10,8) NULL AFTER `service_type`,
   ADD COLUMN `lng` DECIMAL(11,8) NULL AFTER `lat`;
   ```

## Verification

After running the migration using any method:

1. **Test shop creation** in the Flutter app
2. **Expected result**: Shop should be created successfully without 500 error
3. **Check database**: Verify the new shop has lat/lng values if address was selected via autocomplete

## Files Created

- `add_location_columns.php` - Standalone migration script for production (delete after use)
