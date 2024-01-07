<?php

namespace App\Http\Controllers\Search;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Config;
use App\Http\Controllers\Controller;



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
        return view("search/mes_recherches", compact("recherches"));                                                                    #searchFolder
    }
  //

  //_____________________________________.Voir_mes_recherches_2.______________________//
    public function mesRecherches()
    {
        // Récupère l'utilisateur connecté
        $user = Auth::user();
    
        // Vérifie si l'utilisateur est connecté
        if ($user) {
            // Récupère les recherches sauvegardées associées à l'utilisateur connecté
            $recherches = $user->sauvegardesRecherches;
        
            return view('search/mes_recherches', compact('recherches'));                                                                #searchFolder
        } else {
            // Redirige vers la page de connexion si l'utilisateur n'est pas connecté
            return redirect('/login');
        }
    }
  //

  //_____________________________________.Récupérer_infos_annoncelist_grace_a_un_id.______________________//
    public function oneann($id) {
      $id = $id;
      $villes = Ville::all();//find($id)
    return view("search/annoncelist", compact('id','villes'));                                                                          #searchFolder
    }
  //

  //_____________________________________.Recupérer_infos_pour_recherche_par_filtres.______________________//
    public function indexe(Request $request)
    {
        $favoris = Favoris::all();
        $villes = Ville::all();
        $photos = Photo::all();
        $typesHebergement = TypeHebergement::all();
        $annonces = LeBonCoin::all(); 
        $reservations = Reservation::all();
        
        return view('search/annonce-index',compact('annonces', 'villes', 'typesHebergement', 'photos', 'reservations', 'favoris'));     #searchFolder
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
      
      return view('search/annonce-carte',compact('annonces', 'villes', 'typesHebergement', 'photos', 'reservations', 'favoris'));       #searchFolder
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


        return view('search/search', ['searchTerm' => $searchTerm]);                                                                    #searchFolder
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
