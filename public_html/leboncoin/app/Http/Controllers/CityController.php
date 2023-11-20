<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CityController extends Controller
{
    
    public function processCity(Request $request)
    {
        $selectedCityId = $request->input('ville');

        // Faire quelque chose avec l'ID de la ville sélectionnée (par exemple, enregistrer en base de données, etc.)

        return redirect('/')->with('success', 'Ville sélectionnée avec succès.');
    }

    public function index()
    {
        $cities = DB::table('ville')->pluck('nomville', 'idville');

        return view('search', compact('cities'));
    }
}
