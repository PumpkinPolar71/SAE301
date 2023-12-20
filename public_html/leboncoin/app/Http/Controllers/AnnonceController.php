<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LeBonCoin;                       //AnnonceController
use App\Models\Annonce;                         //AnnonceController
use App\Models\TypeHebergement;                 //AnnonceController
use App\Models\ConditionHebergement;            //AnnonceController
use App\Models\Photo;                           //AnnonceController
use App\Models\Critere;                         //AnnonceController
use App\Models\Appartient;                      //AnnonceController

use App\Models\Ville;                           //LocalisationController

use Illuminate\Support\Facades\Auth;


class AnnonceController extends Controller
{
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
    //_____________________________________.Créer_une_annonce.______________________//
      //View : create_annonce.blade.php
      public function add() {
        $villes = Ville::all();
        $typesHebergements = TypeHebergement::all();

        return view("create_annonce",compact('villes', "typesHebergements"));
      }
    //_____________________________________.Ajouter_annonce.______________________//
      //View : create_annonce.blade.php
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
}
