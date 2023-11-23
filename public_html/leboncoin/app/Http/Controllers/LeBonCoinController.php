<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LeBonCoin;
use App\Models\Particulier;
use App\Models\Entreprise;
use App\Models\Compte;
use App\Models\Ville;
use App\Models\Photo;
use App\Models\Critere;
use Illuminate\Support\Facades\Hash;

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
    public function createaccount() {
      return view("createaccount");
    }
    public function one($id) {
      return view ("annonce", ['annonce'=>LeBonCoin::find($id) ], ['photo'=>Photo::find($id) ], ['critere'=>Critere::find($id) ]);
    }
    public function search() {
      return view("search");
    }
    public function createaccountparticulier() {
      return view("createaccountparticulier"); 
    }
  public function save(Request $request)
    {
      if (
          $request->input("nom") == "" || 
          $request->input("prenom") == "" ||
          $request->input("email") == "" ||
          $request->input("civi") == "" ||
          $request->input("date") == "" ||
          $request->input("ville") == "" ||
          $request->input("mdp") == "" ||
          $request->input("rue") == "" ||
          $request->input("cp") == "" ) {
            return redirect('createaccountparticulier')->withInput()->with("error","Il semblerait que vous n'ayez pas renseigné tous les champs !");
      } else {
        $a = new Compte();
        $villeAll = Ville::all();
        foreach ($villeAll as $vile) { 
          if ($request->input("ville") == $vile->nomville) {$a->idville = $vile->idville;}
          else {$a->idville = 100;}
        }
        //if ($request->input("mdp"))
        $a->motdepasse = Hash::make($request->input("mdp"));
        $a->adresseruecompte = $request->input("rue");
        $a->adressecpcompte = $request->input("cp");
        $a->codeetatcompte = 0;
        $a->save();
     
        $b = new Particulier();
        $b->idcompte = $a->idcompte;
        $lastIdPart = Particulier::max('idparticulier');
        $newId = $lastIdPart + 1;
        $b->idparticulier = $newId;
        if ($request->input("mail")==""){$b->bonplanmailpartenaire = false;} else {$b->bonplanmailpartenaire = true;} //
        $b->nomparticulier = $request->input("nom");
        $b->prenomparticulier = $request->input("prenom");
        $b->adressemailparticulier = $request->input("email");
        if ($request->input("nom") =="Homme") { $b->civilite = true;} else { $b->civilite = false;}
        $b->datenaissanceparticulier = $request->input("date");
        $b->etatcompte = 1;
        $b->save();
        return redirect('/');
      } 
    }
    }
