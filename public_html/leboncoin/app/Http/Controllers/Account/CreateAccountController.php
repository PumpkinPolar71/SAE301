<?php

namespace App\Http\Controllers\account;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Models\LeBonCoin;
use App\Models\Particulier;
use App\Models\Entreprise;
use App\Models\Compte;
use App\Models\Ville;
use App\Models\Departement;
use App\Models\Region;

class CreateAccountController extends Controller
{
  //_______________________________________________.Choix_entre_Particulier_ou_Entreprise.___________________________________________________//
    public function createaccount() {
      return view("account/create/createaccount");                                                                                                      #accountFolder #createFolder
    }
  //

  //_______________________________________________.Creation_Compte_Entreprise.___________________________________________________//
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
  //

  //_______________________________________________.Creation_Compte_Particulier.___________________________________________________//
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
  //
}
