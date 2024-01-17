<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Models\Avis;

use App\Models\LeBonCoin;          
use App\Models\Annonce;            
use App\Models\TypeHebergement;    
use App\Models\ConditionHebergement;
use App\Models\Photo;              
use App\Models\Critere;            
use App\Models\Appartient;         
use App\Models\Particulier;        
use App\Models\Entreprise;         
use App\Models\Compte;             
use App\Models\Ville;              
use App\Models\Departement;        
use App\Models\Region;             
use App\Models\Carte;              
use App\Models\Enregistre;         
use App\Models\SauvegardeRecherche;
use App\Models\Incident;           
use App\Models\Reservation;        
use App\Models\Calendrier;         
use App\Models\Favoris;            

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Config;
use Illuminate\Support\Facades\Storage;




class LeBonCoinController extends Controller
{
  //_______________________________________________.Lier_photos_aux_annonces.___________________________________________________//
    public function index() {
        return view ("search/annoncelist", ['annonces'=>LeBonCoin::all() ], ['photo'=>Photo::all() ]);                                  #searchFolder
    }
  //

  //_______________________________________________.Redirections.___________________________________________________//
    public function connect() {
      return view("account/login/connect");                                                           #accountFolder #loginFolder
    }
    public function redirection() {
      return view("account/redirection");                                                             #AccountFolder
    }
  //


      public function store(Request $request)
      {
          $request->validate([
              'nomequipement' => 'required|string|max:255|unique:equipement',
          ]);
      
          $equipment = Equipment::createequipement([
              'nomequipement' => $request->input('nomequipement'),
          ]);
        
          return redirect()->route('equipements.create')->with('success', 'Équipement créé avec succès!');
      }

}