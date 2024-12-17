<?php

namespace App\Http\Controllers;

use App\Models\FloodLocation;
use App\Models\CityDetail;
use Illuminate\Http\Request;

class FloodLocationController extends Controller
{
    public function getFloodLocations()
    {
        $floodLocations = FloodLocation::all()->map(function($location) {
            return [
                'lnglat' => [$location->longitude, $location->latitude],
                'city' => $location->name,
                'count' => $location->flood_count
            ];
        }); 

        return response()->json($floodLocations);
    }

    public function getCityDetails()
    {
        $cityDetails = FloodLocation::with('cityDetails')->get()->mapWithKeys(function($location) {
            return [$location->name => $location->cityDetails->map(function($detail) {
                return [
                    'lnglat' => [$detail->longitude, $detail->latitude],
                    'kelurahan' => $detail->kelurahan,
                    'indeksBanjir' => $detail->indeksBanjir,
                    'Kategori' => $detail->kategori
                ];
            })];
        });

        return response()->json($cityDetails);
    }
}
