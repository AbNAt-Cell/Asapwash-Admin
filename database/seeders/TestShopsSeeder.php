<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TestShopsSeeder extends Seeder
{
    /**
     * Seed test shops with coordinates for location search testing
     */
    public function run()
    {
        // Test location: New York City (40.7128, -74.0060)

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
                'lat' => '40.7138', // ~1.1 km from test location
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
                'lat' => '40.7549', // ~4.7 km from test location
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
                'lat' => '40.6838', // ~3.5 km from test location
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
                'lat' => '40.7389', // ~6.8 km from test location
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
                'lat' => '41.0000', // ~32 km from test location
                'lng' => '-74.5000',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('owner_shops')->insert($testShops);

        $this->command->info('✓ Seeded 5 test shops with coordinates');
        $this->command->info('Test location: (40.7128, -74.0060) - New York City');
        $this->command->info('Shops at varying distances: ~1km, ~3.5km, ~4.7km, ~6.8km, ~32km');
    }
}
