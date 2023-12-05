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
use App\Models\Photo;
use App\Models\Critere;
use App\Models\Reservation;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class LeBonCoinController extends Controller
{

    public function index() {
        return view ("annonces-list", ['annonces'=>LeBonCoin::all() ], ['photo'=>Photo::all() ]);
    }
    public function add() {
      $villes = Ville::all();
      
        return view("annonceeuh",compact('villes'));
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
public function incidentsave(Request $request,  $id)
{
  $validatedData = $request->validate([
      'commentaire' => 'nullable|string|max:255',
  ]);

  // Récupérer les données nécessaires à partir de la réservation
  $incidentData = Reservation::join('annonces', 'reservations.idannonce', '=', 'annonces.id')
      ->join('incidents', 'annonces.id', '=', 'incidents.id_annonce')
      ->where('reservations.id', $id)
      ->select('incidents.*')
      ->first(); // Vous pouvez choisir les colonnes nécessaires ici

  if (!$incidentData) {
      // Gérer la situation où les données de l'incident ne sont pas trouvées
  }

  // Créer une nouvelle instance d'incident
  $incident = new Incident();
  $incident->fill($incidentData->toArray()); // Remplir les données de l'incident à partir de la réservation

  // Remplacer le commentaire si une valeur est fournie dans le formulaire
  $incident->commentaire = $validatedData['commentaire'] ?? $incident->commentaire;

  // Sauvegarder les modifications ou la nouvelle entrée d'incident
  $incident->save();

  return redirect()->back()->with('success', 'Problème signalé avec succès.');
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
      return view("annonce", compact('annonce', 'photos', 'criteres', 'similarFirstWordAds', 'avis','equipements'));
  }
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
    public function updateEmail(Request $request)
    {
        $newEmail = $request->input('email');

        // Mettez à jour l'e-mail dans la base de données, par exemple
        // en utilisant le modèle Compte et la relation avec l'utilisateur actuel.
        Auth::user()->compte->update(['email' => $newEmail]);

        // Réponse JSON facultative pour informer le client que la mise à jour est terminée
        return response()->json(['success' => true]);
    }
    public function updateUserInfo(Request $request)
    {
        // $nouvellePdp = $request->input('nouvellePdp');
        $nouvelEmail = $request->input('nouvelEmail');
        $nouvelleRue = $request->input('nouvelleRue');
        $nouveauCP = $request->input('nouveauCP');
        $nouvelleVille = $request->input('nouvelleVille');
        $nouveauNom = $request->input('nouveauNom');
        $nouveauPrenom = $request->input('nouveauPrenom');

        // Mettez en œuvre la logique de sauvegarde dans la base de données ici
        // Assurez-vous de valider et sécuriser vos données avant de les enregistrer
        
        $compte = Auth::user()->compte;
        // if($nouvellePdp != ""){
        //   $compte->pdp = $nouvellePdp;
        // }
        if($nouvelEmail != ""){
          $compte->email = $nouvelEmail;
        }
        if($nouvelleRue != ""){
          $compte->adresseruecompte = $nouvelleRue;
        }
        if($nouveauCP != ""){
          $compte->adressecpcompte = $nouveauCP;
        }
        

        $ville = Auth::user()->compte;
        if($nouvelleVille != ""){
           $villeAll = Ville::all();
           foreach ($villeAll as $vile) { 
             if ( $nouvelleVille == $vile->nomville) {
                 $ville->idville = $vile->idville;
             } //A REFAIRE
             else {/*ca plante*/}
        }
        $compte->save();
        $ville->save();

        $particulier = Auth::user()->particulier; 
        if($nouveauNom != ""){
          $particulier->nomparticulier = $nouveauNom;
        }
        if($nouveauPrenom != ""){
          $particulier->prenomparticulier = $nouveauPrenom; 
        }
        $particulier->save();

        // Ajoutez la logique pour mettre à jour d'autres informations, si nécessaire

        // Redirigez ou renvoyez une réponse
        return redirect()->back()->with('success', 'Informations utilisateur mises à jour avec succès');
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
        $request->input("cp") == "" ) {
          return redirect('createaccountparticulier')->withInput()->with("error","Il semblerait que vous n'ayez pas renseigné tous les champs !");
    } else {
        $a = new Compte();
        $villeAll = Ville::all();
        foreach ($villeAll as $vile) { 
          if ( $request->input("ville") == $vile->nomville) {
              $a->idville = $vile->idville;
          } //A REFAIRE
          else {/*ca plante*/}
        }
        // $a->motdepasse = Hash::make($request->input("mdp"));
        $a->motdepasse = password_hash($request->input("mdp"), PASSWORD_DEFAULT);
        $a->adresseruecompte = $request->input("adresse");
        $a->adressecpcompte = $request->input("cp");
        $a->codeetatcompte = 1;
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
      $annonce = new Annonce();
      // Attribuez les valeurs des champs de l'annonce depuis le formulaire
      $annonce = new LeBonCoin();
      $annonce->titreannonce = $request->input("titreannonce");
      $annonce->date_arrivee = $request->input("apagnyan1");
      $annonce->date_depart = $request->input("apagnyan1");
      $annonce->fumeur = $request->has("apagnyan") ? 1 : 0;
      $annonce->animaux_acceptes = $request->has("apagnyan2") ? 1 : 0;
      $annonce->ville = $request->input("ville");
      $annonce->capacite = $request->input("critere2");
      $annonce->nombre_chambres = $request->input("critere2");
      $annonce->description = $request->input("description");
      $annonce->date = $request->input("date");
      $annonce->prix = $request->input("prix");
      $annonce->lien_photo = $request->input("lien_photo");
      $annonce->save();
  
      // Sauvegardez l'annonce dans la base de données
      $annonce->save();
  
      // Récupérez le lien de la photo depuis le formulaire
      $lienPhoto = $request->input('lien_photo');
  
      // Créez une nouvelle entrée dans la table Photo associée à l'annonce
      $photo = new Photo();
      $photo->lien_photo = $lienPhoto;
      $photo->idannonce = $annonce->idannonce; // Assurez-vous que la clé étrangère est correctement liée
      $photo->save();
  
      return redirect('/annonces')->with('success', 'Annonce créée avec succès!');
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
        $request->input("cp") == "" ) {
          return redirect('createaccountentreprise')->withInput()->with("error","Il semblerait que vous n'ayez pas renseigné tous les champs !");
    } else {
        $a = new Compte();
        $villeAll = Ville::all();
        foreach ($villeAll as $vile) { 
          if ( $request->input("ville") == $vile->nomville) {
              $a->idville = $vile->idville;
          } //A REFAIRE
          else {/*ca plante*/}
        }
        $a->motdepasse =  password_hash($request->input("mdp"), PASSWORD_DEFAULT);
        $a->adresseruecompte = $request->input("adresse");
        $a->adressecpcompte = $request->input("cp");
        $a->siret = $request->input("siret");
        $a->codeetatcompte = 1;
        $a->save();
     
        $b = new Entreprise();
        $b->idcompte = $a->idcompte;
        $b->secteuractivite = $request->input("secteur");
        $b->societe = $request->input("nom");
        $b->save();
        return redirect('/annonce-filtres?ville=&type_hebergement=&datedebut=&datefin=')->withInput()->with("compte",'compte professionnel créé');
      } 
    }
    
    }

    
