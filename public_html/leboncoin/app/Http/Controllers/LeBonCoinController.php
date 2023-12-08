<?php

namespace App\Http\Controllers;

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
use App\Models\TypeHebergement;
use App\Models\ConditionHebergement;
use App\Models\Appartient;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Config;
use Illuminate\Support\Facades\Storage;

class LeBonCoinController extends Controller
{

    public function index() {
        return view ("annonces-list", ['annonces'=>LeBonCoin::all() ], ['photo'=>Photo::all() ]);
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
       // Commencer à partir de 5, l'ID suivant sera 6 pour le nouvel incident
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
    $id = $id;//find($id)
    // $criteres = $annonce->criteres->pluck('libellecritere')->toArray();
    // $equipements = $annonce->equipements()->pluck('nomequipement')->toArray();
    return view("reservationlist", compact('id'));
  }
  public function oneann($id) {
    $id = $id;//find($id)
  // $criteres = $annonce->criteres->pluck('libellecritere')->toArray();
  // $equipements = $annonce->equipements()->pluck('nomequipement')->toArray();
  return view("annoncelist", compact('id'));
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
    $annonces = LeBonCoin::find($id);
    $compte = Compte::find($id);
    $ville = Ville::find($id);
    $departement = Departement::find($id);
    $proprio = Particulier::find($id);
    $particuiler = Particulier::find($id);
    return view("proprio", compact('annonces', 'compte', 'ville', 'departement', 'proprio'));
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
        if($nouvellePdp != ""){
          $compte->pdp = $nouvellePdp;
        }
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
      private function create (Post $post, CreatePostRequest $request): array
        {
            $data = $request->validated();
            /** @var UploadedFile|null $image */
            $image = $request->validated('image');
            $post->image = $image->store('blog', 'public');

            if ($post->image) {
              Storage::disk('public')->delete($post->image);
          }
        }
    



  public function save(Request $request)
    {
      if (
        $request->input("nom") == "" || 
        $request->input("prenom") == "" ||
        $request->input("email") == "" ||
        $request->input("sexe") == "" ||
        $request->input("date") == "" ||
        $request->input("ville") == "" ||
        $request->input("mdp") == "" ||
        $request->input("adresse") == "" ||
        $request->input("region") == "" ||
        $request->input("dept") == "" ||
        $request->input("cp") == "" ) {return redirect('createaccountparticulier')->withInput()->with("error","Il semblerait que vous n'ayez pas renseigné tous les champs !");
    } else {
      $testville = false;
      $testregion = false;
      $testdept = false;
      $a = new Compte();
      $villeAll = Ville::all();
      foreach ($villeAll as $vile) { 
        if ( $request->input("ville") == $vile->nomville) {
            $a->idville = $vile->idville;
            $testville = true;
            break;
          }
        }
        if ($testville == false) {
          $deptAll = Departement::all();
          $regAll = Region::all();
          $vile = new Ville();
          $vile->idville = Ville::max('idville')+1;
          $a->idville = Ville::max('idville')+1;
          $vile->nomville = $request->input("ville");
          $depart = new Departement();
          foreach ($regAll as $regon) { 
            if ( $request->input("region") == $regon->nomregion) {
              $vile->nomregion = $request->input("region");
              $depart->idregion = $regon->idregion;
              $testregion = true;
              break;
            } 
          }
          if ($testregion == false) {
            $regi = new Region();
            $vile->nomregion = $request->input("region");
            $regi->nomregion = $request->input("region");
            $regi->idregion = Region::max('idregion')+1;
            $depart->idregion = Region::max('idregion')+1;
            $regi->save();
            }
          
          foreach ($deptAll as $depta) {
            if ( $request->input("dept") == $depta->nomdepartement) {
              $vile->iddepartement = $depta->iddepartement;
              $testdept = true;
              $vile->save();
              break;
            } 
          }
          if ($testdept == false) {
            $depart->nomregion = $request->input("region");
            $depart->iddepartement = Departement::max('iddepartement')+1;
            $depart->nomdepartement = $request->input("dept");
            $depart->numdepartement = $request->input("cp");
            $vile->iddepartement = Departement::max('iddepartement')+1;
            $depart->save();
            $vile->save();
          }
        }
          
        /*-----------------compte------------------*/
        $a->motdepasse = password_hash($request->input("mdp"), PASSWORD_DEFAULT);
        $a->adresseruecompte = $request->input("adresse");
        $a->adressecpcompte = $request->input("cp");
        $a->codeetatcompte = 0;
        $a->email = $request->input("email");
        $a->save();
     
        $b = new Particulier();
        $b->idcompte = $a->idcompte;
        $lastIdPart = Particulier::max('idparticulier');
        $newId = $lastIdPart + 1;
        $b->idparticulier = $newId;
        if ($request->input("mail")==""){$b->bonplanmailpartenaire = false;} else {$b->bonplanmailpartenaire = true;} //
        $b->nomparticulier = $request->input("nom");
        $b->prenomparticulier = $request->input("prenom");
       
        
        if ($request->input("sexe") == "Homme") { $b->civilite = true;} else { $b->civilite = false;}
        $boutdate = explode('-', $request->input("date"));
        $date = $boutdate[2] . "-" . $boutdate[1] . "-" . $boutdate[0];
        $b->datenaissanceparticulier = $date;
        $b->etatcompte = 0;
        $b->save();
        return redirect('/annonce-filtres?ville=&type_hebergement=&datedebut=&datefin=')->withInput()->with("compte",'compte créé');
    }
  } 
  public function saveent(Request $request)
    {
      if (
        $request->input("nom") == "" || 
        $request->input("siret") == "" ||
        $request->input("secteur") == "" ||
        $request->input("ville") == "" ||
        $request->input("mdp") == "" ||
        $request->input("adresse") == "" ||
        $request->input("region") == "" ||
        $request->input("dept") == "" ||
        $request->input("cp") == "" ) {
          return redirect('createaccountentreprise')->withInput()->with("error","Il semblerait que vous n'ayez pas renseigné tous les champs !");
    } else {
      $testville = false;
      $testregion = false;
      $testdept = false;
      $a = new Compte();
      $villeAll = Ville::all();
      foreach ($villeAll as $vile) {
        if ( $request->input("ville") == $vile->nomville) {
            $a->idville = $vile->idville;
            $testville = true;
            break;
          }
        }
        if ($testville == false) {
          $deptAll = Departement::all();
          $regAll = Region::all();
          $vile = new Ville();
          $vile->idville = Ville::max('idville')+1;
          $a->idville = Ville::max('idville')+1;
          $vile->nomville = $request->input("ville");
          $depart = new Departement();
          foreach ($regAll as $regon) { 
            if ( $request->input("region") == $regon->nomregion) {
              $vile->nomregion = $request->input("region");
              $depart->idregion = $regon->idregion;
              $testregion = true;
              break;
            } 
          }
          if ($testregion == false) {
            $regi = new Region();
            $vile->nomregion = $request->input("region");
            $regi->nomregion = $request->input("region");
            $regi->idregion = Region::max('idregion')+1;
            $depart->idregion = Region::max('idregion')+1;
            $regi->save();
            }
          
          foreach ($deptAll as $depta) {
            if ( $request->input("dept") == $depta->nomdepartement) {
              $vile->iddepartement = $depta->iddepartement;
              $testdept = true;
              $vile->save();
              break;
            } 
          }
          if ($testdept == false) {
            $depart->nomregion = $request->input("region");
            $depart->iddepartement = Departement::max('iddepartement')+1;
            $depart->nomdepartement = $request->input("dept");
            $depart->numdepartement = $request->input("cp");
            $vile->iddepartement = Departement::max('iddepartement')+1;
            $depart->save();
            $vile->save();
          }
        }
        $a->motdepasse =  password_hash($request->input("mdp"), PASSWORD_DEFAULT);
        $a->adresseruecompte = $request->input("adresse");
        $a->adressecpcompte = $request->input("cp");
        $a->siret = $request->input("siret");
        $a->codeetatcompte = 2;
        $a->save();
     
        $b = new Entreprise();
        $b->idcompte = $a->idcompte;
        $b->identreprise = Entreprise::max('identreprise')+1;
        $b->secteuractivite = $request->input("secteur");
        $b->societe = $request->input("nom");
        $b->save();
        return redirect('/annonce-filtres?ville=&type_hebergement=&datedebut=&datefin=')->withInput()->with("compte",'compte professionnel créé');
      }
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
      $idCritere = Critere::max('idcritere')+1;
      $critere->save();

      $idCritere = $critere->id;

  
      // Récupérer l'id condition hébergement nouvellement créé
        $idConditionHebergement = $conditionHebergement->idconditionh;


        $appartient = new Appartient();
        $annonce->idannonce = LeBonCoin::max('idannonce')+1;
        $appartient->idannonce = LeBonCoin::max('idannonce')+1;
        $annonce->idcompte = Auth::id(); // Associer l'annonce à l'utilisateur connecté
        //$annonce->identreprise = false;
        $annonce->idville = $idVille; // Associer l'annonce à la ville sélectionnée
        $annonce->idtype = $idTypeHebergement;
        $annonce->titreannonce = $request->input("titreannonce");
        $annonce->idcritere = $idCritere;
        $annonce->description = $request->input("description");
        $annonce->dateannonce = $request->input("date");
        $annonce->codeetatvalide = False;
        $annonce->codeetattelverif = False;
        $annonce->save();
        
        $appartient->prix = $request->input("prix");
        $appartient->idperiode = 1;

        
        //$annonce->lien_photo = $request->input("lien_photo");
        
    
        // Sauvegardez l'annonce dans la base de données
        
        // Récupérez le lien de la photo depuis le formulaire
        //$lienPhoto = $request->input('lien_photo');
    
        // Créez une nouvelle entrée dans la table Photo associée à l'annonce
        //$photo = new Photo();
        //$photo->lien_photo = $lienPhoto;
        //$photo->idannonce = $annonce->idannonce; // Assurez-vous que la clé étrangère est correctement liée
        //$photo->save();
    
        return redirect('/compte')->withInput()->with("compte",'Annonce créée');
      }
      public function marquerCommeResolu($idincident)
{
    $incident = Incident::find($idincident);

    if ($incident) {
        $incident->resolu = true; // Mettre à jour le champ "resolu" à true
        $incident->save();
        return redirect('/compte')->with('success', 'Incident marqué comme résolu avec succès');
    } else {
        return redirect('/compte')->with('error', 'Incident non trouvé');
    }
}


    

      
      public function indexIncident()
      {
        $incidents = Incident::all();
        return view('incidentclass', compact('incidents'));
      }

      
      
      public function classementSansSuite(Request $request, $id)
      {
          $incident = Incident::find($id);

          $statut = $request->input('statut', 'non-resolu');

          $incident->resolu = true;

          $incident->commentaire = ($statut == 'resolu') ? 'Souris dans la chambre' : 'Problème non résolu';

          $incident->save();

          return redirect('/incidents');
      }




      public function resolution($id)
      {
          Incident::where('idincident', $id)->update(['resolu' => true]);
          return redirect('/incidents');
      }





    }
  

    
