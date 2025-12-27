<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "Inserting test shops...\n\n";

$testShops = [
    [
        'owner_id' => 1,
        'name' => 'Downtown Car Wash NYC',
        'address' => '123 Broadway, New York, NY 10007',
        'phone_no' => '+1-212-555-0001',
        'start_time' => '08:00:00',
        'end_time' => '18:00:00',
        'service_type' => 0,
        'status' => 1,
        'lat' => '40.7138',
        'lng' => '-74.0070',
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'owner_id' => 1,
        'name' => 'Midtown Auto Detailing',
        'address' => '456 5th Avenue, New York, NY 10018',
        'phone_no' => '+1-212-555-0002',
        'start_time' => '07:00:00',
        'end_time' => '19:00:00',
        'service_type' => 0,
        'status' => 1,
        'lat' => '40.7549',
        'lng' => '-73.9840',
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'owner_id' => 1,
        'name' => 'Brooklyn Premium Wash',
        'address' => '789 Atlantic Ave, Brooklyn, NY 11217',
        'phone_no' => '+1-718-555-0003',
        'start_time' => '09:00:00',
        'end_time' => '20:00:00',
        'service_type' => 0,
        'status' => 1,
        'lat' => '40.6838',
        'lng' => '-73.9761',
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'owner_id' => 1,
        'name' => 'Queens Express Detailing',
        'address' => '321 Queens Blvd, Queens, NY 11373',
        'phone_no' => '+1-718-555-0004',
        'start_time' => '08:00:00',
        'end_time' => '17:00:00',
        'service_type' => 0,
        'status' => 1,
        'lat' => '40.7389',
        'lng' => '-73.8785',
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'owner_id' => 1,
        'name' => 'Far Away Car Care',
        'address' => 'Far Location, NY',
        'phone_no' => '+1-555-555-0005',
        'start_time' => '08:00:00',
        'end_time' => '18:00:00',
        'service_type' => 0,
        'status' => 1,
        'lat' => '41.0000',
        'lng' => '-74.5000',
        'created_at' => now(),
        'updated_at' => now(),
    ],
];

try {
    DB::table('owner_shops')->insert($testShops);
    echo "✓ Successfully inserted 5 test shops\n\n";

    // Verify
    $count = DB::table('owner_shops')->count();
    echo "Total shops in database: {$count}\n";

    echo "\nTest shops added:\n";
    foreach ($testShops as $shop) {
        echo "• {$shop['name']} at ({$shop['lat']}, {$shop['lng']})\n";
    }

} catch (Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}
