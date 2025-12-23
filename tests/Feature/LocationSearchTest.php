<?php

namespace Tests\Feature;

use App\OwnerShop;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LocationSearchTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $conn = \Illuminate\Support\Facades\DB::connection();
        echo "Connection Class: " . get_class($conn) . "\n";
        $pdo = $conn->getPdo();

        $pdo->sqliteCreateFunction('acos', 'acos', 1);
        $pdo->sqliteCreateFunction('cos', 'cos', 1);
        $pdo->sqliteCreateFunction('radians', 'deg2rad', 1);
        $pdo->sqliteCreateFunction('sin', 'sin', 1);

        echo "Registered math functions on connection\n";
    }

    /** @test */
    public function it_can_search_shops_by_location()
    {
        \App\AdminSetting::create(['currency_symbol' => '$']);

        // Create a shop within radius (around London Eye: 51.5033, -0.1195)
        $shop1 = OwnerShop::create([
            'name' => 'London Shop',
            'address' => 'London Eye',
            'phone_no' => '1234567890',
            'start_time' => '09:00',
            'end_time' => '18:00',
            'status' => 1,
            'lat' => 51.5033,
            'lng' => -0.1195,
            'owner_id' => 1 // Dummy ID
        ]);

        // Create a shop outside radius (around Paris: 48.8566, 2.3522)
        $shop2 = OwnerShop::create([
            'name' => 'Paris Shop',
            'address' => 'Eiffel Tower',
            'phone_no' => '0987654321',
            'start_time' => '09:00',
            'end_time' => '18:00',
            'status' => 1,
            'lat' => 48.8566,
            'lng' => 2.3522,
            'owner_id' => 1 // Dummy ID
        ]);

        // Search near London Eye (radius 50km)
        $response = $this->getJson('/api/user/search/shop?lat=51.5033&lng=-0.1195&radius=50');

        $response->assertStatus(200)
            ->assertJsonCount(1, 'data')
            ->assertJsonFragment(['name' => 'London Shop'])
            ->assertJsonMissing(['name' => 'Paris Shop']);
    }

    /** @test */
    public function it_finds_multiple_shops_within_radius()
    {
        \App\AdminSetting::create(['currency_symbol' => '$']);

        // Shop A (0km)
        OwnerShop::create([
            'name' => 'Shop A',
            'address' => 'Addr A',
            'phone_no' => '1',
            'start_time' => '09:00',
            'end_time' => '18:00',
            'status' => 1,
            'lat' => 40.7128,
            'lng' => -74.0060,
            'owner_id' => 1
        ]);

        // Shop B (approx 10km)
        OwnerShop::create([
            'name' => 'Shop B',
            'address' => 'Addr B',
            'phone_no' => '2',
            'start_time' => '09:00',
            'end_time' => '18:00',
            'status' => 1,
            'lat' => 40.7580,
            'lng' => -73.9855,
            'owner_id' => 1
        ]);

        // Search near New York (40.7128, -74.0060)
        $response = $this->getJson('/api/user/search/shop?lat=40.7128&lng=-74.0060&radius=20');

        $response->assertStatus(200)
            ->assertJsonCount(2, 'data');
    }

    /** @test */
    public function it_returns_empty_if_no_shops_within_radius()
    {
        \App\AdminSetting::create(['currency_symbol' => '$']);

        // Shop far away
        OwnerShop::create([
            'name' => 'Far Shop',
            'address' => 'Far Addr',
            'phone_no' => '3',
            'start_time' => '09:00',
            'end_time' => '18:00',
            'status' => 1,
            'lat' => 0,
            'lng' => 0,
            'owner_id' => 1
        ]);

        $response = $this->getJson('/api/user/search/shop?lat=51.5033&lng=-0.1195&radius=50');

        $response->assertStatus(200)
            ->assertJsonCount(0, 'data');
    }
}
