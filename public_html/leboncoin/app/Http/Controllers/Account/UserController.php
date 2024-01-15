<?php

namespace App\Http\Controllers\Account;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;

use App\Models\Entreprise;                      //UserController
use App\Models\Particulier;                     //UserController
use App\Models\Ville;                           //LocalisationController
use App\Models\Compte;                          //UserController



class UserController extends Controller
{
    //_____________________________________.Modifier_son_compte.______________________//
      public function updateUserInfo(Request $request)
      {
        // $siret = $request->input('siret');
        // $email = $request->input('email');
        // $societe = $request->input('nom');

        

        

        $nouvellePdp = $request->input('escapedImageData');
        $nouveauNom = $request->input('nouveauNom');
        $nouveauPrenom = $request->input('nouveauPrenom');
        $nouvelEmail = $request->input('nouvelEmail');

        $nouveauSiret = $request->input('nouveauSiret');          //entreprise
        $nouveauNomS = $request->input('nouveauNomS');            //entreprise
        $nouveauSecteur = $request->input('nouveauSecteur');      //entreprise

        $nouvelleRue = $request->input('nouvelleRue');
        $nouveauCP = $request->input('nouveauCP');
        $nouvelleVille = $request->input('nouvelleVille');

        $existeSiret = Compte::where('siret', $nouveauSiret)->exists();
        $existeEmail = Compte::where('email', $nouvelEmail)->exists();
        $existeSociete = Entreprise::where('societe', $nouveauNomS)->exists();
        
        $compte = Auth::user()->compte;
          $compte->pdp = $request->input('lien_pdp');
        if($nouvelEmail != ""){
          if ($existeEmail) {
            ssession()->flashInput($request->input());
            return back()->with('errorEmailExist', 'Cet e-mail est déjà utilisé. Veuillez en choisir un autre.');
          }else {
          $compte->email = $nouvelEmail;
          }
        }
        if($nouveauSiret != ""){
          if ($existeSiret) {
            session()->flashInput($request->input());
            return back()->with('errorSiretExist', "Il semble y avoir une erreur dans le siret.");
          }else {
            $compte->siret = $nouveauSiret;
          }
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
        if($particulier){
          if($nouveauNom != ""){
            $particulier->nomparticulier = $nouveauNom;
          }
          if($nouveauPrenom != ""){
            $particulier->prenomparticulier = $nouveauPrenom; 
          }
          $particulier->save();
        }

        $entreprise = Auth::user()->entreprise;
        if($entreprise){
          if($nouveauNomS != ""){
            if ($existeSociete) {
              session()->flashInput($request->input());
              return back()->with('errorSocieteExist', "Ce nom de société existe déjà");
            }else {
              $entreprise->societe = $nouveauNomS;
            
            
            }
          }
          if($nouveauSecteur != ""){
            $entreprise->secteuractivite = $nouveauSecteur;
            
          
          }
          $entreprise->save();
        }

        return redirect()->back()->with('success', 'Informations utilisateur mises à jour avec succès');
      
      }
    //
    
    //_____________________________________.Créer_un_compte_particulier.______________________//
      public function createaccountparticulier() {
        return view("account/create/createaccountparticulier");                     #accountFolder #createFolder
      }
    //

    //_____________________________________.Créer_un_compte_entreprise.______________________//
      public function createaccountentreprise() {
        return view("account/create/createaccountentreprise");                      #accountFolder #createFolder
      }
    //

    //_____________________________________.Redirection.______________________//
      public function compte() {
        return view("account/management/compte");                                   #accountFolder #managementFolder
      }
    //

    public function showUserProfile()
    {
        $user = $this->retrieveUser();
        return view('user.profile', compact('user'));
    }
}
