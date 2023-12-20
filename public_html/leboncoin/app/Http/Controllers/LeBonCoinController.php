<?php

namespace App\Http\Controllers;
use App\Models\Avis;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\LeBonCoin;
use App\Models\Particulier;
use App\Models\Entreprise;
use App\Models\Compte;
use App\Models\Ville;
use App\Models\Incident;
use App\Models\Departement;
use App\Models\Region;
use App\Models\Photo;
use App\Models\Critere;
use App\Models\Reservation;
use App\Models\Calendrier;
use App\Models\TypeHebergement;
use App\Models\ConditionHebergement;
use App\Models\Appartient;
use App\Models\Favoris;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Config;
use Illuminate\Support\Facades\Storage;
use App\Models\SauvegardeRecherche;
use App\Models\Carte;
use App\Models\Enregistre;

use App\Models\Annonce;


class LeBonCoinController extends Controller
{

    public function index() {
        return view ("annoncelist", ['annonces'=>LeBonCoin::all() ], ['photo'=>Photo::all() ]);
    }

    public function add() {
      $villes = Ville::all();
      $typesHebergements = TypeHebergement::all();
      
      return view("annonceeuh",compact('villes', "typesHebergements"));
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

    public function incidentsave(Request $request) {
       
      $incident = new Incident();
      
      $incident->idannonce = $request->input('id');
      $incident->remboursement = false;
      $incident->procedurejuridique = false;
      $incident->resolu = false;
      $incident->commentaire = $request->input("commentaire");
      $incident->save();
      // Mettre à jour le prochain ID pour le prochain incident
      
      return redirect('/compte')->withInput()->with("incident", 'signalement créé');
    }
    public function connect() {
      return view("connect");
    }
    public function compte() {
      return view("compte");
    }
    public function guide() {
      return view("guide");
    }
    public function mes_recherches() {
      $recherches = SauvegardeRecherche::all();
      return view("mes_recherches", compact("recherches"));
    }
    public function createaccount() {
      return view("createaccount");
    }
    public function one($id) {
      $photos = Photo::where('idannonce', $id)->get();
      $annonce = LeBonCoin::find($id);
      $criteres = $annonce->criteres->pluck('libellecritere')->toArray();
      $equipements = $annonce->equipements()->pluck('nomequipement')->toArray();

      $words = explode(' ', $annonce->titreannonce);
      $firstWord = strtolower($words[0]);
      $avis = $annonce->avis->pluck('commentaire')->toArray();
      $similarFirstWordAds = LeBonCoin::join('photo', 'photo.idannonce', '=', 'annonce.idannonce')
                                      ->whereRaw('LOWER(SPLIT_PART(titreannonce, \' \', 1)) = ?', [$firstWord])
                                      ->where('annonce.idannonce', '<>', $id) // Exclure l'annonce principale
                                      ->get();
      if (Auth::user()) {
        if (Auth::user()->compte->codeetatcompte == 9 ) {
          return view("annonceserv", compact('annonce', 'photos', 'criteres', 'similarFirstWordAds', 'avis','equipements'));
        } else {
          return view("annonce", compact('annonce', 'photos', 'criteres', 'similarFirstWordAds', 'avis','equipements'));
        }
      } else {
        return view("annonce", compact('annonce', 'photos', 'criteres', 'similarFirstWordAds', 'avis','equipements'));

      }
      
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
    public function search() {
      return view("search");
    }
    public function createaccountparticulier() {
      return view("createaccountparticulier"); 
    }
    public function createaccountentreprise() {
      return view("createaccountentreprise"); 
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
    public function updateUserInfo(Request $request)
    {
        $nouvellePdp = $request->input('escapedImageData');
        $nouvelEmail = $request->input('nouvelEmail');
        $nouvelleRue = $request->input('nouvelleRue');
        $nouveauCP = $request->input('nouveauCP');
        $nouvelleVille = $request->input('nouvelleVille');
        $nouveauNom = $request->input('nouveauNom');
        $nouveauPrenom = $request->input('nouveauPrenom');

        // $nouvellePdp="j'aime le fil";
        $compte = Auth::user()->compte;
          $compte->pdp = $request->input('lien_pdp');
        if($nouvelEmail != ""){
          $compte->email = $nouvelEmail;
        }
        if($nouvelleRue != ""){
          $compte->adresseruecompte = $nouvelleRue;
        }
        if($nouveauCP != ""){
          $compte->adressecpcompte = $nouveauCP;
        }
        $compte->save();

        $ville = Auth::user()->compte;
        if($nouvelleVille != ""){
           $villeAll = Ville::all();
           foreach ($villeAll as $vile) { 
             if ( $nouvelleVille == $vile->nomville) {
                 $ville->idville = $vile->idville;
             } //A REFAIRE
             else {/*ca plante*/}
            }
        }
        $ville->save();

        $particulier = Auth::user()->particulier; 
        if($nouveauNom != ""){
          $particulier->nomparticulier = $nouveauNom;
        }
        if($nouveauPrenom != ""){
          $particulier->prenomparticulier = $nouveauPrenom; 
        }
        $particulier->save();

        return redirect()->back()->with('success', 'Informations utilisateur mises à jour avec succès');
    
        }
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
    



 
  
      
  public function ajouterAnnonce(Request $request)
  {
      $typesHebergement = TypeHebergement::all(); // Ou utilisez la méthode que vous avez pour récupérer les types d'hébergement
      $idVille = $request->input('ville');
      $idTypeHebergement = $request->input('type_hebergement');
      // Récupérer les valeurs de la partie "condition hébergement" de la requête GET
      $dateArrivee = $request->query('datearrive');
      $dateDepart = $request->query('datedepart');
      $fumeur = $request->has('fumeur') ? 'TRUE' : 'FALSE'; // TRUE si la case est cochée
      $animauxAcceptes = $request->has('animaux') ? 'TRUE' : 'FALSE'; // TRUE si la case est cochée
      $critereetoile = 0;
      $criterecapa = $request->input('critere1');
      $criterenbpers = $request->input('critere2');
  
      // Créer la chaîne représentant les conditions d'hébergement
      $libelleCondition = "$dateArrivee $dateDepart $fumeur $animauxAcceptes";
      // $critereetoile = '0 ' . $critereetoile;

    // Concaténer les valeurs des critères pour former le libellé complet
      $libelleCritere = "$critereetoile $criterecapa $criterenbpers";
      // Créer une nouvelle entrée dans la table condition_hebergement
      $conditionHebergement = new ConditionHebergement();
      $conditionHebergement->libellecondition = $libelleCondition;
      $conditionHebergement->idconditionh = ConditionHebergement::max('idconditionh')+1;

      $annonce = new LeBonCoin();
      $annonce->idconditionh = ConditionHebergement::max('idconditionh')+1;
      $conditionHebergement->save();

      $critere = new Critere();
      $critere->libellecritere = $libelleCritere;
      $critere->idcritere = Critere::max('idcritere')+1;
      $annonce->idcritere = Critere::max('idcritere')+1;
      $critere->save();

      // Récupérer l'id condition hébergement nouvellement créé
        $idConditionHebergement = $conditionHebergement->idconditionh;

        $annonce->idannonce = LeBonCoin::max('idannonce')+1;
        $annonce->idcompte = Auth::id(); // Associer l'annonce à l'utilisateur connecté
        //$annonce->identreprise = false;
        $annonce->idville = $idVille; // Associer l'annonce à la ville sélectionnée
        $annonce->idtype = $idTypeHebergement;
        $annonce->titreannonce = $request->input("titreannonce");
        $annonce->description = $request->input("description");
        $annonce->dateannonce = $request->input("date");
        $annonce->codeetatvalide = False;
        $annonce->codeetattelverif = False;
        
        //---------------------------------------------Gestion tableau DateDebut
       
        $dateDebutTab = $request->input('datedebut');
        $chainesDatesD = [];
        
        foreach ($dateDebutTab as $dateD) {
            // Vérifiez si $dateD est déjà une chaîne
            if (is_array($dateD)) {
                // Utilisez implode pour convertir le tableau en chaîne
                $chaineDateD = implode(' ', $dateD);
            } else {
                // Si $dateD est déjà une chaîne, utilisez-la directement
                $chaineDateD = $dateD;
            }
        
            $chainesDatesD[] = $chaineDateD;
        }
        
        // Implémentez les chaînes de dates en une seule chaîne
        $chaineDatesDebut = implode(' ', $chainesDatesD);
        
        $annonce->datedebut = $chaineDatesDebut;

        //---------------------------------------------Gestion tableau DateFin
        
        $dateFinTab = $request->input('datefin');
        $chainesDatesF = [];

        foreach ($dateFinTab as $dateF) {
            // Vérifiez si $dateF est déjà une chaîne
            if (is_array($dateF)) {
                // Utilisez implode pour convertir le tableau en chaîne
                $chaineDateF = implode(' ', $dateF);
            } else {
                // Si $dateF est déjà une chaîne, utilisez-la directement
                $chaineDateF = $dateF;
            }
          
            $chainesDatesF[] = $chaineDateF;
        }

        // Implémentez les chaînes de dates en une seule chaîne
        $chaineDatesFin = implode(' ', $chainesDatesF);

        $annonce->datefin = $chaineDatesFin;

      
        //---------------------------------------------Gestion tableau Prix
        $prixTab = $request->input('prix');
        $chainesPrix = [];
        
              
        foreach ($prixTab as $prix) {
            if (is_array($prix)) {
                $chainePrix = implode(' ', $prix);
            } else {
                $chainePrix = $prix;
            }
          
            $chainesPrix[] = $chainePrix;
        }
        
        $chainePrix = implode(' ', $chainesPrix);
        
        $annonce->libprix = $chainePrix;
        $annonce->save();

        $photo = new Photo();
        $photo->photo = $request->input("lien_photo");
        $photo->idannonce = $annonce->idannonce;
        $photo->save();
    
        return redirect('/compte')->withInput()->with("compte",'Annonce créée');
      }




     
      public function indexIncident()
      {
        $annonces = LeBonCoin::all();
        $incidents = Incident::all();
        return view('incidentclass', compact('incidents',"annonces"));
      }

      public function classementSansSuite(Request $request, $id)
      {
          $incident = Incident::find($id);

          $statut = $request->input('statut', 'non-resolu');

          $incident->resolu = true;

          $incident->commentaire = ($statut == 'resolu') ? 'Problème résolu' : 'Problème non résolu';

          $incident->save();

          return redirect('/incident');
      }


      public function resolution($id)
      {
          Incident::where('idincident', $id)->update(['resolu' => true]);
          return redirect('/incident');
      }

      
      public function mesIncidents()
      {
          $annonces = LeBonCoin::all();
          $user = Auth::user();
          $incidents = $user->incidents;
          return view('mes_incidents', compact('incidents','annonces'));
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
  
  

    
