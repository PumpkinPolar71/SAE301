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
}
