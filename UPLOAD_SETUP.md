# Upload Folder Setup Instructions

## Overview
Your application is configured to save all uploads directly to `public/upload/` without using Laravel's storage symlink system.

## Local Setup

Run the setup script:
```bash
php create_upload_folder.php
```

This will:
- Create the `public/upload` directory
- Set proper permissions (0755)
- Add security `.htaccess` to prevent PHP execution
- Verify write permissions

## Production Server Setup (cPanel/FTP)

### Option 1: Via cPanel File Manager
1. Navigate to `public_html/` directory
2. Click "New Folder" button
3. Create folder named `upload`
4. Right-click the `upload` folder → Permissions
5. Set permissions to `755` (rwxr-xr-x)
6. Upload the `.htaccess` file from `public/upload/.htaccess` to `public_html/upload/.htaccess`

### Option 2: Via FTP
1. Connect to your server via FTP
2. Navigate to `public_html/` directory
3. Create new folder named `upload`
4. Set folder permissions to `755`
5. Upload the `.htaccess` file to the upload folder

### Option 3: Via SSH
```bash
cd /path/to/public_html
mkdir upload
chmod 755 upload
# Copy .htaccess for security
cat > upload/.htaccess << 'EOF'
# Prevent PHP execution in upload folder
<FilesMatch "\.php$">
    Order Allow,Deny
    Deny from all
</FilesMatch>

# Allow image files
<FilesMatch "\.(jpg|jpeg|png|gif|webp|svg)$">
    Order Allow,Deny
    Allow from all
</FilesMatch>
EOF
```

## Verification

After setup, verify the folder is accessible:
- Visit: `https://yourdomain.com/upload/`
- You should see either a directory listing or a 403 Forbidden (both are fine)

## Current Upload Configuration

Your application uses these methods in `AppHelper.php`:

- **`saveImage()`** - Saves uploaded files to `public/upload/`
- **`saveBase64()`** - Saves base64 images to `public/upload/`
- **`deleteFile()`** - Deletes files from `upload/`

All files are saved with unique IDs to prevent conflicts.

## Security Notes

✅ The `.htaccess` file prevents PHP execution in the upload folder
✅ Files are saved with random names (using `uniqid()`)
✅ Folder permissions are set to 755 (readable by web server, writable by owner)

## No Symlink Required

Unlike standard Laravel applications, this setup does NOT require:
- `php artisan storage:link`
- Symlink from `public/storage` to `storage/app/public`

Everything is stored directly in `public/upload/` for simplicity.
