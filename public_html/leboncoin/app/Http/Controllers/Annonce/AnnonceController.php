<?php

namespace App\Http\Controllers\Annonce;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\LeBonCoin;                       //AnnonceController
use App\Models\Annonce;                         //AnnonceController
use App\Models\TypeHebergement;                 //AnnonceController
use App\Models\ConditionHebergement;            //AnnonceController
use App\Models\Photo;                           //AnnonceController
use App\Models\Critere;                         //AnnonceController
use App\Models\Appartient;                      //AnnonceController

use App\Models\Compte;                          //AnnonceController
use App\Models\Departement;                     //AnnonceController
use App\Models\Particulier;                     //AnnonceController

use App\Models\Ville;                           //LocalisationController

use App\Models\Avis;


use Illuminate\Support\Facades\Auth;


class AnnonceController extends Controller
{
    //_____________________________________.Récupérer_infos_annonce_grace_a_un_id.______________________//
      public function one($id) {
        $id = (int)$id;

        $photos = Photo::where('idannonce', $id)->get();
        $annonce = Annonce::find($id);
        $criteres = $annonce->criteres->pluck('libellecritere')->toArray();
        $equipements = $annonce->equipements()->pluck('nomequipement')->toArray();
  
        $words = explode(' ', $annonce->titreannonce);
        $firstWord = strtolower($words[0]);
        $avis = $annonce->avis->pluck('commentaire')->toArray();
        $similarFirstWordAds = Annonce::join('photo', 'photo.idannonce', '=', 'annonce.idannonce')
                                        ->whereRaw('LOWER(SPLIT_PART(titreannonce, \' \', 1)) = ?', [$firstWord])
                                        ->where('annonce.idannonce', '<>', $id)
                                        ->get();
        if (Auth::user()) {
          if (Auth::user()->compte->codeetatcompte == 9 ) {
            return view("annonce/annonceserv", compact('annonce', 'photos', 'criteres', 'similarFirstWordAds', 'avis','equipements'));                #annonceFolder
          } else {
            return view("annonce/annonce", compact('annonce', 'photos', 'criteres', 'similarFirstWordAds', 'avis','equipements'));  // identique à \/ #annonceFolder
          }
        } else {
          return view("annonce/annonce", compact('annonce', 'photos', 'criteres', 'similarFirstWordAds', 'avis','equipements'));    // identique à /\ #annonceFolder
        }  
      }
    //

    //_____________________________________.Créer_une_annonce.______________________//
      public function add() {
        $villes = Ville::all();
        $typesHebergements = TypeHebergement::all();

        return view("annonce/create_annonce",compact('villes', "typesHebergements"));       #annonceFolder
      }
    //

    //_____________________________________.Ajouter_annonce.______________________//
      public function ajouterAnnonce(Request $request)
      {
          $typesHebergement = TypeHebergement::all();
          $idVille = $request->input('ville');
          $idTypeHebergement = $request->input('type_hebergement');
          $dateArrivee = $request->query('datearrive');
          $dateDepart = $request->query('datedepart');
          $fumeur = $request->has('fumeur') ? 'TRUE' : 'FALSE'; // TRUE si la case est cochée
          $animauxAcceptes = $request->has('animaux') ? 'TRUE' : 'FALSE'; // TRUE si la case est cochée
          $critereetoile = 0;
          $criterecapa = $request->input('critere1');
          $criterenbpers = $request->input('critere2');
          // Créer la chaîne représentant les conditions d'hébergement
          $libelleCondition = "$dateArrivee $dateDepart $fumeur $animauxAcceptes";
          // Concaténer les valeurs des critères pour former le libellé complet
          $libelleCritere = "$critereetoile $criterecapa $criterenbpers";
          $conditionHebergement = new ConditionHebergement();
          $conditionHebergement->libellecondition = $libelleCondition;
          $conditionHebergement->idconditionh = ConditionHebergement::max('idconditionh')+1;
      
          $annonce = new Annonce();
          $annonce->idconditionh = ConditionHebergement::max('idconditionh')+1;
          $conditionHebergement->save();
      
          $critere = new Critere();
          $critere->libellecritere = $libelleCritere;
          $critere->idcritere = Critere::max('idcritere')+1;
          $annonce->idcritere = Critere::max('idcritere')+1;
          $critere->save();
          // Récupérer l'id condition hébergement nouvellement créé
            $idConditionHebergement = $conditionHebergement->idconditionh;
            $annonce->idannonce = Annonce::max('idannonce')+1;
            $annonce->idcompte = Auth::id(); // Associer l'annonce à l'utilisateur connecté
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
                if (is_array($dateD)) {
                    $chaineDateD = implode(' ', $dateD);
                } else {
                    $chaineDateD = $dateD;
                }
              
                $chainesDatesD[] = $chaineDateD;
            }

