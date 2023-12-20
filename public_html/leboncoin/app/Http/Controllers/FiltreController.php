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

class FiltreController extends Controller
{
        
        public function carteFiltre(Request $request)
        {
            $favoris = Favoris::all();
            $villes = Ville::all();
            $photos = Photo::all();
            $typesHebergement = TypeHebergement::all();
            $annonces = LeBonCoin::all(); 
            $reservations = Reservation::all();
            
            return view('annonce-carte',compact('annonces', 'villes', 'typesHebergement', 'photos', 'reservations', 'favoris'));
        }
        public function getAnnonces(Request $request)
        {
            $idVille = $request->input('idville');
        
            $annonces = DB::table('annonce')
                ->join('ville', 'ville.idville', '=', 'annonce.idville')
                ->join('photo', 'photo.idannonce', '=', 'annonce.idannonce') 
                ->join('favoris', 'favoris.idcompte', '=', 'annonce.idcompte')
                ->where('annonce.idville', $idVille)
                ->select('annonce.*', 'photo.photo', 'favoris.libidannonce') 
                ->get();
                
        
            return response()->json(['annonces' => $annonces]);
        }
        
    // public function adresse($q){
    //     $r = file_get_contents("https://api-adresse.data.gouv.fr/search/?type=json&q=$q");
    //     return response($r, 200)
    //     ->header('Content-Type', 'application/json');
    // }
}
