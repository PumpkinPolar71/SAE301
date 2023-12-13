<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\TypeHebergement;
use App\Models\Ville;
use App\Models\LeBonCoin;
use App\Models\Photo;
use App\Models\Reservation;
use App\Models\Favoris;
use App\Models\Compte;
use carbon\carbon;

class CityController extends Controller
{
        public function indexe(Request $request)
    {
        $favoris = Favoris::all();
        $villes = Ville::all();
        $photos = Photo::all();
        $typesHebergement = TypeHebergement::all();
        $annonces = LeBonCoin::all(); 
        $reservations = Reservation::all();
        
        return view('annonce-index',compact('annonces', 'villes', 'typesHebergement', 'photos', 'reservations', 'favoris'));
    }
    // public function adresse($q){
    //     $r = file_get_contents("https://api-adresse.data.gouv.fr/search/?type=json&q=$q");
    //     return response($r, 200)
    //     ->header('Content-Type', 'application/json');
    // }
}
