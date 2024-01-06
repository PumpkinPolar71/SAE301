<?php

namespace App\Http\Controllers\Footer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AideController extends Controller
{
    public function aide() {
        return view("Footer/Help/aide");                #FooterFolder #HelpFolder
    }
    public function aidecompte() {
        return view("Footer/Help/aidecompte");          #FooterFolder #HelpFolder
    }
    public function aideannonce() {
        return view("Footer/Help/aideannonce");         #FooterFolder #HelpFolder
    }
    public function aideres() {
        return view("Footer/Help/aideres");             #FooterFolder #HelpFolder
    }
}
