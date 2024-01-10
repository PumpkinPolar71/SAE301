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
        /*---------------------COMPTE-----------------------*/
}
