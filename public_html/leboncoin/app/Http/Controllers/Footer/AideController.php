<?php

namespace App\Http\Controllers\Footer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AideController extends Controller
{
    public function aide() {
        return view("footer/help/aide");                #footerFolder #helpFolder
    }
    public function aidecompte() {
        return view("footer/help/aidecompte");          #footerFolder #helpFolder
    }
    public function aideannonce() {
        return view("footer/help/aideannonce");         #footerFolder #helpFolder
    }
    public function aideres() {
        return view("footer/help/aideres");             #footerFolder #HelpFolder
    }
    public function aiderecherche() {
        return view("footer/help/aiderecherche");       #footerFolder #HelpFolder
    }
    /*---------------------COMPTE-----------------------*/
    public function creercompte() {
        return view("footer/help/creercompte");          #footerFolder #HelpFolder
    }
    public function cocompte() {
        return view("footer/help/cocompte");          #footerFolder #HelpFolder
    }
    public function gererann() {
        return view("footer/help/gererann");          #footerFolder #HelpFolder
    }
    public function gererres() {
        return view("footer/help/gererres");          #footerFolder #HelpFolder
    }
    public function gererinci() {
        return view("footer/help/gererinci");          #footerFolder #HelpFolder
    }
    public function gererfav() {
        return view("footer/help/gererfav");          #footerFolder #HelpFolder
    }
    public function gererbanc() {
        return view("footer/help/gererbanc");          #footerFolder #HelpFolder
    }
    public function gererinfo() {
        return view("footer/help/gererinfo");          #footerFolder #HelpFolder
    }
    public function modifinfo() {
        return view("footer/help/modifinfo");          #footerFolder #HelpFolder
    }
    public function deco() {
        return view("footer/help/deco");          #footerFolder #HelpFolder
    }
    /*---------------------ANNONCE-----------------------*/
    public function depann() {
        return view("footer/help/depann");          #footerFolder #HelpFolder
    }
    public function proprioann() {
        return view("footer/help/proprioann");          #footerFolder #HelpFolder
    }
    public function partageann() {
        return view("footer/help/partageann");          #footerFolder #HelpFolder
    }
    public function depavis() {
        return view("footer/help/depavis");          #footerFolder #HelpFolder
    }
    public function sauvann() {
        return view("footer/help/sauvann");          #footerFolder #HelpFolder
    }
    public function infoann() {
        return view("footer/help/infoann");          #footerFolder #HelpFolder
    }
    /*---------------------RECHERCHE-----------------------*/
    public function fairerech() {
        return view("footer/help/fairerech");          #footerFolder #HelpFolder
    }
    public function sauvrech() {
        return view("footer/help/sauvrech");          #footerFolder #HelpFolder
    }
    public function voircarte() {
        return view("footer/help/voircarte");          #footerFolder #HelpFolder
    }
    public function rechloc() {
        return view("footer/help/rechloc");          #footerFolder #HelpFolder
    }
    public function rechheb() {
        return view("footer/help/rechheb");          #footerFolder #HelpFolder
    }
    /*---------------------RESERVATION-----------------------*/
    public function resann() {
        return view("footer/help/resann");          #footerFolder #HelpFolder
    }
    public function resprob() {
        return view("footer/help/resprob");          #footerFolder #HelpFolder
    }
    public function resrefu() {
        return view("footer/help/resrefu");          #footerFolder #HelpFolder
    }
}
