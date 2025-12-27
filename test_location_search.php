<?php

// Test script for location search API
require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "=== Backend Location Search Test ===\n\n";

// Test 1: Check shops with coordinates
echo "Test 1: Checking shops with coordinates...\n";
$shops = DB::table('owner_shops')
    ->select('id', 'name', 'address', 'lat', 'lng', 'status')
    ->where('status', 1)
    ->get();

echo "Found " . $shops->count() . " active shops\n\n";

foreach ($shops as $shop) {
    $hasCoords = !is_null($shop->lat) && !is_null($shop->lng);
    $status = $hasCoords ? "✓ HAS COORDS" : "✗ NO COORDS";
    echo "ID: {$shop->id} | {$shop->name} | {$status}\n";
    if ($hasCoords) {
        echo "   Location: ({$shop->lat}, {$shop->lng})\n";
    }
    echo "   Address: {$shop->address}\n\n";
}

// Test 2: Test the search endpoint logic
echo "\n=== Test 2: Testing Search Logic ===\n";

if ($shops->count() > 0) {
    // Use first shop's coordinates as test location
    $testShop = $shops->first();

    if (!is_null($testShop->lat) && !is_null($testShop->lng)) {
        $testLat = floatval($testShop->lat);
        $testLng = floatval($testShop->lng);
        $radius = 50; // 50km radius

        echo "Test Location: ({$testLat}, {$testLng})\n";
        echo "Search Radius: {$radius}km\n\n";

        // Simulate the search query
        try {
            $results = DB::table('owner_shops')
                ->select('*')
                ->selectRaw("( 6371 * acos( cos( radians(?) ) *
                    cos( radians( lat ) )
                    * cos( radians( lng ) - radians(?) )
                    + sin( radians(?) ) *
                    sin( radians( lat ) ) ) ) AS distance", [$testLat, $testLng, $testLat])
                ->where('status', 1)
                ->having("distance", "<", $radius)
                ->orderBy("distance")
                ->get();

            echo "Search Results: Found " . $results->count() . " shops within {$radius}km\n\n";

            foreach ($results as $result) {
                $distance = number_format($result->distance, 2);
                echo "• {$result->name} - {$distance} km away\n";
            }
        } catch (Exception $e) {
            echo "ERROR: " . $e->getMessage() . "\n";
        }
    } else {
        echo "⚠ First shop has no coordinates, cannot test search\n";
    }
} else {
    echo "⚠ No active shops found in database\n";
}

echo "\n=== Test Complete ===\n";
