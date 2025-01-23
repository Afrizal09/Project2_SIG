<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Regency;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class RegencyController extends Controller
{
    public function index()
    {
        $regencies = Regency::all();
        return view('chroropleth_map', compact('regencies'));
    }

    public function jumlah_penduduk()
    {
        // Ambil data dari database
        $locations = DB::table('regencies')->get();

        $geojsonData = [];

        foreach ($locations as $location) {
            $filePath = public_path('geojson/' . $location->id. '.geojson');
            if (File::exists($filePath)) {
                $geojson = json_decode(File::get($filePath), true);

                // Tambahkan data penduduk ke properti setiap feature
                foreach ($geojson['features'] as &$feature) {
                    $feature['properties']['population'] = $location->population;
                }

                $geojsonData[] = $geojson;
            } else {
                // Handle jika file tidak ditemukan
                Log::warning("File GeoJSON tidak ditemukan: " . $filePath);
            }
        }

        // var_dump($geojsonData);
        return view('chroropleth_map', compact('geojsonData'));

    }
}
