<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CityController extends Controller
{
    
    public function processCity(Request $request)
    {
        $selectedCityId = $request->input('ville');

        // Faire quelque chose avec l'ID de la ville sélectionnée (par exemple, enregistrer en base de données, etc.)
        echo "coucou";

        return redirect('/city')->with('success', 'Ville sélectionnée avec succès.');
    }

    public function index()
    {
        $cities = DB::table('ville')->pluck('nomville', 'idville');

        return view('search', compact('cities'));
    }
}
