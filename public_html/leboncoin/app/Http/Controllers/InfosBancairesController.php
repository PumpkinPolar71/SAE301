<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

use App\Models\Compte;
use App\Models\Carte;
use App\Models\Enregistre;



class InfosBancairesController extends Controller
{
    //_______________________________________________.Décrypter_infos_bancaires_cryptées_dans_la_base_de_données.___________________________________________________//
        public function cryptInfosBc(Request $request) //non-fonctionnelle
        {
          $comptes = Compte::all();
          $enregistres = Enregistre::all();
          $cartes = Carte::all();

          return view("infosbancaires", compact('comptes','cartes','enregistres'));
        }
    //

    //_______________________________________________.Encrypter_infos_bancaires_avant_de_les_envoyer_dans_la_base_de_données.___________________________________________________//
        public function encrypt(Request $request) //non-fonctionnelle
        {
            $comptes = Compte::all();
            $enregistres = Enregistre::all();
            $cartes = Carte::all();

            $key = 'hfhkffhgjkghfhsgjskjidfhfhsdfhsgdhfssdfgsyfkdshfjdhfu';

            return view("infosbancaires", compact('comptes', 'enregistre', 'cartes'));
        }
    //
}
