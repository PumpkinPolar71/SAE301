<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LeBonCoin;
use App\Models\Particulier;
use App\Models\Entreprise;
use App\Models\Compte;

class LeBonCoinController extends Controller
{
    public function index() {
        return view ("annonces-list", ['annonces'=>LeBonCoin::all() ]);
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
      return view ("annonce", ['annonce'=>LeBonCoin::find($id) ]);
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
          $request->input("mail") == "" ||
          $request->input("cp") == "" ) {
            return redirect('createaccountparticulier')->withInput()->with("error","Oups, t'as fait une boulette !");
      } else {
        $a = new Compte();
        $a->idville = $request->input("ville");
        $a->motdepasse = $request->input("mdp");
        $a->adresseruecompte = $request->input("rue");
        $a->adressecpcompte = $request->input("cp");
        $a->codeetatcompte = 1;
        $a->save();
     
        $b = new Particulier();
        $b->idcompte = $a->idcompte;
        $lastIdPart = Particulier::max('idparticulier');
        $newId = $lastIdPart + 1;
        $b->idparticulier = $newId;
        $b->bonplanmailpartenaire = $request->input("mail");
        $b->nomparticulier = $request->input("nom");
        $b->prenomparticulier = $request->input("prenom");
        $b->adressemailparticulier = $request->input("email");
        if ($request->input("nom") =="Homme") { $b->civilite = true;} else { $b->civilite = false;}
        $b->datenaissanceparticulier = $request->input("date");
        $b->etatcompte = false;
        $b->save();
        return redirect('/');
      } 
    }
    }
