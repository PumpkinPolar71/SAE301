<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\LeBonCoin;
use App\Models\Particulier;
use App\Models\Entreprise;
use App\Models\Compte;
use App\Models\Ville;
use App\Models\Departement;
use App\Models\Photo;
use App\Models\Critere;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class LeBonCoinController extends Controller
{
    public function index() {
        return view ("annonces-list", ['annonces'=>LeBonCoin::all() ], ['photo'=>Photo::all() ]);
    }
    public function add() {
        return view("annonce-add");
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
  
      // Récupérer le premier mot du titre de l'annonce principale
      $words = explode(' ', $annonce->titreannonce);
      $firstWord = strtolower($words[0]);
  
      // Récupérer les annonces ayant le même premier mot dans le titre
      $similarFirstWordAds = LeBonCoin::whereRaw('LOWER(SPLIT_PART(titreannonce, \' \', 1)) = ?', [$firstWord])
                                      ->where('idannonce', '<>', $id) // Exclure l'annonce principale
                                      ->get();
  
      return view("annonce", compact('annonce', 'photos', 'criteres', 'similarFirstWordAds'));
  }
    public function proprio($id) {
    $annonces = LeBonCoin::find($id);
    $compte = Compte::find($id);
    $ville = Ville::find($id);
    $departement = Departement::find($id);
    $proprio = Particulier::find($id);
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
    try {
        $user = Auth::user();
        
        $updated = $user->compte->update([
            'email' => $request->input('email'),
            'address' => $request->input('adressrueparticulier'),
            // Autres champs à mettre à jour
        ]);

        if ($updated) {
            // Mise à jour réussie
            return response()->json(['success' => true]);
        } else {
            // Échec de la mise à jour
            return response()->json(['success' => false, 'message' => 'Échec de la mise à jour']);
        }
    } catch (\Exception $e) {
        // Capturer les éventuelles erreurs et les afficher pour le débogage
        return response()->json(['success' => false, 'message' => $e->getMessage()]);
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
        $a->codeetatcompte = 1;
        $a->save();
     
        $b = new Entreprise();
        $b->idcompte = $a->idcompte;
        $b->secteuractivite = $request->input("secteur");
        $b->societe = $request->input("nom");
        $b->siret = $request->input("siret");
        $b->save();
        return redirect('/annonce-filtres?ville=&type_hebergement=&datedebut=&datefin=')->withInput()->with("compte",'compte professionnel créé');
      } 
    }
    
    }

    
