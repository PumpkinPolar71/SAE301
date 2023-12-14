<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GeocodeController extends Controller
{
    public function geocode($city)
    {
        $response = Http::get('https://nominatim.openstreetmap.org/search', [
            'format' => 'json',
            'q' => $city . ', France',
        ]);

        return $response->body();
    }
}
