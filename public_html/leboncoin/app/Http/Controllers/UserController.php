<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Entreprise;                      //UserController
use App\Models\Particulier;                     //UserController
use App\Models\Ville;                           //LocalisationController
use App\Models\Compte;                          //UserController
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    //_____________________________________.Modifier_son_compte.______________________//
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
    //_____________________________________.Créer_un_compte_particulier.______________________//
      public function createaccountparticulier() {
        return view("createaccountparticulier"); 
      }
    //_____________________________________.Créer_un_compte_entreprise.______________________//
      public function createaccountentreprise() {
        return view("createaccountentreprise"); 
      }
}
