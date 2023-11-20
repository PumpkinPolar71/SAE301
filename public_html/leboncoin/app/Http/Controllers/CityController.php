<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\TypeHebergement;
use App\Models\Ville;
use App\Models\LeBonCoin;

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
    public function indexe(Request $request)
    {
        $villes = Ville::all();
        $typesHebergement = TypeHebergement::all(); // Assurez-vous d'avoir le modèle et la table pour les types d'hébergement
    
        $annonces = LeBonCoin::query();
    
        if ($request->has('ville')) {
            $annonces->where('ville', $request->ville);
        }
    
        if ($request->has('type_hebergement')) {
            $annonces->where('idtype', $request->type_hebergement);
        }
    
        if ($request->has('datedebut') && $request->has('datefin')) {
            $dateDebut = Carbon::createFromFormat('Y-m-d', $request->date_debut)->startOfDay();
            $dateFin = Carbon::createFromFormat('Y-m-d', $request->date_fin)->endOfDay();
    
            $annonces->whereBetween('date_disponibilite', [$dateDebut, $dateFin]);
        }
    
        $annonces = $annonces->get();
    
        return view('annonce-index', compact('annonces', 'villes', 'typesHebergement'));
    }
}
