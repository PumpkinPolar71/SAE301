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
  //

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
  //

  //_____________________________________.Recherche_par_filtres_dans_la_carte.______________________//
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
  //
  
  //_____________________________________.Récupérer_annonce_dans_la_carte.______________________//
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
  //

  //_____________________________________.Barre_de_recherche.______________________//
    // public function search() 
    // {
    //   return view("search");
    // }
    public function search(Request $request)
    {
        $searchTerm = $request->input('search');

        //$searchTermLower = strtolower($searchTerm);


        return view('search', ['searchTerm' => $searchTerm]);
    }
  //
  
  //_____________________________________.Sauvegarder_recherche.______________________//
    public function sauvrecherche(Request $request) {
      $a = new SauvegardeRecherche();
      $a->idsauvegarde = SauvegardeRecherche::max('idsauvegarde')+1;
      $a->idcompte =  Auth::id();
      if (Auth::user()->idparticulier == "") {
          $a->identreprise = Auth::user()->identreprise;
      } else {
          $a->idparticulier = Auth::user()->idparticulier;
      }
      $a->nomsauvegarde = "sauvegarde".SauvegardeRecherche::max('idsauvegarde')+1;
      $a->nomrecherche = "recherche".SauvegardeRecherche::max('idsauvegarde')+1;
      $a->prixmin = NULL;
      $a->prixmax = NULL;
      $a->libnbchambre = NULL;
      $a->nomequitement = "";
      $a->nomexterieur = "";
      $a->nomserviceetaccess = "";
      $a->nomvilles = $request->input('villess');
      $a->nomtypehebergement = $request->input('type_hebergementss');
      $a->save();
      return redirect('/mes_recherches');
    }
  //
}
