<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\TypeHebergement;
use App\Models\Ville;
use App\Models\LeBonCoin;
use carbon\carbon;

class CityController extends Controller
{
        public function indexe(Request $request)
    {
        $villes = Ville::all();
        $typesHebergement = TypeHebergement::all(); // Assurez-vous d'avoir le modèle et la table pour les types d'hébergement
    
        $annonces = LeBonCoin::query();
    
        if ($request->has('ville')) {
            $annonces->where('idville', $request->nomville  );
        }
    
        if ($request->has('type_hebergement')) {
            $annonces->where('idtype', $request->type_hebergement);
        }
    
        if ($request->has('datedebut') && $request->has('datefin')) {
            $dateDebut = Carbon::createFromFormat('dd-mm-yyyy', $request->date_debut)->startOfDay();
            $dateFin = Carbon::createFromFormat('dd-mm-yyyy', $request->date_fin)->endOfDay();
    
            $annonces->whereBetween('date_disponibilite', [$dateDebut, $dateFin]);
        }
    
        $annonces = $annonces->get();
    
        return view('annonce-index', compact('annonces', 'villes', 'typesHebergement'));
    }
}