            $chaineDatesDebut = implode(' ', $chainesDatesD);

            $annonce->datedebut = $chaineDatesDebut;
          
            //---------------------------------------------Gestion tableau DateFin

            $dateFinTab = $request->input('datefin');
            $chainesDatesF = [];
          
            foreach ($dateFinTab as $dateF) {
                if (is_array($dateF)) {
                    $chaineDateF = implode(' ', $dateF);
                } else {
                    $chaineDateF = $dateF;
                }
              
                $chainesDatesF[] = $chaineDateF;
            }

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
    //

    //_____________________________________.Afficher_le_proprietaire_de_l'annonce.______________________//
          public function proprio($id) {
            $compte = Compte::find($id);
            $villes = Ville::all();
            $departements = Departement::all();
            $particuliers = Particulier::all();
            return view("annonce/proprio", compact('compte','particuliers','villes','departements'));                 #annonceFolder
          }
    //

    //_____________________________________.Deposer_un_avis.______________________//
          public function deposerAvis(Request $request)
          {
              $idAnnonce = $request->input('idannonce');
              $commentaire = $request->input('commentaire');
              $idCompte = auth()->user()->id;
          
              // Créer un nouvel avis
              $avis = new Avis();
              $avis->idcompte = $idCompte;
              $avis->idparticulier = $idCompte;
              $avis->idannonce = $idAnnonce;
              $avis->dateavis = now(); // Date actuelle
              $avis->commentaire = $commentaire;
              $avis->valide = false;
          
              $avis->save();
          
              return redirect('annonce')->withInput();
          }
    //

    //_____________________________________.Enregistrer_un_avis.______________________//
      public function gestionAvis()
      {
        $avisNonValides = Avis::where('valide', false)->get();
        return view('avis/enregistrer_avis', compact('avisNonValides'));       #qvisFolder
      }
    //

    //_____________________________________.Modifier_un_avis.______________________//
      public function modifierAvis(Request $request, $id)
      {
          $avis = Avis::findOrFail($id);
          $avis->valide = $request->input('valide', false);
          $avis->save();

          return redirect('/enregistrer_avis')->with('success', 'Statut de l avis modifié avec succès');
      }
    //

    //_____________________________________.Vérifier_annonce_non-validée.______________________//
      public function annoncesNonValidees()
      {
        $annoncesNonVerifiees = LeBonCoin::where('codeetattelverif', false)->get();
        $particuliers = Particulier::all();

          return view('service/service_petites_annonces/validationtel', [ 'annoncesNonValidees'=>$annoncesNonVerifiees, "particuliers"=>$particuliers ]);      #serviceFolder #service_petites_annoncesFolder
      }
    //

    //_____________________________________.Vérifier_annonce_valide.______________________//
      public function validerAnnonce(Request $request, $idannonce)
      {
          LeBonCoin::where('idannonce', $idannonce)->update(['codeetattelverif' => true]);
      
          return redirect('/annonces-non-validees')->with('success', 'Annonce vérifiée avec succès.');
      }
    //
}
