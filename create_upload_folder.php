<?php
/**
 * Script to create upload folder in public directory
 * Run this script once to set up the upload directory
 */

$uploadPath = __DIR__ . '/public/upload';

// Create upload directory if it doesn't exist
if (!file_exists($uploadPath)) {
    if (mkdir($uploadPath, 0755, true)) {
        echo "✓ Upload folder created successfully at: {$uploadPath}\n";
    } else {
        echo "✗ Failed to create upload folder\n";
        exit(1);
    }
} else {
    echo "✓ Upload folder already exists at: {$uploadPath}\n";
}

// Set proper permissions
if (chmod($uploadPath, 0755)) {
    echo "✓ Permissions set to 0755\n";
} else {
    echo "⚠ Warning: Could not set permissions\n";
}

// Create .htaccess for security (prevent PHP execution in upload folder)
$htaccessContent = <<<'HTACCESS'
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
HTACCESS;

$htaccessPath = $uploadPath . '/.htaccess';
if (file_put_contents($htaccessPath, $htaccessContent)) {
    echo "✓ Security .htaccess created\n";
} else {
    echo "⚠ Warning: Could not create .htaccess\n";
}

// Create a test file to verify write permissions
$testFile = $uploadPath . '/test_' . time() . '.txt';
if (file_put_contents($testFile, 'Upload folder is working!')) {
    echo "✓ Write permissions verified\n";
    unlink($testFile); // Clean up test file
} else {
    echo "✗ Warning: Upload folder is not writable\n";
}

echo "\n";
echo "========================================\n";
echo "Upload folder setup complete!\n";
echo "========================================\n";
echo "Path: {$uploadPath}\n";
echo "URL: " . (isset($_SERVER['HTTP_HOST']) ? "https://{$_SERVER['HTTP_HOST']}/upload/" : "https://yourdomain.com/upload/") . "\n";
echo "\nYou can now upload files to this directory.\n";
