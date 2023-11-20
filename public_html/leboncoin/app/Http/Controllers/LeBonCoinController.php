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
     
        $b = new Particulier();
        $b->idcompte = 986;
        $b->bonplanmailpartenaire = $request->input("mail");
        $b->nomparticulier = $request->input("nom");
        $b->prenomparticulier = $request->input("prenom");
        $b->adressemailparticulier = $request->input("email");
        //if ($request->input("nom") =="Homme") { $b->civilite = $request->input(true);} else { $b->civilite = $request->input(false);}
        $b->civilite = $request->input(true);
        $b->datenaissanceparticulier = $request->input("date");
        $b->save();

        return redirect('/');
      
      } 
    }
    public function index(Request $request)
    {
        $villes = Ville::all();
        $typesHebergement = TypeHebergement::all(); // Assurez-vous d'avoir le modèle et la table pour les types d'hébergement
    
        $annonces = Annonce::query();
    
        if ($request->has('ville')) {
            $annonces->where('ville', $request->ville);
        }
    
        if ($request->has('type_hebergement')) {
            $annonces->where('idtype', $request->type_hebergement);
        }
    
        if ($request->has('datedebut') && $request->has('datefin')) {
            $dateDebut = Carbon::createFromFormat('Y-m-d', $request->date_debut)->startOfDay();
            $dateFin = Carbon::createFromFormat('Y-m-d', $request->date_fin)->endOfDay();
    
            $annonces->whereBetween('date_disponibilite', [$dateDebut, $dateFin]);
        }
    
        $annonces = $annonces->get();
    
        return view('annonces.index', compact('annonces', 'villes', 'typesHebergement'));
    }
    }
