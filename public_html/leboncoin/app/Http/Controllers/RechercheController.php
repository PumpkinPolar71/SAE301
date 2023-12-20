<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Config;
use Illuminate\Support\Facades\Storage;

use App\Models\SauvegardeRecherche;             //RechercheController
use App\Models\Favoris;                         //FavorisController
use App\Models\Ville;                           //LocalisationController
use App\Models\Photo;                           //AnnonceController
use App\Models\TypeHebergement;                 //AnnonceController
use App\Models\LeBonCoin;                       //AnnonceController
use App\Models\Reservation;                     //ReservationController




class RechercheController extends Controller
{
  //_____________________________________.Voir_mes_recherches.______________________//
    public function mes_recherches() 
    {
        $recherches = SauvegardeRecherche::all();
        return view("mes_recherches", compact("recherches"));
    }
  //_____________________________________.Recherche_par_filtres.______________________//
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
  //_____________________________________.Barre_de_recherche.______________________//
    public function search() 
    {
      return view("search");
    }
}
