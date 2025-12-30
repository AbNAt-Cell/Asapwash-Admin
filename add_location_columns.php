<?php
/**
 * Standalone Migration Script for Production
 * This script adds lat and lng columns to the owner_shops table
 * 
 * INSTRUCTIONS:
 * 1. Upload this file to: /home/u890683004/domains/asapwash.cloud/public_html/
 * 2. Access it via browser: https://asapwash.cloud/add_location_columns.php
 * 3. Delete this file after successful migration for security
 */

// Load Laravel bootstrap
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;

try {
    echo "<h2>Adding lat and lng columns to owner_shops table</h2>";
    echo "<pre>";

    // Check if columns already exist
    $hasLat = Schema::hasColumn('owner_shops', 'lat');
    $hasLng = Schema::hasColumn('owner_shops', 'lng');

    if ($hasLat && $hasLng) {
        echo "✓ Columns 'lat' and 'lng' already exist in owner_shops table.\n";
        echo "No migration needed.\n";
    } else {
        echo "Adding columns to owner_shops table...\n";

        Schema::table('owner_shops', function (Blueprint $table) use ($hasLat, $hasLng) {
            if (!$hasLat) {
                $table->decimal('lat', 10, 8)->nullable();
                echo "✓ Added 'lat' column\n";
            }
            if (!$hasLng) {
                $table->decimal('lng', 11, 8)->nullable();
                echo "✓ Added 'lng' column\n";
            }
        });

        echo "\n✅ Migration completed successfully!\n";
        echo "\nColumns added:\n";
        echo "- lat: decimal(10,8) nullable\n";
        echo "- lng: decimal(11,8) nullable\n";
    }

    // Verify the columns exist
    echo "\n--- Verification ---\n";
    $columns = DB::select("SHOW COLUMNS FROM owner_shops WHERE Field IN ('lat', 'lng')");
    foreach ($columns as $column) {
        echo "✓ {$column->Field}: {$column->Type} (Null: {$column->Null})\n";
    }

    echo "\n⚠️  IMPORTANT: Delete this file (add_location_columns.php) for security!\n";
    echo "</pre>";

} catch (Exception $e) {
    echo "<h2 style='color: red;'>Error occurred:</h2>";
    echo "<pre style='color: red;'>";
    echo "Error: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . "\n";
    echo "Line: " . $e->getLine() . "\n";
    echo "\nStack trace:\n" . $e->getTraceAsString();
    echo "</pre>";
}
