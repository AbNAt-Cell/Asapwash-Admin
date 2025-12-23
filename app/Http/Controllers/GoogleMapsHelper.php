<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GoogleMapsHelper
{
    /**
     * Get coordinates (lat, lng) for a given address using Google Maps Geocoding API.
     *
     * @param string $address
     * @return array|null
     */
    public static function getCoordinates($address)
    {
        $apiKey = env('GOOGLE_MAPS_API_KEY');

        if (!$apiKey) {
            Log::error('Google Maps API Key is not set in .env');
            return null;
        }

        $response = Http::get('https://maps.googleapis.com/maps/api/geocode/json', [
            'address' => $address,
            'key' => $apiKey,
        ]);

        if ($response->successful()) {
            $data = $response->json();
            if ($data['status'] === 'OK') {
                $location = $data['results'][0]['geometry']['location'];
                return [
                    'lat' => $location['lat'],
                    'lng' => $location['lng'],
                ];
            } else {
                Log::error('Google Maps Geocoding API error: ' . $data['status'] . ' - ' . ($data['error_message'] ?? 'No error message'));
            }
        } else {
            Log::error('Google Maps Geocoding API request failed');
        }

        return null;
    }
}
