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
    // Traitez les données une fois qu'elles ont été validées avec succès
    }
    //$nextId = 7;

  //_____________________________________________________Redirections________________________________//
    public function connect() {
      return view("connect");
    }
    public function compte() {
      return view("compte");
    }
    public function guide() {
      return view("guide");
    }
    public function createaccount() {
      return view("createaccount");
    }
    
  
  /*public function show($id) {
    $annonce = LeBonCoin::find($id); // Récupération de l'annonce avec l'ID fourni
    // ...
    return view('incidentsave')->with('annonce', $annonce);
}*/
  public function oneres($id) {
    $id = $id;
    $villes = Ville::all();
    $annonces = LeBonCoin::all();//find($id)
    return view("reservationlist", compact('id', "villes", "annonces"));
  }
  public function oneann($id) {
    $id = $id;
    $villes = Ville::all();//find($id)
  return view("annoncelist", compact('id','villes'));
  }
  public function reservation($id) {
    $reservation = Reservation::find($id);
    $annonce = LeBonCoin::find($reservation->idannonce); // Récupérer l'annonce associée à la réservation

    $photos = Photo::join('annonce', 'photo.idannonce', '=', 'annonce.idannonce')
                    ->join('reservation', 'reservation.idannonce', '=', 'annonce.idannonce')
                    ->where('idreservation', $id)
                    ->get();
    return view("reservation", compact('reservation', 'annonce', 'photos'));
  }
  public function proprio($id) {
    // $annonces = LeBonCoin::find($id);
    $compte = Compte::find($id);
    $villes = Ville::all();
    $departements = Departement::all();
    $particuliers = Particulier::all();
    return view("proprio", compact('compte','particuliers','villes','departements'));
    }
    
    
    public function imgGP() {
      return view("imgGP");
    }
    // public function updateEmail(Request $request)
    // {
    //     $newEmail = $request->input('email');

    //     Auth::user()->compte->update(['email' => $newEmail]);

    //     // Réponse JSON facultative pour informer le client que la mise à jour est terminée
    //     return response()->json(['success' => true]);
    // }
    
        public function cryptInfosBc(Request $request)
        {
          $comptes = Compte::all();
          $enregistres = Enregistre::all();
          $cartes = Carte::all();


          return view("infosbancaires", compact('comptes','cartes','enregistres'));

            
        }

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
      public function redirection() {
        return view("redirection");
      }
    



 
  
      
  




     
      

      


      
      
      

      public function reconnaissanceJustifie(Request $request, $id)
      {
          $incident = Incident::find($id);

          $statut = $request->input('statut', 'non-resolu');

          $incident->resolu = true;

          $incident->save();

          return redirect('/mes-incidents');
      }

      public function mes_messages()
      {
          return redirect('/mes_messages');
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



      public function annoncesNonValidees()
      {
        $annoncesNonVerifiees = LeBonCoin::where('codeetattelverif', false)->get();
        $particuliers = Particulier::all();
        
          return view('validationtel', [ 'annoncesNonValidees'=>$annoncesNonVerifiees, "particuliers"=>$particuliers ]);
      }


      public function validerAnnonce(Request $request, $idannonce)
      {
          // Mettez à jour le champ CODEETATTELVERIF à true dans la base de données
          LeBonCoin::where('idannonce', $idannonce)->update(['codeetattelverif' => true]);
      
          return redirect('/annonces-non-validees')->with('success', 'Annonce vérifiée avec succès.');
      }
      
      
      public function afficherInscriptionAttente()
      {
          // Récupérez toutes les réservations
          $reservations = Reservation::all();
          $particuliers = Particulier::all();
          $annonces = Annonce::all();
          $entreprises = Entreprise::all();
          $comptes = Compte::all();

          $reservationsParAnnonce = $reservations->groupBy('idannonce');
      
          return view('inscription-attente', compact('reservations' , 'particuliers' , 'annonces', 'reservationsParAnnonce', 'entreprises', 'comptes')) ;
      }
      

      









public function deposerAvis(Request $request)
{
    // Validation des données du formulaire
    

    // Récupérer les données du formulaire
    $idAnnonce = $request->input('idannonce');
    $commentaire = $request->input('commentaire');
    $idCompte = auth()->user()->id; // Supposons que vous utilisez l'authentification de Laravel

    // Créer un nouvel avis
    $avis = new Avis();
    $avis->idcompte = $idCompte;
    $avis->idparticulier = $idCompte; // Supposons que idparticulier est l'ID du compte connecté
    $avis->idannonce = $idAnnonce;
    $avis->dateavis = now(); // Date actuelle
    $avis->commentaire = $commentaire;
    $avis->valide = false;

    // Enregistrer l'avis dans la base de données
    $avis->save();

    // Redirection ou autre logique après avoir enregistré l'avis
    return redirect('/annonce')->withInput();
}
public function gestionAvis()
    {
      $avisNonValides = Avis::where('valide', false)->get();
      //\Log::info($avisNonValides);
      // Fetch related announcement name and comment for each review
      // $avisDetails = [];
      // foreach ($avisNonValides as $avis) {
      //     $annonce = LeBonCoin::find($avis->idannonce);
      //     $avisDetails[] = [
      //         'id' => $avis->id,
      //         'contenu' => $avis->contenu,
      //         'valide' => $avis->valide,
      //         'nom_annonce' => $annonce->titreannonce, // Replace 'nom_annonce' with the actual column name
      //         'commentaire_annonce' => $annonce->commentaire, // Replace 'commentaire_annonce' with the actual column name
      //     ];
      // }
  
      return view('enregistrer_avis', compact('avisNonValides'));
    }

    public function modifierAvis(Request $request, $id)
    {
        $avis = Avis::findOrFail($id);
        $avis->valide = $request->input('valide', false);
        $avis->save();

        return redirect('/enregistrer_avis')->with('success', 'Statut de l avis modifié avec succès');
    }

    public function favoris($id) {
      $favoris = Favoris::where('idcompte', $id)->first();
      //$favoris = Favoris::find($id);
      $annonces = LeBonCoin::all();
      $photos = Photo::all();
      $villes = Ville::all();

      return view('favoris', compact('favoris', "annonces", "photos","villes"));
    }
    public function sauvefavoris($id) {
      $user = Auth::user();
      $favoris = Favoris::where('idcompte', $user->idcompte)->first();
  
      if (!$favoris) {
          $favoris = new Favoris();
          $favoris->idfavoris = Favoris::max('idfavoris') + 1;
          $favoris->idcompte = $user->idcompte;
          $favoris->libidannonce = $id;
      }
  
      $favoris->libidannonce = $favoris->libidannonce." ".$id;
  
      $particulier = Particulier::where('idcompte', $user->idcompte)->first();
      if ($particulier) {
          $favoris->idparticulier = $particulier->idparticulier;
      }
  
      // Sauvegarde seulement si $favoris est défini
      if ($favoris) {
          $favoris->save();
      }


      return redirect('/annonce-filtres?ville=&type_hebergement=&datedebut=&datefin=');
    }
    public function supprfavoris($id) {
      $user = Auth::user();
      $favoris = Favoris::where('idcompte', $user->idcompte)->first();
  
      if ($favoris) {
          $tabann = explode(" ", $favoris->libidannonce);
          $updatedFavoris = [];
  
          foreach ($tabann as $value) {
              if ($value != $id) {
                  $updatedFavoris[] = $value;
              }
          }
  
          $favoris->libidannonce = implode(" ", $updatedFavoris);
          $favoris->save();
      } else {
          echo "Problème : Favoris introuvable.";
      }
  
      return redirect('/annonce-filtres?ville=&type_hebergement=&datedebut=&datefin=');
  }
  public function newres(){
    $annonces = LeBonCoin::all(); // Exemple pour récupérer toutes les annonces
   
    $user = auth()->user();
    // Passer les données récupérées à la vue
    return view('newreservation', ['annonces' => $annonces]);
    return view('newreservation');
}
public function payement(Request $request,$idannonce)
{
  if (
    $request->input("nbadulte") == ""  ||
    $request->input("nbenfant") == "" ||
    $request->input("nbbebe") == "" ||
    $request->input("nbanimaux") == "" ||
    $request->input("prenom") == "" ||
    $request->input("nom") == "" ||
    $request->input("tel") == "" ||
    $request->input("nbnuitee") == "" ||
    $request->input("datedebutr") == "" ||
    $request->input("datefinr") == "" 
    ) {return redirect('newreservation')->withInput()->with("error","Il semblerait que vous n'ayez pas renseigné tous les champs !");
  } else {
    $reservation = new Reservation();

    $reservation->idannonce = $request->input('idannonce');

    return view('payement_reservation');
  }
}
public function showPayementForm($idannonce)
{
    // Vous pouvez également ajouter la logique pour récupérer les données associées à $idannonce
    $annonce = Annonce::find($idannonce);
    
    $compte = auth()->user()->compte; // Assurez-vous que cette relation est correctement définie dans votre modèle User
  
    $user = auth()->user();

    return view('payement_reservation', ['idannonce' => $idannonce]);
}
public function ajouterReservation(Request $request,$id)
    {
      if (
        $request->input("nbadulte") == ""  ||
        $request->input("nbenfant") == "" ||
        $request->input("nbbebe") == "" ||
        $request->input("nbanimaux") == "" ||
        $request->input("prenom") == "" ||
        $request->input("nom") == "" ||
        $request->input("tel") == "" ||
        $request->input("nbnuitee") == "" ||
        $request->input("datedebutr") == "" ||
        $request->input("datefinr") == "" 
        ) {return redirect('newreservation')->withInput()->with("error","Il semblerait que vous n'ayez pas renseigné tous les champs !");
    } else {

        // Création d'une nouvelle réservation
        $reservation = new Reservation();
        $reservation->idreservation = Reservation::max('idreservation')+1;
        $reservation->idannonce = $request->input('idannonce');
        $reservation->idcompte = Auth::id();
        $reservation->idparticulier = Auth::id(); // ID du particulier connecté
        $reservation->nbadulte = $request->input('nbadulte');
        $reservation->nbenfant = $request->input('nbenfant');
        
        $reservation->nbbebe = $request->input('nbbebe');
        $reservation->nbanimaux = $request->input('nbanimaux');
        $reservation->prenom = $request->input('prenom');
        $reservation->nom = $request->input('nom');
        $reservation->tel = $request->input('tel');
        $nbNuits = $request->input('nbnuitee');

    // Utilisation du nombre de nuits récupéré
    // ... (autres opérations)

    // Sauvegarde de la réservation
        $reservation->nbnuitee = $nbNuits;
        $datedebut = $request->input('datedebutr');
        $datefin = $request->input('datefinr');

    // Utilisez les variables $datedebut et $datefin comme nécessaire dans votre logique de réservation

    // Sauvegarde de la réservation
    $reservation->datedebutr = $datedebut;
    $reservation->datefinr = $datefin;
    
        // Calcul du nombre de nuits
    
        // Assigner le nombre de nuits à la réservation
     
        $reservation->montantimmediatacompte = $request->has('montantimmediatacompte');
        // Exemple de calcul pour taxessejour
        $reservation->montantimmediat = $request->input('montantimmediat');
        $taxesSejour = $request->input('montantimmediat') * 0.1;
        $reservation->taxessejour = $taxesSejour;

        // Ajustez les autres calculs selon vos besoins pour les autres champs dérivés
        
        // Sauvegarde de la réservation
        $reservation->save();

        // Redirection vers une page de confirmation ou autre
        
        return redirect('/annonce-filtres?ville=&type_hebergement=&datedebut=&datefin=')->with('success', 'Réservation effectuée avec succès !');
    }
  }
    public function showReservationForm($idannonce) {
    $annonce = Annonce::find($idannonce);
    $libelleDateDebut = $annonce->libelledatedebut;
    $libelleDateFin = $annonce->libelledatefin;
    $datedebut = $annonce->datedebut;
    $datefin = $annonce->datefin;
    $compte = auth()->user()->compte; // Assurez-vous que cette relation est correctement définie dans votre modèle User
    $numeroTelephone = $compte->tel; // Assurez-vous du nom réel du champ dans la table "compte"
    $user = auth()->user();
     $prenom = $user->particulier->prenom;
    $nom = $user->particulier->nom;
    $datesDisponibles = Annonce::where('idannonce', $idannonce)->pluck('datedebut', 'datefin');
    $reservation = Reservation::where('idannonce', $idannonce)->first();
    $montantimmediatacompte = $reservation->montantimmediatacompte;
    // D'autres données que vous pourriez avoir besoin

    return view('newreservation', [
        'idannonce' => $idannonce,
        'numeroTelephone' => $numeroTelephone,
        'user' => $user,
        'datesDisponibles' => $datesDisponibles,
        'prenom' => $prenom,
        'nom' => $nom,
        'montantimmediatacompte' => $montantimmediatacompte,
        'datedebut' => $datedebut,
        'datefin' => $datefin,
        // ... autres données nécessaires à la vue pour afficher le formulaire initial
    ]);
      
  }
  
}
  
  

    
