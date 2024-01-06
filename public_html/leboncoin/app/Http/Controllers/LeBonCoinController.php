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

    public function index() {
        return view ("annoncelist", ['annonces'=>LeBonCoin::all() ], ['photo'=>Photo::all() ]);
    }

  
    public function processForm(Request $request)
    {
    $validatedData = $request->validate([
        'prix' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
        'critere1' => 'required|integer',
        'critere2' => 'required|integer',
    ]);
    // Traite les données une fois qu'elles ont été validées avec succès
    }
    //$nextId = 7;

  //_____________________________________________________Redirections________________________________//
    public function connect() {
      return view("connect");
    }
    public function redirection() {
      return view("redirection");
    }
    // public function compte() {
    //   return view("compte");
    // } déplacé

    
  //
    
  
  /*public function show($id) {
    $annonce = LeBonCoin::find($id); // Récupération de l'annonce avec l'ID fourni
    // ...
    return view('incidentsave')->with('annonce', $annonce);
}*/
  // public function oneres($id) {
  //   $id = $id;
  //   $villes = Ville::all();
  //   $annonces = LeBonCoin::all();//find($id)
  //   return view("reservationlist", compact('id', "villes", "annonces"));
  // } déplacé

  // public function oneann($id) {
  //   $id = $id;
  //   $villes = Ville::all();//find($id)
  // return view("annoncelist", compact('id','villes'));
  // } déplacé

  // public function reservation($id) {
  //   $reservation = Reservation::find($id);
  //   $annonce = LeBonCoin::find($reservation->idannonce); // Récupérer l'annonce associée à la réservation

  //   $photos = Photo::join('annonce', 'photo.idannonce', '=', 'annonce.idannonce')
  //                   ->join('reservation', 'reservation.idannonce', '=', 'annonce.idannonce')
  //                   ->where('idreservation', $id)
  //                   ->get();
  //   return view("reservation", compact('reservation', 'annonce', 'photos'));
  // } déplacé
  
    
    
    
    // public function updateEmail(Request $request)
    // {
    //     $newEmail = $request->input('email');

    //     Auth::user()->compte->update(['email' => $newEmail]);

    //     // Réponse JSON facultative pour informer le client que la mise à jour est terminée
    //     return response()->json(['success' => true]);
    // }
    
        

      // private function create (Post $post, CreatePostRequest $request): array
      //   {
      //       $data = $request->validated();
      //       /** @var UploadedFile|null $image */
      //       $image = $request->validated('image');
      //       $post->image = $image->store('blog', 'public');

      //       if ($post->image) {
      //         Storage::disk('public')->delete($post->image);
      //     }
      //   }
      
    



 
  
      
  




     
      

      


      
      
      

      public function reconnaissanceJustifie(Request $request, $id)
      {
          $incident = Incident::find($id);

          $statut = $request->input('statut', 'non-resolu');

          $incident->resolu = true;

          $incident->save();

          return redirect('/mes-incidents');
      }

      


      
      public function mesRecherches()
      {
          // Récupère l'utilisateur connecté
          $user = Auth::user();
      
          // Vérifie si l'utilisateur est connecté
          if ($user) {
              // Récupère les recherches sauvegardées associées à l'utilisateur connecté
              $recherches = $user->sauvegardesRecherches;
      
              return view('mes_recherches', compact('recherches'));
          } else {
              // Redirige vers la page de connexion si l'utilisateur n'est pas connecté
              return redirect('/login');
          }
      }
      

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
  
  

    
