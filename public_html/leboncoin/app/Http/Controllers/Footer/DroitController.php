<?php

namespace App\Http\Controllers\Footer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Particulier;
use App\Models\Entreprise;
use App\Models\Compte;
use App\Models\Ville;
use App\Models\Carte;
use App\Models\Enregistre;

class DroitController extends Controller
{
    public function cookie() {
        return view("footer/legislation/cookie");           #footerFolder #legislationFolder
    }
    public function politique() {
        return view("footer/legislation/politique");        #footerFolder #legislationFolder
    }
    public function registre() {
        return view("footer/legislation/registre");         #footerFolder #legislationFolder
    }
    public function contrat() {
        return view("footer/legislation/contrat");          #footerFolder #legislationFolder
    }
    public function mesinfoperso() {
        $comptes = Compte::All();
        $particuliers = Particulier::All();
        $entreprises = Entreprise::All();
        $villes = Ville::All();
        $cartes = Carte::All();
        $enregistres = Enregistre::All();
        return view("footer/legislation/mesinfoperso", compact('comptes', "particuliers", "entreprises", "villes", "cartes", "enregistres"));        #footerFolder #legislationFolder
    }
    public function supprinfo() {
        return view("footer/legislation/contrat");
    }
}
