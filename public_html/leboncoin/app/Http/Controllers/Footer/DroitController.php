<?php

namespace App\Http\Controllers\Footer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
}
