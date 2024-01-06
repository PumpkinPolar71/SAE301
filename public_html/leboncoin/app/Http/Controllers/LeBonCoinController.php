<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Models\Avis;

use App\Models\LeBonCoin;                       //AnnonceController
use App\Models\Annonce;                         //AnnonceController
use App\Models\TypeHebergement;                 //AnnonceController
use App\Models\ConditionHebergement;            //AnnonceController
use App\Models\Photo;                           //AnnonceController
use App\Models\Critere;                         //AnnonceController
use App\Models\Appartient;                      //AnnonceController

use App\Models\Particulier;                     //UserController
use App\Models\Entreprise;                      //UserController
use App\Models\Compte;                          //UserController

use App\Models\Ville;                           //LocalisationController
use App\Models\Departement;                     //LocalisationController
use App\Models\Region;                          //LocalisationController

use App\Models\Carte;                           //InfosBancairesController
use App\Models\Enregistre;                      //InfosBancairesController

use App\Models\SauvegardeRecherche;             //RechercheController

use App\Models\Incident;                        //IncidentController

use App\Models\Reservation;                     //ReservationController

use App\Models\Calendrier;                      //CalendrierController

use App\Models\Favoris;                         //FavorisController

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Config;
use Illuminate\Support\Facades\Storage;




class LeBonCoinController extends Controller
{
  //_______________________________________________.Lier_photos_aux_annonces.___________________________________________________//
    public function index() {
        return view ("Search/annoncelist", ['annonces'=>LeBonCoin::all() ], ['photo'=>Photo::all() ]);                                  #SearchFolder
    }
  //

  //_______________________________________________.processForm_sert_à_?.___________________________________________________//
    public function processForm(Request $request)
    {
      $validatedData = $request->validate([
          'prix' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
          'critere1' => 'required|integer',
          'critere2' => 'required|integer',
      ]);
      // Traite les données une fois qu'elles ont été validées avec succès
    }
  //

  //$nextId = 7;

  //_______________________________________________.Redirections.___________________________________________________//
    public function connect() {
      return view("Account/Login/connect");                                                           #AccountFolder #LoginFolder
    }
    public function redirection() {
      return view("Account/redirection");                                                             #AccountFolder
    }
  //


      public function store(Request $request)
      {
          // Valider les données du formulaire
          $request->validate([
              'nomequipement' => 'required|string|max:255|unique:equipement',
              // ... autres règles de validation ...
          ]);
        
          // Créer un nouvel équipement
          $equipment = Equipment::createequipement([
              'nomequipement' => $request->input('nomequipement'),
              // ... autres champs ...
          ]);
        
          // Rediriger avec un message de succès
          return redirect()->route('equipements.create')->with('success', 'Équipement créé avec succès!');
      }

}