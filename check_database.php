<?php
/**
 * Database Column Checker for Production
 * This script checks the current structure of the owner_shops table
 * 
 * INSTRUCTIONS:
 * 1. Upload this file to: /home/u890683004/domains/asapwash.cloud/public_html/
 * 2. Access it via browser: https://asapwash.cloud/check_database.php
 * 3. Delete this file after checking for security
 */

// Load Laravel bootstrap
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

try {
    echo "<h2>Database Structure Check - owner_shops Table</h2>";
    echo "<pre>";

    // Check if table exists
    if (!Schema::hasTable('owner_shops')) {
        echo "❌ ERROR: Table 'owner_shops' does not exist!\n";
        exit;
    }

    echo "✓ Table 'owner_shops' exists\n\n";

    // Get all columns
    echo "=== ALL COLUMNS IN owner_shops ===\n";
    $columns = DB::select("SHOW COLUMNS FROM owner_shops");

    $hasLat = false;
    $hasLng = false;

    foreach ($columns as $column) {
        $nullable = $column->Null === 'YES' ? 'NULL' : 'NOT NULL';
        $default = $column->Default !== null ? "DEFAULT '{$column->Default}'" : '';
        echo sprintf(
            "%-20s %-20s %-10s %s\n",
            $column->Field,
            $column->Type,
            $nullable,
            $default
        );

        if ($column->Field === 'lat')
            $hasLat = true;
        if ($column->Field === 'lng')
            $hasLng = true;
    }

    echo "\n=== LOCATION COLUMNS STATUS ===\n";
    if ($hasLat) {
        echo "✓ Column 'lat' EXISTS\n";
    } else {
        echo "❌ Column 'lat' MISSING\n";
    }

    if ($hasLng) {
        echo "✓ Column 'lng' EXISTS\n";
    } else {
        echo "❌ Column 'lng' MISSING\n";
    }

    // Check migrations table
    echo "\n=== MIGRATION STATUS ===\n";
    if (Schema::hasTable('migrations')) {
        $migration = DB::table('migrations')
            ->where('migration', 'like', '%add_location_to_owner_shops%')
            ->first();

        if ($migration) {
            echo "✓ Migration 'add_location_to_owner_shops' has been run\n";
            echo "  Batch: {$migration->batch}\n";
            echo "  Run at: {$migration->migration}\n";
        } else {
            echo "❌ Migration 'add_location_to_owner_shops' has NOT been run\n";
        }
    }

    // Count existing shops
    echo "\n=== EXISTING DATA ===\n";
    $shopCount = DB::table('owner_shops')->count();
    echo "Total shops in database: {$shopCount}\n";

    if ($shopCount > 0 && $hasLat && $hasLng) {
        $shopsWithLocation = DB::table('owner_shops')
            ->whereNotNull('lat')
            ->whereNotNull('lng')
            ->count();
        echo "Shops with location data: {$shopsWithLocation}\n";
        echo "Shops without location: " . ($shopCount - $shopsWithLocation) . "\n";
    }

    echo "\n=== RECOMMENDATION ===\n";
    if (!$hasLat || !$hasLng) {
        echo "⚠️  You need to add the missing columns!\n";
        echo "Run one of these methods:\n";
        echo "1. SSH: php artisan migrate\n";
        echo "2. Upload and run: add_location_columns.php\n";
        echo "3. Run SQL in phpMyAdmin:\n";
        echo "   ALTER TABLE `owner_shops` \n";
        echo "   ADD COLUMN `lat` DECIMAL(10,8) NULL,\n";
        echo "   ADD COLUMN `lng` DECIMAL(11,8) NULL;\n";
    } else {
        echo "✅ Database structure is correct!\n";
        echo "The lat and lng columns exist.\n";
        echo "If you're still getting errors, check:\n";
        echo "- Cache: php artisan config:clear\n";
        echo "- Cache: php artisan cache:clear\n";
    }

    echo "\n⚠️  IMPORTANT: Delete this file (check_database.php) for security!\n";
    echo "</pre>";

} catch (Exception $e) {
    echo "<h2 style='color: red;'>Error occurred:</h2>";
    echo "<pre style='color: red;'>";
    echo "Error: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . "\n";
    echo "Line: " . $e->getLine() . "\n";
    echo "</pre>";
}
