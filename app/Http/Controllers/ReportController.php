<?php

namespace App\Http\Controllers;

use App\Models\FloodLocation;
use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function store(Request $request){

        // Validasi data input
        $validated = $request->validate([
            'city_name' => 'required|string|exists:flood_locations,name',
            'subdistrict' => 'required|string',
            'description' => 'required|string|min:10'
        ]);

        // cari id flood location dari namanya
        $floodLocation = FloodLocation::where('name', $validated['city_name'])->firstOrFail();

        if(!$floodLocation){
            return back()->withErrors(['city_name' => 'Invalid City name']);
        }

        Report::create([
            'flood_location_id' => $floodLocation->id,
            'subdistrict' => $validated['subdistrict'],
            'description' => $validated['description']
        ]);

        return redirect()->back()->with('success', 'Report submitted successfully!');
    }
}
